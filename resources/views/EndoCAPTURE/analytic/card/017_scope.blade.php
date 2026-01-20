<div class="col-lg-3">
    <div class="card mt-2">
        <div class="card-body">
            <div class="row" style="align-items: center;">
                <div class="col-lg-6"><h3>Scope</h3></div>
                <div class="col-lg-6 text-right"><button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#scope_modal">Show All</button></div>
                <div class="col-lg-12">
                    <center>
                        <img    class="loading" src="{{url('public/images/loading.gif')}}" width="150px">
                        </center>
                    <div id="scope" class="showdata"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    var chartSCOPE = am4core.create("scope", am4charts.XYChart);
    chartSCOPE.data = [];
    var categoryAxisSCOPE = chartSCOPE.xAxes.push(new am4charts.CategoryAxis());
    categoryAxisSCOPE.dataFields.category = "country";
    categoryAxisSCOPE.renderer.grid.template.location = 0;
    categoryAxisSCOPE.renderer.minGridDistance = 30;
    categoryAxisSCOPE.renderer.labels.template.adapter.add("dy", function(dy, target) {
      return dy;
    });
    var valueAxisSCOPE = chartSCOPE.yAxes.push(new am4charts.ValueAxis());
    var seriesSCOPE = chartSCOPE.series.push(new am4charts.ColumnSeries());
    seriesSCOPE.dataFields.valueY = "visits";
    seriesSCOPE.dataFields.categoryX = "country";
    seriesSCOPE.name = "Visits";
    seriesSCOPE.columns.template.tooltipText = "{categoryX}: [bold]{valueY}[/]";
    seriesSCOPE.columns.template.fillOpacity = .8;
    seriesSCOPE.columns.template.fill = am4core.color("#84e0db");
    seriesSCOPE.columns.template.stroke = am4core.color("#2ccac1");
    var columnTemplateSCOPE = seriesSCOPE.columns.template;
    columnTemplateSCOPE.strokeWidth = 2;
    columnTemplateSCOPE.strokeOpacity = 1;

</script>
