@php

    $w[] = array('queue_hn',$_GET['hn']);
    $w[] = array('queue_datetime','like',date("Y-m-d")."%");
    $w[] = array('queue_procedure',@$_GET['procedure']." ");
    $find = DB::table('tb_demoqueue')->where($w)->first();

    $val['queue_hn']        = $_GET['hn'];
    $val['queue_fullname']  = $_GET['fullname'];
    $val['queue_status']    = $_GET['status'];
    $val['queue_procedure'] = @$_GET['procedure']." ";
    $val['queue_datetime']  = date("Y-m-d H:i:s");

    if($find==null){
        DB::table('tb_demoqueue')->insert($val);
    }else{
        if($val['queue_status']!="รอคิว"){
            DB::table('tb_demoqueue')->where($w)->update($val);
        }
    }


@endphp
