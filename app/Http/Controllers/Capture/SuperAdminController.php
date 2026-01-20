<?php

namespace App\Http\Controllers\Capture;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Department;
use App\Models\connect;
use App\Models\Mongo;

class SuperAdminController extends Controller
{
    public function __construct(Request $r){checklogin();}

    public function index(Request $r)
    {
        $str    = file_get_contents("D:/laragon/htdocs/config/project/admin.txt");
        $view['connection'] = jsonDecode($str);
        $view['room']       = Department::room(uid());
        return view('endocapture.superadmin.index',$view);
    }


    public function store(Request $r)
    {
        switch($r->event){
            case "config_type"          : $this->config_type($r);           break;
            case "clearview"            : $this->clearview($r);             break;
            case "queue"                : $this->queue($r);                 break;
            case "connection_hospital"  : $this->connection_hospital($r);   break;
            case "list_file_connection" : $this->list_file_connection();    break;
            case "add_connection_file"  : $this->add_connection_file($r);   break;
            case "test_connect"         : $this->test_connect($r);          break;
            case "update_connect"       : $this->update_connect($r);        break;
            case "update_patient"       : $this->update_patient();          break;
            case "update_lumina"        : $this->update_lumina($r);          break;
        }
    }

    public function config_type($r){
        // $str            = getCONFIG("$r->config_type.txt");
        // $json           = (array) jsonDecode($str);
        // $json[$r->id]   = $r->value;

        setCONFIG($r->config_type,$r->id,$r->value);
    }
    public function update_patient(){
        $gender = DB::table('dd_gender')->where('gender_name','None')->first();
        if(!isset($gender)){
            $gd['gender_name'] = 'None';
            DB::table('dd_gender')->insert($gd);
        }
        $save_hn = '';
        $patients   = DB::table('patient')->select('hn')->get();
        foreach ($patients as $pt) {
            $array[] = $pt->hn;
        }
        $case       = DB::table('tb_case')->whereNotIn('case_hn',$array)->select('case_hn','case_json')->where('case_hn', 'not like', "%test%")->orderBy('case_hn', 'desc')->get()->toArray();
        foreach ($case as $key => $c) {
            if($save_hn!=$c->case_hn){
                $json = jsonDecode($c->case_json);
                $data['birthdate'] = date('Y-01-01');
                if(isset($json->age)){
                    $data['birthdate'] = intval(date('Y')-$json->age)."-01-01";
                }
                $name = explode(" ", $json->patientname);
                $spac = array_filter($name, fn($value) => $value !== '');
                if(count($spac)==2){
                    $data['firstname'] = @$name[0];
                    $data['lastname'] = @$name[2];
                }
                $data['gender'] = 3;
                $data['createdate'] = date('Y-m-d');
                $data['hn'] = $c->case_hn;
                DB::table('patient')->insert($data);
                $save_hn=$c->case_hn;
            }
        }
        return redirect('superadmin');
    }
    public function update_connect($r){
        $str            = file_get_contents("D:/laragon/htdocs/config/connection/hospital/$r->file.txt");
        $json           = json_decode($str);
        $id             = $r->id;
        $json->$id      = $r->value;
        file_put_contents($_SERVER['DOCUMENT_ROOT']."/config/connection/hospital/$r->file.txt", jsonEncode($json));
    }
    public function test_connect($r){
        try {
            $servername = $r->host;
            $username   = $r->username;
            $password   = $r->password;
            $db         = $r->database;
            $port       = $r->port;

            $conn = mysqli_connect($servername, $username, $password,$db,$port);

            if (!$conn) {
                echo "error";
            }
            echo "success";
        } catch(\Throwable $e) {
            echo "error";
        }
    }

    public function show($id){
        $view['id'] = $id;
        $str    = file_get_contents("D:/laragon/htdocs/config/project/admin.txt");
        if($id=='api'){
            $x      = 0;
            $file = scandir($_SERVER['DOCUMENT_ROOT']."/config/api");
            if(count($file)>2){
                for($i=2;$i<count($file);$i++){
                    $get = file_get_contents("D:/laragon/htdocs/config/api/$file[$i]");
                    $json = jsonDecode($get);
                    if($json->type_connect==1){
                        $type   = 'POST';
                        $color  = 'api-post';
                    }elseif($json->type_connect==2){
                        $type = 'GET';
                        $color  = 'api-get';
                    }elseif($json->type_connect==3){
                        $type = 'PUT';
                        $color  = 'api-put';
                    }elseif($json->type_connect==4){
                        $type = 'Token POST';
                        $color  = 'api-token-post';
                    }elseif($json->type_connect==5){
                        $type = 'Token GET';
                        $color  = 'api-token-get';
                    }elseif($json->type_connect==6){
                        $type = 'Token PUT';
                        $color  = 'api-token-put';
                    }else{
                        $type = 'None';
                        $color  = 'text-dark';
                    }
                    $array[$x]['file']          = $file[$i];
                    $array[$x]['type_name']     = $type;
                    $array[$x]['type_nume']     = $json->type_connect;
                    $array[$x]['type_color']    = $color;
                    $x++;
                }
            }else{
                $array = null;
            }
            $view['file'] = $array;
        }
        $view['connection'] = jsonDecode($str);
        return view("endocapture.superadmin.page.$id",$view);
    }
    public function add_connection_file($data){
        $fp = fopen($_SERVER['DOCUMENT_ROOT']."/config/connection/hospital/$data->namefile".'.txt',"w") or die("Unable to open file!");
        $content['host'] = '';
        $content['port'] = '';
        $content['database'] = '';
        $content['username'] = '';
        $content['password'] = '';
        $content['driver'] = 'mysql';
        fwrite($fp,json_encode($content));
        fclose($fp);
    }
    public function connection_hospital($data){
        if($data->name!='Default'){
            $name = str_replace('.txt','',$data->name);
            file_put_contents($_SERVER['DOCUMENT_ROOT']."/config/connection/connect.txt",$name);
        }
        $value = connect::get_all();
        $view['data'] = json_decode($value);
        $show =view('EndoCAPTURE.superadmin.component.detail_connection',$view)->render();
        echo $show;
    }
    public function list_file_connection(){
        $view['file'] = scandir($_SERVER['DOCUMENT_ROOT']."/config/connection/hospital");
        $view['select'] = file_get_contents("D:/laragon/htdocs/config/connection/connect.txt");
        $show =view('EndoCAPTURE.superadmin.component.list_connection',$view)->render();
        echo $show;
    }

    public function clearview(){
        $dir = storage_path('framework\views');
        function getDirContents($dir, &$results = array()) {
            $files = scandir($dir);
            foreach ($files as $key => $value) {
                $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
                if (!is_dir($path)) {
                    $find = strpos($path,'.gitignore');
                    if($find>0){
                        echo $path;
                    }else{
                        unlink($path);
                        $results[] = $path;
                    }
                } else if ($value != "." && $value != "..") {
                    getDirContents($path, $results);
                    $results[] = $path;
                }
            }
            return $results;
        }
        getDirContents($dir);
    }

    public function update_lumina($r){
        $tb_lumina = Mongo::table('tb_lumina')->where('id', 1)->first();
        if(!isset($tb_lumina)){
            $arr['id'] = 1;
            Mongo::table('tb_lumina')->insert($arr);
        }
        $is_default = $r->is_default == 'true' ? 'default_' : '';
        $u[$is_default.$r->id] = @$r->value."";
        Mongo::table('tb_lumina')->where('id', 1)->update($u);
    }

}
