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
                    <div class="col-6">
                        <div class="row">
                            <div class="col-12 mt-2">
                                <h3 class="text-primary">OPERATION MENU</h5>
                            </div>
                        </div>
                        {{-- <div class="row m-0">
                            <div class="col-6">
                                <span class="h4">Home</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"menu"     ,"name"=>""          ,"id"=>"menu_home"])  @endcomponent
                            </div>
                        </div> --}}
                        {{-- <div class="row m-0 ">
                            <div class="col-6 ">
                                <span class="h4">Booking</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"menu"     ,"name"=>""          ,"id"=>"menu_booking"])  @endcomponent
                            </div>
                        </div> --}}

                        <div class="row m-0">
                            <div class="col-6 ">
                                <span class="h4">Cases History</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"menu"     ,"name"=>""          ,"id"=>"menu_caselist"])  @endcomponent
                            </div>
                        </div>
                        {{-- <div class="row m-0">
                            <div class="col-6 ">
                                <span class="h4">Send to</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"menu"     ,"name"=>""          ,"id"=>"menu_sendto"])  @endcomponent
                            </div>
                        </div> --}}
                        {{-- <div class="row m-0">
                            <div class="col-6 ">
                                <span class="h4">Viewer
                                    History</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"menu"     ,"name"=>""          ,"id"=>"menu_viewer"])  @endcomponent
                            </div>
                        </div> --}}
                        {{-- <div class="row m-0">
                            <div class="col-6">
                                <span class="h4">Followup</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"menu"     ,"name"=>""          ,"id"=>"menu_followup"])  @endcomponent
                            </div>
                        </div> --}}
                        <div class="row">
                            <div class="col-12 mt-3">
                                <h3 class="text-primary">MANAGEMENT MENU</h5>
                            </div>
                        </div>


                        {{-- <div class="row m-0">
                            <div class="col-6">
                                <span class="h4">Case Control</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"menu"     ,"name"=>""          ,"id"=>"menu_casecontrol"])  @endcomponent
                            </div>
                        </div> --}}
                        {{-- <div class="row m-0">
                            <div class="col-6">
                                <span class="h4">Overall</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"menu"     ,"name"=>""          ,"id"=>"menu_overall"])  @endcomponent
                            </div>
                        </div> --}}

                        {{-- <div class="row m-0">
                            <div class="col-6">
                                <span class="h4">Scope Management</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"menu"     ,"name"=>""          ,"id"=>"menu_scope"])  @endcomponent
                            </div>
                        </div> --}}
                        <div class="row m-0">
                            <div class="col-6">
                                <span class="h4">Analysis</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"menu"     ,"name"=>""          ,"id"=>"menu_dataanalyze"])  @endcomponent
                            </div>
                        </div>
                        <div class="row m-0">
                            <div class="col-6">
                                <span class="h4">Export Data</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"menu"     ,"name"=>""          ,"id"=>"menu_export"])  @endcomponent
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mt-2">
                                <h3 class="text-primary">MONITOR MENU</h5>
                            </div>
                        </div>
                        <div class="row m-0">
                            <div class="col-6">
                                <span class="h4">Cases Monitor</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"menu"     ,"name"=>""          ,"id"=>"menu_case"])  @endcomponent
                            </div>
                        </div>
                        <div class="row m-0">
                            <div class="col-6">
                                <span class="h4">EMR</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"menu"     ,"name"=>""          ,"id"=>"menu_patient"])  @endcomponent
                            </div>
                        </div>
                        <div class="row m-0">
                            <div class="col-6">
                                <span class="h4">Storage Manager</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"menu"     ,"name"=>""          ,"id"=>"menu_store"])  @endcomponent
                            </div>
                        </div>
                        {{-- <div class="row m-0">
                            <div class="col-6">
                                <span class="h4">Incharge Monitor</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"menu"     ,"name"=>""          ,"id"=>"menu_incharge"])  @endcomponent
                            </div>
                        </div> --}}
                    </div>
                    <div class="col-6">
                        <div class="row">
                            <div class="col-12 mt-2 bank">
                                <h3 class="text-primary">ADMIN-MENU</h5>
                            </div>
                        </div>
                        {{-- <div class="row m-0">
                            <div class="col-6">
                                <span class="h4">Home</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"menu"     ,"name"=>""          ,"id"=>"menu_home"])  @endcomponent
                            </div>
                        </div> --}}
                        <div class="row m-0 ">
                            <div class="col-6 ">
                                <span class="h4">Hospital Setting</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"menu"     ,"name"=>""          ,"id"=>"menu_admin_hospital"])  @endcomponent
                            </div>
                        </div>

                        <div class="row m-0">
                            <div class="col-6 ">
                                <span class="h4">Procedure Setting</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"menu"     ,"name"=>""          ,"id"=>"menu_admin_procedure"])  @endcomponent
                            </div>
                        </div>
                        <div class="row m-0">
                            <div class="col-6 ">
                                <span class="h4">Department
                                    Setting</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"menu"     ,"name"=>""          ,"id"=>"menu_admin_department"])  @endcomponent
                            </div>
                        </div>
                        <div class="row m-0">
                            <div class="col-6">
                                <span class="h4">Doctor Setting (Book)</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"menu"     ,"name"=>""          ,"id"=>"menu_admin_doctorbook"])  @endcomponent
                            </div>
                        </div>



                        <div class="row m-0">
                            <div class="col-6">
                                <span class="h4">Department Setting (Book)</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"menu"     ,"name"=>""          ,"id"=>"menu_admin_department_book"])  @endcomponent
                            </div>
                        </div>

                        <div class="row m-0">
                            <div class="col-6">
                                <span class="h4">Createcollection</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"menu"     ,"name"=>""          ,"id"=>"menu_admin_collection"])  @endcomponent
                            </div>
                        </div>
                        <div class="row m-0">
                            <div class="col-6">
                                <span class="h4">User Setting</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"menu"     ,"name"=>""          ,"id"=>"menu_admin_User"])  @endcomponent
                            </div>
                        </div>
                        <div class="row m-0">
                            <div class="col-6">
                                <span class="h4">Scope Setting</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"menu"     ,"name"=>""          ,"id"=>"menu_admin_scope"])  @endcomponent
                            </div>
                        </div>

                        <div class="row m-0">
                            <div class="col-6">
                                <span class="h4">Room Setting</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"menu"     ,"name"=>""          ,"id"=>"menu_admin_room"])  @endcomponent
                            </div>
                        </div>
                        <div class="row m-0">
                            <div class="col-6">
                                <span class="h4">Case Setting</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"menu"     ,"name"=>""          ,"id"=>"menu_admin_case"])  @endcomponent
                            </div>
                        </div>
                        <div class="row m-0">
                            <div class="col-6">
                                <span class="h4">Worklist Procedure Setting</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"menu"     ,"name"=>""          ,"id"=>"menu_admin_worklist"])  @endcomponent
                            </div>
                        </div>
                        <div class="row m-0">
                            <div class="col-6">
                                <span class="h4">Treatment
                                    Coverage</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"menu"     ,"name"=>""          ,"id"=>"menu_admin_treatment"])  @endcomponent
                            </div>
                        </div>
                        <div class="row m-0">
                            <div class="col-6">
                                <span class="h4">Wording</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"menu"     ,"name"=>""          ,"id"=>"menu_admin_wording"])  @endcomponent
                            </div>
                        </div>
                        <div class="row m-0">
                            <div class="col-6">
                                <span class="h4">Migrate</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"menu"     ,"name"=>""          ,"id"=>"menu_admin_migrate"])  @endcomponent
                            </div>
                        </div>
                        <div class="row m-0">
                            <div class="col-6">
                                <span class="h4">Log Data</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"menu"     ,"name"=>""          ,"id"=>"menu_admin_log"])  @endcomponent
                            </div>
                        </div>
                        <div class="row m-0">
                            <div class="col-6">
                                <span class="h4">About</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"menu"     ,"name"=>""          ,"id"=>"menu_aboutproject"])  @endcomponent
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
