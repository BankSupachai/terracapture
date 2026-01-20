<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SonyController extends Controller
{

    public function index(Request $r)
    {

        $view['mmm'] ="mmm";
        return view('endocapture.sony.index',$view);
    }


    public function store(Request $r)
    {
        if($r->event=="step01"){$this->step01($r);}
        if($r->event=="step02"){$this->step02($r);}
    }

    public function step01($r){
        $url = "http://$r->ip/api/token";
        $header[0]      = 'Content-Type:application/json';
        $header[1]      = 'Authorization: YWRtaW46YWRtaW4=';

        $arr['authorization']    = "YWRtaW46YWRtaW4=";
        $json           = jsonEncode($arr);
        $str            = connectwebJSON($url,$json,$header);
        echo $str;
    }

    public function step02($r){
        $url = "http://$r->ip/api/recorder/metadata";
        $header[0]      = 'Content-Type:application/json';
        $header[1]      = "Authorization: $r->token";




        $a1['id']       = 1;
        $a1['name']     = "CASE ID";
        $a1['value']    = $r->cid;

        $a2['id']       = 2;
        $a2['name']     = "hn";
        $a2['value']    = $r->hn;

        $a3['id']       = 3;
        $a3['name']     = "first name";
        $a3['value']    = "$r->firstname";

        $a4['id']       = 4;
        $a4['name']     = "middle name";
        $a4['value']    = "$r->middlename";


        $a5['id']       = 5;
        $a5['name']     = "last name";
        $a5['value']    = "$r->lastname";

        $a6['id']       = 6;
        $a6['name']     = "Gender";
        $a6['value']    = "$r->gender";

        $a7['id']       = 7;
        $a7['name']     = "AGE";
        $a7['value']    = "$r->age";

        $arr            = array($a1,$a2,$a3,$a4,$a5,$a6,$a7);

        // dd($arr);

        $json           = jsonEncode($arr);
        $str            = connectwebJSONmethod($url,$json,$header,"PUT");
        // dd($str);
        echo $str;
    }


}
