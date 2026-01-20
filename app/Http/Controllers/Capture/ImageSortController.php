<?php

namespace App\Http\Controllers\capture;
use App\Http\Controllers\Controller;

use DB;
use Illuminate\Http\Request;
use App\Models\Mongo;

class ImageSortController extends Controller
{

    // public function __construct()
    // {$this->middleware('auth');}
    public function __construct(Request $r){checklogin();}

    public function index(Request $r)
    {

        // $imgsort = array( "35_70_320801811034_20210420082750_528.png","35_70_320801811034_20210420084718_935.png", "35_70_320801811034_20210420082806_522.png", "35_53_2021_04_20_09_30_0_217798.jpg");
        // //$imgsort    = jsonDecode($r->imgsort);
        // $cid        = 35;


        // $tb_case    = DB::table('tb_case')->where('case_id',$cid)->first();
        // $picture        = (array) jsonDecode($tb_case->case_photo);
        // $arr = array();

        // $i=0;
        // foreach($picture as $photo){
        //     $arr[$i]['nu'] = $photo->nu;
        //     $arr[$i]['ns'] = $photo->ns;
        //     $arr[$i]['na'] = $photo->na;
        //     $arr[$i]['sc'] = $photo->sc;
        //     $arr[$i]['st'] = $photo->st;
        //     $arr[$i]['tx'] = $photo->tx;
        //     $e = 1;
        //     foreach($imgsort as $img){
        //         if($photo->na==$img){
        //             $arr[$i]['ns'] = $e;
        //         }
        //         $e++;
        //     }
        //     $i++;
        // }
        // $value['case_photo'] = jsonEncode($arr);
        // DB::table('tb_case')->where('case_id',$cid)->update($value);




    }

    public function show(Request $r,$id)
    {

        $view['cid'] = $id;
        $view["case"] = (object) Mongo::table('tb_case')->where('_id',$id)->first();
        $apppoint                   = explode(" ",$view['case']->appointment);
        $view['folderdate']          = $apppoint[0];
        if(isset($view["case"])){
            // $photo = jsonDecode($view["case"]->case_photo);
            $view['photo_select'] = photoSELECT($view['case']->photo);
        }else{
            $view['photo_select'] = '';
        }
        // dd($view);
        // return view('endocapture.imagesort.show',$view);
        return view('capture.imagesort.newshow',$view);



    }

    public function update(Request $r,$id)
    {
        $photo_have = array();
        $photo_none = array();

        $i = 0;


        if(isset($r['photo_id'])){

            foreach($r['photo_id'] as $val)
            {
                if($r['photo_select'][$i]!='0')
                {
                    $photo_have[$i]['id']=$val;
                    $photo_have[$i]['select']=$r['photo_select'][$i];
                }
                else
                {
                    $photo_none[$i]['id']=$val;
                    $photo_none[$i]['select']=$r['photo_select'][$i];
                }
                $i++;
            }

            $count = count($photo_have);

            foreach ($photo_none as $key => $value) {
                $count++;
                $photo_have[$key]['id']=$value['id'];
                $photo_have[$key]['select']=$count;
            }

            foreach ($photo_have as $key => $value) {
                Mongo::table('photo')->where('id','=',$value['id'])->update(['photo_num_select'=>$value['select']]);
            }

        }

        return redirect('procedure/'.$_POST['pid'].'?case_id='.$_POST['case_id']."#upphoto");
    }



    public function store(Request $r){
        if($r->event=="imagesort"){
            //$imgsort = array("35_70_320801811034_20210420084718_935.png", "35_70_320801811034_20210420082750_528.png", "35_70_320801811034_20210420082806_522.png", "35_53_2021_04_20_09_30_0_217798.jpg");
            $imgsort    = $r->imgsort;
            $cid        = $r->cid;


            $tb_case    = (object) Mongo::table('tb_case')->where('_id',$cid)->first();
            $picture    = $tb_case->photo;
            $arr = array();

            $i=0;
            foreach($picture as $photo){
                $photo = (object) $photo;
                $arr[$i]['nu'] = $photo->nu;
                $arr[$i]['ns'] = $photo->ns;
                $arr[$i]['na'] = $photo->na;
                $arr[$i]['sc'] = $photo->sc;
                $arr[$i]['st'] = $photo->st;
                $arr[$i]['tx'] = $photo->tx;
                $e = 1;
                foreach($imgsort as $img){
                    if($photo->na==$img){
                        $arr[$i]['ns'] = $e;
                    }
                    $e++;
                }
                $i++;
            }
            $value['photo'] = $arr;
            Mongo::table('tb_case')->where('_id',$cid)->update($value);
            echo "success";
        }
    }








}
