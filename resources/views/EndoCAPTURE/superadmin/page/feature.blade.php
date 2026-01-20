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
                                <h3 class="text-primary">Feature MENU</h5>
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
                                <span class="h4">อ่านบัตรประชาชน</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"feature"     ,"name"=>""          ,"id"=>"citizencard"])  @endcomponent
                            </div>
                        </div>

                        <div class="row m-0">
                            <div class="col-6 ">
                                <span class="h4">Or Data</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"feature"     ,"name"=>""          ,"id"=>"ordata"])  @endcomponent
                            </div>
                        </div>
                        <div class="row m-0">
                            <div class="col-6 ">
                                <span class="h4">Semi</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"feature"     ,"name"=>""          ,"id"=>"semi"])  @endcomponent
                            </div>
                        </div>
                        <div class="row m-0">
                            <div class="col-6 ">
                                <span class="h4">Case Control</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"feature"     ,"name"=>""          ,"id"=>"casecontrol"])  @endcomponent
                            </div>
                        </div>
                        <div class="row m-0">
                            <div class="col-6 ">
                                <span class="h4">OCR</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"feature"     ,"name"=>""          ,"id"=>"ocr"])  @endcomponent
                            </div>
                        </div>
                        <div class="row m-0">
                            <div class="col-6 ">
                                <span class="h4">pacs</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"feature"     ,"name"=>""          ,"id"=>"pacs"])  @endcomponent
                            </div>
                        </div>
                        <div class="row m-0">
                            <div class="col-6 ">
                                <span class="h4">emr</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"feature"     ,"name"=>""          ,"id"=>"emr"])  @endcomponent
                            </div>
                        </div>

                        <div class="row m-0">
                            <div class="col-6 ">
                                <span class="h4">vna</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"feature"     ,"name"=>""          ,"id"=>"vna"])  @endcomponent
                            </div>
                        </div>

                        <div class="row m-0">
                            <div class="col-6 ">
                                <span class="h4">softcon</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"feature"     ,"name"=>""          ,"id"=>"softcon"])  @endcomponent
                            </div>
                        </div>

                        <div class="row m-0">
                            <div class="col-6 ">
                                <span class="h4">booking</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"feature"     ,"name"=>""          ,"id"=>"booking"])  @endcomponent
                            </div>
                        </div>
                        <div class="row m-0">
                            <div class="col-6 ">
                                <span class="h4">track</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"feature"     ,"name"=>""          ,"id"=>"track"])  @endcomponent
                            </div>
                        </div>
                        <div class="row m-0">
                            <div class="col-6 ">
                                <span class="h4">queue</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"feature"     ,"name"=>""          ,"id"=>"queue"])  @endcomponent
                            </div>
                        </div>
                        <div class="row m-0">
                            <div class="col-6 ">
                                <span class="h4">worklist</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"feature"     ,"name"=>""          ,"id"=>"worklist"])  @endcomponent
                            </div>
                        </div>
                        <div class="row m-0">
                            <div class="col-6 ">
                                <span class="h4">HTTPS</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"feature"     ,"name"=>""          ,"id"=>"https"])  @endcomponent
                            </div>
                        </div>



                        <div class="row m-0">
                            <div class="col-6 ">
                                <span class="h4">SEMI HTTPS</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"feature"     ,"name"=>""          ,"id"=>"semihttps"])  @endcomponent
                            </div>
                        </div>


                        <div class="row m-0">
                            <div class="col-6 ">
                                <span class="h4">Year Thai</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"feature"     ,"name"=>""          ,"id"=>"year_thai"])  @endcomponent
                            </div>
                        </div>

                        <div class="row m-0">
                            <div class="col-6 ">
                                <span class="h4">Report Eng</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"feature"     ,"name"=>""          ,"id"=>"report_eng"])  @endcomponent
                            </div>
                        </div>

                    </div>
                    <div class="col-6">
                        <div class="row m-0  mt-5 pt-4">
                            <div class="col-6 ">
                                <span class="h4">Multi ScopeSource</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"feature"     ,"name"=>""          ,"id"=>"multiscopesource"])  @endcomponent
                            </div>
                        </div>

                        <div class="row m-0">
                            <div class="col-6 ">
                                <span class="h4">Live Stream</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"feature"     ,"name"=>""          ,"id"=>"livestream"])  @endcomponent
                            </div>
                        </div>
                        <div class="row m-0">
                            <div class="col-6 ">
                                <span class="h4">Live Consult</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"feature"     ,"name"=>""          ,"id"=>"liveconsult"])  @endcomponent
                            </div>
                        </div>

                        <div class="row m-0">
                            <div class="col-6 ">
                                <span class="h4">API Appointment</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"feature"     ,"name"=>""          ,"id"=>"apiappointment"])  @endcomponent
                            </div>
                        </div>
                        <div class="row m-0">
                            <div class="col-6 ">
                                <span class="h4">Nurse Note</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"feature"     ,"name"=>""          ,"id"=>"nursenote"])  @endcomponent
                            </div>
                        </div>
                        <div class="row m-0">
                            <div class="col-6 ">
                                <span class="h4">E-sign</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"feature"     ,"name"=>""          ,"id"=>"esign"])  @endcomponent
                            </div>
                        </div>
                        <div class="row m-0">
                            <div class="col-6 ">
                                <span class="h4">Accession Number</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"feature"     ,"name"=>""          ,"id"=>"accessionnnumber"])  @endcomponent
                            </div>
                        </div>
                        <div class="row m-0">
                            <div class="col-6 ">
                                <span class="h4">Health Record</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"feature"     ,"name"=>""          ,"id"=>"health_record"])  @endcomponent
                            </div>
                        </div>
                        <div class="row m-0">
                            <div class="col-6 ">
                                <span class="h4">Physician Record</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"feature"     ,"name"=>""          ,"id"=>"physician_record"])  @endcomponent
                            </div>
                        </div>
                        <div class="row m-0">
                            <div class="col-6 ">
                                <span class="h4">Nurse Record</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"feature"     ,"name"=>""          ,"id"=>"nurse_record"])  @endcomponent
                            </div>
                        </div>
                        <div class="row m-0">
                            <div class="col-6 ">
                                <span class="h4">Billing Record</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"feature"     ,"name"=>""          ,"id"=>"billing_record"])  @endcomponent
                            </div>
                        </div>
                        <div class="row m-0">
                            <div class="col-6 ">
                                <span class="h4">Follow Up Record</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"feature"     ,"name"=>""          ,"id"=>"followup_record"])  @endcomponent
                            </div>
                        </div>
                        <div class="row m-0">
                            <div class="col-6 ">
                                <span class="h4">Store Management</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"feature"     ,"name"=>""          ,"id"=>"store_management"])  @endcomponent
                            </div>
                        </div>
                        <div class="row m-0">
                            <div class="col-6 ">
                                <span class="h4">Finding Side Photo</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"feature"     ,"name"=>""          ,"id"=>"fidingsidephoto"])  @endcomponent
                            </div>
                        </div>

                        <div class="row m-0">
                            <div class="col-6 ">
                                <span class="h4">Send status to cloud</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"feature"     ,"name"=>""          ,"id"=>"sendstatustocloud"])  @endcomponent
                            </div>
                        </div>

                        <div class="row m-0">
                            <div class="col-6 ">
                                <span class="h4">Photo caseuniq</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"feature"     ,"name"=>""          ,"id"=>"photocaseuniq"])  @endcomponent
                            </div>
                        </div>


                        <div class="row m-0">
                            <div class="col-6 ">
                                <span class="h4">ADFS</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"feature"     ,"name"=>""          ,"id"=>"adfs"])  @endcomponent
                            </div>
                        </div>

                        <div class="row m-0">
                            <div class="col-6 ">
                                <span class="h4">Auth report</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"feature"     ,"name"=>""          ,"id"=>"report_auth"])  @endcomponent
                            </div>
                        </div>

                        {{-- <div class="row m-0">
                            <div class="col-6 ">
                                <span class="h4">doctor Search</span>
                            </div>
                            <div class="col-6 text-center">
                                @component($swicth,["type"=>"feature"     ,"name"=>""          ,"id"=>"adfs"])  @endcomponent
                            </div>
                        </div> --}}

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
