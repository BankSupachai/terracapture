<div class="col-6"  id="intervention_div">
    <div class="card card-ipad h-left mt-2">
        <div class="border-bottom-solid  p-3 d-flex justify-content-between" style="background: #222529;">
            <span class="text-header-chart-ipad  h3">Intervention</span>
            <button class="btn btn-soft-darkness" data-bs-toggle="offcanvas" data-bs-target="#Fullintervention" aria-controls="offcanvasRight">Show all</button>
        </div>
        @php
          $intervention_arr = [];
          $index         = 0;
          foreach (isset($intervention)?$intervention:[] as $key => $count) {
            if($count == 0 || !is_numeric($count) || $index >= 6){
              continue;
            }
            $intervention_arr[$key] = $count;
            $index += 1;
          }
        @endphp
        <div class="card-body p-0">
            <div id="bar_intervention" data-colors='["--vz-success"]' class="apex-charts" dir="ltr"></div>
        </div>
    </div>
</div>

<script>
  var icd9 = @json($intervention_arr) 
  var key = Object.keys(icd9)
  var value = Object.values(icd9)
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
          colors:['#0ab39c'],
      },
      xaxis: {
        categories: key,
        min:0,
        tickAmount: 1,
      },
      
      };

      var chart = new ApexCharts(document.querySelector("#bar_intervention"), options);
      chart.render();


</script>
