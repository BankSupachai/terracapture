@extends('layouts.app')
@section('title', 'EndoINDEX')
@section('style')
    <link href="{{ url('public/extra/esign/colorpicker.css') }}" rel="stylesheet">
    <link href="{{ url('public/extra/esign/literally.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <style type="text/css">
        body {
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            margin: 0;
        }
        .fs-container {
            width: 100%;
            height: 100%;
            margin: auto;
        }
        .literally {
            width: 100%;
            height: 70vh;
        }
        #canvas{
            width: 100%;
            height: 70vh;
        }
        .toolbar{
            display:none;
        }
    </style>
@endsection



@section('content')
<div class="row m-0">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <div class="literally">
                            <canvas id="canvas"></canvas>
                        </div>
                    </div>
                    <div class="col-12">
                        <h1>{{@$user->user_prefix}}{{@$user->user_firstname}}&nbsp;&nbsp;{{@$user->user_lastname}}</h1>
                        <div class="form-group">
                            <label>ชื่อ - นามสกุล</label>
                            <input id="user_fullname" type="text" name="user_fullname" class="form-control" placeholder="ชื่อ - นามสกุล">
                        </div>
                        <div class="form-group">
                            <label>Doctor Code</label>
                            <input id="user_code" type="text" name="user_code" class="form-control" placeholder="เลข ว.">
                        </div>
                        <div class="form-group">
                            <label>โรงพยาบาล</label>
                            <input id="hospital_name" type="text" name="user_code" class="form-control" placeholder="โรงพยาบาล">
                        </div>
                        <div class="form-group">
                            <button id="btn_submit" class="btn btn-primary btn-block" type="submit">บันทึก</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script src="{{ url('public/extra/esign/literallycanvas.fat.js') }}"></script>
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function() {
        $(document).bind('touchmove', function(e) {
            var canvas  = document.getElementById('canvas');
            var dataURL = canvas.toDataURL();





            // if (e.target === document.documentElement) {
            //     alert()
            // }
        });
        $('.literally').literallycanvas();
    });





    $('#btn_submit').click(function() {
        var canvas  = document.getElementById('canvas');
        var dataURL = canvas.toDataURL();




        var user_code       = $("#user_code").val();
        var user_fullname   = $("#user_fullname").val();
        var hospital_name   = $("#hospital_name").val();

        if(user_code!="" && user_fullname!="" && hospital_name!=""){
            $.post('{{ url('api/esign') }}', {
                event           : 'create_sign_doctor',
                user_code       : user_code,
                user_fullname   : user_fullname,
                hospital_name   : hospital_name,
                datapic         : dataURL
            }, function(data, status) {
                window.location.replace("{{url("api/esign/complete")}}");
            });
        }else{
            alert("Data not complete.")
        }

    });
</script>






@endsection
