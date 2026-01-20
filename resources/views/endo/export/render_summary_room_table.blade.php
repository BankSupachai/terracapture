<p>Period : @if(isset($this_month))<span>{{@$this_month}}/</span> @endif <span>{{@$this_year.""}}</span></p>
<p>Summary Form: <span>{{@$this_type}}</span></p>
<p>Calculated from: Time Stamp(Patient in) - Time Stamp(Patient out)</p>
@php
    $total = [];
    $total_cases_all = [];
    $total_procedure = [];
    $total_procedure_all = [];
    $text_head = $have_month ? 'Date' : 'Month';
@endphp
<table class="table table-nowrap align-middle" id="{{@$tbody_id}}_div" style="width: 80%">
    <thead class="table-light">
        <tr>
            <th >Room/{{@$text_head}}</th>
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
        @foreach (isset($rooms)?$rooms:[] as $room)
        @php
            $sum  = 0;
            $total_sum = 0;
            $room_name = isset($room) ? $room : '';
            if(!isset($room_name)){
                continue;
            }
            $total_procedure[] = $room_name;
        @endphp
        <tr>
            <td>{{@$room_name}}</td>
            @for ($i = 0; $i < count($total); $i++)
                @php
                    $case_num = isset($data[$this_year][$total[$i]][$room_name]) ? $data[$this_year][$total[$i]][$room_name] : 0;
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
      <div class="card-body p-0 mt-4">
          <div id="line_case" data-colors='["--vz-primary", "--vz-success", "--vz-warning", "--vz-danger"]' class="apex-charts" dir="ltr"></div>
      </div>
    </div>
    <div class="col-lg-6">
        <div class="card-body p-0 mt-4">
            <div id="column_proc" data-colors='["--vz-primary", "--vz-success", "--vz-warning", "--vz-danger"]' class="apex-charts" dir="ltr"></div>
        </div>
    </div>
    <div class="row m-3">
        <div id="column_age" data-colors='["--vz-primary", "--vz-success", "--vz-warning", "--vz-danger"]' class="apex-charts" dir="ltr"></div>
    </div>
    <div class="row m-3">
      <div id="bar_line" data-colors='["--vz-primary", "--vz-success", "--vz-warning", "--vz-danger"]' class="apex-charts" dir="ltr"></div>
    </div>
  </div>
</div>


<script src="{{asset('public/js/moment.min.js')}}"></script>
<script>
     var cases_y = @json($total_cases_all);
        var cases_x = @json($total);
        console.log(cases_y);

        var options = {
          series: [{
            name: "Total cases",
            data: cases_y,

        }],
          chart: {
          height: 300,
          type: 'line',
          zoom: {
            enabled: false
          },
          animations: {
            enabled:false,
          },
        },
        dataLabels: {
          enabled: false
        },
        colors: ['#245788'],
        stroke: {
          curve: 'smooth'
        },
        title: {
          text: 'Total Cases in {{@$date_type}}',
          align: 'left',
          margin: 5,
          style: {
            fontSize:  '12px',
            fontWeight:  'normal',
            fontFamily:  'kanit',
            color:  '#808080'
          },
        xaxis: {
          categories: cases_x,
          tickAmount: 4,
        },
        yaxis: {
          labels: {
            formatter: (val) => { return parseFloat(val).toFixed(0);console.log(parseFloat(val).toFixed(0)); },
          }
        },
        tooltip: {
                  y: {
                    formatter: function (val) {
                      return parseFloat(val).toFixed(1)
                    }
                  }
                }
        }
      }

        var chart = new ApexCharts(document.querySelector("#line_case"), options);
        chart.render().then(() => finishRendering());
	</script>

<script>
    var procedure_y = @json($total_procedure_all);
    var procedure_x = @json($total_procedure);
    var options = {
            series: [{
                      name: 'Total hour',
                      data: procedure_y
                    },],
            chart: {
                      type: 'bar',
                      height: 300,
                      animations: {
        enabled:false,
      },
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
                  colors: ["#245788"],
            stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                  },
            xaxis: {
                    categories: procedure_x,
                  },
            yaxis: {
              labels: {
                formatter: (val) => { return parseFloat(val).toFixed(0) },
              }
            },
            fill: {
                    opacity: 1
                  },
                  title: {
                    text: 'Room usage (hours) in {{@$date_type}}',
                    align: 'left',
                    margin: 5,
                    style: {
                      fontSize:  '12px',
                      fontWeight:  'normal',
                      fontFamily:  'kanit',
                      color:  '#808080'
                    },
                  },
            tooltip: {
                    y: {
                      formatter: function (val) {
                        return parseFloat(val).toFixed(1)
                      }
                    }
                  },
          };

          var chart = new ApexCharts(document.querySelector("#column_proc"), options);
          chart.render().then(() => finishRendering());
  </script>
