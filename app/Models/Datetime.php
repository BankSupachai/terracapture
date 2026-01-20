<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Datetime extends Model
{
    use HasFactory;

    public static function monthALL()
    {
        $data = (object) ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
        return $data;
    }

    public static function dayALL()
    {
        $data = (object) ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12', '13', '14', '15', '16', '17', '18', '19', '20', '21', '22', '23', '24', '25', '26', '27', '28', '29', '30', '31'];
        return $data;
    }

    public static function weekALL()
    {
        $data = (object) ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
        return $data;
    }

    public static function yearALL($yearwant)
    {
        $data   = array();
        for ($i = intval(date('Y') + 543); $i >= intval(date('Y') + 543) - $yearwant; $i--) {
            array_push($data, $i);
        }
        $data = (object) $data;
        return $data;
    }

    public static function year_eng($yearwant)
    {
        $data   = array();
        for ($i = intval(date('Y')); $i >= intval(date('Y')) - $yearwant; $i--) {
            array_push($data, $i);
        }
        $data = (object) $data;
        return $data;
    }



    public static function dayADD($num)
    {
        $date = date("Y-m-d");
        $newdate = strtotime("+$num day", strtotime($date));
        return date('Y-m-d', $newdate);
    }

    public static function timeuse($cid)
    {
        $tb_case = Mongo::table('tb_case')->where('_id', $cid)->first();
        $time_start = $tb_case['time_start'];
        $time_end = $tb_case['time_end'];
        $timeuse = strtotime($time_end) - strtotime($time_start);
        $minutes = floor($timeuse / 60);
        $val['timeuse'] = $minutes;
        Mongo::table('tb_case')->where('_id', $cid)->update($val);
    }


}
