<div class="col-lg-4">
    <div class="card h-charts mt-2">
      @php
          $gastric_arr = isset($gastric) ? $gastric : [];
      @endphp
        <div class="card-header">
            <span class="text-header-chart">Gastric Content</span>
        </div>

        <div class="card-body p-0 mt-4">
            <div id="bar_gastric" data-colors='["--vz-primary", "--vz-success", "--vz-warning", "--vz-danger", "--vz-info"]' class="apex-charts" dir="ltr"></div>
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
    var gastric     = @json($gastric_arr);
    var key       = Object.keys(gastric);
    var value     = Object.values(gastric);
    console.log(gastric, key, value);
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
          colors: ['#245788', '#08AF9D', '#F0BB5D', '#F36349'],
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
        var chart = new ApexCharts(document.querySelector("#bar_gastric"), options);
        chart.render();

      let text = $('#bar_gratric').find('.apexcharts-legend-text')
      console.log(text);
</script>



