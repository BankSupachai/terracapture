<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Mongo;


class HospitalController extends Controller
{
    public function index(Request $r){
    }

    public function edit($id){
        $file_name = 'hospital';
        $view['id']       = $id;
        if(file_exists($_SERVER['DOCUMENT_ROOT']."/config/project/$file_name.txt")){
            $view['config']   = getCONFIG($file_name);
            $url              = str_replace('endoindex', '', url(''));
            $view['img_path'] = $url.'\\config\\'.@$view['config']->hospital_pic;
        }
        return view('admin.hospital.edit', $view);
    }

    public function store(Request $r){
        if(isset($r->event)){
            if($r->event=='edit_hospital_data')                    {return $this->edit_hospital_data($r);}
        }
    }

    public function edit_hospital_data($r){
        // dd($r->all());
        $file_name = 'hospital';
        if ($r->hasFile('file')) {
            $image              = $r->file('file');
            $name               = 'hospital_logo.' . $image->getClientOriginalExtension();
            $destinationPath    = htdocs('config');
            $image->move($destinationPath, $name);
            $val['hospital_pic']       = $name;
        }
        $val['hospital_name']       = $r->hospital_name;
        $val['hospital_name_eng']   = $r->hospital_name_eng . "";
        $val['hospital_address']    = $r->hospital_address . "";
        $val['hospital_address_eng']    = $r->hospital_address_eng . "";
        $val['hospital_tel']        = $r->hospital_tel . "";
        $val['hospital_email']      = $r->hospital_email . "";
        $val['hospital_color']      = $r->hospital_color . "";
        $val['hospital_code']      = $r->hospital_code . "";
       (array) Mongo::table('tb_config')->where('config_type',$file_name)->update($val);
        return redirect(url('admin/hospital/'.$r->id.'/edit'));
    }




}
