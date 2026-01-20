<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Mongo;
use Illuminate\Http\Request;
use MongoDB\BSON\ObjectId;
use PDO;

class CaseSettingController extends Controller
{
    
    public function index(Request $r)
    {

        $view['cases'] = $this->statusall($r);
        if(isset($r->search)){
            $view['filter'] = $r->search_name;
        } else {
            $view['filter'] = '';
        }
        return view('admin.case.index', $view);
    }

    public function statusall($r){
        $w[]        = array('statusjob', '!=', 'delete');
        $w[]        = array('statusjob', '!=', 'cancel');

        $sub  = [];
        if(isset($r->search_name)){
            // case_hn
            $w[] = array('case_hn', 'like','%'.$r->search_name.'%');
            $sub = $this->get_case($w, $sub, 'tb_case');
            array_pop($w);
            // patientname
            $w[] = array('patientname', 'like','%'.$r->search_name.'%');
            $sub = $this->get_case($w, $sub, 'tb_case');
            array_pop($w);
            // doctorname
            $w[] = array('doctorname', 'like','%'.$r->search_name.'%');
            $sub = $this->get_case($w, $sub, 'tb_case');
            array_pop($w);
            
            $sub = array_values(array_unique($sub));
            // $tb_case = Mongo::table('tb_case')->whereIn('caseuniq', $sub)->orderBy('_id','DESC')->get();
            // กรณีที่ caseuniq เป็น object จะไม่สามารถใช้ whereIn ได้
            $tb_case = [];
            foreach (isset($sub)?$sub:[] as $uniq) {
                $temp = Mongo::table('tb_case')->where('caseuniq', $uniq)->orWhere('caseuniq', new ObjectId($uniq))->first();
                if(isset($temp)){
                    $tb_case[] = $temp;
                }
            }

            return $tb_case;
        }

        $tb_case    = Mongo::table('tb_case')->where($w)->orderBy('_id','DESC')->limit(100)->get();
        $arr        = isset($tb_case) ? $tb_case : [];
        return $arr;
    }

    public function get_delete($r){

        $sub  = [];
        if(isset($r->search_name)){
            // case_hn
            $w[] = array('case_hn', 'like','%'.$r->search_name.'%');
            $sub = $this->get_case($w, $sub, 'tb_casebackup');
            array_pop($w);
            // patientname
            $w[] = array('patientname', 'like','%'.$r->search_name.'%');
            $sub = $this->get_case($w, $sub, 'tb_casebackup');
            array_pop($w);
            // doctorname
            $w[] = array('doctorname', 'like','%'.$r->search_name.'%');
            $sub = $this->get_case($w, $sub, 'tb_casebackup');
            array_pop($w);

            $sub = array_values(array_unique($sub));
            // $tb_casebackup = Mongo::table('tb_casebackup')->whereIn('caseuniq', $sub)->orderBy('_id','DESC')->get();

            $tb_casebackup = [];
            foreach (isset($sub)?$sub:[] as $uniq) {
                $temp = Mongo::table('tb_casebackup')->where('caseuniq', $uniq)->orWhere('caseuniq', new ObjectId($uniq))->first();
                if(isset($temp)){
                    $tb_casebackup[] = $temp;
                }
            }

            return $tb_casebackup;
        }

        $tb_casebackup = Mongo::table('tb_casebackup')->get();
        return isset($tb_casebackup) ? $tb_casebackup : [];
    }

    function get_case($w, $sub, $tb_name){
        $tb_case    = Mongo::table($tb_name)->where($w)->orderBy('_id','DESC')->get();
        foreach (isset($tb_case)?$tb_case:[] as $case) {
            $case = (object) $case;
            if(isset($case->caseuniq)){
                $sub[] = strval($case->caseuniq);
            }
        }
        return $sub;
    }

    public function create()
    {
        //
    }

    public function store(Request $r)
    {
        if(isset($r->event)){
            if($r->event=="delete_cases")            {return $this->delete_cases($r);}
            if($r->event=="rollback_cases")          {return $this->rollback_cases($r);}
        }
    }

    public function delete_cases($r){
        if(isset($r->delete_ck)){
            $count = is_array($r->delete_ck) ? count($r->delete_ck) : 0 ;
            if($count == 0){
                return;
            } else {
                foreach (isset($r->delete_ck)?$r->delete_ck:[] as $data) {
                    $w[] = array('caseuniq', $data);
                    $orw[] = array('caseuniq', new ObjectId($data));
                    $tb_casetemp = Mongo::table('tb_case')->where($w)->orWhere($orw)->project(['_id' => 0])->first();
                    $tb_casemedicationtemp = Mongo::table('tb_casemedication')->where($w)->orWhere($orw)->project(['_id' => 0])->first();
                    if(isset($tb_casetemp)){
                        Mongo::table('tb_casebackup')->insert($tb_casetemp);
                        $check_insert = Mongo::table('tb_casebackup')->where($w)->orWhere($orw)->first();
                        if(isset($check_insert)){
                            Mongo::table('tb_case')->where($w)->orWhere($orw)->delete();
                        }
                    }

                    if(isset($tb_casemedicationtemp)){
                        Mongo::table('tb_casebackup_medication')->insert($tb_casemedicationtemp);
                        $check_insert = Mongo::table('tb_casebackup_medication')->where($w)->orWhere($orw)->first();
                        if(isset($check_insert)){
                            Mongo::table('tb_casemedication')->where($w)->orWhere($orw)->delete();
                        }
                    }
                    $w = array();
                    $orw = array();
                }
            }
        }
        return redirect(url('admin/case'));
    }

    public function rollback_cases($r){
        if(isset($r->rollback_ck)){
            $count = is_array($r->rollback_ck) ? count($r->rollback_ck) : 0 ;
            if($count == 0){
                return;
            } else {
                foreach (isset($r->rollback_ck)?$r->rollback_ck:[] as $data) {
                    $w[] = array('caseuniq', $data);
                    $orw[] = array('caseuniq', new ObjectId($data));
                    $tb_casetemp = Mongo::table('tb_casebackup')->where($w)->orWhere($orw)->project(['_id' => 0, 'case_id'=> 0])->first();
                    $tb_casemedicationtemp = Mongo::table('tb_casebackup_medication')->where($w)->orWhere($orw)->project(['_id' => 0])->first();
                    if(isset($tb_casetemp)){
                        $tb_casetemp['case_id'] = get_last_id('case_id', 'tb_case') + 1;
                        $tb_casetemp['statusjob'] = 'holding';
                        $tb_casetemp['case_status'] = 0;
                        Mongo::table('tb_case')->insert($tb_casetemp);
                        $check_insert = Mongo::table('tb_case')->where($w)->orWhere($orw)->first();
                        if(isset($check_insert)){
                            Mongo::table('tb_casebackup')->where($w)->orWhere($orw)->delete();
                        }
                    }

                    if(isset($tb_casemedicationtemp)){
                        Mongo::table('tb_casemedication')->insert($tb_casemedicationtemp);
                        $check_insert = Mongo::table('tb_casemedication')->where($w)->orWhere($orw)->first();
                        if(isset($check_insert)){
                            Mongo::table('tb_casebackup_medication')->where($w)->orWhere($orw)->delete();
                        }
                    }
                    $w = array();
                    $orw = array();
                }
            }
        }
        return redirect(url('admin/case/rollback'));
    }

    public function show(Request $r, $id)
    {
        if($id == 'rollback'){
            $view['cases'] = $this->get_delete($r);
            return view('admin.case.rollback', $view);
        }
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
