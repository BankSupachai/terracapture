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
                                <span class="h4">Appointment Detail</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"tablet","name"=>"","id"=>"appointmentdetail"])  @endcomponent
                            </div>



                            <div class="col-6 ">
                                <span class="h4">Operation Record</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"tablet","name"=>"","id"=>"operationrecord"])  @endcomponent
                            </div>



                            <div class="col-6 ">
                                <span class="h4">Nurse record</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"tablet","name"=>"","id"=>"nurserecord"])  @endcomponent
                            </div>


                            <div class="col-6 ">
                                <span class="h4">Billing record</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"tablet","name"=>"","id"=>"billingrecord"])  @endcomponent
                            </div>

                            <div class="row">
                                <div class="col-12 ">
                                    <h3 class="text-primary"> Menu : </h3>
                                </div>
                                <div class="col-6 ">
                                    <span class="h4">Booking list</span>
                                </div>
                                <div class="col-6 text-center">

                                    @component($swicth,["type"=>"tablet","name"=>"","id"=>"booking_menu"])  @endcomponent

                                </div>
                                <div class="col-6 ">
                                    <span class="h4">Case Control</span>
                                </div>
                                <div class="col-6 text-center">
                                    @component($swicth,["type"=>"tablet","name"=>"","id"=>"casecontrol_menu"])  @endcomponent
                                </div>

                                <div class="col-6 ">
                                    <span class="h4">Case list</span>
                                </div>
                                <div class="col-6 text-center">
                                    @component($swicth,["type"=>"tablet","name"=>"","id"=>"caselist_menu"])  @endcomponent
                                </div>
                                <div class="col-6 ">
                                    <span class="h4">Viewer History</span>
                                </div>
                                <div class="col-6 text-center">
                                    @component($swicth,["type"=>"tablet","name"=>"","id"=>"viewer_menu"])  @endcomponent
                                </div>
                                <div class="col-6 ">
                                    <span class="h4">Scope management</span>
                                </div>
                                <div class="col-6 text-center">
                                    @component($swicth,["type"=>"tablet","name"=>"","id"=>"scope_menu"])  @endcomponent
                                </div>
                                <div class="col-6 ">
                                    <span class="h4">Overall</span>
                                </div>
                                <div class="col-6 text-center">
                                    @component($swicth,["type"=>"tablet","name"=>"","id"=>"overall_menu"])  @endcomponent
                                </div>
                                <div class="col-6 ">
                                    <span class="h4">Data analyze</span>
                                </div>
                                <div class="col-6 text-center">
                                    @component($swicth,["type"=>"tablet","name"=>"","id"=>"dataanlyze_menu"])  @endcomponent
                                </div>
                            </div>
                        </div>





                    </div>
                    <div class="col-6">
                        <div class="row m-0">
                            <div class="col-6 ">
                                <span class="h4">History Taking 1</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"tablet"     ,"name"=>""          ,"id"=>"note_historytaking01"])  @endcomponent
                            </div>

                            <div class="col-6 ">
                                <span class="h4">History Taking 2</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"tablet"     ,"name"=>""          ,"id"=>"note_historytaking02"])  @endcomponent
                            </div>

                            <div class="col-6 ">
                                <span class="h4">Operation</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"tablet"     ,"name"=>""          ,"id"=>"note_operation"])  @endcomponent
                            </div>

                            <div class="col-6 ">
                                <span class="h4">Recovery</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"tablet"     ,"name"=>""          ,"id"=>"note_recovery"])  @endcomponent
                            </div>

                            <div class="col-6 ">
                                <span class="h4">Follow-Up</span>
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
