<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    // Resource methods: index, create, store, show, edit, update, destroy
    public function index(Request $r)
    {
        if(isset($r->event)) {
            $event = $r->event;
            return $this->$event($r);
        }
    }

    public function create()
    {
        return view('admin.patient.create');
    }

    public function store(Request $r)
    {
        return $r->all();
    }



}
