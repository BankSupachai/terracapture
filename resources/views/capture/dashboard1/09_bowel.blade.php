<div class="col-4">
    <div class="card h-charts mt-2">
        <div class="card-header">
            <span class="text-header-chart">Bowel Preparation</span>
        </div>

        <div class="card-body p-0 mt-4">
            <div id="bar_bowel" data-colors='["--vz-primary", "--vz-success", "--vz-warning", "--vz-danger", "--vz-info"]' class="apex-charts" dir="ltr"></div>
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
    var options = {
          series: [{{$bowel['Excellent']}}, {{$bowel['Good']}}, {{$bowel['Fair']}}, {{$bowel['Poor']}}],
          chart: {
          type: 'donut',
          height: 190,
        },
        labels: [
            'Excellent     {{$bowel['Excellent']}} คน',
            'Good          {{$bowel['Good']}} คน',
            'Fair          {{$bowel['Fair']}} คน',
            'Poor          {{$bowel['Poor']}} คน'],
        colors:['#245788', '#08AF9D', '#F0BB5D', '#F36349'],
        legend: {
            show: true,
            offsetX: 10,

            horizontalAlign: 'center',
            itemMargin: {
                vertical: 10
            },
            fontSize: '60px',

        },
        dataLabels: {
            enabled: false,
        },
        responsive: [{
          breakpoint: 480,
          options: {
            chart: {
              width: 200
            },
            fill: {
                // colors:['#245788', '#245788' ,'#245788', '#245788'],
            },
            legend: {
              position: 'bottom',
              showForSingleSeries: true,
            }
          }
        }]
        };

        var chart = new ApexCharts(document.querySelector("#bar_bowel"), options);
        chart.render();

</script>
