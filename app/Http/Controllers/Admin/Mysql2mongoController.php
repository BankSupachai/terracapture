<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Mongo;

use App\Models\Datacase;
use Exception;

class Mysql2mongoController extends Controller
{

    public function index()
    {
        dd("mdfdkjfldsjf");
    }


    public function store(Request $r)
    {
        if (isset($r->event)) {
            $event  = $r->event;
            return $this->$event($r);
        }
    }

    public function show($id)
    {

        $table = DB::table($id)->get();
        // dd($table);
        if ($id == "users") {
            $this->users($table);
        }

        if ($id == "tb_scope") {
            $this->tb_scope($table);
        }
    }

    public function users($data)
    {
        foreach ($data as $key => $value) {
            $value = (array)$value;
            $val["id"]              = $value["id"];
            $val["user_department"] = array("GI");
            $val["user_status"]     = "active";
            $val["user_code"]       = @$value["user_code"];
            $val["user_type"]       = $value["user_type"];
            $val["user_branch"]     = "";
            $val["practical"]       = null;
            $val["color"]           = "#000000";
            $val["name"]            = "";
            $val["user_rfid"]       = "";
            $val["user_prefix"]     = $value["user_prefix"];
            $val["user_firstname"]  = $value["user_firstname"];
            $val["user_lastname"]   = $value["user_lastname"];
            $val["user_email"]      = $value["user_email"];
            $val["user_config"]     = array();
            $val["email"]           = $value["email"];
            $val["password"]        = '$2y$10$zEJJf214DWzquohrnkfzQuNAn/Tthbh7Pl8F9ioDyfMWljgAsSYJu';
            $val["remember_token"]  = @$value["remember_token"];
            $val["opencase"]        = 1;
            $val["created_at"]      = $value["created_at"];
            $val["updated_at"]      = $value["updated_at"];
            $val["department"]      = "GI";
            Mongo::table("users")->insert($val);
        }
    }

    public function tb_scope($table)
    {
        foreach ($table as $key => $value) {
            # code...
            $val["scope_id"]                        = $value->scope_id;
            $val["scope_rfid"]                      = $value->scope_rfid;
            $val["scope_name"]                      = $value->scope_name;
            $val["scope_band"]                      = $value->scope_band;
            $val["scope_model"]                     = $value->scope_model;
            $val["scope_serial"]                    = $value->scope_serial;
            $val["scope_installdate"]               = $value->scope_installdate;
            $val["scope_top"]                       = $value->scope_top;
            $val["scope_bottom"]                    = $value->scope_bottom;
            $val["scope_left"]                      = $value->scope_left;
            $val["scope_right"]                     = $value->scope_right;
            $val["scope_comment"]                   = $value->scope_comment;
            $val["scope_status"]                    = $value->scope_status;
            $val["scope_status"]                    = "active";
            $val["scope_type"]                      = $value->scope_type;
            $val["scope_working_channel"]           = $value->scope_working_channel;
            $val["scope_distal_end_diameter"]       = $value->scope_distal_end_diameter;
            $val["scope_selling_price"]             = $value->scope_selling_price;
            $val["scope_warranty_year"]             = $value->scope_warranty_year;
            $val["scope_contract_warrantee_start"]  = $value->scope_contract_warrantee_start;
            $val["scope_contract_warrantee_end"]    = $value->scope_contract_warrantee_end;
            $val["scope_sale_name"]                 = $value->scope_sale_name;
            $val["scope_sale_tel"]                  = $value->scope_sale_tel;
            $val["scope_service_name"]              = $value->scope_service_name;
            $val["scope_service_tel"]               = "";
            $val["scope_department"]                = "GI";
            Mongo::table("tb_scope")->insert($val);
        }







        // dd($table);
    }
}
