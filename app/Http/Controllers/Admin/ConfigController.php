<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ConfigController extends Controller
{

    public function index()
    {
        // migrate configindex จาก config file
        $config_path = "D:\laragon\htdocs\config\project";
        $json_files  = File::files($config_path);
        foreach ($json_files as $file) {
            $tablename = str_replace('.txt', '', $file->getBasename('.json'));
            $jsonData = json_decode(File::get($file->getPathname()), true);
            if (is_array($jsonData)) {
                $check = Config::name($tablename)->get();
                if(count($check) == 0){
                    $i['tempid'] = 1;
                    Config::name($tablename)->insert($i);
                }
                foreach ($jsonData as $key=>$value) {
                    if($key == "0" || @$key."" == ""){
                        continue;
                    }
                    $u[$key] = $value;
                    Config::name($tablename)->where('tempid', 1)->update($u);
                    $u = array();
                }
            } 
        }
        echo "success";
    }


    public function store(Request $r)
    {

    }

    public function show($id)
    {

    }



}
