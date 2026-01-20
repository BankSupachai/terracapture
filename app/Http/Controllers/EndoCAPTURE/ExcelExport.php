<?php
namespace App\Http\Controllers\Endocapture;
use App\Http\Controllers\Controller;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ExcelExport implements FromView
{

    public function alldata($data)
    {
        $this->data = $data;
        return $this;
    }

    public function view(): View
    {
        $view['tb_report']  = DB::table('tb_report')->paginate(3);
        return view('endo.excel',$view);
    }
}
