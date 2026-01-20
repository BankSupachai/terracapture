<style>
    input:-webkit-autofill,
    input:-webkit-autofill:hover,
    input:-webkit-autofill:focus,
    textarea:-webkit-autofill,
    textarea:-webkit-autofill:hover,
    textarea:-webkit-autofill:focus,
    select:-webkit-autofill,
    select:-webkit-autofill:hover,
    select:-webkit-autofill:focus {
        border: 1px solid #ced4da;
        -webkit-text-fill-color: black;
        -webkit-box-shadow: 0 0 0px 1000px rgb(210, 235, 246) inset;
        transition: background-color 5000s ease-in-out 0s;
    }
</style>

<div class="col-12 p-0">
    <div class="card card-custom gutter-b">
        <div class="card-body">
            <div class="row">
                <div class="col-xxl-6 ">
                    <div class="row">
                        <div class="col-12">
                            <span class="h5"> <b>Post-Procedure (Diagnostic)</b></span> &ensp;
                            <button type="button" class="btn btn-transparent" id="modal_icd10"><i
                                    class="ri-equalizer-line"></i></button>
                        </div>
                    </div>


                    <div class="row mt-3">
                        @php
                            $i = 1;
                        @endphp
                        @foreach (isset($procedure->icd10) ? $procedure->icd10 : [] as $keydi => $newdi)
                            <div class="col-12"><b>{{ $keydi }}</b>
                                <div class="row">
                                    @foreach ($newdi as $key => $dia)
                                        <div class="col-6">
                                            <label class="form-check-label checkbox checkbox-index">
                                                @php
                                                    $diagnostic = is_array(@$case->diagnostic) ? @$case->diagnostic : json_decode(@$case->diagnostic);
                                                @endphp
                                                <input type="checkbox" name="diagnostic"
                                                    class="form-check-input boxicd10 savejson"
                                                    id="boxicdten_{{ $i }}" value="{{ $dia['name'] }}"
                                                    @if (in_array($dia['name'], $diagnostic ?? [])) checked @endif>


                                                <span></span>
                                                <label class="ms-4"
                                                    for="boxicdten_{{ $i }}">&nbsp;{{ $dia['name'] }}</label>
                                            </label>
                                        </div>
                                        @php
                                            $i++;
                                        @endphp
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-11">
                                <hr>
                            </div>
                        @endforeach
                        <div class="col-11" style="margin-top:15px;">
                            <textarea id='overall_diagnosis' name="formsubmit_overall_diagnosis" type="text" placeholder="Free text"
                                rows="6" autocomplete="off" class="savejson form-control autotext">{{ @$case->overall_diagnosis }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-6">
                    <div class="row pd_col">
                        <div class="col-12">&emsp;<br></div>
                        <div class="col-12">&emsp;<br></div>
                        <div class="col-12">
                            <button type="button" class="btn btn-checkbox btn-label waves-effect waves-light btn-sm"
                                id="btn_postdiagnosis">
                                <i class="ri-checkbox-blank-line label-icon align-middle fs-16 me-2 text-light"></i>
                                Normal {{ $procedure->name }}
                            </button>
                        </div>
                        <div class="col-12">
                            <div class="input-group">
                                <input id="diag{{ md5('case->diagnostic_text[0]') }}" group="diagnostic"
                                    class="form-control texticd10 autotextgroup" type="text"
                                    placeholder="Principal Diagnosis" name="formsubmit_diagnostic_text[]" txtnum="0"
                                    value="{{ @$case->diagnostic_text[0] }}" aria-label="Recipient's username"
                                    autocomplete="off" aria-describedby="basic-addon2">
                                <span class="input-group-text" id="icd10text01">ICD-10</span>
                            </div>
                        </div>

                        <div class="col-12 mt-2">
                            <div class="input-group">
                                <input type="text" id="diag{{ md5('case->diagnostic_text[1]') }}" group="diagnostic"
                                    class="form-control texticd10 autotextgroup" placeholder="Other Diagnosis"
                                    name="formsubmit_diagnostic_text[]" txtnum="1"
                                    value="{{ @$case->diagnostic_text[1] }}" aria-label="Recipient's username"
                                    aria-describedby="basic-addon2" autocomplete="off">
                                <span class="input-group-text" id="icd10text02">ICD-10</span>
                            </div>
                        </div>

                        <div class="col-12 mt-2">
                            <div class="input-group">
                                <input type="text" id="diag{{ md5('case->diagnostic_text[2]') }}" group="diagnostic"
                                    class="form-control texticd10 autotextgroup" placeholder="Other Diagnosis"
                                    name="formsubmit_diagnostic_text[]" txtnum="2"
                                    value="{{ @$case->diagnostic_text[2] }}" aria-label="Recipient's username"
                                    aria-describedby="basic-addon2" autocomplete="off">
                                <span class="input-group-text" id="icd10text03">ICD-10</span>
                            </div>
                        </div>

                        <div class="col-12 mt-2">
                            <div class="input-group">
                                <input type="text" id="diag{{ md5('case->diagnostic_text[3]') }}" group="diagnostic"
                                    class="form-control texticd10 autotextgroup" placeholder="Other Diagnosis"
                                    name="formsubmit_diagnostic_text[]" txtnum="3"
                                    value="{{ @$case->diagnostic_text[3] }}" aria-label="Recipient's username"
                                    aria-describedby="basic-addon2 "autocomplete="off">
                                <span class="input-group-text" id="icd10text04">ICD-10</span>
                            </div>
                        </div>

                        <div class="col-12 mt-2">
                            <div class="input-group">
                                <input type="text" id="diag{{ md5('case->diagnostic_text[4]') }}"
                                    group="diagnostic" class="form-control texticd10 autotextgroup"
                                    placeholder="Other Diagnosis" name="formsubmit_diagnostic_text[]" txtnum="4"
                                    value="{{ @$case->diagnostic_text[4] }}" aria-label="Recipient's username"
                                    aria-describedby="basic-addon2"autocomplete="off">
                                <span class="input-group-text autotext" id="icd10text05">ICD-10</span>
                            </div>
                        </div>

                        <div class="col-12 mt-2">
                            <div class="input-group">
                                <input type="text" id="diag{{ md5('case->diagnostic_text[5]') }}"
                                    group="diagnostic" class="form-control texticd10 autotextgroup"
                                    placeholder="Other Diagnosis" name="formsubmit_diagnostic_text[]" txtnum="5"
                                    value="{{ @$case->diagnostic_text[5] }}" aria-label="Recipient's username"
                                    aria-describedby="basic-addon2"autocomplete="off">
                                <span class="input-group-text" id="icd10text06">ICD-10</span>
                            </div>
                        </div>
                        <div class="col-12 mt-2">
                            <div class="input-group">
                                <input type="text" id="diag{{ md5('case->diagnostic_text[6]') }}"
                                    group="diagnostic" class="form-control texticd10 autotextgroup"
                                    placeholder="Other Diagnosis" name="formsubmit_diagnostic_text[]" txtnum="6"
                                    value="{{ @$case->diagnostic_text[6] }}" aria-label="Recipient's username"
                                    aria-describedby="basic-addon2"autocomplete="off">
                                <span class="input-group-text" id="icd10text07">ICD-10</span>
                            </div>
                        </div>
                        <div class="col-12 mt-2">
                            <div class="input-group">
                                <input type="text" id="diag{{ md5('case->diagnostic_text[7]') }}"
                                    group="diagnostic" class="form-control texticd10 autotextgroup"
                                    placeholder="Other Diagnosis" name="formsubmit_diagnostic_text[]" txtnum="7"
                                    value="{{ @$case->diagnostic_text[7] }}" aria-label="Recipient's username"
                                    aria-describedby="basic-addon2"autocomplete="off">
                                <span class="input-group-text" id="icd10text08">ICD-10</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $("#modal_icd10").click(function() {

            $("#custom-report-icd10").modal('show')
        })






        $("#btn_postdiagnosis").click(function() {

            $(".texticd10").val("");
            $(".texticd10[txtnum='0']").css("background-color", "rgb(210, 235, 246)");
            $(".texticd10[txtnum='0']").val("Normal {{ $procedure->name }}");
            texticd10update();
            clear_checkbox1()
        });

        function clear_checkbox1() {
            var icd10_ck_lg = $('.boxicd10').length
            for (let i = 0; i < icd10_ck_lg; i++) {
                $($('.boxicd10')[i]).prop('checked', false)
            }
            console.log('gggg');
            $.post("{{ url('api/photo') }}", {
                event: "case_update",
                key: "diagnostic",
                val: [],
                cid: "{{ $cid }}"
            }, function(data, status) {});
        }


        $(".boxicd10").click(function() {
            var icd10val = $(this).val();
            var arr = [];
            normal_status = false;

            if (icd10val == "Normal") {
                if ($(this).prop("checked")) {
                    $(".boxicd10").prop('checked', false);
                    $(this).prop('checked', true);

                }
            } else {
                if ($(this).prop("checked")) {
                    $("#boxicdten_0").prop('checked', false);
                }
            }

            var procedurename = '{{ @$case->procedurename }}'
            var firsttext = $($('.texticd10')[0]).val()
            var normal = "Normal " + procedurename
            if (firsttext.includes('Normal ') || firsttext == normal) {
                $($('.texticd10')[0]).val('');
            }

            $(".boxicd10:checked").each(function() {
                arr.push($(this).val());
            });
            arr = arr.filter(function(el) {
                return el != null;
            });

            $.post("{{ url('api/photo') }}", {
                event: "case_update",
                key: "diagnostic",
                val: arr,
                cid: "{{ $cid }}"
            }, function(data, status) {});

            if ($(this).is(':checked')) {
                texticd10add(icd10val);
            } else {
                texticd10sub(icd10val);
            }
            texticd10update();
        });


        function icd10normal_status() {
            var arr = [];
            $(".boxicd10:checked").each(function() {
                arr.push($(this).val());
            });
            arr.forEach(function(el, index) {
                if (el != "") {
                    normal_status = true;
                }
            });
            if (normal_status) {
                $("#icd10_normal").prop("checked", true);
            } else {
                $("#icd10_normal").prop("checked", false);
            }
        }



        $(".texticd10").focusout(function() {
            texticd10update();
        });
    </script>


    @if (@$admin->system_autotext == 'true')
        <script>
            $(".texticd10").focusout(function() {
                let group = $(this).attr("group");
                let text = $(this).val();
                $.post("{{ url('api/procedure') }}", {
                    event: "autotextgroup_save",
                    name: group,
                    code: "{{ $procedure->code }}",
                    text: text,
                }, function(d, s) {});
            });
        </script>
    @endif


    <script>
        function texticd10update() {
            let texticd10 = $(".texticd10").map(function() {
                return $(this).val();
            }).get();
            texticd10 = texticd10.filter(function(el) {
                return el != null && el != "";
            });

            save_localstorage('texticd10', texticd10)
            save_localstorage('checkicd10', texticd10)

            $.post("{{ url('api/photo') }}", {
                event: "case_update",
                key: "diagnostic_text",
                val: texticd10,
                cid: "{{ $cid }}"
            }, function(data, status) {});
        }

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

        function texticd10add(icd10val) {
            let same = true;
            let breakcom = true;
            let arr2 = [];
            let texticd10 = $(".texticd10").map(function() {
                return $(this).val();
            }).get();
            texticd10.forEach(function(el, index) {
                if (el == icd10val) {
                    same = false;
                }
            });
            texticd10 = texticd10.filter(function(el) {
                return el != null;
            });

            if (icd10val == "Normal") {
                $(".texticd10").val("");
                $(".texticd10[txtnum='0']").val("Normal");
            }

            if (same) {
                texticd10.forEach(function(el, index) {
                    if ($(".texticd10[txtnum='" + index + "']").val() == "") {
                        if (breakcom) {
                            arr2.push(icd10val);
                        }
                        breakcom = false;
                    } else {

                        if (el != "Normal") {
                            arr2.push(el);
                        }

                    }
                });

                arr2.forEach(function(el, index) {
                    $(".texticd10[txtnum='" + index + "']").val(el);
                    $(".texticd10[txtnum='" + index + "']").css("background-color", "rgb(210, 235, 246)");
                    $(".texticd10[txtnum='" + index + "']").css("background-color", "rgb(210, 235, 246)");
                });


            }
        }

        function texticd10sub(icd10val) {
            let arr2 = [];
            let texticd10 = $(".texticd10").map(function() {
                return $(this).val();
            }).get();
            texticd10.forEach(function(el, index) {
                if ($(".texticd10[txtnum='" + index + "']").val() != icd10val) {
                    arr2.push(el);
                }
            });
            arr2.forEach(function(el, index) {
                $(".texticd10[txtnum='" + index + "']").val(el);
            });

            var lg = ('.texticd10').length
            for (let i = 0; i < lg; i++) {
                var inp_val = $($('.texticd10')[i]).val()
                if (inp_val == "" || inp_val == undefined) {
                    $(".texticd10[txtnum='" + i + "']").css("background-color", "white");
                }
            }
        }
    </script>
