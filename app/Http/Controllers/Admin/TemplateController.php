<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Datacase;

class TemplateController extends Controller
{

    public function index(){
        return view('EndoCAPTURE.template_prepare.index');
    }


}
