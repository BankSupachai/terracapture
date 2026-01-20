<div class="cardcode col-12" style="padding: 0;display:none">
    View : <a style="color:red;" href="{{url("autoit?run=visualcode_open\\endo.exe&path=pdf_footer")}}">pdf_footer</a>
    <br><br>
</div>
<table border="0" width="100%">
    <tr>
        <td align="left">
            @php
                $datapic = DB::table('tb_case')
                ->join('patient','patient.hn','tb_case.case_hn')
                ->where('case_id',$casedata->case_id)
                ->first();

                $file_start = fopen("public/images/ori-esign.txt", "r") or die("Unable to open file!");
                $str_start = fread($file_start,filesize("public/images/ori-esign.txt"));
                fclose($file_start);

                $check_file = file_exists(exfolder()."store/".$datapic->hn."/".$casedata->case_id.".txt");

                if($check_file==1){
                    $file_end = fopen(exfolder()."store/".$datapic->hn."/".$casedata->case_id.".txt", "r") or die("Unable to open file!");
                    $str_end = fread($file_end,filesize(exfolder()."store/".$datapic->hn."/".$casedata->case_id.".txt"));
                    fclose($file_end);
                }else{
                    $file_end = fopen("public/images/ori-esign.txt", "r") or die("Unable to open file!");
                    $str_end = fread($file_end,filesize("public/images/ori-esign.txt"));
                    fclose($file_end);
                }

                $rightto = DB::table('patient')
                ->leftjoin('dd_righttotreatment','dd_righttotreatment.id','patient.righttotreatment')
                ->where('patient.hn',$casedata->case_hn)->first();
                $this_json = jsonDecode($casedata->case_json);
                $doctorname = "-";
                if(isset($this_json->doctorname)){
                    if($this_json->doctorname != ''){
                        $doctorname = $this_json->doctorname;
                    }
                }
            @endphp
            <font size="2">
            @if($str_start==$str_end)
                Signature___________________________, {{$doctor[1]}}
            @else
                Signature @for($nu=0;$nu<=5;$nu++) &nbsp; @endfor <img src='{{$str_end}}' width="140" style="position: absolute;border-bottom: 1px solid black;"><br>
                @for($nu=0;$nu<=19;$nu++) &nbsp; @endfor
                {{ @$doctor01->name }}
            @endif
            </font>
        </td>
        <td align="right" valign="bottom">
            <font size="2">Reported by EndoCapture</font>
        </td>
    </tr>
</table>
