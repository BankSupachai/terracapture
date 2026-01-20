<div class="col-lg-6 pt-2">
    <div class="card">
        <div class="card-body p-4">
            <div class="row" style="align-items: center;">
                <h3>&emsp;Medication</h3>
                <center>
                    <img    class="loading" src="{{url('public/images/loading.gif')}}" width="150px">
                    </center>
                <div id="medication" class="showdata"></div>
            </div>
        </div>
    </div>
</div>


<script>
    var chartMEDICATION = am4core.create("medication", am4charts.PieChart);
    chartMEDICATION.hiddenState.properties.opacity = 0; // this creates initial fade-in
    chartMEDICATION.data = [];
    chartMEDICATION.radius = am4core.percent(70);
    chartMEDICATION.innerRadius = am4core.percent(40);
    chartMEDICATION.startAngle = 180;
    chartMEDICATION.endAngle = 360;
    var seriesMEDICATION = chartMEDICATION.series.push(new am4charts.PieSeries());
    seriesMEDICATION.dataFields.value = "value";
    seriesMEDICATION.dataFields.category = "country";
    seriesMEDICATION.slices.template.cornerRadius = 10;
    seriesMEDICATION.slices.template.innerCornerRadius = 7;
    seriesMEDICATION.slices.template.draggable = true;
    seriesMEDICATION.slices.template.inert = true;
    seriesMEDICATION.alignLabels = false;
    seriesMEDICATION.slices.template.propertyFields.fill = "color";
    seriesMEDICATION.hiddenState.properties.startAngle = 90;
    seriesMEDICATION.hiddenState.properties.endAngle = 90;
</script>
