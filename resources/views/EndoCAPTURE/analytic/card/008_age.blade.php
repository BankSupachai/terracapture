<div class="col-lg-6 text-center">
    <h3 class="text-left">Age</h3>
    <center>
        <img    class="loading" src="{{url('public/images/loading.gif')}}" width="150px">
        </center>
    <div id="chart_age" class="showdata"></div>
</div>
<script>
    var chartAGE = am4core.create("chart_age", am4charts.XYChart);
    chartAGE.data = [];
    var categoryAxisAGE = chartAGE.xAxes.push(new am4charts.CategoryAxis());
    categoryAxisAGE.dataFields.category = "country";
    categoryAxisAGE.renderer.grid.template.location = 0;
    categoryAxisAGE.renderer.minGridDistance = 30;
    categoryAxisAGE.renderer.labels.template.adapter.add("dy", function(dy, target) {
      return dy;
    });
    var valueAxisAGE = chartAGE.yAxes.push(new am4charts.ValueAxis());
    var seriesAGE = chartAGE.series.push(new am4charts.ColumnSeries());
    seriesAGE.dataFields.valueY = "visits";
    seriesAGE.dataFields.categoryX = "country";
    seriesAGE.name = "Visits";
    seriesAGE.columns.template.tooltipText = "{categoryX}: [bold]{valueY}[/]";
    seriesAGE.columns.template.fillOpacity = .8;
    seriesAGE.columns.template.fill = am4core.color("#84e0db");
    seriesAGE.columns.template.stroke = am4core.color("#2ccac1");
    var columnTemplateAGE = seriesAGE.columns.template;
    columnTemplateAGE.strokeWidth = 2;
    columnTemplateAGE.strokeOpacity = 1;
</script>
