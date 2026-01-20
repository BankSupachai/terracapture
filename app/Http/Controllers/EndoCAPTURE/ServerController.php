<?php

namespace App\Http\Controllers\Endocapture;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Fileconfig;



class ServerController extends Controller
{

    public function index(Request $r)
    {
        $admin            = getCONFIG('admin');
        $emrdrive           = configTYPE("path","path_emr");
        $view['disk_store'] = $this->print_alldrives($emrdrive);
        $view['all_client'] = jsonDecode($admin->all_client);

        return view('endocapture.errorserver.status' ,$view);

    }

    public function create()
    {

    }

    public function store(Request $r)
    {
        if (isset($r->event)) {
            $event = $r->event;
            $this->$event($r);
        }
        // return view('endocapture.errorserver.status');

    }


    public function checkport($r){
        echo exec("D:\\allindex\\service\\portscanner.py $r->comname $r->port");
    }


    public function edit($id, Request $r)
    {

    }

    public function show(Request $r)
    {
    }

    public function update(Request $r, $id)
    {

    }

    public function print_alldrives($disk){
        $alphabet = str_split($disk);
        $i = 0;
        $arr = array();
        $GB = 1073741824;
        foreach($alphabet as $drive){
            try {
                if (!file_exists("$drive:")) throw new \Exception('This drive does not exist');
                $disk_total_space   = disk_total_space("$drive:");
                $disk_free_space    = disk_free_space("$drive:");
                $arr[$i]['drive']   = "$drive:\\";
                $arr[$i]['department'] = $this->departmentdrive($drive);
                $arr[$i]['total']   = number_format($disk_total_space/$GB,1);
                $arr[$i]['free']    = number_format($disk_free_space/$GB,1);
                $arr[$i]['used']    = number_format(($disk_total_space-$disk_free_space)/$GB,1);
                $arr[$i]['status']  = 'true';
            } catch (\Throwable $th) {
                $arr[$i]['drive']   = "$drive:\\";
                $arr[$i]['department'] = "";
                $arr[$i]['total']   = 0;
                $arr[$i]['free']    = 0;
                $arr[$i]['used']    = 0;
                $arr[$i]['status']  = 'false';
            }
            $i++;
        }
        $new_arr = [];
        foreach ($arr as $index => $disk_data) {
            $new_arr[] = $disk_data;
        }
        return $new_arr;
    }

    public function departmentdrive($drive){
        $name = '';
        if($drive=="W"){$name="GYNE";}
        if($drive=="X"){$name="OR";}
        if($drive=="Y"){$name="URO";}
        if($drive=="Z"){$name="GI";}
        return $name;
    }


}
