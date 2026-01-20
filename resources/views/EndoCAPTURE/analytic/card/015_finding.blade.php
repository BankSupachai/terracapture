<div class="col-lg-6 pt-2">
    <div class="card">
        <div class="card-body p-4">
            <form action="" method="get">
            <div class="row" style="align-items: center;">
                <div class="col-lg-3"><h3>Finding</h3></div>
                    <div class="col-lg-7"><input type="text" name="finding" class="form-control form-control-sm" id="filter_finding"></div>
                    <div class="col-lg-2 pt-1"><button type="submit" class="btn btn-outline-primary btn-sm w-100"><i class="fa fa-search"></i></button></div>
                <div class="col-lg-12">
                    <center>
                        <img    class="loading" src="{{url('public/images/loading.gif')}}" width="150px">
                        </center>
                    <div id="finding" class="showdata"></div>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>


<script>

        var chartFINDING = am4core.create("finding", am4charts.XYChart);
        chartFINDING.data = [];
        var categoryAxisFINDING = chartFINDING.xAxes.push(new am4charts.CategoryAxis());
        categoryAxisFINDING.dataFields.category = "country";
        categoryAxisFINDING.renderer.grid.template.location = 0;
        categoryAxisFINDING.renderer.minGridDistance = 30;
        categoryAxisFINDING.renderer.labels.template.adapter.add("dy", function(dy, target) {
        if (target.dataItem && target.dataItem.index & 2 == 2) {
            return dy + 25;
        }
        return dy;
        });
        var valueAxisFINDING = chartFINDING.yAxes.push(new am4charts.ValueAxis());
        var seriesFINDING = chartFINDING.series.push(new am4charts.ColumnSeries());
        seriesFINDING.dataFields.valueY = "visits";
        seriesFINDING.dataFields.categoryX = "country";
        seriesFINDING.name = "Visits";
        seriesFINDING.columns.template.tooltipText = "{categoryX}: [bold]{valueY}[/]";
        seriesFINDING.columns.template.fillOpacity = .8;
        seriesFINDING.columns.template.fill = am4core.color("#84e0db");
        seriesFINDING.columns.template.stroke = am4core.color("#2ccac1");
        var columnTemplateFINDING = seriesFINDING.columns.template;
        columnTemplateFINDING.strokeWidth = 2;
        columnTemplateFINDING.strokeOpacity = 1;

</script>
