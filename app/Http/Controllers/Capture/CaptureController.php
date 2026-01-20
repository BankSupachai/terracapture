<?php

namespace App\Http\Controllers\Capture;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\casemedication;
use App\Models\Datacase;
use App\Models\Mongo;
use App\Models\User;
use App\Models\Patient;
use App\Models\Camera;
use App\Models\Livewire;

class CaptureController extends Controller
{
    public function __construct(Request $r)
    {
        checklogin();
    }

    public function index(Request $r)
    {
        $view['text'] = 'TEST CAMERA';
        $this->movetestphoto();
        controllerpath(__FILE__);
        return view('capture/camera/capturetest/capturefortest', $view);
    }

    public function show($id)
    {
        controllerpath(__FILE__);
        $view['cid'] = $id;
        if($id=="test"){
            return view('capture/camera/capturetest/capturefortest', $view);
        }else{
            return view('capture/camera/obs/01obs', $view);
        }
    }

    public function edit($id)
    {
        $view['cid'] = $id;
        return view('capture.camera.edit', $view);
    }

    public function delete_user_in_case($id, $idhtml, $value)
    {
        $w[] = array('id', $id);
        $tb_case = Mongo::table('tb_case')->where($w)->first();
        $tb_case = (object) $tb_case;
        $user_in_case = isset($tb_case->user_in_case) ? $tb_case->user_in_case : [];
        if (in_array(intval($value), $user_in_case)) {
            $index = array_search(intval($value), $user_in_case);
            unset($user_in_case[$index]);
        }
        $data['user_in_case'] = $user_in_case;
        Mongo::table('tb_case')->where($w)->update($data);
    }




    public function delete($id)
    {
        dd($id);
    }

    public function finish_record($r){
        // dd($r->all());
        // $cid = $r->cid;
        // dd($cid);
        return redirect(url("loadpic/$r->cid"));
    }



}
