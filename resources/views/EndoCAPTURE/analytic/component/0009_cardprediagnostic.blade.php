<div class="card">
    <div class="card-header ribbon ribbon-top">
        <div class="ribbon-target bg-warning" style="top: -2px; left: 20px;">
            <i class="fas fa-undo text-light"></i>
        </div>
        <div class="col-12 text-center">
            Pre Diagnostic
            <button class="btn btn-outline-secondary btn-chart" data-toggle="modal" data-target=".modal_diagnostic" style="margin-top: -1em;">Show All</button>
        </div>
    </div>
    <div class="card-body">
        <div id="chart_diagnostic" style="height: 250px;"></div>
    </div>
</div>


<script>
    var chart_diagnostic = am4core.create("chart_diagnostic", am4charts.XYChart);
    chart_diagnostic.data = [
        @php
            $i= 0;
            @endphp
        @foreach($prediagnostic_other as $p =>$v)

            @if($i<5)
            {
        "country": "{{substr($p,0,12)}}...",
        "visits": {{$v}}
        },
            @endif

            @php
            $i++;
            @endphp
        @endforeach
    ];
    var diagnostic_categoryAxis = chart_diagnostic.xAxes.push(new am4charts.CategoryAxis());
    diagnostic_categoryAxis.dataFields.category = "country";
    diagnostic_categoryAxis.renderer.grid.template.location = 0;
    diagnostic_categoryAxis.renderer.minGridDistance = 30;

    diagnostic_categoryAxis.renderer.labels.template.rotation = -45;
    diagnostic_categoryAxis.renderer.labels.template.horizontalCenter = "right";
    diagnostic_categoryAxis.renderer.labels.template.verticalCenter = "middle";
    diagnostic_categoryAxis.renderer.labels.template.Width = "10px";

    diagnostic_categoryAxis.renderer.labels.template.adapter.add("dy", function(dy, target) {return dy;});
    var diagnostic_valueAxis = chart_diagnostic.yAxes.push(new am4charts.ValueAxis());
    var diagnostic_series = chart_diagnostic.series.push(new am4charts.ColumnSeries());

    // diagnostic_categoryAxis.events.on("sizechanged", function(ev) {
    // var axis = ev.target;
    // var cellWidth = axis.pixelWidth / (axis.endIndex - axis.startIndex);
    // if (cellWidth < axis.renderer.labels.template.maxWidth) {
    //     axis.renderer.labels.template.rotation = -45;
    //     axis.renderer.labels.template.horizontalCenter = "right";
    //     axis.renderer.labels.template.verticalCenter = "middle";
    // }
    // else {
    //     axis.renderer.labels.template.rotation = 0;
    //     axis.renderer.labels.template.horizontalCenter = "middle";
    //     axis.renderer.labels.template.verticalCenter = "top";
    // }
    // });



    diagnostic_series.dataFields.valueY = "visits";
    diagnostic_series.dataFields.categoryX = "country";
    diagnostic_series.name = "Visits";
    diagnostic_series.columns.template.tooltipText = "{categoryX}: [bold]{valueY}[/]";
    diagnostic_series.columns.template.fillOpacity = .8;
    diagnostic_series.columns.template.stroke = "#1BC5BD";
    diagnostic_series.columns.template.fill = "#1BC5BD";

    console.log(diagnostic_series.dataFields.categoryX);

    diagnostic_categoryAxis.renderer.labels.template.events.on("hit", highlighColumn);
    diagnostic_categoryAxis.renderer.labels.template.cursorOverStyle = am4core.MouseCursorStyle.pointer;



    var diagnostic_label = categoryAxis.renderer.labels.template;
    diagnostic_label.truncate = true;
    diagnostic_label.maxWidth = 120;
    var diagnostic_columnTemplate = series.columns.template;
    diagnostic_columnTemplate.strokeWidth = 2;
    diagnostic_columnTemplate.strokeOpacity = 1;

</script>


<script>
    var chart_diagnostic_modal = am4core.create("chart_diagnostic_modal", am4charts.XYChart);
    chart_diagnostic_modal.data = [{"country": "01","visits": 10},];

    // Create axes
    var categoryAxis = chart_diagnostic_modal.xAxes.push(new am4charts.CategoryAxis());
    categoryAxis.dataFields.category = "country";
    categoryAxis.renderer.grid.template.location = 0;
    categoryAxis.renderer.minGridDistance = 30;

    categoryAxis.renderer.labels.template.adapter.add("dy", function(dy, target) {
    return dy;
    });

    var valueAxis = chart_diagnostic_modal.yAxes.push(new am4charts.ValueAxis());

    // Create series
    var series = chart_diagnostic_modal.series.push(new am4charts.ColumnSeries());
    series.dataFields.valueY = "visits";
    series.dataFields.categoryX = "country";
    series.name = "Visits";
    series.columns.template.tooltipText = "{categoryX}: [bold]{valueY}[/]";
    series.columns.template.fillOpacity = .8;
    series.columns.template.stroke = "#1BC5BD";
    series.columns.template.fill = "#1BC5BD";

    var columnTemplate = series.columns.template;
    columnTemplate.strokeWidth = 2;
    columnTemplate.strokeOpacity = 1;
</script>
