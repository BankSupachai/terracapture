<?php

use App\Models\Mongo;
use App\Models\Server;

function NURSEMONITORoperation($hn, $caseuniq, $room)
{
    if (@getCONFIG("feature")->nurse_monitor) {
        $serverconnect = @fsockopen(@getCONFIG("admin")->server_name, portnumber(), $errno, $errstr, 1);
        if ($serverconnect) {

            $w1[0]                  = array('caseuniq', (string) $caseuniq);
            $w1[1]                  = array('monitor_status', 'Holding');
            $val1['monitor_status'] = "Waiting";
            Server::table('tb_casemonitor')->where($w1)->update($val1);

            $w2[0]                      = array('caseuniq', (string) $caseuniq);
            $val2['monitor_status']     = "Operation";
            $val2['monitor_room']       = (int) $room;
            $val2['monitor_casestatus'] = 1;
            Server::table('tb_casemonitor')->where($w2)->update($val2);


            $w3[0]                  = array('monitor_hn', $hn);
            $w3[1]                  = array('monitor_status', 'Holding');
            $val3['monitor_room']   = (int) $room;
            Server::table('tb_casemonitor')->where($w3)->update($val3);

            socketioTRIGGER('casemonitor');
        }
    }
}

function NURSEMONITORreporting($caseuniq)
{
    if (@getCONFIG("feature")->nurse_monitor) {
        $serverconnect = @fsockopen(@getCONFIG("admin")->server_name, portnumber(), $errno, $errstr, 1);
        if ($serverconnect) {
            $w2[0]                      = array('caseuniq', (string) $caseuniq);
            $val2['monitor_status']     = "Recovery";
            $val2['monitor_reportstatus'] = "draft";
            Server::table('tb_casemonitor')->where($w2)->update($val2);
            socketioTRIGGER('casemonitor');
        }
    }
}

function NURSEMONITORsuccess($caseuniq)
{
    if (@getCONFIG("feature")->nurse_monitor) {
        $serverconnect = @fsockopen(@getCONFIG("admin")->server_name, portnumber(), $errno, $errstr, 1);
        if ($serverconnect) {
            $room = (object) Mongo::table('tb_room')->where('room_type', 'recovery')->first();
            $w2[0]                      = array('caseuniq', (string) $caseuniq);
            $val2['monitor_status']     = "Recovery";
            $val2['monitor_reportstatus'] = "final";

            $val2['monitor_room']       = (int) @$room->room_id;
            Server::table('tb_casemonitor')->where($w2)->update($val2);
            socketioTRIGGER('casemonitor');
        }
    }
}



function socketioTRIGGER($text)
{
    if (connectSERVER()) {
        $servername = getCONFIG("admin")->server_name;
        $app_name   = app_name();
        $portnumber = portnumber();
        // $url        = "http://$servername:$portnumber/$app_name/socketio/$text";
        $url        = "http://endoindex/endoindex/socketio/$text";
        connectweb($url);
    }
}



