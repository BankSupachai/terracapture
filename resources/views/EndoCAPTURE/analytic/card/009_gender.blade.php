<div class="col-lg-6 text-center">
    <h3 class="text-left">Gender</h3>
    <center>
        <img    class="loading" src="{{url('public/images/loading.gif')}}" width="150px">
        </center>
    <div id="chart_gender" class="showdata"></div>
</div>

<script>
    var chartGENDER = am4core.create("chart_gender", am4charts.PieChart);
    chartGENDER.data = [];
    var pieSeriesGENDER = chartGENDER.series.push(new am4charts.PieSeries());
    pieSeriesGENDER.dataFields.value = "litres";
    pieSeriesGENDER.dataFields.category = "country";
    pieSeriesGENDER.slices.template.stroke = am4core.color("#fff");
    pieSeriesGENDER.slices.template.strokeWidth = 2;
    pieSeriesGENDER.slices.template.strokeOpacity = 1;
    pieSeriesGENDER.slices.template.propertyFields.fill = "color";
    pieSeriesGENDER.hiddenState.properties.opacity = 1;
    pieSeriesGENDER.hiddenState.properties.endAngle = -90;
    pieSeriesGENDER.hiddenState.properties.startAngle = -90;
</script>
