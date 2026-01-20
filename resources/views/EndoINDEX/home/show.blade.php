<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src='{{url('resources/box/js/box.js')}}'></script>
<script>
$(document).ready(function(){

    $("#btn1").click(function(){
        alert("Text: " + $("#test").text());
    });

    $("#btn2").click(function(){
        $.post("{{url('boxframework')}}",{
            event:"test",
        },function(data,status){
            box('#dayu',data,'{{url('resources/box/endocapture/home/testloop.html')}}');
        });
    });


});
</script>
</head>


<body>

<p id="flow">This is some <b>bold</b> text in a paragraph.</p>

<button id="btn1">Show Text</button>
<button id="btn2">Show HTML</button>
<div id="dayu"></div>
</body>
</html>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