<script>
    var hours = @json($hours);
    var countcase = @json($count_case);
    var options = {
      series: [{
          name: 'Mon.',
          data: countcase['mon']
        }, {
          name: 'Tue.',
          data: countcase['tue']
        }, {
          name: 'Wed.',
          data: countcase['wed']
        }, {
          name: 'Thus.',
          data: countcase['thu']
        } , {
          name: 'Fri.',
          data: countcase['fri']
        }, {
          name: 'Sat.',
          data: countcase['sat']
        } , {
          name: 'Sun.',
          data: countcase['sun']
        }],
        chart: {
         type: 'bar',
         stacked: true,
         height: 300,
         width: '100%',
         animations: {
        enabled:false,
      },
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
         categories: hours,
       },
       yaxis: {
         title: {
           text: ''

         },
         labels: {formatter: function (value) {return Math.floor(value);}}
       },
       fill: {
         opacity: 1,
         colors:['#F7B84B', '#FF7F9F', '#0AB39C', '#F06548', '#299CDB', '#245788', '#212529'],
       },
       tooltip: {
         y: {
           formatter: function (val) {
             return val + " เคส"
           }
         }
       },
       legend: {
           show: true,
           position: 'right',
           horizontalAlign: 'center',
       },
      //  colors: ['#05445E', '#189AB4', '#75E6DA', '#21B6A8', '#A3EBB1', '#18A558'],
       colors:['#F7B84B', '#FF7F9F', '#0AB39C', '#F06548', '#299CDB', '#245788', '#212529'],
       title: {
            text: 'Room usage (Period) in Month',
            align: 'left',
            margin: 5,
            style: {
              fontSize:  '12px',
              fontWeight:  'normal',
              fontFamily:  'kanit',
              color:  '#808080'
            },
        },
       };

       var chart = new ApexCharts(document.querySelector("#column_age"), options);
       chart.render().then(() => finishRendering());
  </script>
     @php
     $casetime_array = $casetime ?? [];
     $count_timecase     = $casetime['case'] ?? [];
     $count_time     = $casetime['time'] ?? [];


     if(count($this_col) == 12){
       $this_col = array_map(function($this_col) {
           $date = DateTime::createFromFormat('m', $this_col);
           return $date->format('M');
       }, $this_col);
     }
 @endphp
   <script>
    var times = @json($this_col);
    var count_case = @json($count_timecase);
    var count_time = @json($count_time);

        var options = {
        series: [{
        name: 'Room usage (Minutes/ cases)',
        type: 'column',
        data: count_time,
      }, {
        name: 'Cases',
        type: 'line',
        data: count_case,
      }],
        chart: {
        height: 300,
        type: 'line',
        animations: {
      enabled:false,
    },
      },
      stroke: {
        width: [0, 4]
      },
      title: {
        text: 'Room usage (Minutes/ cases) in year/month'
      },
      dataLabels: {
        enabled: true,
        enabledOnSeries: [1]
      },
      labels: times,
      xaxis: {
        // type: 'datetime',
      },
      yaxis: [{
        title: {
          text: 'Usage time (min)',
          align: 'left',
          margin: 5,
          style: {
            fontSize:  '12px',
            fontWeight:  'normal',
            fontFamily:  undefined,
            color:  '#ADB5BD'
          },
        },
        labels: {formatter: function (value) {return Math.floor(value);}}

      }, {
        opposite: true,
        title: {
          text: 'Cases',
          align: 'left',
          margin: 5,
          style: {
            fontSize:  '12px',
            fontWeight:  'normal',
            fontFamily:  undefined,
            color:  '#ADB5BD'
          },
        },
        labels: {formatter: function (value) {return Math.floor(value);}}
      }],
      legend: {
         show: true,
         position: 'bottom',
         horizontalAlign: 'center',
     },
     colors:['#245788', '#0AB39C'],
     title: {
          text: 'Total Room usage (Hours) in Month',
          align: 'left',
          margin: 5,
          style: {
            fontSize:  '12px',
            fontWeight:  'normal',
            fontFamily:  undefined,
            color:  '#ADB5BD'
          },
      },
      };

      var chart = new ApexCharts(document.querySelector("#bar_line"), options);
      chart.render().then(() => finishRendering());

</script>

