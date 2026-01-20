

<div class="offcanvas offcanvas-end w-100 bg-darkness " tabindex="-1" id="FullDianosis"
    aria-labelledby="offcanvasRightLabel" style="height: 100vh;">
    <div class="offcanvas-header " style="border-bottom: 1px solid #ffffff3d;">
        <h3 id="offcanvasRightLabel" class="text-white">
            &ensp;
            Diagnosis
        </h3>
        <button type="button" class="btn text-white" data-bs-dismiss="offcanvas" aria-label="Close">X</button>

    </div>
    @php
      $date_from = isset($filter['date_from']) ? $filter['date_from'] : null;
      $date_to   = isset($filter['date_to'])   ? $filter['date_to'] : null;
      $physician = isset($filter['physician']) ? $filter['physician'] : null;
      $procedure = isset($filter['procedure']) ? $filter['procedure'] : null;

      $text = '';
      foreach (isset($filter)?$filter:[] as $key => $value) {
          if(isset($filter[$key])){
              $text = $text."$key=$value&";
          }
      }
    @endphp
    <div class="offcanvas-body">
      @php
        $diagnosis_arr = isset($diagnosis_data) ? $diagnosis_data : [];
        foreach ($diagnosis_arr as $key => $value) {
            if($value == 0){
                unset($diagnosis_arr[$key]);
            }
        }
      @endphp
        <div class="row m-0 p-0 ">
            <div class="col-lg-12 p-0">
                <div class="card m-0 card-ipad">

                        <div class="row p-0 m-0">
                            <div class="col-4"></div>
                            <div class="col-4 text-center">
                                <span class="text-header-fullchart">Diagnosis </span>
                            </div>
                            <div class="col-4">

                            </div>
                        </div>

                    <div class="card-body p-0 ">
                        <div id="bar_diagnosis_all" data-colors='["--vz-success"]' class="apex-charts" dir="ltr"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>

  var total = @json($diagnosis_arr);
  var key = Object.keys(total)
  var value = Object.values(total)
  var options = {
        series: [{
          name: 'จำนวน',
          data: value
        }],
        chart: {
        type: 'bar',
        height: 1000,
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

  var chart = new ApexCharts(document.querySelector("#bar_diagnosis_all"), options);
  chart.render();
</script>
