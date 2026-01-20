<div class="card">
    <div class="card-header ribbon ribbon-top">
        <div class="ribbon-target bg-warning" style="top: -2px; left: 20px;">
            <i class="fas fa-undo text-light"></i>
        </div>
        <div class="col-12 text-center">
            Scope
        </div>
    </div>
    <div class="card-body">
        <div id="chart_scope" style="height: 250px;"></div>
    </div>
</div>
    <script>
        var chart_scope = am4core.create("chart_scope", am4charts.XYChart);
        chart_scope.data = [

            @php
            $i= 0;
            @endphp
        @foreach($scope as $s =>$v)

            @if($i<5)
            {
        "country": "{{$s}}",
        "visits": {{$v}}
        },
            @endif

            @php
            $i++;
            @endphp
        @endforeach
    ];
        var scope_categoryAxis = chart_scope.xAxes.push(new am4charts.CategoryAxis());
        scope_categoryAxis.dataFields.category = "country";
        scope_categoryAxis.renderer.grid.template.location = 0;
        scope_categoryAxis.renderer.minGridDistance = 30;
        scope_categoryAxis.renderer.labels.template.adapter.add("dy", function(dy, target) {return dy;});
        var scope_valueAxis = chart_scope.yAxes.push(new am4charts.ValueAxis());
        var scope_series = chart_scope.series.push(new am4charts.ColumnSeries());
        scope_series.dataFields.valueY = "visits";
        scope_series.dataFields.categoryX = "country";
        scope_series.name = "Visits";
        scope_series.columns.template.tooltipText = "{categoryX}: [bold]{valueY}[/]";
        scope_series.columns.template.fillOpacity = .8;
        scope_series.columns.template.stroke = "#1BC5BD";
        scope_series.columns.template.fill = "#1BC5BD";

        scope_categoryAxis.renderer.labels.template.events.on("hit", highlighColumn);
        scope_categoryAxis.renderer.labels.template.cursorOverStyle = am4core.MouseCursorStyle.pointer;


        var scope_columnTemplate = series.columns.template;
        scope_columnTemplate.strokeWidth = 2;
        scope_columnTemplate.strokeOpacity = 1;


    </script>