{{-- <script>
  var cases_y = @json($total_cases_all);
  var cases_x = @json($total);
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
        colors: ['#245788'],
        stroke: {
          curve: 'straight'
        },
        title: {
          text: 'Total Cases in {{@$date_type}}',
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
        yaxis: {
          labels: {
            formatter: (val) => { return parseFloat(val).toFixed(0) },
          }
        },
        tooltip: {
                  y: {
                    formatter: function (val) {
                      return parseFloat(val).toFixed(1)
                    }
                  }
                }
        };

        var chart = new ApexCharts(document.querySelector("#line_case"), options);
        chart.render();

</script>

<script>
  var procedure_y = @json($total_procedure_all);
  var procedure_x = @json($total_procedure);
  var options = {
          series: [{
                    name: 'Total hour',
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
                colors: ['#245788'],
          stroke: {
                  show: true,
                  width: 2,
                  colors: ['transparent']
                },
          xaxis: {
                  categories: procedure_x,
                },
          yaxis: {
            labels: {
              formatter: (val) => { return parseFloat(val).toFixed(0) },
            }
          },
          fill: {
                  opacity: 1
                },
                title: {
                  text: 'Room usage (hours) in {{@$date_type}}',
                  align: 'left'
                },
          tooltip: {
                  y: {
                    formatter: function (val) {
                      return parseFloat(val).toFixed(1)
                    }
                  }
                }
        };

        var chart = new ApexCharts(document.querySelector("#column_proc"), options);
        chart.render();
</script>

<script>
  var hours = @json($hours);
  var countcase = @json($count_case);
  var options = {
    //    series: [{
    //    name: 'จำนวน',
    //    data: countcase
    //  }],
    series: [{
        name: 'Mon.',
        data: countcase['mon']
      }, {
        name: 'Tue.',
        data: countcase['tue']
      }, {
        name: 'Wed.',
        data: countcase['wed']
      }, {
        name: 'Thus.',
        data: countcase['thu']
      } , {
        name: 'Fri.',
        data: countcase['fri']
      }, {
        name: 'Sat.',
        data: countcase['sat']
      } , {
        name: 'Sun.',
        data: countcase['sun']
      }],
      chart: {
       type: 'bar',
       stacked: true,
       height: 500,
       width: '80%',
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
       categories: hours,
     },
     yaxis: {
       title: {
         text: ''

       },
       labels: {formatter: function (value) {return Math.floor(value);}}
     },
     fill: {
       opacity: 1,
       colors:['#F7B84B', '#FF7F9F', '#0AB39C', '#F06548', '#299CDB', '#245788', '#212529'],
     },
     tooltip: {
       y: {
         formatter: function (val) {
           return val + " เคส"
         }
       }
     },
     legend: {
         show: true,
         position: 'right',
         horizontalAlign: 'center',
     },
     colors:['#F7B84B', '#FF7F9F', '#0AB39C', '#F06548', '#299CDB', '#245788', '#212529'],
     };

     var chart = new ApexCharts(document.querySelector("#column_age"), options);
     chart.render();
</script>

@php
    $casetime_array = $casetime ?? [];
    $count_timecase     = $casetime['case'] ?? [];
    $count_time     = $casetime['time'] ?? [];


    if(count($this_col) == 12){
      $this_col = array_map(function($this_col) {
          $date = DateTime::createFromFormat('m', $this_col);
          return $date->format('M');
      }, $this_col);
    }
@endphp

<script>
    var times = @json($this_col);
    var count_case = @json($count_timecase);
    var count_time = @json($count_time);

        var options = {
        series: [{
        name: 'Room usage (Minutes/ cases)',
        type: 'column',
        data: count_time,
      }, {
        name: 'Cases',
        type: 'line',
        data: count_case,
      }],
        chart: {
        height: 350,
        type: 'line',
      },
      stroke: {
        width: [0, 4]
      },
      title: {
        text: 'Room usage (Minutes/ cases) in year/month'
      },
      dataLabels: {
        enabled: true,
        enabledOnSeries: [1]
      },
      labels: times,
      xaxis: {
        // type: 'datetime',
      },
      yaxis: [{
        title: {
          text: 'Room usage (Minutes)',
        },
        labels: {formatter: function (value) {return Math.floor(value);}}

      }, {
        opposite: true,
        title: {
          text: 'Cases'
        },
        labels: {formatter: function (value) {return Math.floor(value);}}
      }],
      legend: {
         show: true,
         position: 'bottom',
         horizontalAlign: 'center',
     },
      };

      var chart = new ApexCharts(document.querySelector("#bar_line"), options);
      chart.render();

</script>
 --}}
