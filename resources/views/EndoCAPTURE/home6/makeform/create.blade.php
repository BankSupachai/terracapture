@extends('layouts.layout_capture')
@section('title', 'Make')

@section('style')
<style>
#modules {
    padding: 20px;
    background: #eee;
    margin-bottom: 20px;
    z-index: 1;
    border-radius: 10px;
}

#dropzone {
    padding: 20px 0;
    background: #fff;
    /* min-height: 100px; */
    margin-bottom: 20px;
    z-index: 0;
    border-radius: 0;
}

.active {
    outline: 1px solid red;
}

.hover {
    outline: 1px solid blue;
}

.drop-item {
    cursor: pointer;
    margin-bottom: 10px;
    background-color: rgb(255, 255, 255);
    padding: 5px 10px;
    border-radius: 3px;
    /* border: 1px solid rgb(204, 204, 204); */
    position: relative;
}
.col-1,.col-2,.col-3,.col-4,.col-5,.col-6,.col-7,.col-8,.col-9,.col-10,.col-11,.col-12{transition: 0.2s;padding-top: 0;padding-bottom: 0;}
.drop-item .remove {
    position: absolute;
    top: 4px;
    right: 4px;
}
.drop-item .remove2 {
    position: absolute;
    top: 4px;
    right: 2em;
}
.fs-italic{font-style: italic;}
.fs-inherit{font-style: inherit;}
.fs-initial{font-style: initial;}
.fs-underline{text-decoration: underline;}
.fs-blod{font-weight: bold;}
.fs-bloder{font-weight: bolder;}
.fs-lighter{font-weight: lighter;}
.fs-normal{font-weight: normal;}
.offcanvas-backdrop{background: none;}
.fs-14{font-size: 14px;}
.fs-15{font-size: 15px;}
.fs-16{font-size: 16px;}
.fs-17{font-size: 17px;}
.fs-18{font-size: 18px;}
.fs-19{font-size: 19px;}
.fs-20{font-size: 20px;}
.fs-21{font-size: 20px;}
.fs-22{font-size: 22px;}
.fs-23{font-size: 23px;}
.fs-24{font-size: 24px;}
.fs-25{font-size: 25px;}
.fs-26{font-size: 26px;}
.ck-group{
    position: absolute;
    top: 0;
}
.new-form{background: #f2f2f7;height: 1.5em;margin: 2em -20px;}
#modules {
    overflow-x: auto;
    max-height: 84vh;
}
#btn_save{
    position: fixed;
    bottom: 0;
    z-index: 99999;
    left: 50%;
    margin-left: -200px;
    width: 200px;
    border-radius: 40px 40px 0px 0px;
    opacity: 0.8;
    transition: 0.2s;
}
#btn_save:hover{background: green;opacity: 1;}
.offcanvas-body{background: #3a6a7c4a;}
.offcanvas-body > .row{padding: 0.5em;background: #fff;border-radius: 5px;}
.hide-show{display: none;}
.hide-show.active{display: block;}
.menu-setting{margin: 0;}
#data_set{
    display: none;
}

</style>
{{-- <link href="{{url("public/new/assets/libs/sweetalert2/sweetalert2.min.css")}}" rel="stylesheet" type="text/css" /> --}}
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection

@section('modal')
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 id="offcanvasRightLabel">Setting</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <input type="hidden" name="" id="size">
        <div class="row menu-size">
            @for($i=1;$i<=12;$i++)
                <div class="col-3 p-1"><button class="btn btn-light w-100" onclick="edit_size({{$i}})">{{$i}}</button></div>
            @endfor
            <div class="col-6 p-1"><button class="btn btn-danger w-100" onclick="edit_size()">By size</button></div>
            <div class="col-6 p-1"><button class="btn btn-danger w-100" onclick="edit_size()">Auto</button></div>
        </div>
        <div class="row mt-3 menu-name">
            <div class="col-md-12 mb-3">
                <label for="set_name">Name</label>
                <input type="text" class="form-control" id="set_name">
            </div>
        </div>
        <div class="row mt-3 menu-placeholder">
            <div class="col-md-12 mb-3">
                <label for="set_placeholder">Placeholder</label>
                <input type="text" class="form-control" id="set_placeholder">
            </div>
        </div>
        <div class="row mt-3 menu-select-data">
            <div class="col-md-12 mb-3">
                <label for="set_select_data">Data</label>
                <select class="form-control set-data-on-select" id="choices-single-groups" data-choices data-choices-groups data-placeholder="Select" name="choices-single-groups">
                    <option value="">Choose</option>
                    <optgroup label="Users">
                        <option value="all">All users</option>
                        <option value="admin">Type admin</option>
                    </optgroup>
                    <optgroup label="Other">
                        <option value="test">test</option>
                    </optgroup>
                </select>
            </div>
        </div>
        <div class="row mt-3 menu-text">
            <div class="col-md-12 mb-3">
                <label for="set_text">Text</label>
                <input type="text" class="form-control" id="set_text">
            </div>
        </div>
        <div class="row mt-3 menu-font-size">
            <label for="" class="p-0">Set Font Size</label>
            @for ($i=14;$i<=26;$i++)
            <div class="col-3 p-1"><button class="btn btn-light w-100" onclick="edit_font_size({{$i}})">{{$i}} PX</button></div>
            @endfor
        </div>
        <div class="row mt-3 menu-margin">
            <label for="" class="p-0">Set Margin</label>
            <div class="row">
                <div class="col-4"></div>
                <div class="col-4"><input type="number" id="pt" class="form-control set-scale" set="margin-top"></div>
                <div class="col-4"></div>
            </div>
            <div class="row">
                <div class="col-4"><input type="number" id="pl" class="form-control set-scale" set="margin-left"></div>
                <div class="col-4"></div>
                <div class="col-4"><input type="number" id="pr" class="form-control set-scale" set="margin-right"></div>
            </div>
            <div class="row">
                <div class="col-4"></div>
                <div class="col-4"><input type="number" id="pb" class="form-control set-scale" set="margin-bottom"></div>
                <div class="col-4"></div>
            </div>
        </div>
        <div class="row mt-3 menu-padding">
            <label for="" class="p-0">Set Padding</label>
            <div class="row">
                <div class="col-4"></div>
                <div class="col-4"><input type="number" id="mt" class="form-control set-scale" set="padding-bottom"></div>
                <div class="col-4"></div>
            </div>
            <div class="row">
                <div class="col-4"><input type="number" id="ml" class="form-control set-scale" set="padding-bottom"></div>
                <div class="col-4"></div>
                <div class="col-4"><input type="number" id="mr" class="form-control set-scale" set="padding-bottom"></div>
            </div>
            <div class="row">
                <div class="col-4"></div>
                <div class="col-4"><input type="number" id="mb" class="form-control set-scale" set="padding-bottom"></div>
                <div class="col-4"></div>
            </div>
        </div>
        <div class="row mt-3 menu-set-color">
            <label for="" class="p-0">Set Color</label>
            <div class="col-4 p-1"><button type="button" set-class="btn-primary" class="w-100 btn-set btn btn-primary bg-gradient waves-effect waves-light">Primary</button></div>
            <div class="col-4 p-1"><button type="button" set-class="btn-secondary" class="w-100 btn-set btn btn-secondary bg-gradient waves-effect waves-light">Secondary</button></div>
            <div class="col-4 p-1"><button type="button" set-class="btn-success" class="w-100 btn-set btn btn-success bg-gradient waves-effect waves-light">Success</button></div>
            <div class="col-4 p-1"><button type="button" set-class="btn-info" class="w-100 btn-set btn btn-info bg-gradient waves-effect waves-light">Info</button></div>
            <div class="col-4 p-1"><button type="button" set-class="btn-warning" class="w-100 btn-set btn btn-warning bg-gradient waves-effect waves-light">Warning</button></div>
            <div class="col-4 p-1"><button type="button" set-class="btn-danger" class="w-100 btn-set btn btn-danger bg-gradient waves-effect waves-light">Danger</button></div>
            <div class="col-4 p-1"><button type="button" set-class="btn-dark" class="w-100 btn-set btn btn-dark bg-gradient waves-effect waves-light">Dark</button></div>
            <div class="col-4 p-1"><button type="button" set-class="btn-light" class="w-100 btn-set btn btn-light bg-gradient waves-effect">Light</button></div>
        </div>
        <div class="row mt-3 menu-set-border">
            <label for="" class="p-0">Set Border</label>
            <div class="col-12 p-0">
                <div class="row">
                    <div class="col pl-0">Border Top</div>
                    <div class="col-3"><input type="number" class="form-control form-control-sm text-center" value="0"></div>
                    <div class="col-3"><input type="color" class="form-control"></div>
                </div>
                <div class="row mt-1">
                    <div class="col pl-0">Border Bottom</div>
                    <div class="col-3"><input type="number" class="form-control form-control-sm text-center" value="0"></div>
                    <div class="col-3"><input type="color" class="form-control"></div>
                </div>
                <div class="row mt-1">
                    <div class="col pl-0">Border Left</div>
                    <div class="col-3"><input type="number" class="form-control form-control-sm text-center" value="0"></div>
                    <div class="col-3"><input type="color" class="form-control"></div>
                </div>
                <div class="row mt-1">
                    <div class="col pl-0">Border Right</div>
                    <div class="col-3"><input type="number" class="form-control form-control-sm text-center" value="0"></div>
                    <div class="col-3"><input type="color" class="form-control"></div>
                </div>
            </div>
        </div>
        <div class="row mt-3 menu-set-text-style">
            <label for="" class="p-0">Set Text style</label>
            <div class="col-12">
                <div class="row m-0">
                    <div class="col-6 p-1"><button class="btn btn-light w-100" onclick="set_text_style('fs-italic')">Italic</button></div>
                    <div class="col-6 p-1"><button class="btn btn-light w-100" onclick="set_text_style('fs-underline')">Underline</button></div>
                </div>
                <div class="row m-0 mt-2">
                    <div class="col-3 p-1"><button class="btn btn-light w-100" onclick="set_text_style('fs-blod')">Bold</button></div>
                    <div class="col-3 p-1"><button class="btn btn-light w-100" onclick="set_text_style('fs-bloder')">Bolder</button></div>
                    <div class="col-3 p-1"><button class="btn btn-light w-100" onclick="set_text_style('fs-inherit')">Inherit</button></div>
                    <div class="col-3 p-1"><button class="btn btn-light w-100" onclick="set_text_style('fs-initial')">Initial</button></div>
                    <div class="col-3 p-1"><button class="btn btn-light w-100" onclick="set_text_style('fs-lighter')">Lighter</button></div>
                    <div class="col-3 p-1"><button class="btn btn-light w-100" onclick="set_text_style('fs-normal')">Normal</button></div>
                </div>
            </div>
        </div>
        <div class="row mt-3 menu-set-text-align">
            <div class="row m-0 mt-2">
                <div class="col-4 p-1"><button class="btn btn-light w-100" onclick="set_text_align('text-left')">Left</button></div>
                <div class="col-4 p-1"><button class="btn btn-light w-100" onclick="set_text_align('text-center')">Center</button></div>
                <div class="col-4 p-1"><button class="btn btn-light w-100" onclick="set_text_align('text-right')">Right</button></div>
            </div>
        </div>
        <div class="row mt-3 menu-set-data">
            <label for="" class="p-0">Set Show Data</label>
            <div class="row">
                <div class="col">
                    <div class="form-check form-radio-success mb-3">
                        <input class="form-check-input" type="radio" name="data_list" id="formradioRight5">
                        <label class="form-check-label" for="formradioRight5">
                            Single Data
                        </label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-check form-radio-success mb-3">
                        <input class="form-check-input" type="radio" name="data_list" id="formradioRight5">
                        <label class="form-check-label" for="formradioRight5">
                            Loop Data
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <input type="text" name="" id="" class="form-control" placeholder="Attribute Name">
            </div>
        </div>
        <div class="row mt-3 menu-set-link">
            <label for="" class="p-0">Set Link</label>
            <div class="col-12">
                <div class="form-check form-switch">
                    <input class="form-check-input" type="checkbox" role="switch" id="SwitchCheck1">
                    <label class="form-check-label" for="SwitchCheck1">ID</label>
                </div>
            </div>
            <div class="col-12">
                <input type="text" name="" id="" class="form-control" placeholder="URL link">
            </div>
        </div>
        <div class="row mt-3 menu-set-image">
            <label for="" class="p-0">Set Image</label>
            <div class="row">
                <div class="col">
                    <div class="form-check form-radio-success mb-3">
                        <input class="form-check-input" type="radio" name="data_list" id="formradioRight5">
                        <label class="form-check-label" for="formradioRight5">
                            Single Image
                        </label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-check form-radio-success mb-3">
                        <input class="form-check-input" type="radio" name="data_list" id="formradioRight5">
                        <label class="form-check-label" for="formradioRight5">
                            Loop Image
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-12 hide-show">
                <select name="" class="form-control">
                    @for($i=1;$i<=12;$i++)
                        <option value="{{$i}}">{{$i}} ต่อแถว</option>
                    @endfor
                </select>
            </div>
            <div class="col-12 hide-show"><select name="" class="form-control"><option value="">Profile</option></select></div>
        </div>
        <div class="row mt-3 menu-set-date-time">
            <label for="" class="p-0">Set Date time</label>
            <div class="row">
                <div class="col">
                    <div class="form-check form-radio-success mb-3">
                        <input class="form-check-input" type="radio" name="data_list" id="formradioRight5">
                        <label class="form-check-label" for="formradioRight5">
                            Date & Time now
                        </label>
                    </div>
                </div>
                <div class="col">
                    <div class="form-check form-radio-success mb-3">
                        <input class="form-check-input" type="radio" name="data_list" id="formradioRight5">
                        <label class="form-check-label" for="formradioRight5">
                            Date & Time Data
                        </label>
                    </div>
                </div>
            </div>
            <div class="col-12 hide-show">
                <input type="text" name="" id="" class="form-control" placeholder="Attribute Name">
            </div>
        </div>
        <div class="row mt-3 menu-set-ungroup">
            <button class="btn btn-warning w-100" onclick="un_group()">Ungroup</button>
        </div>
    </div>
</div>
@endsection

@section('tab')
<b class="text-light ml-5">Make</b>
@endsection

@section('content')
    <input type="hidden" name="" id="num_form" value="1">

    <button class="btn btn-success pull-right" id="btn_save" onclick="save_form()"><i class="mdi mdi-content-save"></i> Save</button>
    <div class="row">
        <div class="col-sm">
            <div id="dropzone" class="row">
                {{-- <div class="drop-item col-12" sub-type="form"><input type="text" class="form-control form-control-sm text-center font-weight-bol" placeholder="ชื่อฟอร์ม"/></div> --}}
            </div>
        </div>
      <div class="col-sm-2">
        <div id="modules" class="bg-white">
          <p class="drag"><a class="btn btn-success w-100">Patients</a></p>
          <p class="drag"><a class="btn btn-success w-100">Brief History</a></p>
          <p class="drag"><a class="btn btn-success w-100">Medication</a></p>
          <p class="drag"><a class="btn btn-success w-100">GASTRIC CONTENT</a></p>
          <p class="drag"><a class="btn btn-success w-100">COMPLICATION</a></p>
          <p class="drag"><a class="btn btn-success w-100">RAPID UREASE TEST</a></p>
          <p class="drag"><a class="btn btn-success w-100">ESTIMATED BLOOD LOSS</a></p>
          <p class="drag"><a class="btn btn-success w-100">BLOOD TRANSFUSION</a></p>
          <p class="drag"><a class="btn btn-success w-100">SPECIMEN</a></p>
          <p class="drag"><a class="btn btn-success w-100">PLAN</a></p>
          <p class="drag"><a class="btn btn-success w-100">Attendant</a></p>
          <p class="drag"><a class="btn btn-success w-100">Assistant</a></p>
          <p class="drag"><a class="btn btn-success w-100">Endoscopist</a></p>
          <p class="drag"><a class="btn btn-success w-100">Finding</a></p>
          <p class="drag"><a class="btn btn-success w-100">ICD-10</a></p>

          <p class="drag"><a class="btn btn-dark w-100">New Form</a></p>
          <p><button class="btn btn-primary w-100 set-group" sub="set">Set Group</button></p>
        </div>
      </div>


    </div>
{{-- </div> --}}
<div id="data_set">
    @include('endocapture.home6.components.case.patients')
    @include('endocapture.home6.components.case.pre_procedure')
    @include('endocapture.home6.components.case.other')
    @include('endocapture.home6.components.case.finding')
    @include('endocapture.home6.components.case.icd10')
</div>


@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script>
    // $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    $('.drag').draggable({
        appendTo: 'body',
        helper: 'clone'
    });

