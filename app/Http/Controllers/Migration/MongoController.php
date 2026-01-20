<?php

namespace App\Http\Controllers\Migration;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Department;
use App\Models\Mongo;

class MongoController extends Controller
{

    public function index(){


        $arr[0]['name'] = "สิทธิข้าราชการ";
        $arr[0]['code'] = "001";
        $arr[1]['name'] = "สิทธิบัตรทอง";
        $arr[1]['code'] = "002";
        $arr[2]['name'] = "สิทธิประกันสังคม";
        $arr[2]['code'] = "003";
        $arr[3]['name'] = "สิทธิรัฐวิสาหกิจ และองค์กรคู่สัญญา";
        $arr[3]['code'] = "004";
        $arr[4]['name'] = "บัตรประกันสุขภาพ";
        $arr[4]['code'] = "005";
        $arr[5]['name'] = "ผู้ป่วยทั่วไป";
        $arr[5]['code'] = "006";

        printJSON($arr);


        return 0;

        $tb_department = Mongo::table("tb_department")->get();
        foreach($tb_department as $data){
            $data = (object) $data;
            $val["department_id"]           = $data->department_id;
            $val["department_name"]         = $data->department_name;
            $val["department_user"]         = jsonDecode($data->department_user);
            $val["department_procedure"]    = jsonDecode($data->department_procedure);
            $val["department_room"]         = jsonDecode($data->department_room);
            $val["department_scope"]        = jsonDecode($data->department_scope);
            $val["department_json"]         = jsonDecode($data->department_json);
            Mongo::table("tb_department")->insert($val);
            Mongo::table("tb_department")->where("_id", $data->id)->delete();
        }

        $tb_hisconnect = Mongo::table("tb_hisconnect")->get();
        foreach($tb_hisconnect as $data){
            $data = (object) $data;
            $val["his_id"]      = $data->his_id;
            $val["his_hn"]      = $data->his_hn;
            $val["his_date"]    = $data->his_date;
            $val["his_json"]    = $data->his_json;
            $val["his_status"]  = $data->his_status;
            Mongo::table("tb_hisconnect")->insert($val);
            Mongo::table("tb_hisconnect")->where("_id", $data->id)->delete();
        }

        $tb_logedit = Mongo::table("tb_logedit")->get();
        foreach($tb_logedit as $data){
            $data = (object) $data;
            $val["edit_id"]      = $data->edit_id;
            $val["edit_userid"]      = $data->edit_userid;
            $val["edit_event"]    = $data->edit_event;
            $val["edit_remark"]    = $data->edit_event;
            $val["edit_json"]    = $data->edit_json;
            $val["edit_status"]  = $data->edit_status;
            Mongo::table("tb_logedit")->insert($val);
            Mongo::table("tb_logedit")->where("_id", $data->id)->delete();
        }

        $tb_logindata = Mongo::table("tb_logindata")->get();
        foreach($tb_logindata as $data){
            $data = (object) $data;
            $val["logindata_id"]      = $data->logindata_id;
            $val["logindata_user_id"]      = $data->logindata_user_id;
            $val["logindata_login_time"]    = $data->logindata_login_time;
            $val["logindata_logout_time"]    = $data->logindata_logout_time;
            $val["logindata_status"]    = $data->logindata_status;

            Mongo::table("tb_logindata")->insert($val);
            Mongo::table("tb_logindata")->where("_id", $data->id)->delete();
        }


        $tb_procedure = Mongo::table("tb_procedure")->get();
        foreach($tb_procedure as $data){
            $data = (object) $data;
            $val["name"]        = $data->name;
            $val["img"]         = $data->img;
            $val["color"]       = $data->color;
            $val["case"]        = $data->case;
            $val["pdf"]         = $data->pdf;
            $val["gen_desc"]    = $data->gen_desc;
            $val["anesthesia"]  = $data->anesthesia;
            $val["anesthesis"]  = $data->anesthesis;
            $val["histopathology"]    = $data->histopathology;
            $val["icd9"]        = $data->icd9;
            $val["icd10"]       = $data->icd10;
            $val["mainpart"]    = $data->mainpart;
            Mongo::table("tb_procedure")->insert($val);
            Mongo::table("tb_procedure")->where("_id", $data->id)->delete();
        }

            $tb_queue = Mongo::table("tb_queue")->get();
            foreach($tb_queue as $data){
            $data = (object) $data;
            $val["q_id"]        = $data->q_id;
            $val["q_users"]     = $data->q_users;
            $val["q_department"]    = $data->q_department;
            $val["q_qrcode"]    = $data->q_qrcode;
            $val["q_type"]      = $data->q_type;
            $val["q_number"]    = $data->q_number;
            $val["q_hn"]        = $data->q_hn;
            $val["q_tel"]       = $data->q_tel;
            $val["q_datetime"]  = $data->q_datetime;
            $val["q_start"]     = $data->q_start;
            $val["q_call"]      = $data->q_call;
            $val["q_json"]      = $data->q_json;
            $val["q_status"]    = $data->q_status;
            $val["q_statustext"]  = $data->q_statustext;
            $val["q_skip"]      = $data->q_skip;
            Mongo::table("tb_queue")->insert($val);
            Mongo::table("tb_queue")->where("_id", $data->id)->delete();
        }

        $tb_queuetype = Mongo::table("tb_queuetype")->get();
        foreach($tb_queuetype as $data){
        $data = (object) $data;
        $val["qtype_id"]        = $data->qtype_id;
        $val["qtype_name"]      = $data->qtype_name;
        $val["qtype_textpatient"]    = $data->qtype_textpatient;
        $val["qtype_prefix"]    = $data->qtype_prefix;
        $val["qtype_code"]      = $data->qtype_code;
        $val["qtype_nextstep"]    = $data->qtype_nextstep;
        $val["qtype_operation"]        = $data->qtype_operation;
        $val["qtype_department"]       = $data->qtype_department;
        $val["qtype_html"]     = $data->qtype_html;
        $val["qtype_skip"]      = $data->qtype_skip;
        $val["qtype_link"]      = $data->qtype_link;
        $val["qtype_statustext"]    = $data->qtype_statustext;
        Mongo::table("tb_queuetype")->insert($val);
        Mongo::table("tb_queuetype")->where("_id", $data->id)->delete();
    }

    $tb_room = Mongo::table("tb_room")->get();
        foreach($tb_room as $data){
        $data = (object) $data;
        $val["room_id"]        = $data->room_id;
        $val["room_department"]     = $data->room_department;
        $val["room_type"]    = $data->room_type;
        $val["room_name"]    = $data->room_name;
        $val["room_storage"]      = $data->room_storage;
        $val["room_color"]    = $data->room_color;
        $val["room_ready"]        = $data->room_ready;
        $val["room_doctor"]       = $data->room_doctor;
        $val["room_nurse"]     = $data->room_nurse;
        $val["room_register"]      = $data->room_register;
        Mongo::table("tb_room")->insert($val);
        Mongo::table("tb_room")->where("_id", $data->id)->delete();
    }

    $tb_scope = Mongo::table("tb_scope")->get();
        foreach($tb_scope as $data){
        $data = (object) $data;
        $val["scope_id"]                = $data->scope_id;
        $val["scope_rfid"]              = $data->scope_rfid;
        $val["scope_name"]              = $data->scope_name;
        $val["scope_band"]              = $data->scope_band;
        $val["scope_model"]             = $data->scope_model;
        $val["scope_serial"]            = $data->scope_serial;
        $val["scope_installdate"]       = $data->scope_installdate;
        $val["scope_top"]               = $data->scope_top;
        $val["scope_bottom"]            = $data->scope_bottom;
        $val["scope_left"]              = $data->scope_left;
        $val["scope_right"]             = $data->scope_right;
        $val["scope_comment"]           = $data->scope_comment;
        $val["scope_status"]            = $data->scope_status;
        $val["scope_autocrop"]          = $data->scope_autocrop;
        $val["scope_type"]              = $data->scope_type;
        $val["scope_working_channel"]   = $data->scope_working_channel;
        $val["scope_distal_end_diameter"]        = $data->scope_distal_end_diameter;
        $val["scope_selling_price"]     = $data->scope_selling_price;
        $val["scope_warranty_year"]     = $data->scope_warranty_year;
        $val["scope_contract_warrantee_start"]    = $data->scope_contract_warrantee_start;
        $val["scope_contract_warrantee_end"]      = $data->scope_contract_warrantee_end;
        $val["scope_sale_name"]                   = $data->scope_sale_name;
        $val["scope_sale_tel"]                    = $data->scope_sale_tel;
        $val["scope_service_name"]                = $data->scope_service_name;
        Mongo::table("tb_scope")->insert($val);
        Mongo::table("tb_scope")->where("_id", $data->id)->delete();
    }


            $tb_scope_repair = Mongo::table("tb_scope_repair")->get();
            foreach($tb_scope_repair as $data){
            $data = (object) $data;
            $val["sr_id"]                           = $data->sr_id;
            $val["sr_scope_serial_number"]          = $data->sr_scope_serial_number;
            $val["sr_broken_date"]                  = $data->sr_broken_date;
            $val["sr_main_phenomenon_repair"]       = $data->sr_main_phenomenon_repair;
            $val["sr_repair_analyze"]               = $data->sr_repair_analyze;
            $val["sr_bringback_date"]               = $data->sr_bringback_date;
            $val["sr_repair_price"]                 = $data->sr_repair_price;
            $val["sr_return_date"]                  = $data->sr_return_date;
            $val["sr_repair_status"]                = $data->sr_repair_status;
            Mongo::table("tb_scope_repair")->insert($val);
            Mongo::table("tb_scope_repair")->where("_id", $data->id)->delete();
            }


        $tb_upload_dicom = Mongo::table("tb_upload_dicom")->get();
            foreach($tb_upload_dicom as $data){
            $data = (object) $data;
            $val["ud_id"]             = $data->ud_id;
            $val["ud_fname"]          = $data->ud_fname;
            $val["ud_hn"]             = $data->ud_hn;
            $val["ud_name"]           = $data->ud_name;
            $val["ud_dob"]            = $data->ud_dob;
            $val["ud_institute"]      = $data->ud_institute;
            $val["ud_status"]         = $data->ud_status;
            Mongo::table("tb_upload_dicom")->insert($val);
            Mongo::table("tb_upload_dicom")->where("_id", $data->id)->delete();
        }

        $tb_upload_other = Mongo::table("tb_upload_other")->get();
        foreach($tb_upload_other as $data){
        $data = (object) $data;
        $val["uo_id"]             = $data->uo_id;
        $val["uo_fname"]          = $data->uo_fname;
        $val["uo_hn"]             = $data->uo_hn;
        $val["uo_name"]           = $data->uo_name;
        $val["uo_dob"]            = $data->uo_dob;
        $val["uo_gender"]         = $data->uo_gender;
        $val["uo_studydate"]      = $data->uo_studydate;
        $val["uo_status"]         = $data->uo_status;
        Mongo::table("tb_upload_other")->insert($val);
        Mongo::table("tb_upload_other")->where("_id", $data->id)->delete();
    }

    $users = Mongo::table("users")->get();
        foreach($users as $data){
        $data = (object) $data;
        $val["id"]                = $data->id;
        $val["user_code"]              = $data->user_code;
        $val["user_type"]              = $data->user_type;
        $val["user_branch"]              = $data->user_branch;
        $val["practical"]             = $data->practical;
        $val["color"]            = $data->color;
        $val["name"]       = $data->name;
        $val["user_rfid"]               = $data->user_rfid;
        $val["user_prefix"]            = $data->user_prefix;
        $val["user_firstname"]              = $data->user_firstname;
        $val["user_lastname"]             = $data->user_lastname;
        $val["user_email"]           = $data->user_email;
        $val["user_config"]            = $data->user_config;
        $val["email"]          = $data->email;
        $val["phone"]              = $data->phone;
        $val["password"]   = $data->password;
        $val["remember_token"]        = $data->remember_token;
        $val["created_at"]     = $data->created_at;
        $val["updated_at"]     = $data->updated_at;
        $val["opencase"]    = $data->opencase;
        $val["procedure_json"]      = $data->procedure_json;
        Mongo::table("users")->insert($val);
        Mongo::table("users")->where("_id", $data->id)->delete();
    }
    }



}
