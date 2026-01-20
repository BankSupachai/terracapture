<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mongo;

class ImageController extends Controller
{
    public function store(Request $r){
        switch($r->event){
            case "img_reload": $this->img_reload($r);   break;
        }
    }

    public function img_reload($r){
        $cid        = $r->cid;
        $tb_case    = Mongo::table("tb_case")->where("_id",$cid)->first();
        $tb_case    = (object) $tb_case;
        $date       = isset($tb_case->appointment) ? $tb_case->appointment : $tb_case->case_dateappointment;
        $date       = str_contains($date, " ")     ? explode(" ", $date)[0] : $date;
        $hn         = isset($tb_case->hn)          ? $tb_case->hn : $tb_case->case_hn;
        $folderdate = $date;
        $dir        = htdocs("store/$hn/$folderdate");
        $files1     = scandir($dir);
        $x          = 0;
        $photo_new  = array();
        foreach ($files1 as $filename) {
            $f = explode("_", $filename);
            if ($f[0]==$cid) {
                if(strpos($filename, ".thu")==0){
                    $photo_new[$x]["nu"] = $x + 1;
                    $photo_new[$x]['ns'] = 0;
                    $photo_new[$x]["na"] = $filename;
                    $photo_new[$x]["sc"] = "";
                    $photo_new[$x]['st'] = 0;
                    $photo_new[$x]['tx'] = "";
                    $x++;
                }
            }
        }

        $data['photo'] = $photo_new;
        Mongo::table('tb_case')->where('_id', $cid)->update($data);
    }
}
