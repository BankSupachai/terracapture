<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <script src="https://www.google.com/jsapi"></script>
    <style>
        .pie-chart {
            width: 600px;
            height: 400px;
            margin: 0 auto;
        }
        .text-center{
            text-align: center;
        }
    </style>
</head>
<body>

<h2 class="text-center">Generate PDF with Chart in Laravel</h2>

<div id="chartDiv" class="pie-chart"></div>

<div class="text-center">
    <h2>ItSolutionStuff.com.com</h2>
</div>
<input type="text" name="" id="url">
<script src="{{url("public/js/jquery-3.6.0.min.js")}}"></script>
<script>
    window.onload = function() {
        google.load("visualization", "1.1", {
            packages: ["corechart"],
            callback: 'drawChart'
        });
    };
    function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Pizza');
        data.addColumn('number', 'Populartiy');
        data.addRows([
            ['Laravel', 33],
            ['Codeigniter', 26],
            ['Symfony', 22],
            ['CakePHP', 10],
            ['Slim', 9]
        ]);

        var options = {
            title: 'Popularity of Types of Framework',
            sliceVisibilityThreshold: .2
        };

        var chart = new google.visualization.PieChart(document.getElementById('chartDiv'));
        chart.draw(data, options);

    }

    const canvas = document.getElementById('chartDiv');
    alert()
    const dataURL = canvas.toDataURL();

    console.log(dataURL);
</script>

</body>
</html>
