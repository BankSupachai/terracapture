<div class="card" style="height: 49%;">
    <div class="card-header ribbon ribbon-top">
        <div class="ribbon-target bg-warning" style="top: -2px; left: 20px;">
            <a href="#" onclick="chart_age()" ><i class="fas fa-undo text-light"></i></a>
        </div>
        <div class="col-12 text-center">
            Year
        </div>
    </div>
    <div class="card-body">
        <div id="chart_year" style="height: 250px;"></div>
    </div>
</div>
<div class="card mt-1" style="height: 49%;">
    <div class="card-header ribbon ribbon-top">
        <div class="ribbon-target bg-warning" style="top: -2px; left: 20px;">
            <i class="fas fa-undo text-light"></i>
        </div>
        <div class="col-12 text-center">
            Months1233333
        </div>
    </div>
    <div class="card-body">
        <div id="chart_months" style="height: 250px;"></div>
    </div>
</div>

    <!--  Chart Years  -->
    <script>


        var chart_year = am4core.create("chart_year", am4charts.XYChart);

function chart_age(){
        chart_year.data = [
            @foreach($year as $y =>$v)
                {
                "country": "{{$y}}",
                "visits": {{$v}}
                },
            @endforeach
        ];
}
        var year_categoryAxis = chart_year.xAxes.push(new am4charts.CategoryAxis());
        year_categoryAxis.dataFields.category = "country";
        year_categoryAxis.renderer.grid.template.location = 0;
        year_categoryAxis.renderer.minGridDistance = 30;
        year_categoryAxis.renderer.labels.template.adapter.add("dy", function(dy, target) {return dy;});
        var year_valueAxis = chart_year.yAxes.push(new am4charts.ValueAxis());
        var year_series = chart_year.series.push(new am4charts.ColumnSeries());
        year_series.dataFields.valueY = "visits";
        year_series.dataFields.categoryX = "country";
        year_series.name = "Visits";
        year_series.columns.template.tooltipText = "{categoryX}: [bold]{valueY}[/]";
        year_series.columns.template.fillOpacity = .8;
        year_series.columns.template.stroke = "#1BC5BD";
        year_series.columns.template.fill = "#1BC5BD";
        var year_columnTemplate = year_series.columns.template;
        year_columnTemplate.strokeWidth = 2;
        year_columnTemplate.strokeOpacity = 1;
        // Add events
        year_categoryAxis.renderer.labels.template.events.on("hit", highlighColumn);
        year_categoryAxis.renderer.labels.template.cursorOverStyle = am4core.MouseCursorStyle.pointer;


        function highlighColumn(ev) {
            console.log(ev);


            if(ev === 'male'){
                $("#gender_top").html('male');
            }

            if(ev === 'female'){
                $("#gender_top").html('female');
            }


            if(ev !== 'male' && ev !== 'female'){

                if(ev.event.path[20].id == 'chart_year'){
                $("#year_top").html(ev.target.currentText);
                }
                if(ev.event.path[20].id == 'chart_months'){
                    $("#months_top").html(ev.target.currentText);
                }
                if(ev.event.path[22].id == 'chart_procedure'){
                    $("#procedure_top").html(ev.target.currentText);
                }
                if(ev.event.path[20].id == 'chart_gender'){
                    $("#gender_top").html(ev.target.currentText);
                }
                if(ev.event.path[20].id == 'chart_icd10'){
                    $("#icd10_top").html(ev.target.currentText);
                }
                if(ev.event.path[20].id == 'chart_icd09'){
                    $("#icd9_top").html(ev.target.currentText);
                }
                if(ev.event.path[20].id == 'chart_diagnostic'){
                    $("#prediagnostic_top").html(ev.target.currentText);
                }
                if(ev.event.path[20].id == 'chart_medication'){
                    $("#medication_top").html(ev.target.currentText);
                }
                if(ev.event.path[20].id == 'chart_scope'){
                    $("#scope_top").html(ev.target.currentText);
                }
                if(ev.event.path[20].id == 'chart_room'){
                    $("#room_top").html(ev.target.currentText);
                }

            }


            $.post("{{url('analytic')}}",{
                event                   : 'fillter',
                year                    : $("#year_top").html(),
                month                   : $("#months_top").html(),
                procedure               : $("#procedure_top").html(),
                icd10                   : $("#icd10_top").html(),
                icd9                    : $("#icd9_top").html(),
                prediagnostic           : $("#prediagnostic_top").html(),
                medication              : $("#medication_top").html(),
                scope                   : $("#scope_top").html(),
                room                    : $("#room_top").html()
            },function(data,status){
                var obj = JSON.parse(data);
                // console.log(obj);
                chart_months.data           = obj['month'];
                chart_year.data             = obj['year'];
                chart_procedure.data        = obj['procedure'];

                chart_icd10.data            = obj['icd10_show5'];
                chart_icd10_modal.data      = obj['icd10_showall'];

                chart_icd09.data            = obj['icd9_show5'];
                chart_icd09_modal.data      = obj['icd9_showall'];

                chart_diagnostic.data       = obj['prediagnostic_show5'];
                chart_diagnostic_modal.data = obj['prediagnostic_showall'];

                chart_medication.data       = obj['medication_show5'];
                chart_medication_modal.data = obj['medication_showall'];

                chart_room.data             = obj['room'];
                chart_scope.data            = obj['scope_show5'];
            });






            // console.log(ev.target.currentText);
            // console.log(ev.event.path[20].id);
        }


            var chart_months = am4core.create("chart_months", am4charts.XYChart);

            // Add data
            chart_months.data =
            [


            @foreach($month as $m => $v)
                {"country": "{{$m}}",
                "visits": {{$v}}
                },
            @endforeach
            ];

            var months_categoryAxis = chart_months.xAxes.push(new am4charts.CategoryAxis());
            months_categoryAxis.dataFields.category = "country";
            months_categoryAxis.renderer.grid.template.location = 0;
            months_categoryAxis.renderer.minGridDistance = 30;
            months_categoryAxis.renderer.labels.template.adapter.add("dy", function(dy, target) {return dy;});
            var months_valueAxis = chart_months.yAxes.push(new am4charts.ValueAxis());
            var months_series = chart_months.series.push(new am4charts.ColumnSeries());
            months_series.dataFields.valueY = "visits";
            months_series.dataFields.categoryX = "country";
            months_series.name = "Visits";
            months_series.columns.template.tooltipText = "{categoryX}: [bold]{valueY}[/]";
            months_series.columns.template.fillOpacity = .8;
            months_series.columns.template.stroke = "#1BC5BD";
            months_series.columns.template.fill = "#1BC5BD";
            var months_columnTemplate = months_series.columns.template;
            months_columnTemplate.strokeWidth = 2;
            months_columnTemplate.strokeOpacity = 1;
            // Add events

            // console.log(months_categoryAxis.renderer.labels.template.events)

            months_categoryAxis.renderer.labels.template.events.on("hit", highlighColumn);
            months_categoryAxis.renderer.labels.template.cursorOverStyle = am4core.MouseCursorStyle.pointer;

        </script>
<script>
    chart_age()
</script>