function operation_room($roomID)
{

    $roomID = (int) $roomID;
    $job    = Mongo::table('tb_casemonitor')

        ->where('monitor_room', $roomID)
        ->where("monitor_display", "show")
        ->where(function ($query) {
            $query->where("monitor_status", "Operation")
                ->orWhere("monitor_status", "operation");
        })
        ->get();
    // dd($job);
    unset($arr);
    $arr = [];
    foreach ($job as $book) {
        $book = (object) $book;
        $arr[$book->monitor_hn]['hn']           = '' . @$book->monitor_hn;
        $arr[$book->monitor_hn]['caseuniq']     = '' . @$book->caseuniq;
        $arr[$book->monitor_hn]['timevisit']    = '' . @$book->monitor_timevisit;
        $arr[$book->monitor_hn]['room']         = '' . @$book->monitor_room;
        $arr[$book->monitor_hn]['location']     = '' . @$book->monitor_location;
        $arr[$book->monitor_hn]['procedure'][]  = '' . @$book->monitor_procedure;
        $arr[$book->monitor_hn]['patientname']  = '' . @$book->monitor_patientname;
        $arr[$book->monitor_hn]['doctorname']   = '' . @$book->monitor_doctorname;
        $arr[$book->monitor_hn]['queue']        = '' . @$book->monitor_queue;
        if (isset($book->monitor_status)) {
            if ($book->monitor_status == 'Holding') {
                $arr[$book->monitor_hn]['color'][]  = 'warning';
                $arr[$book->monitor_hn]['status'][] = 'Holding';
            }
            if ($book->monitor_status == 'Operation') {
                $arr[$book->monitor_hn]['color'][]  = 'danger';
                $arr[$book->monitor_hn]['status'][] = 'Operation';
            }
            if ($book->monitor_status == 'Reporting') {
                $arr[$book->monitor_hn]['color'][]  = 'success';
                $arr[$book->monitor_hn]['status'][] = 'Reporting';
            }
        } else {
            $arr[$book->monitor_hn]['color'][]      = 'success';
            $arr[$book->monitor_hn]['status'][]     = 'Reporting';
        }
    }

    $arr2 = array();
    foreach ($arr as $key) {
        $hn         = $key['hn'];
        $nothold    = false;
        foreach (isset($key['status']) ? $key['status'] : [] as $data) {
            if ($data != "Holding") {
                $nothold = true;
            }
        }
        if ($nothold) {
            $arr2[$hn] = $key;
        }
    }
    return $arr2;
}

function holding_room($roomID, $hn)
{
    $roomID = (int) $roomID;

    // dd($hn);
    $job = Mongo::table('tb_casemonitor')
        // ->where('monitor_hn',$hn)
        ->where('monitor_room', $roomID)
        ->where("monitor_display", "show")
        ->where(function ($query) {
            $query->where("monitor_status", "Holding")
                ->orWhere("monitor_status", "holding");
        })


        ->get();
    // dd($job);
    unset($arr);
    // dd($job);
    $arr = [];

    foreach ($job as $book) {
        $book = (object) $book;
        $arr[$book->monitor_hn]['hn']               = '' . @$book->monitor_hn;
        $arr[$book->monitor_hn]['caseuniq']         = '' . @$book->caseuniq;
        $arr[$book->monitor_hn]['timevisit']        = '' . @$book->monitor_timevisit;
        $arr[$book->monitor_hn]['room']             = '' . @$book->monitor_room;
        $arr[$book->monitor_hn]['location']         = '' . @$book->monitor_location;
        $arr[$book->monitor_hn]['procedure'][]      = '' . @$book->monitor_procedure;
        $arr[$book->monitor_hn]['patientname']      = '' . @$book->monitor_patientname;
        $arr[$book->monitor_hn]['prediagnostic']    = '' . @$book->monitor_prediagnostic;
        $arr[$book->monitor_hn]['doctorname']       = '' . @$book->monitor_doctorname;
        $arr[$book->monitor_hn]['remark']           = '' . @$book->monitor_description;
        $arr[$book->monitor_hn]['queue']            = '' . @$book->monitor_queue;
    }
    return $arr;
}


