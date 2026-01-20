<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HolidayController extends Controller
{
    public function __construct(Request $r){checklogin();}
    public function store(Request $r)
    {
        if(isset($r->holiday_day_off)){
            $count = count($r->holiday_day_off);
            for($i=0;$i<$count;$i++){
                $data['holiday_user_id']    = uid();
                $data['holiday_tittle']     = $r->holiday_tittle[$i];
                $data['holiday_detail']     = @$r->holiday_detail[$i];
                $data['holiday_day_off']    = $r->holiday_day_off[$i];
                $data['holiday_date_create']= Carbon::now()->format('Y-m-d H:i:s');
                DB::table('tb_holiday')->insert($data);
            }
        }
        if(isset($r->holiday_id_old)){
            $count_old = count($r->holiday_id_old);
            for($x=0;$x<$count_old;$x++){
                if(isset($r->holiday_ck_old[$r->holiday_id_old[$x]])){
                    $data_old['holiday_user_id']    = uid();
                    $data_old['holiday_tittle']     = $r->holiday_tittle_old[$r->holiday_id_old[$x]];
                    $data_old['holiday_detail']     = @$r->holiday_detail_old[$r->holiday_id_old[$x]];
                    $data_old['holiday_day_off']    = $r->holiday_day_off_old[$r->holiday_id_old[$x]];
                }else{
                    $data_old['holiday_status'] = 'delete';
                }
                DB::table('tb_holiday')->where('holiday_id',$r->holiday_id_old[$x])->update($data_old);

            }
        }
        return redirect()->back();
    }
}
