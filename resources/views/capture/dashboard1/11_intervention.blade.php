<div class="col-4">
    <div class="card h-charts ">
        <div class="card-header d-flex justify-content-between">
            <span class="text-header-chart" style="font-weight: bold;">Intervention</span>
            {{-- <a href="{{url("dashboard/intervention")}}" class="btn btn-light">Show all</a> --}}
            <a href="{{url("dashboard/intervention?")}}@php
            if(isset($_GET['date'])){echo "date=".$_GET['date'];}
            if(isset($_GET['hoscode'])){echo "&hoscode=".$_GET['hoscode'];}
            @endphp" class="btn btn-light">Show all</a>
        </div>
        <div class="card-body p-0">
            <div id="bar_intervention" data-colors='["--vz-success"]' class="apex-charts" dir="ltr"></div>
        </div>

    </div>
</div>


{{-- procedure_sub --}}
<script>
    var options = {
          series: [{
          data: [
            @foreach ($procedure_sub as $key => $val)
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
            colors:['#0ab39c'],
        },
        xaxis: {
          categories: [
            @foreach ($procedure_sub as $key => $val)
                    '{{ $key }}',
            @endforeach
          ],
          labels: {formatter: function (value) {return Math.floor(value);}}
        }
        };

        var chart = new ApexCharts(document.querySelector("#bar_intervention"), options);
        chart.render();
</script>
