@extends('layouts.layouts_index.main')

<link rel="stylesheet" href="{{url('public/css/registration/registration.css')}}" rel="stylesheet" type="text/css">
<link href="{{url('public/css/zoomify.css')}}" rel="stylesheet" type="text/css">
<link href="{{url('public/extra/fileinput/fileinput.css')}}" rel="stylesheet" type="text/css">
<input type="hidden" id="tabselect" value="0">
@section('style')
<style>


.choices__input{
    background: transparent !important;
}
 .img-pos{
    padding: 20px !important;
}
</style>
@endsection

@section('modal')
<div class="modal fade" id="warning_modal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered  modal-lg" role="document">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="myModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
                </div>
                <div class="modal-body">
                    <span id="warning_msg"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    {{-- <button type="button" class="btn btn-primary ">Save Changes</button> --}}
                </div>

            </div>
        </div>
    </div>
</div>
@endsection


@section('content')
@section('title-left')
    <h4 class="mb-sm-0">CREATE NEW</h4>
@endsection
@section('title-right')
    <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><a href="javascript: void(0);">Booking List</a></li>
        <li class="breadcrumb-item active">Create</li>
    </ol>
@endsection

<div class="col-12 cardcode" style="display: none">
    <div class="card card-custom gutter-b">
        <div class="card-body">
            <label id="discharge_toggle">
                <font size='4'><b>Page Detail</b></font>
            </label>
            <div class="row">
                <div class="col-12">
                    <a id="test123">RegistrationController -> Show</a>
                    <br>
                    Controller : <a
                        href="{{ url("autoit?run=visualcode_open\\endo.exe&path=RegistrationController") }}">RegistrationController</a>
                </div>
                <div class="col-12">
                    View : <a
                        href="{{ url("autoit?run=visualcode_open\\endo.exe&path=report/registration.blade.php") }}">report/registration.blade.php</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row" style="padding-top: 1em;margin:0;">
    <div class="col-4">
        <div class="card" style="height: 96%;">
            <div class="card-body">
                {{-- @dd($patient) --}}
                <input name="patientid" type="hidden" value="{{$id}}">
                <input name="useropen"  type="hidden" value="{{ uid() }}">
                <input name="hn" type="hidden" value="{{$patient->hn}}">
                    <div class="row">
                        <div class="col-6 text-left">
                            <div class="col-md-12"><label class="col-form-label"><font size="2"><b>HN :</b> {{ $patient->hn }}</label></font></div>
                            <div class="col-md-12"><label class="col-form-label"><font size="2"><b>AN :</b> {{check_val($patient->an,'ไม่มีข้อมูล')}}</label></font></div>
                            <div class="col-md-12"><label class="col-form-label"><font size="2"><b>Name :</b> {{check_val($patient->firstname,'ไม่มีข้อมูล')." ".$patient->lastname }}</label></font></div>
                        </div>
                        <div class="col-6 text-right">
                            @if($patient->pic=="")
                                <img  id="imgnew" src="{{asset('public/images/avatar.png')}}"  width="120px"/>
                            @else
                                <img  id="imgnew" src="{{url("public/pic_patient/$patient->pic")}}?a={{date("Y-m-dH:i:s")}}"  width="100px"/>
                            @endif
                            <br><a href="{{url("patient/$patient->_id/edit?prepage=")}}{{url()->full()}}"  class="btn btn-light" style="border: 1px solid gray"><b>Edit Patient profile</b></a>
                        </div>
                    </div>
                    @php
                    $gender = '-';
                        if(isset($patient->gender)){
                            $gen = $patient->gender;
                            if($gen == 1){
                                $gender = 'Male';
                            }elseif ($gen == 2){
                                $gender ='Female';
                            }
                        }
                    @endphp
                    <div class="col-md-12"><label class="col-form-label"><font size="2"><b>ID/Passport :</b> {{check_val(@$patient->citizen,'ไม่มีข้อมูล') }}</label></font></div>
                    <div class="col-md-12"><label class="col-form-label"><font size="2"><b>Age :</b>{{age(@$patient->birthdate,'ไม่มีข้อมูล')}}</label></font></div>
                    <div class="col-md-12"><label class="col-form-label"><font size="2"><b>Gender:</b> {{check_val($gender,'ไม่มีข้อมูล')}}</label></font></div>
                    <div class="col-md-12"><label class="col-form-label"><font size="2"><b>Allergic :</b> {{check_val(@$patient->allergic,'ไม่มีข้อมูล')}}</label></font></div>
                    <div class="col-md-12"><label class="col-form-label"><font size="2"><b>Contact :</b> {{check_val(@$patient->email,'ไม่มีข้อมูล')." ".$patient->phone}}</label></font></div>
                    <div class="col-md-12"><label class="col-form-label"><font size="2"><b>Emergency Contact :</b> {{check_val(@$patient->emer_name,'ไม่มีข้อมูล')." ".@$patient->emer_tel}}</label></font></div>
                    <div class="col-md-12"><label class="col-form-label"><font size="2"><b>Congenital disease :</b> {{check_val(@$patient->congenital_disease,'ไม่มีข้อมูล')}}</label></font></div>
                    </font>
                </label>
            </div>
        </div>
    </div>




    <div class="col-8">
        <div class="card">
            <div class="card-body">
                <form action="{{url("api/registration")}}" method="post" style="width: 100%;" id="regis_form">
                    @csrf
                    <input name="hn"        type="hidden" value="{{ $patient->hn }}">
                    <input name="useropen"  type="hidden" value="{{ uid() }}">
                    <div class="row">
                        <div class="form-group col-4">
                            <label><font size="2">นัดหมาย</font></label>
                                <input id="meet_date" name="meet_date" type="text" class="form-control flatpickr-input" data-provider="flatpickr" data-date-format="Y-m-d" readonly="readonly" value="{{ $today }}" onchange="check_procedure()"   required>
                        </div>





                        <div class="form-group col-4">
                            <label><font size="2">เวลา (ชั่วโมง)</font></label>
                            <select name='meet_hour' class='form-control textrrr' style='width:100%' id='meet_hor'>
                                @for ($i=0;$i<24;$i++)
                                    @php
                                    $select="";
                                    $num=str_pad($i, 2, '0', STR_PAD_LEFT);
                                    if($num==@$time[0]){$select="selected";}
                                    @endphp
                                    <option value='{{$num}}' @if($num == '08') selected @endif>{{$num}}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="form-group col-4">
                            <label><font size="2">เวลา (นาที)</font></label>
                            <select name='meet_minute' class='form-control textrrr' style='width:100%' id='meet_minute'>
                                @for($i=0;$i<60;$i=$i+10)
                                    @php
                                    $select="";
                                    $num=str_pad($i, 2, '0', STR_PAD_LEFT);
                                    if($num==@$time[1]){$select="selected";}
                                    @endphp
                                <option value='{{$num}}' {{$select}}>{{$num}}</option>
                                @endfor
                            </select>
                        </div>
                        @if (count($errors) > 0)
                        <div class="alert alert-danger">
                          <ul>
                            @foreach($errors->all() as $error)
                              <li>{{ $error }}</li>
                            @endforeach
                          </ul>
                        </div>
                       @endif
                       <div class="form-group col-4">
                            <label><font size="2">Procedure</font> <font color="red">*</font></label>
                            <div id="selectprocedure">
                                <select class="form-control" required="required" id="case_procedure" name="case_procedurecode[]" style="font-size: 13px; background: none;"
                                oninvalid="InvalidMsg(this);"  oninput="InvalidMsg(this);" onchange="check_show_procedure(this.value)"
                                data-choices data-choices-removeItem multiple >
                                    <option value="">เลือกการตรวจ</option>
                                    @foreach($procedure as $data)
                                        {{-- @php
                                            $is_disabled = isset($disabled_proc) ? in_array($data['code'], $disabled_proc) : false;
                                        @endphp --}}
                                        <option id="{{$data['code']}}" value="{{$data['code']}}" >{{$data['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-4">
                            <label><font size="2">Room</font></label><br>
                            {{-- @dd($room) --}}
                            <select class="form-control" name="room" data-choices >
                                <option value="">เลือกห้อง</option>
                                @foreach($room as $data)
                                {{-- <option value="{{$r->room_id}}" @if(intval($r->room_id) == intval(@$case->room)) selected @endif >{{$r->room_name}}</option> --}}
                                    <option value="{{$data['room_id']}}">{{$data['room_name']}}</option>
                                @endforeach
                            </select>

                            {{-- {!! Form::select('room',array(''=>'เลือกห้อง')+array_pluck($room,'room_name','room_id'),@$casedata->case_room,['class'=>'form-control']) !!} --}}
                        </div>

                        <div class="form-group col-4">
                            <label><font size="2">Endoscopist</font> <font color="red">*</font></label>
                            <select class="form-control savejson selectpicker" id="s_endoscopist" name="case_physicians01" required data-live-search="true"
                            oninvalid="InvalidMsg1(this);"
                            oninput="InvalidMsg1(this);"
                            data-choices required>
                                <option value="">เลือกแพทย์</option>
                                @foreach($doctor_select as $data)
                                    <option value="{{$data['id']}}">{{$data['user_prefix']}}{{$data['user_firstname']}} {{$data['user_lastname']}}</option>
                                @endforeach
                            </select>

                            {{-- {!!userSELECT('case_physicians01','เลือกแพทย์',$doctor_select,@$json->case_physicians01,'class="form-control savejson selectpicker" required data-live-search="true"')!!} --}}
                        </div>

                        <div class="form-group col-md-12">
                            <label>Attendant</label>
                            <select class="form-control selectpicker" id="select_users" name="part"  data-choices data-choices-removeItem multiple >
                                <option value="" disabled>Select Users</option>
                                @if(isset($users))
                                    @foreach ($users as $data)
                                    <option
                                        value       = "{{@$data['id']}}"
                                        data-tokens = "{{@$data['id']}}"
                                        data-name   = "{{@$data['user_prefix']}} {{@$data['user_firstname']}} {{@$data['user_lastname']}}"
                                        data-type   = "{{@$data['user_type']}}"
                                        data-tab    = "{{@$data['id']}}">
                                        {{@$data['user_prefix']}} {{@$data['user_firstname']}} {{@$data['user_lastname']}} {{@$data['user_code']}}
                                    </option>
                                    @endforeach
                                @endif

                            </select>
                            <div class="row m-0" id="scroll_list"></div>

                            <input type="hidden" name="user_in_case" id="user_in_case">
                        </div>



                        {{-- @dd($word->opd); --}}
                        <div class="form-group col-md-4">
                            <label><font size="2">Clinic</font></label>
                            <input id="opd" name="opd" class="form-control savejson autotext" type="text" autocomplete="off">
                        </div>
                        <div class="form-group col-md-4">
                            <label><font size="2">Ward</font></label>
                            <input id="ward" name="ward" class="form-control savejson autotext" type="text" autocomplete="off">
                        </div>
                        <div class="form-group col-md-4">
                            <label><font size="2">Refer</font></label>
                            <input id="refer" name="refer" class="form-control savejson autotext" type="text" autocomplete="off">
                        </div>
                        {{--
                        <div class="form-group col-md-6"><label><font size="2">{{$word->physicians02}}</font></label>
                            {!!userSELECT('doctor02','เลือกแพทย์',$doctor_select,@$json->doctor02,'class="form-control savejson"')!!}
                        </div>
                        <div class="form-group col-md-6"><label><font size="2">{{$word->physicians03}}</font></label>
                            {!!userSELECT('doctor03','เลือกแพทย์',$doctor_select,@$json->doctor03,'class="form-control savejson"')!!}
                        </div>


                        <div class="form-group col-md-6"><label><font size="2">{{$word->nurse01}}</font></label>
                            {!!userSELECT('nurse01','เลือกพยาบาล',$nurse_select,@$json->nurse01,'class="form-control savejson"')!!}
                        </div>
                        <div class="form-group col-md-6"><label><font size="2">{{$word->nurse02}}</font></label>
                            {!!userSELECT('nurse02','เลือกพยาบาล',$nurse_select,@$json->nurse02,'class="form-control savejson"')!!}
                        </div>

                        <div class="form-group col-md-6"><label><font size="2">{{$word->nurse03}}</font></label>
                            {!!userSELECT('nurse03','เลือกผู้ช่วยพยาบาล',$register_select,@$json->nurse03,'class="form-control savejson"')!!}
                        </div>
                        <div class="form-group col-md-6"><label><font size="2">{{$word->nurse04}}</font></label>
                            {!!userSELECT('nurse04','เลือกผู้ช่วยพยาบาล',$register_select,@$json->nurse04,'class="form-control savejson"')!!}
                        </div>

                        <div class="form-group col-md-6"><label><font size="2">วิสัญญีแพทย์</font></label>
                            {!!userSELECT('anes','เลือกวิสัญญีแพทย์',$anes_select,@$json->anes,'class="form-control savejson"')!!}
                        </div>--}}

                        <div class="form-group col-md-12"><label><font size="2">Treatment Coverage (สิทธิการรักษา)</font></label>
                            <select class="form-control savejson" name="treatment_coverage" data-choices >
                                <option value="">เลือกสิทธิการรักษา</option>
                                @foreach ($tb_treatmentcoverage as $data)
                                    <option value="{{$data['name']}}">{{$data['name']}}</option>
                                @endforeach
                            </select>


                            {{-- {!! Form::select('righttotreatment',array(''=>'ไม่มีข้อมูล')+array_pluck(@$righttotreatment,'name','name'),'',['class'=>'form-control savejson','id'=>'righttotreatment']) !!} --}}
                        </div>
                        <div class="form-group col-md-6">
                            <label>
                                <font size="2">Pre-diagnosis</font>
                                @if(configTYPE('required','prediagnosis'))<font color="red"> *</font>@endif
                            </label>
                            @if(configTYPE('required','prediagnosis'))
                                <input id="prediagnostic_other" name="prediagnostic_other" class="form-control savejson autotext" type="text" autocomplete="off"
                                required>
                            @else
                                <input id="prediagnostic_other" name="prediagnostic_other" class="form-control savejson autotext" type="text" autocomplete="off">
                            @endif
                        </div>
                        <div class="form-group col-md-6">
                            <label>
                                <font size="2">Type of case</font>
                            </label>
                            <input id="typeofcase" name="typeofcase" class="form-control savejson autotext" type="text" autocomplete="off">
                        </div>
                        <div hidden>
                            <input type="text" name="redirect" value="" id="redirect">
                            <button id="show_modal_btn" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#warning_modal"></button>
                        </div>
                        <div class="row mt3em">
                            <div class="col text-start" >
                                <button id="savestep04" type="submit" class="btn btn-orange font-weight-bold  mr-2 btn-lg">
                                <span>บันทึกเเละกลับหน้าหลัก&nbsp;</span></button>
                            </div>

                            <div class="col text-end">
                                <button id="takephoto" type="submit" name="takephoto" value="takephoto" class="btn btn-submit btn-primary font-weight-bold mr-2 btn-lg">
                                <span>บันทึกเเละถ่ายรูป</span></button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
            @include("EndoCAPTURE.camera.modal.modal_progress_camera")
    @endsection
    @section('script')
    <script src="{{url('public/js/jquery.input-dropdown.js')}}"></script>

    <script>

// $(".js-example-theme-multiple").select2({
//   theme: "classic"
// });


        $("#savestep04, #takephoto").on('click',function(){
            var procedure           = $("#case_procedure").val()
            var physicians          = $("#case_physicians01").val()
            var prediagnostic_other = $("#prediagnostic_other").val();
            //
            var endoscopist       = $("#s_endoscopist").val()
            //

            if(procedure!='' && physicians!='' && prediagnostic_other!='' && endoscopist!=''){
                $(".btn-lg").hide();
                $("#modal_progress_camera").modal('show')
            }else if(procedure=='' && physicians==''){
                $('#case_procedure').addClass('border-danger')
                $('button[data-id="case_physicians01"]').addClass('border-danger')
            }else if(procedure==''){
                $('#case_procedure').addClass('border-danger')
            }else if(physicians==''){
                $('button[data-id="case_physicians01"]').addClass('border-danger')
            }

            if(endoscopist == ''){
                $("#s_endoscopist").addClass('border-danger')
            }
        });

        $("#s_endoscopist").change(function(){
            $(this).removeClass('border-danger')
        })
        $('#case_procedure').change(function(){
            $(this).removeClass('border-danger')
        })
        $('#case_physicians01').change(function(){
            $('button[data-id="case_physicians01"]').removeClass('border-danger')
        })


    $('.autotext').on('click keyup',function(){
        var procedure   = "";
        var this_id     = $(this).attr('id');
        var this_value  = $(this).val();
        var check       = $('#case_procedure').val();
        if(check!=""){procedure=check;}else{procedure=0;}
        $.post("{{url('api/photo')}}",{
            event       : 'jqinputdropdown',
            textid      : this_id,
            value       : this_value,
            procedure   : procedure,
        },function(data,status){
            dataList = [];
            dataList = JSON.parse(data);
            $('#'+this_id).inputDropdown(dataList, {
                formatter: data => {return `<li language="${data.value}">`+data.name+'</li>'},
                valueKey: 'language'
            });
            var wi = $('#'+this_id).css('width');
            $('.jq-input-dropdown').css({'min-width':wi});
            $('#jq-input-dropdown_'+this_id).show();
            var html_li = "";
            dataList.forEach(obj => {
                html_li += '<li language="'+obj['value']+'">'+obj['value']+'</li>';
            });
            $('#jq-input-dropdown_'+this_id).html(html_li);
            $('li').on('click',function(){
                $('#'+this_id).focus();
            });
        });
    });

    check_procedure()

    var procedures = []
    var old;
    function check_procedure(){
        var all_select = $('div').find('.choices__inner').find(`[data-value*="0"]`)
        for (let i = 0; i < all_select.length; i++) {
            var elem = all_select[i];
            var data_id = $(elem).data('id')
            var data_value = $(elem).data('value')
            var data_text  = $(elem).text()
            data_text = data_text.replace('Remove item', '')
            procedures.push(
            `<div id="choices--case_procedure-item-choice-${data_id}" class="choices__item choices__item--choice choices__item--selectable"`+
            `role="option" data-choice="" data-id="${data_id}" data-value="${data_value}" data-select-text="Press to select" data-choice-selectable="" >${data_text}</div>`)

        }

        $('div').find('.choices__inner').find(`[data-value*="0"]`).remove()
        var to_append = $('#selectprocedure').find('.choices__list').find('.choices__list')
        if(procedures != undefined){
            if(procedures.length > 0){
                procedures.forEach((e, i) => {
                    $(to_append).append(e)
                })
            }
        }


        $('div').find('.choices__list').find(`[data-value*="0"]`).css('pointer-events', '')
        $('div').find('.choices__list').find(`[data-value*="0"]`).css('color', 'black')

        check_procedure_ajax()
    }

    function check_show_procedure(val){
        check_procedure_ajax()
    }

    function check_procedure_ajax(){
        var appointment = $('#meet_date').val()
        $.post("{{url('api')}}/registration",{
            event: "check_create_case",
            date : appointment,
            hn   : '{{@$patient->hn}}',
        }, function (data, status) {
            var parse = JSON.parse(data)
            $('div').find('.choices__list').show()
            if(parse != undefined && parse != '' && parse != []){
                parse.forEach((e, i) => {
                    // $('div').find('.choices__list').find(`[data-value="${e}"]`).hide()
                    $('div').find('.choices__list').find(`[data-value="${e}"]`).css('pointer-events', 'none')
                    $('div').find('.choices__list').find(`[data-value="${e}"]`).css('color', '#53565A')
                    // procedures.push(e)
                })
            }
        })
    }

    function InvalidMsg(textbox){
        if (textbox.value ===''){
            textbox.setCustomValidity('โปรดเลือกการตรวจ');

        } else {
           textbox.setCustomValidity('');
        }
        return true;
        }

        function InvalidMsg1(textbox){
        if (textbox.value ===''){
            textbox.setCustomValidity('โปรดเลือกแพทย์');
            // $('this').css('border','1px solid red;');
        } else {
           textbox.setCustomValidity('');
        }
        return true;
        }

        $('.savejson').bind('focusout',function(){
            var this_id     = $(this).attr('id');
            var this_type   = $(this).attr('type');
            var procedure   = "";
            var check = $('#case_procedure').val();
            if(check!=""){procedure=check;}else{procedure=0;}

            if(this_type=="checkbox"){
                $.post('{{url('api/photomove')}}',{
                    event       : 'savejson2',
                    name        : this_id,
                    value       : $(this).prop('checked'),
                    field       : 'case_json',
                    procedure   : "0",
                },function(data,status){});
            }else{
                $.post('{{url('api/photomove')}}',{
                    event       : 'savejson2',
                    name        : this_id,
                    value       : $('#'+this_id).val(),
                    field       : 'case_json',
                    procedure   : "0",
                },function(data,status){});
            }
        });

        // $('.btn-submit').click(function(){
        //     var case_procedure      = $('#case_procedure').val();
        //     var case_physicians01   = $('#case_physicians01').val();
        //     if(case_procedure!="" && case_physicians01!=""){
        //         $('.btn-submit').hide();
        //         $('#modal_progress').modal('show');
        //     }
        // });


        $('input[type=text]').each(function() {
            if($(this).val() != '' && $(this).val() != null){
                $(this).css('background','#d2ebf6');
            }else{
            }
        });
        $('select').each(function() {
            if($(this).val() != '' && $(this).val() != null){
                $(this).css('background','#d2ebf6');
            }else{
            }
        });
        $('input[type=number]').each(function() {
            if($(this).val() != '' && $(this).val() != null){
                $(this).css('background','#d2ebf6');
            }else{
            }
        });
        $('textarea').each(function() {
            if($(this).text() != '' && $(this).text() != null){
                $(this).css('background','#d2ebf6');
            }else{
            }
        });
        $('.form-control').focusout(function(){
            var text_val = $(this).val();
            if(text_val !=null&& text_val != ''){
                $(this).css('background','#d2ebf6');
            }else{
                $(this).css('background','none');
            }
        })


    </script>

<script>
    $("#select_users").change(function() {
        var value   = $(this).val()
        var select  = $("#select_users option[value='" + value + "']");
        var type    = select.attr('data-type');
        var names   = select.attr('data-name')
        var tab     = select.attr('data-tab');
        var array_data = "";
        if (value != []) {
            // var lists = "<div class='col-7 set-data pt-2' sub-tab=" + value + ">" + names +
            //     "</div><div class='col-3 pt-2'sub-tab=" + value + ">" + type +
            //     "</div><div class='col-2 pt-2'sub-tab=" + value +
            //     "><i class='fa fa-times text-danger' aria-hidden='true' onclick='del_list(" + value +
            //     ")'></i></div>"
            // $("#scroll_list").append(lists)
            list_user_save(value)
        }
    });
    function list_user_save(data_array){
        // count_list = $("#scroll_list .col-7").length
        // var data_array = []
        // for(i=0;i<count_list;i++){
        //     data_array[i] = $($("#scroll_list .col-7")[i]).attr('sub-tab')
        // }
        var my_json = JSON.stringify(data_array)
        $("#user_in_case").val(my_json)
        $("#user_in_case").focusout();
    }
    function del_list(data) {
        $("div[sub-tab='" + data + "'").remove()
    }

</script>

<script>

    function check_form(btn_id) {
        var procedure = $('#case_procedure').val()
        var doctor    = $('#s_endoscopist').val()

        var action = btn_id == 'takephoto' ? 'camera' : 'home'
        $('#redirect').val(action)

        var warning_msg = ''
        if(doctor == '' && procedure == ''){
            $('#warning_msg').html('โปรดเลือการตรวจและแพทย์')
            // $('#show_modal_btn').click()
        } else if (doctor == undefined){
            $('#warning_msg').html('โปรดเลือกแพทย์')
            // $('#show_modal_btn').click()
        } else if(procedure == undefined){
            $('#warning_msg').html('โปรดเลือการตรวจ')
            // $('#show_modal_btn').click()
        } else {
            $.post('{{url('api/registration')}}',{
                event       : 'check_same_hn',
                hn          : '{{@$patient->hn}}',
                appointment : $('#meet_date').val(),
                procedure   : procedure
            },function(data,status){
                var status = data
                if(status == 'true'){
                    $('#regis_form').submit()
                } else if(status == 'false'){
                    $('#warning_msg').html('ไม่สามารถสร้างเคสได้')
                    $('#show_modal_btn').click()
                }
            });
        }

    }
</script>

@php
$head = configTYPE('pdf', 'pdf_folder_head');
$pathhispatient = $_SERVER['DOCUMENT_ROOT']."/config/views/his/$head/user_get_detail.blade.php";
@endphp

@if(is_file($pathhispatient))
@include("his.$head.user_get_detail")
@else
@include("endo.patient.his.00000")
@endif

    @endsection