var count_num = 1;
$('#dropzone').droppable({
    activeClass: 'active',
    hoverClass: 'hover',
    accept: ":not(.ui-sortable-helper)", // Reject clones generated by sortable
    drop: function (e, ui) {
        // var $el = $('<div class="drop-item"><details><summary>' + ui.draggable.text() + '</summary><div><label>More Data</label><input type="text" /></div></details></div>');
        count_num = count_num+1;
        var num_form = $("#num_form").val()
        if(ui.draggable.text()=='Patients'){
            var dt =$("#data_set #patients").html();
            var $el = $('<div class="drop-item col-12 menu-setting" id="element'+count_num+'" sub-type="patients"><div class="row">'+dt+'</div></div>');
        }else if(ui.draggable.text()=='Textarea'){
            var $el = $('<div class="drop-item col-12 menu-setting" id="element'+count_num+'" sub-type="textarea"><textarea class="form-control" name="" rows="3"></textarea></div>');
        }else if(ui.draggable.text()=='Brief History'){
            var dt =$("#data_set #brief_history").html();
            var $el = $('<div class="drop-item col-12 menu-setting" id="element'+count_num+'" sub-type="brief_history"><div class="row"><div class="col-lg-12">'+dt+'</div></div></div>');
        }else if(ui.draggable.text()=='GASTRIC CONTENT'){
            var dt =$("#data_set #gastric_content").html();
            var $el = $('<div class="drop-item col-12 menu-setting" id="element'+count_num+'" sub-type="other"><div class="row"><div class="col-lg-12">'+dt+'</div></div></div>');
        }else if(ui.draggable.text()=='Medication'){
            var dt =$("#data_set #medication").html();
            var $el = $('<div class="drop-item col-12 menu-setting" id="element'+count_num+'" sub-type="medication"><div class="row">'+dt+'</div></div>');
        }else if(ui.draggable.text()=='COMPLICATION'){
            var dt =$("#data_set #complication").html();
            var $el = $('<div class="drop-item col-12 menu-setting" id="element'+count_num+'" sub-type="medication"><div class="row">'+dt+'</div></div>');
        }else if(ui.draggable.text()=='RAPID UREASE TEST'){
            var dt =$("#data_set #rapid_urease_test").html();
            var $el = $('<div class="drop-item col-12 menu-setting" id="element'+count_num+'" sub-type="medication"><div class="row">'+dt+'</div></div>');
        }else if(ui.draggable.text()=='ESTIMATED BLOOD LOSS'){
            var dt =$("#data_set #estimated_blood_loss").html();
            var $el = $('<div class="drop-item col-12 menu-setting" id="element'+count_num+'" sub-type="medication"><div class="row">'+dt+'</div></div>');
        }else if(ui.draggable.text()=='BLOOD TRANSFUSION'){
            var dt =$("#data_set #blood_transfusions").html();
            var $el = $('<div class="drop-item col-12 menu-setting" id="element'+count_num+'" sub-type="medication"><div class="row">'+dt+'</div></div>');
        }else if(ui.draggable.text()=='SPECIMEN'){
            var dt =$("#data_set #specimens").html();
            var $el = $('<div class="drop-item col-12 menu-setting" id="element'+count_num+'" sub-type="medication"><div class="row">'+dt+'</div></div>');
        }else if(ui.draggable.text()=='PLAN'){
            var dt =$("#data_set #plans").html();
            var $el = $('<div class="drop-item col-12 menu-setting" id="element'+count_num+'" sub-type="medication"><div class="row">'+dt+'</div></div>');
        }else if(ui.draggable.text()=='Attendant'){
            var dt =$("#data_set #attendants").html();
            var $el = $('<div class="drop-item col-12 menu-setting" id="element'+count_num+'" sub-type="medication"><div class="row">'+dt+'</div></div>');
        }else if(ui.draggable.text()=='Assistant'){
            var dt =$("#data_set #assistants").html();
            var $el = $('<div class="drop-item col-12 menu-setting" id="element'+count_num+'" sub-type="medication"><div class="row">'+dt+'</div></div>');
        }else if(ui.draggable.text()=='Endoscopist'){
            var dt =$("#data_set #endoscopists").html();
            var $el = $('<div class="drop-item col-12 menu-setting" id="element'+count_num+'" sub-type="medication"><div class="row">'+dt+'</div></div>');
        }else if(ui.draggable.text()=='Finding'){
            var dt =$("#data_set #findings").html();
            var $el = $('<div class="drop-item col-12 menu-setting" id="element'+count_num+'" sub-type="medication"><div class="row">'+dt+'</div></div>');
        }else if(ui.draggable.text()=='ICD-10'){
            var dt =$("#data_set #icd10s").html();
            var $el = $('<div class="drop-item col-12 menu-setting" id="element'+count_num+'" sub-type="medication"><div class="row">'+dt+'</div></div>');
        }else if(ui.draggable.text()=='New Form'){
            var $el = $('<div class="drop-item col-12" id="element'+count_num+'" sub-type="form"><div class="row new-form" num='+num_form+'></div></div>');
        }
        $("#num_form").val(parseInt(num_form)+1)

        $el.append($('<button type="button" class="btn btn-danger btn-sm remove p-0"><i class="mdi mdi-close-thick"></i></button>').click(function () { $(this).parent().detach(); }));
        if(ui.draggable.text()!='New Form'){
            $el.append($('<button type="button" onclick="call_setting('+count_num+')" class="btn btn-primary btn-sm remove2 p-0" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="mdi mdi-cog"></i></button>'));
        }

        $(this).append($el);
    }
    }).sortable({
    items: '.drop-item',
    sort: function() {
        $( this ).removeClass( "active" );
    }
});

