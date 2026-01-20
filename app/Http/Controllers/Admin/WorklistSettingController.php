<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mongo;
use App\Models\Server;


class WorklistSettingController extends Controller
{

    public function index(Request $r)
    {
        $w[0] = array('text_find', '!=', '');
        if(isset($r->search)){
            $view['filter']['text'] = @$r->search_text."";
            $view['filter']['procedure'] = @$r->search_procedure."";
            $view['filter']['department']   = @$r->search_department."";
            if(isset($r->search_text)){
                $w[] = array('text_find', 'like', '%'.$r->search_text."".'%');
            }
            if(isset($r->search_procedure)){
                $w[] = array('text_match', 'like', '%'.$r->search_procedure."".'%');
            }
        } else {
            $view['filter'] = [];
        }
        $view['wk_findtext'] = Server::table('tb_worklistfindtext')->where($w)->limit(100)->get();
        $view['procedures']  = Mongo::table('tb_procedure')->get();
        $view['department']  = Mongo::table('tb_department')->get();
        // dd($view);
        // dd($view, $r->all(), $w);
        return view('admin.worklist.index', $view);
    }

    public function edit($id)
    {
    }

    public function store(Request $r){
        if (isset($r->event)) {
            $event = $r->event;
            return $this->$event($r);
        }
    }

    public function add_worklist_findtext($r){
        $row = isset($r->total_row) ? $r->total_row : 0;
        for ($i=0; $i < $row; $i++) {
            $text_find = @$r->input("text$i");
            $text_match = @$r->input("procedure$i");
            $text_department = @$r->input("department$i");
            $u['text_find'] = $text_find;
            $u['text_match'] = $text_match;
            $u['text_department'] = $text_department;
            try {
                Server::table('tb_worklistfindtext')->insert($u);
            } catch (\Exception $e) {}
        }
        return redirect()->back();
    }

    public function update_textfind($r){
        $this->match_procedure();
        return redirect()->back();
    }

    function match_procedure(){
        $w[0] = array('proceduredescription', '!=', '');
        $tb_caseworklist = Mongo::table('tb_caseworklist')->where($w)->get();
        $tb_procedure    = Mongo::table('tb_procedure')->get();

        $match = [];
        foreach ($tb_caseworklist as $key => $val) {
            $val = (object) $val;
            $wk_proc = $val->proceduredescription;
            $txt_split = $this->custom_split($wk_proc);
            foreach ($txt_split as $t) {
                foreach ($tb_procedure as $k => $v) {
                    if($t == 'with' || $t == '-' || $t == 'UNKNOWN' || $t == '' || $t == '/' || $t == 'Change' || strlen($t) < 3){
                        continue;
                    }
                    $v = (object) $v;
                    $name = $v->name;
                    if (str_contains($name, $t) || str_contains($t, $name)){
                        $match[$t] = $name;
                        break;
                    }
                }
            }
        }

        foreach ($match as $proc_name => $proc_match) {
            $w[0] = array('text_find', $proc_name);
            $tb_worklistfindtext = Mongo::table('tb_worklistfindtext')->where($w)->first();
            if(!isset($tb_worklistfindtext)){
                $i['text_find'] = $proc_name;
                $i['text_match'] = $proc_match;
                Server::table('tb_worklistfindtext')->insert($i);
            }
        }
    }

    function custom_split($str) {
        if (preg_match('/\((.*?)\)/', $str, $matches)) {
            $insideParentheses = $matches[1];
            $str = str_replace('(' . $insideParentheses . ')', '', $str);
            $parts = explode(' ', trim($str));
            $parts[] = $insideParentheses;
            return $parts;
        } else {
            return explode(' ', $str);
        }
    }
}
