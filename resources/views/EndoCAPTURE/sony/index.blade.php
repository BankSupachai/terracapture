@php

@endphp

@extends('layouts.app')
@section('title', 'EndoINDEX')
@section('style')
@endsection

@section('content')






    <div class="row" style="margin: 0;margin-top:-0.5em;margin-bottom: 5em;">
        <div class="col-lg-12">
            <div class="card card-custom" style="width: 100%;">
                <div class="card-header" style="padding: 0;">
                    <div class="row">
                        <div class="col-12">
                            IP
                            <input type="text" class="form-control" id="ip" value="192.168.1.151">
                            <br><br><br>
                            CASE ID
                            <input type="text" class="form-control" id="cid">
                            HN
                            <input type="text" class="form-control" id="hn">
                            first name
                            <input type="text" class="form-control" id="firstname">
                            middle name
                            <input type="text" class="form-control" id="middlename">
                            last name
                            <input type="text" class="form-control" id="lastname">
                            gender
                            <input type="text" class="form-control" id="gender">
                            age
                            <input type="text" class="form-control" id="age">


                            <button type="button" class="btn btn-success sendapi" cname="com1">Send DATA</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection
@section('script')
    <script src="{{url('public/sample/assets/plugins/global/plugins.bundle.js')}}"></script>
    <script src="{{url('public/sample/assets/plugins/custom/prismjs/prismjs.bundle.js')}}"></script>
    <script src="{{url('public/sample/assets/js/scripts.bundle.js')}}"></script>
    <script src='{{url('resources/box/js/box.js')}}'></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <script>

        $(".sendapi").click(function (e) {
            var cname = $(this).attr("cname");
            var ip          = $("#ip").val();
            var cid         = $("#cid").val();
            var hn          = $("#hn").val();
            var firstname   = $("#firstname").val();
            var middlename  = $("#middlename").val();
            var lastname    = $("#lastname").val();
            var gender      = $("#gender").val();
            var age         = $("#age").val();






            console.log(cname);
            console.log(ip);


            $.post("{{url('api/sony')}}", {
                event   : "step01",
                caname  : cname,
                ip      : ip
            },function(data, status) {
                var obj = JSON.parse(data);
                console.log(obj);

                $.post("{{url('api/sony')}}", {
                    event       : "step02"      ,
                    token       : obj.token     ,
                    cid         : cid           ,
                    hn          : hn            ,
                    firstname   : firstname     ,
                    middlename  : middlename    ,
                    lastname    : lastname      ,
                    gender      : gender        ,
                    age         : age           ,
                    ip          : ip
                },function(data, status) {
                    console.log(data);
                    alert("success");
                });
            });




        });

    </script>
@endsection
