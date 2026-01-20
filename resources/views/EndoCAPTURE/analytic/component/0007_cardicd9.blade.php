<div class="card">
    <div class="card-header ribbon ribbon-top">
        <div class="ribbon-target bg-warning" style="top: -2px; left: 20px;">
            <i class="fas fa-undo text-light"></i>
        </div>
        <div class="col-12 text-center">
            ICD 9
            <button class="btn btn-outline-secondary btn-chart" data-toggle="modal" data-target=".modal_icd9" style="margin-top: -1em;">Show All</button>
        </div>
    </div>
    <div class="card-body">
        <div id="chart_icd09" style="height: 250px;"></div>
    </div>
</div>
<script>
    var chart_icd09 = am4core.create("chart_icd09", am4charts.XYChart);
    chart_icd09.data = [
        @php
            $i= 0;
            @endphp
        @foreach($icd9 as $icd =>$v)

            @if($i<5)
            {
        "country": "{{$icd}}",
        "visits": {{$v}}
        },
            @endif

            @php
            $i++;
            @endphp
        @endforeach
    ];
    var icd09_categoryAxis = chart_icd09.xAxes.push(new am4charts.CategoryAxis());
    icd09_categoryAxis.dataFields.category = "country";
    icd09_categoryAxis.renderer.grid.template.location = 0;
    icd09_categoryAxis.renderer.minGridDistance = 30;
    icd09_categoryAxis.renderer.labels.template.adapter.add("dy", function(dy, target) {return dy;});
    var icd09_valueAxis = chart_icd09.yAxes.push(new am4charts.ValueAxis());
    var icd09_series = chart_icd09.series.push(new am4charts.ColumnSeries());
    icd09_series.dataFields.valueY = "visits";
    icd09_series.dataFields.categoryX = "country";
    icd09_series.name = "Visits";
    icd09_series.columns.template.tooltipText = "{categoryX}: [bold]{valueY}[/]";
    icd09_series.columns.template.fillOpacity = .8;
    icd09_series.columns.template.stroke = "#1BC5BD";
    icd09_series.columns.template.fill = "#1BC5BD";

    icd09_categoryAxis.renderer.labels.template.events.on("hit", highlighColumn);
    icd09_categoryAxis.renderer.labels.template.cursorOverStyle = am4core.MouseCursorStyle.pointer;



    var icd09_label = icd09_categoryAxis.renderer.labels.template;
    icd09_label.truncate = true;
    icd09_label.maxWidth = 120;
    var icd09_columnTemplate = icd09_series.columns.template;
    icd09_columnTemplate.strokeWidth = 2;
    icd09_columnTemplate.strokeOpacity = 1;
</script>


    <!--  Chart ICD 9  -->
    <script>
        // Create chart instance
        var chart_icd09_modal = am4core.create("chart_icd09_modal", am4charts.XYChart);

        // Add data
        chart_icd09_modal.data = [{"country": "01","visits": 10},];

        // Create axes
        var categoryAxis = chart_icd09_modal.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "country";
        categoryAxis.renderer.grid.template.location = 0;
        categoryAxis.renderer.minGridDistance = 30;
        categoryAxis.renderer.labels.template.adapter.add("dy", function(dy, target) {return dy;});
        var valueAxis = chart_icd09_modal.yAxes.push(new am4charts.ValueAxis());

        // Create series
        var series = chart_icd09_modal.series.push(new am4charts.ColumnSeries());
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
