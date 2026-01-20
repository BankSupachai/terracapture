<div class="col-4">
    <div class="card h-charts mt-2">
        <div class="card-header">
            <span class="text-header-chart">Age / Gender</span>

        </div>
        <div class="card-body p-0 mt-4">
            <div id="column_age" data-colors='["--vz-primary", "--vz-success", "--vz-warning", "--vz-danger"]' class="apex-charts" dir="ltr"></div>
        </div>
    </div>
</div>

{{-- @dd($agegender_male,$agegender_female) --}}




<script>
    var options = {
         series: [{
         name: 'Male',
         data: [{{$agegender_male[0]['val']}}, {{$agegender_male[1]['val']}}, {{$agegender_male[2]['val']}}, {{$agegender_male[3]['val']}}, {{$agegender_male[4]['val']}}]
       }, {
         name: 'Female',
         data: [{{$agegender_female[0]['val']}}, {{$agegender_female[1]['val']}}, {{$agegender_female[2]['val']}}, {{$agegender_female[3]['val']}}, {{$agegender_female[4]['val']}}]
       }, ],
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
         labels: {formatter: function (value) {return Math.floor(value);}}
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

       var chart = new ApexCharts(document.querySelector("#column_age"), options);
       chart.render();
</script>
