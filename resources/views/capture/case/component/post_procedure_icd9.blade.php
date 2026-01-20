@php
    $admin = getConfig('admin');
    if (@$admin->icd_toggle_ck) {
        $icd_toggle_ck = 'active';
    } else {
        $icd_toggle_ck = '';
    }
@endphp
<style>
    div[id^="icd9_group"] .row .col-12 {
        display: inherit;
        padding-left: 2em;
    }
    .btn-transparent{
        background: transparent;
    }
</style>
<div class="col-12 p-0">
    <div class="card card-custom gutter-b">
        <div class="card-body">
            @php
                $post_diag      = isset($case->procedure_sub) ? $case->procedure_sub : [];
                $procedureicd9  = isset($procedure->icd9) ? $procedure->icd9 : [];
                $proicd9array   = @$case->procedure_sub;

            @endphp
            <div class="row">
                @php
                    if (!function_exists('check_string')) {
                        function check_string($data, $array)
                        {
                            if (isset($data)) {
                                foreach ($array as $value) {
                                    if (strpos($data, @$value->proicd9_name) !== false) {
                                        if (isset($value->proicd9_id)) {
                                            echo "subid=@$value->proicd9_id";
                                        }
                                    }
                                }
                            }
                        }
                    }
                @endphp

                <div class="col-xxl-6">
                    <div class="row" style="line-height: 2em;">
                        <div class="col-12">
                            <div class="h5">POST-PROCEDURE (Procedure)
                                <button type="button" class="btn btn-transparent" id="modal_icd9"><i class="ri-equalizer-line"></i></button>
                            </div>
                        </div>


                        @foreach ($procedureicd9 as $keyname=>$icd9data)

                            @php
                                $data   = $icd9data[0];
                                $count  = count($icd9data);
                            @endphp

                            {{-- @if (true) --}}
                            @if ($count == 1)
                                <div class="col-6 form-inline" style="padding-bottom: 5px;">
                                    <div class="row">
                                        <div class="col-auto">
                                            <input id="icdnine{{ md5($keyname) }}" type="checkbox"
                                                class="form-check-input savejson_checkbox boxicd9" name="procedure_sub"
                                                icd9code="{{ $data['code'] }}"
                                                icd9_billprice="{{ $data['price'] }}"
                                                icd9_billname="{{ $data['bill'] }}"
                                                value="{{ $keyname }}"
                                                value2="{{ $keyname }}"
                                                {{-- ckid="{{ $data['proicd9_id'] }}" --}}
                                                ckid="{{ $data['code'] }}"

                                                {{ in_array($keyname, $post_diag) ? 'checked' : '' }}>
                                            <label class="form-check-label ms-4"
                                                for="icdnine{{ md5($keyname) }}">{{ $keyname }}</label>
                                            @php
                                                if ($proicd9array == null) {
                                                    $proicd9array = [];
                                                }
                                            @endphp
                                        </div>

                                        <div class="col-2">
                                            @isset ($data['extra_text'])
                                                @php
                                                    $extravalue = '';
                                                @endphp
                                                @foreach ($proicd9array as $text => $value)
                                                    @php
                                                        $variebletype = gettype($value);
                                                        if ($variebletype == 'object') {
                                                            foreach ($value as $key => $v) {
                                                                if ($data['code'] == $key) {
                                                                    $extravalue = $v;
                                                                }
                                                            }
                                                        }
                                                    @endphp
                                                @endforeach
                                                @php
                                                    $icd9sub = 'icd9text' . $data['code'];
                                                @endphp
                                                <input type="number" name="proicd9[][{{ $data['code'] }}]"
                                                    id="icd9text{{ $data['code'] }}"
                                                    unit="{{ $data['extra_text'] }}"
                                                    textboxicd9="{{ $keyname }}"
                                                    class="form-control form-control-sm  ontext savejson textboxicd9"
                                                    value="{{ @$case->$icd9sub }}"
                                                    txtckid="{{ $data['code'] }}" />
                                            @endisset
                                        </div>
                                        <div class="col-auto">
                                            {{ @$data['extra_text'] }}
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="col-6 form-inline">
                                    <div class="row">
                                        <div class="col-auto form-inline icd9_group "
                                            icd9_group="{{ md5($keyname) }}">
                                            @php
                                                $groupid = 'icdninegroup' . $data['code'];
                                                $icd9g = 'toggle_' . md5($keyname);
                                                $groupshow = 'none2';
                                            @endphp
                                            <input type="checkbox" id="toggle_{{ md5($keyname) }}"
                                                name="toggle_{{ md5($keyname) }}" value="{{ @$case->$icd9g }}"
                                                @if (@$case->$icd9g == 'show') checked @endif
                                                class="form-check-input toggle-checkbox">
                                            <span
                                            click="toggle_{{ md5($keyname) }}"
                                                class="form-check-label ms-4 icon-on icd9checkbox111"
                                                {{-- for="toggle_{{ md5($keyname) }}" --}}

                                                >
                                                {{ $keyname }}
                                    </span>
                                        </div>

                                        <div id="icd9_group{{ md5($keyname) }}" class="col-12 "
                                            style="display:{{ isset($case->$icd9g) ? $case->$icd9g : 'none' }}">
                                            <div class="row m-0">

                                                @foreach ($icd9data as $data2)

                                                <div class="col-12">
                                                    <div class="form-check  checkbox checkbox-index">
                                                            <input id="icdnine{{ $data2['name'] }}" type="checkbox"
                                                                class="form-check-input savejson_checkbox boxicd9"
                                                                name="procedure_sub" icd9code="{{ $data2['code'] }}"
                                                                icd9_billprice="{{ $data2['price'] }}"
                                                                icd9_billname="{{ $data2['bill'] }}"
                                                                value="{{ $data2['name'] }}"
                                                                value2="{{ $data2['name'] }}"
                                                                ckid="{{ $data2['code'] }}"
                                                                {{ checkselect($data2['name'], @$case->procedure_sub) }}>
                                                            <span></span>
                                                            <label class="form-check-label "
                                                                for="icdnine{{ $data2['name'] }}">{{ $data2['name'] }}</label>
                                                        </div>
                                                        @isset ($data2['extra_text'])
                                                            @php
                                                                $extravalue = '';
                                                            @endphp
                                                            @foreach ($proicd9array as $text => $value)
                                                                @php
                                                                    $variebletype = gettype($value);
                                                                    if ($variebletype == 'object') {
                                                                        foreach ($value as $key => $v) {
                                                                            if ($data2['code'] == $key) {
                                                                                $extravalue = $v;
                                                                            }
                                                                        }
                                                                    }
                                                                @endphp
                                                            @endforeach

                                                            {{ nbsp(4) }}

                                                            @php
                                                                $icd9sub = 'icd9text' . $data2['code'];
                                                            @endphp
                                                            <input type="number"
                                                                name="proicd9[][{{ $data2['code'] }}]"
                                                                id="icd9text{{ $data2['code'] }}"
                                                                unit="{{ $data2['extra_text'] }}"
                                                                textboxicd9="{{ $data2['name'] }}"
                                                                class="form-control form-control-sm w-25 ontext savejson  textboxicd9"
                                                                value="{{ @$case->$icd9sub }}" style="height: 25px"
                                                                txtckid="{{ $data2['code'] }}" />
                                                            &nbsp;{{ $data2['extra_text'] }}
                                                        @endisset



                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        <div class="col-11" style="margin-top:15px;">
                            <textarea id='overall_procedure' name="formsubmit_overall_procedure" type="text" rows="6"
                                placeholder="Free text" class="savejson form-control autotext">{{ checknotarray(@$case->overall_procedure) }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-6">
                    @php
                        if (isset($case_json->procedure_subtext)) {
                            $icd9value = jsonDecode($case_json->procedure_subtext);
                        }
                    @endphp
                    <div class="row pd_col" style="align-items: center;">
                        <div class="col-12">&emsp;</div>

                        <div class="col-12">
                            <button type="button" class="btn btn-checkbox btn-label waves-effect waves-light btn-sm"
                                id="btn_none_other_procedure">
                                <i class="ri-checkbox-blank-line label-icon align-middle fs-16 me-2 text-light"></i>
                                None other Procedure
                            </button>
                        </div>

                        {{-- id="diag{{md5("case->diagnostic_text[0]")}}"
                        group="diagnostic"
                        class="form-control texticd10 autotextgroup" --}}



                        <div class="col-12">
                            <div class="input-group">
                                <input
                                    id="icd9{{md5("case->procedure_subtext[0]")}}"
                                    group="icd9"
                                    type="text" {{ check_string(@$icd9value[0], $procedureicd9) }}
                                    box=""
                                    value="{{ @$case->procedure_subtext[0] }}"
                                    name="formsubmit_procedure_subtext[]"
                                    ckid="" textset=""
                                    class="form-control form-control-sm procedure_subtext autotextgroup clear-text"
                                    placeholder="Principal Procedure" autocomplete="off">
                                <span class="input-group-text" id="basic-addon2">ICD-9</span>
                            </div>
                        </div>
                        <div class="col-12 mt-2">
                            <div class="input-group">
                                <input
                                id="icd9{{md5("case->procedure_subtext[1]")}}"
                                group="icd9"

                                type="text" {{ check_string(@$icd9value[1], $procedureicd9) }} box=""
                                    value="{{ @$case->procedure_subtext[1] }}" name="formsubmit_procedure_subtext[]"
                                    ckid="" textset="" id="cd92" placeholder="Other Procedure"
                                    class="form-control form-control-sm procedure_subtext autotextgroup"
                                    autocomplete="off">
                                <span class="input-group-text" id="basic-addon2">ICD-9</span>
                            </div>
                        </div>
                        <div class="col-12 mt-2">
                            <div class="input-group">
                                <input
                                id="icd9{{md5("case->procedure_subtext[2]")}}"
                                group="icd9"

                                type="text" {{ check_string(@$icd9value[2], $procedureicd9) }} box=""
                                    value="{{ @$case->procedure_subtext[2] }}" name="formsubmit_procedure_subtext[]"
                                    ckid="" textset="" id="cd93" placeholder="Other Procedure"
                                    class="form-control form-control-sm procedure_subtext autotextgroup"
                                    autocomplete="off">
                                <span class="input-group-text" id="basic-addon2">ICD-9</span>
                            </div>
                        </div>
                        <div class="col-12 mt-2">
                            <div class="input-group">
                                <input
                                id="icd9{{md5("case->procedure_subtext[3]")}}"
                                group="icd9"
                                type="text" {{ check_string(@$icd9value[3], $procedureicd9) }} box=""
                                    value="{{ @$case->procedure_subtext[3] }}" name="formsubmit_procedure_subtext[]"
                                    ckid="" textset="" id="cd94" placeholder="Other Procedure"
                                    class="form-control form-control-sm procedure_subtext autotextgroup"
                                    autocomplete="off">
                                <span class="input-group-text" id="basic-addon2">ICD-9</span>
                            </div>
                        </div>
                        <div class="col-12 mt-2">
                            <div class="input-group">
                                <input
                                id="icd9{{md5("case->procedure_subtext[4]")}}"
                                group="icd9"
                                type="text" {{ check_string(@$icd9value[4], $procedureicd9) }} box=""
                                    value="{{ @$case->procedure_subtext[4] }}" name="formsubmit_procedure_subtext[]"
                                    ckid="" textset="" id="cd95" placeholder="Other Procedure"
                                    class="form-control form-control-sm procedure_subtext autotextgroup"
                                    autocomplete="off">
                                <span class="input-group-text" id="basic-addon2">ICD-9</span>
                            </div>
                        </div>
                        <div class="col-12 mt-2">
                            <div class="input-group">
                                <input
                                id="icd9{{md5("case->procedure_subtext[5]")}}"
                                group="icd9"
                                type="text" {{ check_string(@$icd9value[5], $procedureicd9) }} box=""
                                    value="{{ @$case->procedure_subtext[5] }}" name="formsubmit_procedure_subtext[]"
                                    ckid="" textset="" id="cd96" placeholder="Other Procedure"
                                    class="form-control form-control-sm procedure_subtext autotextgroup"
                                    autocomplete="off">
                                <span class="input-group-text" id="basic-addon2">ICD-9</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-12">&nbsp;</div>
                        @php
                            $acc = isset($case_json->recommendation) ? $case_json->recommendation : '';
                        @endphp
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $("#modal_icd9").click(function () {

        $("#custom-report-icd9").modal('show')
    })
</script>
<script>

    $(".icd9checkbox").click(function() {
        let click = $(this).attr("click");
        $("#" + click).trigger("click");
    });


    $('.toggle-checkbox').bind('click', function() {
        let this_id = $(this).attr('id');
        let this_name = $(this).attr('name');
        let this_table = $(this).attr('tb_case');
        let value = $(this).attr('value');
        if (value != 'show') {
            value = 'show';
        } else {
            value = 'none';
        }
        $(this).attr('value', value);
        console.log(this_name, value);
        $.post('{{ url('api/procedure') }}', {
            event: 'savejson',
            name: this_id,
            value: value,
            table: this_table,
            field: 'case_json',
            id: '{{ $cid }}',
            comcreate: '{{ $case->comcreate }}',
            procedure: '{{ $procedure->code }}',
        }, function(data, status) {});
    });


    $("#btn_none_other_procedure").click(function() {
        $(".procedure_subtext").val("");
        $(".clear-text").val("None Other Procedure");
        updateprocedure_subtext(true);
        clear_checkbox()
    });


    function clear_checkbox() {
        var icd9_ck_lg = $('.boxicd9').length
        for (let i = 0; i < icd9_ck_lg; i++) {
            $($('.boxicd9')[i]).prop('checked', false)
        }

        var icd9_gp = $('.icd9_group_ck').length
        for (let j = 0; j < icd9_gp; j++) {
            $($('.icd9_group_ck')[j]).prop('checked', false)
        }
        save_localstorage('icdninegroup', [])

        $.post('{{ url('api/jquery') }}', {
            event: 'savejson_checkbox2',
            idhtml: 'icdninegroup',
            value: [],
            idname: 'case_id',
            id: '{{ $cid }}',
            procedure: '{{ $procedure->code }}',
        }, function(data, status) {});

        var empty_arr = []
        update_procedure_subtext(empty_arr)
    }

    $('.icd9_group_ck').on('click', function() {
        let icd9group_lg = $('.icd9_group_ck').length;
        let sub = [];
        for (let i = 0; i < icd9group_lg; i++) {
            let group_id = $($('.icd9_group_ck')[i]).attr('id').replace('icdninegroup', '')
            let status = $($('.icd9_group_ck')[i]).is(':checked')
            if (status) {
                sub.push(group_id)
            }
        }
        save_localstorage('icdninegroup', sub)

        $.post('{{ url('api/jquery') }}', {
            event: 'savejson_checkbox2',
            idhtml: 'icdninegroup',
            value: sub,
            idname: 'case_id',
            id: '{{ $cid }}',
            procedure: '{{ $procedure->code }}',
        }, function(data, status) {});

    })

    function update_procedure_subtext(value) {
        $.post("{{ url('api/photo') }}", {
            event: "case_update",
            key: "procedure_sub",
            val: value,
            cid: "{{ $cid }}"
        }, function(data, status) {});
    }


    $(".icd9_group").click(function() {
        var icd9_group = $(this).attr('icd9_group');
        $("#icd9_group" + icd9_group).slideToggle();
    });

    $("#icd09_normal").click(function() {
        if ($(this).prop('checked')) {
            $(".boxicd9").prop('checked', false).focusout()
            $(".icd9_group input").prop('checked', false).focusout()
            $(".procedure_subtext").val('').focusout();
            $("#overall_procedure").val('').focusout();
        }
    })


    $("#icd9_normal").click(function() {
        if ($(this).is(':checked')) {
            $(".boxicd9").prop('checked', false).focusout()
            $(".procedure_subtext").val('').focusout();
            icd9_normal_set();
            var arr = new Array();
            $.post('{{ url('api/jquery') }}', {
                event: 'savejson_checkbox2',
                idhtml: "procedure_sub",
                value: arr,
                table: 'tb_case',
                idname: 'case_id',
                id: '{{ $cid }}',
                procedure: '{{ @$procedure->code }}',
            }, function(data, status) {});
            $.post('{{ url('api/jquery') }}', {
                event: 'savejson_checkbox2',
                idhtml: 'billingicd9',
                value: arr,
                table: 'tb_case',
                idname: 'case_id',
                id: '{{ $cid }}',
                procedure: '{{ @$procedure->code }}',
            }, function(data, status) {});
            updateprocedure_subtext();
        }
    })

    function check_icd9_ck() {
        var save_ck = 2;
        var icd10_ck = $(".boxicd9").length
        for (i = 0; i < icd10_ck; i++) {
            if ($($(".boxicd9")[i]).is(':checked')) {
                $("#icd9_normal").prop('checked', false).focusout()
                save_ck = 1;
            }
        }
        if (save_ck == 2) {
            $("#icd9_normal").prop('checked', true).focusout()
            icd9_normal_set()
        }
    }

    function icd9_normal_set() {
        if ($("#icd9_normal").is(':checked')) {
            $("#change_icd9 tr").remove()
        }
    }

    $('.boxicd9').click(function() {
        var firsttext = $($('.procedure_subtext')[0]).val()
        if (firsttext.includes('None Other')) {
            $($('.procedure_subtext')[0]).val('')
        }

        let checkbox_val = $(this).attr("value2");
        var ckstatus = $(this).prop('checked');
        var subid = $(this).attr('ckid');
        var procedure_subtext = $(".procedure_subtext").map(function() {
            return $(this).val();
        }).get();
        var filltext = true;

        if (!ckstatus) {
            $(".procedure_subtext").map(function() {
                var str = $(this).val();
                var str_ori = escapeRegExp(checkbox_val);
                var str_end = escapeRegExp(str);
                var find = str_end.search(str_ori);
                if (find == 0) {
                    $(this).val("");
                    $(this).focus();
                }
            });
        }

        if (ckstatus) {
            $(".procedure_subtext").map(function() {
                if ($(this).val() === checkbox_val) {
                    filltext = false;
                }
                if ($(this).val() === "" && filltext) {
                    var stricd9 = $("[textboxicd9='" + checkbox_val + "']").val();
                    var uniticd9 = $("[textboxicd9='" + checkbox_val + "']").attr("unit");
                    if (stricd9 != undefined && stricd9 != "") {
                        var newstr = checkbox_val + " " + stricd9 + " " + uniticd9;
                        $(this).val(newstr);
                    } else {
                        $(this).val(checkbox_val);
                    }
                    $(this).focus();
                    filltext = false;
                }
            });
        }

        check_icd9_ck()
        updateprocedure_subtext();
    });


    function escapeRegExp(str) {
        return str.replace(/[.*+?^${}()|[\]\\]/g, "@"); // $& means the whole matched string
    }

    $('.textboxicd9').focusout(function() {
        let textval     = $(this).val();
        let textboxicd9 = $(this).attr('textboxicd9');
        let boxicd9     = $(".boxicd9[value='"+textboxicd9+"']").prop("checked");
        if(boxicd9){
            $(".boxicd9[value='"+textboxicd9+"']").trigger("click");
            $(this).val(textval);
            $(".boxicd9[value='"+textboxicd9+"']").trigger("click");
        }else{
            $(".boxicd9[value='"+textboxicd9+"']").trigger("click");
        }
    });



    $(".procedure_subtext").focusout(function() {
        updateprocedure_subtext();
    });
</script>


@if (@$admin->system_autotext == 'true')
<script>
    $(".procedure_subtext").focusout(function() {
        let group   = $(this).attr("group");
        let text    = $(this).val();
        $.post("{{url("api/procedure")}}",{
            event   : "autotextgroup_save",
            name    : group,
            code    : "{{$procedure->code}}",
            text    : text,
        },function(d,s){});
    });
</script>
@endif




<script>


    function updateprocedure_subtext(is_clear) {
        var procedure_subtext = $(".procedure_subtext").map(function() {
            return $(this).val();
        }).get();

        // console.log(procedure_subtext);


        procedure_subtext = procedure_subtext.filter(function(el) {
            return el != null && el != "";
        });


        if (is_clear) {
            procedure_subtext = ['None Other Procedure'];
        }

        // $(".procedure_subtext").focusout();

        $.post("{{ url('api/photo') }}", {
            event: "case_update",
            key: "procedure_subtext",
            val: procedure_subtext,
            cid: "{{ $cid }}"
        }, function(data, status) {});
    }




    //temp
    $(".boxicd9").click(function() {
        var size = $(".boxicd9").length
        var check = 0;
        for (i = 0; i < size; i++) {
            if ($($(".boxicd9")[i]).prop('checked')) {
                check = 1;
            }
        }
        for (ii = 0; ii < 6; ii++) {
            if ($($('.procedure_subtext')[ii]).val().length > 0) {
                check = 1;
            }
        }
        if ($("#overall_procedure").val().length > 0) {
            check = 1;
        }
        if (check == 0) {
            $("#icd09_normal").prop('checked', true);
        } else {
            $("#icd09_normal").prop('checked', false);
        }

        var firsttext = $($('.procedure_subtext')[0]).val()
        if (firsttext.includes('None Other')) {
            $($('.procedure_subtext')[0]).val('')
        }


        var arr = [];
        $(".boxicd9:checked").each(function() {
            arr.push($(this).val());
        });
        arr = arr.filter(function(el) {
            return el != null && el != "";
        });
        if (arr.length == 0) {
            arr = ['None Other Procedure']
        }

        let status = $(this).is(':checked')
        if (status == false) {
            let index = $(this).attr('ckid')
            $(`#icd9text${index}`).val('')

            $.post('{{ url('api/jquery') }}', {
                event: 'savejson_checkbox2',
                idhtml: `icd9text${index}`,
                value: '',
                idname: 'case_id',
                id: '{{ $cid }}',
                procedure: '{{ $procedure->code }}',
            }, function(data, status) {});

            save_localstorage(`icd9text${index}`, '')
        }

        save_localstorage('checkicd9', arr)

        let texticd9 = $(".procedure_subtext").map(function() {
            return $(this).val();
        }).get();
        save_localstorage('texticd9', texticd9)

        $.post("{{ url('api/photo') }}", {
            event: "case_update",
            key: "procedure_sub",
            val: arr,
            cid: "{{ $cid }}"
        }, function(data, status) {});
    });

    function save_localstorage(key, value) {
        let retString = localStorage.getItem("{{ $cid }}")
        let obj = {}
        if (retString != null) {
            obj = JSON.parse(retString)
        }
        obj[key] = value
        console.log(obj);
        let text = JSON.stringify(obj);
        localStorage.setItem("{{ $cid }}", text);
    }


    $(".procedure_subtext ,#overall_procedure").keyup(function(e) {
        var check = 0;
        for (ii = 0; ii < 6; ii++) {
            if ($($('.procedure_subtext')[ii]).val().length > 0) {
                check = 1;
            }
        }
        if ($("#overall_procedure").val().length > 0) {
            check = 1;
        }
        if (check == 0) {
            $("#icd09_normal").prop('checked', true);
        } else {
            $("#icd09_normal").prop('checked', false);
        }

        let texticd9 = $(".procedure_subtext").map(function() {
            return $(this).val();
        }).get();

        save_localstorage('texticd9', texticd9)

    });
</script>
