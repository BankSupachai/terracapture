














am4core.ready(function() {

    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end

    // Create chart instance
    var chart = am4core.create("chartreprocess", am4charts.XYChart);

    // Add data
    chart.data = [ {
      "year": "Clean",
      "Leake_test": 3,
      "Cleaning": 5,
      "AER": 24,
      "Drying": 3,
    }];
    chart.colors.list = [
        am4core.color("#83e0db"),
        am4core.color("#57bbb5"),
        am4core.color("#1f827c"),
        am4core.color("#374649"),
    ];
    // Create axes
    var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
    categoryAxis.dataFields.category = "year";
    categoryAxis.renderer.grid.template.location = 0;
    categoryAxis.renderer.minGridDistance = 20;
    // categoryAxis.renderer.cellStartLocation = 0.1;
    // categoryAxis.renderer.cellEndLocation = 0.9;

    var  valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
    // valueAxis.min = 0;

    // Create series
    function createSeries(field, name, stacked) {
      var series = chart.series.push(new am4charts.ColumnSeries());
      series.dataFields.valueY = field;
      series.dataFields.categoryX = "year";
      series.name = name;
      series.columns.template.tooltipText = "{categoryX}: [bold]{valueY}[/]";
      series.stacked = stacked;
      series.disabled  = false;
    //   series.legendSettings.labelText = "[bold {color}]{name}[/]";
      series.legendSettings.valueText = "{valueY.close}";
    //   series.columns.template.width = am4core.percent(95);
    }
    // var title = chart.titles.create();
    // title.text = "Average time";
    // // title.fontSize = 18;
    // title.layout = "absolute";
    // title.marginBottom = 0;
    // title.align = "right";

    // var label = chart.chartContainer.createChild(am4core.Label);
    // label.text = "Clean";
    // label.paddingLeft = 40;
    // label.layout = "absolute";
    // label.align = "center";



    // var topContainer = chart.chartContainer.createChild(am4core.Container);
    // topContainer.layout = "absolute";
    // topContainer.toBack();
    // topContainer.width = am4core.percent(100);

    // var dateTitle = topContainer.createChild(am4core.Label);
    // dateTitle.text = " Dirty";
    // dateTitle.paddingLeft = 40;
    // dateTitle.align = "center";



    createSeries("Leake_test", "Leake_test", true);
    createSeries("Cleaning", "Cleaning", true);
    createSeries("AER", "AER", true);
    createSeries("Drying", "Drying", true);

    // Add legend
    // chart.legend = new am4charts.Legend();
    // chart.legend.position = "right";
    // chart.legend.scrollable = true;
}); // end am4core.ready()




am4core.ready(function() {

    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end

    // Create chart instance
    var chart = am4core.create("chartstorage", am4charts.XYChart);

    // Add data
    chart.data = [{
      "country": "1",
      "visits": 6
    }];

    // Create axes

    var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
    categoryAxis.dataFields.category = "country";
    categoryAxis.renderer.grid.template.location = 0;
    categoryAxis.renderer.minGridDistance = 10;

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
    series.fill = am4core.color("#83e0db");
    series.stroke = am4core.color("#83e0db");

    var columnTemplate = series.columns.template;
    columnTemplate.strokeWidth = 2;
    columnTemplate.strokeOpacity = 1;

}); // end am4core.ready()






var chart = am4core.create("charttraining", am4charts.PieChart);

// Add data
chart.data = [{
  "country": "Trained",
  "value": 25
}, {
  "country": "Not trained",
  "value": 15
}];

// Add and configure Series
var pieSeries = chart.series.push(new am4charts.PieSeries());
pieSeries.dataFields.value = "value";
pieSeries.dataFields.category = "country";
pieSeries.labels.template.disabled = true;
pieSeries.ticks.template.disabled = true;
pieSeries.colors.list = [
    am4core.color("#83e0db"),
    am4core.color("#374649"),
];
chart.legend = new am4charts.Legend();
chart.legend.position = "bottom";

chart.innerRadius = am4core.percent(60);

var label = pieSeries.createChild(am4core.Label);
label.text = "{values.value.sum}Time";
label.horizontalCenter = "middle";
label.verticalCenter = "middle";
label.fontSize = 10;



am4core.ready(function() {

    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end

    // Create chart instance
    var chart = am4core.create("chartbartraining", am4charts.XYChart);

    // Add data
    chart.data = [{
      "country": "None Train",
      "visits": 6
    }];

    // Create axes

    var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
    categoryAxis.dataFields.category = "country";
    categoryAxis.renderer.grid.template.location = 0;
    categoryAxis.renderer.minGridDistance = 10;

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
    series.fill = am4core.color("grey");
    series.stroke = am4core.color("grey");

    var columnTemplate = series.columns.template;
    columnTemplate.strokeWidth = 2;
    columnTemplate.strokeOpacity = 1;

}); // end am4core.ready()






