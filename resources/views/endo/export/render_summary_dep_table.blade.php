<p>Period : @if(isset($this_month))<span>{{@$this_month}}/</span> @endif <span>{{@$this_year.""}}</span></p>
<p>Summary Form: <span>{{@$this_type}}</span></p>
@php
    $total = [];
    $total_cases_all = [];
    $total_procedure = [];
    $total_procedure_all = [];
@endphp
<table class="table table-nowrap align-middle" id="{{@$tbody_id}}_div" style="width: 80%">
    <thead class="table-light">
        <tr>
            <th >Procedure/Date</th>
            @foreach (isset($this_col)?$this_col:[] as $col)
            @if(isset($this_month))
                @php
                    $exclude = [];
                    $col = isset($col) ? strval($col) : '';
                    if($this_month == '02'){
                        $exclude = ['29', '30', '31'];
                    } else if(in_array($this_month, ['04', '06', '09', '11'])) {
                        $exclude = ['31'];
                    }

                    if(in_array($col, $exclude)){
                        continue;
                    }

                    $total[] = $col;
                @endphp
            @else
                @php
                    $total[] = $col;
                @endphp
            @endif
                <th >{{@$col}}</th>
            @endforeach
          <th>Total</th>
        </tr>
    </thead>
    <tbody id="{{@$tbody_id}}">
        {{-- @dd($data, $total) --}}
        @foreach (isset($procedures)?$procedures:[] as $proc)
        @php
            $proc = (object) $proc;
            $sum  = 0;
            $total_sum = 0;
            $proc_name = isset($proc->name) ? $proc->name : '';
            if(!isset($proc_name)){
                continue;
            }
            $total_procedure[] = $proc_name;
        @endphp
        <tr>
            <td>{{@$proc_name}}</td>
            @for ($i = 0; $i < count($total); $i++)
                @php
                    $case_num = isset($data[$this_year][$total[$i]][$proc_name]) ? $data[$this_year][$total[$i]][$proc_name] : 0;
                    $sum      += $case_num;
                @endphp
                <td>{{@$case_num}}</td>
            @endfor
            <td>{{@$sum}}</td>
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
                    if(is_array($data[$this_year][$total[$j]])){
                        $total_cases = array_sum($data[$this_year][$total[$j]]);
                        $total_cases_all[] = $total_cases;
                    }
                    $total_sum += $total_cases;
                @endphp
                <td>{{@$total_cases}}</td>
            @endfor
            <td>{{@$total_sum}}</td>
        </tr>
    </tbody>
</table>


<div id="graph_div">
  <div class="row">
    @php
        $date_type = ($have_month) ? 'Month' : 'Year';
    @endphp
    <div class="col-lg-6">
      @php
          
      @endphp
      {{-- <div class="card-header">
          <span class="text-header-chart">Total cases in {{@$date_type}}</span>
      </div> --}}
      <div class="card-body p-0 mt-4">
          <div id="line_case" data-colors='["--vz-primary", "--vz-success", "--vz-warning", "--vz-danger"]' class="apex-charts" dir="ltr"></div>
      </div>
    </div>
    <div class="col-lg-6">
        {{-- <div class="card-header">
            <span class="text-header-chart">Total procedures in {{@$date_type}}</span>
        </div> --}}
        <div class="card-body p-0 mt-4">
            <div id="column_proc" data-colors='["--vz-primary", "--vz-success", "--vz-warning", "--vz-danger"]' class="apex-charts" dir="ltr"></div>
        </div>
    </div>
  </div>
</div>

<script>
  var cases_y = <?php echo json_encode($total_cases_all); ?>;
  var cases_x = <?php echo json_encode($total); ?>;

  var options = {
          series: [{
            name: "Total cases",
            data: cases_y
        }],
          chart: {
          height: 350,
          type: 'line',
          zoom: {
            enabled: false
          }
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'straight'
        },
        title: {
          text: 'Total cases in {{@$date_type}}',
          align: 'left'
        },
        // grid: {
        //   row: {
        //     colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
        //     opacity: 0.5
        //   },
        // },
        xaxis: {
          categories: cases_x,
          tickAmount: 4,
        },
        tooltip: {
                  y: {
                    formatter: function (val) {
                      return parseInt(val)
                    }
                  }
                }
        };

        var chart = new ApexCharts(document.querySelector("#line_case"), options);
        chart.render();

</script>

<script>
  var procedure_y = <?php echo json_encode($total_procedure_all); ?>;
  var procedure_x = <?php echo json_encode($total_procedure); ?>;

  var options = {
          series: [{
                    name: 'Total procedure',
                    data: procedure_y
                  },],
          chart: {
                    type: 'bar',
                    height: 350
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
                  categories: procedure_x,
                },
          yaxis: {
                  // title: {
                  //   text: '$ (thousands)'
                  // }
                },
          fill: {
                  opacity: 1
                },
                title: {
                  text: 'Total procedures in {{@$date_type}}',
                  align: 'left'
                },
          tooltip: {
                  y: {
                    formatter: function (val) {
                      return parseInt(val)
                    }
                  }
                }
        };

        var chart = new ApexCharts(document.querySelector("#column_proc"), options);
        chart.render();

</script> 

