<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\TryCatch;
use PDF;
use Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Models\Mongo;


class ConvertController extends Controller
{

    public function index()
    {

    }


    public function create(){

    }

    public function store(Request $r){
        if($r->event=='get_accessory')  {$this->get_accessory($r);}
        if($r->event=='get_terra')      {$this->get_terra($r);}
        if($r->event=='get_terra_image'){$this->get_terra_image($r);}
    }

    public function get_accessory($r){
        $view['accessory'] = DB::table('accessory')->get();
        $data = view('test_box',$view)->render();       // แปลง .Blade และค่า เป็น text
        echo $data;
    }

    public function get_terra($r){

        $w[] = array('case_hn', 'like', $r->hn);
        $orw[] = array('hn', 'like', $r->hn);
        $tb_case = Mongo::table('tb_case')->where($w)->orWhere($orw)->orderBy('_id','DESC')->get();
        $view['tb_case'] = $this->statusholding($tb_case);
        // dd($view);

        $data = view('terra.wait.terra',$view)->render();       // แปลง .Blade และค่า เป็น text
        echo $data;
    }

    public function statusholding($tb_case){
        $arr = array();


            foreach($tb_case as $data){
                $data = (object) $data;
                $appointment = isset($data->appointment) ? $data->appointment : null;
                $date        = isset($appointment) ? explode(' ', $appointment)[0] : null;
                $case_hn     = isset($data->case_hn) ? $data->case_hn : $data->hn;

                if(isset($date)){
                    $arr[$date]['_id']               = $data->id;
                    $arr[$date]['hn']                = $case_hn;
                    $arr[$date]['patientname']       = @$data->patientname."";
                    $arr[$date]['physician']         = @$data->doctorname."";
                    $arr[$date]['procedure'][]       = @$data->procedurename."";
                    $arr[$date]['description']       = @$data->description."";
                    $arr[$date]['waitinglocation']   = @$data->waitinglocation."";
                    $arr[$date]['statusjob'][]       = @$data->statusjob."";
                    $arr[$date]['room']              = @$data->room."";
                    $arr[$date]['appointment']       = @$data->appointment."";
                    $arr[$date]['photo'][]           = @$data->photo;
                }


            }

        return $arr;
    }

    public function get_terra_image($r){
        $appointment = isset($r->appointment) ? explode(' ', $r->appointment)[0] : '';
        $hn          = strtolower($r->hn);
        $w[0]  = array('appointment', '!=', null);
        $check_null = Mongo::table('tb_case')->where($w)->get();
        $arr = [];
        if(isset($check_null)){
            foreach ($check_null as $ck) {
                $ck = (object) $ck;
                $ck_app = $ck->appointment;
                $ck_hn  = isset($ck->hn) ? strtolower($ck->hn) : strtolower($ck->case_hn);
                if(str_contains($ck_app, $appointment) && $hn == $ck_hn){
                    $arr[] = $ck;
                }
            }
        }

        $tb_case = $arr;
        $photo = [];
        if(isset($tb_case)){
            foreach($tb_case as $data){
                $data = (object) $data;
                $photos = isset($data->photo) ? $data->photo : [];
                foreach($photos as $p){
                    $photo[] = $p;
                }
            }
        }

        $exp = explode(' ', $r->appointment);
        $date = isset($exp[0]) ? $exp[0] : '';
        $view['img']         = $photo;
        $view['url']         = str_replace("endoindex", '', url(''));
        $view['appointment'] = $date;
        $view['hn']          = $r->hn;
        $view['data']        = "";
        $data = view('terra.wait.terra_img',$view)->render();       // แปลง .Blade และค่า เป็น text
        echo $data;
    }






}
