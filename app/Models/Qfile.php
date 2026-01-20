<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Mongo;


class Qfile extends Model
{
    use HasFactory;
    protected $table = 'tb_qfile';
    const UPDATED_AT = null;

    public static function getrow($num)
    {
        return Mongo::table("tb_qfile")->orderBy("_id", "desc")->limit($num)->get();
    }

    public static function insert($data)
    {
        Mongo::table("tb_qfile")->insert($data);
    }

    public static function change($id, $data)
    {
        Mongo::table("tb_qfile")->where("_id", $id)->update($data);
    }
}
