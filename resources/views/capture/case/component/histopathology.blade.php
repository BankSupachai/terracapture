<div class="col-12">
    {!! editcard('histopathology', 'histopathology.blade.php') !!}
    <div class="card card-custom gutter-b">
        <div class="card-body">
            <h5 class="card-label">
                OTHER
            </h5>
            <div class="row">
                <div class="col-xxl-6 pe-5">
                    <div class="row">

                        @if($case->procedurename=="Colonoscopy")
                        <div class="row">
                            <div class="col-12 ">&nbsp;</div>
                            <div class="col-12 ">
                                Bowel Preparation &ensp; &ensp;   <i class="ri-equalizer-line"></i>
                            </div>
                            <div class="col-auto">
                            </div>
                            <div class="col-12">
                                <select id="bowel" name="bowel" class="savejson form-control">
                                    <option value="">Select</option>
                                    {{-- <option value="Fair">Fair</option>
                                    <option value="Good">Good</option> --}}
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





                        @if ($procedure->name == 'EGD' || $procedure->name == 'Push Enteroscope')
                            <div class="col-12 set_col">
                                <div class="row">
                                    <div class="col-12 ">
                                        <div class="row">
                                            <div class="col-3">
                                                GASTRIC CONTENT
                                            </div>
                                            <div class="col-auto">
                                                <button id="btn_gastric_clear" type="button"
                                                    class="btn btn-checkbox btn-label waves-effect waves-light btn-sm">
                                                    <i class="ri-checkbox-blank-line label-icon align-middle fs-16 me-2 text-light"></i>
                                                    Clear
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="row">
                                            @php
                                                $combox = isset($case->gastriccontent) ? $case->gastriccontent : [];
                                                // $procedure->gastriccontent = ['Food content', 'Blood', 'Bile', 'Coffee ground'];
                                            @endphp
                                            @foreach (isset($procedure->gastriccontent) ? $procedure->gastriccontent : [] as $box)
                                                <div class="col-6">
                                                    <div class="form-check">
                                                        <input type="checkbox"
                                                            id="box_{{$box}}"
                                                            class="form-check-input savejson_checkbox ck-gastric savejson"
                                                            name="gastriccontent" value="{{ $box }}"

                                                            @if (in_array($box, $combox)) checked @endif>
                                                        <label class="form-check-label ms-4" for="box_{{$box}}">
                                                            {{ $box }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <textarea id='gastriccontent_other' name="gastriccontent_other" type="text" placeholder="Free text" class="savejson form-control autotext">{{ @$case->gastriccontent_other }}</textarea>
                                    </div>
                                </div>
                            </div>




                        @endif

                        {{-- @if ($procedure->name == 'Colonoscopy')
                            <div class="col-12 set_col">
                                <div class="row">
                                    <div class="col-12">QUALITY OF BOWEL PREPARATION &emsp;
                                        <button id="bowel_normal" type="button"
                                            class="btn btn-checkbox btn-label savejson_checkbox waves-effect waves-light btn-sm "
                                            sub="bowel_other">
                                            <i
                                                class="mdi mdi-checkbox-outline label-icon align-middle fs-16 me-2 text-light"></i>
                                            Clear
                                        </button>
                                        <input type="checkbox" class="savejson_checkbox" sub="bowel_other" id="bowel_normal"
                                        @if (!isset($case->bowel))
                                        checked
                                        @endif
                                        >
                                        <label for="bowel_normal"> &nbsp;Clear</label>
                                    </div>

                                    <div class="col-6">
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
                                    <div class="col-5">
                                        <input class="form-control autotext savejson" id="bowel_other"
                                            placeholder="Free Text" type="text" autocomplete="off"
                                            value="{{ @$case->bowel_other }}" />
                                    </div>
                                </div>
                            </div>
                        @endif --}}


                        <div class="col-12 set_col">
                            <div class="row">
                                <div class="col-12 ">&nbsp;</div>
                                <div class="col-3 ">
                                    COMPLICATION &ensp; &ensp;   <i class="ri-equalizer-line"></i>
                                </div>
                                <div class="col-auto">
                                    <button id="btn_none_immediately_complication" type="button"
                                        class="btn btn-checkbox btn-label waves-effect waves-light btn-sm">
                                        <i class="ri-checkbox-blank-line label-icon align-middle fs-16 me-2 text-light"></i>
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
                                                        id="complication{{ $box }}" value="{{ $box }}"
                                                        {{ $check }}>
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

@if($case->procedurename=="Colonoscopy")
                            <div class="row">
                                <div class="col-12 ">&nbsp;</div>
                                <div class="col-12 ">
                                    Technique &ensp; &ensp;   <i class="ri-equalizer-line"></i>
                                </div>
                                <div class="col-auto">
                                </div>
                                <div class="col-12">
                                    <div class="row">


                                        @php
                                        $arrt[] = "CO2 Sufflation";
                                        $arrt[] = "Water Exchange";
                                        $arrt[] = "Water Infusion";
                                        $arrt[] = "2nd forward view right sided colon";
                                        $technique = $case->technique??[];
                                        @endphp

                                        @foreach ($arrt as $box)
                                            @php
                                            $check = in_array($box, $technique) ? 'checked' : '';
                                            @endphp


                                        <div class="col-6">
                                            <div class="form-check">
                                                <input type="checkbox" name="technique"
                                                    class="form-check-input savejson_checkbox ck-val  ck-technique savejson"
                                                    id="technique{{ @$box }}" value="{{ @$box }}"
                                                    {{ $check }}>
                                                <label class="form-check-label ms-4"
                                                    for="technique{{ @$box }}">{{ @$box }}</label>
                                            </div>
                                        </div>
                                        @endforeach


                                    </div>
                                </div>
                                <div class="col-12">
                                    <textarea id='technique_other' name="technique_other" type="text" placeholder="Free text"
                                        class="savejson form-control autotext">{{ @$case->technique_other }}</textarea>
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



                        @if ($procedure->name == 'EGD' || $procedure->name == 'Push Enteroscope'|| $procedure->name == 'PEG')
                            <div class="col-12 set_col">
                                <div class="row">
                                    <div class="col-3">
                                        RAPID UREASE TEST
                                    </div>
                                    <div class="col-auto">
                                        <button id="btn_rapid_urease_test_notdone" type="button"
                                            class="btn btn-checkbox btn-label waves-effect waves-light btn-sm">
                                            <i class="ri-checkbox-blank-line label-icon align-middle fs-16 me-2 text-light"></i>
                                            Not done
                                        </button>
                                    </div>
                                    <div class="col-12"></div>
                                    <div class="col-4 mt-1">
                                        {{-- สำหรับ putchin อย่างเดียว --}}
                                        {{-- @dd($case) --}}
                                        <input @checked(@$case->rapid_other   == 'Pending' || strlen(@$case->rapid_other  ."") > 15) id="box_rapid_pending"
                                            name="rapid_urease_test" value="Pending" type="radio"
                                            class="form-check-input savejson_checkbox2 rapid_urease_test savejson">
                                        <span></span>
                                        <label class="form-check-label" for="box_rapid_pending"> &nbsp; Pending
                                        </label>
                                    </div>

                                    {{-- <div class="col-4 mt-1">

                                        <input @checked(@$case->rapid_urease_test == 'Pending' || strlen(@$case->rapid_urease_test."") > 15) id="box_rapid_pending"
                                            name="rapid_urease_test" value="Pending : &nbsp;&nbsp; Positive  [&nbsp;&nbsp; ]  &nbsp;&nbsp;&nbsp;&nbsp;   Negative [&nbsp;&nbsp; ]" type="radio"
                                            class="form-check-input savejson_checkbox2 rapid_urease_test savejson">
                                        <span></span>
                                        <label class="form-check-label" for="box_rapid_pending"> &nbsp; Pending

                                        </label>

                                    </div> --}}

                                    <div class="col-4 mt-1">
                                        <input @checked(str_contains(@$case->rapid_other ."", "Positive (+)")) id="box_rapid_positive"
                                            name="rapid_urease_test" value="Positive (+)" type="radio"
                                            class="form-check-input savejson_checkbox2 rapid_urease_test">
                                        <span></span>
                                        <label class="form-check-label" for="box_rapid_positive"> &nbsp; Positive
                                            (+)</label>
                                    </div>


                                    <div class="col-4 mt-1">
                                        <input @checked(str_contains(@$case->rapid_other ."", "Negative (-)")) id="box_rapid_negative"
                                            name="rapid_urease_test" value="Negative (-)" type="radio"
                                            class="form-check-input savejson_checkbox2 rapid_urease_test">
                                        <span></span>
                                        <label class="form-check-label" for="box_rapid_negative"> &nbsp; Negative
                                            (-)</label>
                                    </div>



                                    <div class="col-11 mt-3">
                                        <input class="form-control autotext savejson" id="rapid_other"
                                            placeholder="Free Text" type="text" autocomplete="off"
                                            value="{{ @$case->rapid_other }}" />
                                    </div>
                                </div>
                            </div>

                            <script>
                                $("#btn_rapid_urease_test_notdone").click(function() {
                                    $("#rapid_other").val("Not done");
                                    $("#rapid_other").focus();
                                    $("input[name='rapid_urease_test']").prop("checked", false).trigger('change');
                                    $.post('{{ url('api/photomove') }}', {
                                        event: 'savejson',
                                        name: 'rapid_urease_test',
                                        value: "Not done",
                                        table: 'tb_case',
                                        field: 'case_json',
                                        id: '{{ $cid }}',
                                        comcreate: '{{ $case->comcreate }}',
                                        procedure: '{{ $procedure->code }}',
                                    }, function(data, status) {});
                                });

                                $(".rapid_urease_test").click(function() {
                                    let id = $(this).attr("name");
                                    let val = $(this).attr("value");
                                    $.post('{{ url('api/photomove') }}', {
                                        event: 'savejson',
                                        name: id,
                                        value: val,
                                        table: 'tb_case',
                                        field: 'case_json',
                                        id: '{{ $cid }}',
                                        comcreate: '{{ $case->comcreate }}',
                                        procedure: '{{ $procedure->code }}',
                                    }, function(data, status) {});
                                    $("#rapid_other").val(val);
                                    $("#rapid_other").focus();
                                });
                            </script>
                        @endif

                    </div>
                </div>
                <div class="col-xxl-6">
                    <div class="row ">
                        @if ($procedure->name == 'ERCP' || $procedure->name == 'EGD' || $procedure->name == 'Colonoscopy')
                            <div class="col-3 align-self-center text-nowrap">
                                ESTIMATED BLOOD LOSS &ensp; &ensp;   <i class="ri-equalizer-line "></i>
                            </div>
                            <div class="col-5">
                                <input class="form-control autotext savejson" id="blood_loss" placeholder="Free Text"
                                    type="text" autocomplete="off"

                                    @isset($case->blood_loss) value="{{ $case->blood_loss }}"
                                    @else
                                    value="0"
                                    @endisset />
                            </div>
                            <div class="col-2 align-self-center">ml.</div>
                            <div class="col-12">&nbsp;</div>
                        @endif

                        @if ($procedure->name == 'EGD' || $procedure->name == 'Colonoscopy')
                            <div class="col-3 align-self-center">
                                BLOOD TRANSFUSION &ensp; &ensp;   <i class="ri-equalizer-line"></i>
                            </div>
                            <div class="col-5">
                                <input class="form-control autotext savejson" id="blood_transfusion"
                                    placeholder="Free Text" type="text" autocomplete="off"
                                    value="{{ @$case->blood_transfusion }}" />
                            </div>
                            <div class="col-2 lign-self-center">ml.</div>
                            <div class="col-12 ">&nbsp;</div>
                        @endif

                        <div class="row">
                            <div class="col-3 align-self-center">
                                SPECIMEN &ensp; &ensp;  <i class="ri-equalizer-line"></i>
                            </div>
                                <div class="col-5 mt-1 ms-2">
                                    <input class="form-control autotext savejson" id="specimen1"
                                        placeholder="Detail" type="text" autocomplete="off"
                                        value="{{ @$case->specimen1 }}" />
                                </div>
                                <div class="col-2 mt-1 ">
                                    <input id="specimenbottle1" value="{{@$case->specimenbottle1}}" type="number" class="form-control savejson"></div>
                                <div class="col-1 mt-1 align-self-center">Bottle</div>



                                <div class="col-3 mt-1 "></div>
                                <div class="col-5 mt-1  ms-2">
                                    <input class="form-control autotext savejson" id="specimen2"
                                        placeholder="Detail" type="text" autocomplete="off"
                                        value="{{ @$case->specimen2 }}" />
                                </div>
                                <div class="col-2 mt-1"><input id="specimenbottle2" value="{{@$case->specimenbottle2}}" type="number" class="form-control savejson"></div>
                                <div class="col-1 mt-1 align-self-center">Bottle</div>

                                <div class="col-3 mt-1"></div>
                                <div class="col-5 mt-1 ms-2">
                                    <input class="form-control autotext savejson" id="specimen3"
                                        placeholder="Detail" type="text" autocomplete="off"
                                        value="{{ @$case->specimen3 }}" />
                                </div>
                                <div class="col-2 mt-1"><input id="specimenbottle3" value="{{@$case->specimenbottle3}}" type="number" class="form-control savejson"></div>
                                <div class="col-1 mt-1 align-self-center">Bottle</div>




                                <div class="col-3 mt-1"></div>
                                <div class="col-5 mt-1 ms-2">
                                    <input class="form-control autotext savejson" id="specimen4"
                                        placeholder="Detail" type="text" autocomplete="off"
                                        value="{{ @$case->specimen4 }}" />
                                </div>
                                <div class="col-2 mt-1"><input id="specimenbottle4" value="{{@$case->specimenbottle4}}" type="number" class="form-control savejson"></div>
                                <div class="col-1 mt-1 align-self-center">Bottle</div>

                        </div>


                        <div class="col-12">&nbsp;</div>
                        {{-- <div class="col-5">
                            <textarea id='histopathology_other' name="histopathology_other" type="text" placeholder="Free text"
                                class="savejson form-control autotext">{{ @$case->histopathology_other }}</textarea>
                        </div> --}}


                        <div class="col-3 align-self-center">Urgent &ensp; &ensp;   <i class="ri-equalizer-line"></i></div>
                        <div class="col-4">
                           <select name="urgent" id="urgent" class="form-select">
                            <option value="elective" @selected(@$case->urgent == "elective")>Elective</option>
                            <option value="urgency" @selected(@$case->urgent == "urgency")>Urgency</option>
                            <option value="emergency" @selected(@$case->urgent == "emergency")>Emergency</option>
                           </select>

                        </div>
                        <div class="col-12 mt-2"></div>


                        <div class="col-3 align-self-center">FOLLOW UP  &ensp; &ensp;   <i class="ri-equalizer-line"></i></div>
                        <div class="col-2">
                            <input type="number" class="form-control form-control-sm savejson" id="followup_date"
                                value="{{ isset($case->followup_date) ? $case->followup_date : 0 }}">
                        </div>
                        <div class="col-1">Days</div>

                        <div class="col-12">&nbsp;</div>

                        <div class="col-12">
                            PLAN / COMMENT  &ensp;  <i class="ri-equalizer-line"></i>
                        </div>
                        <div class="col-12 mt-2">
                            <textarea id='case_comment' name="formsubmit_case_comment" placeholder="Free text" type="text"class="savejson form-control autotext">{{ @$case->case_comment }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
     $("#btn_gastric_clear").on('click', function () {
        $("#gastriccontent_other").val("Clear");
        $("#gastriccontent_other").focus();
        $("input[name='gastriccontent']").prop("checked", false);
        let gastriccontent = [];

        save_localstorage('gastriccontent', gastriccontent)

        $.post('{{ url('api/jquery') }}',{
            event       : 'savejson_checkbox2',
            idhtml      : 'gastriccontent',
            value       : gastriccontent,
            table       : 'tb_case',
            idname      : 'case_id',
            id          : '{{ $cid }}',
            procedure   : '{{ $procedure->code }}',
        },function(data,status){});
        save_value('gastriccontent_other', 'Clear')
    });

    function save_localstorage(key, value){
        let retString   = localStorage.getItem("{{$cid}}")
        let obj         = {}
        if(retString != null){
            obj = JSON.parse(retString)
        }
        obj[key] = value
        let text = JSON.stringify(obj);
        localStorage.setItem("{{$cid}}", text);
    }

    $('.ck-gastric').on('click', () => {
        var count = $(".ck-gastric:checked").length
        var arr = []
        var checked = $(".ck-gastric:checked").each(function(){
            arr.push($(this).val());
        });
        save_value('gastriccontent', arr)
        if(count > 0){
            var text = $('#gastriccontent_other').val()
            if(text == 'Clear'){
                $('#gastriccontent_other').val('')
                save_value('gastriccontent_other', "")
            }
        }
    })

    $('.ck-complication').on('click', () => {
        var count = $(".ck-complication:checked").length
        var arr = []
        var checked = $(".ck-complication:checked").each(function(){
            arr.push($(this).val());
        });
        save_value('complication', arr)
        if(count > 0){
            var text = $('#complication_other').val()
            if(text == 'None Immediately Complication'){
                $('#complication_other').val('')
                save_value('complication_other', "")
            }
        }
    })

    $('.ck-technique').on('click', () => {
        var count = $(".ck-technique:checked").length
        var arr = []
        var checked = $(".ck-technique:checked").each(function(){
            arr.push($(this).val());
        });
        save_value('technique', arr)
        if(count > 0){
            var text = $('#technique_other').val()
            if(text == 'None Immediately Technique'){
                $('#technique_other').val('')
                save_value('technique_other', "")
            }
        }
    })

    function save_value(idhtml, value){
        $.post("{{ url('api/jquery') }}", {
            event: "savejson_checkbox2",
            id     : "{{ $case->id }}",
            idhtml : idhtml,
            value  : value
        }, function(data, status) {});
    }


    // $('#btn_gastric_clear').on('click', function () {
    //     $('#gastriccontent_other').val('Clear').focusout()
    // })

    $("#bowel_normal").on("click", function() {
            $("#bowel_other").val("Clear").focusout();
            $("#bowel").val("").focusout()
        })

    $("#bowel").on('change', function () {
        $('#bowel_other').val('').focusout()
        var quality_bowel = $(this).val()
        $.post("{{ url('api/jquery') }}", {
            event: "savejson_checkbox2",
            id     : "{{ $case->id }}",
            idhtml : 'bowel',
            value  : quality_bowel
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
