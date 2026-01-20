@extends('layouts.app')
{{-- @extends('layouts.layouts_index.main') --}}

@section('title', 'EndoINDEX')
@section("modal")
    @include("reportendocapture.component.modal_vip")
    @include("reportendocapture.component.modal_emr")
    @include("reportendocapture.component.modal_modal_confirmsave")
    @include("reportendocapture.component.modal_waitingcreatedicom")
@endsection



@section('content')
    @php
        $admin['controllername'] = "ReportEndocaptureController";
        $admin['viewname']       = "reportendocapture/show.blade.php";
        cardADMIN($admin);
    @endphp

    <div class="row" style="margin:0;">
        <div class="col-3 PACSreport">
            <div class="card" style="height: 100%;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h4 class="m-t-0 header-title"><b>Endoscopy Report</b></h4>
                        </div>
                        <div class="col-md-12">
                            <hr />
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row title m-0">
                                <label class="col-6">
                                    <a class="btn btn-warning text-center btn-block" href="{{ url("procedure/$casedata->case_id") }}"> Edit Report</a>
                                </label>
                                @if($casedata->case_hn=="vip")
                                    <label class="col-6">
                                        <a class="btn btn-danger text-center btn-block" data-toggle="modal" data-target="#modalvip">Encrypt Data</a>
                                    </label>
                                @endif


                                <label class="col-6">&nbsp;</label>
                                @if ($casedata->procedure_name != 'manometry')
                                    <label class="col-12">
                                        <a class="btn @if(@$_GET['type']=='procedure') btn-primary  @else btn-outline-primary @endif btn-block" href="?type=procedure" disabled>Procedure Report</a>
                                    </label>
                                    <label class="col-12">
                                        <a class="btn @if(@$_GET['type']=='procedure_custom') btn-primary  @else btn-outline-primary @endif btn-block" href="?type=procedure_custom">Procedure Report 2</a>
                                    </label>
                                    <label class="col-12">
                                        <a class="btn @if(@$_GET['type']=='ProcedureWriting') btn-primary  @else btn-outline-primary @endif btn-block" href="?type=long_writing">Procedure Report
                                            (Long writing) </a>
                                    </label>
                                    <label class="col-12">
                                        <a class="btn @if(@$_GET['type']=='ProcedureImage') btn-primary  @else btn-outline-primary @endif btn-block" href="?type=long_image">Procedure Report (Long
                                            Image) </a>
                                    </label>
                                    <label class="col-12">
                                        <a class="btn @if(@$_GET['type']=='ProcedureDraw') btn-primary  @else btn-outline-primary @endif btn-block" href="?type=drawing">Procedure Report
                                            (Drawing)</a>
                                    </label>
                                    <label class="col-12">
                                        <a class="btn @if(@$_GET['type']=='accessory') btn-primary  @else btn-outline-primary @endif btn-block" href="?type=accessory">Accessory Report</a>
                                    </label>
                                @endif
                            </div>

                            <div class="row">
                                <div class="col-12 mb-2"><h4><b>E-sign</b></h4></div>
                                <div class="col-12" style="height:100%;">
                                    <button id="btn_esign" class="btn btn-default text-center" style="width: 100%;height:100%;"><i class="far fa-file-pdf"></i><br>Create sign</button>
                                </div>
                                <div class="col-12"><hr></div>
                            </div>

                            @if(configTYPE("admin","system_pacs"))      @include('reportendocapture.component.pacs')    @endif
                            @if(configTYPE("admin","system_vna"))       @include('reportendocapture.component.vna')     @endif
                            @if(configTYPE("admin","system_ordata"))    @include('reportendocapture.component.ordata')  @endif

                            <div class="row">
                                <div class="col-12"><h4><b>Case Detail</b></h4></div>
                                <h6 class="col-5">CASE ID:</h6>
                                <h6 class="col-7">{{ $casedata->case_id }}</h6>
                            </div>

                            <div class="row">
                                <h6 class="col-5">NAME:</h6>
                                    <h6 class="col-7">
                                    {{$casedata->firstname.' '.$casedata->lastname}} ({{ @$json->age }})
                                </h6>
                            </div>

                            <div class="row">
                                <h6 class="col-5">HN:</h6>
                                    <h6 class="col-7">{{ $casedata->hn }}</h6>
                            </div>
                            <div class="row">
                                <h6 class="col-5">Date of Procedure:</h6>
                                    <h6 class="col-7">{{ $casedata->case_dateappointment }}</h6>
                            </div>

                            <div class="row">
                                <h6 class="col-5">
                                    Physicians :
                                </h6>
                                <h6 class="col-7">
                                    {{$doctorname}}<br>
                                    @foreach($doctor as $name)
                                        @if($name!=null)
                                            {{$name->user_prefix}}
                                            {{$name->user_firstname}}
                                            {{$name->user_lastname}} <br>
                                        @endif
                                    @endforeach
                                </h6>
                                <h6 class="col-5">
                                    Nurse:
                                </h6>
                                <h6 class="col-7">
                                    @foreach($nurse as $name)
                                        @if($name!=null)
                                            {{$name->user_prefix}}
                                            {{$name->user_firstname}}
                                            {{$name->user_lastname}} <br>
                                        @endif
                                    @endforeach
                                </h6>
                                <h6 class="col-5">Procedure:</h6>
                                <h6 class="col-7">{{ @$casedata->procedure_name }}</h6>

                                <div class="col-12">
                                    &nbsp;
                                </div>
                                <h6 class="col-12">
                                    <b>
                                    PDF Version
                                    </b>
                                </h6>
                                @foreach($case_pdfversion as $pdf)
                                    <div class="col-5">{{@$pdf->user}}</div>
                                    <div class="col-6">{{@$pdf->when}}</div>
                                    @if(isset($pdf->pdf))
                                        <div class="col-1"><a target="_blank" href="{{getCONFIG('admin')->store_url}}/{{"$casedata->case_hn/$folderdate/pdf/"}}{{@$pdf->pdf}}" class="btn btn-sm btn-warning p-1"><i class="fa fa-file-pdf pr-0"></i></a></div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-9">
            <div class="card">
                <div class="card-body">
                    <div class="row" >
                        <div class="col"></div>
                        <div class="col-auto">
                            <a href="{{ url('api/pdf?id=') }}{{ Request::segment(2) }}" target="_blank">
                                <i class="fas fa-expand-alt text-primary"></i>
                            </a>
                        </div>
                        <div class="col-auto">
                            <span id="switch_setting">
                                <i class="far fa-sun text-warning"></i>
                            </span>
                        </div>
                        <div class="col-12" id="card_setting" style="display: none;">
                            <div class="row m-0">
                                <div class="col-12">
                                    <div class="row">
                                            @php
                                                $swicth     = "EndoCAPTURE.superadmin.component.switch";
                                                $textbox    = "EndoCAPTURE.superadmin.component.textbox";
                                            @endphp
                                            @component($swicth,["type"=>"admin"     ,"name"=>"PDF findding normal"          ,"id"=>"pdf_findding_normal"])  @endcomponent
                                            @component($textbox,["type"=>"pdf"      ,"name"=>"PDF Folder HEAD Hospital"     ,"id"=>"pdf_folder_head"])      @endcomponent
                                            @component($textbox,["type"=>"admin"    ,"name"=>"PDF Procedure pic"            ,"id"=>"pdf_procedure_pic"])    @endcomponent
                                            @component($textbox,["type"=>"admin"    ,"name"=>"pdf_exit"                     ,"id"=>"pdf_exit"])             @endcomponent

                                            @component($textbox,["type"=>"pdf"      ,"name"=>"pdf_page_margin_top"          ,"id"=>"pdf_page_margin_top"])      @endcomponent
                                            @component($textbox,["type"=>"pdf"      ,"name"=>"pdf_header_margin_top"        ,"id"=>"pdf_header_margin_top"])    @endcomponent
                                            @component($textbox,["type"=>"pdf"      ,"name"=>"pdf_content_left_top"         ,"id"=>"pdf_content_left_top"])     @endcomponent
                                            @component($textbox,["type"=>"pdf"      ,"name"=>"pdf_content_right_top"        ,"id"=>"pdf_content_right_top"])    @endcomponent

                                            <div class="col-3"><h3>pdf_default&emsp;&nbsp;</h3></div>
                                            <div class="col-1"></div>
                                            <div class="col-6">
                                                <select id="pdf_default" class="form-control configtext">
                                                    <option value="auto"                @if(@$connection->pdf_default=="auto")              selected @endif>auto</option>
                                                    <option value="procedure"           @if(@$connection->pdf_default=="procedure")         selected @endif>procedure</option>
                                                    <option value="long_writing"        @if(@$connection->pdf_default=="long_writing")      selected @endif>long_writing</option>
                                                    <option value="drawing"             @if(@$connection->pdf_default=="drawing")           selected @endif>drawing</option>
                                                    <option value="long_image"          @if(@$connection->pdf_default=="long_image")        selected @endif>long_image</option>
                                                    <option value="procedure_custom"   @if(@$connection->pdf_default=="procedure_custom") selected @endif>procedure_custom</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col text-right">
                                        <a id="pdf_setting_save" class="btn btn-success">Save</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-6">
                            <a href="{{ url('pdf?id=') }}{{ Request::segment(2) }}" target="_blank"><i class="fas fa-expand-alt text-primary"></i></a>
                        </div>
                        <div class="col-6 text-right">

                        </div> --}}
                        <div class="col-12">
                            @php
                                if (isset($_GET['type'])) {
                                    $type = "&type=".$_GET['type'];
                                } else {
                                    $type = '';
                                }
                            @endphp

                            @isset($_GET['type'])
                                @if($_GET['type']=="accessory")
                                    <iframe id="iframepdf" src="{{url('billing')}}/{{Request::segment(2)}}" width="100%" height="1200" ></iframe>
                                @else
                                    <iframe id="iframepdf" src="{{url('api/pdf?id=')}}{{Request::segment(2)}}&type={{$type}}" width="100%" height="1200" ></iframe>
                                @endif
                            @else
                                <iframe id="iframepdf" src="{{url('api/pdf?id=')}}{{Request::segment(2)}}&type={{$type}}" width="100%" height="1200" ></iframe>
                            @endisset
                            {{-- ห้ามลบบรรทัดนี้เด็ดขาดไม่งั้น font ไทยเสีย--}}
                            <iframe style="display: none" id="iframepdf" src="{{url('api/pdf?id=')}}{{Request::segment(2)}}&type={{$type}}&savepdf=true" width="100%" height="1200" ></iframe>
                            {{-- ห้ามลบบรรทัดนี้เด็ดขาดไม่งั้น font ไทยเสีย--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection




@section('script')

    <script src     ='{{url('resources/box/js/box.js')}}'></script>
    <script>
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

    $(".jsonboxSAVE").click(function(){
        var ele             = $(this).attr("name");
        var elements        = document.querySelectorAll('input[name="'+ele+'"]:checked');
        var checkedElements = Array.prototype.map.call(elements,function(el,i){
            return el.value;
        });
        $.post("{{url('api/case')}}",{
            event   : "jsonboxSAVE",
            ele     : ele,
            val     : checkedElements,
            cid     : "{{$cid}}"
        },function(data, status){});
    });




    $("#pdf_setting_save").click(function(){
        $.post("{{url('superadmin')}}",{
            event:"clearview"
        },function(d,s){
            window.location.reload();
        });
    });



    $("#btn_esign").click(function(){
        $("#modal_emr").modal("show");
        $("#password_incorrect1").hide();
        $("#password_incorrect2").hide();
    });

    $("#card_setting").slideUp()

    $("#switch_setting").click(function(){
        $("#card_setting").toggle(500)
    });
    $("#create_sign").click(function(){
        var doctor_id = $("#doctor_id").val();
        var doctor_code = $("#doctor_code").val();
        setTimeout(() => {
            $.post('{{url('reportendocapture')}}',{
                event       : "create_sign",
                doctor_id   : doctor_id,
                doctor_code : doctor_code,
                folderdate  : '{{$folderdate}}',
                cid         : '{{$casedata->case_id}}',
                caseuniq    : '{{$casedata->caseuniq}}',
                comcreate   : '{{$casedata->comcreate}}',
                hn          : '{{$casedata->case_hn}}'
            },function(data,status){
                if(data=="success"){
                    location.reload();
                }else{
                    $("#password_incorrect1").show();
                    $("#password_incorrect2").show();
                }
            });
        }, 1000);
    });







    var pdftype = "";

    $('.btn-outline-success').click(function() {
        pdftype = $(this).attr('id');
        $('#modal_confirmsave').modal('show');
    });

    $('#btnYes').click(function() {
        window.location.replace("{{ url('') }}/reportendocapture/{{ Request::segment(2) }}?type=" +
            pdftype + "&savepdf=true");
    });


    $('#sendbilling').click(function(){
        var cid = $(this).attr('cid');
        $.post('{{url('billing')}}',{
            event   :"billing_file",
            cid     : cid,
        },function(data,status){
            const obj = JSON.parse(data);
            if(obj.status=="success"){
                alert("ส่งข้อมูลค่าใช้จ่าย สำเร็จ");
            }else{
                alert("ส่งข้อมูลค่าใช้จ่าย ไม่สำเร็จ");
            }
            console.log(data);
        });
    });

</script>
<script>

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
<script>
    @php
        $comname = getCONFIG('admin')->com_name;
    @endphp

    @if($comname!="endocapture")
        @if(configTYPE("admin","system_semi"))
            setInterval(function(){
                $.post("{{url('synchronize')}}",{},
                function(data,status){
                    console.log(data);
                    if(data=="true"){
                        location.reload();
                    }
                });
                console.log("Connect server success!!!");
            }, 10000);
        @endif
    @endif
</script>





    {{-- Nurse Monitor--}}
    <script src="http://{{getCONFIG('admin')->server_name}}:3000/socket.io/socket.io.js"></script>
    <script>
        var socket2 = io.connect('http://{{getCONFIG('admin')->server_name}}:3000');
        socket2.emit('chat message','casemonitor');
    </script>
    {{-- Nurse Monitor--}}
@endsection
