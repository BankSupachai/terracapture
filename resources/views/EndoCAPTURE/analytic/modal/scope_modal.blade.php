<div class="modal fade" id="scope_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-body" style="min-height: 40em;">
          <div id="chart_scope_all"></div>
        </div>
        <div class="modal-footer p-0">
          <button type="button" class="btn btn-secondary w-100" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>


<script>
    am4core.ready(function() {
    am4core.useTheme(am4themes_animated);
    var chart = am4core.create("chart_scope_all", am4charts.XYChart);
    chart.data = [
        {
        "country": "3",
        "visits": 3
        },
    ];

        <?php
        /*
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
        */
        ?>

    var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
    categoryAxis.dataFields.category = "country";
    categoryAxis.renderer.grid.template.location = 0;
    categoryAxis.renderer.minGridDistance = 30;
    categoryAxis.renderer.labels.template.adapter.add("dy", function(dy, target) {
      return dy;
    });

    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

    // Create series
    var series = chart.series.push(new am4charts.ColumnSeries());
    series.dataFields.valueY = "visits";
    series.dataFields.categoryX = "country";
    series.name = "Visits";
    series.columns.template.tooltipText = "{categoryX}: [bold]{valueY}[/]";
    series.columns.template.fillOpacity = .8;
    series.columns.template.fill = am4core.color("#84e0db");
    series.columns.template.stroke = am4core.color("#2ccac1");

    var columnTemplate = series.columns.template;
    columnTemplate.strokeWidth = 2;
    columnTemplate.strokeOpacity = 1;
    });
</script>
