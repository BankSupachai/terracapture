<div class="col-lg-4 mt-2">
    <div class="card h-charts ">
        @php
          $complication_arr = [];
          $index         = 0;
          foreach (isset($complication)?$complication:[] as $key => $count) {
            if($count == 0 || !is_numeric($count) || $index >= 6){
              continue;
            }
            $complication_arr[$key] = $count;
            $index += 1;
          }
        @endphp
        <div class="card-header d-flex justify-content-between">
            <span class="text-header-chart">Complication</span>
            <button onclick="to_url('complication')" class="btn btn-light">Show all</button>
        </div>
        <div class="card-body p-0 mt-4">
            <div id="bar_complication" data-colors='["--vz-success"]' class="apex-charts" dir="ltr"></div>
        </div>
    </div>
</div>


<script>
      var complication = @json($complication_arr);
      var key = Object.keys(complication);
      var value = Object.values(complication);
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
             return val + " คน"
           }
         }
       },
        fill: {
            colors:['#F06548'],
        },
        xaxis: {
          // categories: ['Rectal Polyp.', 'CA Colon', 'Colonic Polyp', 'Polyp of colon',  'Normal'],
          categories: key,
        }
        };

        var chart = new ApexCharts(document.querySelector("#bar_complication"), options);
        chart.render();


</script>

