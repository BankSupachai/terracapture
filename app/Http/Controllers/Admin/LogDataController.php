<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mongo;
use App\Models\Server;
use Illuminate\Support\Facades\Session;

class LogDataController extends Controller
{
    // public function __construct(Request $r){checklogin();}

    private $paginate = 15;

    public function index(){

    }

    public function create(){

    }

    public function edit($id){

    }

    public function show(Request $r, $id){
        // if(Server::check_connection()){return redirect(url('servererror'));}

        $view['data'] = [];
        if(@$id."" != ""){
            $view['data'] = Mongo::table("tb_log$id")->paginate($this->paginate);
        }

        $search = isset($r->search) ? true : false;
        if($search){
            $get_search = Session::get('search');
            $to_search  = json_decode($get_search, true);
            $search_arr = $this->search_data($to_search);
            $view['data'] = isset($search_arr['data']) ? $search_arr['data'] : [];
            $view['searchkey'] = isset($search_arr['searchkey']) ?$search_arr['searchkey'] : [];
            $view['search']    = 'search';
        }

        $view['log_type']   = $id;
        $view['columnname'] = $this->getHEAD($view['data'], "tb_log$id");
        // $view['columnname'] = $id == 'photo' ? ['time'] : ['datetime'];
        $view['tablename']  = "tb_log$id";
        $view['page']       = isset($r->page) ? $r->page : '1';
        $view['paginate']   = $this->paginate;
        return view('admin.logdata.show', $view);
    }

    public function store(Request $r){
        if($r->event){
            if($r->event=='search_data')            {return $this->request_to_search_data($r);}
        }
    }

    public function getHEAD($table, $tablename){
        $val = array();
        $table = isset($table) && $table != [] ? $table : Mongo::table($tablename)->paginate($this->paginate);
        foreach($table as $data){
            foreach ($data as $key => $value){
                $val[] = $key;
            }
        }

        if(count($val) == 0){
            $val = ($tablename == 'tb_logphoto') ? ['time'] : ['datetime'];
        }
        return array_values(array_unique($val));
    }

    public function request_to_search_data($r){
        $to_page = str_replace('tb_log', '', $r->tablename);
        Session::put('search', json_encode($r->all()));
        return redirect(url('admin')."/log/$to_page?page=1&search=true");
    }

    public function search_data($r){
        if(isset($r)){
            $key_skip = ['_token', 'event', 'tablename'];
            $all_data = $r;
            $w        = array();
            $search_key = array();
            foreach ($all_data as $key => $data) {
                if(in_array($key, $key_skip)){
                    continue;
                }

                if(is_numeric($data)){
                    $data = intval($data);
                }

                if(isset($data)){
                    if($key == '_id'){
                        $w[] = array('_id', $data);
                    } else if($key == 'eventsearch') {
                        $w[] = array('event', $data);
                    } else if(str_contains($key, 'id')){
                        $w[] = array($key, intval($data));
                    } else {
                        $w[] = array($key, 'LIKE','%'.$data.'%');
                    }
                    $search_key[$key] = $data;
                }
            }


            $data =  Mongo::table($r['tablename'])->where($w)->paginate($this->paginate);

            $arr['data'] = $data;
            $arr['searchkey'] = $search_key;
        } else {
            $arr['data'] = Mongo::table($r['tablename'])->paginate($this->paginate);
            $arr['searchkey'] = null;
        }

        return $arr;
    }


}
