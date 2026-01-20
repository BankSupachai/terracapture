<div class="col-12">
    {!! editcard('histopathology', 'histopathology.blade.php') !!}
    <div class="card card-custom gutter-b">
        <div class="card-body">
            <h5 class="card-label">
                <b>Other</b>
            </h5>
            <div class="row">
                <div class="col-xxl-6">
                    <div class="row">
                        @if ($case->procedurename == 'Colonoscopy')
                            <div class="row">
                                <div class="col-12 ">
                                    BOWEL PREPARATION &ensp; &ensp; <i class="ri-equalizer-line"></i>
                                </div>
                                <div class="col-auto">
                                </div>
                                <div class="col-12">
                                    <select id="bowel" name="bowel" class="savejson form-control">
                                        <option value="">Select</option>
                                        @foreach (isset($procedure->bowel) ? $procedure->bowel : [] as $data)
                                            @if (@$case->bowel == $data)
                                                <option value="{{ $data }}" selected>{{ $data }}
                                                </option>
                                            @else
                                                <option value="{{ $data }}">{{ $data }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12">&nbsp;</div>
                                <div class="col-5">
                                    <input class="form-control autotext savejson" id="bowelpreparation"
                                        placeholder="Bowel preparation" type="text" autocomplete="off"
                                        value="{{ @$case->bowelpreparation }}" />
                                </div>
                                <div class="col-2">
                                    <input class="form-control autotext savejson" id="bowelpreparation_cc"
                                        placeholder="cc." type="text" autocomplete="off"
                                        value="{{ @$case->bowelpreparation_cc }}" />
                                </div>
                                <div class="col-5">
                                    <input class="form-control autotext savejson" id="bowel_other"
                                        placeholder="Free Text" type="text" autocomplete="off"
                                        value="{{ @$case->bowel_other }}" />
                                </div>
                            </div>
                        @endif

                        <div class="col-12 set_col">
                            @if (@$project_name == 'capture')
                                <div class="row">
                                    <div class="col-12 ">&nbsp;</div>
                                    <div class="col-3 ">
                                        Complication &ensp; &ensp; <i class="ri-equalizer-line"></i>
                                    </div>
                                    <div class="col-auto">
                                        <button id="btn_none_immediately_complication" type="button"
                                            class="btn btn-checkbox btn-label waves-effect waves-light btn-sm">
                                            <i
                                                class="ri-checkbox-blank-line label-icon align-middle fs-16 me-2 text-light"></i>
                                            No Immediate Complication
                                        </button>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            @php
                                                $complication = isset($case->complication) ? $case->complication : [];
                                                // $procedure->complication = ['Perforation', 'Hypoxia', 'Bleeding',];
                                            @endphp
                                            @foreach (isset($procedure->complication) ? $procedure->complication : [] as $box)
                                                @php
                                                    $check = in_array($box, $complication) ? 'checked' : '';
                                                @endphp
                                                <div class="col-4 pt-2">
                                                    <div class="form-check">
                                                        <input type="checkbox" name="complication"
                                                            class="form-check-input savejson_checkbox ck-val  ck-complication savejson"
                                                            id="complication{{ $box }}"
                                                            value="{{ $box }}" {{ $check }}>
                                                        <label class="form-check-label ms-4"
                                                            for="complication{{ $box }}">{{ $box }}</label>
                                                    </div>
                                                </div>
                                                <div class="col-8 pt-2">
                                                    @php
                                                        $box = str_replace(' ', '_', $box);
                                                    @endphp
                                                    <input id="complication_{{ $box }}_other"
                                                        name="complication_{{ $box }}_other" type="text"
                                                        placeholder="lesion" class="savejson form-control autotext"
                                                        value="{{ @$case->{'complication_' . $box . '_other'} }}" />
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="col-12 pt-3">
                                        <textarea id='complication_other' name="complication_other" type="text" placeholder="Free text"
                                            class="savejson form-control autotext">{{ @$case->complication_other }}</textarea>
                                    </div>
                                </div>
                            @else
                                <div class="row">
                                    <div class="col-12 ">&nbsp;</div>
                                    <div class="col-3 ">
                                        Complication &ensp; &ensp; <i class="ri-equalizer-line"></i>
                                    </div>
                                    <div class="col-auto">
                                        <button id="btn_none_immediately_complication" type="button"
                                            class="btn btn-checkbox btn-label waves-effect waves-light btn-sm">
                                            <i
                                                class="ri-checkbox-blank-line label-icon align-middle fs-16 me-2 text-light"></i>
                                            No Immediate Complication
                                        </button>
                                    </div>
                                    <div class="col-12">
                                        <div class="row">
                                            @php
                                                $complication = isset($case->complication) ? $case->complication : [];
                                                // $procedure->complication = ['Perforation', 'Hypoxia', 'Bleeding',];
                                            @endphp
                                            @foreach (isset($procedure->complication) ? $procedure->complication : [] as $box)
                                                @php
                                                    $check = in_array($box, $complication) ? 'checked' : '';
                                                @endphp
                                                <div class="col-6">
                                                    <div class="form-check">
                                                        <input type="checkbox" name="complication"
                                                            class="form-check-input savejson_checkbox ck-val  ck-complication savejson"
                                                            id="complication{{ $box }}"
                                                            value="{{ $box }}" {{ $check }}>
                                                        <label class="form-check-label ms-4"
                                                            for="complication{{ $box }}">{{ $box }}</label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <textarea id='complication_other' name="complication_other" type="text" placeholder="Free text"
                                            class="savejson form-control autotext">{{ @$case->complication_other }}</textarea>
                                    </div>
                                </div>
                            @endif



                            <script>
                                $("#btn_none_immediately_complication").on('click', function() {
                                    $("#complication_other").val("No Immediate Complication");
                                    $("#complication_other").focus();

                                    save_value('complication_other', 'No Immediate Complication')
                                    save_localstorage('complication', [])

                                    $("input[name='complication']").prop("checked", false);
                                    $.post('{{ url('api/jquery') }}', {
                                        event: 'savejson_checkbox2',
                                        idhtml: 'complication',
                                        value: [],
                                        table: 'tb_case',
                                        idname: 'case_id',
                                        id: '{{ $cid }}',
                                        procedure: '{{ $procedure->code }}',
                                    }, function(data, status) {});
                                });
                            </script>
                        </div>



                    </div>
                </div>
                <div class="col-xxl-6">
                    <div class="col-12">
                        Comment &ensp; <i class="ri-equalizer-line"></i>
                    </div>
                    <div class="col-12 mt-2">
                        <textarea id='case_comment' name="formsubmit_case_comment" placeholder="Free text"
                            type="text"class="savejson form-control autotext">{{ @$case->case_comment }}</textarea>
                    </div>
                </div>

            </div>

        </div>
    </div>




</div>

<script>
    $("#btn_gastric_clear").on('click', function() {
        $("#gastriccontent_other").val("Clear");
        $("#gastriccontent_other").focus();
        $("input[name='gastriccontent']").prop("checked", false);
        let gastriccontent = [];

        save_localstorage('gastriccontent', gastriccontent)

        $.post('{{ url('api/jquery') }}', {
            event: 'savejson_checkbox2',
            idhtml: 'gastriccontent',
            value: gastriccontent,
            table: 'tb_case',
            idname: 'case_id',
            id: '{{ $cid }}',
            procedure: '{{ $procedure->code }}',
        }, function(data, status) {});
        save_value('gastriccontent_other', 'Clear')
    });

    function save_localstorage(key, value) {
        let retString = localStorage.getItem("{{ $cid }}")
        let obj = {}
        if (retString != null) {
            obj = JSON.parse(retString)
        }
        obj[key] = value
        let text = JSON.stringify(obj);
        localStorage.setItem("{{ $cid }}", text);
    }

    $('.ck-gastric').on('click', () => {
        var count = $(".ck-gastric:checked").length
        var arr = []
        var checked = $(".ck-gastric:checked").each(function() {
            arr.push($(this).val());
        });
        save_value('gastriccontent', arr)
        if (count > 0) {
            var text = $('#gastriccontent_other').val()
            if (text == 'Clear') {
                $('#gastriccontent_other').val('')
                save_value('gastriccontent_other', "")
            }
        }
    })

    $('.ck-complication').on('click', () => {
        var count = $(".ck-complication:checked").length
        var arr = []
        var checked = $(".ck-complication:checked").each(function() {
            arr.push($(this).val());
        });
        save_value('complication', arr)
        if (count > 0) {
            var text = $('#complication_other').val()
            if (text == 'None Immediately Complication') {
                $('#complication_other').val('')
                save_value('complication_other', "")
            }
        }
    })

    $('.ck-technique').on('click', () => {
        var count = $(".ck-technique:checked").length
        var arr = []
        var checked = $(".ck-technique:checked").each(function() {
            arr.push($(this).val());
        });
        save_value('technique', arr)
        if (count > 0) {
            var text = $('#technique_other').val()
            if (text == 'None Immediately Technique') {
                $('#technique_other').val('')
                save_value('technique_other', "")
            }
        }
    })

    function save_value(idhtml, value) {
        $.post("{{ url('api/jquery') }}", {
            event: "savejson_checkbox2",
            id: "{{ $case->id }}",
            idhtml: idhtml,
            value: value
        }, function(data, status) {});
    }


    // $('#btn_gastric_clear').on('click', function () {
    //     $('#gastriccontent_other').val('Clear').focusout()
    // })

    $("#bowel_normal").on("click", function() {
        $("#bowel_other").val("Clear").focusout();
        $("#bowel").val("").focusout()
    })

    $("#bowel").on('change', function() {
        $('#bowel_other').val('').focusout()
        var quality_bowel = $(this).val()
        $.post("{{ url('api/jquery') }}", {
            event: "savejson_checkbox2",
            id: "{{ $case->id }}",
            idhtml: 'bowel',
            value: quality_bowel
        }, function(data, status) {});
        $(this).focusout()
    })

    // $('#bowel_other').on('click', function(){
    //     $('#bowel').val('').focusout()
    // })




    $(".histo_checkgroup").click(function() {
        $("#histopathology_volumn").focus();
        $("#histopathology_volumn").val("1");
    });


    $(".histo_checkgroup").click(function() {
        var value_count = $(".histo_checkgroup").length
        var check_all = false;
        var counts = 0;
        for (i = 0; i < value_count; i++) {
            if ($($('.histo_checkgroup')[i]).prop('checked') == true) {
                check_all = true;
            } else {
                counts++;
            }
        }
        if (check_all == false) {
            $("#specimen_na").prop('checked', true)
            $('#specimen_wfp').prop('checked', false)
            $("#histopathology_volumn").val(0)
            $("#histopathology_volumn").focusout()
        } else {
            $("#specimen_na").prop('checked', false)
        }
        $("#specimen_na").focusout();
    })

    $("#specimen_na").click(function() {
        var value_count = $(".histo_checkgroup").length
        if ($(this).prop('checked') == true) {
            for (i = 0; i < value_count; i++) {
                $($('.histo_checkgroup')[i]).prop('checked', false)
                $($('.histo_checkgroup')[i]).focusout()
            }
            $("#histopathology_volumn").val(0)
            $("#histopathology_volumn").focusout()

            $('#specimen_wfp').prop('checked', false)

        }

        $(this).focusout()
    })

    if ($("#histopathology_volumn").val() != '') {
        $("#specimen_na").prop('checked', false)
        $('#specimen_wfp').prop('checked', true)
    }

    if ($("#histopathology_volumn").val() == 0) {
        $("#specimen_na").prop('checked', true)
        $('#specimen_wfp').prop('checked', false)
    }

    $('#histopathology_volumn').on('click', function() {
        $("#specimen_na").prop('checked', false)
        $('#specimen_wfp').prop('checked', true)
    })

    if ($("#specimen_na").prop('checked') == true) {
        $('#specimen_wfp').prop('checked', false)
    }

    $("#specimen_wfp").click(function() {
        if ($(this).prop('checked') == true) {
            $('#specimen_na').prop('checked', false)
            $("#histopathology_volumn").val(1)

        }
    })

    if ($('#gastriccontent_other').val() != '') {
        $("#gastric_normal").prop('checked', false).focusout()
    }

    if ($('#complication_other').val() != '') {
        $("#complication_normal").prop('checked', false).focusout()
    }

    if ($('#rapid_other').val() != '') {
        $("#rapid_not").prop('checked', false).focusout()
    }

    // if ($('#bowel_other').val() != '') {
    //     $("#bowel_normal").prop('checked', false).focusout()
    // }

    $('#followup_date').on('input', function() {
        var days = $('#followup_date').val()
        days = (days != '') && (days != undefined) ? days : ''
        console.log(days);
        $.post("{{ url('jquery') }}", {
            event: "save_followup",
            _id: "{{ $case->id }}",
            days: days
        }, function(data, status) {});
    })


    $(".complication_ck").click(function() {
        complication();
    });
    $("#complication_other").keyup(function() {
        complication();
    });
    $(".gastric_content_ck").click(function() {
        gastric()
    })
    $("#gastriccontent_other").keyup(function() {
        gastric()
    })
    // $("#case_comment").focusout(function() {
    //     if ($(this).val().length > 0) {
    //         $("#plan_na").prop('checked', false).focusout()
    //     } else {
    //         $("#plan_na").prop('checked', true).focusout()
    //     }
    // })
    $("#blood_transfusion").keyup(function() {

        if ($(this).val().length > 0) {
            $("#blood_na").prop('checked', false).focusout()
        } else {
            $("#blood_na").prop('checked', true).focusout()
        }
    })
    $("#blood_na").change(function() {
        $("#blood_transfusion").focusout()
    })
    $("#loss_na").change(function() {
        $("#blood_loss").focusout()
    })
    $("#blood_loss").keyup(function() {
        if ($(this).val().length > 0) {
            $("#loss_na").prop('checked', false).focusout()
        } else {
            $("#loss_na").prop('checked', true).focusout()
        }
    })

    function gastric() {
        var size = $(".gastric_content_ck").length
        var check = 0;
        for (i = 0; i < size; i++)
            if ($($(".gastric_content_ck")[i]).prop('checked')) {
                check = 1;
            }
        if ($("#gastriccontent_other").val().length > 0) {
            check = 1;
        }
        if (check == 1) {
            $("#gastric_normal").prop('checked', false).focusout()
        } else {
            $("#gastric_normal").prop('checked', true).focusout()
        }
    }

    function complication() {
        var size = $(".complication_ck").length
        var check = 0;
        for (i = 0; i < size; i++)
            if ($($(".complication_ck")[i]).prop('checked')) {
                check = 1;
            }
        if ($("#complication_other").val().length > 0) {
            check = 1;
        }
        if (check == 1) {
            $("#complication_normal").prop('checked', false).focusout()
        } else {
            $("#complication_normal").prop('checked', true).focusout()
        }

    }

    $("#bowel").change(function() {
        bowel();
    })
    // $("#bowel_other").keyup(function() {
    //     // bowel();
    // })

    // function bowel() {
    //     if ($("#bowel").val() != '' || $("#bowel_other").val().length > 0) {
    //         $("#bowel_normal").prop('checked', false).focusout()
    //     } else {
    //         $("#bowel_normal").prop('checked', true).focusout()
    //     }
    // }

    $("#rapid_not").click(function() {
        if ($(this).prop('checked')) {
            $("#rapid_other").val('')
            $("#rapid_other").focusout()
            for (i = 0; i <= 2; i++) {
                $($(".rapid_radio")[i]).prop('checked', false).focusout();
            }
        }
    })
    $('#rapid_other').keyup(function(e) {
        if ($(this).val().length > 0) {
            $("#rapid_not").prop('checked', false).focusout()
        } else {
            $("#rapid_not").prop('checked', true).focusout()
        }
    });
    $(".rapid_radio").click(function() {
        $("#rapid").val($(this).val());
        $("#rapid").focusout()
        $("#rapid_not").prop('checked', false).focusout()
    })
</script>
