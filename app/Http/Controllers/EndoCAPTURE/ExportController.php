<?php

namespace App\Http\Controllers\Endocapture;

use App\Http\Controllers\Controller;
use App\Http\Controllers\EndoINDEX\OperationDataController;
use App\Http\Controllers\EndoINDEX\SummaryDataController;
use App\Jobs\ExportCasesJob;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\Server;
use Exception;
use Illuminate\Support\Facades\Log;

class ExportController extends Controller
{
    // public function __construct(Request $r){checklogin();}

    public function index(Request $r)

    {
        if (Server::check_connection()) {
            return redirect(url('servererror'));
        }
        $serverconnect = @fsockopen(getCONFIG('admin')->server_name, portnumber(), $errno, $errstr, 1);
        $view = $this->indexfirst($r);
        // dd($view);
        return view('endo.export', $view);

    }

    public function indexfirst($r, $data = [])
    {

        $data['doctor']     = Department::server_user('doctor', uid());
        $data['nurse']      = Department::server_user('nurse', uid());
        $data['register']   = Department::server_user('register', uid());
        $data['procedure']  = Server::table('tb_procedure')->get();
        $data['scope']      = Server::table('tb_scope')->get();
        $data['allroom']    = Server::table('tb_room')->get();
        $data['users']      = Server::table('users')->where('user_type', '!=', 'endo')->get();
        $data['data2']      = $r;
        $data['icd9']       = $this->geticd9($r);  // intervention
        $data['icd10']      = $this->geticd10($r); // diagnosis
        $admin = getCONFIG('admin');
        $data['year_install'] = $admin->year_install;
        $scope = getCONFIG('scope');
        $data['is_phutshin'] = $scope->phutchin_scope ?? false;
        $data['users_modal'] = Server::table('users')->get();
        $data['data_limit']  = 250;
        return $data;
    }

    public function store(Request $r)
    {
        if (isset($r->event)) {
            $event  = $r->event;
            return $this->$event($r);
        }
    }

    public function geticd($r)
    {
        $arr['icd9'] = $this->geticd9($r);
        $arr['icd10'] = $this->geticd10($r);
        return jsonEncode($arr);
    }

    public function get_all_indication($type, $indication)
    {
        if ($type == 'EGD') {
            $indication[] = "GI Bleeding";
            $indication[] = "GERD";
            $indication[] = "Dyspepsia";
            $indication[] = "Dysphagia";
            $indication[] = "IDA";
            $indication[] = "Iron Deficiency Anemia";
        } else if ($type == 'Colonoscopy') {
            $indication[] = "CRC screening";
            $indication[] = "Constipation";
            $indication[] = "Abdominal pain";
            $indication[] = "Fit Positive";
            $indication[] = "Rectal Bleeding";
            $indication[] = "IBD";
            $indication[] = "Bowel Habit Change";
            $indication[] = "LGIB";
            $indication[] = "Family Hx CRC";
            $indication[] = "Diarrhea";
            $indication[] = "Surveillance colonoscopy";
            $indication[] = "Iron Deficiency Anemia";
        }
        return $indication;
    }

    public function get_indication($r)
    {
        $indication = [];
        if (!isset($r->procedure)) {
            $r->procedure = ['all'];
        }
        foreach (isset($r->procedure) ? $r->procedure : [] as $i => $procedure) {
            if ($procedure == "Colonoscopy") {
                $indication = $this->get_all_indication('Colonoscopy', $indication);
            } elseif ($procedure == "EGD") {
                $indication = $this->get_all_indication('EGD', $indication);
            } else {
                $indication = $this->get_all_indication('Colonoscopy', $indication);
                $indication = $this->get_all_indication('EGD', $indication);
            }
        }
        return json_encode($indication);
    }

    public function query_data($r)
    {
        // dd($r->all());
        if (isset($r->clear)) {
            return redirect(url('exportindex'));
        }
        $r         = (object) $r;
        $config = getCONFIG('hospital');
        $hospital_name = @$config->hospital_name;
        if (str_contains($hospital_name, 'วชิร')) {
            $this->format_room_vajira();
        }

// dd($data);
        if ($r->type == 'operation') {
            $data = OperationDataController::get_operation($r, $allcases ?? []);
        } else {
            $wc[0]     = array('updatetime', '!=', '');
            $wc[1]     = array('statusjob', "!=", 'delete');
            $wc[2]     = array('statusjob', "!=", 'cancel');
            $wc[3]     = array('case_status', "!=", 90);
            $allcases  = Server::table('tb_case')->where($wc)->orderBy('caseuniq', 'asc')->limit(250)->get() ?? [];
            $data = SummaryDataController::get_summary2($r, $allcases);
        }


        $data = $this->indexfirst($r, $data);

        // dd($data);
        return view('endo.export', $data);
    }

