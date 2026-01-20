<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Mongo;

use App\Models\Datacase;

class RoleController extends Controller
{

    public function index()
    {
        return view('admin.role.index');
    }

    public function edit($id)
    {

        $view['id'] =   $id;
        $view['tb_role'] = Mongo::table('tb_role')->where('name',$id)->first();
        $view['role']   =  @$view['tb_role']['role'];
        // dd($view);
        return view('admin.role.edit',$view);

    }

    public function store(Request $r){
        if(isset($r->event)){
            if($r->event=='editrole') {return $this->editrole($r);}
        }
    }


    public function editrole($r){

        $role = Mongo::table('tb_role')->where('name',$r->type)->first();

        // dd($role);
        if($role == null){
            $val['name']    =   $r->type;
            $val['role']    =   $r->role;
            Mongo::table('tb_role')->insert($val);
        }else{
            $val['name']    =   $r->type;
            $val['role']    =   $r->role;
            Mongo::table('tb_role')->where('name',$r->type)->update($val);

        }
        return redirect('admin/role');

    }



}
