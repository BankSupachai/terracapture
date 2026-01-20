@php
    $tb_report = DB::table("tb_report")->get();

    foreach($tb_report as $data){
        $w[0] = array("caseuniq",$data->caseuniq);
        $w[1] = array("comcreate",$data->comcreate);
        $tb_case = DB::table("tb_case")->where($w)->first();

        if($tb_case != null){
            $val["report_hn"] = pdpaEncode($tb_case->case_hn."");
            $json = jsonDecode($tb_case->case_json);
            $val["report_patientname"] = pdpaEncode(@$json->patientname."");

            DB::table("tb_report")->where($w)->update($val);
        }



    }



@endphp
