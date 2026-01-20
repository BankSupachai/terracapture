<?php

namespace App\Http\Controllers\api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use App\Models\Mongo;
use Excel;
use App\Models\Datacase;
use App\Models\Api;

use Exception;
use Illuminate\Contracts\Bus\Dispatcher;
use Symfony\Component\Process\Process;

class PdfnurseController extends Controller
{



    public function show($id,Request $r)
    {
        shell_exec(htdocs('endoindex'). "/public/pdf/nursereport.py $id");
        // dd(1);
        // $view['casedata']   = Datacase::first($id);
        // $view['hospital']   = get_hospital();
        // $view['note']       = Mongo::table('tb_casenote')->where('_id',$view['casedata']->noteid)->first();
        // $view['patient']    = Mongo::table('tb_patient')->where('hn',$view['casedata']->hn)->first();
        // $view['procedure']  = Mongo::table('tb_procedure')->where('name',$view['casedata']->procedurename)->first();
        // $view['caseall']    = Mongo::table('tb_case')->where('noteid',$view['casedata']->noteid)->get();
        // $pdf                = Pdf::loadView('endoindex.pdfnurse.start',$view);

        // $view['nursepdf'] = $this->generate_nursepdf($view['casedata']);

        // return $pdf->stream();
        // shell_exec(htdocs('endoindex'). "/public/pdf/nursereport.py $id");

        // dd($view);
        // return view('endoindex.pdfnurse.component.head');
        // return view('endoindex.nursereport',$view);

    }

    public function generate_nursepdf($case){
        $cid = $case['_id'];
        $scriptPath = htdocs('endoindex'). "/public/pdf/nursereport.py $cid";

        $pdfPath = $this->store_pdfdata($case);
        try {
            $process = new Process(['python', $scriptPath]);
            $process->run();
        } catch (\Throwable $th) {}
        return $pdfPath;
    }

    public function store_pdfdata($case){
        $folderdate = @$case->appointment_date ?? explode(' ', @$case->appointment."")[0];
        $hn = @$case->hn ?? @$case->case_hn;
        $datetime   = date('YmdHis');
        if(!empty($folderdate)){
            $pdf_data = Mongo::table('tb_temppdf')->where('id', 1)->first();
            if(empty($pdf_data)){
                $i['id'] = 1;
                Mongo::table('tb_temppdf')->insert($i);
            }
            $u['folderdate'] = $folderdate;
            $u['hn'] = $hn;
            $u['datetime'] = $datetime;
            Mongo::table('tb_temppdf')->where('id', 1)->update($u);
        }
        return "store/$hn/$folderdate/pdf/nurse_$hn"."_$datetime.pdf";
    }

    public function create(){
        //temp
        $view['casedata']   = Datacase::first("64450ea99259bf6dbe091911");
        $view['hospital']   = get_hospital();
        $view['note']       = Mongo::table('tb_casenote')->where('_id',$view['casedata']->noteid)->first();
        $view['patient']    = Mongo::table('tb_patient')->where('hn',$view['casedata']->hn)->first();


        $pdf = Pdf::loadView('endoindex.pdfnurse.start',$view);
        // return $pdf->stream();
        // return view('endoindex.pdfnurse.start',$view);
        return view('endoindex.nursereport',$view);

    }


    public function export_pdf($r){

        if(isset($r['doctor'])){
            $w[] = array('case_physicians01', $r['doctor']);
        }


        if(isset($r['modality'])){

        }

        if(isset($r['date_from']) && isset($r['date_to'])){
            $w[] = array('appointment', '>=', $r['date_from']);
            $w[] = array('appointment', '<=', $r['date_to']);
        }

        if(isset($r['procedure'])){
            if(strpos($r['procedure'], '.')){
                $exp = explode('.', $r['procedure']);
                $procedure = array_values(array_filter($exp));
            }

            // dd($w, $procedure);

            // whereIn - if no a''
            $data = Mongo::table('tb_case')
                    ->where($w)
                    ->whereIn('case_procedurecode', $procedure)
                    ->get();
        } else {
            $data = Mongo::table('tb_case')
                    ->where($w)
                    ->get();
        }


        return $data;
    }


    public function edit($id)
    {
        $r = [
            "event" => "export_csv",
            "date_from" => "2023-03-15",
            "date_to" => "2023-04-30",
            "modality" => "ES",
            "doctor" => "91",
            "procedure" => "gi001."
        ];
        if($id == 'excel'){
            $view['case'] = $this->export_pdf($r);
            $view['filename'] = 'test';
            return view('endo.excelindex01', $view);
        }

        $view['casedata']   = Datacase::first($id);
        $view['hospital']   = get_hospital();
        $view['case']       = Mongo::table('tb_case')->where('_id',$id)->first();
        $view['note']       = Mongo::table('tb_casenote')->where('_id',$view['case']['noteid'])->first();
        $view['patient']    = Mongo::table('tb_patient')->where('hn',$view['case']['hn'])->first();

        if(isset($view['note']['history1']['user'])){
            $view['his1_user'] = Mongo::table('users')->where('uid',$view['note']['history1']['user'])->first();
        }else{
            $view['his1_user'] = null;
        }
        if(isset($view['note']['history2']['user'])){
            $view['his2_user'] = Mongo::table('users')->where('uid',$view['note']['history2']['user'])->first();
        }else{
            $view['his2_user'] = null;
        }
        $view['blade']      = "nurse_p1";
        if($id=='1'){
            $view['blade']  = "nurse_p1";
        }elseif($id=='2'){
            $view['blade']  = "nurse_p2";
        }elseif($id=='3'){
            $view['blade']  = "follow_up";
        }


        $view['data'] = $view;
        $pdf = Pdf::loadView('endoindex.pdfnurse.follow_up',$view);
        return $pdf->stream();

    }

}
