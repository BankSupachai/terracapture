<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class OCRController extends Controller
{
    public function index()
    {
        return view('EndoCAPTURE.ocr.index');
    }
}
