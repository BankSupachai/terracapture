@extends('capture.layoutv6')

@section('title', 'EndoINDEX')
@section('style')
<style>
    .row{
        padding: 0.5rem;
    }
</style>
@endsection
@section('content')
@php
$swicth     = "EndoCAPTURE.superadmin.component.switch";
$textbox    = "EndoCAPTURE.superadmin.component.textbox";

@endphp
@include('EndoCAPTURE.superadmin.component.marginstyle')
<div class="row m-0">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="col-12 mb-3">
                    <h2 style="text-align: center;">การเปิดปิดการใช้งานระบบหลัก</h2>
                </div>
               @include('EndoCAPTURE.superadmin.component.menutopbar')

                <div class="row  " id="set_menu_config">
                    <div class="col-12">
                        <h3 class="text-primary">Tablet</h5>
                    </div>
                    <div class="col-12">
                        &nbsp;
                    </div>

                    <div class="col-6">
                        <div class="row m-0 ">

                            <div class="col-6 ">
                                <span class="h4">ดึงคนไข้จาก HIS เท่านั้น</span>
                            </div>
                            <div class="col-6">
                                @component($swicth,["type"=>"his"     ,"name"=>""          ,"id"=>"patient_form_his"])  @endcomponent

                            </div>
                        </div>





                    </div>
                    <div class="col-6">
                        <div class="row m-0">
                            <div class="col-6 ">
                                <span class="h4">History Taking 1</span>
                            </div>

                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"tablet"     ,"name"=>""          ,"id"=>"note_followup"])  @endcomponent
                            </div>





                        </div>


                    </div>
                </div>


            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


$(".config_type").focusout(function(){
var value       = $(this).val();
var id          = $(this).attr('id');
var config_type = $(this).attr('config_type');
$.post("{{url('superadmin')}}",{
    event       : "config_type",
    config_type : config_type,
    id          : id,
    value       : value,
},function(data, status){});
});


$(".configtext").focusout(function(){
var value   = $(this).val();
var id      = $(this).attr('id');
$.post("{{url('jquery')}}",{
    event   : "configtext",
    id      : id,
    value   : value,
},function(data, status){});
});

$('.config_option').click(function(){
var id              = $(this).attr('id');
var config_type     = $(this).attr('config_type');
var value           = true;
if($(this).prop("checked")==false){value='false';}
$.post("{{url('jquery')}}",{
    event           : "configcheck",
    id              : id,
    config_type     : config_type,
    value           : value,
},function(data, status){console.log(data);});
});
</script>
@endsection
