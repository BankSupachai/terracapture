<?php

namespace App\Http\Controllers\MongoDB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Department;
use App\Models\Mongo;
use Exception;

class RecordController extends Controller
{
    public function index(){

    }

    public function store(Request $r){
        if(isset($r->event)){
            if($r->event=='edit_record' || $r->event=='clone_record')          {return $this->edit_clone_record($r);}
        }
    }

    public function show(Request $r, $id){
        $action     = $r->event;
        $table_name = $r->table;
        $page       = isset($r->page) ? $r->page : '';
        switch ($action) {
            case $action=='edit' || $action=='clone':
                return $this->action_record($id, $table_name, $action, $page);
                break;
            case 'delete':
                $this->delete_record($id, $table_name);
                return redirect()->back();
                break;
        }
    }

    public function action_record($id, $table_name, $action, $page){
        $w[] = array('_id', $id);
        $view['record']     = (object) Mongo::table($table_name)->where($w)->first();
        $view['action']     = $action == 'edit' ? 'edit' : 'clone';
        $view['table_name'] = $table_name;
        $view['_id']        = $id;
        $view['page']       = $page;
        return view('mongodb.record.edit', $view);
    }

    public function edit_clone_record($r){
        $all_key  = $r->all();
        $action   = $r->action;
        $table    = $r->table_name;
        $_id      = $r->record_id;
        $skip_key = ['_token', '_method', 'event', 'record_id', '_id',  'table_name', 'action', 'num_more_field'];
        foreach ($all_key as $key => $value) {
            $each_type = $r->input($key."_type");
            if(in_array($key, $skip_key) || (strpos($key, '_type') && $each_type!='string') || strpos($key, '_key') || strpos($key, '_value')){
                continue;
            }

            if($each_type == 'array'){
                $value = json_decode($value, true);
            } else if($each_type == 'boolean'){
                $value = $value=='true' ? true : false;
            } else if ($each_type == 'integer'){
                $value = intval($value);
            }

            $new_arr[$key] = $value;
        }

        $num_add = $r->input('num_more_field');
        for ($i=0; $i < intval($num_add) ; $i++) {
            $add_key  = $r->input($i."_key");
            $add_val  = $r->input($i."_value");
            $add_type = $r->input($i.'_type');
            if($add_key != null && $add_key != ''){
                if($add_type == 'array'){
                    $add_val = json_decode($add_val, true);
                } else if($add_type == 'boolean') {
                    $add_val = ($add_val=='true') ? true : false;
                } else if ($add_type == 'integer'){
                    $add_val = intval($add_val);
                }
                $new_arr[$add_key] = $add_val;
            }
        }

        try{
            if($r->action == 'edit'){
                $w[] = array('_id', $_id);
                Mongo::table($r->table_name)->where($w)->update($new_arr);
            } else {
                Mongo::table($r->table_name)->insert($new_arr);
            }
        } catch (Exception $e){

        }

        if($action=='clone'){
            return redirect(url('')."/mongodb/browse/$table");
        } else {
            return redirect()->back();
        }

    }

    public function delete_record($id, $table_name){
        $w[] = array('_id', $id);
        Mongo::table($table_name)->where($w)->delete();
    }


}
