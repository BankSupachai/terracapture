<?php

namespace App\Http\Controllers\capture;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Mongo;
use App\Models\Note;
use App\Models\Datacase;

class CreatecaseController extends Controller
{
    public function __construct(Request $r){checklogin();}

    public function store(Request $r)
    {
        switch($r->event){
            case "createcase"       : return $this->createcase($r); break;
            case "createcasebook"   : return $this->createcasebook($r); break;

        }


    }


    public function createcase($r){



        $tb_casenote    = (object) Mongo::table("tb_casenote")->where('id', $r->noteid)->first();
        $b              = (object) Mongo::table("tb_booking")

        ->where('date', $r->date)
        ->where('hn',$r->hn)
        ->first();

        $b->procedure;

        if(isset($r->procedure)){
            $b->procedure = array_merge($b->procedure,$r->procedure);
        }

        // dd($b,$r);


        $note["historytaking02"]["data"] = $r->input();
        Mongo::table("tb_casenote")->where('id', $r->noteid)->update($note);
        foreach($b->procedure as $data){
            $expro = array("anes01","anes02","anes03","equ01","equ02","equ03",null);
            if(!in_array($data,$expro)){
                $val['noteid']              = $r->noteid;
                $val['caseuniq']            = date("ymdHis");
                $val['updatetime']          = date("ymdHis");
                $val['comcreate']           = getCONFIG('admin')->com_name;
                $val['case_procedurecode']  = $data;
                $val['case_hn']             = $tb_casenote->hn;
                $val['case_physicians01']   = $b->physician;
                $val['appointment']         = $b->date." 08:00";
                $val['appointment_date']    = $b->date;
                $val['statusjob']           = "holding";
                $val['case_status']         = 0;
                $val['case_room']           = 1;
                $val['case_roomsort']       = 0;
                $val['case_photo']          = array();
                $val['case_dateregister']   = date("Y-m-d H:i:s");
                $val['updatetime']          = date("ymdHis");

                $patient                    = (object) Mongo::table('tb_patient')->where('hn',$tb_casenote->hn)->first();
                $doctor                     = (object) Mongo::table('users')->where('uid',(int) $b->physician)->first();
                $procedure                  = (object) Mongo::table('tb_procedure')->where('code',$data)->first();
                $room                       = (object) Mongo::table('tb_room')->where('room_id',$val['case_room'])->first();
                if($room==null){$room_val   = "-";}else{$room_val = @$room->room_name."";}
                $val['patientname']         = $b->patient_name;
                $val['hn']                  = $tb_casenote->hn;
                $val['age']                 = age($patient->birthdate);
                $val['doctorname']          = $doctor->user_prefix.$doctor->user_firstname." ".$doctor->user_lastname;
                $val['procedurename']       = $procedure->name;
                $val['opd']                 = @$r->opd;
                $val['ward']                = @$r->ward;
                $val['typeofcase']          = @$r->typeofcase;
                $val['refer']               = @$r->refer;
                $val['department']          = uget("department");
                $val['user_in_case']        = @$r->user_in_case;
                $val['room']                = $room_val;
                $val['physicians02']        = @$r->doctor02;
                $val['physicians03']        = @$r->doctor03;
                $val['physicians04']        = null;
                $val['nurse01']             = @$r->nurse01;
                $val['nurse02']             = @$r->nurse02;
                $val['nurse03']             = @$r->nurse03;
                $val['nurse04']             = @$r->nurse04;
                $val['anes']                = @$r->anes;
                $val['prediagnostic_other'] = @$r->prediagnostic_other;
                $val['patient_id']          = @$r->patientid;
                $val['useropencase']        = uid();
                $val['righttotreatment']    = @$r->righttotreatment;
                $val['pdfcreate']           = false;

                $hospital                   = getCONFIG("hospital");
                $val['hospitalcode']        = $hospital->hospital_code;

                if($r->case_procedure==1){
                    if(getCONFIG('admin')->topical){
                        $arr = array("Topical");
                        $val['anesthesia'] =jsonEncode($arr);
                    }
                }
                $tb_case = Mongo::table("tb_case")
                ->where('noteid', $r->noteid)
                ->where('case_procedurecode', $data)
                ->first();

                if($tb_case==null){
                    $cid = (string) Mongo::table('tb_case')->insertGetId($val);
                    $case_id = get_last_id('case_id', 'tb_case') + 1;
                    Datacase::dataUPDATE($cid,['caseuniq'=>$cid,'case_id'=>$case_id]);

                    $case = Mongo::table('tb_case')->where('_id',$cid)->first();
                    unset($case['_id']);
                    Mongo::table("tb_cloudtemp")->insert($case);
                    createTEMP('tb_case',$cid,$val['comcreate'],$val['updatetime']);
                }

            }///////
        } //endforeach

        $val2['status'] = "createcase";
        Mongo::table("tb_booking")
        ->where('hn', $r->hn)
        ->where('date', $r->date)
        ->update($val2);


        // Mongo::table("tb_casemonitor")->where("monitor_hn",$val['hn'])->update(["monitor_timevisit"=>date("H:i")]);


        socketioTRIGGER('casemonitor');

        return redirect("casemonitor/control");
    }



    public function createcase_softcon($r){
        $feature = getCONFIG("feature");
        $val['physician_id']    = null;
        $val['physician_name']  = null;

        if(@$feature->softcon){
            $post['hn']     = $r->hn;
            $post["date"]   = $r->date;
            $post['event']  = "appointmentres";
            $res    = connectwebPOST(url("api/softcon"),$post);
            $json   = jsonDecode($res);
            $obj = $json[0];
            $val['userid'] = null;
            // dd($r->all(),$json,$obj);
            $val['treatment_coverage'] = @$obj->TreatmentCoverage;
            $hcode  = $obj->Physician_id??"abcdef"; //ใส่ abcdef เพื่อให้หาไม่เจอ
            $user   = Mongo::table("users")->where("hcode",$hcode)->first();
            if($user){
                $val['physician_id']    = $user['id'];
                $val['physician_name']  = fullname($user);

            }
        }

        // dd("ไม่ต้องทำงานนะจ๊ะ");

        return $val;
    }




