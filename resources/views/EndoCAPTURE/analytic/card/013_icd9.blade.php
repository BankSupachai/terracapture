<div class="col-lg-6">
    <div class="card">
        <div class="card-body p-4">
            <div class="row" style="align-items: center;">
                <div class="col-lg-6"><h3>ICD-9</h3></div>
                <div class="col-lg-6 text-right"><button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#icd9_modal">Show All</button></div>
                <div class="col-lg-12">
                    <center>
                        <img    class="loading" src="{{url('public/images/loading.gif')}}" width="150px">
                        </center>
                    <div id="icd09" class="showdata"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var chartICD9 = am4core.create("icd09", am4charts.XYChart);
    chartICD9.data = [];
    var categoryAxisICD9 = chartICD9.yAxes.push(new am4charts.CategoryAxis());
    categoryAxisICD9.dataFields.category = "category";
    categoryAxisICD9.renderer.grid.template.location = 0;
    var valueAxisICD9 = chartICD9.xAxes.push(new am4charts.ValueAxis());
    valueAxisICD9.renderer.minGridDistance = 30;
    valueAxisICD9.renderer.labels.template.adapter.add("text", function(text, target) {
        return text && text.match(/\./) ? "" : text;
    });
    var seriesICD9 = chartICD9.series.push(new am4charts.ColumnSeries());
    seriesICD9.dataFields.valueX = "value";
    seriesICD9.dataFields.categoryY = "category";
    seriesICD9.columns.template.tooltipText = "{categoryY}: [bold]{valueX}[/]";
    seriesICD9.columns.template.fillOpacity = .8;
    seriesICD9.columns.template.fill = am4core.color("#84e0db");
    seriesICD9.columns.template.stroke = am4core.color("#2ccac1");
</script>
