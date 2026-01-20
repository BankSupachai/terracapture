<div class="col-4">
    <div class="card h-charts mt-">
        <div class="card-header">
            <span class="text-header-chart" style="font-weight: bold;">Procedure</span>
        </div>
        <div class="card-body p-0 mt-2 ms-4 " style="height: 227px;">
            <div id="count-procedure" data-colors='["--vz-primary", "--vz-success", "--vz-warning", "--vz-danger", "--vz-info"]' class="apex-charts" dir="ltr">
EGD<br><br>Colonoscopy<br><br> Bronchoscopy <br><br>ERCP  <br><br>EUS <br><br>Sigmoidscopy

            </div>
        </div>

    </div>
</div>
{{-- <script>
    var options = {
            series: [{{$hos01_gender["all"]}}, {{$hos02_gender["all"]}}, {{$hos03_gender["all"]}}],
            chart: {
                height: 200,
                type: 'pie',
            },
            labels: [
                'รพ.พระจอมเกล้า {{$hos01_gender["all"]}} ราย',
                'รพ.ท่ายาง {{$hos02_gender["all"]}} ราย',
                'รพ.ชะอำ {{$hos03_gender["all"]}} ราย'
            ],
            legend: {
                show: true,
                offsetX: 10,
                horizontalAlign: 'center',
                itemMargin: {
                    vertical: 10
                },
                fontSize: '50px',
                fontFamily: 'Anuphan, sans-serif',
                foreColor: '#00000',
            },
            colors: ['#415089', '#08AF9D', '#F36349'],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {

                        fontFamily: 'Anuphan, sans-serif',
                    },
                    fill: {
                        //  colors: ['#415089', '#F36349', '#08AF9D']
                    },
                    legend: {
                    // position: 'bottom'
                    },
                    yaxis:{
                        max: 6,
                    },
                }
            }]
        };


        var chart = new ApexCharts(document.querySelector("#count-procedure"), options);
        chart.render();
</script> --}}
