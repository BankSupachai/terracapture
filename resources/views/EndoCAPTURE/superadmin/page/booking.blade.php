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
                        <h3 class="text-primary">Booking</h5>
                    </div>
                    <div class="col-12">
                        &nbsp;
                    </div>

                    <div class="col-6">
                        <div class="row m-0 ">


                            <div class="col-6 ">
                                <span class="h4">สร้าง Create ล่วงหน้าแล้วเข้า booking</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"booking","name"=>"","id"=>"futureinbooking"])  @endcomponent
                            </div>


                            <div class="col-6 ">
                                <span class="h4">ไม่ถามประวัติ หน้า Booking</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"booking","name"=>"","id"=>"noask"])  @endcomponent
                            </div>




                            <div class="col-6 ">
                                <span class="h4">History taking01</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"booking","name"=>"","id"=>"history_taking01"])  @endcomponent
                            </div>

                            <div class="col-6 ">
                                <span class="h4">History taking02</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"booking","name"=>"","id"=>"history_taking02"])  @endcomponent
                            </div>



                            <div class="col-6 ">
                                <span class="h4">Appoint card</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"booking","name"=>"","id"=>"appointcard"])  @endcomponent
                            </div>



                            <div class="col-6 ">
                                <span class="h4">ปุ่ม Print ตอนสร้าง booking</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"booking","name"=>"","id"=>"btn_print"])  @endcomponent
                            </div>


                        </div>





                    </div>
                    <div class="col-6">
                        <div class="row m-0">
                            <div class="col-6 ">
                                <span class="h4">Photo caseuniq</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"feature"     ,"name"=>""          ,"id"=>"photocaseuniq"])  @endcomponent
                            </div>
                        </div>
                        <div class="row m-0">
                            <div class="col-6">
                                <span class="h4">Period wording (Service)</span>

                            </div>
                            <div class="col-6">

                                @component($textbox, ['type' => 'booking', 'name' => '', 'id' => 'period_service']) @endcomponent
                            </div>
                        </div>
                        <div class="row m-0">
                            <div class="col-6">
                                <span class="h4">Period wording (Special)</span>

                            </div>
                            <div class="col-6">

                                @component($textbox, ['type' => 'booking', 'name' => '', 'id' => 'period_special']) @endcomponent
                            </div>
                        </div>
                        <div class="row m-0">
                            <div class="col-6">
                                <span class="h4">Period wording (overtime)</span>

                            </div>
                            <div class="col-6">

                                @component($textbox, ['type' => 'booking', 'name' => '', 'id' => 'period_overtime']) @endcomponent
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