    public function get_tabledata($r)
    {
        try {
            $data     = OperationDataController::get_operation($r, $allcases ?? []);
            $query    = collect($data['cases'] ?? []);
            if ($query->isEmpty()) {
                throw new Exception('No data available for export.');
            }

            if (@$r->action == "export") {
                $searchText     = strtolower(trim(@$r->search . ""));
                $filtered_cases = $this->filter_cases($query, $searchText, $data['heads'], $data['onlyprocedure']);
                $query          = collect($filtered_cases);
                $filename = 'cases_' . time() . '.csv';
                ExportCasesJob::dispatch($query, $filename, array_values(array_keys($data['heads'])), $data['values']);
                $fileUrl = url('storage/app/' . $filename);
                return response()->json(['status' => 'success', 'fileUrl' => $fileUrl]);


            } else if (@$r->action == "show") {
                return response()->stream(function () use ($query, $data) {
                    $chunks = $query->chunk(250);
                    foreach ($chunks ?? [] as $c) {
                        Log::info('Chunk fetched: ' . count($c));
                        $rendered = view('endo.export.render_row', ['cases' => $c, 'heads' => $data['heads'], 'values' => $data['values']])->render();
                        echo $rendered;
                        if (ob_get_level() > 0) {
                            ob_flush();
                        }
                        flush();
                    }
                }, 200, [
                    'Content-Type' => 'text/html',
                    'Charset' => 'UTF-8',
                    'Cache-Control' => 'no-cache',
                ]);
            } else {
                $searchText     = strtolower(trim(@$r->search . ""));
                if ($searchText != "") {
                    $query = $this->filter_cases($query, $searchText, $data['heads'], $data['onlyprocedure']);
                }
                return response()->json(['status' => 'success', 'counts' => count($query)]);
            }
        } catch (Exception $e) {
            Log::error('Excel export error: ' . $e->getMessage());
            return response()->json(['status' => 'unsuccess', 'message' => $e->getMessage()], 500);
        }
    }

    function filter_cases($cases, $searchText, $heads, $onlyprocedure)
    {
        $conditions     = split_searchtext_condition($searchText);
        $ands           = $conditions['and_conditions'];
        $ors            = $conditions['or_conditions'];
        return $cases->map(function ($case) use ($ands, $ors, $heads, $onlyprocedure) {
            $case_array = format_cases($case, $heads, $onlyprocedure);
            $caseText = strtolower(implode(' ', $case_array));

            $isCompleteSearch = in_array('complete', $ands) || in_array('complete', $ors);
            $isIncompleteSearch = in_array('incomplete', $ands) || in_array('incomplete', $ors);
            $containsComplete = strpos($caseText, 'complete') !== false;
            $containsIncomplete = strpos($caseText, 'incomplete') !== false;

            $isOr = array_reduce($ors, function ($carry, $or) use ($caseText) {
                return $carry || (strpos($caseText, strtolower($or)) !== false);
            }, false);

            $isAnd = array_reduce($ands, function ($carry, $and) use ($caseText) {
                return $carry && (strpos($caseText, strtolower($and)) !== false);
            }, true);

            $can_show = ($isOr || $isAnd) &&
                (!$isCompleteSearch || ($isCompleteSearch && $containsComplete && !$isIncompleteSearch)) &&
                (!$isIncompleteSearch || ($isIncompleteSearch && $containsIncomplete));

            if ($can_show) {
                return $case_array;
            }

            return null;
        })->filter()->values();
    }

    public static function format_room_vajira()
    {
        $u['room'] = 'ENDO-4';
        $u['room_id'] = 4;
        $u['room_name'] = 'ENDO-4';
        $test = Server::table('tb_case')
            ->where('updatetime', '!=', '')
            ->where('statusjob', '!=', 'delete')
            ->where('statusjob', '!=', 'cancel')
            ->where('case_status', '!=', 90)
            ->where('appointment', 'like', "%2023-06%")
            ->where(function ($query) {
                $query->whereNull('room_id')
                    ->orWhere('room_id', '=', '');
            })
            ->update($u);
    }

