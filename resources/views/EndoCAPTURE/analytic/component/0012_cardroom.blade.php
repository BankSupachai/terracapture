<div class="card">
    <div class="card-header ribbon ribbon-top">
        <div class="ribbon-target bg-warning" style="top: -2px; left: 20px;">
            <i class="fas fa-undo text-light"></i>
        </div>
        <div class="col-12 text-center">
            Room
        </div>
    </div>
    <div class="card-body">
        <div id="chart_room" style="height: 250px;"></div>
    </div>
</div>
    <script>
        var chart_room = am4core.create("chart_room", am4charts.XYChart);
        chart_room.data = [
            @foreach($room as $r => $v)
        {
        "country": "{{$r}}",
        "visits": {{$v}}
        },
        @endforeach
];
        var room_categoryAxis = chart_room.xAxes.push(new am4charts.CategoryAxis());
        room_categoryAxis.dataFields.category = "country";
        room_categoryAxis.renderer.grid.template.location = 0;
        room_categoryAxis.renderer.minGridDistance = 30;
        room_categoryAxis.renderer.labels.template.adapter.add("dy", function(dy, target) {return dy;});
        var room_valueAxis = chart_room.yAxes.push(new am4charts.ValueAxis());
        var room_series = chart_room.series.push(new am4charts.ColumnSeries());
        room_series.dataFields.valueY = "visits";
        room_series.dataFields.categoryX = "country";
        room_series.name = "Visits";
        room_series.columns.template.tooltipText = "{categoryX}: [bold]{valueY}[/]";
        room_series.columns.template.fillOpacity = .8;
        room_series.columns.template.stroke = "#1BC5BD";
        room_series.columns.template.fill = "#1BC5BD";


        room_categoryAxis.renderer.labels.template.events.on("hit", highlighColumn);
        room_categoryAxis.renderer.labels.template.cursorOverStyle = am4core.MouseCursorStyle.pointer;


        var room_columnTemplate = series.columns.template;
        room_columnTemplate.strokeWidth = 2;
        room_columnTemplate.strokeOpacity = 1;
    </script>
