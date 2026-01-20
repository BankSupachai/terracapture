<div class="card">
    <div class="card-header ribbon ribbon-top">
        <div class="ribbon-target bg-warning" style="top: -2px; left: 20px;">
            <i class="fas fa-undo text-light"></i>
        </div>
        <div class="col-12 text-center">
            Medication
            <button class="btn btn-outline-secondary btn-chart" data-toggle="modal" data-target=".modal_medication" style="margin-top: -1em;">Show All</button>
        </div>
    </div>
    <div class="card-body">
        <div id="chart_medication" style="height: 250px;"></div>
    </div>
</div>

<script>
    var chart_medication = am4core.create("chart_medication", am4charts.XYChart);
    chart_medication.data = [
        @php
            $i= 0;
            @endphp
        @foreach($medication as $m =>$v)

            @if($i<5)
            {
        "country": "{{$m}}",
        "visits": {{$v}}
        },
            @endif

            @php
            $i++;
            @endphp
        @endforeach
    ];
    var medication_categoryAxis = chart_medication.xAxes.push(new am4charts.CategoryAxis());
    medication_categoryAxis.dataFields.category = "country";
    medication_categoryAxis.renderer.grid.template.location = 0;
    medication_categoryAxis.renderer.minGridDistance = 30;
    medication_categoryAxis.renderer.labels.template.adapter.add("dy", function(dy, target) {return dy;});
    var medication_valueAxis = chart_medication.yAxes.push(new am4charts.ValueAxis());
    var medication_series = chart_medication.series.push(new am4charts.ColumnSeries());
    medication_series.dataFields.valueY = "visits";
    medication_series.dataFields.categoryX = "country";
    medication_series.name = "Visits";
    medication_series.columns.template.tooltipText = "{categoryX}: [bold]{valueY}[/]";
    medication_series.columns.template.fillOpacity = .8;
    medication_series.columns.template.stroke = "#1BC5BD";
    medication_series.columns.template.fill = "#1BC5BD";


    medication_categoryAxis.renderer.labels.template.events.on("hit", highlighColumn);
    medication_categoryAxis.renderer.labels.template.cursorOverStyle = am4core.MouseCursorStyle.pointer;


    var medication_columnTemplate = series.columns.template;
    medication_columnTemplate.strokeWidth = 2;
    medication_columnTemplate.strokeOpacity = 1;
</script>


<script>
    var chart_medication_modal = am4core.create("chart_medication_modal", am4charts.XYChart);
    chart_medication_modal.data = [{"country": "01","visits": 10},];

    // Create axes
    var categoryAxis = chart_medication_modal.xAxes.push(new am4charts.CategoryAxis());
    categoryAxis.dataFields.category = "country";
    categoryAxis.renderer.grid.template.location = 0;
    categoryAxis.renderer.minGridDistance = 30;
    categoryAxis.renderer.labels.template.adapter.add("dy", function(dy, target) {return dy;});

    var valueAxis = chart_medication_modal.yAxes.push(new am4charts.ValueAxis());

    // Create series
    var series = chart_medication_modal.series.push(new am4charts.ColumnSeries());
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