function call_setting(id){
    $("#size").val(id)
    var type = $("#element"+id).attr('sub-type');
    $(' .menu-name, .menu-placeholder, .menu-select-data, .menu-text, .menu-font-size, .menu-set-color, .menu-set-border, .menu-set-text-style, .menu-set-data, .menu-set-link, .menu-set-image, .menu-set-date-time, .menu-set-ungroup, .menu-set-text-align').slideUp()
    if(type=='label'){
        setTimeout(() => {
            $('.menu-size, .menu-font-size, .menu-text, .menu-set-text-style, .menu-set-text-align').slideDown();
            var text = $("#element"+id+' label').text();
            $("#set_text").val(text)
        }, 500);
    }else if(type=='textarea'){
        setTimeout(() => {
            $('.menu-size, .menu-name, .menu-placeholder').slideDown();
            var placeholder = $("#element"+id+' textarea').attr('placeholder');
            var name = $("#element"+id+' textarea').attr('name');
            $("#set_name").val(name)
            $("#set_placeholder").val(placeholder)
        }, 500);
    }else if(type=='text'){
        setTimeout(() => {
            $('.menu-size, .menu-name, .menu-placeholder').slideDown();
            var placeholder = $("#element"+id+' input').attr('placeholder');
            var name = $("#element"+id+' input').attr('name');
            $("#set_name").val(name)
            $("#set_placeholder").val(placeholder)
        }, 500);
    }else if(type=='number'){
        setTimeout(() => {
            $('.menu-size, .menu-name, .menu-placeholder').slideDown();
            var placeholder = $("#element"+id+' input').attr('placeholder');
            var name = $("#element"+id+' input').attr('name');
            $("#set_name").val(name)
            $("#set_placeholder").val(placeholder)
        }, 500);
    }else if(type=='button'){
        setTimeout(() => {
            $('.menu-size, .menu-text, .menu-set-color, .menu-set-text-align').slideDown();
            var text = $("#element"+id+' button').text();
            $("#set_text").val(text)
        }, 500);
    }else if(type=='radio'){
        setTimeout(() => {
            $('.menu-size, .menu-text,  .menu-name, .menu-set-text-align').slideDown();
            var name = $("#element"+id+' input').attr('name');
            var text = $("#element"+id+' label').text();
            $("#set_text").val(text)
            $("#set_name").val(name)
        }, 500);
    }else if(type=='checkbox'){
        setTimeout(() => {
            $('.menu-size, .menu-text, .menu-name, .menu-set-text-align').slideDown();
            var name = $("#element"+id+' input').attr('name');
            var text = $("#element"+id+' label').text();
            $("#set_text").val(text)
            $("#set_name").val(name)
        }, 500);
    }else if(type=='select'){
        setTimeout(() => {
            $('.menu-size, .menu-name, .menu-select-data, .menu-set-text-align').slideDown();
            var name = $("#element"+id+' select').attr('name');
            var target = $("#element"+id+' select').attr('data-target');
            $("#set_name").val(name)
            $(".set-data-on-select").val(target).change()
        }, 500);
    }else if(type=='row'){
        $('.menu-size, .menu-set-text-align, .menu-set-ungroup').slideDown();
        $('.menu-size').slideDown();
    }else if(type=='link'){
        setTimeout(() => {
            $('.menu-size, .menu-font-size, .menu-set-text-style, .menu-set-text-align, .menu-set-link').slideDown();
            var text = $("#element"+id+' a').text();
            $("#set_text").val(text)
        }, 500);
    }else if(type=='text_db'){
        setTimeout(() => {
            $('.menu-size, .menu-font-size, .menu-set-text-style, .menu-set-text-align, .menu-set-data').slideDown();
            var text = $("#element"+id+' label').text();
            $("#set_text").val(text)
        }, 500);
    }else if(type=='image'){
        setTimeout(() => {
            $('.menu-size, .menu-set-text-align').slideDown();
            var text = $("#element"+id+' image').text();
            $("#set_text").val(text)
        }, 500);
    }else if(type=='date'){
        setTimeout(() => {
            $('.menu-size, .menu-set-text-align').slideDown();
            var text = $("#element"+id).text();
            $("#set_text").val(text)
        }, 500);
    }else if(type=='time'){
        setTimeout(() => {
            $('.menu-size, .menu-set-text-align').slideDown();
            var text = $("#element"+id).text();
            $("#set_text").val(text)
        }, 500);
    }else if(type=='datetime'){
        setTimeout(() => {
            $('.menu-size, .menu-set-text-align').slideDown();
            var text = $("#element"+id).text();
            $("#set_text").val(text)
        }, 500);
    }
    var pt = $("#element"+id).css('padding-top');
    var pl = $("#element"+id).css('padding-left');
    var pr = $("#element"+id).css('padding-right');
    var pb = $("#element"+id).css('padding-bottom');
    var mt = $("#element"+id).css('margin-top');
    var ml = $("#element"+id).css('margin-left');
    var mr = $("#element"+id).css('margin-right');
    var mb = $("#element"+id).css('margin-bottom');
    $("#pt").val(parseInt(pt))
    $("#pl").val(parseInt(pl))
    $("#pr").val(parseInt(pr))
    $("#pb").val(parseInt(pb))
    $("#mt").val(parseInt(mt))
    $("#ml").val(parseInt(ml))
    $("#mr").val(parseInt(mr))
    $("#mb").val(parseInt(mb))

}


