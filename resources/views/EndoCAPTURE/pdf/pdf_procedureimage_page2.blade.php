

<?php if (version_compare(PHP_VERSION, '7.2.0', '>=')) {error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);} ?>
   <table width="770" border="0">
        <tr>
            <td>&nbsp;</td>
        <tr>
        <tr>
            <td width="20"></td>
            <td>


              <table border="0" align="center" width="95%">
                  <tr>
                      <td>
                          &nbsp;&nbsp;<img src="{{url("images/{{$hospital[0]->hospital_pic}}")}}" width="70">
                      </td>
                      <td width="10"></td>
                      <td width="390">
                        <font>{{$hospital[0]->hospital_name}} <br>
                        {{$hospital[0]->hospital_address}} <br>
                        Tel :{{$hospital[0]->hospital_tel}}
                        </font>
                      </td>
                      <td width="20"></td>
                      <td align="right">
                        <p style="font-size:25px;">Procedure Report</p>
                        <p style="font-size:25px;color:{{$casedata->procedure_color}}"><b>{{$casedata->procedure_name}}</b></p>

                      </td>
                  </tr>
              </table>


<hr>
    <table border="0" width="100%">
        <tr>
            <td>Patient Name : {{$casedata->firstname." ".$casedata->lastname}}</td>
            <td>HN : {{ $casedata->hn }}</td>
        </tr>
        <tr>
            <td>Date of birth/Age : {{$casedata->birthdate}} ({{age($casedata->birthdate)}})</td>
            <td>Gender : {{ $casedata->gender_name }}</td>
        </tr>
        <tr>
            <td>Date of procedure : {{$casedata->case_dateappointment}}</td>
            <td>Time Start : {{ $casedata->capture_start }}</td>
        </tr>
        <tr>
            <td>Referring Physician : {{$casedata->refer}}</td>
            <td>End :{{ $casedata->capture_end }}
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <?php


                        echo " Total Time (Start to End) : ".@$withdrawal;
                        ?>
          </td>
        </tr>
        <tr>
            <td valign="top">

                <table>
                    <tr>
                        <td valign="top"><b>Endoscopist :</b>
                            @if($doctor01[0]->name!="")  {{$doctor01[0]->name}}           @endif
                            @if($doctor02[0]->name!="") ,{{$doctor02[0]->name}}           @endif
                            @if($doctor03[0]->name!="") ,{{$doctor03[0]->name}}           @endif
                            @if($doctor04[0]->name!="") ,<br>{{$doctor04[0]->name}}       @endif
</td>
</tr>
<tr>
                        <td>

                <b>Nurse, Assist / Anesthesia :</b>
                @if($nurse01[0]->name!="")   {{$nurse01[0]->name}}  @endif
                @if($nurse02[0]->name!=""),   {{$nurse02[0]->name}}  @endif
                @if($nurse03[0]->name!=""),   {{$nurse03[0]->name}}  @endif
                @if($nurse04[0]->name!=""),   {{$nurse04[0]->name}}  @endif
                @if($anes[0]->name!="") /     {{$anes[0]->name}}     @endif



                        </td>
                    </tr>
                </table>



            </td>
            <td colspan="2"  valign="top">
                <table>
                    <tr>
                        <td valign="top">Endoscope :</td>
                        <td>

                @php
                $i =0;
                @endphp

                @foreach($photoselect as $p)
                    @php
                        $ex = explode('_',$p->photo_name);
                        $keep[$i] = $ex[1];
                        $i++;
                    @endphp
                @endforeach

                @php
                if($keep==null){
                    $b=array();
                }else{
                $b = array_unique ($keep);
                }

                @endphp

