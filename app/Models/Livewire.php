<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Mongo;

class Livewire extends Model
{



    public static function get($data)
    {
        $new = $data->map(function ($info) {
            $info->id = (string) $info->id; // แปลง ObjectId เป็น string
            $info->_id = (string) @$info->_id; // แปลง ObjectId เป็น string
            return $info;
        });
        return $new;
    }


    public static function paginate($data)
    {

        $new = $data->getCollection()->map(function ($info) {
            $info->id = (string) $info->id; // แปลง ObjectId เป็น string
            return $info;
        });

        return new \Illuminate\Pagination\LengthAwarePaginator(
            $new,
            $data->total(),
            $data->perPage(),
            $data->currentPage(),
            [
                'path' => $data->path(),
                'pageName' => $data->getPageName()
            ]
        );

    }

    public static function first($data)
    {

        if(isset($data->id)){
            $data->id = (string) $data->id; // แปลง ObjectId เป็น string
        }
        return $data;
    }


}
