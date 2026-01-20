<div class="col-6"  id="rapid_div">
    <div class="card card-ipad h-left mt-2">
        <div class="border-bottom-solid  p-4" style="background: #222529;">
          @php
              $rapid_arr = isset($rapid) ? $rapid : [];
              // dd($rapid_arr);
          @endphp
            <span class="text-header-chart-ipad h3">Rapid Urease Test</span>
        </div>
        <div class="card-body p-0 mt-2">
            <div id="bar_rapid" data-colors='["--vz-success"]' class="apex-charts" dir="ltr"></div>
        </div>
    </div>
</div>

<script>
  var rapid     = @json($rapid_arr);
  var key       = Object.keys(rapid);
  var value     = Object.values(rapid);

  for (let i = 0; i < key.length; i++) {
    if(key[i].length > 20){
      key[i] = 'Pending'
    }
  }

  var options = {
        series: value,
        chart: {
          width: 250,
          type: 'pie',
          height: 200,
        },
        legend: {
              position: 'bottom',
              height: 50
            },
        dataLabels: {
          enabled: true,
          formatter: function (val) {
              return parseInt(val) + "%"
            }
        },
        labels: key,
        colors: ['#245788', '#F06548', '#2B2F34', '#F36349'],
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            legend: {
              position: 'bottom',
              height: 50
            }
          }
        }]
      };
      var chart = new ApexCharts(document.querySelector("#bar_rapid"), options);
      chart.render();

    let text = $('#bar_rapid').find('.apexcharts-legend-text')
    console.log(text);
</script>
