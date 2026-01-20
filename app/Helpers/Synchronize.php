<?php
    use App\Models\Mongo;




    function synfile($com_name,$hn){
        // dd($hn);
        $app_name   = app_name();
        $portnumber = portnumber();
        $url    = "http://$com_name:$portnumber/$app_name/pichn?hn=$hn";
        $res    = connectweb($url);
        $json   = jsonDecode($res);
        if(isset($json->dir)){
            foreach($json->dir as $dir){
                makedirfull(htdocs("store/$hn".$dir));
            }
        }

        if(isset($json->file)){
            foreach($json->file as $data){
                $path = $data->path;
                $size = $data->size;
                $file_end   = htdocs("store/$hn/$path");
                $file_start = "http://$com_name/store/$hn/$path";
                if(file_exists($file_end)){
                    if(filesize($file_end)!=$size){
                        try {copy($file_start, $file_end);}catch(\Throwable $e){}
                    }
                }else{
                    try {copy($file_start, $file_end);}catch(\Throwable $e){}
                }
            }
        }
    }


    function synfilehttps($com_name,$hn){
        $app_name   = app_name();
        $portnumber = portnumber();
        $url    = "https://endocapture.siph.com/$app_name/pichn?hn=$hn";
        $res    = connectweb($url);
        $json   = jsonDecode($res);
        if(isset($json->dir)){
            foreach($json->dir as $dir){
                makedirfull(htdocs("store/$hn".$dir));
            }
        }

        // dd($url,$app_name,$json,$res);
        if(isset($json->file)){
            foreach($json->file as $data){
                $path = $data->path;
                $size = $data->size;
                $file_end   = htdocs("store/$hn/$path");
                $file_start = "https://endocapture.siph.com/store/$hn/$path";
                if(file_exists($file_end)){
                    if(filesize($file_end)!=$size){
                        try {copy($file_start, $file_end);}catch(\Throwable $e){}
                    }
                }else{
                    try {copy($file_start, $file_end);}catch(\Throwable $e){}
                }
            }
        }
    }



    function createTEMP($table,$caseuniq,$comcreate,$updatetime){
        $w[0] = array('caseuniq',$caseuniq);
        $w[1] = array('comcreate',$comcreate);
        $val['updatetime']      = $updatetime;

        Mongo::table($table)->where($w)->update($val);

        $tb_case            = Mongo::table("tb_case")->where($w)->first();
        $tb_casemedication  = Mongo::table("tb_casemedication")->where($w)->first();

        $clientall = clientALL();
        array_push($clientall,"endoindex");

        foreach($clientall as $comname){
            if($comname!=getCONFIG("admin")->com_name && $comname!=""){
                $w[2] = array('temp_comname',$comname);
                $tb_casetemp = Mongo::table('tb_casetempout')->where($w)->first();
                $val['caseuniq']            = $caseuniq;
                $val['comcreate']           = $comcreate;
                $val['temp_comname']        = $comname;
                $val['tb_case']             = $tb_case;
                $val['tb_casemedication']   = $tb_casemedication;
                if($tb_casetemp==null){
                    Mongo::table('tb_casetempout')->insert($val);
                }else{
                    Mongo::table('tb_casetempout')->where($w)->update($val);
                }
            }
        }
    }

    function createTEMPMASTERDATA($table){
        foreach(clientALL() as $comname){
            $w[0] = array('comname',$comname);
            $w[1] = array('tablename',$table);
            $tb = Mongo::table('tb_datamastercheck')
            ->where($w)
            ->first();
            if($tb==null){
                $val['comname']     = $comname;
                $val['tablename']   = $table;
                Mongo::table('tb_datamastercheck')
                ->table('tb_datamastercheck')
                ->insert($val);
            }
        }
    }

    function createTEMPVDO($table,$caseuniq,$comcreate,$updatetime){
        $w[0] = array('caseuniq',$caseuniq);
        $w[1] = array('comcreate',$comcreate);
        $w[2] = array('vdo_syn','1');
        $data['updatetime'] = $updatetime;
        Mongo::table($table)->where($w)->update($data);

        if(getCONFIG("admin")->com_name!="endocapture"){
            $tb_case = Mongo::table($table)->where($w)->get();
            foreach($tb_case as $vdo){
                $json = jsonEncode($vdo);
                $val['temp_comname']    = "endocapture";
                $val['temp_table']      = $table;
                $val['caseuniq']        = $caseuniq;
                $val['temp_json']       = $json;
                $val['updatetime']      = $updatetime;
                Mongo::table('tb_casetemp')->insert($val);
                unset($val);
                Mongo::table($table)->where('vdo_id',$vdo->vdo_id)->update(['vdo_syn'=>0]);
            }
        }
    }






?>
