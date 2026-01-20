<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class connect extends Model
{
    use HasFactory;

    /**
     * ดึงค่าทั้งหมดจาก config/connection/connect.txt
     *
     * @param  use App\Models\connect;
     * @param  get จำเป็นต้องมี paramiter ชื่อไฟล์
     * @param  array  $ชื่อไฟล์
     * @return Json
     */
    public static function get($db)
    {
        $use = file_get_contents("D:/laragon/htdocs/config/connection/connect.txt");
        $connect = file_get_contents("D:/laragon/htdocs/config/connection/hospital/$use.txt");
        $json = json_decode($connect);
        if ($db != '') {
            return $json->$db;
        } else {
            return '';
        }
    }

    /**
     * ดึงค่าทั้งหมดจาก config/connection/connect.txt
     *
     * @param  get_all ไม่จำเป็นต้องมี paramiter
     * @param  array  $parameters
     * @return mixed
     */
    public static function get_all()
    {
        $use = file_get_contents("D:/laragon/htdocs/config/connection/connect.txt");
        $connect = file_get_contents("D:/laragon/htdocs/config/connection/hospital/$use.txt");
        return $connect;
    }
}
