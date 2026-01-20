<?php

namespace App\Http\Controllers\capture;
use App\Http\Controllers\Controller;
use Illuminate\Http\File;
use Illuminate\Support\Facades\DB;
use Image;
use Illuminate\Http\Request;

class CropController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function __construct(Request $r){checklogin();}

    public function index(Request $r)
    {

        $data['folderdate'] = isset($r->folderdate) ? $r->folderdate : '';
        $data['allphoto']   = $this->get_allphoto_backup($r);
        $data['project_name'] = "capture";
        // dd($r->all());
        // $type = 'crop';

        if($r->type == 'crop'){
            return view('capture.drawing.crop', $data);
        } else {
            // return view('endocapture.drawing.index_ori2', $data);
            return view('capture.drawing.index', $data);
        }

        // return view('endocapture.drawing.index', $data);
        return view('capture.crop.cropphoto', $data);

        // return view('endocapture.crop.newcrop');
        // return view('endocapture.crop.index');
    }

    public function get_allphoto_backup($r){
        $allphoto = [];
        if(isset($r->hn) && isset($r->folderdate)){
            $dir         = exfolder("store");
            $appointment = isset($r->folderdate) ? $r->folderdate : '';
            $dir         = "$dir/$r->hn/$appointment/backup";
            $skip        = ['.', '..'];

            if (!file_exists($dir)) {
                mkdir($dir, 0777, true);
            }

            $files       = scandir($dir);
            foreach ($files as $file) {
                if(!in_array($file, $skip) && str_contains($file, '_')){
                    if(explode('_', $file)[0] == $r->cid){
                        $allphoto[] = $file;
                    }
                }
            }
        }
        return $allphoto;
    }

    public function store(Request $r)
    {
        // dd($r->all());
        if($r->event=="crop_all"){
            $tb_case = DB::table('tb_case')->where('case_id',$r->cid)->first();
            $json = jsonDecode($tb_case->case_photo);
            foreach($json as $j){
                if($j->ns!=0){
                    $img = Image::make(exfolder("store/$r->hn/$r->folderdate/$j->na"));
                    $img->crop( $r->w, $r->h,$r->x, $r->y);
                    $img->save(exfolder("store/$r->hn/$r->folderdate/$j->na"));
                }
            }
        }

        if($r->event=="crop_single"){
            // $img = Image::make(exfolder("store/$r->hn/$r->folderdate/$r->photoname"));
            // $img->crop( $r->w, $r->h,$r->x, $r->y);
            // $img->save(exfolder("store/$r->hn/$r->folderdate/$r->photoname"));
            $path = exfolder("store/$r->hn/$r->folderdate/$r->photoname");
            $image_data = $r->photodata;
            Image::make(file_get_contents($image_data))->save($path);
            return redirect(url('procedure')."/$r->cid");
        }
    }

}