function edit_size(size){
    var select_e = $("#size").val()
    var class_s = "col-"+size
    $("#element"+select_e).removeClass('col-1 col-2 col-3 col-4 col-5 col-6 col-7 col-8 col-9 col-10 col-11 col-12')
    $("#element"+select_e).addClass(class_s)
}

function edit_font_size(size){
    var select_e = $("#size").val()
    var type = $("#element"+select_e).attr('sub-type')
    $("#element"+select_e+' '+type).removeClass('fs-14 fs-15 fs-16 fs-17 fs-18 fs-19 fs-20 fs-21 fs-22 fs-23 fs-24 fs-25 fs-26')
    $("#element"+select_e+' '+type).addClass('fs-'+size)
}

function un_group(){
    var select_e = $("#size").val()
    var size =  $("#element"+select_e+" > .row > div").length
    for(i=0;i<size;i++){
        var count_num = $("#num_form").val()
        var div = $($("#element"+select_e+" > .row > div")[i]).html()
        var class_s = $($("#element"+select_e+" > .row > div")[i]).attr('class')
        var type_s = $($("#element"+select_e+" > .row > div")[i]).attr('menu-type')
        var $div_new = $("<div class='drop-item "+class_s+"' id='element"+count_num+"' sub-type='"+type_s+"'>"+div+"</div>")
        $div_new.append($('<button type="button" class="btn btn-danger btn-sm remove p-0"><i class="mdi mdi-close-thick"></i></button>').click(function () { $(this).parent().detach(); }));
        $div_new.append($('<button type="button" onclick="call_setting('+count_num+')" class="btn btn-primary btn-sm remove2 p-0" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="mdi mdi-cog"></i></button>'));
        $('#dropzone').append($div_new);
        count_num = parseInt(count_num)+1;
        $("#num_form").val(parseInt(count_num)+1)
        $div_new = "";
    }
    $("#element"+select_e).remove()

}