<table>
                @foreach($b as $c)

                <tr>
                @php
                if($c!="self")
                {
                    $showscope = DB::table('tb_scope')->where('scope_id','=',$c)->first();
                    echo "<td></td><td>";
                    echo $showscope->scope_name;
                    echo "</td> ";
                }

                @endphp
                </tr>

                @endforeach
            </table>
                </td>
                </tr>
                </table>




            </td>
        </tr>


    </table>
    <hr></td></tr>
              </table>


    <table border="0">
      <tr>
        <td width="25"></td>
        <td height="750" valign="top">

    <table border="0" width="100%">





                            <?php $i=0; ?>
                            <?php $startpic =0; ?>
                            @forelse ($photoselect as $p)
                              <?php
                              if($p->photo_status==1){
                                $border_color="red";
                              }else{
                                $border_color="black";
                              }

                                  $path= picurl($casedata->hn."/".$p->photo_name);
                                  list($width, $height) = getimagesize($path);
                                  $fixwidth = 350;
                                  $newheight = ($fixwidth/$width)*$height;
                               ?>

                              <?php $startpic++; ?>

                              @if($startpic>=$photostart && $startpic<=$photoend)
                              <?php $i++; ?>
                              <?php if($i==1){echo "<tr>";} ?>
                                <td valign="top">

                                <table>
                                <tr>
                                  <td style="border: 1px solid {{$border_color}} ;">

                                  <img src="{{$path}}" width="350">

                                  </td>
                                  <td rowspan="2" width="<?php if($i!=3){echo "20px";}else{echo "0px";} ?>">

                                  </td>
                                </tr>
                                <tr>

                                  <td style="border: 1px solid {{$border_color}};height:20px">
                  								  [ {{$p->photo_num_select}} ] &nbsp;
                        @if($p->mainpartsub_name!="")
                        <font color="{{$border_color}}">{{$p->mainpartsub_name}}</font>
                        <br><font>{{$p->photo_text}}</font>
                        @else
                        <font>{{$p->photo_text}}</font>
                    @endif


                    @if($p->photo_gastrolesion!="")
                        <br><font>{{$p->photo_gastrolesion}}</font>
                    @endif
                                  </td>
                                </tr>
                              </table>

                              <br><br>
                            </td>
                            <?php if($i==2){echo "</tr>";$i=0;} ?>
                            @endif

                            @empty
                            @endforelse
</table>

</td>
</tr>
</table>

<br>
 @if($paperend=="true")
                <table width="400">
                  <tr>
                    <td height="50" width="400">
                      <center>
                        @php
                        $datapic = DB::table('tb_case')
                        ->join('patient','patient.id','tb_case.case_patientid')
                        ->where('case_id',$casedata->case_id)
                        ->first();

                        $file_start = fopen("images/ori-esign.txt", "r") or die("Unable to open file!");
                        $str_start = fread($file_start,filesize("images/ori-esign.txt"));
                        fclose($file_start);

                        $check_file = file_exists("store/".$datapic->hn."/".$casedata->case_id.".txt");

                        if($check_file==1){
                            $file_end = fopen("store/".$datapic->hn."/".$casedata->case_id.".txt", "r") or die("Unable to open file!");
                            $str_end = fread($file_end,filesize("store/".$datapic->hn."/".$casedata->case_id.".txt"));
                            fclose($file_end);
                        }else{
                            $file_end = fopen("images/ori-esign.txt", "r") or die("Unable to open file!");
                            $str_end = fread($file_end,filesize("images/ori-esign.txt"));
                            fclose($file_end);
                        }
                        @endphp
                        @if($str_start==$str_end)
                            Signature___________________________, MD
                        @else
                            <img src='{{$str_end}}' width="150">
                        @endif
                      <br>(&nbsp;&nbsp;&nbsp;{{ @$doctor01[0]->name }}&nbsp;&nbsp;&nbsp;)
                      </center>

                    </td>
                  </tr>
                </table>

                <table width="100%">
                  <tr>
                    <td align="right">
                     Reported by EndoCapture &nbsp;&nbsp;&nbsp;
                    </td>
                  </tr>
                </table>
@endif


    </td>
    </tr>
    </table>
    @if(!$paperend)
    <pagebreak>
    @endif
