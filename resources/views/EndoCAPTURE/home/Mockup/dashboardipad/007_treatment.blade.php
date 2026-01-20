<div class="col-6"  id="treatment_div">
    <div class="card card-ipad h-left mt-2">
        <div class="border-bottom-solid d-flex justify-content-between  p-3" style="background: #222529;">
            <span class="text-header-chart-ipad  h3">Treatment Coverage</span>
            <button class="btn btn-soft-darkness" data-bs-toggle="offcanvas" data-bs-target="#FullTreatment" aria-controls="offcanvasRight">Show all</button>
        </div>
        <div class="card-body p-0">
            <div id="bar_treatment" data-colors='["--vz-success"]' class="apex-charts" dir="ltr"></div>
        </div>
        @php
          $treatment_arr = [];
          $j = 0;
            foreach (isset($tb_treatment)?$tb_treatment:[] as $key=>$t) {
              if($j > 6){
                continue;
              }
              
              $t = (object) $t;
              if(!isset($t->name)){
                continue;
              }

              $count = 0;
              if(isset($treatment_coverage[$t->name])){
                $count = $treatment_coverage[$t->name];
              }

              $treatment_arr[$t->name] = $count;
              $j++;
            } 
      @endphp
    </div>
</div>

<script>
  var total = @json($treatment_arr);
  var key = Object.keys(total)
  var value = Object.values(total)
  console.log(total, key, value);
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

        var chart = new ApexCharts(document.querySelector("#bar_treatment"), options);
        chart.render();


</script>
