<div class="col-lg-4 mt-2">
    <div class="card h-charts ">
        <div class="card-header d-flex justify-content-between">
            <span class="text-header-chart">Treatment Coverage</span>
            <button onclick="to_url('treatment')" class="btn btn-light">Show all</button>
        </div>
        <div class="card-body p-0 mt-4">
            <div id="bar_treatment" data-colors='["--vz-success"]' class="apex-charts" dir="ltr"></div>
        </div>
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


<script>
  var total = @json($treatment_arr);
  var key = Object.keys(total)
  var value = Object.values(total)
  // console.log(total, key, value);
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
             return parseInt(val) + " คน"
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

{{-- <script>
    var options = {
          series: [{
          data: [
            @foreach ($physician as $key => $val)
                {{ $val }},
            @endforeach
          ]
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
        fill: {
            colors:['#245788'],
        },
        xaxis: {
          categories: [
            @foreach ($physician as $key => $val)
                '{{ $key }}',
            @endforeach

          ],
          labels: {formatter: function (value) {return Math.floor(value);}}
        }
        };

        var chart = new ApexCharts(document.querySelector("#bar_Physician"), options);
        chart.render();
</script> --}}
