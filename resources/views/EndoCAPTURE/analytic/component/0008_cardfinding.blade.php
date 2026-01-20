<div class="card">
    <div class="card-header ribbon ribbon-top">
        <div class="ribbon-target bg-warning" style="top: -2px; left: 20px;">
            <i class="fas fa-undo text-light"></i>
        </div>
        <div class="col-12 text-center">
            Finding
        </div>
    </div>
    <div class="card-body">
        <div id="chart_finding" style="height: 250px;"></div>
    </div>
</div>
    <script>
        var chart_finding = am4core.create("chart_finding", am4charts.XYChart);
        chart_finding.data = [
            {
            "country": "{{$finding['name']}}",
            "visits": @php echo $finding['value']; @endphp
            }
        ];
        var finding_categoryAxis = chart_finding.xAxes.push(new am4charts.CategoryAxis());
        finding_categoryAxis.dataFields.category = "country";
        finding_categoryAxis.renderer.grid.template.location = 0;
        finding_categoryAxis.renderer.minGridDistance = 30;
        finding_categoryAxis.renderer.labels.template.adapter.add("dy", function(dy, target) {return dy;});
        var finding_valueAxis = chart_finding.yAxes.push(new am4charts.ValueAxis());
        var finding_series = chart_finding.series.push(new am4charts.ColumnSeries());
        finding_series.dataFields.valueY = "visits";
        finding_series.dataFields.categoryX = "country";
        finding_series.name = "Visits";
        finding_series.columns.template.tooltipText = "{categoryX}: [bold]{valueY}[/]";
        finding_series.columns.template.fillOpacity = .8;
        finding_series.columns.template.stroke = "#1BC5BD";
        finding_series.columns.template.fill = "#1BC5BD";

        finding_series.renderer.labels.template.events.on("hit", highlighColumn);
        finding_series.renderer.labels.template.cursorOverStyle = am4core.MouseCursorStyle.pointer;


        var finding_columnTemplate = series.columns.template;
        finding_columnTemplate.strokeWidth = 2;
        finding_columnTemplate.strokeOpacity = 1;
    </script>
