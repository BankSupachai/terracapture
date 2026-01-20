<div class="col-lg-4 mt-2">
    <div class="card h-charts ">
        @php
          $physician_arr = [];
          $index         = 0;
          foreach (isset($physician)?$physician:[] as $key => $count) {
            if($count == 0 || !is_numeric($count) || $index >= 6){
              continue;
            }
            $physician_arr[$key] = $count;
            $index += 1;
          }
        @endphp
        <div class="card-header d-flex justify-content-between">
            <span class="text-header-chart">Physician</span>
            <button onclick="to_url('physician')" class="btn btn-light">Show all</button>
        </div>
        <div class="card-body p-0 mt-4">
            <div id="bar_physician" data-colors='["--vz-success"]' class="apex-charts" dir="ltr"></div>
        </div>
    </div>
</div>


<script>
    var physician = @json($physician_arr);
    var key       = Object.keys(physician);
    var value     = Object.values(physician);
    var options = {
          series: [{
            name: 'จำนวน',
            data: value
          }],
          chart: {
            type: 'bar',
            height: 190,
            width: '80%',
          },
          plotOptions: {
            bar: {
              borderRadius: 4,
              horizontal: true,
            }
          },
          dataLabels: {
            enabled: false
          },
          tooltip: {
            y: {
              formatter: function (val) {
                return val + " เคส"
              }
            }
          },
        fill: {
            colors:['#245788'],
        },
        xaxis: {
          categories: key,
          min:0,
          tickAmount: 1,
        },
        };

        var chart = new ApexCharts(document.querySelector("#bar_physician"), options);
        chart.render();


</script>


