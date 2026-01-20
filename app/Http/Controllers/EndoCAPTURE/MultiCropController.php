<?php

namespace App\Http\Controllers\Endocapture;
use App\Http\Controllers\Controller;
use App\Models\Datacase;
use Illuminate\Http\File;
use Illuminate\Support\Facades\DB;
use Image;
use Illuminate\Http\Request;

class MultiCropController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $r)
    {

    }

    public function show($id)
    {
        $case               = Datacase::fromID($id);
        $data['hn']         = isset($case->case_hn) ? $case->case_hn : '';
        $data['folderdate'] = isset($case->appointment_date) ? $case->appointment_date : explode(' ', $case->appointment)[0];
        $data['photos']     = isset($case->photo) ? $case->photo : []; 
        $data['cid']        = $id;
        $data['case']       = $case;
        // dd($data);
        return view('endocapture.multicrop.show', $data);
    }

    public function store(Request $r)
    {

    }

}
