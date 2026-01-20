<div class="row px-4">
    <div class="col-6">
        <span class="fw-bold">Time Stamp</span>
        <div class="row mt-3">
            <div class="col-3 p-2">
                Patient In
            </div>
            <div class="col-3">
                <input id="time_patientin" type="text" placeholder="hh:mm:ss" maxlength="9"
                    value="{{ @$case->time_patientin }}" time="0" onfocusout="edit_time(this.value, this.id)"
                    class="form-control form-control-sm  savejson text-time time_format1  mt-0 timepicker" autocomplete="off">
            </div>
            <div class="col-6"></div>
        </div>
        <div class="row mt-3">
            <div class="col-3 p-2">
                Operation Start
            </div>
            <div class="col-3">
                <input id="time_start" placeholder="hh:mm:ss" type="text" value="{{ @$case->time_start }}" onfocusout="edit_time(this.value, this.id)"
                    time="1" class="form-control form-control-sm savejson text-time time_format2  timepicker" autocomplete="off">
            </div>
            <div class="col-6"></div>
        </div>

        {{-- @dd($procedure->code); --}}
        @if (@$procedure->code == 'gi002')

        <div class="row mt-3">
            <div class="col-3 p-2">
                Withdrawal
            </div>
            <div class="col-3">
                <input id="time_withdrawal" placeholder="hh:mm:ss" onkeypress="return onlyNumbersWithColon(event);"
                    type="text" value="{{ @$case->time_withdrawal }}" time="2" onfocusout="edit_time(this.value, this.id)"
                    class="form-control form-control-sm  savejson text-time time_format3  timepicker" autocomplete="off">
            </div>
            <div class="col-6"></div>
        </div>
        @endif
        <div class="row mt-3">
            <div class="col-3 p-2">
                Operation End
            </div>
            <div class="col-3">
                <input id="time_end" placeholder="hh:mm:ss" onkeypress="return onlyNumbersWithColon(event);"
                    type="text" value="{{ @$case->time_end }}" time="3" onfocusout="edit_time(this.value, this.id)"
                    class="form-control form-control-sm savejson text-time time_format4 timepicker" autocomplete="off">
            </div>
            <div class="col-6"></div>
        </div>
    </div>
    <div class="col-4">
        <span class="fw-bold">Endoscope Usage</span>
        <div class="row">
            <div class="col-8 mt-3">
                <select id="scope_sel" class="form-select form-select-sm  mb-3" data-choices
                    onchange="add_scope_data('{{ $case->id }}')" >
                    <option value="">Endoscope</option>
                    @foreach ($scopes as $data)
                        <option value="{{ $data->scope_id }}" >{{ @$data->scope_name }} &nbsp;
                            {{ @$data->scope_serial }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-8"></div>
            <div class="col-8 mt-2"></div>
            <div class="col-8"></div>
            <div class="col-8 " id="scope_data_list">
                @isset($case->scope)
                    @foreach ($case->scope as $scope_id)
                        @php
                            $sc = get_scope_data(intval($scope_id), 'scope_id');
                        @endphp
                        <div class="row m-0 cn scope_list  scope_list{{ @$sc->scope_id }}">
                            <div class="col-9 scope-data" data-scopeid="{{ @$sc->scope_id }}">{{ @$sc->scope_name }} SN :
                                {{ @$sc->scope_serial }}</div>
                            <div class="col-3 p-0">
                                <button type="button"
                                    onclick='del_scope_data("{{ @$case->id }}","{{ @$sc->scope_id }}")'
                                    class="btn btn-icon btn-light-danger btn-sm" style="float:right">
                                    <i class="ri-close-line text-danger" style="font-size: 20px"></i>
                                </button>
                            </div>
                        </div>
                    @endforeach
                @endisset
            </div>

        </div>
    </div>
    <div class="col-4"></div>


    {{-- <div class="col-1 mt-2">
        <a class="btn btn-soft-secondary " onclick='add_scope("{{ $cid }}")'><i class="ri-add-fill"></i>
            Add</a>
    </div> --}}




</div>
<script src="{{url("public/js/cleave.min.js")}}"></script>

{{-- <script src="https://cdn.jsdelivr.net/npm/cleave.js@1.6.0/dist/cleave.min.js"></script> --}}
<script>
    var cleave = new Cleave('.time_format1', {
        time: true,
        timePattern: ['h', 'm', 's']
    });
    var cleave = new Cleave('.time_format2', {
        time: true,
        timePattern: ['h', 'm', 's']
    });
    if($('.time_format3').length > 0){
        var cleave = new Cleave('.time_format3', {
            time: true,
            timePattern: ['h', 'm', 's']
        });
    }
    if($('.time_format4').length > 0){
        var cleave = new Cleave('.time_format4', {
            time: true,
            timePattern: ['h', 'm', 's']
        });
    }
</script>
{{-- <script>
    const time = document.getElementById("time_patientin");

    time.addEventListener('input', (e) => {
        let input = e.target.value;
        // Test if ending with /, so it's a delete operation when ending with /
        if (/\D:$/.test(input)) {
            input = input.substr(0, input.length - 3);
        }
        // /\D/g replaces every non zero value
        const values = input.split(':');
        const timeValues = values.slice(0, 2).map((v) => v.replace(/\D/g, ''));

        if (timeValues[0]) timeValues[0] = formatValue(timeValues[0], 12);
        if (timeValues[1]) timeValues[1] = formatValue(timeValues[1], 59);

        const output = timeValues.map(
            (v, i) => v.length == 2 && i < 2 ? v + ':' : + v);
        if (values[2]) {
            const meridian = formatMeridian(values[2]);
            output.push(meridian);
        }

        e.target.value = output.join('').substr(0, 12);
    });
    const formatValue = (str, max) => {
        if (str.charAt(0) !== '0' || str == '00') {
            const num = parseInt(str);
            if (isNaN(num) || num <= 0 || num > max) num = 1;
            str = num > parseInt(max.toString().charAt(0)) && num.toString().length == 1 ? '0' + num : num
            .toString();
        };
        return str;
    };

    const formatMeridian = (str) => {
        str = str.toUpperCase().trim();
        return /(AM|PM|^A$|^P$)/.test(str) ? str : '';
    }
</script> --}}
<script>
    function add_scope_data(case_id) {
        var scope_id = $('#scope_sel').val()
        var check_scope = check_have_scope(scope_id)

        if (check_scope) {
            return 0;
        }

        if (scope_id) {
            $.post("{{ url('api/jquery') }}", {
                    event: 'add_scope',
                    case_id: case_id,
                    scope_name: scope_id
                },
                function(data, status) {
                    var scope = JSON.parse(data)
                    console.log(scope);
                    let html = `
                <div class="row m-0 cn scope_list  scope_list${scope_id}" >
                    <div class="col-9 scope-data" data-scopeid="${scope_id}">${scope.scope_name} SN : ${scope.scope_serial}</div>
                    <div class="col-3 p-0" >
                        <button type="button" onclick='del_scope_data("${case_id}","${scope_id}")' class="btn btn-icon btn-light-danger btn-sm" style="float:right">
                            <i class="ri-close-line text-danger" style="font-size: 20px"></i>
                        </button>
                    </div>
                </div>
                `
                    $("#scope_data_list").append(html)
                })
        }
    }

    function del_scope_data(case_id, scope_id) {
        console.log(case_id, scope_id);
        $.post("{{ url('api/jquery') }}", {
            event: 'delete_scope',
            case_id: case_id,
            scope_name: scope_id
        }, function(data, status) {
            console.log(data);
            if (data == 'success') {
                $(".scope_list" + scope_id).remove()
            }
        })
    }

    function check_have_scope(scope_id) {
        let status = false
        let scope_num = $('.scope-data').length
        for (let i = 0; i < scope_num; i++) {
            let this_scopeid = $($('.scope-data')[i]).data('scopeid')
            if (this_scopeid == scope_id) {
                status = true
            }
        }
        return status
    }

    function validate_timestr(time){
        let new_time = time.trim().replace(/:/g, '');
        if(new_time.length <= 2) {
            new_time += '00';
        } else if(new_time.length === 3) {
            new_time = new_time.substring(0, 2) + '0' + new_time.substring(2);
        } else if(new_time.length > 4) {
            new_time = new_time.substring(0, 4);
        }
        let hours = new_time.substring(0, 2);
        let minutes = new_time.substring(2, 4);
        return  `${hours}:${minutes}:00`;
    }

    function edit_time(text, id){
        let time_value = text.trim()
        // filter empty str out
        let parts = time_value.split(':').filter(part => part !== '')
        parts = parts.map((part, index) => {
            // for hours and sec, pad 0 at the start
            if(index === 0 || index === 2){
                return part.padStart(2, '0')
            }
            // for min, if single digit, assume tens
            if(index == 1 && part.length == 1){
                return part + '0'
            }
            return part
        })

        // if only hour, add '00' for both min and sec
        if(parts.length == 1){
            parts.push('00', '00')
        }

        // if only hour and min, add '00' for sec
        if(parts.length == 2){
            parts.push('00')
        }

        new_value = parts.slice(0, 3).join(':')
        if(parts[0]){
            if(parts[0].length >= 3 ){
                // in case, cleave.js format wrong (e.g., '111'=>'111:00:00' in withdrawal time)
                new_value  = validate_timestr(new_value)
            }
        }

        $(`#${id}`).val(new_value)

        $.post('{{ url('api/procedure') }}', {
            event: 'savejson',
            name: id,
            value: new_value,
            table: 'tb_case',
            field: 'case_json',
            id: '{{ $cid }}',
            comcreate: '{{ $case->comcreate }}',
            procedure: '{{ $procedure->code }}',
        }, function(data, status) {});
    }
</script>



{{-- <script>
    $('.timepicker').timepicker({
        disableMousewheel: true,
        icons: {
            up: 'la la-angle-up',
            down: 'la la-angle-down'
        },
        showSeconds: true,
        showMeridian: false,
        defaultTime: new Date()
    }).on('changeTime.timepicker', function(e) {
        var hours = ('0' + e.time.hours).slice(-2);
        var minutes = ('0' + e.time.minutes).slice(-2);
        var seconds = ('0' + e.time.seconds).slice(-2);
        $(this).val(hours + ':' + minutes + ':' + seconds);
    });
</script> --}}