$(".btn-set").on('click',function(){
    var select_e = $("#size").val()
    var this_class = $(this).attr('set-class')
    $("#element"+select_e+" button.w-100").removeClass('btn-primary btn-secondary btn-success btn-info btn-warning btn-danger btn-dark btn-light')
    $("#element"+select_e+" button.w-100").addClass(this_class)
})

$("#set_text").keyup(function(){
    var text       = $(this).val()
    var select_e = $("#size").val()
    var type = $("#element"+select_e).attr('sub-type')
    if(type=='button'){
        $("#element"+select_e+" "+type+'.w-100').text(text)
    }else{
        $("#element"+select_e+" label").text(text)
    }
})

$("#set_name").keyup(function(){
    var name       = $(this).val()
    var select_e = $("#size").val()
    var type = $("#element"+select_e).attr('sub-type')
    if(type=='textarea'){
        $("#element"+select_e+" textarea").attr('name',name)
        $("#element"+select_e+" textarea").attr('id',name)
    }else if(type=='select'){
        $("#element"+select_e+" select").attr('name',name)
        $("#element"+select_e+" select").attr('id',name)
    }else{
        $("#element"+select_e+" input").attr('name',name)
        $("#element"+select_e+" input").attr('id',name)
    }
})

$("#set_placeholder").keyup(function(){
    var name       = $(this).val()
    var select_e = $("#size").val()
    var type = $("#element"+select_e).attr('sub-type')
    if(type=='textarea'){
        $("#element"+select_e+" textarea").attr('placeholder',name)
    }else{
        $("#element"+select_e+" input").attr('placeholder',name)
    }
})

