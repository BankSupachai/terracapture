@php
$path =  str_replace("�","0",$_GET['path']);

//$url = "HYPER_DATA/";
//$url = "D:\\xampp\htdocs\\endocapture\public\HYPER_DATA\\";
//$url = "D:\\laragon\htdocs\\HYPER_DATA\\";
$url = $path;

$portnumber = portnumber();
// $endo4 = "http://endocapture/endocapture/public/HYPER_DATA/".$path;
$endo4 = url("HYPER_DATA/").$path;

$files1 = array();

try {
    //code...
    $files1 = scandir($url);

} catch (\Throwable $th) {
    //throw $th;
}

@endphp

@foreach($files1 as $f)
    @php
        $pic = strpos($f,".jpg");
        $pt = strpos($f,"pt");
        $name =  "$endo4/$f";
        $new = str_replace("D:\\laragon\\htdocs\\HYPER_DATA","",$name);
        $new = str_replace("\\","/",$new);
        $new = str_replace("endocapture5.0/","",$new);
    @endphp


    @if($pic>0 && $pt>0)
        <div class="col-12">
        <img src="{{$new}}" width="100%">
        {{--<font size='2'>{{$new}}</font>--}}
        </div>
    @endif
@endforeach


