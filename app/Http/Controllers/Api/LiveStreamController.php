<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LiveStreamController extends Controller
{

    public function index(){
        exec("D:/allindex/vidsteam/__pycache__/client.cpython-310.pyc");
    }

    public function store(Request $r)
    {
        switch($r->event){
            case "live_open"    :   $this->live_open($r);   break;
            case "sound_open"   :   $this->sound_open($r);  break;
            case "client_open"  :   $this->client_open($r); break;
            case "live_close"   :   $this->live_close();    break;
            case "client_close" :   $this->client_close();  break;

        }
    }

    public function show($id){
        switch($id){
            case "serveropen"   :   $this->serveropen();    break;
            case "soundopen"    :   $this->soundopen();     break;
            case "clientopen"   :   $this->clientopen();    break;
            case "serverclose"  :   $this->live_close();   break;
            case "clientclose"  :   $this->live_close();   break;

        }
    }

    public function clientopen(){
        exec("D:/allindex/vidsteam/__pycache__/server.cpython-310.pyc");
    }

    public function soundopen(){
        exec("D:/allindex/vidsteam/__pycache__/server_sound.cpython-310.pyc");
    }

    public function serveropen(){
        exec("D:/allindex/vidsteam/__pycache__/client.cpython-310.pyc");
    }


    public function client_open(){
        $client = configTYPE("admin","ipaddress_client");
        $url = "http://$client/endocapture5.0/api/livestream";
        connectweb($url);
    }

    public function client_close(){
        // $client = configTYPE("admin","ipaddress_client");
        // $url = "http://$client/endocapture5.0/api/livestream/9999";
        // connectweb($url);
    }

    public function live_close(){
        $file01 = fopen("D:/allindex/vidsteam/__pycache__/server_close.txt", "w") or die("Unable to open file!");
        $file02 = fopen("D:/allindex/vidsteam/__pycache__/client_close.txt", "w") or die("Unable to open file!");
        $file03 = fopen("D:/allindex/vidsteam/__pycache__/sound_close.txt", "w") or die("Unable to open file!");
        fclose($file01);
        fclose($file02);
        fclose($file03);
    }

}
