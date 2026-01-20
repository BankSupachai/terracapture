<div class="col-4">
    <div class="card h-charts mt-2">
        <div class="card-header">
            <span class="text-header-chart">Status</span>
        </div>
        <div class="card-body p-0 mt-4">
            <div id="bar_status" data-colors='["--vz-danger", "--vz-primary", "--vz-success"]' class="apex-charts" dir="ltr"></div>
        </div>
    </div>
</div>

@php
$m01    = $hos01_gender[0]['val'];
$f01    = $hos01_gender[1]['val'];
$m02    = $hos02_gender[0]['val'];
$f02    = $hos02_gender[1]['val'];
$m03    = $hos03_gender[0]['val'];
$f03    = $hos03_gender[1]['val'];
@endphp


<script>
   var options = {
         series: [{

         name: 'Registered',
         data: [{{$f01}}, {{$f02}}, {{$f03}}]
       },
       {
         name: 'Finished',
         data: [{{$m01}}, {{$m02}}, {{$m03}}]
       },
    ],
        chart: {
         type: 'bar',
         height: 190,
         width: '80%',
       },
       plotOptions: {
         bar: {
           horizontal: false,
           columnWidth: '50%',
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
         categories: ['รพ.พระจอมเกล้า', 'รพ.ท่ายาง', 'รพ.ชะอำ',],
       },
       yaxis: {
         title: {
           text: ''

         }
       },
       fill: {
         opacity: 1,
         colors:['#245788', '#0ab39c'],
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

       var chart = new ApexCharts(document.querySelector("#bar_status"), options);
       chart.render();
</script>






{{-- <script>
    var options = {
          series: [
          {
            name: 'รพ.พระจอมเกล้า',
            group: 'budget',
            data: [{{$m01}}, {{$m02}}, {{$m03}}]
          },
          {
            name: 'รพ.ท่ายาง',
            group: 'actual',
            data: [{{$f01}}, {{$f02}}, {{$f03}}]
          },
          {
            name: 'รพ.ชะอำ',
            group: 'actual',
            data: []
          },

        ],
          chart: {
          type: 'bar',
          height: 190,
          stacked: true,
          fontFamily: 'Anuphan sans-serif',

        },

        labels: [
            'Registered',
            'Finished'
            ],
        stroke: {
          width: 1,
          colors: ['#fff']
        },
        dataLabels: {
          formatter: (val) => {
            return val / 1000 + ''
          }
        },
        plotOptions: {
          bar: {
            horizontal: false
          }
        },
        xaxis: {
          categories: [
            'รพ.พระจอมเกล้า',
            'รพ.ท่ายาง',
            'รพ.ชะอำ'
          ]
        },
        fill: {
        },
        colors: ['#245788', '#0ab39c', '#245788'],
        yaxis: {
          labels: {
            formatter: (val) => {
              return val / 1000 + ''
            }
          }
        },
        legend: {
            show: true,
            position: 'right',
            horizontalAlign: 'left'
        }
        };

        var chart = new ApexCharts(document.querySelector("#bar_status"), options);
        chart.render();
</script> --}}
