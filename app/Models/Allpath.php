<?php

namespace App\Models;

class Allpath
{
    public static function vdodir($case)
    {
        // ตรวจสอบว่า case มี appointment หรือ appointment_date
        $datetime = isset($case->appointment) ? $case->appointment : $case->appointment_date;
        $exp = explode(' ', $datetime);
        $folderdate = $exp[0];

        // สร้าง path สำหรับไฟล์วิดีโอ
        $hn = $case->case_hn;
        return "d:/laragon/htdocs/store/$hn/$folderdate/vdo";
    }

    public static function vdourl($case)
    {

    }
}