function recovery_room()
{
    $job = Mongo::table('tb_casemonitor')
        ->where('monitor_status', 'Recovery')
        ->orwhere('monitor_status', 'Discharged')
        ->where('monitor_display', '!=', 'hide')
        ->orderby('monitor_status', 'desc')
        ->orderby('monitor_order')
        ->get();
    unset($arr);
    $arr = [];
    foreach ($job as $book) {
        $book = (object) $book;
        $arr[$book->monitor_hn]['hn']               = '' . @$book->monitor_hn;
        $arr[$book->monitor_hn]['caseuniq']         = '' . @$book->caseuniq;
        $arr[$book->monitor_hn]['timevisit']        = '' . @$book->monitor_timevisit;
        $arr[$book->monitor_hn]['room']             = '' . @$book->monitor_room;
        $arr[$book->monitor_hn]['location']         = '' . @$book->monitor_location;
        $arr[$book->monitor_hn]['procedure'][]      = '' . @$book->monitor_procedure;
        $arr[$book->monitor_hn]['patientname']      = '' . @$book->monitor_patientname;
        $arr[$book->monitor_hn]['prediagnostic']    = '' . @$book->monitor_prediagnostic;
        $arr[$book->monitor_hn]['doctorname']       = '' . @$book->monitor_doctorname;
        $arr[$book->monitor_hn]['remark']           = '' . @$book->monitor_description;
        $arr[$book->monitor_hn]['queue']            = '' . @$book->monitor_queue;
    }
    return $arr;
}





function status_monitor($status)
{
    $job = Mongo::table('tb_casemonitor')
        ->where('monitor_status', $status)
        ->orderby('monitor_status', 'desc')
        ->where('monitor_display', '!=', 'hide')
        ->orderby('monitor_order')
        ->get();
    unset($arr);
    $arr = [];
    foreach ($job as $book) {
        $book = (object) $book;
        $arr[$book->monitor_hn]['hn']               = '' . @$book->monitor_hn;
        $arr[$book->monitor_hn]['caseuniq']         = '' . @$book->caseuniq;
        $arr[$book->monitor_hn]['timevisit']        = '' . @$book->monitor_timevisit;
        $arr[$book->monitor_hn]['room']             = '' . @$book->monitor_room;
        $arr[$book->monitor_hn]['location']         = '' . @$book->monitor_location;
        $arr[$book->monitor_hn]['procedure'][]      = '' . @$book->monitor_procedure;
        $arr[$book->monitor_hn]['patientname']      = '' . @$book->monitor_patientname;
        $arr[$book->monitor_hn]['prediagnostic']    = '' . @$book->monitor_prediagnostic;
        $arr[$book->monitor_hn]['doctorname']       = '' . @$book->monitor_doctorname;
        $arr[$book->monitor_hn]['remark']           = '' . @$book->monitor_description;
        $arr[$book->monitor_hn]['queue']            = '' . @$book->monitor_queue;
    }
    return $arr;
}


function status_monitor_array($status)
{
    $job = Mongo::table('tb_casemonitor')
        ->whereIn('monitor_status', $status)
        ->where('monitor_display', '!=', 'hide')
        ->orderby('monitor_status', 'desc')
        // ->orderby('monitor_order')
        ->get();

    // dd($job);
    unset($arr);
    $arr = [];
    foreach ($job as $book) {
        $book = (object) $book;
        $arr[$book->monitor_hn]['hn']               = '' . @$book->monitor_hn;
        $arr[$book->monitor_hn]['caseuniq']         = '' . @$book->caseuniq;
        $arr[$book->monitor_hn]['timevisit']        = '' . @$book->monitor_timevisit;
        $arr[$book->monitor_hn]['room']             = '' . @$book->monitor_room;
        $arr[$book->monitor_hn]['location']         = '' . @$book->monitor_location;
        $arr[$book->monitor_hn]['procedure'][]      = '' . @$book->monitor_procedure;
        $arr[$book->monitor_hn]['patientname']      = '' . @$book->monitor_patientname;
        $arr[$book->monitor_hn]['prediagnostic']    = '' . @$book->monitor_prediagnostic;
        $arr[$book->monitor_hn]['doctorname']       = '' . @$book->monitor_doctorname;
        $arr[$book->monitor_hn]['remark']           = '' . @$book->monitor_description;
        $arr[$book->monitor_hn]['queue']            = '' . @$book->monitor_queue;
        $arr[$book->monitor_hn]['status']           = '' . @$book->monitor_status;
    }
    return $arr;
}
