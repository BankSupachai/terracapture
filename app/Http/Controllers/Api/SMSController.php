<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Mongo;
use Carbon\Carbon;


class SMSController extends Controller
{

    // wy-dL0QVbl6AnBwScImHYFW0Amo1B0
    // ni8i49J7R-YFMSyEUr0X6ZgyyNKXQH

    //thaibulksms.com
    // public $apikey = "wy-dL0QVbl6AnBwScImHYFW0Amo1B0";
    // public $secret = "ni8i49J7R-YFMSyEUr0X6ZgyyNKXQH";
    // public $sender = "Remark";

    // sms-kub.com
    public $url =   "https://console.sms-kub.com/api/messages";
    public $apitoken = "vrKwL8J9prcXoegCIi3PV25l3N02maGW";

    public function store(Request $r)
    {
        if (isset($r->event)) {
            if ($r->event == "viewer_sms") {
                $this->viewer_sms($r);
            }
            if ($r->event == "booking_sms") {
                $this->booking_sms($r);
            }
            if ($r->event == "liveconsult_sms") {
                $this->liveconsult_sms($r);
            }

            if($r->event == "queue_sms") {
                $this->queue_sms($r);
            }

            if($r->event == "send_sms") {
                $this->send_sms_message($r->phone_number,"หิวข้าว");
            }
        }
    }

    public function queue_sms($r) {
        $message = "Queue $r->message";
        echo $this->send_sms_message($r->phone,$message);
    }


    public function viewer_sms($r)
    {
        $phonenumber    = $r->phone;
        $message        = "viewer medicaendo.com/v/$r->hn";
        $apiKey         = "vYuwGg_H5W6TlbjSGWaWhwzkoFX_9W";
        $apiSecretKey   = "nkr4rKWhn6RV6Qixh-DPMq_wkRt9Cx";
        $token          = base64_encode("$apiKey:$apiSecretKey");
        $body           = [
            'msisdn'    => $phonenumber,
            'message'   => $message,
            'sender'    => 'Member',
        ];
        $header[0]      = 'application/x-www-form-urlencoded';
        $header[1]      = 'Authorization: Basic ' . $token;
        $header[2]      = 'accept: application/json';
        $url            = "https://api-v2.thaibulksms.com/sms";
        connectwebJSON($url, $body, $header);
        echo "success";
    }



    public function liveconsult_sms($r)
    {
        // $phonenumber    = $r->phone;
        $message        = "liveconsult medicaendo.com/c/$r->cid";
        // $apiKey         = "vYuwGg_H5W6TlbjSGWaWhwzkoFX_9W";
        // $apiSecretKey   = "nkr4rKWhn6RV6Qixh-DPMq_wkRt9Cx";
        // $token          = base64_encode("$apiKey:$apiSecretKey");
        // $body           = [
        //     'msisdn'    => $phonenumber,
        //     'message'   => $message,
        //     'sender'    => 'Member',
        // ];
        // $header[0]      = 'application/x-www-form-urlencoded';
        // $header[1]      = 'Authorization: Basic ' . $token;
        // $header[2]      = 'accept: application/json';
        // $url            = "https://api-v2.thaibulksms.com/sms";
        // connectwebJSON($url, $body, $header);


        $this->send_sms_message($r->phone,$message);
        $arr['status'] = 'success';
        $arr['phone'] = $r->phone;
        $arr['message'] = $message;
        printJSON($arr);
        // echo "success";


    }



    public function booking_sms($r)
    {
        $hospital       = "10672";
        $phonenumber    = $r->phone;
        $message        = "prepare medicaendo.com/b/$r->nid?h=$hospital";

        // {
        //     "balance":2475,
        //     "code":200,
        //     "data":{"total":1,
        //         "block":0,
        //         "send":1,
        //         "used":1,
        //         "balance":2475,
        //         "type":"MARKETING",
        //         "is_schedule":null,
        //         "id":"000000000000000000000000"},
        //         "message":"Success"
        // }

        echo $this->send_sms_message($phonenumber,$message);
    }

