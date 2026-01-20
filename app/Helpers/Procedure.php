<?php
use App\Models\Mongo;
use App\Models\tb_procedure;
use Illuminate\Support\Facades\DB;

function get_procedure_name($procedure_id){
    $name = '';
    if(isset($procedure_id)){
        $tb_procedure = tb_procedure::get_procedure_by_id($procedure_id);
        $name = ($tb_procedure!=null) ? $tb_procedure->procedure_name : '';
    }
    return $name;
}

function procedureCODE($code){
    $data = DB::table('tb_procedure')->where('procedure_code', $code)->first();
    return $data->procedure_name;
}

function getprocedure($code){
    $data = Mongo::table('tb_procedure')
    ->where('code', $code)
    ->orwhere('name','like',"%".$code."%")
    ->first();
    $data = (object) $data;
    $name = isset($data->name) ? $data->name : '';
    return $name;
}

function get_history1($note_id){
    $tb_casenote = Mongo::table('tb_casenote')->where('_id' , $note_id)->first();
    $tb_casenote = (object) $tb_casenote;
    $history1    = isset($tb_casenote->history1) ? $tb_casenote->history1 : [];

    $str     = '-';
    foreach ($history1 as $key=>$val) {
        if($key == 'provisional_other'){
            $str = $val;
        }
    }
    return $str;
}




function notecase($notehn){
    $data = Mongo::table('tb_casenote')->where('hn', $notehn)->first();
    $history ='';
    $data = (object) $data;
    // dd($data, $data->history1);
    if(isset($data->history1)){
        $h1 = (object) $data->history1;
        if(isset($h1->symptoms_ck_1)){
            $history = $history.$h1->symptoms_ck_1.' ';
        }
    } else {
        $history ='-';
    }
    return $history;
}

function count_case($status){
    $w[] = array('studydate','!=',0);
    if($status == 'pending'){
        $w[] = array('case_status', 0);
    } else if($status == 'completed'){
        $w[] = array('case_status', 2);
    } else if ($status == 'cancel'){
        $w[] = array('case_status', 1);
    }
    $case = DB::table('tb_case')
        ->join('patient','patient.hn','tb_case.case_hn')
        ->where($w)
        ->get();
    $num = isset($case) || $case != '' ?  $case->count() : 0;
    return $num;
}

function get_status_name($status_num){
    $text = '';
    if($status_num == 0){
        $text = 'Holding';
    } else if ($status_num == 1){
        $text = 'Operation';
    } else if ($status_num == 2){
        $text = 'Recovery';
    } else if ($status_num == 3){
        $text = 'Discharged';
    } else if ($status_num == 4){
        $text = 'Reporting';
    }
    return $text;
}



        function pleurotext($case, $headdata01, $nameId01, $Valuetext01)
        {
            $Valuetext01 = @$case->$nameId01;



        // </div>";
            $html = "<div class='row mb-2' style='align-items: center'>

                <div class='col-2'>$headdata01</div>
                <div class='col-4'>
                        <input type='text'
                        name='$nameId01'
                        class='form-control form-control-sm  savejson autotext'
                        autocomplete=''
                        id='$nameId01'
                        value='$Valuetext01'>
                    </div>

                </div>";
            return $html;
        }



function pleurobox($case, $Valuebox01, $nameId, $text)
{
    $box = box(@$case->$nameId);


    $html = " <div class='col-3'>
                    <div class='form-check mb-2'>
                        <input class='form-check-input savejson' $box
                         type='checkbox'
                         name='$nameId'
                         id='$nameId'
                         value='$Valuebox01'
                         >
                        <label class='form-check-label'
                        for='$nameId'>
                        $text
                        </label>
                    </div>
                </div>";
    return $html;
}

function check_in_array($arr, $key, $is_match=false){
    $is_in = false;
    if(isset($arr)){
        if(is_array($arr)){
            if(in_array($key, $arr)){
                $is_in = true;
            }

            if($is_match){
                foreach ($arr as $val) {
                    if($key == $val){
                        $is_in = true;
                    }
                }
            }
        }
    }
    return $is_in;
}

function check_is_str($val){
    $str = '';
    if(isset($val)){
        if(!is_array($val)){
            $str = $val;
        }
    }
    return $str;
}

function get_total_str($arr){
    $total_str = '';
    if(isset($arr)){
        if(is_array($arr)){
            foreach ($arr as $text) {
                $total_str = $total_str.$text."\n";
            }
        }
    }
    return $total_str;
}

function check_in_str($str_to_cut, $str_find, $full_str){
    $is_match = false;
    if(isset($full_str)){
        $replace_str = trim(str_replace($str_to_cut, '', $full_str));
        if($str_find == $replace_str){
            $is_match = true;
        }
    }
    return $is_match;
}

function get_medication_nursenote($case){
    $w[] = array('case_hn', @$case->case_hn);
    $w[] = array('appointment_date', @$case->appointment_date);
    $w[] = array('department', @$case->department);
    $w[] = array('case_status', '!=', '90');
    $all_cases = Mongo::table('tb_case')->where($w)->get();
    $medications = [];
    foreach (isset($all_cases)?$all_cases:[] as $in => $case) {
        $sub   = [];
        $case  = (object) $case;
        $procedurecode  = @$case->case_procedurecode;
        $w1[]           = array('code', $procedurecode);
        $procedure      = (object) Mongo::table('tb_procedure')->where($w1)->first();
        if(isset($procedure)){
            foreach ($case as $key => $val) {
                $sub[$key] = $val;
            }
            foreach ($procedure as $key => $val) {
                $sub[$key] = $val;
            }
            $medications[]  = $sub;
        }
        $w1 = [];
    }
    return $medications;
}

function get_medication($caseuniq){
    if(!isset($caseuniq)) {return [];}
    $w[] = array('caseuniq', @$caseuniq);
    $tb_medication = (object) Mongo::table('tb_casemedication')->where($w)->first();
    return isset($tb_medication) ? $tb_medication : [];
}


?>
