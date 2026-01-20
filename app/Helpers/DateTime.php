<?php

function baseDAY(){
    $data = ['01','02','03','04','05','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24','25','26','27','28','29','30','31'];
    return $data;
}

function baseMONTH(){
    $data = ['01','02','03','04','05','06','07','08','09','10','11','12'];
    return $data;
}

function case_book_text($text){
    $text_show = '';
    if($text=='service'){
        $text_show = 'Service';
    }elseif($text=='special'){
        $text_show = 'Special';
    }elseif($text=='premium'){
        $text_show = 'Premium';
    }elseif($text=='am'){
        $text_show = 'AM.';
    }elseif($text=='pm'){
        $text_show = 'PM.';
    }elseif($text=='ot'){
        $text_show = 'OT.';
    }elseif($text=='elective'){
        $text_show = 'Elective.';
    }elseif($text=='urgency'){
        $text_show = 'Urgency.';
    }elseif($text=='ga'){
        $text_show = 'GA';
    }elseif($text=='sedation'){
        $text_show = 'Sedation';
    }elseif($text=='la'){
        $text_show = 'LA';
    }elseif($text=='flu'){
        $text_show = 'Flu';
    }elseif($text=='spyglass'){
        $text_show = 'Spyglass';
    }elseif($text=='laser'){
        $text_show = 'Spyglass';
    }else{
        $text_show = $text;
    }
    return $text_show;
}

function baseYEARTHAI(){
    $data       = array();
    $yearthai   = intval(date('Y')+543);
    $yearthai120= intval(date('Y')+543)-120;
    for($i=$yearthai;$i>=$yearthai120;$i--)
    {
        array_push($data,$i);
    }
    return $data;
}

//Show Date with user timezone
if (! function_exists('input_color')) {
    function input_color($date, $class)
    {
        if(isset($data)){
            if($data!=''){
                return $class;
            }
        }
    }
}


function getDates($year)
{
    $dates = array();
    $m = intval(date('m'));
    date("L", mktime(0,0,0, 7,7, $year)) ? $days = 366 : $days = 365;
    for($i = 1; $i <= $days; $i++){
        if($i==$days){
            $years = $year+1;
        }
        $month = date('m', mktime(0,0,0,1,$i,$year));
        $wk = date('W', mktime(0,0,0,1,$i,$year));
        $wkDay = date('D', mktime(0,0,0,1,$i,$year));
        $day = date('d', mktime(0,0,0,1,$i,$year));
        if(intval($month)>=$m){
            $dates[$month][$wk][$wkDay] = $day;
        }
    }
    date("L", mktime(0,0,0, 7,7, $years)) ? $days = 366 : $days = 365;
    for($i = 1; $i <= $days; $i++){
        $month = date('m', mktime(0,0,0,1,$i,$years));
        $wk = date('W', mktime(0,0,0,1,$i,$years));
        $wkDay = date('D', mktime(0,0,0,1,$i,$years));
        $day = date('d', mktime(0,0,0,1,$i,$years));
        if(intval($month)<$m){
            $dates[$month][$wk][$wkDay] = $day;
        }
    }
    return $dates;
}

//Show Date with user timezone
if (! function_exists('show_date')) {
    function show_date($date, $format="d/m/Y H:i")
    {
        if(!($date instanceof \Carbon\Carbon)) {
            if(is_numeric($date)) {
                 // Assume Timestamp
                 $date = \Carbon\Carbon::createFromTimestamp($date);
            } else {
                $date = \Carbon\Carbon::parse($date);
            }
        }

        return $date->setTimezone(Auth::user()->timezone)->format($format);
    }
}

//Set Datetime to insert_db
if (! function_exists('insert_db_date')) {
    function insert_db_date($date, $format="Y-m-d H:i:s")
    {
        $output_timezone = \Config::get('app.timezone', 'UTC');
        $date = \Carbon\Carbon::parse($date);
        return \Carbon\Carbon::createFromFormat($format, $date->format($format), Auth::user()->timezone)->setTimezone($output_timezone)->format('Y-m-d H:i:s');
    }
}

function swapDate($date){

    $x = explode(' ',$date);

    $ex = explode('-',$x[0]);
    $et = explode(' ',@$ex[2]);
    $new = $et[0].'-'.@$ex[1].'-'.$ex[0];
    return $new;
}


function date_thaiformat($date,$symbol){
    $ex     = explode('-',$date);
    $year   = $ex[2]+ 543;
    $new    = $ex[0].$symbol.$ex[1].$symbol.$year;
    return $new;
}

