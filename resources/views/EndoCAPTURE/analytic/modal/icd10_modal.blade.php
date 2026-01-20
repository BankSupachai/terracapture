<div class="modal fade" id="icd10_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="modal-body" style="min-height: 40em;">
          <div id="chart_icd10_modal"></div>
        </div>
        <div class="modal-footer p-0">
          <button type="button" class="btn btn-secondary w-100" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>


<script>
    am4core.useTheme(am4themes_animated);
    var chart = am4core.create("chart_icd10_modal", am4charts.XYChart);
    // Add data
    chart.data = [{
    "category": "K 01",
    "value": 15
    }, {
    "category": "K 02",
    "value": 12
    }, {
    "category": "K 03",
    "value": 10
    }, {
    "category": "K 04",
    "value": 8
    }, {
    "category": "K 05",
    "value": 6
    }];

    // Create axes
    var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
    categoryAxis.dataFields.category = "category";
    categoryAxis.renderer.grid.template.location = 0;

    var valueAxis = chart.xAxes.push(new am4charts.ValueAxis());
    valueAxis.renderer.minGridDistance = 30;
    valueAxis.renderer.labels.template.adapter.add("text", function(text, target) {
        return text && text.match(/\./) ? "" : text;
    });
    var series = chart.series.push(new am4charts.ColumnSeries());
    series.dataFields.valueX = "value";
    series.dataFields.categoryY = "category";
    series.columns.template.tooltipText = "{categoryY}: [bold]{valueX}[/]";
    series.columns.template.fillOpacity = .8;
    series.columns.template.fill = am4core.color("#84e0db");
    series.columns.template.stroke = am4core.color("#2ccac1");
</script>
