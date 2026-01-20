<?php

namespace App\Http\Controllers\Endocapture;

use App\Http\Controllers\Controller;

use App\Item;
use DB;
use Excel;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ExportEXCELL extends Controller
{


    public function downloadExcel(Request $r)
    {
        $data = DB::table('users')->get()->toArray();
        return Excel::download((new ExcelExport)->alldata($data), 'invoices.xlsx');
    }

    public function html(Request $r)
    {
        $view['tb_report']  = DB::table('tb_report')->paginate(3);
        return view('endo.excel', $view);
    }
}
