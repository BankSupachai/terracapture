<div class="col-6"  id="diagnosis_div">
    <div class="card card-ipad  h-left mt-2">
      @php
        $diagnostic_arr = [];
        $index         = 0;
        foreach (isset($diagnosis)?$diagnosis:[] as $key => $count) {
          if($count == 0 || !is_numeric($count) || $index >= 6){
            continue;
          }
          $diagnostic_arr[$key] = $count;
          $index += 1;
        }
      @endphp
        <div class="border-bottom-solid d-flex justify-content-between  p-3" style="background: #222529;">
            <span class="text-header-chart-ipad  h3">Diagnosis</span>
            <button class="btn btn-soft-darkness" data-bs-toggle="offcanvas" data-bs-target="#FullDianosis" aria-controls="offcanvasRight">Show all</button>
        </div>
        <div class="card-body p-0 ">
            <div id="bar_diagnosis" data-colors='["--vz-success"]' class="apex-charts" dir="ltr"></div>
        </div>
    </div>
</div>

<script>
  var icd10 = @json($diagnostic_arr) 
  var key = Object.keys(icd10)
  var value = Object.values(icd10)
  // console.log(icd10, key, value);
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
          colors:['#245788'],
      },
      xaxis: {
        categories: key,
        min:0,
        tickAmount: 1,
      },
      };

      var chart = new ApexCharts(document.querySelector("#bar_diagnosis"), options);
      chart.render();


</script>
