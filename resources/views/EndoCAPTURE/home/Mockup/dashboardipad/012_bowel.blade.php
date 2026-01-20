<div class="col-6"  id="bowel_div">
    <div class="card card-ipad h-left mt-2">
        <div class="border-bottom-solid  p-4" style="background: #222529;">
          @php
            $bowel_arr = isset($bowel) ? $bowel : [];
          @endphp
            <span class="text-header-chart-ipad  h3">Bowel Preparation</span>
        </div>
        <div class="card-body p-0 mt-2">
            <div id="bar_bowel" data-colors='["--vz-success"]' class="apex-charts" dir="ltr"></div>
        </div>
    </div>
</div>

<script>
  var bowel     = @json($bowel_arr) 
  var key       = Object.keys(bowel)
  var value     = Object.values(bowel)
  console.log(bowel, key, value, key.length);
  var text_arr  = [];
  for (let i = 0; i < key.length; i++) {
    let text = `${key[i]} ${value[i]}`  
    // let text = `${key[i]}    ${value[i]} คน`    
    text_arr.push(text)  
  }

  console.log(text_arr);
  var options = {
        series: value,
        chart: {
        type: 'donut',
        height: 200,
      },
      labels: text_arr,
      dataLabels: {
          enabled: true,
          formatter: function (val) {
              return parseInt(val) + "%"
            }
        },
      legend: {
          show: true,
          offsetX: 10,
          horizontalAlign: 'center',
          itemMargin: {
              vertical: 10
          },
          fontSize: '60px',
      },
      colors:['#245788', '#08AF9D', '#F0BB5D', '#F36349'],
      responsive: [{
        breakpoint: 480,
        options: {
          chart: {
            width: 200
          },

          legend: {
            position: 'bottom'
          }
        }
      }]
      };

      var chart = new ApexCharts(document.querySelector("#bar_bowel"), options);
      chart.render();
</script>
