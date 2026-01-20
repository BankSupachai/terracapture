    <div class="card">
        <div class="card-header ribbon ribbon-top">
            <div class="ribbon-target bg-warning" style="top: -2px; left: 20px;">
                <i class="fas fa-undo text-light"></i>
            </div>
            <div class="col-12 text-center">
                ICD 10
                <a class="btn btn-outline-secondary btn-chart" target="_blank" href="{{ url('showanalytic') }}"
                    style="margin-top: -1em;">Show All</a>
            </div>
        </div>
        <div class="card-body">
            <div id="chart_icd10" style="height: 250px;"></div>
        </div>
    </div>

    <script>
        var chart_icd10 = am4core.create("chart_icd10", am4charts.XYChart);
        chart_icd10.data = [
            @php
            $i = 0;
            @endphp
            @foreach ($icd10 as $icd => $v)
                @if ($i < 5)
                    {
                    "country": "{{ $icd }}",
                    "visits": {{ $v }}
                    },
                @endif

                @php
                    $i++;
                @endphp
            @endforeach
        ];

        var categoryAxis = chart_icd10.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "country";
        categoryAxis.renderer.grid.template.location = 0;
        categoryAxis.renderer.minGridDistance = 30;
        categoryAxis.renderer.labels.template.adapter.add("dy", function(dy, target) {
            return dy;
        });
        var valueAxis = chart_icd10.yAxes.push(new am4charts.ValueAxis());

        // Create series
        var series = chart_icd10.series.push(new am4charts.ColumnSeries());
        series.dataFields.valueY = "visits";
        series.dataFields.categoryX = "country";
        series.name = "Visits";
        series.columns.template.tooltipText = "{categoryX}: [bold]{valueY}[/]";
        series.columns.template.fillOpacity = .8;
        series.columns.template.stroke = "#1BC5BD";
        series.columns.template.fill = "#1BC5BD";

        // Add events
        categoryAxis.renderer.labels.template.events.on("hit", highlighColumn);
        categoryAxis.renderer.labels.template.cursorOverStyle = am4core.MouseCursorStyle.pointer;

    </script>




    <script>
        // Create chart instance
        var chart_icd10_modal = am4core.create("chart_icd10_modal", am4charts.XYChart);
        // Add data
        chart_icd10_modal.data = [
            @foreach ($icd10 as $icd => $v)
                {
                "country": "{{ $icd }}",
                "visits": {{ $v }}
                },
            @endforeach
        ];

        var categoryAxis = chart_icd10_modal.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "country";
        categoryAxis.renderer.grid.template.location = 0;
        categoryAxis.renderer.minGridDistance = 30;

        categoryAxis.renderer.labels.template.adapter.add("dy", function(dy, target) {
            return dy;
        });

        var valueAxis = chart_icd10_modal.yAxes.push(new am4charts.ValueAxis());
        var label = categoryAxis.renderer.labels.template;
        label.truncate = true;
        label.maxWidth = 200;
        label.tooltipText = "{country}";

        categoryAxis.events.on("sizechanged", function(ev) {
            var axis = ev.target;
            var cellWidth = axis.pixelWidth / (axis.endIndex - axis.startIndex);
            if (cellWidth < axis.renderer.labels.template.maxWidth) {
                axis.renderer.labels.template.rotation = -45;
                axis.renderer.labels.template.horizontalCenter = "right";
                axis.renderer.labels.template.verticalCenter = "middle";
            } else {
                axis.renderer.labels.template.rotation = 0;
                axis.renderer.labels.template.horizontalCenter = "middle";
                axis.renderer.labels.template.verticalCenter = "top";
            }
        });

        // Create series
        var series = chart_icd10_modal.series.push(new am4charts.ColumnSeries());
        series.dataFields.valueY = "visits";
        series.dataFields.categoryX = "country";

    </script>
