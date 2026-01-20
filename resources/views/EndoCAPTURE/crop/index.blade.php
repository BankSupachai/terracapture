@php
    $cid        = $_GET['cid'];
    $hn         = $_GET['hn'];
    $photoname  = $_GET['photoname'];
    $folderdate = $_GET['folderdate'];
    $caseuniq   = $_GET['caseuniq'];
    $ppic       = $_GET['ppic'];

@endphp

<html>
<head>
<title>EndoINDEX</title>
<link href="{{asset('public/images/favicon.png')}}"                                rel="shortcut icon">
<link rel="stylesheet" href="{{url("public/crop_img/jquery.Jcrop.min.css")}}" type="text/css" />
<script src="{{url("public/crop_img/jquery.min.js")}}"></script>
<script src="{{url("public/crop_img/jquery.Jcrop.min.js")}}"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link href="{{asset('public/css/bootstrap.min.css')}}"  rel="stylesheet" type="text/css"/>
<link href="{{asset('public/css/crop/index.css')}}"     rel="stylesheet" type="text/css"/>

</head>
<body>

<div class="row m-0" id="header">
    <div class="col-lg-3">
        <a onclick="goBack()" class="btn btn-outline-primary btn-lg w-100"><img src="{{url('public/image/back.png')}}" class="icon-img"> ย้อนกลับ</a>
    </div>
    <div class="col-lg-3">
        <a id="drawrenew" class="btn btn-outline-warning btn-lg w-100"><img src="{{url('public/image/archeology.png')}}" class="icon-img"> Clear</a>
    </div>
    <div class="col-lg-3">
        <a id="crop" class="btn btn-outline-success btn-lg w-100"><img src="{{url('public/image/selection-tool.png')}}" class="icon-img"> CROP</a>
    </div>
    <div class="col-lg-3">
        <a id="cropall" class="btn btn-outline-info btn-lg w-100"><img src="{{url('public/image/layers.png')}}" class="icon-img"> CROP ALL</a>
    </div>
    {{-- <div id="btn" class="col-lg-6"> --}}
</div>
<br>
<br>
<div class="row mt-5 m-0">
    <div class="col-lg-12 text-center mt-3">
        <span class="draw-img">
            <img src="{{picurl("$hn/$folderdate/$photoname")}}" photoname="{{$photoname}}" id="cropbox" class="img"/>​<br />
        </span>
    </div>
</div>
<br>







<div>
    <img src="#" id="cropped_img" style="display: none;">
</div>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>



<script type="text/javascript">






$(document).ready(function(){
    var size;
    var mm;
    $('#cropbox').Jcrop({
      aspectRatio: 0,
      onSelect: function(c){
        size = {x:c.x,y:c.y,w:c.w,h:c.h};
        console.log(size);
       $("#crop").css("visibility", "visible");
       $("#cropall").css("visibility", "visible");

      }
    });

    $("#crop").click(function(){
        $.post('{{url('crop')}}', {
            event       : 'crop_single',
            folderdate  : '{{$folderdate}}',
            cid         : '{{$cid}}',
            hn          : '{{$hn}}',
            photoname   : '{{$photoname}}',
            img         : '{{picurl("$hn/$folderdate/$photoname")}}',
            x           : size.x,
            y           : size.y,
            w           : size.w,
            h           : size.h,
        }, function(data, status) {
            window.location='{{url("loadpic/$cid")}}';
        });
	});

    $("#cropall").click(function(){
        $.post('{{url('crop')}}', {
            event       : 'crop_all',
            cid         : '{{$cid}}',
            folderdate  : '{{$folderdate}}',
            hn          : '{{$hn}}',
            photoname   : '{{$photoname}}',
            img         : '{{picurl("$hn/$folderdate/$photoname")}}',
            x           : size.x,
            y           : size.y,
            w           : size.w,
            h           : size.h,
        }, function(data, status) {
            window.location='{{url("loadpic/$cid")}}';
        });
    });

    $("#drawrenew").click(function(e){
        var photoname = $('#cropbox').attr('photoname')
        $.post("{{ url('api/photomove') }}", {
            event       : 'drawclear',
            cid         : '{{ $cid }}',
            caseuniq    : '{{ $caseuniq }}',
            ppic        : '{{ $ppic }}',
            hn          : '{{ $hn }}',
            folderdate  : '{{$folderdate}}',
            picname     : photoname,
        },
        function(data, status) {
            window.location.reload()

        });

        // $.post("http://endo/endocapture/public/photomove",
        // {
        //     event : 'drawrenew',
        //     hn : '<?php echo $_GET['hn']; ?>',
        //     picname : '<?php echo $_GET['photoname']; ?>',
        // },
        // function(data,status)
        // {
        //     window.history.back();
        // });
    });


});
</script>

<script>
function goBack() {
    var protocol = window.location.protocol
    var host = window.location.hostname
    window.location.href = `${protocol}//${host}/endoindex/procedure/{{ $cid }}`
//   window.history.back();
}
</script>


</body>
</html>
