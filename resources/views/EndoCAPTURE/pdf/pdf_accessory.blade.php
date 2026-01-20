<?php if (version_compare(PHP_VERSION, '7.2.0', '>=')) {error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);} ?>

<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<style>
    body {font-family: "Garuda";}
    table {border-collapse: collapse;}
    td,th {
      font-size: 12px;
    }

.image {
   position: relative;
}

ggg {
   position: absolute;
   top: 200px;
   left: 0;
   width: 100%;
}


</style>





<body topmargin="50" leftmargin="50" rightmargin="50">
    <table width="750" border="0">
        <tr>
            <td>&nbsp;</td>
        <tr>
        <tr>
            <td width="50"></td>
            <td>


              <table border="0">
                  <tr>
                      <td>
                          <img src="images/{{$hospital[0]->hospital_pic}}" width="70">
                      </td>
                      <td width="10"></td>
                      <td width="400">
                        <font>{{$hospital[0]->hospital_name}} <br>
                        {{$hospital[0]->hospital_address}} <br>
                        Tel :{{$hospital[0]->hospital_tel}}
                        </font>
                      </td>
                      <td width="40"></td>
                      <td>
                        <h2>Accessory Report</h2><br>
                        <h2>&nbsp;</h2>
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
                    <?php
                    if($casedata->birthdate!=""){
                      $birthDate = explode("-", $casedata->birthdate);
                      $age = (date("md", date("U", mktime(0, 0, 0, $birthDate[1], $birthDate[0], $birthDate[2]))) > date("md") ? (((date("Y")+543) - $birthDate[2]) - 1) : ((date("Y")+543) - $birthDate[2]));
                    }
                     ?>
                      <td>Date of birth/Age : {{$casedata->birthdate}} ({{$age}})</td>
                      <td>Gender : {{ $casedata->gender_name }}</td>
                  </tr>
                  <tr>
                      <td>Date of procedure : {{$casedata->case_dateappointment}}</td>
                      <td>Endoscope : {{$scopeselect[0]->scope_model}}({{$scopeselect[0]->scope_serial}})</td>
                  </tr>
                  <tr>
                      <td>Referring Physician : {{$casedata->refer}}</td>
                      <td>Time Start : {{ $casedata->capture_start }}</td>
                  </tr>
                  <tr>
                      <td>Endoscopist : {{$doctor01[0]->name}}</td>
                      <td>End :{{ $casedata->capture_end }}
                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

						<?php
						$start	= explode(":",$casedata->capture_start);
						$end	= explode(":",$casedata->capture_end);
						$timestart	= ($start[0]*60)+$start[1];
						$timeend	= ($end[0]*60)+$end[1];
						$withdrawal = $timeend-$timestart;
						echo " Withdrawal : ".$withdrawal;
						?>





                      </td>
                  </tr>
              </table>

              <hr>

@php

  $acc = (array) json_decode(@$casedata->accessory);
  $acc_count=strlen(@$casedata->accessory);
  $acci=1;
