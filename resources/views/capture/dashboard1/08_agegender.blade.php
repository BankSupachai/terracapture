<div class="col-4">
    <div class="card h-charts " >
        <div class="card-header">
            <span class="text-header-chart" style="font-weight: bold;">Age / Gender</span>
        </div>
        <div class="card-body p-0 mt-4" style="margin-bottom: 23px;">
            <div id="column_age" data-colors='["--vz-primary", "--vz-success", "--vz-warning", "--vz-danger"]' class="apex-charts" dir="ltr"></div>
        </div>
    </div>
</div>

{{-- @dd($agegender_male); --}}




<script>
    var options = {
        series: [{
            name: 'Male',
            data: {!! json_encode(array_column($agegender_male, 'val')) !!}
        }, {
            name: 'Female',
            data: {!! json_encode(array_column($agegender_female, 'val')) !!}
        }],
        chart: {
            type: 'bar',
            height: 190,
            width: '80%',
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                endingShape: 'rounded'
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        xaxis: {
            categories: ['0-20', '21-40', '41-60', '61-80', '80+'],
        },
        yaxis: {
            title: {
                text: ''
            },
            labels: {
                formatter: function (value) {
                    return Math.floor(value);
                }
            }
        },
        fill: {
            opacity: 1,
            colors: ['#245788', '#0ab39c'],
        },
        tooltip: {
            y: {
                formatter: function (val) {
                    return "$ " + val + " thousands"
                }
            }
        },
        legend: {
            show: true,
            position: 'bottom',
            horizontalAlign: 'center',
        },
        colors: ['#245788', '#0ab39c'],
    };

    var chart = new ApexCharts(document.querySelector("#column_age"), options);
    chart.render();
</script>

