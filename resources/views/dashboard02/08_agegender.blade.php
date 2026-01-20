<div class="col-lg-4">
    <div class="card h-charts mt-2">
      @php
          $male_age   = isset($age['male'])   ? $age['male']   : [0, 0, 0, 0, 0];
          $female_age = isset($age['female']) ? $age['female'] : [0, 0, 0, 0, 0];
      @endphp
        <div class="card-header">
            <span class="text-header-chart">Age / Gender</span>

        </div>
        <div class="card-body p-0 mt-4">
            <div id="column_age" data-colors='["--vz-primary", "--vz-success", "--vz-warning", "--vz-danger"]' class="apex-charts" dir="ltr"></div>
        </div>
    </div>
</div>



<script>
  var female = @json($female_age);
  var male   = @json($male_age);
    var options = {
         series: [{
         name: 'Male',
         data: male,
       }, {
         name: 'Female',
         data: female,
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
           text: 'Age'

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
             return val + " คน"
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
