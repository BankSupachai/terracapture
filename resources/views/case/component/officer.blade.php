@php
    use app\models\Mongo;
@endphp

<style>
    ::-webkit-scrollbar {
        width: 0px;
    }

    .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background-color: #f3f6f9;
        border: 0 !important;
    }

    .border-radius {
        border-radius: 0px 4px 4px 0;
    }

    .scroll-list {
        overflow: auto;
        height: 107px;
    }

    .select2-container--default .select2-selection--multiple {
        background: #f3f6f9 !important;
    }

    .select2-container--default.select2-container--focus .select2-selection--multiple,
    .select2-container--default .select2-selection--multiple.select2-selection--filled {
        background-color: #d2ebf6 !important;
    }
</style>


@if (@$project_name == 'capture')
    <div class="col-12 p-0">
        {!! editcard('officer', 'officer.blade.php') !!}
        <div class="card card-custom gutter-b">
            <div class="card-body">
                <h5> <b>Staff</b></h5>
                <div class="row">
                    <div class="col-xxl-6">

                        Physician

                        <div class="row">
                            <div class="col-5 pe-0">

                                <select name="case_physicians01" id="case_physicians01" class="form-control" required>
                                    <option value="">เลือกแพทย์</option>
                                    @foreach ($doctor as $data)
                                        <option value="{{ @$data->uid }}" @selected(@$case->case_physicians01 == @$data->uid)>
                                           {{ fullname(@$data) }}  {{ @$data->user_code }}  </option>
                                    @endforeach
                                </select>

                            </div>
                            <div class="col-1 ps-0">
                                <button type="button"
                                    class="btn btn-primary btn-icon waves-effect waves-light border-radius"
                                    data-bs-toggle="modal" data-bs-target="#modal_adddoctor">
                                    <i class="ri-user-add-line"></i>
                                </button>
                            </div>
                            <div class="col-5 pe-0" style="margin-top:-20px;">
                                Consultant<br>
                                <select name="case_consultant" id="case_consultant" class="form-control" select2>
                                    <option value="">เลือกแพทย์</option>
                                    @foreach ($doctor as $data)
                                        <option value="{{ $data->uid }}" @selected(@$case->case_consultant == $data->uid)>
                                            {{ fullname($data) }} {{ $data->user_code }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-1 ps-0">
                                <button type="button"
                                    class="btn btn-primary btn-icon waves-effect waves-light border-radius"
                                    data-bs-toggle="modal" data-bs-target="#modal_adddoctor">
                                    <i class="ri-user-add-line"></i>
                                </button>
                            </div>

                            <div class="col-6 pt-2">
                                Attendant
                                <select class="form-select" name="user_in_case[]" id="select_users"
                                multiple="multiple">
                                @php
                                    $lists = [];
                                    if (isset($case->user_in_case)) {
                                        $lists = $case->user_in_case;
                                        $user_list = Mongo::table('users')->whereIn('uid', $lists)->get();
                                    }
                                    // กำหนดลำดับและชื่อกลุ่ม
                                    $group_order = [
                                        'doctor' => 'Doctor',
                                        'nurse' => 'Nurse',
                                        'register' => 'Register',
                                        'anesthesia' => 'Anesthesia',
                                        'nurse_anes' => 'Nurse Anesthesia',
                                        'nurse_assistant' => 'Nurse Assistant'
                                    ];

                                    $grouped_users = [];
                                    if (isset($users)) {
                                        foreach ($users as $index => $data) {
                                            $data = (object) $data;
                                            $user_type = @$data->user_type ?? '';

                                            if (isset($group_order[$user_type])) {
                                                if (!isset($grouped_users[$user_type])) {
                                                    $grouped_users[$user_type] = [];
                                                }
                                                $grouped_users[$user_type][] = ['data' => $data, 'index' => $index];
                                            }
                                        }
                                    }
                                @endphp

                                @if (isset($users))
                                    @foreach ($group_order as $type => $label)
                                        @if (isset($grouped_users[$type]) && count($grouped_users[$type]) > 0)
                                            <optgroup label="{{ $label }}">
                                                @foreach ($grouped_users[$type] as $item)
                                                    @php
                                                        $data = $item['data'];
                                                        $index = $item['index'];
                                                        $is_selected = in_array($data->uid, $lists);
                                                    @endphp
                                                    <option value="{{ @$data->uid }}"
                                                        {{ $is_selected ? 'selected' : '' }}>
                                                        {{ @$data->user_prefix }}
                                                        {{ @$data->user_firstname }}
                                                        {{ @$data->user_lastname }}
                                                        {{ @$data->user_code }}
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                        @endif
                                    @endforeach
                                @endif
                            </select>
                            </div>
                            <div class="col-6 pt-2">
                                Reported by<br>
                                <select name="case_doctorreported" id="case_reportedby" class="form-control" select2>
                                    <option value="">เลือกแพทย์</option>
                                    @foreach ($doctor as $data)
                                        <option value="{{ $data->uid }}" @selected(@$case->case_reportedby == $data->uid)>
                                            {{ fullname($data) }} {{ $data->user_code }}</option>
                                    @endforeach
                                </select>
                            </div>



                        </div>

                        <br>

                        {{-- @include('case.component.new.modalVerify')
                    @include('case.component.new.modalalert') --}}
                    </div>
                    <div class="col-xxl-6">
                        <div class="row">

                            <div class="col-9">
                                Assistant<br>
                                <textarea id='assistant' name="assistant" type="text" placeholder="Free text" rows="5"
                                    class="savejson form-control autotext">{{ is_array(@$case->assistant) ? '' : @$case->assistant }}</textarea>
                            </div>
                            <div class="col-3">
                                <br>
                                <button type="submit" id="btn_save_hide" name="report" value="true"
                                    class="btn btn-loading btn-success fs-16" style="width: 10em; height: 7em;">
                                    <i class="ri-dossier-fill fs-20"></i><br>
                                    <span class="">Create Report</span>
                                </button>
                            </div>

                            {{-- <div class="col-12 pt-3">
                                Reported by<br>
                                <select name="case_doctorreported" id="case_reportedby" class="form-control" select2>
                                    <option value="">เลือกแพทย์</option>
                                    @foreach ($doctor as $data)
                                        <option value="{{ $data['id'] }}" @selected(@$case->case_reportedby == $data['id'])>
                                            {{ fullname($data) }} {{ $data['user_code'] }}</option>
                                    @endforeach
                                </select>
                            </div> --}}

                        </div>

                    </div>




                    @if (@uget('user_type') == 'viewer')
                        <div class="col-6" align="right">
                            <button id="btn_save_hide" name="report" value="true"
                                class="btn-submit btn-block btn-lg btn-icon waves-effect waves-light btn-primary  "
                                style="z-index: 999999 !important;;display: block !important;position: absolute;">
                                Show Report&nbsp;&nbsp;
                                <i class="flaticon2-writing"></i>
                            </button>
                        </div>
                    @endif




                    <script>
                        var KTSelect2 = function() {

                            var demos12 = function() {
                                $('#case_physicians01').select2({
                                    placeholder: "Select Physician",
                                    allowClear: true

                                });

                                $('#case_consultant').select2({
                                    placeholder: "Select Physician",
                                    allowClear: true

                                });

                                $('#case_reportedby').select2({
                                    placeholder: "Select Physician",
                                    allowClear: true

                                });

                                $('#select_users').select2({
                                    placeholder: "Select Staff",
                                    allowClear: true
                                }).on('change', function() {
                                    if ($(this).val().length > 0) {
                                        $(this).next('.select2-container').find('.select2-selection--multiple')
                                            .addClass('select2-selection--filled')
                                            .css('background-color', '#d2ebf6');
                                    } else {
                                        $(this).next('.select2-container').find('.select2-selection--multiple')
                                            .removeClass('select2-selection--filled')
                                            .css('background-color', '#f3f6f9');
                                    }

                                    // Save selected values
                                    save_attendant($(this).val());
                                    save_localstorage('attendant', $(this).val());
                                });


                                $("#case_physicians01").change(function() {
                                    let selectedValue = $("#case_physicians01").val();
                                    let selectedText = $("#case_physicians01 option:selected").text();
                                    // alert(selectedText);
                                    $("#case_reportedby").val(selectedValue);
                                    save_localstorage('endoscopist', $('#case_physicians01').val())
                                    $.post('{{ url('api/procedure') }}', {
                                        event: 'changedoctor',
                                        value: $('#case_physicians01').val(),
                                        name: "case_physicians01",
                                        cid: '{{ $cid }}',
                                    }, function(data, status) {});
                                });

                                $("#case_consultant").change(function() {
                                    let selectedValue = $("#case_consultant").val();
                                    let selectedText = $("#case_consultant option:selected").text();
                                    $.post('{{ url('api/procedure') }}', {
                                        event: 'savejson',
                                        name: "case_consultant",
                                        value: selectedValue,
                                        table: "tb_case",
                                        field: 'case_json',
                                        id: '{{ $case->id }}',
                                        comcreate: '{{ @$case->comcreate }}',
                                        procedure: '{{ @$case->case_procedure }}',
                                    }, function(data, status) {});
                                });

                                $("#case_reportedby").change(function() {
                                    save_localstorage('endoscopist', $('#case_physicians01').val())
                                    $.post('{{ url('api/procedure') }}', {
                                        event: 'changedoctor',
                                        value: $('#case_reportedby').val(),
                                        name: "case_reportedby",
                                        cid: '{{ $cid }}',
                                    }, function(data, status) {});
                                });

                                $("#select_users").change(function() {
                                    var value = $(this).val()
                                    var select = $("#select_users option[value='" + value + "']");
                                    var type = select.attr('data-type');
                                    var names = select.attr('data-name')
                                    var index = select.attr('data-index')
                                    var tab = select.attr('data-tab');
                                    var is_show = select.attr('data-show')
                                    if (value != 0 && is_show == 'false') {
                                        var lists = "<div class='col-7 pt-2' sub-tab=" + value + ">" + names +
                                            "</div><div class='col-3 pt-2'sub-tab=" + value + ">" + type +
                                            "</div><div class='col-2 pt-2'sub-tab=" + value +
                                            "><i class='mdi mdi-trash-can text-danger' style='cursor: pointer;' aria-hidden='true' onclick='del_list(" +
                                            value +
                                            ")'></i></div>"
                                        $("#scroll_list").append(lists)
                                        $("#select_users option[value='" + value + "']").attr('data-show', 'true')
                                        list_user_save()
                                    }

                                });
                            }

                            // Public functions
                            return {
                                init: function() {
                                    demos12();
                                }
                            };
                        }();
                        jQuery(document).ready(function() {
                            KTSelect2.init();
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
                    </script>

                    {{-- <div id="modal_esign" class="modal" tabindex="99999999" role="dialog"
                    aria-labelledby="mySmallModalLabel" aria-hidden="false">
                    <div class="modal-dialog">
                        <div class="modal-content" style="width: fit-content;">
                            <div class="modal-content">
                                <a class="btn btn-success" id="btn_checksign">บันทึก</a>
                                <button type="button" class="btn btn-warning" id="btn_close_draw"
                                    data-dismiss="modal">Close</button>
                                <div class="row m-auto">
                                    <div class="col-lg-auto p-0 text-center m-auto sign_modal">
                                        <iframe
                                            src="{{url("e-sign3/?cid=$cid&folderdate=$folderdate&hn=$case->hn")}}"
                                            title="Iframe Example" frameBorder="0"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

                </div>
            </div>
        </div>
        <div class="col-12 mt-2">
            <input type="hidden" name="user_in_case" id="user_in_case" class="savejson">
            {{-- <div class="row m-0 scroll-list" id="scroll_list">

                @foreach (isset($case->user_in_case) ? $case->user_in_case : [] as $data)
                    @php
                        $user = (object) Mongo::table('users')->where('uid', (int) $data)->first();
                        // dd($user,$data);
                    @endphp

                    <div class="col-7 pt-2" sub-tab="{{ @$data }}">
                        {{ @$user->user_prefix }}{{ @$user->user_firstname }}
                        {{ @$user->user_lastname }}

                    </div>
                    <div class="col-3 pt-2" sub-tab="{{ @$data }}">
                        {{ @$user->user_type }}
                    </div>
                    <div class="col-2 pt-2" sub-tab="{{ @$data }}">
                        <i class="mdi mdi-trash-can text-danger" style="cursor: pointer;"
                            onclick='del_list({{ @$data }})' aria-hidden="true"></i>
                    </div>
                @endforeach

            </div> --}}

        </div>
    @else
        <div class="col-12 p-0">
            {!! editcard('officer', 'officer.blade.php') !!}
            <div class="card card-custom gutter-b">
                <div class="card-body">
                    <h5> <b>STAFF</b></h5>
                    <div class="row">
                        <div class="col-xxl-6">

                            Endoscopist

                            <div class="row">
                                <div class="col-11 pe-0">
                                    <select name="case_physicians01" id="case_physicians01" class="form-control"
                                        required select2>
                                        <option value="">เลือกแพทย์</option>
                                        @foreach ($doctor as $data)
                                            <option value="{{ $data->uid }}" @selected($case->case_physicians01 == $data->uid)>
                                                {{ $data->user_code }} {{ fullname($data) }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-1 ps-0">
                                    <button type="button"
                                        class="btn btn-primary btn-icon waves-effect waves-light border-radius"
                                        data-bs-toggle="modal" data-bs-target="#modal_adddoctor">
                                        <i class="ri-user-add-line"></i>
                                    </button>
                                </div>
                                <div class="col-12">
                                    Reported by<br>
                                    <select name="case_doctorreported" id="case_reportedby" class="form-control"
                                        select2>
                                        <option value="">เลือกแพทย์</option>
                                        @foreach ($doctor as $data)
                                            @php
                                                $data = (object) $data;
                                            @endphp
                                            <option value="{{ $data->uid }}" @selected(@$case->case_reportedby == $data->uid)>
                                                {{ fullname($data) }} {{ $data->user_code }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-12 mt-2">
                                    Assistant<br>
                                    <textarea id='assistant' name="assistant" type="text" placeholder="Free text" class="savejson form-control autotext">{{ is_array(@$case->assistant) ? '' : @$case->assistant }}</textarea>
                                </div>

                            </div>

                            <br>

                            {{-- @include('case.component.new.modalVerify')
                    @include('case.component.new.modalalert') --}}
                        </div>
                        <div class="col-xxl-6">
                            <div class="row">
                                <div class="col-12">
                                    Attendant
                                    {{-- @dd($case->user_in_case); --}}
                                    <select class="form-select" name="user_in_case[]" id="select_users"
                                        multiple="multiple">
                                        @php
                                            $lists = [];
                                            if (isset($case->user_in_case)) {
                                                $lists = $case->user_in_case;
                                                $user_list = Mongo::table('users')->whereIn('uid', $lists)->get();
                                            }

                                            // กำหนดลำดับและชื่อกลุ่ม
                                            $group_order = [
                                                'doctor' => 'Doctor',
                                                'nurse' => 'Nurse',
                                                'register' => 'Register',
                                                'anesthesia' => 'Anesthesia',
                                                'nurse_anes' => 'Nurse Anesthesia',
                                                'nurse_assistant' => 'Nurse Assistant'
                                            ];


                                            $grouped_users = [];
                                            if (isset($users)) {
                                                foreach ($users as $index => $data) {
                                                    $data = (object) $data;
                                                    $user_type = @$data->user_type ?? '';

                                                    if (isset($group_order[$user_type])) {
                                                        if (!isset($grouped_users[$user_type])) {
                                                            $grouped_users[$user_type] = [];
                                                        }
                                                        $grouped_users[$user_type][] = ['data' => $data, 'index' => $index];
                                                    }
                                                }
                                            }
                                        @endphp

                                        @if (isset($users))
                                            @foreach ($group_order as $type => $label)
                                                @if (isset($grouped_users[$type]) && count($grouped_users[$type]) > 0)
                                                    <optgroup label="{{ $label }}">
                                                        @foreach ($grouped_users[$type] as $item)
                                                            @php
                                                                $data = $item['data'];
                                                                $index = $item['index'];
                                                                $is_selected = in_array($data->uid, $lists);
                                                            @endphp
                                                            <option value="{{ @$data->uid }}"
                                                                {{ $is_selected ? 'selected' : '' }}>
                                                                {{ @$data->user_prefix }}
                                                                {{ @$data->user_firstname }}
                                                                {{ @$data->user_lastname }}
                                                                {{ @$data->user_code }}
                                                            </option>
                                                        @endforeach
                                                    </optgroup>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="col-12 mt-2">
                                    <input type="hidden" name="user_in_case" id="user_in_case" class="savejson">
                                    <div class="row m-0 scroll-list" id="scroll_list">

                                        @foreach (isset($case->user_in_case) ? $case->user_in_case : [] as $data)
                                            @php
                                                $user = (object) Mongo::table('users')
                                                    ->where('uid', (int) $data)
                                                    ->first();
                                                // dd($user,$data);
                                            @endphp

                                            <div class="col-7 pt-2" sub-tab="{{ @$data }}">
                                                {{ @$user->user_prefix }}{{ @$user->user_firstname }}
                                                {{ @$user->user_lastname }}

                                            </div>
                                            <div class="col-3 pt-2" sub-tab="{{ @$data }}">
                                                {{ @$user->user_type }}
                                            </div>
                                            <div class="col-2 pt-2" sub-tab="{{ @$data }}">
                                                <i class="mdi mdi-trash-can text-danger" style="cursor: pointer;"
                                                    onclick='del_list({{ @$data }})' aria-hidden="true"></i>
                                            </div>
                                        @endforeach

                                    </div>

                                </div>
                            </div>

                        </div>




                        @if (@uget('user_type') == 'viewer')
                            <div class="col-6" align="right">
                                <button id="btn_save_hide" name="report" value="true"
                                    class="btn-submit btn-block btn-lg btn-icon waves-effect waves-light btn-primary  "
                                    style="z-index: 999999 !important;;display: block !important;position: absolute;">
                                    Show Report&nbsp;&nbsp;
                                    <i class="flaticon2-writing"></i>
                                </button>
                            </div>
                        @endif




                        <script>
                            var KTSelect2 = function() {

                                var demos12 = function() {
                                    $('#case_physicians01').select2({
                                        placeholder: "Select Endoscopist",

                                        // minimumInputLength: 6
                                    });
                                    $('#case_reportedby').select2({
                                        placeholder: "Select Endoscopist"
                                    });

                                    $('#select_users').select2({
                                        placeholder: "Select Staff",
                                        allowClear: true
                                    }).on('change', function() {
                                        if ($(this).val().length > 0) {
                                            $(this).next('.select2-container').find('.select2-selection--multiple')
                                                .addClass('select2-selection--filled')
                                                .css('background-color', '#d2ebf6');
                                        } else {
                                            $(this).next('.select2-container').find('.select2-selection--multiple')
                                                .removeClass('select2-selection--filled')
                                                .css('background-color', '#f3f6f9');
                                        }

                                        // Save selected values
                                        save_attendant($(this).val());
                                        save_localstorage('attendant', $(this).val());
                                    });


                                    $("#case_physicians01").change(function() {
                                        let selectedValue = $("#case_physicians01").val();
                                        let selectedText = $("#case_physicians01 option:selected").text();
                                        // alert(selectedText);
                                        $("#case_reportedby").val(selectedValue);
                                        save_localstorage('endoscopist', $('#case_physicians01').val())
                                        $.post('{{ url('api/procedure') }}', {
                                            event: 'changedoctor',
                                            value: $('#case_physicians01').val(),
                                            name: "case_physicians01",
                                            cid: '{{ $cid }}',
                                        }, function(data, status) {});




                                    });


                                    $("#case_reportedby").change(function() {
                                        save_localstorage('endoscopist', $('#case_physicians01').val())
                                        $.post('{{ url('api/procedure') }}', {
                                            event: 'changedoctor',
                                            value: $('#case_reportedby').val(),
                                            name: "case_reportedby",
                                            cid: '{{ $cid }}',
                                        }, function(data, status) {});


                                    });





                                    $("#select_users").change(function() {
                                        var value = $(this).val()
                                        var select = $("#select_users option[value='" + value + "']");
                                        var type = select.attr('data-type');
                                        var names = select.attr('data-name')
                                        var index = select.attr('data-index')
                                        var tab = select.attr('data-tab');
                                        var is_show = select.attr('data-show')
                                        if (value != 0 && is_show == 'false') {
                                            var lists = "<div class='col-7 pt-2' sub-tab=" + value + ">" + names +
                                                "</div><div class='col-3 pt-2'sub-tab=" + value + ">" + type +
                                                "</div><div class='col-2 pt-2'sub-tab=" + value +
                                                "><i class='mdi mdi-trash-can text-danger' style='cursor: pointer;' aria-hidden='true' onclick='del_list(" +
                                                value +
                                                ")'></i></div>"
                                            $("#scroll_list").append(lists)
                                            $("#select_users option[value='" + value + "']").attr('data-show', 'true')
                                            list_user_save()
                                        }

                                    });
                                }

                                // Public functions
                                return {
                                    init: function() {
                                        demos12();
                                    }
                                };
                            }();
                            jQuery(document).ready(function() {
                                KTSelect2.init();
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
                        </script>

                        {{-- <div id="modal_esign" class="modal" tabindex="99999999" role="dialog"
                    aria-labelledby="mySmallModalLabel" aria-hidden="false">
                    <div class="modal-dialog">
                        <div class="modal-content" style="width: fit-content;">
                            <div class="modal-content">
                                <a class="btn btn-success" id="btn_checksign">บันทึก</a>
                                <button type="button" class="btn btn-warning" id="btn_close_draw"
                                    data-dismiss="modal">Close</button>
                                <div class="row m-auto">
                                    <div class="col-lg-auto p-0 text-center m-auto sign_modal">
                                        <iframe
                                            src="{{url("e-sign3/?cid=$cid&folderdate=$folderdate&hn=$case->hn")}}"
                                            title="Iframe Example" frameBorder="0"></iframe>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

                    </div>
                </div>
            </div>
@endif
<div class="col-12 text-center mb-3">
    @if (@$project_name == 'capture')
    @else
        @if (@getCONFIG("feature")->system_esign)
            <button type="submit" name="report" value="true" id="btn_save"
                class="btn btn-success  btn-loading fs-16 " style="width: 50em;">
                <i class="ri-dossier-fill"></i>
                <span class="">Create Report</span>
            </button>
        @else
            <button type="submit" id="btn_save_hide" name="report" value="true"
                class="btn btn-loading btn-success fs-16" style="width: 50em;">
                <i class="ri-dossier-fill "></i>
                <span class="">Create Report</span>
            </button>
        @endif
    @endif

</div>
</div>
<script>
    $(".possiblecolorectalcancer").click(function() {
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
    });
</script>



























<link rel="stylesheet" href="{{ url('public/css/component/officer.css') }}">


<script>
    function del_list(data) {
        $("#select_users option[value='" + data + "']").attr('data-show', 'false')
        $("div[sub-tab='" + data + "'").remove()
        list_user_save()
    }

    function list_user_save() {
        count_list = $("#scroll_list .col-7").length
        var data_array = [];
        for (i = 0; i < count_list; i++) {
            data_array.push($($("#scroll_list .col-7")[i]).attr('sub-tab'));
        }
        save_attendant(data_array)
        save_localstorage('attendant', data_array)
        var my_json = JSON.stringify(data_array)
    }

    function save_attendant(val) {
        $.post("{{ url('api/photomove') }}", {
            event: 'save_attendant',
            key: "user_in_case",
            cid: '{{ $cid }}',
            val: val
        }, function(data, status) {});
    }
</script>
