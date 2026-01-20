<?php
    use App\Models\Mongo;

    function SYSTEMQueue($event,$case){
        if(@getCONFIG("feature")->system_queue){
            $serverconnect = @fsockopen(@getCONFIG("admin")->server_name, portnumber(), $errno, $errstr, 1);
            if($serverconnect){
                $val['q_status']        = $event;
                $val['q_statustext']    = $event;
                $w[0] = array('q_hn',$case->case_hn);
                Mongo::table('tb_queue')->where($w)->update($val);
                $tb_queue   = (object) Mongo::table('tb_queue')->where($w)->first();
                insertqueue2cloud($tb_queue,false);
            }
        }
    }

    function insertqueue2cloud($tb_queue,$call){
        if($tb_queue!=null&&(array) $tb_queue != []){
            $arr['number']              = $tb_queue->q_number;
            $arr['type']                = $tb_queue->q_type;
            $arr['hn']                  = $tb_queue->q_hn;
            $arr['qrcode']              = $tb_queue->q_qrcode;
            $arr['status']              = $tb_queue->q_status;
            $arr['statustext']          = $tb_queue->q_statustext;
            $arr['timestart']           = $tb_queue->q_start;
            $arr['skip']                = $tb_queue->q_skip;
            $arr['calling']             = $call;
            $arr['hospital_code']       = configTYPE('hospital','hospital_code');
            $arr['hospital_name']       = configTYPE('hospital','hospital_name');
            $json                       = jsonEncode($arr);
            $val['send2cloud_id']       = get_last_id('send2cloud_id', 'tb_send2cloud') + 1;
            $val['send2cloud_system']   = "queue";
            $val['send2cloud_json']     = $json;
            $val['send2cloud_date']     = date('Y-m-d');
            Mongo::table('tb_send2cloud')->insert($val);
        }
    }

