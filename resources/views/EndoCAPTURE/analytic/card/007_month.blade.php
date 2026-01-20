<div class="col-lg-8 text-center">
    <h3 class="text-left">Month</h3>
        <center>
        <img    class="loading" src="{{url('public/images/loading.gif')}}" width="150px">
        </center>
    <div id="chart_month" class="showdata"></div>
</div>


<script>

    var chartMONTH          =   am4core.create("chart_month", am4charts.XYChart);
    chartMONTH.data         = [];

    var categoryAxisMONTH   =   chartMONTH.xAxes.push(new am4charts.CategoryAxis());
    categoryAxisMONTH.dataFields.category = "country";
    categoryAxisMONTH.renderer.grid.template.location = 0;
    categoryAxisMONTH.renderer.minGridDistance = 30;
    categoryAxisMONTH.renderer.labels.template.adapter.add("dy", function(dy, target) {
    if (target.dataItem && target.dataItem.index & 2 == 2) {return dy + 25;}
                                return dy;
                            });

    var valueAxis       =   chartMONTH.yAxes.push(new am4charts.ValueAxis());
    var seriesMONTH     =   chartMONTH.series.push(new am4charts.ColumnSeries());
    seriesMONTH.dataFields.valueY = "visits";
    seriesMONTH.dataFields.categoryX = "country";
    seriesMONTH.name = "Visits";
    seriesMONTH.columns.template.tooltipText = "{categoryX}: [bold]{valueY}[/]";
    seriesMONTH.columns.template.fillOpacity = .8;
    seriesMONTH.columns.template.fill = am4core.color("#84e0db");
    seriesMONTH.columns.template.stroke = am4core.color("#2ccac1");

    var columnTemplateMONTH  =   seriesMONTH.columns.template;
    columnTemplateMONTH.strokeWidth = 2;
    columnTemplateMONTH.strokeOpacity = 1;

</script>
