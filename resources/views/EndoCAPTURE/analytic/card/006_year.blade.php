<div class="col-lg-4 text-center">
    <h3 class="text-left">Year</h3>
    <center>
        <img    class="loading" src="{{url('public/images/loading.gif')}}" width="150px">
        </center>
    <div id="chart_Year" class="showdata"></div>
</div>

<script>

    var chartYEAR           =   am4core.create("chart_Year", am4charts.XYChart);
                                chartYEAR.data = [{
                                "country": "3",
                                "visits": 3
                                }, ];

    var categoryAxisYEAR    =   chartYEAR.xAxes.push(new am4charts.CategoryAxis());
    categoryAxisYEAR.dataFields.category = "country";
    categoryAxisYEAR.renderer.grid.template.location = 0;
    categoryAxisYEAR.renderer.minGridDistance = 30;
    categoryAxisYEAR.renderer.labels.template.adapter.add("dy", function(dy, target) {
    if (target.dataItem && target.dataItem.index & 2 == 2) {return dy + 25;}
                                return dy;
                            });

    var valueAxis       =   chartYEAR.yAxes.push(new am4charts.ValueAxis());
    var seriesYEAR      =   chartYEAR.series.push(new am4charts.ColumnSeries());
    seriesYEAR.dataFields.valueY = "visits";
    seriesYEAR.dataFields.categoryX = "country";
    seriesYEAR.name = "Visits";
    seriesYEAR.columns.template.tooltipText = "{categoryX}: [bold]{valueY}[/]";
    seriesYEAR.columns.template.fillOpacity = .8;
    seriesYEAR.columns.template.fill = am4core.color("#84e0db");
    seriesYEAR.columns.template.stroke = am4core.color("#2ccac1");

    var columnTemplateYEAR  =   seriesYEAR.columns.template;
    columnTemplateYEAR.strokeWidth = 2;
    columnTemplateYEAR.strokeOpacity = 1;

</script>
