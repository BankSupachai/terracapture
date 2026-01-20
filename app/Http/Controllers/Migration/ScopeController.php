<?php

namespace App\Http\Controllers\Migration;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


use App\Models\Department;
use App\Models\Mongo;

class ScopeController extends Controller
{

    public function index(){
        $scope_id = array();
        $tb_scope = DB::table('tb_scope')->get();
        foreach ($tb_scope as $data) {
            $scope_id[] = $data->scope_id;


            $val["scope_id"]                                                                  = $data->scope_id;
            $val["scope_rfid"]                                                                = $data->scope_rfid;
            $val["scope_name"]                                                                = $data->scope_name;
            $val["scope_band"]                                                                = $data->scope_band;
            $val["scope_model"]                                                               = $data->scope_model;
            $val["scope_serial"]                                                              = $data->scope_serial;
            $val["scope_installdate"]                                                         = $data->scope_installdate;
            $val["scope_top"]                                                                 = $data->scope_top;
            $val["scope_bottom"]                                                              = $data->scope_bottom;
            $val["scope_left"]                                                                = $data->scope_left;
            $val["scope_right"]                                                               = $data->scope_right;
            $val["scope_comment"]                                                             = $data->scope_comment;
            $val["scope_status"]                                                              = $data->scope_status;
            $val["scope_autocrop"]                                                            = $data->scope_autocrop;
            $val["scope_type"]                                                                = $data->scope_type;
            $val["scope_working_channel"]                                                     = $data->scope_working_channel;
            $val["scope_distal_end_diameter"]                                                 = $data->scope_distal_end_diameter;
            $val["scope_selling_price"]                                                       = $data->scope_selling_price;
            $val["scope_warranty_year"]                                                       = $data->scope_warranty_year;
            $val["scope_contract_warrantee_start"]                                            = $data->scope_contract_warrantee_start;
            $val["scope_contract_warrantee_end"]                                              = $data->scope_contract_warrantee_end;
            $val["scope_sale_name"]                                                           = $data->scope_sale_name;
            $val["scope_sale_tel"]                                                            = $data->scope_sale_tel;
            $val["scope_service_name"]                                                        = $data->scope_service_name;
            $val["scope_department"]                                                          = array('GI');






            $newscope = Mongo::table("tb_scope")
            ->where('scope_id' , $data->scope_id)
            ->first();

            if($newscope){
                Mongo::table("tb_scope")
                ->where('scope_id' , $data->scope_id)
                ->update($val);
            }else{
                Mongo::table("tb_scope")->insert($val);
            }




            # code...
        }
        Mongo::table("tb_department")->where('department_name', 'GI')->update(['department_scope' => $scope_id]);

    }



    public function create(){
        $tb_scope = Mongo::table("tb_scope")->get();

        dd($tb_scope);
    }
}


