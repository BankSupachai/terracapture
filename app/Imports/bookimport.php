<?php

namespace App\Imports;

use App\Models\book;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class bookimport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if(isset($row['book_from'])){
            $arr["HN"]          = $row['hn'];
            $arr["PTNAME"]      = $row['prefix'].$row['firstname']." ".$row['lastname'];
            $arr['PT_PREFIX']   = $row['prefix'];
            $arr['PT_FIRSTNAME']= $row['firstname'];
            $arr['PT_LASTNAME'] = $row['lastname'];
            $arr["MALE"]        = $row['gender'];
            $arr["AGE"]         = $row['age'];
            $arr["PTTYPE"]      = "NO";
            $arr["PTTYPE_NAME"] = $row['righttotreatment'];
            $arr["OPERATION"]   = $row['book_title'];
            $arr["SURGEON"]     = $row['book_doctor'];
            $arr["DIAG"]        = $row['book_predignosis'];
            $arr["REQDATE"]     = $row['book_date_end']." 08:00:00";
            $arr["VIP"]         = null;
            $json = jsonEncode($arr);
            return new book([
                'book_appoint'      => $json,
                'book_from'         => $row['book_from']."",
                'book_user'         => $row['book_user']."",
                'book_branch'       => $row['book_branch']."",
                'book_doctorowner'  => $row['book_doctorowner']."",
                'book_doctoremail'  => "aaa",
                'book_doctor'       => $row['book_doctor']."",
                'book_procedure'    => $row['book_procedure']."",
                'book_room'         => $row['book_room']."",
                'book_predignosis'  => $row['book_predignosis']."",
                'book_comment'      => $row['book_comment']."",
                'book_date_start'   => str_replace("'","",$row['book_date_start'])." 08:00:00",
                'book_date_end'     => str_replace("'","",$row['book_date_end'])." 08:00:00",
                'book_title'        => $row['book_title']."",
                'book_topic'        => $row['book_topic']."",
            ]);
        }
    }
}
