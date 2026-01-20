<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Mongo;
use App\Models\Datetime;
use Exception;
use App\Models\Department;
class Luminacreate extends Component
{
    public function render()
    {
        $view['scope_type']         = get_config_scope();
        if(isset($view['scope_type'])){
            if($view['scope_type']=='true'){
                $this_case = $this->get_user_config();
                $view['patientname'] = isset($this_case->patientname) ? $this_case->patientname : '';
                $view['doctorname']  = isset($this_case->doctorname) ? $this_case->doctorname : '';
                $view['procedurename']  = isset($this_case->procedurename) ? $this_case->procedurename : '';
                $view['case_age']       = isset($this_case->age) ? $this_case->age : '';
                $view['appointment']    = isset($this_case->appointment) ? $this_case->appointment : '';
                $view['case_hn']        = isset($this_case->hn) ? $this_case->hn : '';
                $view['case_id']        = isset($this_case->cid) ? $this_case->cid : '';
                $view['caseuniq']       = isset($this_case->caseuniq) ? $this_case->caseuniq : '';
                $view['open']           = isset($this_case->open) ? $this_case->open : '';
            }
        }
        $view['doctor']             = Department::userActive('doctor');
        $view['month_all']          = Datetime::monthALL();
        $view['day_all']            = Datetime::dayALL();
        $view['year_all']           = Datetime::yearALL(120);
        $view['tb_procedure']       =  (object) Mongo::table('tb_procedure')->get();
        $view['config_lumina']      = $this->get_user_config();
        $view['procedurecode']      = $this->get_procedurecode(@$view['config_lumina']->procedurename."");
        return view('livewire.lumina-create' , $view);
    }


    public function get_procedurecode($procedurename){
        $w[] = array('name',  'like', $procedurename);
        $tb_procedure = Mongo::table('tb_procedure')->where($w)->first();
        $code = '';
        if($procedurename!=''){
            if(isset($tb_procedure)){
                $tb_procedure = (object) $tb_procedure;
                $code = isset($tb_procedure->code) ? $tb_procedure->code : '';
            }
        }
        return $code;
    }

    public function get_user_config(){
        $tb_lumina = [];
        try{
            $tb_lumina = Mongo::table('tb_lumina')->first();
        } catch(Exception $e){}
        return (object) $tb_lumina;
    }
}