# จัดภาพ
if (! function_exists('tablePICPDF')) {
    function tablePICPDF($column,$image,$size)
    {
        $str = "";
        $str.= "<table class='set-num-image'>";
        $x = 1;
        $count = 1;
        foreach($image as $img){
            if($x==1){$str.="<tr style='vertical-align: top;'>";}
            $str.="<td>";
            $str.="<table>";
            $str.="<tr style='vertical-align: top;'> ";
            $str.="<td> <img src='".$img['name']."' $size ></td>";
            $str.="</tr>";

            if($img['tx']!="mainpart"){
                if($img['sc']!=""){
                    $str.="<tr style='font-size: 10px;'>";
                    $str.="<td style='line-height:8px; '>";
                    $str.='['.$count.']';
                    $str.=$img['sc']."<br>";
                    $str.=$img['tx'];
                    $str.="</td>";
                    $str.="</tr>";
                }else{
                    $str.="<tr style='font-size: 10px'>";
                    $str.="<td style='line-height:8px; '>";
                    $str.='['.$count.']';
                    $str.=$img['tx'];
                    $str.="</td>";
                    $str.="</tr>";
                }
            }






            $str.="</table>";
            $str.="</td>";
            $str.="<td>";
            $str.="</td>";
            if($x==$column){$str.="</tr>";$x=0;}
            $x++;
            if($img['tx']!="mainpart"){$count++;}
        }
        $str.="</table>";
        return $str;
    }
}


if (! function_exists('tablefixnumberstart')) {
    function tablefixnumberstart($column,$image,$size,$start)
    {
        $str = "";
        $str.= "<table class='set-num-image'>";
        $x = 1;
        $count = $start;
        foreach($image as $img){
            if($x==1){$str.="<tr style='vertical-align: top;'>";}
            $str.="<td>";
            $str.="<table>";
            $str.="<tr style='vertical-align: top;'>";
            $str.="<td><img src='".$img['name']."' $size></td>";
            $str.="</tr>";

            if($img['tx']!="mainpart"){
                if($img['sc']!=""){
                    $str.="<tr>";
                    $str.="<td style='line-height:8px;'>";
                    // $str.='['.$count.']';
                    $str.=$img['sc']."<br>";
                    $str.=$img['tx'];
                    $str.="</td>";
                    $str.="</tr>";
                }else{
                    $str.="<tr>";
                    $str.="<td style='line-height:8px;'>";
                    // $str.='['.$count.']';
                    $str.=$img['tx'];
                    $str.="</td>";
                    $str.="</tr>";
                }
            }






            $str.="</table>";
            $str.="</td>";
            $str.="<td>";
            $str.="</td>";
            if($x==$column){$str.="</tr>";$x=0;}
            $x++;
            if($img['tx']!="mainpart"){$count++;}
        }
        $str.="</table>";
        return $str;
    }
}


if (! function_exists('tablePICPDF_new')) {
    function tablePICPDF_new($column,$image,$size)
    {
        $str = "";
        $x = 1;
        $count = 1;
        foreach($image as $img){
            if($x==1||$x==4){
                $str.= "<table>";
            }
            if($x==1){$str.="<tr>";}
            $str.="<td>";

            if($img['tx']!="mainpart"){
                $str.="<table style=''>";
                $str.="<tr>";
                $str.="<td><img src='".$img['name']."' $size></td>";
                $str.="</tr>";
            }else{
                $str.="<table style=''>";
                $str.="<tr>";
                $str.="<td><img src='".$img['name']."' width='180px'></td>";
                $str.="</tr>";
            }

            if($img['tx']!="mainpart"){
                $str.="<tr>";
                $str.="<td style='line-height:8px;'>";
                if($img['sc']!=0 && $img['sc']!="" && $img['sc']!=null){
                    $tb_mainpartsub = DB::table('tb_mainpartsub')->where('mainpartsub_id',$img['sc'])->first();
                    $mainsub = $tb_mainpartsub->mainpartsub_name."<br>";
                }else{
                    $mainsub = "";
                }
                $str.='['.$count.'] ';
                $str.=$mainsub;
                $str.=$img['tx'];
                $str.="</td>";
                $str.="</tr>";
            }

            $str.="</table>";
            $str.="</td>";
            $str.="<td>";
            $str.="</td>";
            if($x==$column){$str.="</tr>";}
            if($x==1||$x==4){
                $str.= "</table>";
            }
            if($x==$column){$x=0;}
            $x++;
            if($img['tx']!="mainpart"){$count++;}
        }
        // $str.="</table>";
        return $str;
    }
}


function TimeDiff($strTime1,$strTime2)
{
    if($strTime2 == null){
        return 0;
    }
    return(strtotime($strTime2)-strtotime($strTime1))/(60*60); // 1 Hour =  60*60
}

function minuteDiff($strTime1,$strTime2)
{
    if($strTime2 == null){
        return 0;
    }
    return abs((strtotime($strTime2)-strtotime($strTime1))/(60)); // 1 Hour =  60*60
}

function CalMINUTE($start,$end){
    $to_time    = strtotime($start);
    $from_time  = strtotime($end);
    $minute     = round(abs($to_time - $from_time) / 60,0);
    return $minute;
}




# เว้นวรร
if (! function_exists('datefiff')) {
    function datefiff($date_now)
    {
        try{
            $date_1 = new DateTime( $date_now );
            $date_2 = new DateTime( date( 'Y-m-d' ) );
            $difference = $date_2->diff( $date_1 );
            $date_echo = (string)$difference->y;
            echo (string)$difference->y;
        }catch(\Throwable $e){
            echo 0;
        }
    }
}


