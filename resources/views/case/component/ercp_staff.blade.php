@php
    use app\models\Mongo;
@endphp
<div class="card card-custom gutter-b">
    <div class="card-body">
        <h5>Staff</h5>
        <div class="row">
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-6">
                        <label for="basiInput" class="form-label">Endoscopist</label>
                        <select name="case_physicians01" id="case_physicians01" class="form-control" required select2>
                            <option value="">เลือกแพทย์</option>
                            @foreach ($doctor as $data)
                                <option value="{{ $data->uid }}" @selected($case->case_physicians01 == $data->uid)>{{ fullname($data) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6">
                        <label for="basiInput" class="form-label">Department</label>
                        <input type="text" class="form-control savejson" id="staff_department" placeholder="Fill Department"
                            value="{{ @$case->staff_department }}">
                    </div>
                    <div class="col-12 mt-1">
                        @php
                            $list_consultant = [];
                            $consult_list = [];
                            if (isset($case->consultant)) {
                                $list_consultant = array_map('intval', $case->consultant);
                                $consult_list = Mongo::table('users')
                                    ->whereIn('uid', $list_consultant)
                                    ->get();
                            }
                        @endphp

                        <label for="basiInput" class="form-label">Consultant</label>
                        <select class="form-control select_consultant" select2>
                            <option value="">Select Consultants</option>
                            @foreach ($doctor as $index => $user)
                                @php
                                    $user = (object) $user;
                                    $is_consultant = in_array($user->uid, $list_consultant) ? 'true' : 'false';
                                @endphp
                                <option value       ="{{ @$user->uid }}" data-tokens ="{{ @$user->uid }}"
                                    data-name   ="{{ @$user->user_prefix }} {{ @$user->user_firstname }} {{ @$user->user_lastname }}"
                                    data-type   ="{{ @$user->user_type }}" data-tab    ="{{ @$user->uid }}"
                                    data-index  = "{{ @$index }}" data-show   = "{{ @$is_consultant }}">
                                    {{ fullname($user) }}</option>
                            @endforeach
                        </select>
                        <div class="row consultant-div mb-3">
                            @foreach ($consult_list as $consultant)
                                @php
                                    $consultant = (object) $consultant;
                                @endphp
                                <div class='col-7 pt-2' sub-tab="{{ @$consultant->uid }}">{{ fullname($consultant) }}
                                </div>
                                <div class='col-3 pt-2'sub-tab="{{ @$consultant->uid }}">{{ @$consultant->user_type }}
                                </div>
                                <div class='col-2 pt-2'sub-tab="{{ @$consultant->uid }}"
                                    onclick='del_user(".consultant-div .col-7","{{ @$consultant->uid }}")'>
                                    <i class='mdi mdi-trash-can text-danger' style='cursor: pointer;'
                                        aria-hidden='true'></i>
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-12">
                        <label for="basiInput" class="form-label">Attendent</label>
                        <select class="form-control" name="attendant" id="select_users" select2>
                            <option value="">Select Users</option>
                            @php
                                $lists = [];
                                if (isset($case->user_in_case)) {
                                    $lists = $case->user_in_case;
                                    $user_list = Mongo::table('users')
                                        ->whereIn('uid', $lists)
                                        ->get();
                                }
                            @endphp
                            @if (isset($users))
                                @foreach ($users as $index => $data)
                                    @php
                                        $data = (object) $data;
                                        $is_attendant = in_array($data->uid, $lists) ? 'true' : 'false';
                                    @endphp
                                    <option value       ="{{ @$data->uid }}" data-tokens ="{{ @$data->uid }}"
                                        data-name   ="{{ @$data->user_prefix }} {{ @$data->user_firstname }} {{ @$data->user_lastname }}"
                                        data-type   ="{{ @$data->user_type }}" data-tab    ="{{ @$data->uid }}"
                                        data-index  = "{{ @$index }}" data-show   = "{{ @$is_attendant }}">
                                        {{ @$data->user_prefix }} {{ @$data->user_firstname }}
                                        {{ @$data->user_lastname }} {{ @$data->user_code }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-12">
                        <input type="hidden" name="user_in_case" id="user_in_case" class="savejson">
                        <div class="row m-0 scroll-list" id="scroll_list">

                            @foreach (isset($case->user_in_case) ? $case->user_in_case : [] as $data)
                                @php
                                    $user = (object) Mongo::table('users')
                                        ->where('uid', (int) $data)
                                        ->first();
                                @endphp


                                <div class="col-7 pt-2" sub-tab="{{ @$data }}">
                                    {{ @$user->user_prefix }}{{ @$user->user_firstname }} {{ @$user->user_lastname }}

                                </div>
                                <div class="col-3 pt-2" sub-tab="{{ @$data }}">{{ @$user->user_type }}</div>
                                <div class="col-2 pt-2" sub-tab="{{ @$data }}">
                                    <i class="mdi mdi-trash-can text-danger" style="cursor: pointer;"
                                        onclick='del_list({{ @$data }})' aria-hidden="true"></i>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>


            </div>
            <div class="col-12">
                <label for="basiInput" class="form-label">Trainee involvement</label>
                <div class="row">
                    <div class="col-6">
                        <div class="row">
                            <div class="col-3 align-self-center">
                                <div class="form-check">
                                    <input class="form-check-input radiosave ck-no" datagroup="traineeinvolvement"
                                        subgroup="traineeinvolvement" value="No" type="radio"
                                        name="traineeinvolvement" id="{{ md5('no') }}"
                                        {{ checkradio($case, 'traineeinvolvement', 'No') }}>
                                    <label class="form-check-label" for="{{ md5('no') }}">
                                        &ensp; &ensp; No
                                    </label>
                                </div>
                            </div>
                            <div class="col-3 align-self-center">
                                <div class="form-check ">
                                    <input class="form-check-input radiosave" datagroup="traineeinvolvement"
                                        value="Yes" type="radio" name="traineeinvolvement"
                                        id="{{ md5('yes') }}" {{ checkradio($case, 'traineeinvolvement', 'Yes') }}>
                                    <label class="form-check-label" for="{{ md5('yes') }}">
                                        &ensp; &ensp; Yes
                                    </label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-check">
                                    <select class="form-control select_trainee ck-traineeinvolvement-input"
                                        datagroup="trainee" name="trainee" id="select_trainee" select2>

                                        @if (isset($users))
                                            @foreach ($users as $index => $data)
                                            {{-- @dd($data); --}}
                                                @php
                                                    $data = (object) $data;
                                                    // dd($data);
                                                @endphp
                                                <option value=""></option>
                                                <option value="{{ @$data->uid }}" @selected(@$case->trainee . '' == @$data->uid . '')>
                                                    {{ @$data->user_prefix }} {{ @$data->user_firstname }}
                                                    {{ @$data->user_lastname }} {{ @$data->user_code }}
                                                </option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <input type="text"
                            class="form-control autotext savejson ck-traineeinvolvement-input other_trainee"
                            id="other_trainee" placeholder="Other" value="{{ @$case->other_trainee }}">
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>


<script>
    $(document).ready(function name(params) {
        init()
    })

    function init() {
        $('.select_consultant').select2({
            placeholder: "Select Consultant(s)"
        });
        $('.select_trainee').select2({
            placeholder: "Select Trainee"
        });
        $('#case_physicians01').select2({
            placeholder: "Select Endoscopist"
        });
        $('#select_users').select2({
            placeholder: "Select Staff"
        });
        $("#case_physicians01").change(function() {
            save_localstorage('endoscopist', $('#case_physicians01').val())
            $.post('{{ url('api/photomove') }}', {
                event: 'savejson',
                name: "case_physicians01",
                value: $('#case_physicians01').val(),
                table: 'tb_case',
                field: 'case_json',
                id: '{{ $cid }}',
                comcreate: '{{ $case->comcreate }}',
                procedure: '{{ $procedure->code }}',
            }, function(data, status) {});

            $.post('{{ url('api/procedure') }}', {
                event: 'changedoctor',
                value: $('#case_physicians01').val(),
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
        $(".select_consultant").change(function() {
            var value = $(this).val()
            var select = $(".select_consultant option[value='" + value + "']");
            var type = select.attr('data-type');
            var names = select.attr('data-name')
            var is_show = select.attr('data-show')
            if (value != 0 && is_show == 'false') {
                var lists =
                    `<div class='col-7 pt-2' sub-tab="${value}">${names}</div>
                            <div class='col-3 pt-2'sub-tab="${value}">${type}</div>
                            <div class='col-2 pt-2'sub-tab="${value}" onclick='del_user(".consultant-div .col-7","${value}")'><i class='mdi mdi-trash-can text-danger' style='cursor: pointer;' aria-hidden='true' ></i></div>`
                $(".consultant-div").append(lists)
                $(".select_consultant option[value='" + value + "']").attr('data-show', 'true')

                let data_array = get_user('.consultant-div .col-7', 'sub-tab')
                list_save('consultant', data_array)
                save_name('consultant', data_array)
            }
        });

        $(".select_trainee").change(function(e) {
            check_trainee(e.target)
            if($(e.target).val() == 'No'){
                $.post('{{ url('api/procedure') }}', {
                    event: "radiosavename",
                    cid: '{{ @$cid }}',
                    datagroup: `traineename`,
                    value: ''
                }, function(d, s) {})
            }
        });

        $('.other_trainee').change(function(e) {
            check_trainee(e.target)
        })

        function check_trainee(e) {
            let value = $(e).val()
            let datagroup = $(e).attr('datagroup')
            let radio = $('.radiosave[datagroup="traineeinvolvement"][value="Yes"]')
            if (value != '' && value != null)
                if (!radio.is(':checked')) $(radio).click()
            $.post('{{ url('api/procedure') }}', {
                event: "radiosave",
                cid: '{{ @$cid }}',
                datagroup: datagroup,
                value: value
            }, function(d, s) {})
            if(datagroup){
                save_name(datagroup, value)
            }

        }

        function save_name(datagroup, value) {
            $.post('{{ url('api/procedure') }}', {
                event: "radiosavename",
                cid: '{{ @$cid }}',
                datagroup: `${datagroup}name`,
                value: value
            }, function(d, s) {})
        }
    }

        function del_list(data) {
            $("#select_users option[value='" + data + "']").attr('data-show', 'false')
            $("div[sub-tab='" + data + "'").remove()
            console.log('rrrr');
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

{{-- <script>
    var KTSelect2 = function() {

        var demos12 = function() {
            $('#case_physicians01') .select2({placeholder: "Select Endoscopist"});
            $('#select_users')      .select2({placeholder: "Select Staff"});
            $("#case_physicians01").change(function(){
                save_localstorage('endoscopist', $('#case_physicians01').val())
                $.post('{{url('api/photomove')}}',{
                    event       : 'savejson',
                    name        : "case_physicians01",
                    value       : $('#case_physicians01').val(),
                    table       : 'tb_case',
                    field       : 'case_json',
                    id          : '{{$cid}}',
                    comcreate   : '{{$case->comcreate}}',
                    procedure   : '{{$procedure->code}}',
                },function(data,status){});

                $.post('{{url('api/procedure')}}',{
                    event       : 'changedoctor',
                    value       : $('#case_physicians01').val(),
                    cid         : '{{$cid}}',
                },function(data,status){});


            });
            $("#select_users").change(function() {
                var value   = $(this).val()
                var select  = $("#select_users option[value='" + value + "']");
                var type    = select.attr('data-type');
                var names   = select.attr('data-name')
                var index   = select.attr('data-index')
                var tab     = select.attr('data-tab');
                var is_show = select.attr('data-show')
                if (value != 0 && is_show == 'false') {
                    var lists = "<div class='col-7 pt-2' sub-tab=" + value + ">" + names +
                        "</div><div class='col-3 pt-2'sub-tab=" + value + ">" + type +
                        "</div><div class='col-2 pt-2'sub-tab=" + value +
                        "><i class='mdi mdi-trash-can text-danger' style='cursor: pointer;' aria-hidden='true' onclick='del_list(" + value +
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






</script> --}}