@endphp


            @php
                $all_income = 0;
                $all_payout = 0;

                $rightto = DB::table('patient')
                ->leftjoin('dd_righttotreatment','dd_righttotreatment.id','patient.righttotreatment')
                ->where('patient.id',$casedata->case_patientid)->first();

                $proprice = jsonDecode($casedata->procedure_json);
                $price_charge       = $proprice->price_charge;
                $price_procedure    = $proprice->price_procedure;

                $all_income = $all_income+$price_charge;
                $all_payout = $all_payout+$price_procedure;

                if($rightto->name==null){
                    $righto_name    = "ไม่ใช้สิทธิ";
                    $rrt_price      = 0;
                }else{
                    $righto_name = $rightto->name;
                    if($rightto->id==1){$rrt_price=$proprice->rtt_insurance_social;}
                    if($rightto->id==2){$rrt_price=$proprice->rtt_government;}
                    if($rightto->id==3){$rrt_price=$proprice->rtt_insurance_health;}
                    if($rightto->id==4){$rrt_price=$proprice->rtt_insurance_foreign;}
                    if($rightto->id==5){$rrt_price=0;}
                }

                $price_rrt = $price_charge+$rrt_price;

                $i = 1;
                foreach($acc as $a => $b){
                    if($b->id!=null){

                        $itemuse = DB::table('accessory')->where('accessory_id',$b->id)->first();

                        $item[$i]['accessory_name']       = $itemuse->accessory_name;
                        $item[$i]['accessory_price']      = $itemuse->accessory_price;
                        $item[$i]['accessory_sale']       = $itemuse->accessory_sale;
                        if($b->qty==null){

                            $item[$i]['qty']              = 1;
                            $item[$i]['total_price']      = $itemuse->accessory_price;
                            $item[$i]['total_sale']       = $itemuse->accessory_sale;
                            $all_income = $all_income+$itemuse->accessory_price;
                            $all_payout = $all_payout+$itemuse->accessory_sale;
                        }else{
                            $item[$i]['qty']              = $b->qty;
                            $item[$i]['total_price']      = $itemuse->accessory_price * $b->qty;
                            $item[$i]['total_sale']       = $itemuse->accessory_sale * $b->qty;
                            $all_income = $all_income+$itemuse->accessory_price * $b->qty;
                            $all_payout = $all_payout+$itemuse->accessory_sale * $b->qty;
                        }

                    }
                    $i++;
                }
            @endphp




    <table border="1" width="100%">
        <tr><td colspan="3">รายรับ</td></tr>
        <tr><td>รายการ</td><td width="100">จำนวน</td><td width="200">ราคา</td></tr>
        <tr><td>{{$casedata->procedure_name}} ({{$righto_name}} {{$rrt_price}})</td><td>1</td><td> {{$price_rrt}}</td></tr>


        @foreach($item as $t=>$r)
            <tr><td>{{$r['accessory_name']}}</td><td>{{$r['qty']}}</td><td>{{$r['total_price']}}</td></tr>
        @endforeach


        <tr>
            <td colspan="2">icd 9</td>

            <td width="200"></td>
        </tr>



    @php
        $acc        = jsonDecode($casedata->icd9);
        $dino       = jsonDecode($casedata->proicd9);
        $dino_other = jsonDecode($casedata->proicd9_other);
        $proicd9count = 0;
    @endphp


    @php
        foreach($dino as $di => $value){
            $variebletype =  gettype($value);

            if($variebletype=="string"){
                if($casedata->proicd9!=""){
                    $proicd9count++;
                }
            }

            if($variebletype=="object"){
                foreach($value as $v){
                    if($v!=null){
                        $proicd9count++;
                    }
                }
            }
        }
    @endphp


    @if($casedata->proicd9_other!=""
    || $proicd9count>0
    || $casedata->overall_procedure!="")

    <font>

    @php
        $dval = "";
        $i=100;
    @endphp

    @if($casedata->proicd9_other!="" || $proicd9count>0)
        @forelse($dino as $di => $value)
            @php
            $variebletype = gettype($value);
            if($variebletype=="object"){
                $i--;
                foreach ($value as $key=>$v) {
                    $table = DB::table('tb_procedureicd9')->where('proicd9_name','=',$old)->first();
                    if($v!=""){
                        $val[$i] = "<tr><td>aaaaaaaaaaaaaaa".$table->icd9."</td><td>&nbsp;&nbsp;&nbsp;</td><td>".$old." ".$v." ".$table->extra_text."</td></tr>";
                    }
                }
                $i++;
            }else{
                if($value!=""){
                    $table = DB::table('tb_procedureicd9')->where([['proicd9_name','=',$value],['procedure_code',$casedata->case_procedure]])->first();


                    $icd9_rrt = (array) jsonDecode($table->icd9_json);

                    if($rightto->name==null){
                        $icd9_price     = 0;
                    }else{
                        if($rightto->id==1){$icd9_price=$icd9_rrt['rtt_insurance_social'];}
                        if($rightto->id==2){$icd9_price=$icd9_rrt['rtt_government'];}
                        if($rightto->id==3){$icd9_price=$icd9_rrt['rtt_insurance_health'];}
                        if($rightto->id==4){$icd9_price=$icd9_rrt['rtt_insurance_foreign'];}
                        if($rightto->id==5){$icd9_price=0;}
                        if($icd9_price==null){$icd9_price=0;}
                        $all_income = $all_income+$icd9_price;
                    }



                    $val[$i] = "<tr><td>".$value."</td><td>1</td><td>".$icd9_price."</td></tr>";
                    $old = $value;
                    $i++;
                }
            }
            @endphp
        @empty

        @endforelse


        @if(isset($val))
            @forelse($val as $v)
                {!!$v!!}
            @empty
            @endforelse
        @endif


        @forelse($dino_other as $di)
            @if($di!="")

                <tr><td></td><td>&nbsp;&nbsp;&nbsp;</td><td>{{$di}}</td></tr>

            @endif
        @empty
        @endforelse

        @foreach ($acc as $a)
            @if($a!="")
                @php
                $icd = explode("     ", $a);
                @endphp
                <tr>
                <td valign="top">{{$icd[0]}}</td><td>&nbsp;&nbsp;&nbsp;</td>
                <td>{{$icd[1]}}</td>
                </tr>
            @endif
        @endforeach

        @endif


        </font>

        <font>{!!@$casedata->overall_procedure!!}</font>
        @php
        @endphp
        @else
            None
        @endif












        <br>
        @if($casedata->Bronchial_Washing_site!="")
        <font color="#E4310B">Bronchial Washing site   :</font>
            {{$casedata->Bronchial_Washing_site}}<br>
        @endif

        @if($casedata->Bronchoalveolar_Lavage_site!="")
        <font color="#E4310B">Bronchoalveolar Lavage site   :</font>
            {{$casedata->Bronchoalveolar_Lavage_site}}<br>
                [
                    @if($casedata->Instilled_volume!="")
                    <font color="#E4310B">Instilled vol.  :</font>{{$casedata->Instilled_volume}}
                    @endif

                     @if($casedata->Retrived_volume!="")
                    <font color="#E4310B">Retrived vol.   :</font>{{$casedata->Retrived_volume}}
                    @endif

                    @if($casedata->AM!="")
                    <font color="#E4310B">AM   :</font>{{$casedata->AM}}%
                    @endif

                    @if($casedata->N!="")
                    <font color="#E4310B">N   :</font>{{$casedata->N}}%
                    @endif

                    @if($casedata->L!="")
                    <font color="#E4310B">L   :</font>{{$casedata->L}}%
                    @endif

                    @if($casedata->E!="")
                    <font color="#E4310B">E   :</font>{{$casedata->E}}%
                    @endif
                ]<br>
        @endif


        @if($casedata->Bronchial_Biopsy_site!="")
        <font color="#E4310B">Bronchial Biopsy site   :</font>
            {{$casedata->Bronchial_Biopsy_site}}<br>
        @endif

        @if($casedata->Transbronchial_lung_Biopsy_site!="")
        <font color="#E4310B">Transbronchial lung Biopsy site   :</font>
            {{$casedata->Transbronchial_lung_Biopsy_site}}<br>
        @endif

        @if($casedata->Transbronchial_Needle_Aspiration_for_Cytology_site!="")
        <font color="#E4310B">TBNA for Cytology site   :</font>
            {{$casedata->Transbronchial_Needle_Aspiration_for_Cytology_site}}<br>
        @endif

        @if($casedata->Transbronchial_Needle_Aspiration_for_Histology_site!="")
        <font color="#E4310B">TBNA for Histology site   :</font>
            {{$casedata->Transbronchial_Needle_Aspiration_for_Histology_site}}<br>
        @endif

        @if($casedata->Bronchial_Brushing_site!="")
        <font color="#E4310B">Bronchial Brushing site   :</font>
            {{$casedata->Bronchial_Brushing_site}}<br>
        @endif

        @if($casedata->Laser_Bronchoscopy_energy!="")
        <font color="#E4310B">Laser Bronchoscopy energy   :</font>
            {{$casedata->Laser_Bronchoscopy_energy}}<br>
        @endif

        @if($casedata->otherprocedure!="")
        <font color="#E4310B">Other procedure   :</font>
            {!!$casedata->otherprocedure!!}
        @endif


        <tr>
            <td colspan="3" align="right">รวม {{$all_income}}</td>
        </tr>

    </table>

    <br>
    ----------------------
    <br>

    <table border="1" width="100%">
        <tr><td colspan="3">รายจ่าย</td></tr>
        <tr><td>รายการ</td><td width="100">จำนวน</td><td width="200">ราคา</td></tr>
        <tr><td>{{$casedata->procedure_name}}</td><td>1</td><td> {{$price_procedure}}</td></tr>
        @foreach($item as $t=>$r)
            <tr><td>{{$r['accessory_name']}}</td><td>{{$r['qty']}}</td><td>{{$r['total_sale']}}</td></tr>
        @endforeach
        <tr>
            <td colspan="3" align="right">รวม {{$all_payout}}</td>
        </tr>
    </table>

@php
    $sum = $all_income - $all_payout;
@endphp

    <br>


    <table border="1" width="100%">
        <tr><td colspan="3">คงเหลือ</td></tr>
        <tr>
            <td colspan="3" align="right">รวม {{$sum}}</td>
        </tr>
    </table>



</td>
</tr>


    </table>

</body>