    // public function viewer_otp($r){
    //     $patient = DB::table('patient')->where('hn',$r->hn)->first();
    //     $otp = rand(100000,999999);
    //     $otp = $this->check_dup_otp($otp);
    //     $phonenumber    = $patient->phone;
    //     $message        = "OTP = $otp";
    //     $apiKey         = "vYuwGg_H5W6TlbjSGWaWhwzkoFX_9W";
    //     $apiSecretKey   = "nkr4rKWhn6RV6Qixh-DPMq_wkRt9Cx";
    //     $token          = base64_encode("$apiKey:$apiSecretKey");
    //     $body           = [ 'msisdn'    => $phonenumber,
    //                         'message'   => $message,
    //                         'sender'    => 'Member',    ];
    //     $header[0]      = 'application/x-www-form-urlencoded';
    //     $header[1]      = 'Authorization: Basic '. $token;
    //     $header[2]      = 'accept: application/json';
    //     $url            = "https://api-v2.thaibulksms.com/sms";
    //     $sms = connectwebJSON($url,$body,$header);

    //     $data['otp']        = $otp;
    //     $data['hn']         = $r->hn;
    //     $data['process']    = 'VIEWER';
    //     $data['date_time']  = Carbon::now()->format('Y-m-d H:i:s');
    //     Mongo::table('tb_sms')->insert($data);

    //     $date = Carbon::now()->addMinutes(-1)->format('Y-m-d H:i:s');
    //     Mongo::table("tb_sms")->whereDate('date_time', '<=', $date)->delete();

    //     echo "success";
    // }

    public function send_sms($r, $name)
    {
        $patient = (object) Mongo::table('tb_patient')->where('hn', $r->hn)->first();
        $otp = rand(100000, 999999);
        $otp = $this->check_dup_otp($otp);
        $phonenumber    = $patient->phone;
        $message        = "OTP = $otp";
        $apiKey         = "vYuwGg_H5W6TlbjSGWaWhwzkoFX_9W";
        $apiSecretKey   = "nkr4rKWhn6RV6Qixh-DPMq_wkRt9Cx";
        $token          = base64_encode("$apiKey:$apiSecretKey");
        $body           = [
            'msisdn'    => $phonenumber,
            'message'   => $message,
            'sender'    => 'Member',
        ];
        $header[0]      = 'application/x-www-form-urlencoded';
        $header[1]      = 'Authorization: Basic ' . $token;
        $header[2]      = 'accept: application/json';
        $url            = "https://api-v2.thaibulksms.com/sms";
        $sms = connectwebJSON($url, $body, $header);

        $data['otp']        = $otp;
        $data['hn']         = $r->hn;
        $data['process']    = $name;
        $data['date_time']  = Carbon::now()->format('Y-m-d H:i:s');
        $t = Mongo::table('tb_sms')->insert($data);

        $date = Carbon::now()->addMinutes(-1)->format('Y-m-d H:i:s');
        $d = Mongo::table("tb_sms")->whereDate('date_time', '<=', $date)->delete();

        echo "success";
    }





    public function check_dup_otp($current_otp)
    {
        $new_otp = '';
        $check = Mongo::table('tb_sms')->where('otp', $current_otp)->get();
        if (isset($check) && count($check) != 0) {
            $new_otp = $this->get_otp();
            while ($new_otp == $current_otp) {
                $new_otp = $this->get_otp();
            }
        } else {
            $new_otp = $current_otp;
        }
        return $new_otp;
    }

    public function get_otp()
    {
        $otp = rand(100000, 999999);
        return $otp;
    }



    public function index()
    {

        $this->send_sms_message("0927499072","หิวข้าว");

    }



    public function send_sms_message($number,$message){
        $ch = curl_init();

        $arr['to'] = array($number);
        $arr['from'] = "Medica";
        $arr['message'] = $message;
        $json = jsonEncode($arr);

        curl_setopt($ch, CURLOPT_URL, 'https://console.sms-kub.com/api/messages');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json);

        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Token: E6EMq6KKPpQuqQmu8VRXzFNrzK0W45Xh';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            $res =  'Error:' . curl_error($ch);
        }else{
            $res = $result;
        }
        curl_close($ch);

        return $res;
        // dd($res);
    }


}
