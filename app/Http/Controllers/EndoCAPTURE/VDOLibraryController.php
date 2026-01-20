<?php

namespace App\Http\Controllers\Endocapture;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;



class VDOLibraryController extends Controller
{

    public function index(Request $r)
    {
        $this->createVDOGROUP();
        $view['tb_casevdogroup']    = DB::table('tb_casevdogroup')
        ->join('users','users.id','tb_casevdogroup.vdogroup_user')
        ->orderby('vdogroup_id','desc')
        ->get();

        $view['most']               = DB::table('tb_casevdogroup')
        ->join('users','users.id','tb_casevdogroup.vdogroup_user')
        ->orderby('vdogroup_visit','desc')
        ->get();
        return view('endolibrary.library.index',$view);
    }

    public function store(Request $r){
        if(isset($r->event)){
            if($r->event=="updategroupvdo"){$this->updategroupvdo($r);return redirect("library/0/edit");}
        }
    }

    public function show($id,Request $r){
        $view['id'] = $id;
        $view['mmmm'] = "";
        $w[0] = array('vdogroup_id',$id);
        DB::table('tb_casevdogroup')->where($w)->increment('vdogroup_visit');

        $view['group'] = DB::table('tb_casevdogroup')
        ->join('users','users.id','tb_casevdogroup.vdogroup_user')
        ->where($w)
        ->first();

        if(isset($r->vdoid)){
            $wh[0]          = array('vdo_id',$r->vdoid);
            $view['vdo']    = DB::table('tb_casevdo')->where($wh)->first();
        }else{
            $wh[0]          = array('caseuniq',$view['group']->caseuniq);
            $wh[1]          = array('comcreate',$view['group']->comcreate);
            $view['vdo']    = DB::table('tb_casevdo')->where($wh)->first();
        }

        $wh[0]          = array('caseuniq',$view['group']->caseuniq);
        $wh[1]          = array('comcreate',$view['group']->comcreate);
        $view['groupvdo'] = DB::table('tb_casevdo')
        ->where($wh)
        ->get();


        return view('endolibrary.library.show',$view);
    }



    public function updategroupvdo($r){
        $w[0] = array('vdogroup_id',$r->vdogroup_id);
        $val['vdogroup_name']           = $r->vdogroup_name."";
        $val['vdogroup_description']    = $r->vdogroup_description."";
        $val['vdogroup_status']         = $r->vdogroup_status;
        DB::table('tb_casevdogroup')->where($w)->update($val);
    }


    public function edit($id){
        $view['id']                 = $id;
        if(uget("user_type")=="endo"){
            $view['tb_casevdogroup']    = DB::table('tb_casevdogroup')->limit(200)->get();
        }else{
            $view['tb_casevdogroup']    = DB::table('tb_casevdogroup')->where('vdogroup_user',uid())->get();
        }
        $view['tb_casevdo']         = DB::table('tb_casevdo')->where('vdo_id',0)->get();
        $view['detailgroup']        = DB::table('tb_casevdogroup')->where('vdogroup_id',$id)->first();
        if($id!=0){
            $view['detailgroup'] = DB::table('tb_casevdogroup')->where('vdogroup_id',$id)->first();
            $w[0] = array('caseuniq',$view['detailgroup']->caseuniq);
            $w[1] = array('comcreate',$view['detailgroup']->comcreate);
            $view['tb_casevdo'] = DB::table('tb_casevdo')->where($w)->get();
        }
        return view('endolibrary.library.edit',$view);
    }



    public function createVDOGROUP(){

        $tb_casevdo = DB::table('tb_casevdo')
        ->select('caseuniq','comcreate')
        ->where('vdo_group',0)
        ->distinct()
        ->get();

        foreach($tb_casevdo as $data){
            $w[0] = array('caseuniq',$data->caseuniq);
            $w[1] = array('comcreate',$data->comcreate);
            $tb_casevdogroup = DB::table('tb_casevdogroup')->where($w)->first();
        try {
            if($tb_casevdogroup==null){
                $tb_case = DB::table('tb_case')->where($w)->first();
                $val['caseuniq']            = $data->caseuniq;
                $val['comcreate']           = $data->comcreate;
                $val['vdogroup_user']       = $tb_case->case_physicians01;
                $val['vdogroup_name']       = "";
                $val['vdogroup_description']= "";
                $val['vdogroup_visit']      = 0;
                $val['vdogroup_date']       = date('Y-m-d');
                $val['vdogroup_status']     = 0;
                DB::table('tb_casevdogroup')->insert($val);
            }

            $group['vdo_group'] = 1;
            $tb_casevdo = DB::table('tb_casevdo')->where($w)->update($group);
        } catch(\Throwable $e) {

        }
        }
    }





}



// Route::get('library',                   function () {return view('endolibrary.library.index');});
// Route::get('library_show',              function () {return view('endolibrary.library.show');});
// Route::get('library_history',           function () {return view('endolibrary.library.history');});
// Route::get('library_play',              function () {return view('endolibrary.library.play');});
// Route::get('library_favorite',          function () {return view('endolibrary.library.favorite');});
