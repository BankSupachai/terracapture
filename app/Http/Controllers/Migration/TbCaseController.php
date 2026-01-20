<?php

namespace App\Http\Controllers\Migration;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Department;
use App\Models\Mongo;

class TbCaseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show($id){
        switch($id)
        {
            case "mysql2mongo" : $this->mysql2mongo();break;
            case "clear_data" : $this->clear_data();break;

        }
    }


    public function mysql2mongo()
    {

        $patient = DB::connection('mysql')->table('patient')
        ->where('patient_id', '>', 0)
        ->where('patient_id', '<', 1000)
        ->get();
        foreach($patient as $data){
            $val['firstname'] = $data->firstname;
            $val['lastname'] = $data->lastname;
            $val['gender'] = $data->gender;
            $val['prefix'] = $data->prefix;
            $val['nationality'] = $data->nationality;
            $val['birthdate'] = $data->birthdate;
            $val['hn'] = $data->hn;
            $val['phone'] = $data->phone;
            $val['regis_date'] = $data->regis_date;
            $val['regis_time'] = $data->regis_time;
            $val['email'] = $data->email;


            Mongo::table("tb_patient")->insert($val);
        }







        $tb_case = DB::connection('mysql')->table('tb_case')
        ->where('case_id', '>', 0)
        ->where('case_id', '<', 1000)
        ->where("case_json", "like" , "%indication%")
        ->orderBy("case_id" , "desc")
        ->get();
        dd($tb_case);
        foreach($tb_case as $data){
            try {
                $val["case_id"]             = $data->case_id;
                $val["modality"]            = @$data->modality;
                $val["studydate"]           = @$data->studydate;
                $val["seriesdate"]          = @$data->seriesdate;
                $val["studyuid"]            = @$data->studyuid;
                $val["seriesuid"]           = @$data->seriesuid;
                $val["dicomtag"]            = @$data->dicomtag;
                $val["dicomsr"]             = @$data->dicomsr;
                $val["caseuniq"]            = @$data->caseuniq;
                $val["updatetime"]          = @$data->updatetime;
                $val["comcreate"]           = @$data->comcreate;
                $val["case_hn"]             = @$data->case_hn;
                $val["case_dateregister"]   = @$data->case_dateregister;
                $val["case_procedure"]      = @$data->case_procedure;
                $val["case_procedurecode"]  = @$data->case_procedurecode;
                $val["appointment"]= @$data->case_dateappointment;
                $val["case_physicians01"]   = @$data->case_physicians01;
                $val["case_status"]         = @$data->case_status;
                $val["case_status_queue"]   = @$data->case_status_queue;
                $val                        = $this->json2field($val,$data->case_json);
                $val['appointment_date']     = date('Y/m/d', strtotime(@$data->case_dateappointment));
                $val["photo"]          = jsonDecode($data->case_photo);

                $val['noteid']              = @$data->caseuniq;
                $pdfcase = @$data->case_pdfversion;
                $pdfcase = jsonDecode($pdfcase);

                $val["case_pdfversion"]     =@$pdfcase;
                $val["case_room"]           =@$data->case_room;
                $val["case_roomsort"]       =@$data->case_roomsort;
                $val["ready_status"]        =@$data->ready_status;
                $val["ready_comment"]       =@$data->ready_comment;
                $val["case_vip"]            =@$data->case_vip;
                $val["case_semi"]           =@$data->case_semi;
                $val["case_booking"]        = @$data->case_booking;
                $val["anesthesia"]          = @$data->anesthesia;

                foreach($val as $key => $value) {
                    if($key === '' || $key === null) {
                        unset($val[$key]);
                    }
                }
                // dd($data->case_pdfversion);
                $blank = $data->case_id;
                // dd($blank);
                Mongo::table("tb_case")->insert($val);
            } catch (\Throwable $th) {
                // dd($blank, $val , $th);
            }

            // dd($val);
        }

    }


    public function clear_data()
    {

        $tb_case = Mongo::table("tb_case")->delete();
        $patient = Mongo::table("tb_patient")->delete();
    }

    public function json2field($val,$data)
    {
        $json = jsonDecode($data);
        foreach($json as $k1 => $v1)
        {
            $val[$k1]=$v1;
        }
        return $val;
    }


}