$(".set-data-on-select").change(function(){
    var select_e = $("#size").val()
    var data_target = $(this).val()
    $("#element"+select_e+" select").text(null)
    $.post("{{url('api/api-data-form')}}",
    {
        event       : 'select',
        select_e    : data_target
    },
    function(data, status) {
        var option ="";
        data.forEach(element => {
            option+="<option value='"+element.id+"'>"+element.name+'</option>'
        });
        $("#element"+select_e+" select").append(option)
        $("#element"+select_e+" select").attr('data-target',data_target)
    })
})


function save_form(){

    var count_menu  = $('.drop-item').length
    var array_data  = [];
    var alert_text  = "";
    var count_alert = 0;
    var ar          = "";
    var save_form = $("#dropzone").html()
    $(".remove2").remove()
    $(".remove").remove()
    // console.log(save_form);
    for(i=0;i<count_menu;i++){
        var type        = "";
        var class_s     = "";
        var label       = "";
        var name        = "";
        var data_target = "";
        var placeholder = "";
        var this_type   = 'input';
        if($($('.drop-item')[i]).attr('sub-type')=='form'){
            ar = $($('.drop-item')[i]).find('input').val();
            if(ar){
                $($('.drop-item')[i]).attr('type','hidden')
            }else{
                count_alert = count_alert+1;
                alert_text += "Name Form "+count_alert+" Is Null"+"<br>"
            }
            array_data[ar] = [];
        }else{
            type        = $($('.drop-item')[i]).attr('sub-type')
            if(type=='text' || type=='number' || type=='radio' || type=='checkbox'){
                this_type = 'input';
            }else{
                this_type = type;
            }
            this_class      = $($('.drop-item')[i]).attr('class')
            this_html       = $($('.drop-item')[i]).html()
            if(this_html!=undefined){
                var gen_html    = "<div class='"+this_class+"'>"+this_html+"</div>"
                array_data[ar].push(gen_html)
            }
        }
    }
    if(count_alert==0){
        $(".drop-item[sub-type='form'] input").remove()
        var s = $("#dropzone").html()
        // console.log(array_data);
        // Swal.fire(
        //     'บันทึกสำเร็จ',
        //     '',
        //     'success'
        // )
        // setTimeout(() => {
        //     window.location.href="{{url('makeform')}}";
        // }, 1000);
        $.post("{{url('makeform')}}",
        {
            event       : 'make',
            form_data   : s
        },
        function(data, status) {
            console.log(data);
        })
        Swal.fire(
            'บันทึกสำเร็จ',
            '',
            'success'
        )
        setTimeout(() => {
            window.location.href="{{url('makeform')}}";
        }, 1000);
    }else{

        Swal.fire(
          'Form is Null',
           alert_text,
          'warning'
        )
    }

}