am4core.ready(function() {

    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end

    // Create chart instance
    var chart = am4core.create("chartpm", am4charts.XYChart);

    // Add data
    chart.data = [{
      "country": "Normal",
      "visits": 4
    }, {
      "country": "None-Critical",
      "visits": 5
    }, {
      "country": "Critical",
      "visits": 6
    }];

    // Create axes

    var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
    categoryAxis.dataFields.category = "country";
    categoryAxis.renderer.grid.template.location = 0;
    categoryAxis.renderer.minGridDistance = 0;
    // categoryAxis.renderer.labels.template.rotation = 20;
    categoryAxis.renderer.labels.template.adapter.add("dy", function(dy, target) {
        if (target.dataItem && target.dataItem.index & 2 == 2) {
            return dy + 25;
          }
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
    series.fill = am4core.color("#83e0db");
    series.stroke = am4core.color("#83e0db");

    var columnTemplate = series.columns.template;
    columnTemplate.strokeWidth = 2;
    columnTemplate.strokeOpacity = 1;

}); // end am4core.ready()




am4core.ready(function() {

    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end

    // Create chart instance
    var chart = am4core.create("chartpm01", am4charts.XYChart);

    // Add data
    chart.data = [{
      "country": "None PM",
      "visits": 6
    }];

    // Create axes

    var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
    categoryAxis.dataFields.category = "country";
    categoryAxis.renderer.grid.template.location = 0;
    categoryAxis.renderer.minGridDistance = 10;

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
    series.fill = am4core.color("grey");
    series.stroke = am4core.color("grey");

    var columnTemplate = series.columns.template;
    columnTemplate.strokeWidth = 2;
    columnTemplate.strokeOpacity = 1;

}); // end am4core.ready()





am4core.ready(function() {

    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end

    // Create chart instance
    var chart = am4core.create("chartrepair", am4charts.XYChart);

    // Add data
    chart.data = [ {
      "year": " ",
      "Mistake": 30,
      "Wear_and_Tears": 10
    }];
    chart.colors.list = [
        am4core.color("#83e0db"),
        am4core.color("#374649"),
    ];
    // Create axes
    var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
    categoryAxis.dataFields.category = "year";
    categoryAxis.renderer.grid.template.location = 0;
    categoryAxis.renderer.minGridDistance = 20;
    // categoryAxis.renderer.cellStartLocation = 0.1;
    // categoryAxis.renderer.cellEndLocation = 0.9;

    var  valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
    // valueAxis.min = 0;

    // Create series
    function createSeries(field, name, stacked) {
      var series = chart.series.push(new am4charts.ColumnSeries());
      series.dataFields.valueY = field;
      series.dataFields.categoryX = "year";
      series.name = name;
      series.columns.template.tooltipText = "{name}: [bold]{valueY}[/]";
      series.stacked = stacked;
      series.disabled  = false;
    //   series.columns.template.width = am4core.percent(95);
    }


    createSeries("Mistake", "Mistake", true);
    createSeries("Wear_and_Tears", "Wear_and_Tears", true);

    // Add legend
    // chart.legend = new am4charts.Legend();
    // chart.legend.position = "right";
    // chart.legend.scrollable = true;
}); // end am4core.ready()




am4core.ready(function() {

    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end

    // Create chart instance
    var chart = am4core.create("chartmp", am4charts.XYChart);

    // Add data
    var data = [
      {
        country: "Insertion tube peel off..",
        research: 10
      },
      {
        country: "Snake shape",
        research: 8
      },
      {
        country: "A-rubber is peel off..",
        research: 5
      },
      {
        country: "Angulation knob is loose",
        research: 2
      },
      {
        country: "Adjust angulation..",
        research: 2
      }
    ];

    chart.data = data;
    // Create axes
    var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
    categoryAxis.dataFields.category = "country";
    categoryAxis.renderer.grid.template.location = 0;
    categoryAxis.renderer.minGridDistance = 5;
    categoryAxis.interpolationDuration = 10;

    var valueAxis = chart.xAxes.push(new am4charts.ValueAxis());

    // Create series
    function createSeries(field, name) {
      var series = chart.series.push(new am4charts.ColumnSeries());
      series.dataFields.valueX = "research";
      series.dataFields.categoryY = "country";
      series.columns.template.tooltipText = "[bold]{valueX}[/]";
      series.columns.template.cursorOverStyle = am4core.MouseCursorStyle.pointer;
      series.fill = am4core.color("#83e0db");
      series.stroke = am4core.color("#83e0db");
      var hs = series.columns.template.states.create("hover");
      hs.properties.fillOpacity = 0.7;

      var columnTemplate = series.columns.template;
      columnTemplate.maxX = 0;
      columnTemplate.draggable = true;

      columnTemplate.events.on("dragstart", function (ev) {
        var dataItem = ev.target.dataItem;

        var axislabelItem = categoryAxis.dataItemsByCategory.getKey(
          dataItem.categoryY
        )._label;
        axislabelItem.isMeasured = false;
        axislabelItem.minX = axislabelItem.pixelX;
        axislabelItem.maxX = axislabelItem.pixelX;

        axislabelItem.dragStart(ev.target.interactions.downPointers.getIndex(0));
        axislabelItem.dragStart(ev.pointer);
      });
      columnTemplate.events.on("dragstop", function (ev) {
        var dataItem = ev.target.dataItem;
        var axislabelItem = categoryAxis.dataItemsByCategory.getKey(
          dataItem.categoryY
        )._label;
        axislabelItem.dragStop();
        handleDragStop(ev);
      });
    }
    createSeries("research", "Research");

    function handleDragStop(ev) {
      data = [];
      chart.series.each(function (series) {
        if (series instanceof am4charts.ColumnSeries) {
          series.dataItems.values.sort(compare);

          var indexes = {};
          series.dataItems.each(function (seriesItem, index) {
            indexes[seriesItem.categoryY] = index;
          });

          categoryAxis.dataItems.values.sort(function (a, b) {
            var ai = indexes[a.category];
            var bi = indexes[b.category];
            if (ai == bi) {
              return 0;
            } else if (ai < bi) {
              return -1;
            } else {
              return 1;
            }
          });

          var i = 0;
          categoryAxis.dataItems.each(function (dataItem) {
            dataItem._index = i;
            i++;
          });

          categoryAxis.validateDataItems();
          series.validateDataItems();
        }
      });
    }

    function compare(a, b) {
      if (a.column.pixelY < b.column.pixelY) {
        return 1;
      }
      if (a.column.pixelY > b.column.pixelY) {
        return -1;
      }
      return 0;
    }

}); // end am4core.ready()





am4core.ready(function() {

    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end

    // Create chart instance
    var chart = am4core.create("chartmp2", am4charts.XYChart);

    // Add data
    var data = [
      {
        country: "Chanel leak..",
        research: 10
      },
      {
        country: "Insertion tube has dent.",
        research: 8
      },
      {
        country: "Air water is block..",
        research: 5
      },
      {
        country: "Lightguide has broken.",
        research: 2
      },
      {
        country: "Brush struck..",
        research: 2
      }
    ];

    chart.data = data;
    // Create axes
    var categoryAxis = chart.yAxes.push(new am4charts.CategoryAxis());
    categoryAxis.dataFields.category = "country";
    categoryAxis.renderer.grid.template.location = 0;
    categoryAxis.renderer.minGridDistance = 5;
    categoryAxis.interpolationDuration = 10;

    var valueAxis = chart.xAxes.push(new am4charts.ValueAxis());

    // Create series
    function createSeries(field, name) {
      var series = chart.series.push(new am4charts.ColumnSeries());
      series.dataFields.valueX = "research";
      series.dataFields.categoryY = "country";
      series.columns.template.tooltipText = "[bold]{valueX}[/]";
      series.columns.template.cursorOverStyle = am4core.MouseCursorStyle.pointer;
      series.fill = am4core.color("#374649");
      series.stroke = am4core.color("#374649");
      var hs = series.columns.template.states.create("hover");
      hs.properties.fillOpacity = 0.7;

      var columnTemplate = series.columns.template;
      columnTemplate.maxX = 0;
      columnTemplate.draggable = true;

      columnTemplate.events.on("dragstart", function (ev) {
        var dataItem = ev.target.dataItem;

        var axislabelItem = categoryAxis.dataItemsByCategory.getKey(
          dataItem.categoryY
        )._label;
        axislabelItem.isMeasured = false;
        axislabelItem.minX = axislabelItem.pixelX;
        axislabelItem.maxX = axislabelItem.pixelX;

        axislabelItem.dragStart(ev.target.interactions.downPointers.getIndex(0));
        axislabelItem.dragStart(ev.pointer);
      });
      columnTemplate.events.on("dragstop", function (ev) {
        var dataItem = ev.target.dataItem;
        var axislabelItem = categoryAxis.dataItemsByCategory.getKey(
          dataItem.categoryY
        )._label;
        axislabelItem.dragStop();
        handleDragStop(ev);
      });
    }
    createSeries("research", "Research");

    function handleDragStop(ev) {
      data = [];
      chart.series.each(function (series) {
        if (series instanceof am4charts.ColumnSeries) {
          series.dataItems.values.sort(compare);

          var indexes = {};
          series.dataItems.each(function (seriesItem, index) {
            indexes[seriesItem.categoryY] = index;
          });

          categoryAxis.dataItems.values.sort(function (a, b) {
            var ai = indexes[a.category];
            var bi = indexes[b.category];
            if (ai == bi) {
              return 0;
            } else if (ai < bi) {
              return -1;
            } else {
              return 1;
            }
          });

          var i = 0;
          categoryAxis.dataItems.each(function (dataItem) {
            dataItem._index = i;
            i++;
          });

          categoryAxis.validateDataItems();
          series.validateDataItems();
        }
      });
    }

    function compare(a, b) {
      if (a.column.pixelY < b.column.pixelY) {
        return 1;
      }
      if (a.column.pixelY > b.column.pixelY) {
        return -1;
      }
      return 0;
    }

}); // end am4core.ready()
