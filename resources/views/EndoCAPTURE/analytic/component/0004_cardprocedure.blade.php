<div class="card">
    <div class="card-header ribbon ribbon-top">
        <div class="ribbon-target bg-warning" style="top: -2px; left: 20px;">
            <i class="fas fa-undo text-light"></i>
        </div>
        <div class="col-12 text-center">
            Procedure
        </div>
    </div>
    <div class="card-body">
        <div id="chart_procedure" style="height: 500px;"></div>
    </div>
</div>


<!--  Chart Procedure  -->
<script>
    /*
        // var chart_procedure = am4core.create("chart_procedure", am4charts.XYChart);
        var data = [];
        var value = 120;
        var names = [
            @foreach ($procedure as $p => $v)
                "{{ $p }}",
            @endforeach
        ];

        var value = [
            @foreach ($procedure as $p => $v)
                {{ $v }},
            @endforeach
        ];

        for (var i = 0; i < names.length; i++) {
            data.push({ category: names[i], value: value[i] });
        }

        chart_procedure.data = data;

        var procedure_categoryAxis = chart_procedure.xAxes.push(new am4charts.CategoryAxis());
        procedure_categoryAxis.renderer.grid.template.location = 0;
        procedure_categoryAxis.dataFields.category = "category";
        procedure_categoryAxis.renderer.minGridDistance = 15;
        procedure_categoryAxis.renderer.grid.template.location = 0.5;
        procedure_categoryAxis.renderer.grid.template.strokeDasharray = "1,3";
        procedure_categoryAxis.renderer.labels.template.rotation = -90;
        procedure_categoryAxis.renderer.labels.template.horizontalCenter = "left";
        procedure_categoryAxis.renderer.labels.template.location = 0.5;
        procedure_categoryAxis.renderer.labels.template.adapter.add("dx", function(dx, target) {return -target.maxRight / 2;})

        var procedure_valueAxis = chart_procedure.yAxes.push(new am4charts.ValueAxis());
        procedure_valueAxis.tooltip.disabled = true;
        procedure_valueAxis.renderer.ticks.template.disabled = true;
        procedure_valueAxis.renderer.axisFills.template.disabled = true;

        var procedure_series = chart_procedure.series.push(new am4charts.ColumnSeries());
        procedure_series.dataFields.categoryX = "category";
        procedure_series.dataFields.valueY = "value";
        procedure_series.tooltipText = "{valueY.value}";
        procedure_series.sequencedInterpolation = true;
        procedure_series.fillOpacity = 0;
        procedure_series.strokeOpacity = 1;
        procedure_series.strokeDashArray = "1,3";
        procedure_series.columns.template.width = 0.01;
        procedure_series.tooltip.pointerOrientation = "horizontal";
        procedure_series.columns.template.stroke = "#1BC5BD";
        procedure_series.columns.template.fill = "#1BC5BD";


        procedure_series.renderer.labels.template.events.on("hit", highlighColumn);
        procedure_series.renderer.labels.template.cursorOverStyle = am4core.MouseCursorStyle.pointer;


        var bullet = procedure_series.bullets.create(am4charts.CircleBullet);

        chart_procedure.cursor = new am4charts.XYCursor();
        chart_procedure.scrollbarX = new am4core.Scrollbar();
        chart_procedure.scrollbarY = new am4core.Scrollbar();
        */

</script>





<script>


        var chart_procedure = am4core.create("chart_procedure", am4charts.XYChart);

        chart_procedure.data = [
            @foreach ($procedure as $p => $v)
                {
                "region": "Central",
                "state": "{{ $p }}",
                "sales": {{ $v }}
                },
            @endforeach
        ];

        // Create axes
        var procedure_yAxis = chart_procedure.yAxes.push(new am4charts.CategoryAxis());
        procedure_yAxis.dataFields.category = "state";
        procedure_yAxis.renderer.grid.template.location = 0;
        procedure_yAxis.renderer.labels.template.fontSize = 10;
        procedure_yAxis.renderer.minGridDistance = 10;

        var procedure_xAxis = chart_procedure.xAxes.push(new am4charts.ValueAxis());

        // Create series
        var procedure_series = chart_procedure.series.push(new am4charts.ColumnSeries());
        procedure_series.dataFields.valueX = "sales";
        procedure_series.dataFields.categoryY = "state";
        procedure_series.columns.template.tooltipText = "{categoryY}: [bold]{valueX}[/]";
        procedure_series.columns.template.strokeWidth = 0;
        procedure_series.columns.template.fill = "rgb(27, 197, 189)";




        // console.log(yAxis);



        procedure_yAxis.renderer.labels.template.events.on("hit", highlighColumn);
        procedure_yAxis.renderer.labels.template.cursorOverStyle = am4core.MouseCursorStyle.pointer;

        console.log('dfkdjfl');
</script>
