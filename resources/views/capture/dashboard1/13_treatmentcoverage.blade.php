<div class="col-4 ">
    <div class="card h-charts">
        <div class="card-header">
            <span class="text-header-chart" style="font-weight: bold;">Treatment Coverage</span>
        </div>

        <div class="card-body p-0 mt-4" style="margin-bottom: 25px;">
            <div id="bar_TreatmentCoverage" data-colors='["--vz-success"]' class="apex-charts" dir="ltr"></div>
        </div>

    </div>
</div>
<script>
    var options = {
          series: [{
          data: [
            @foreach ($treatment as $key => $val)
                {{ $val }},
            @endforeach
          ]
        }],
          chart: {
          type: 'bar',
          height: 190,
          width: '90%'
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
            @foreach ($treatment as $key => $val)
                '{{ $key }}',
            @endforeach
          ],
        }
        };

        var chart = new ApexCharts(document.querySelector("#bar_TreatmentCoverage"), options);
        chart.render();

</script>