if (! function_exists('nbsp')) {
    /**
     * Function เว้นวรร
     * @param  $num คือจำนวนเว้นวรร
     * @param  Create by mos
     */
    function nbsp($num)
    {
        for($i=1;$i<=$num;$i++){
            echo "&nbsp;";
        }
    }
}
# เว้นวรร

# ตรวจค่าว่าง
if (! function_exists('check_val')) {
    function check_val($val,$text)
    {
        if(!isset($val) || $val==""){
            echo $text;
        }else{
            echo $val;
        }
    }
}
# ตรวจค่าว่าง
#
if (! function_exists('check_sky')) {
    function check_sky($val)
    {
        if(isset($val)){
            if($val != ''){
                echo "background: #d2ebf6;";
            }
        }
    }
}

if (! function_exists('data_check_bg')) {
    function data_check_bg($val)
    {
        if(isset($val)){
            if($val != ''){
                echo "bg-soft-info";
            }
        }
    }
}
if (! function_exists('data_check_active')) {
    function data_check_active($val,$type)
    {
        if($type=='auto'){
            if(@$val !='false'){
                echo "active";
            }
        }else{
            if(@$val =='true'){
                echo "active";
            }
        }
    }
}

if (! function_exists('icon')) {
    function icon($url,$name,$type)
    {
        echo "<img width='7px' src=$url/public/image/$name.$type>";
    }
}

//Set Datetime to insert_db
if (! function_exists('age')) {
    function age($birthdate)
    {
        $age = "";
        try {
            if(isset($birthdate)){
                if($birthdate!="")
                {
                    $date   = new DateTime($birthdate);
                    $now    = new DateTime();
                    $interval = $now->diff($date);
                    $age    = $interval->y;
                // dd($date, $now, $birthdate);

                }
            }
        } catch(\Throwable $e) {

        }
        return $age;
    }
}


function ageWARRANTEE($birthdate)
{
    $age = "";
    if(isset($birthdate)){
        if($birthdate!="")
        {
            $date   = new DateTime($birthdate);
            $now    = new DateTime();
            $interval = $now->diff($date);
            $age    = $interval;
        }
    }
    return $age;
}
function age_form_bd($birthdate)
{
    $age = "";
    if(isset($birthdate)){
        if($birthdate!="")
        {
            $date   = new DateTime($birthdate);
            $now    = new DateTime();
            $interval = $now->diff($date);
            $age    = $interval->y;
        }
    }
    return $age;
}


function yearALL(){
    $year_start = intval(getCONFIG("admin")->year_install);
    $year_end   = date('Y');
    for($i=$year_start;$i<=$year_end;$i++){
        $year_all[] = $i;
    }
    return $year_all;
}


function DateThai($strDate)
{
    $strYear = date("Y",strtotime($strDate))+543;
    $strMonth= date("n",strtotime($strDate));
    $strDay= date("j",strtotime($strDate));
    $strHour= date("H",strtotime($strDate));
    $strMinute= date("i",strtotime($strDate));
    $strSeconds= date("s",strtotime($strDate));
    // $strMonthCut = Array("","มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฏาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
    $strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
    $strdayName = Array("","จันทร์","อังคาร","พุธ","พฤหัสบดี","ศุกร์","เสาร์","อาทิตย์");

    $strMonthThai=$strMonthCut[$strMonth];
    // $strdaythai=$strdayName[$strDay];

    return " $strDay $strMonthThai $strYear";
}

function format_date($date_str, $type){
    if(isset($date_str)){
        $date = date_create($date_str);
        if ($date !== false){
            return date_format($date, $type);
        }else {
            return '';
        }
    } else {
        return '';
    }
}

function calculate_followup_str($date_compare, $date_now){
    $date1 = new DateTime($date_compare);
    $date2 = new DateTime($date_now);

    $days = $date2->diff($date1)->format('%r%d');

    if($days == "0") {
        return 'Today';
    } else if($days === "-1") {
        return 'yesterday';
    } else if ($days === "1"){
        return 'Tomorrow';
    } else if (intval($days) > 0 && intval($days) < 7) {
        return $days . ' days';
    } else if (intval($days) < 0 && intval($days) > -7) {
        return abs(intval($days)) . ' days ago';
    } else {
        $date = date_create($date_compare);
        return date_format($date,"d M, Y");
    }
}

function format_datestr($time_str){
    $str = '';
    if(isset($time_str) && $time_str != ''){
        for ($i=0; $i <= 5; $i++) {
            $char = isset($time_str[$i]) ? $time_str[$i] : '0';
            if($i == 1 || $i == 3){
                $special  = ':';
            } else {
                $special  = '';
            }
            $str  = $str.$char.$special;

        }
    }
    return $str;
}


function adddate($date , $day)
{
    $aaa = new DateTime($date);
    $aaa->add(new DateInterval("P".$day. 'D'));
    $bbb = $aaa->format('Y-m-d');
    return $bbb;
}
