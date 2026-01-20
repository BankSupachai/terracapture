<?php

namespace App\Http\Controllers\Endocapture;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class HISconnectController extends Controller
{




    public function show($id, Request $r)
    {
        $view['id'] = $id;
        $head = configTYPE('pdf', 'pdf_folder_head');
        if ($id == "appoint") {
            return view("his.$head.appoint", $view);
        }
    }








    public function checkHN($j)
    {
        $val['hn']          = $j->HN;
        $exname             = explode(" ", $j->PTNAME);
        $val['firstname']   = current($exname);
        $val['lastname']    = end($exname);
        $year               = date('Y') - $j->AGE;
        $val['birthdate']   = $year . "-01-01";
        if ($j->MALE == "ชาย") {
            $gender = 1;
        } else {
            $gender = 2;
        }
        $val['gender']      = $gender;
        $patient = DB::table('patient')->where('hn', $j->HN)->first();
        if ($patient == null) {
            DB::table('patient')->insert($val);
        }
    }

    public function check_ptt($ptt)
    {
        $val = 0;
        if ($ptt == "ข้าราชการเบิกจ่ายตรง/บำนาญ") {
            $val = 0;
        }
        return $val;
    }








    public function store(Request $r)
    {

        $arr = array();
        foreach ($r->patient_operation as $oper) {
            sleep(1);

            $val['comcreate']           = getCONFIG('admin')->com_name;
            $val['caseuniq']            = date("ymdHis");
            $val['updatetime']          = date("ymdHis");
            $val['case_physicians01']   = $r->patient_surgeon;
            $val['case_hn']             = $j->HN;
            $val['case_dateregister']   = $r->date;
            $val['case_dateappointment'] = $r->date;
            $val['case_status']         = 0;
            $val['case_photo']          = '[]';
            $val['case_roomsort']       = 0;
            $this->checkHN($j);
            $str['hn']                  = $j->HN;
            $str['patientname']         = $j->PTNAME;
            $str['age']                 = $j->AGE;
            $str['doctorname']          = $doctorfull;
            $str['prediagnostic_other'] = $j->DIAG;
            $str['righttotreatment']    = $j->PTTYPE_NAME;
            $str['opd']                 = null;
            $str['ward']                = null;
            $str['refer']               = null;
            $str['room']                = null;
            $str['physicians02']        = null;
            $str['physicians03']        = null;
            $str['physicians04']        = null;
            $str['nurse01']             = null;
            $str['nurse02']             = null;
            $str['nurse03']             = null;
            $str['nurse04']             = null;
            $str['anes']                = null;
            $str['patient_id']          = null;
            $str['useropencase']        = uid();
            $tb_procedure               = DB::table('tb_procedure')->where('procedure_name', $oper)->first();
            $val['case_procedurecode']  = $tb_procedure->procedure_code;
            $str['procedurename']       = $tb_procedure->procedure_name;
            $val['case_json']           = jsonEncode($str);
            DB::table('tb_case')->insert($val);
            createTEMP('tb_case', $val['caseuniq'], getCONFIG('admin')->com_name, $val['updatetime']);

            $medi['comcreate']          = getCONFIG('admin')->com_name;
            $medi['caseuniq']           = $val['caseuniq'];
            $medi['updatetime']         = $val['updatetime'];
            $medi['medi_casejson']      = "[]";
            insertMEDICATION($medi);

            unset($val);
        }
        return redirect('home');
    }
}
