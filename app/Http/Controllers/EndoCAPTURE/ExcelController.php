<?php


namespace App\Http\Controllers\Endocapture;
use App\Http\Controllers\Controller;

use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Support\Facades\DB;



class ExcelController extends Controller
{
    public function export()
    {
        $room       = DB::table('tb_room')->get();
		$collection = collect($room);
		return (new FastExcel($collection))->download('file.xlsx');
    }
}
