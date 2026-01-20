<div class="col-lg-6">
    <div class="card">
        <div class="card-body p-4">
            <div class="row" style="align-items: center;">
                <div class="col-lg-6"><h3>ICD-10</h3></div>
                <div class="col-lg-6 text-right"><button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#icd10_modal">Show All</button></div>
                <div class="col-lg-12">
                    <center>
                        <img    class="loading" src="{{url('public/images/loading.gif')}}" width="150px">
                        </center>
                    <div id="icd10" class="showdata"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var chartICD10 = am4core.create("icd10", am4charts.XYChart);
    chartICD10.data = [];
    var categoryAxisICD10 = chartICD10.yAxes.push(new am4charts.CategoryAxis());
    categoryAxisICD10.dataFields.category = "category";
    categoryAxisICD10.renderer.grid.template.location = 0;
    var valueAxisICD10 = chartICD10.xAxes.push(new am4charts.ValueAxis());
    valueAxisICD10.renderer.minGridDistance = 30;
    valueAxisICD10.renderer.labels.template.adapter.add("text", function(text, target) {
        return text && text.match(/\./) ? "" : text;
    });
    var seriesICD10 = chartICD10.series.push(new am4charts.ColumnSeries());
    seriesICD10.dataFields.valueX               = "value";
    seriesICD10.dataFields.categoryY            = "category";
    seriesICD10.columns.template.tooltipText    = "{categoryY}: [bold]{valueX}[/]";
    seriesICD10.columns.template.fillOpacity    = .8;
    seriesICD10.columns.template.fill           = am4core.color("#84e0db");
    seriesICD10.columns.template.stroke         = am4core.color("#2ccac1");
</script>