    public function createcasebook($r){
        // dd($r->all());
        $temp = $this->createcase_softcon($r);
        $noteid = Note::hndate($r->hn,$r->date);
        $tb_casenote    = (object) Mongo::table("tb_casenote")->where('_id', $noteid->_id)->first();
        $b              = (object) Mongo::table("tb_booking")


        ->where('date', $r->date)
        ->where('hn',$r->hn)
        ->first();

        // dd($r->all() , $tb_casenote);
        if(isset($r->procedure)){
            $temparr0 = array();
            $temparr1 = array_unique(array_merge($b->procedure,$r->procedure));
            foreach($temparr1 as $t1){
                if(isset($t1)){
                    $temparr0[] = $t1;
                }
            }
             $b->procedure = $temparr0;
        }

        $note["historytaking02"]["data"] = $r->input();
        Mongo::table("tb_casenote")->where('_id', $r->noteid)->update($note);


        foreach($b->procedure as $data){
            $expro = array("anes01","anes02","anes03","equ01","equ02","equ03",null);
            if(!in_array($data,$expro)){
                $val['noteid']              = $r->noteid;
                $val['caseuniq']            = date("ymdHis");
                $val['updatetime']          = date("ymdHis");
                $val['comcreate']           = getCONFIG('admin')->com_name;
                $val['case_procedurecode']  = $data;
                $val['case_hn']             = $tb_casenote->hn;
                $val['case_physicians01']   = $temp['physician_id']??$b->physician;
                $val['appointment']         = $b->date." 08:00";
                $val['appointment_date']    = $b->date;
                $val['statusjob']           = "holding";
                $val['case_status']         = 0;
                $val['case_room']           = 1;
                $val['case_roomsort']       = 0;
                $val['case_photo']          = array();
                $val['case_dateregister']   = date("Y-m-d H:i:s");
                $patient                    = (object) Mongo::table('tb_patient')->where('hn',$tb_casenote->hn)->first();
                $doctor                     = (object) Mongo::table('users')->where('uid',(int) $b->physician)->first();
                $procedure                  = (object) Mongo::table('tb_procedure')->where('code',$data)->first();
                $room                       = (object) Mongo::table('tb_room')->where('room_id',$val['case_room'])->first();
                if($room==null){$room_val   = "-";}else{$room_val = @$room->room_name."";}
                $val['patientname']         = $b->patient_name;
                $val['hn']                  = $tb_casenote->hn;
                $val['age']                 = age($patient->birthdate);
                $val['doctorname']          = $temp['physician_name']??fullname($doctor);
                $val['procedurename']       = $procedure->name;
                $val['opd']                 = @$r->opd;
                $val['ward']                = @$r->ward;
                $val['typeofcase']          = @$r->typeofcase;
                $val['refer']               = @$r->refer;
                $val['department']          = uget("department");
                $val['user_in_case']        = @$r->user_in_case;
                $val['room']                = $room_val;
                $val['physicians02']        = @$r->doctor02;
                $val['physicians03']        = @$r->doctor03;
                $val['physicians04']        = null;
                $val['nurse01']             = @$r->nurse01;
                $val['nurse02']             = @$r->nurse02;
                $val['nurse03']             = @$r->nurse03;
                $val['nurse04']             = @$r->nurse04;
                $val['anes']                = @$r->anes;
                $val['prediagnostic_other'] = @$r->prediagnostic_other;
                $val['patient_id']          = @$r->patientid;
                $val['useropencase']        = uid();
                $val['treatment_coverage']  = $temp['TreatmentCoverage']??@$r->righttotreatment;
                $val['pdfcreate']           = false;
                $val['created_from']        = "booking";
                $hospital                   = getCONFIG("hospital");
                $val['hospitalcode']        = $hospital->hospital_code;
                $val['description']          = @$b->description;
                if($r->case_procedure==1){
                    if(getCONFIG('admin')->topical){
                        $arr = array("Topical");
                        $val['anesthesia'] =jsonEncode($arr);
                    }
                }
                $tb_case = Mongo::table("tb_case")
                ->where("case_hn",$b->hn)
                ->where("appointment_date",$b->date)
                ->where('case_procedurecode', $data)
                ->first();

                if($tb_case==null){
                    $cid = (string) Mongo::table('tb_case')->insertGetId($val);
                    $case_id = get_last_id('case_id', 'tb_case') + 1;
                    Datacase::dataUPDATE($cid,['caseuniq'=>$cid,'case_id'=>$case_id]);
                    $case = Mongo::table('tb_case')->where('_id',$cid)->first();
                    unset($case['_id']);
                    Mongo::table("tb_cloudtemp")->insert($case);
                    createTEMP('tb_case',$cid,$val['comcreate'],$val['updatetime']);
                }

            }///////
        } //endforeach

        $val2['status'] = "createcase";
        Mongo::table("tb_booking")
        ->where('hn', $r->hn)
        ->where('date', $r->date)
        ->update($val2);

        socketioTRIGGER('casemonitor');
        $booking = getCONFIG("booking");
        // dd($booking);
        if(@$booking->history_taking02){
            return redirect("book/casemonitor/show?hn=$r->hn&date=$r->date");
        }else{
            return redirect("casemonitor/control");
        }
    }



}
