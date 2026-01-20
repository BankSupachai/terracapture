@extends('capture.layoutv6')

@section('title', 'EndoINDEX')
@section('style')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link href="{{url('public/css/superadmin/index.css')}}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
<div class="row m-0">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 mb-3">
                        <h2 style="text-align: center;">การเปิดปิดการใช้งานระบบ {{ $id }}</h2>
                    </div>
                    @include('EndoCAPTURE.superadmin.component.menutopbar')

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
</div>
@php
    $head_line = configTYPE("pdf","head_line");
    $body_line = configTYPE("pdf","body_line");
    $pagetwo   = configTYPE("pdf","pagetwo");
@endphp
    <div class="row  mt-2">
        <div class="col-3"><h3>pdf_default</h3></div>
        <div class="col-1"></div>
        <div class="col-6">
            <select id="pdf_default" class="form-control configtext">
                <option value="auto"                @if(@$connection->pdf_default=="auto")              selected @endif>auto</option>
                <option value="procedure"           @if(@$connection->pdf_default=="procedure")         selected @endif>procedure</option>
                <option value="long_writing"        @if(@$connection->pdf_default=="long_writing")      selected @endif>long_writing</option>
                <option value="drawing"             @if(@$connection->pdf_default=="drawing")           selected @endif>drawing</option>
                <option value="long_image"          @if(@$connection->pdf_default=="long_image")        selected @endif>long_image</option>
                <option value="pdf_picturebottom"   @if(@$connection->pdf_default=="pdf_picturebottom") selected @endif>pdf_picturebottom</option>
            </select>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-3"><h3>ภาพหน้าแรก</h3></div>
        <div class="col-1"></div>
        <div class="col-6">
            <select id="pdf_img" class="form-control configtext">
                @for ($i=0;$i<=8;$i++)
                    <option value="{{$i}}" @if(@$connection->pdf_img==$i || !isset($connection->pdf_img))  selected @endif>{{$i}}</option>
                @endfor
            </select>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-3 h3 text-right">Head special</div>
        <div class="col-1"></div>
        <div class="col-6"><input type="text" name="" id="head_line" class="form-control config_type" config_type="pdf" value="{{$head_line}}"></div>
    </div>
    <div class="row mt-2">
        <div class="col-3 h3 text-right">Line special</div>
        <div class="col-1"></div>
        <div class="col-6"><input type="text" name="" id="body_line" class="form-control config_type" config_type="pdf" value="{{$body_line}}"></div>
    </div>
    <div class="row mt-2">
        <div class="col-3 h3 text-right">Image Page 2</div>
        <div class="col-1"></div>
        <div class="col-6"><input type="number" name="" id="pagetwo" class="form-control config_type" config_type="pdf" value="{{$pagetwo}}"></div>
    </div>
</div>
</div>
</div>


@endsection
@section('script')
<script>
$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

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