    public static function geticd10($r)
    {
        $w[] = array('icd10', '!=', null);
        $tb_procedure = Server::table('tb_procedure')->where($w)->select('name', 'icd10')->get();
        if (isset($r->procedure)) {
            $tb_procedure = Server::table('tb_procedure')->where($w)->whereIn('name', $r->procedure)->select('name', 'icd10')->get();
        }

        $icd10        = [];
        foreach ($tb_procedure as $proc) {
            $proc = (object) $proc;
            if (!isset($proc->name) || !isset($proc->icd10)) {
                continue;
            }

            $icd10_proc = is_array($proc->icd10) ? $proc->icd10 : [];
            foreach ($icd10_proc as $key => $data) {
                if (isset($data)) {
                    for ($i = 0; $i < count($data); $i++) {
                        $name = $data[$i]['name'];
                        if (isset($name) && @$name . "" != "") {
                            $icd10[] = $name;
                        }
                    }
                }
            }
        }

        return $icd10;
    }

    public static function geticd9($r)
    {
        $w[] = array('icd9', '!=', null);
        $tb_procedure   = Server::table('tb_procedure')->where($w)->select('name', 'icd9')->get();
        if (isset($r->procedure)) {
            $tb_procedure = Server::table('tb_procedure')->where($w)->whereIn('name', $r->procedure)->select('name', 'icd9')->get();
        }

        $icd9        = [];
        foreach ($tb_procedure as $proc) {
            $proc = (object) $proc;
            if (!isset($proc->name) || !isset($proc->icd9)) {
                continue;
            }

            $icd9_proc = is_array($proc->icd9) ? $proc->icd9 : [];
            foreach ($icd9_proc as $key => $data) {
                if (isset($data)) {
                    for ($i = 0; $i < count($data); $i++) {
                        $name = $data[$i]['name'];
                        if (isset($name) && @$name . "" != "") {
                            $icd9[] = $name;
                        }
                    }
                }
            }
        }

        return $icd9;
    }

    public function render_summary_graph($r)
    {
        $data = $r->all();
        session(['data' => $data]);
        $temp = Server::table('tb_summarytemp')->where('id', 1)->first();
        if (empty($temp)) {
            $u['id'] = 1;
            Server::table('tb_summarytemp')->insert($u);
        }
        $view['count_case'] = $data['count_case'] ?? $temp['count_case'];
        $view['hours'] = $data['hours'] ?? $temp['hours'];
        $view['casetime'] = $data['casetime'] ?? $temp['casetime'];
        $view['data'] = $data['data'] ?? $temp['data'];
        $view['this_col'] = $data['this_col'] ?? $temp['this_col'];
        $view['this_year'] = $data['this_year'] ?? $temp['this_year'];
        $view['this_month'] = $data['this_month'] ?? $temp['this_month'];
        $view['this_type'] = $data['this_type'] ?? $temp['this_type'];
        $view['tbody_id'] = $data['tbody_id'] ?? $temp['tbody_id'];
        $view['have_month'] = $data['have_month'] ?? $temp['have_month'];
        $view['rooms'] = $data['rooms'] ?? $temp['rooms'];
        Server::table('tb_summarytemp')->where('id', 1)->update($view);
        return redirect(url('exportindex/1'));
    }

    public function show(Request $r, $id)
    {
        $temp = Server::table('tb_summarytemp')->where('id', 1)->first();
        $view['count_case'] = $temp['count_case'] ?? [];
        $view['hours'] = $temp['hours'] ?? [];
        $view['casetime'] =  $temp['casetime'] ?? [];
        $view['data'] =  $temp['data'] ?? [];
        $view['this_col'] =  $temp['this_col'] ?? [];
        $view['this_year'] =  $temp['this_year'] ?? '';
        $view['this_month'] =  $temp['this_month'] ?? '';
        $view['this_type'] = $temp['this_type'] ?? '';
        $view['tbody_id'] =  $temp['tbody_id'] ?? '';
        $view['have_month'] = $temp['have_month'] ?? '';
        $view['rooms'] =  $temp['rooms'] ?? [];

        return view('endo.export.render_graph', $view);
    }
}
