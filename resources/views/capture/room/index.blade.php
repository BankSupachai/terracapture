{{-- @extends('layouts.layouts_index.main') --}}
@extends('capture.layoutv6')
@section('style')

@endsection

<script src="{{ url('assets/libs/cleave.js/cleave.min.js') }}"></script>
<script src="{{ url('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ url('assets/js/pages/form-masks.init.js') }}"></script>
<script src="{{ url('assets/libs/chart.js/chart.min.js') }}"></script>
<script src="{{ url('assets/js/pages/chartjs.init.js') }}"></script>
<script src="{{ url('assets/js/pages/apexcharts-pie.init.js') }}"></script>
<script src="{{ url('assets/js/pages/apexcharts-bar.init.js') }}"></script>
<script src="{{ url('assets/js/pages/apexcharts-column.init.js') }}"></script>
<script src="{{ url('assets/js/pages/apexcharts-radialbar.init.js') }}"></script>

@section('content')
<form action="{{url('procedure')}}" method="post">
    @method('GET')
    <input type="hidden" name="generate" value="1" >
    <div class="row">
        <div class="col-2" hidden>
            <select class="form-select" name="day" id="">
                @foreach (isset($days)?$days:[] as $day)
                    <option value="{{strtolower($day)}}" @selected(@$graph_day."" == @strtolower($day)."")>{{@$day}}.</option>
                @endforeach
            </select>
        </div>
        <div class="col-2">
            <select class="form-select" name="room" id="">
                @foreach (isset($rooms)?$rooms:[] as $room)
                    <option value="{{$room->room_name}}" @selected(@$graph_room."" == @$room->room_name."")>{{@$room->room_name}}.</option>
                @endforeach
            </select>
        </div>
        <div class="col-2">
            <div >
                @php
                    $start_date = isset($graph_start) ? $graph_start : $before;
                @endphp
                <input type="date" class="form-control start-date" name="start_date"value="{{$start_date}}">
            </div>
        </div>
        <div class="col-2">
            <div >
                @php
                    $end_date = isset($graph_end) ? $graph_end : $now;
                @endphp
                <input type="date" class="form-control end-date" name="end_date" value="{{$end_date}}">
            </div>
        </div>
        <div class="col-auto m-0 p-0">
            <button type="submit" class="btn btn-primary">Generate Graph</button>
        </div>
        <div class="col-auto">
            <button type="button" class="btn btn-primary add-days">+7 days</button>
        </div>
        <div class="col-auto">
          <button type="button" class="btn btn-primary remove-days">-7 days</button>
      </div>
        <div class="col-auto">
            <a class="btn btn-warning " href="{{url('procedure')}}">Clear</a>
        </div>

    </div>
</form>

<div class="row m-3">
    <div id="column_age" data-colors='["--vz-primary", "--vz-success", "--vz-warning", "--vz-danger"]' class="apex-charts" dir="ltr"></div>
</div>


<div class="row m-3">
  <div id="bar_line" data-colors='["--vz-primary", "--vz-success", "--vz-warning", "--vz-danger"]' class="apex-charts" dir="ltr"></div>
</div>






@endsection
@section('script')
<script src="{{asset('public/js/moment.min.js')}}"></script>
<script>
    const hours = @json($hours);
    const countcase = @json($count_case);
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
         colors:['#05445E', '#189AB4', '#75E6DA', '#21B6A8', '#A3EBB1', '#18A558'],
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
       colors: ['#05445E', '#189AB4', '#75E6DA', '#21B6A8', '#A3EBB1', '#18A558'],
       };

       var chart = new ApexCharts(document.querySelector("#column_age"), options);
       chart.render();
</script>

<script>
          var options = {
          series: [{
          name: 'Website Blog',
          type: 'column',
          data: [440, 505, 414, 671, 227, 413, 201, 352, 752, 320, 257, 160]
        }, {
          name: 'Social Media',
          type: 'line',
          data: [23, 42, 35, 27, 43, 22, 17, 31, 22, 22, 12, 16]
        }],
          chart: {
          height: 350,
          type: 'line',
        },
        stroke: {
          width: [0, 4]
        },
        title: {
          text: 'Traffic Sources'
        },
        dataLabels: {
          enabled: true,
          enabledOnSeries: [1]
        },
        labels: ['01 Jan 2001', '02 Jan 2001', '03 Jan 2001', '04 Jan 2001', '05 Jan 2001', '06 Jan 2001', '07 Jan 2001', '08 Jan 2001', '09 Jan 2001', '10 Jan 2001', '11 Jan 2001', '12 Jan 2001'],
        xaxis: {
          type: 'datetime'
        },
        yaxis: [{
          title: {
            text: 'Website Blog',
          },

        }, {
          opposite: true,
          title: {
            text: 'Social Media'
          }
        }]
        };

        var chart = new ApexCharts(document.querySelector("#bar_line"), options);
        chart.render();

</script>

<script>
    $('.add-days').on('click', () => {
        let newstartdate = moment($('.start-date').val()).add(7, 'days').format('YYYY-MM-DD');
        let newenddate = moment($('.end-date').val()).add(7, 'days').format('YYYY-MM-DD');
        $('.start-date').val(newstartdate)
        $('.end-date').val(newenddate)
    })

    $('.remove-days').on('click', () => {
        let newstartdate = moment($('.start-date').val()).subtract(7, 'days').format('YYYY-MM-DD');
        let newenddate = moment($('.end-date').val()).subtract(7, 'days').format('YYYY-MM-DD');
        $('.start-date').val(newstartdate)
        $('.end-date').val(newenddate)
    })
</script>




@endsection
