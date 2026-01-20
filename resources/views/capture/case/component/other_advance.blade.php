<div class="card card-custom gutter-b">
    <div class="card-body">
        <h5 class="card-label">
            OTHER
        </h5>
        {{-- @dd($case->managecomplication0 ) --}}
        <div class="col-12">
            <div class="row">
                {{-- <div class="col-12"> --}}
                <div class="col-12 ">
                    COMPLICATION &ensp; &ensp; <i class="ri-equalizer-line"></i> &ensp; &ensp; &ensp; &ensp;
                    <button id="btn_none_immediately_complication" type="button"
                        class="btn btn-checkbox btn-label waves-effect waves-light btn-sm">
                        <i class="mdi mdi-checkbox-outline label-icon align-middle fs-16 me-2 text-light"></i>
                        No Immediate Complication
                    </button>
                </div>
                <div class="col-5">
                    <div class="row">
                        <div class="col-3 align-self-center">
                            <div class="form-check mb-2">
                                <input class="form-check-input checkboxgroupsave ck-complicationercp ck-input"
                                    type="checkbox" id="{{ md5('Perforation at') }}" datagroup="complication"
                                    subgroup="complicationercp" name="complication" value="Perforation at"
                                    position="1" {{ checkinarray($case, 'complication', 'Perforation at') }}>
                                <label class="form-check-label" for="{{ md5('Perforation at') }}">
                                    &ensp; &ensp; Perforation at
                                </label>
                            </div>
                        </div>
                        <div class="col-9">
                            <input type="text" class="form-control ck-radio ck-complicationercp-input savejson_edit"
                                datagroup="complication" subgroup="complicationercp" name="perforation_at_other"
                                position="1" placeholder="lesion" value="{{ @$case->perforation_at_other }}">
                        </div>
                    </div>
                </div>
                <div class="col-1 p-0 m-0">
                    <button type="button" class="btn btn-primary w-100 ercp-manage-btn" data-bs-toggle="modal"
                        dataindex="0" data-bs-target="#modal_ercp_manageCompli"><i class="ri-equalizer-line"></i>
                        Manage With
                    </button>
                </div>
                <div class="col-6">
                    <input type="text" dataindex="0" class="form-control manage-complication-text savejson"
                        placeholder="Manage Detail" value="{{ @$case->managecomplication0 }}">
                </div>


                <div class="col-5 mt-2">
                    <div class="row ">
                        <div class="col-3 align-self-center">
                            <div class="form-check mb-2">
                                <input class="form-check-input checkboxgroupsave ck-complicationercp" type="checkbox"
                                    id="{{ md5('Bleeding at') }}" datagroup="complication"
                                    subgroup="complicationercp" name="complication" value="Bleeding at"
                                    position="2" {{ checkinarray($case, 'complication', 'Bleeding at') }}>
                                <label class="form-check-label" for="{{ md5('Bleeding at') }}">
                                    &ensp; &ensp; Bleeding at
                                </label>
                            </div>
                        </div>
                        <div class="col-9">
                            <input type="text"
                                class="form-control ck-radio ck-complicationercp-input savejson_edit"
                                datagroup="complication" subgroup="complicationercp" name="bleeding_at_other"
                                position="2" placeholder="lesion" value="{{ @$case->bleeding_at_other }}">
                        </div>
                    </div>
                </div>
                <div class="col-1 mt-2 p-0 m-0">
                    <button type="button" class="btn btn-primary w-100 ercp-manage-btn" data-bs-toggle="modal"
                        dataindex="1" data-bs-target="#modal_ercp_manageCompli"><i class="ri-equalizer-line"></i>
                        Manage With
                    </button>
                </div>
                <div class="col-6 mt-2">
                    <input type="text" dataindex="1" class="form-control manage-complication-text savejson"
                        placeholder="Manage Detail" value="{{ @$case->managecomplication1 }}">
                </div>

                <div class="col-12 mt-2">
                    <div class="row ">
                        <div class="col-12">
                            <textarea id='complication_other' name="complication_other" type="text" placeholder="Free text1"
                                class="savejson form-control autotext complication-ercp-other">{{ @$case->complication_other }}</textarea>
                        </div>
                    </div>
                </div>

        </div>
        </div>



        <div class="row mb-2 mt-3">

            <div class="col-6">
                    @if ($procedure->name == 'EGD' || $procedure->name == 'Push Enteroscope')

                            <div class="col-12  p-2">
                                <div class="row">
                                    <div class="col-12 ">
                                        <div class="row">
                                            <div class="col-3">
                                                GASTRIC CONTENT
                                            </div>
                                            <div class="col-auto">
                                                <button id="btn_gastric_clear" type="button"
                                                    class="btn btn-checkbox btn-label waves-effect waves-light btn-sm">
                                                    <i
                                                        class="mdi mdi-checkbox-outline label-icon align-middle fs-16 me-2 text-light"></i>
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
                                                        <input type="checkbox" id="box_{{ $box }}"
                                                            class="form-check-input savejson_checkbox ck-gastric savejson"
                                                            name="gastriccontent" value="{{ $box }}"
                                                            @if (in_array($box, $combox)) checked @endif>
                                                        <label class="form-check-label ms-4" for="box_{{ $box }}">
                                                            {{ $box }}
                                                        </label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-5">
                                        <textarea id='gastriccontent_other' name="gastriccontent_other" type="text" placeholder="Free text"
                                            class="savejson form-control autotext">{{ @$case->gastriccontent_other }}</textarea>
                                    </div>
                                </div>
                            </div>

                        @endif


                        @if ($procedure->name == 'EGD' || $procedure->name == 'Push Enteroscope' || $procedure->name == 'PEG')
                        <div class="col-12 p-2">
                            <div class="row">
                                <div class="col-3">
                                    RAPID UREASE TEST
                                </div>
                                <div class="col-auto">
                                    <button id="btn_rapid_urease_test_notdone" type="button"
                                        class="btn btn-checkbox btn-label waves-effect waves-light btn-sm">
                                        <i class="mdi mdi-checkbox-outline label-icon align-middle fs-16 me-2 text-light"></i>
                                        Not done
                                    </button>
                                </div>
                                <div class="col-12"></div>
                                <div class="col-4 mt-1">
                                    {{-- สำหรับ putchin อย่างเดียว --}}
                                    {{-- @dd($case) --}}
                                    <input @checked(@$case->rapid_other == 'Pending' || strlen(@$case->rapid_other . '') > 15) id="box_rapid_pending" name="rapid_urease_test"
                                        value="Pending" type="radio"
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
                                    <input @checked(str_contains(@$case->rapid_other . '', 'Positive (+)')) id="box_rapid_positive" name="rapid_urease_test"
                                        value="Positive (+)" type="radio"
                                        class="form-check-input savejson_checkbox2 rapid_urease_test">
                                    <span></span>
                                    <label class="form-check-label" for="box_rapid_positive"> &nbsp; Positive
                                        (+)</label>
                                </div>


                                <div class="col-4 mt-1">
                                    <input @checked(str_contains(@$case->rapid_other . '', 'Negative (-)')) id="box_rapid_negative" name="rapid_urease_test"
                                        value="Negative (-)" type="radio"
                                        class="form-check-input savejson_checkbox2 rapid_urease_test">
                                    <span></span>
                                    <label class="form-check-label" for="box_rapid_negative"> &nbsp; Negative
                                        (-)</label>
                                </div>



                                <div class="col-11 mt-3">
                                    <input class="form-control autotext savejson" id="rapid_other" placeholder="Free Text"
                                        type="text" autocomplete="off" value="{{ @$case->rapid_other }}" />
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

                    @if ($procedure->name == 'Colonoscopy')
                    <div class="col-12 ">


                        <div class="row">
                                {{-- <button id="bowel_normal" type="button"
                                    class="btn btn-checkbox btn-label savejson_checkbox waves-effect waves-light btn-sm "
                                    sub="bowel_other">
                                    <i
                                        class="mdi mdi-checkbox-outline label-icon align-middle fs-16 me-2 text-light"></i>
                                    Clear
                                </button> --}}
                                {{-- <input type="checkbox" class="savejson_checkbox" sub="bowel_other" id="bowel_normal"
                                @if (!isset($case->bowel))
                                checked
                                @endif
                                >
                                <label for="bowel_normal"> &nbsp;Clear</label> --}}




                                {{-- Old bowel --}}
                                {{-- <div class="col-6">
                                    <div class="col-12">  Bowel Preparation</div>
                                    <div class="row " style="margin-top: 21px;">
                                        <div class="col-4">
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
                                        <div class="col-6">
                                            <input class="form-control autotext savejson" id="bowel_other"
                                            placeholder="Free Text" type="text" autocomplete="off"
                                            value="{{ @$case->bowel_other }}" />
                                        </div>
                                    </div>
                                </div> --}}
                                <div class="col-12">
                                    <div class="col-12"> Boston Bowel Preparation</div>
                                    <div class="row mt-2">
                                        <div class="col-4">Medicine</div>
                                        <div class="col-2">Rc</div>
                                        <div class="col-2">Tc</div>
                                        <div class="col-2">Lc</div>


                                    </div>
                                    <div class="row mt-2">

                                        <div class="col-4">
                                            <input type="text" class="form-control autotext savejson" id="bowel_medi" placeholder="Medi" value="{{@$case->bowel_medi}}">
                                        </div>
                                        <div class="col-2">
                                            <select id="bowel_rc" name="bowel_rc" class="savejson form-select">
                                                <option value="">select</option>

                                                <option value="1" @selected(@$case->bowel_rc == '1')>1</option>
                                                <option value="2" @selected(@$case->bowel_rc == '2')> 2</option>
                                                <option value="3" @selected(@$case->bowel_rc == '3')>3</option>
                                            </select>
                                        </div>
                                        <div class="col-2">
                                            <select id="bowel_tc" name="bowel_tc" class="savejson form-select">
                                                <option value="">select</option>

                                                <option value="1" @selected(@$case->bowel_tc == '1')>1</option>
                                                <option value="2" @selected(@$case->bowel_tc == '2')>2</option>
                                                <option value="3" @selected(@$case->bowel_tc == '3')>3</option>

                                            </select>
                                        </div>
                                        <div class="col-2">
                                            <select id="bowel_lc" name="bowel_lc" class="savejson form-select">
                                                <option value="">select</option>

                                                <option value="1"  @selected(@$case->bowel_lc == '1')>1</option>
                                                <option value="2"  @selected(@$case->bowel_lc == '2')>2</option>
                                                <option value="3"  @selected(@$case->bowel_lc == '3')>3</option>

                                            </select>
                                        </div>

                                    </div>

                                </div>
                                    <div class="col-12 mt-2">
                                        Techniques
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-4">
                                            <div class="form-check mb-2">
                                                @php
                                                    // $ck_techni = in_array('C02 sufflation',$case->ck_techbowel_co2);
                                                    // dd($ck_techni);
                                                @endphp
                                                <input @if(in_array('C02 sufflation',$case->ck_techbowel_co2??[])) checked @endif class=" form-check-input savejson_checkbox" type="checkbox" id="ck_tech1" value="C02 sufflation" name="ck_techbowel_co2">
                                                <label class="form-check-label" for="ck_tech1">
                                                    C02 sufflation
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-4">
                                            <div class="form-check mb-2">
                                                <input @if(in_array('WaterInfusion',$case->ck_techbowel_co2??[])) checked @endif class="form-check-input savejson_checkbox" type="checkbox" id="ck_tech2" value="WaterInfusion" name="ck_techbowel_co2">
                                                <label class="form-check-label" for="ck_tech2">
                                                    Water Infusion
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="form-check mb-2">
                                                <input @if(in_array('WaterExchange',$case->ck_techbowel_co2??[])) checked @endif class="form-check-input savejson_checkbox" type="checkbox" id="ck_tech3" value="WaterExchange" name="ck_techbowel_co2">
                                                <label class="form-check-label" for="ck_tech3">
                                                    Water Exchange
                                                </label>
                                            </div>

                                        </div>
                                        <div class="col-4">
                                            <div class="form-check mb-2">
                                                <input @if(in_array('2ndforward',$case->ck_techbowel_co2??[])) checked @endif class="form-check-input savejson_checkbox" type="checkbox" id="ck_tech4" value="2nd forward view right sided colon" name="ck_techbowel_co2">
                                                <label class="form-check-label" for="ck_tech4">
                                                    2 <sup>nd</sup> forward view right sided colon
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="row">
                                                <div class="col-3">
                                                    Other
                                                </div>
                                                <div class="col-9">
                                                     <input type="text" class="form-control savejson autotext" id="other_tech" name="other_tech" value="{{@$case->other_tech}}">

                                                </div>
                                            </div>

                                        </div>


                                    </div>



                            </div>

                    </div>
                @endif
            </div>
            <div class="col-6 ">
                <div class="row">
                    <div class="col-12">
                        <div class="row mt-3">
                            <div class="col-4 align-self-center">
                                ESTIMATED BLOOD LOSS &ensp; &ensp; <i class="ri-equalizer-line"></i>
                            </div>
                            <div class="col-6">
                                <input class="form-control autotext savejson" id="blood_loss" placeholder="Free Text"
                                    type="number" autocomplete="off" min="0"
                                    oninput="validity.valid||(value='');"
                                    @isset($case->blood_loss) value="{{ $case->blood_loss }}"
                                    @else
                                    value="0"
                                    @endisset />
                            </div>
                            <div class="col-2 align-self-center">ml.</div>

                        </div>


                        <div class="row mt-2">
                            <div class="col-4 align-self-center">
                                BLOOD TRANSFUSION &ensp; &ensp; <i class="ri-equalizer-line"></i>
                            </div>
                            <div class="col-6">
                                <input class="form-control autotext savejson" id="blood_transfusion"
                                    placeholder="Free Text" min="0" oninput="validity.valid||(value='');"
                                    type="number" autocomplete="off" value="{{ @$case->blood_transfusion }}" />
                            </div>
                            <div class="col-2 align-self-center">ml.</div>

                        </div>
                    </div>

                    <div class="col-12">


                        <div class="row mt-2 specimenercp-div">
                            <div class="col-4">
                                SPECIMEN &ensp; &ensp; <i class="ri-equalizer-line"></i>
                            </div>
                            <div class="col-5">
                                <input class="form-control autotext savejson " id="specimen1" placeholder="Detail"
                                    type="text" autocomplete="off" value="{{ @$case->specimen1 }}" /> <br>
                                {{-- <button class="btn btn-soft-secondary"> + Add</button> --}}
                            </div>
                            <div class="col-2">
                                <input id="specimenbottle1" value="{{ @$case->specimenbottle1 }}" type="number"
                                    class="form-control savejson" min="0" oninput="validity.valid||(value='');">
                            </div>
                            <div class="col-1 text-nowrap">Bottle</div>
                        </div>
                        @for ($i = 2; $i < 99; $i++)
                            @php
                                $specimen = @$case->{"specimen$i"} . '';
                                $specimenbottle = @$case->{"specimenbottle$i"} . '';
                                if (!isset($specimen) || @$specimen . '' == '') {
                                    continue;
                                }
                            @endphp
                            <div class="row mt-1 specimenercp-div">
                                <div class="col-4"></div>
                                <div class="col-5">
                                    <input class="form-control autotext savejson add-specimen specimen"
                                        id="specimen{{ $i }}" placeholder="Detail" type="text"
                                        autocomplete="off" value="{{ @$specimen }}" /> <br>
                                </div>
                                <div class="col-2">
                                    <input id="specimenbottle{{ $i }}" value="{{ @$specimenbottle }}"
                                        type="number" class="form-control savejson specimen" min="0"
                                        oninput="validity.valid||(value='');">
                                </div>
                                <div class="col-1 text-nowrap">Bottle</div>
                            </div>
                        @endfor
                        <div class="row">
                            <div class="col-4"></div>
                            <div class="col-5">
                                <button type="button" class="btn btn-soft-secondary add-specimen"> + Add</button>
                            </div>
                            <div class="col-2"></div>
                            <div class="col-1"></div>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="row">
                            <div class="col-3 align-self-center">FOLLOW UP &ensp; &ensp; <i class="ri-equalizer-line"></i>
                            </div>
                            <div class="col-6">
                                <input type="text" class="form-control savejson" id="followup_other"
                                    placeholder="Detail" value="{{ @$case->followup_other }}">
                            </div>
                            <div class="col-2">
                                <input type="number" class="form-control  savejson" id="followup_date"
                                    value="{{ isset($case->followup_date) ? $case->followup_date : 0 }}" min="0"
                                    oninput="validity.valid||(value='');">
                            </div>
                            <div class="col-1 align-self-center">Days</div>

                            <div class="col-12">&nbsp;</div>

                            <div class="col-12">
                                COMMENT &ensp; <i class="ri-equalizer-line"></i>
                            </div>
                            <div class="col-12 mt-2">
                                <textarea id='case_comment' name="formsubmit_case_comment" placeholder="Free text"
                                    type="text"class="savejson form-control autotext">{{ checknotarray(@$case->case_comment) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>


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



    var manage_complication = []

    // manage complication
    $('.ercp-manage-btn').on('click', function() {
        let index = $(this).attr('dataindex')
        $('#managewith_index').val(index)
        $('.manage-complication').prop('checked', false)
        $('.manage-complication-input').val('')
    })

    $('.manage-complication-input').on('change', function() {
        let index = $('#managewith_index').val()
        let unit = $(this).attr('unit')
        let subgroup = $(this).attr('subgroup')
        let val = $(this).val()
        $(`.manage-complication[subgroup="${subgroup}"]`).prop('checked', true).change()
        let text = `${subgroup} ${val} ${unit}`
        for (let i = 0; i < manage_complication[index].length; i++) {
            let manage_text = manage_complication[index][i]
            if (manage_text.includes(subgroup)) {
                manage_complication[index][i] = text
            }
        }
    })

    $('.manage-complication-btn').on('click', function() {
        let index = $('#managewith_index').val()
        $('.modal-close-btn').click()
        let input_text = ''
        for (let i = 0; i < manage_complication[index].length; i++) {
            let txt = manage_complication[index][i]
            input_text = input_text + txt
            if (i != manage_complication[index].length - 1) {
                input_text = input_text + '; '
            }
        }
        $(`.manage-complication-text[dataindex="${index}"]`).val(input_text).change()
        $.post('{{ url('api/procedure') }}', {
            event: "radiosave",
            cid: cid,
            datagroup: `managecomplication${index}`,
            value: input_text
        }, function(d, s) {})
        manage_complication[index] = []
    })


    $('.manage-complication-text').on('change', function() {
        let index = $(this).attr('dataindex')
        let input_text = $(this).val()
        console.log({
            event: "radiosave",
            cid: cid,
            datagroup: `managecomplication${index}`,
            value: input_text
        });
        $.post('{{ url('api/procedure') }}', {
            event: "radiosave",
            cid: cid,
            datagroup: `managecomplication${index}`,
            value: input_text
        }, function(d, s) {})
    })

    $('.manage-complication').on('change', function() {
        let index = $('#managewith_index').val()
        let this_text = $(this).attr('text')
        let this_unit = $(this).attr('unit')
        let subgroup = $(this).attr('subgroup')
        let manage_detail_text = $(`.manage-complication-text[dataindex=${index}]`).val()
        if (manage_complication[parseInt(index)] == undefined) {
            manage_complication[index] = []
        }
        if ($(this).is(':checked')) {
            let input = $(`input[type="number"][subgroup="${subgroup}"]`).val()
            let text = this_text
            if (input != '' && input != undefined) {
                text = `${text} ${input} ${this_unit}`
            }
            let is_found = false
            for (let i = 0; i < manage_complication[index].length; i++) {
                let txt = manage_complication[index][i]
                if (txt.includes(subgroup)) {
                    is_found = true
                }
            }
            if (!is_found) {
                manage_complication[index].push(text)
            }
        } else {
            for (let i = 0; i < manage_complication[index].length; i++) {
                let txt = manage_complication[index][i]
                if (txt.includes(subgroup)) {
                    manage_complication[index].splice(manage_complication[index].indexOf(subgroup), 1)
                }
            }
            $(`input[type="number"][subgroup="${subgroup}"]`).val('')
        }

        console.log(manage_complication);

    })

    $("#btn_none_immediately_complication").on('click', function() {
        $("#complication_other").val("No Immediate Complication");
        $("#complication_other").focus();

        // save_value('complication_other', 'No Immediate Complication')
        save_localstorage('complication', [])

        $("input[name='complication']").prop("checked", false);
        $(".ck-complicationercp-input").val('').focusout()
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

    $('.add-specimen').on('click', function() {
        let total_specimen = $('.specimenercp-div').length
        let newdiv = `
            <div class="row mt-1 specimenercp-div">
                <div class="col-4"></div>
                <div class="col-5">
                    <input class="form-control autotext savejson add-specimen specimen" id="specimen${total_specimen+1}" placeholder="Detail"
                        type="text" autocomplete="off" value="" /> <br>
                </div>
                <div class="col-2">
                    <input id="specimenbottle${total_specimen+1}" value="" type="number" min="0" oninput="validity.valid||(value='');"
                        class="form-control savejson specimen">
                </div>
                <div class="col-1 text-nowrap">Bottle</div>
            </div>
        `
        let lastdiv = total_specimen == 0 ? $($('.specimenercp-div')[0]) : $($('.specimenercp-div')[
            total_specimen - 1])
        console.log(total_specimen, lastdiv, 'aaaaa');
        $(lastdiv).after(newdiv)
        $('.specimen').bind('change', function() {
            $.post('{{ url('api/procedure') }}', {
                event: "radiosave",
                cid: '{{ @$cid }}',
                datagroup: $(this).attr('id'),
                value: $(this).val()
            }, function(d, s) {})
        })
    })

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
    // function
</script>
