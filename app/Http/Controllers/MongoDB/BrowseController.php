<?php

namespace App\Http\Controllers\MongoDB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Department;
use App\Models\Mongo;
use Illuminate\Support\Facades\Session;

class BrowseController extends Controller
{
    public function index(Request $r){
        foreach (DB::connection('mongodb')->getMongoDB('endoindex')->listCollections() as $collection) {
            $data[]    = $collection['name'] ;
        }
        asort($data);
        $view['alltable'] = $data;
        return view('mongodb.home.index',$view);
    }

    public function show(Request $r, $id){
        $view['i']              = 0;
        $view['alltable']       = $this->alltable();
        // $view['table']          = (object) Mongo::table($id)->get();
        $paginate               = 15;
        $view['table']          = (object) Mongo::table($id)->paginate($paginate);
        $view['tableheader']    = $this->getHEAD($view['table']);
        $view['tablename']      = $id;
        $view['page']           = isset($r->page) ? $r->page : '1';
        $view['paginate']       = $paginate;

        $search = isset($r->search) ? true : false;
        if($search){
            $get_search         = Session::get('search');
            $to_search          = json_decode($get_search, true);
            $search_arr         = $this->search_data($to_search, $paginate);
            $view['table']      = isset($search_arr['table']) ? $search_arr['table'] : [];
            $view['key']        = isset($search_arr['key']) ?$search_arr['key'] : [];
            $view['search']     = 'search';
            $view['event']      = 'search_data';
        } else if($r->event=='clear_all'){
            return $this->clear_all($r);
        }

        return view('mongodb.browse.show',$view);
    }
    public function store(Request $r){
        if($r->event){
            if($r->event=='search_data')            {return $this->request_to_search_data($r);}
            if($r->event=='create_table')           {return $this->create_table($r);}
        }

        $id     = $r->id;
        $table  = $r->table;
        $column = $r->column;
        $value  = $r->text;

        $data[$column] = $value;
        Mongo::table($table)->where('_id',$id)->update($data);

        return redirect("mongodb/browse/$table");
    }

    public function request_to_search_data($r){
        $to_page = $r->tablename;
        Session::put('search', json_encode($r->all()));
        return redirect(url('mongodb')."/browse/$to_page?page=1&search=true");
    }

    public static function alltable(){
        foreach (DB::connection('mongodb')->getMongoDB('endoindex')->listCollections() as $collection) {
            $data[]    = $collection['name'] ;
        }
        asort($data);
        return $data;
    }

    public function create_table($r){
        $name = $r->table_name;
        $alltable = $this->alltable();
        if(!in_array($name, $alltable)){
            Mongo::create($name);
        }
        return redirect()->back();
    }

    public static function getHEAD($table){
        $val = array();
        foreach($table as $data){
            foreach ($data as $key => $value){
                $val[] = $key;
            }
        }
        $val = array_unique($val);
        return $val;
    }

    public function search_data($r, $paginate){
        $data     = [];
        $requests = isset($r) ? $r : [];
        $w        = [];
        $keys     = [];
        foreach ($requests as $key => $value) {
            $is_contain = str_contains($key, 'key_');
            if($is_contain && isset($value)){
                $new_key = str_replace('key_', '', $key);
                $keys[$new_key] = $value;

                if(is_numeric($value)){
                    $value = intval($value);
                }

                if(isset($value)){
                    if($new_key == '_id'){
                        $w[] = array('_id', $value);
                    } else if($new_key == 'eventsearch') {
                        $w[] = array('event', $value);
                    } else if(str_contains($new_key, 'id')){
                        $w[] = array($new_key, intval($value));
                    } else {
                        $w[] = array($new_key, 'LIKE','%'.$value.'%');
                    }
                    $search_key[$key] = $value;
                }
            }
        }

        if(isset($w)){
            $data    = Mongo::table($r['tablename'])->where($w)->paginate($paginate);
        } else {
            $data    = Mongo::table($r['tablename'])->paginate($paginate);
        }

        $view['table'] = $data;
        $view['page'] = 1;
        $view['key']  = $keys;
        return $view;
    }





}
