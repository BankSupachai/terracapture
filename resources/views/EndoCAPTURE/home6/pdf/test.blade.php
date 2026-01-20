<!DOCTYPE html>
<html>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<body>
<div id="myChart" style="width:100%; max-width:600px; height:500px;"></div>
<div id="chart"></div>
<input type="text" name="" id="" value="{{"OIL-".date('ymdhis')}}">
<script src="{{url("public/js/jquery-3.6.0.min.js")}}"></script>
<script>
google.charts.load('current',{packages:['corechart']});
google.charts.setOnLoadCallback(drawChart);


function drawChart() {
// Set Data
var data = google.visualization.arrayToDataTable([
  ['Price', 'Size'],
  [50,7],[60,8],[70,8],[80,9],[90,9],
  [100,9],[110,10],[120,11],
  [130,14],[140,14],[150,15]
]);
// Set Options
var options = {
  title: 'House Prices vs. Size',
  hAxis: {title: 'Square Meters'},
  vAxis: {title: 'Price in Millions'},
  legend: 'none',

};
// Draw
var chart = new google.visualization.LineChart(document.getElementById('myChart'));
chart.draw(data, options);

}
var canvas = $("#myChart").get(0);
console.log(canvas);
$("#chart").html(canvas)
</script>
<script>
    $("#btn-download").click(function () {

    var canvas = $("#myChart").get(0);
    // var dataURL = canvas.toDataURL('image/jpeg');
    console.log(canvas);
    // $("#btn-download").attr("href", dataURL);

});
</script>
</body>
</html>
