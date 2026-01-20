{{-- <table class="table table-nowrap align-middle" id="{{@$tbody_id}}_div" style="width: 80%">
    <thead class="table-light">
        <tr>
            <th>_id</th>
            <th>track_rfid</th>
            <th>track_user</th>
            <th>track_username</th>
            <th>track_time</th>
            <th>track_date</th>
            <th>scope_name</th>
            <th>scope_band</th>
            <th>scope_model</th>
            <th>track_serial</th>
            <th>track_station</th>
            <th>room_name</th>
            <th>track_status</th>
            <th>track_type</th>
        </tr>
    </thead>
    <tbody id="{{@$tbody_id}}">
        @foreach (isset($data) ? $data : [] as $track)
            <tr>
                @php
                    $track = (object) $track;
                @endphp
                <td>{{@$track->_id}}</td>
                <td>{{@$track->track_rfid}}</td>
                <td>{{@$track->track_user}}</td>
                <td>{{@$track->track_username}}</td>
                <td>{{@$track->track_time}}</td>
                <td>{{@DateTime::createFromFormat('Y-m-d', $track->track_date)->format('d/m/Y')}}</td>
                <td>{{@$track->scope_name}}</td>
                <td>{{@$track->scope_band}}</td>
                <td>{{@$track->scope_model}}</td>
                <td>{{@$track->track_serial}}</td>
                <td>{{@$track->track_station}}</td>
                <td>{{@$track->room_name}}</td>
                <td>{{@$track->track_status}}</td>
                <td>{{@$track->track_type}}</td>
            </tr>
        @endforeach
    </tbody>
</table>
 --}}


<p>Period : @if (isset($this_month))
        <span>{{ @$this_month }}/</span>
    @endif <span>{{ @$this_year . '' }}</span></p>
<p>Summary Form: <span>{{ @$this_type }}</span></p>
<p>Calculated from: Time Stamp(Patient in) - Time Stamp(Patient out)</p>
@php
    $total = [];
    $total_cases_all = [];
    $total_procedure = [];
    $total_procedure_all = [];
    $most_used_scopename = [];
    $text_head = $have_month ? 'Date' : 'Month';
@endphp
<table class="table table-nowrap align-middle" id="{{ @$tbody_id }}_div" style="width: 80%">
    <thead class="table-light">
        <tr>
            <th>Endoscope/{{ @$text_head }}</th>
            @foreach (isset($this_col) ? $this_col : [] as $col)
                @if (isset($this_month))
                    @php
                        $exclude = [];
                        $col = isset($col) ? strval($col) : '';
                        if ($this_month == '02') {
                            $exclude = ['29', '30', '31'];
                        } elseif (in_array($this_month, ['04', '06', '09', '11'])) {
                            $exclude = ['31'];
                        }

                        if (in_array($col, $exclude)) {
                            continue;
                        }

                        $total[] = $col;
                    @endphp
                @else
                    @php
                        $total[] = $col;
                    @endphp
                @endif
                <th>{{ @$col }}</th>
            @endforeach
            <th>Total</th>
        </tr>
    </thead>
    <tbody id="{{ @$tbody_id }}">
        @foreach ($scopes ?? [] as $scope)
        {{-- @dd($scope) --}}
            @php
                $sum = 0;
                $total_sum = 0;
                $scope_name = !empty($scope) ? $scope : '';

                $exp_scope = explode('::', $scope_name);
                $scopefullname = $exp_scope[0];
                $scopeid = $exp_scope[1];
                if (!isset($scope_name)) {
                    continue;
                }

                if (array_key_exists($scopeid, $scope_total)) {
                    $most_used_scopename[] = $scopefullname;
                }
                $total_procedure[] = $scopeid;


                // dd($scopefullname,$total,$data);
            @endphp
            <tr>
                <td>{{ @$scopefullname }}</td>
                @for ($i = 0; $i < count($total); $i++)
                    @php
                        $case_num = isset($data[$this_year][$total[$i]][$scopeid])
                            ? $data[$this_year][$total[$i]][$scopeid]
                            : 0;
                        $sum += $case_num;
                    @endphp
                    <td>{{ @$case_num }}</td>
                @endfor
                <td>{{ @$sum }}</td>
                @php
                    $total_procedure_all[] = isset($sum) ? $sum : 0;
                @endphp
            </tr>
        @endforeach
        <tr>
            <td>Total</td>
            @for ($j = 0; $j < count($total); $j++)
                @php
                    $total_cases = 0;
                    if (is_array($data[$this_year][$total[$j]])) {
                        $total_cases = array_sum($data[$this_year][$total[$j]]);
                        $total_cases_all[] = $total_cases;
                    }
                    $total_sum += $total_cases;
                @endphp
                <td>{{ @$total_cases }}</td>
            @endfor
            <td>{{ @$total_sum }}</td>
        </tr>
    </tbody>
</table>


<div id="graph_div">
    <div class="row">
        @php
            $date_type = $have_month ? 'Month' : 'Year';
            $scope_total_values =
                isset($scope_total) && gettype(@$scope_total) == 'array' ? array_values($scope_total) : [];
        @endphp
        <div class="col-1"></div>
        <div class="col-lg-10">
            <div class="card-body p-0 mt-4">
                <div id="bar_endoscope" data-colors='["--vz-primary", "--vz-success", "--vz-warning", "--vz-danger"]'
                    class="apex-charts" dir="ltr"></div>
            </div>
        </div>
        <div class="col-1"></div>

    </div>
</div>


<script src="{{ asset('public/js/moment.min.js') }}"></script>
<script>
    var xaxis = @json($most_used_scopename);
    var yaxis = @json($scope_total_values);
    var options = {
        series: [{
            name: xaxis,
            data: yaxis,
        }],
        chart: {
            type: 'bar',
            stacked: true,
            height: 500,
            width: '100%',
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                endingShape: 'rounded'
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        xaxis: {
            categories: xaxis,
        },
        yaxis: {
            title: {
                text: ''

            },
            labels: {
                formatter: function(value) {
                    return Math.floor(value);
                }
            }
        },
        fill: {
            opacity: 1,
            colors: ['#245788'],
        },
        tooltip: {
            y: {
                formatter: function(val) {
                    return val + ' เคส'
                }
            }
        },
        legend: {
            show: true,
            position: 'right',
            horizontalAlign: 'center',
        },
        colors: ['#245788'],
    };

    var chart = new ApexCharts(document.querySelector("#bar_endoscope"), options);
    chart.render();
</script>
