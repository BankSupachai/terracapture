<?php
    use Illuminate\Support\Facades\DB;
    use App\Models\Fileconfig;

    function app_name(){
        $val = configTYPE('admin','app_name');
        return $val;
    }

    function hostname($path){
        $host = request()->getSchemeAndHttpHost()."/".$path;
        return $host;
    }

    function domainname($path){
        $httpstype = configTYPE("feature", "https");
        if($httpstype){$protocal="https";}else{$protocal="http";}
        $url    = url("");
        $ex     = explode("/",$url);
        $val    = $ex[2];
        $val    = "$protocal://$val/$path";
        return $val;
    }

    function domainnameport($path){
        $httpstype = configTYPE("feature", "https");
        if($httpstype){$protocal="https";}else{$protocal="http";}
        $url    = url("");
        $ex     = explode("/",$url);
        $val    = $ex[2];
        $val    = "$protocal://$val$path";
        return $val;
    }

    function portnumber(){
        $val =configTYPE('admin','port_number');
        return $val;
    }
    function get_hospital(){
        $hospital = getCONFIG("hospital");
        return $hospital;
    }

    function get_hospital_config(){
        $hospital = (object) [];
        $hospital->hospital_code = configTYPE('hospital','hospital_code');
        $hospital->hospital_name = configTYPE('hospital','hospital_name');
        $hospital->hospital_address = configTYPE('hospital','hospital_address');
        $hospital->hospital_tel = configTYPE('hospital','hospital_tel');
        $hospital->hospital_email = configTYPE('hospital','hospital_email');
        $hospital->hospital_pic = configTYPE('hospital','hospital_pic');
        return $hospital;
    }


    function storePATH($path)
    {
        return ("D:\\laragon\htdocs\store\\$path");
    }

    function fileconfig($str){
        $fileconfig = "D:\\laragon\\htdocs\\config\\";
        $val = $fileconfig.$str;
        return $val;
    }


    function urlConfig($str){
        $url = domainname("config/");
        $val = $url.$str;
        return $val;
    }


    function makedir($path){
        $checkfile  = file_exists($path);
        if ($checkfile == 0) {
            mkdir($path, 0777, true);
        }
    }

    function makedirfull($path){
        try {
            //code...
            $path   = str_replace("\\","/",$path);
            $path   = str_replace("//","/",$path);
            $ex     = explode("/",$path);
            $dir    = "";
            foreach($ex as $item){
                $dir = $dir.$item."/";
                $checkfile  = file_exists($dir);
                if ($checkfile == 0) {
                    mkdir($dir, 0777, true);
                }
            }
        } catch (\Throwable $th) {
            //throw $th;
        }

    }

    function htdocs($subpath){
        $str    = file_get_contents("D:/laragon/htdocs/config/project/admin.txt");
        $json   = jsonDecode($str);
        return $json->htdocs_path.$subpath;
    }


    function mePHOTO($hn,$picname,$folderdate)
    {
        $path   = storePATH("$hn\\$folderdate\\$picname");

        if(!file_exists($path)){
            $file_end           = $path;
            $file_start         = storePATH("$hn\\$picname");

            makedirfull(storePATH("$hn\\$folderdate\\backup"));
            $file_backup_end    = storePATH("$hn\\$folderdate\\backup\\$picname");
            $file_backup_start  = storePATH("$hn\\backup\\$picname");
            try {copy($file_start, $file_end);}catch(\Throwable $e){}
            try {copy($file_backup_start, $file_backup_end);}catch(\Throwable $e){}
        }

        $path   = str_replace("\\","/",$path);
        if (file_exists($path)) {
            $str = domainname("store/$hn/$folderdate/$picname");
            // $str = "http://110.171.123.140/store/$hn/$folderdate/$picname";
        } else {
            $str = url('public/images/no_image.jpg');
        }


        return $str;
    }

    function picurl($value)
    {
        // $str    = file_get_contents("D:/laragon/htdocs/config/project/admin.txt");
        // $json   = jsonDecode($str);
        // $value      = $json->store_url.$value;
        $value = domainname("store/$value");
        return $value;
    }

    function exfolder($val)
    {
        $data = "D:\laragon\htdocs\\".$val;
        return $data;
    }


    function connectSERVER()
    {
        $servername = getCONFIG("admin")->server_name;
        $url        = "http://$servername";

        $ch = curl_init();                          // เริ่มต้นใช้งาน cURL
        curl_setopt($ch, CURLOPT_URL, $url);        // กำหนดค่า URL
        curl_setopt($ch, CURLOPT_HEADER, 0);        // กำให้ cURL ไม่มีการตั้งค่า Header
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);// กำหนดให้ cURL คืนค่าผลลัพท์
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 1);       //timeout in seconds
        $response = curl_exec($ch);                 // ประมวลผล cURL
        curl_close($ch);                            // ปิดการใช้งาน cURL

        if($response!=false||$response==""){
            return true;
        }else{
            return false;
        }






    }


    function connectweb($url){
        $ch = curl_init();                          // เริ่มต้นใช้งาน cURL
        curl_setopt($ch, CURLOPT_URL, $url);        // กำหนดค่า URL
        curl_setopt($ch, CURLOPT_HEADER, 0);        // กำให้ cURL ไม่มีการตั้งค่า Header
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);// กำหนดให้ cURL คืนค่าผลลัพท์
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
        $response = curl_exec($ch);                 // ประมวลผล cURL
        curl_close($ch);                            // ปิดการใช้งาน cURL
        return $response;
    }

    function connectwebPOST($url,$post){
        $ch     = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$post);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res    = curl_exec($ch);
        curl_close ($ch);
        return $res;
    }


    function connectwebJSON($url,$post,$header){
        $ch     = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$post);
        curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res    = curl_exec($ch);
        curl_close ($ch);
        return $res;
    }

    function connectpostheader($url,$post,$header){
        $ch     = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($post));
        curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res    = curl_exec($ch);
        curl_close ($ch);
        return $res;
    }

    function connectwebJSONmethod($url,$post,$header,$method){
        $ch     = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        // curl_setopt($ch, CURLOPT_POST, 1);
        // curl_setopt($ch, CURLOPT_POSTFIELDS,$post);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$post);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST,$method);
        curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res    = curl_exec($ch);
        curl_close ($ch);
        return $res;
    }

    function connectGETJSON($url,$header){
        $ch     = curl_init();
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'GET' );
        // curl_setopt( $ch, CURLOPT_POSTFIELDS, "" );
        curl_setopt($ch, CURLOPT_HTTPHEADER,$header);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);       //timeout in seconds
        $res    = curl_exec($ch);
        curl_close ($ch);
        return $res;
    }



    function isMobile() {
        // 1 = Mobile
        // 0 = Pc
        // return 1;

        if(preg_match("/(Chrome|Safari|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"])){
            $mobile = false;
        }else{
            $mobile = true;
        }


        return $mobile;
    }





