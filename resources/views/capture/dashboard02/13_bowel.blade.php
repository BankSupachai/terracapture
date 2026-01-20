<div class="col-lg-4">
    <div class="card h-charts mt-2">
      @php
          $bowel_arr = isset($bowel) ? $bowel : [];
      @endphp
        <div class="card-header">
            <span class="text-header-chart">Bowel Preparation</span>
        </div>

        <div class="card-body p-0 mt-4">
            <div id="bar_bowel" data-colors='["--vz-primary", "--vz-success", "--vz-warning", "--vz-danger", "--vz-info"]' class="apex-charts" dir="ltr"></div>
        </div><!-- end card-body -->
    </div>
</div>

{{--
$bowel['Excellent']
$bowel['Good']
$bowel['Fair']
$bowel['Poor']
--}}

{{-- @dd($bowel) --}}


<script>
    var bowel     = @json($bowel_arr);
    var key       = Object.keys(bowel);
    var value     = Object.values(bowel);
    // console.log('bowel', bowel, key, value, key.length);
    var text_arr  = [];
    for (let i = 0; i < key.length; i++) {
      let text = `${key[i]} ${value[i]}`
      // let text = `${key[i]}    ${value[i]} คน`
      text_arr.push(text)
    }

    console.log(text_arr);
    var options = {
          series: value,
          chart: {
          type: 'donut',
          height: 200,
        },
        labels: text_arr,
        dataLabels: {
            enabled: true,
            formatter: function (val) {
                return parseInt(val) + "%"
              }
          },
        legend: {
            show: true,
            offsetX: 10,
            horizontalAlign: 'center',
            itemMargin: {
                vertical: 10
            },
            fontSize: '60px',
        },
        colors:['#245788', '#08AF9D', '#F0BB5D', '#F36349'],
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },

            legend: {
              position: 'bottom'
            }
          }
        }]
        };

        var chart = new ApexCharts(document.querySelector("#bar_bowel"), options);
        chart.render();
</script>


{{-- <script>
    var options = {
          series: [{{$bowel['Excellent']}}, {{$bowel['Good']}}, {{$bowel['Fair']}}, {{$bowel['Poor']}}],
          chart: {
          type: 'donut',
          height: 190,
        },
        labels: [
            'Excellent     {{$bowel['Excellent']}} คน',
            'Good          {{$bowel['Good']}} คน',
            'Fair          {{$bowel['Fair']}} คน',
            'Poor          {{$bowel['Poor']}} คน'],
        colors:['#245788', '#08AF9D', '#F0BB5D', '#F36349'],
        legend: {
            show: true,
            offsetX: 10,

            horizontalAlign: 'center',
            itemMargin: {
                vertical: 10
            },
            fontSize: '60px',

        },
        dataLabels: {
            enabled: false,
        },
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            fill: {
                // colors:['#245788', '#245788' ,'#245788', '#245788'],
            },
            legend: {
              position: 'bottom',
              showForSingleSeries: true,
            }
          }
        }]
        };

        var chart = new ApexCharts(document.querySelector("#bar_bowel"), options);
        chart.render();

</script> --}}