$(".set-group").on('click',function(){
    if($(this).attr('sub')=='set'){
        $(this).text('Compile')
        $(this).attr('sub','save')
        $(this).removeClass('btn-primary')
        $(this).addClass('btn-info')
            $(".menu-setting").append('<div class="form-check form-check-success ck-group"><input class="form-check-input" type="checkbox"></div>')
    }else{
        $(this).text('Set Group')
        $(this).attr('sub','set')
        $(this).removeClass('btn-info')
        $(this).addClass('btn-primary')
        var type_select = undefined;
        var count_check = $(".menu-setting").length
        var num_form = $("#num_form").val();
        var class_div = 'col-12'
        var new_group = '<div class="drop-item col-12 menu-setting" id="element'+num_form+'" sub-type="row"><div class="row">';
        for(i=0;i<count_check;i++){

            if($($('.menu-setting')[i]).find('.form-check-input').is(":checked")==true){
                $($('.menu-setting')[i]).find('.remove').remove()
                $($('.menu-setting')[i]).find('.remove2').remove()
                $($('.menu-setting')[i]).find('.ck-group').remove()
                class_div = check_col($($('.menu-setting')[i]))
                new_g = "<div class='"+class_div+"' menu-type='"+$($('.menu-setting')[i]).attr('sub-type')+"'>"
                type_select = $($('.menu-setting')[i]).html()
                new_group += new_g+type_select+"</div>"
                $($('.menu-setting')[i]).addClass('wait')
            }
        }
        new_group += "</div>"
        new_group +='<button type="button" onclick="call_setting('+num_form+')" class="btn btn-primary btn-sm remove2 p-0" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight"><i class="mdi mdi-cog"></i></button>';
        new_group += "</div>"
        $("#num_form").val(parseInt(num_form)+1)
        $(".wait").remove()
        var $set = $(new_group);
        $set.append($('<button type="button" class="btn btn-danger btn-sm remove p-0"><i class="mdi mdi-close-thick"></i></button>').click(function () { $(this).parent().detach(); }));
        $('#dropzone').append($set);
        $('.ck-group').remove()
    }
})


function check_a(id){
    if($("#ck"+id).is(":checked")==true){
        $("#ck"+id).attr('checked',true)
    }else{
        $("#ck"+id).attr('checked',false)
    }
}


function check_col(check){
    for(ii=1;ii<=12;ii++){
        if(check.hasClass('col-'+ii)){
            return 'col-'+ii
        }
    }
}

function set_text_style(style){
    var select_e = $("#size").val()
    $("#element"+select_e+" label").removeClass('fs-italic fs-inherit fs-initial fs-underline fs-blod fs-bloder fs-lighter fs-normal')
    $("#element"+select_e+" label").addClass(style)
}
function set_text_align(style){
    var select_e = $("#size").val()
    $("#element"+select_e).removeClass('text-left text-center text-right')
    $("#element"+select_e).addClass(style)
}


$(".set-scale").on('change',function(){
    var set_num = $(this).val()+'px'
    var class_s = $(this).attr('set')
    var select_e = $("#size").val()
    $("#element"+select_e).css(class_s,set_num)
})
</script>
@endsection
