@extends('layouts.index')

@section('style')
<style>
    .dot-success{
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: greenyellow;
    }
    .dot-grey{
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: grey;
    }
    .w-comtent{
        width: fit-content;
        padding: 2px 5px;
    }
    #scope ,#procedure_chart{
        width: 100%;
        height: 250px;
    }
    #icd10,#icd9{
        width: 100%;
        height: 100%;
    }
    g[aria-labelledby^="id-"]{
        display: none;
    }
    .set-b{
        margin-top: -15px;
    }
    .aside-fixed .wrapper {
        padding-left: 0px !important;
    }
</style>
@endsection

@section('modal')

@endsection



@section('content')
<div class="p-2">
    <div class="row m-0">
        <div class="col-lg-6 p-0">
            <div class="row m-0">
                <div class="col-lg-4 p-1 text-center">
                    <div class="card">
                        <div class="card-body">
                            <img src="{{url("public/image/rama.gif")}}" alt="" srcset="" style="width: 150px;">
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 p-1">
                    <div class="card rounded-0 h-100">
                        <div class="card-body">
                            <div class="row m-0 h-100">
                                <div class="col-6 m-auto">
                                    <div class="row m-0 h3 text-center">
                                        <div class="col-lg-12">2240</div>
                                    </div>
                                </div>
                                <div class="col-6 m-auto">
                                    <div class="row m-0 h3 text-center">
                                        <div class="col-lg-12">30</div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 text-center">
                                    <div class="h3 set-b">คนไข้ทั้งหมด</div>
                                </div>
                                <div class="col-lg-6 text-center">
                                    <div class="h3 set-b">คนไข้วันนี้</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 p-0">
            <div class="row m-0 h-100">
                <div class="col-lg-3 p-1">
                    <div class="card rounded-0 h-100">
                        <div class="card-body text-center">
                            <div class="row m-0 h3 text-center h-100">
                                <div class="col-lg-12 m-auto">30</div>
                            </div>
                            <div class="h3 set-b">รอทำหัตถการ</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 p-1">
                    <div class="card rounded-0 h-100">
                        <div class="card-body text-center">
                            <div class="row m-0 h3 text-center h-100">
                                <div class="col-lg-12 m-auto">0</div>
                            </div>
                            <div class="h3 set-b">กำลังทำหัตถการ</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 p-1">
                    <div class="card rounded-0 h-100">
                        <div class="card-body text-center">
                            <div class="row m-0 h3 text-center h-100">
                                <div class="col-lg-12 m-auto">0</div>
                            </div>
                            <div class="h3 set-b">พักฟื้น</div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 p-1">
                    <div class="card rounded-0 h-100">
                        <div class="card-body text-center">
                            <div class="row m-0 h3 text-center h-100">
                                <div class="col-lg-12 m-auto">0</div>
                            </div>
                            <div class="h3 set-b">ส่งกลับ</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row m-0 mt-1">
        <div class="col-lg-9 p-1">
            <div class="card rounded-0">
                <div class="card-body">
                    <div class="row m-0">
                        <div class="col-lg-2 m-auto">
                            <div class="row m-0">
                                <div class="col-lg-2">ปี</div>
                                <div class="col-lg-10"><select name="" id="" class="form-control form-control-sm"><option value="">2021</option></select></div>
                            </div>
                            <div class="row m-0 mt-5 mb-3 text-center">
                                <div class="col-lg-12 h2 pt-5 pb-5">1740</div>
                            </div>
                            <div class="row m-0 text-center">
                                <div class="col-lg-12 h4">เคสทั้งหมด</div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div id="procedure_chart"></div>
                        </div>
                        <div class="col-lg-3">
                            <div id="icd10"></div>
                        </div>
                        <div class="col-lg-3">
                            <div id="icd9"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 p-1">
            <div class="card rounded-0 h-100">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <h5>Endoscopist</h5>
                            นายเเพทย์ 1 <br>
                            นายเเพทย์ 2 <br>
                            นายเเพทย์ 3
                        </div>
                        <div class="col-lg-6">
                            <h5>จำนวนหัตถการ</h5>
                            1290 <br>
                            540 <br>
                            120
                        </div>
                        <div class="col-lg-6">
                            <h5>Nurse</h5>
                            พยาบาล 1 <br>
                            พยาบาล 2 <br>
                            พยาบาล 3
                        </div>
                        <div class="col-lg-6">
                            <h5>จำนวนหัตถการ</h5>
                            2400<br>
                            542 <br>
                            232
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row m-0 mt-1">
        <div class="col-lg-9 p-0">
            <div class="row m-0">
                <div class="col-lg-2 p-1">
                    <div class="card rounded-0 h-100">
                        <div class="card-body">
                            <div class="row m-0">
                                <div class="col-lg-12 h4">Room</div>
                            </div>
                            <div class="row m-0">
                                <div class="col-lg-9 mt-2">Room 1</div>
                                <div class="col-lg-3 mt-2 text-right"><div class="dot-success"></div></div>
                                <div class="col-lg-9 mt-2">Room 2</div>
                                <div class="col-lg-3 mt-2 text-right"><div class="dot-success"></div></div>
                                <div class="col-lg-9 mt-2">Room 3</div>
                                <div class="col-lg-3 mt-2 text-right"><div class="dot-success"></div></div>
                                <div class="col-lg-9 mt-2">Room 4</div>
                                <div class="col-lg-3 mt-2 text-right"><div class="dot-success"></div></div>
                                <div class="col-lg-9 mt-2">ERCP room</div>
                                <div class="col-lg-3 mt-2 text-right"><div class="dot-grey"></div></div>
                                <div class="col-lg-9 mt-2">EUS room</div>
                                <div class="col-lg-3 mt-2 text-right"><div class="dot-grey"></div></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 p-1">
                    <div class="card rounded-0 h-100">
                        <div class="card-body p-0">
                            <div id="scope"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5 p-1">
                    <div class="card rounded-0 h-100">
                        <div class="card-body">
                            <div class="row m-0">
                                <div class="col-lg-6 border-right">
                                    <div class="row m-0">
                                        <div class="col-lg-12 text-center">สินค้าที่ใกล้หมดอายุ</div>
                                        <div class="col-lg-12 text-center">(Due date stock)</div>
                                    </div>
                                    <div class="row m-0 mt-2">
                                        <div class="col-lg-6">Name</div>
                                        <div class="col-lg-6">Duedate</div>
                                        <div class="col-lg-6">Biopsy EGD 2.8</div>
                                        <div class="col-lg-6 text-right">10-04-2021</div>
                                        <div class="col-lg-6">Biopsy EGD 3.2</div>
                                        <div class="col-lg-6 text-right">15-04-2021</div>
                                        <div class="col-lg-6">Heamoclip </div>
                                        <div class="col-lg-6 text-right">25-05-2021</div>
                                        <div class="col-lg-6">Heamoclip</div>
                                        <div class="col-lg-6 text-right">27-05-2021</div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="row m-0">
                                        <div class="col-lg-12 text-center">สินค้าที่ใกล้หมดคลัง</div>
                                        <div class="col-lg-12 text-center">(Safety stock)</div>
                                    </div>
                                    <div class="row m-0 mt-2">
                                        <div class="col-lg-6">Name</div>
                                        <div class="col-lg-6">Price</div>
                                        <div class="col-lg-6">Guidewire </div>
                                        <div class="col-lg-6 text-right">1</div>
                                        <div class="col-lg-6">Heamoclip</div>
                                        <div class="col-lg-6 text-right">2</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 p-1">
            <div class="card rounded-0 h-100">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">Cabinet</div>
                        <table class="table table-borderless">
                            <tr>
                                <td></td>
                                <td><i class="fas fa-thermometer-three-quarters"></i></td>
                                <td><i class="fas fa-tint"></i></td>
                                <td><i class="fas fa-tachometer-alt"></i></td>
                                <td>Slot</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>Cabinet 1</td>
                                <td>27 C</td>
                                <td>40%</td>
                                <td>1 Pa</td>
                                <td>8/10</td>
                                <td><span class="label label-rounded label-success w-comtent">Normal</span></td>
                            </tr>
                            <tr>
                                <td>Cabinet 2</td>
                                <td>27 C</td>
                                <td>40%</td>
                                <td>1 Pa</td>
                                <td>3/10</td>
                                <td><span class="label label-rounded label-success w-comtent">Normal</span></td>
                            </tr>
                            <tr>
                                <td>Cabinet 3</td>
                                <td>27 C</td>
                                <td>40%</td>
                                <td>1 Pa</td>
                                <td>0/10</td>
                                <td><span class="label label-rounded label-danger w-comtent">Abnormal</span></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection



@section('script')
<script src="{{url('public/js/core.js')}}"></script>
<script src="{{url('public/js/charts.js')}}"></script>
<script src="{{url('public/js/animated.js')}}"></script>

<script>
    am4core.ready(function() {

    // Themes begin
    am4core.useTheme(am4themes_animated);
    // Themes end

    // Create chart instance
    var chart = am4core.create("scope", am4charts.PieChart);

    // Add and configure Series
    var pieSeries = chart.series.push(new am4charts.PieSeries());
    pieSeries.dataFields.value = "litres";
    pieSeries.dataFields.category = "country";

    // Let's cut a hole in our Pie chart the size of 30% the radius
    chart.innerRadius = am4core.percent(30);

    // Put a thick white border around each Slice
    pieSeries.slices.template.stroke = am4core.color("#fff");
    pieSeries.slices.template.strokeWidth = 2;
    pieSeries.slices.template.strokeOpacity = 1;
    pieSeries.slices.template.propertyFields.fill = "color";
    pieSeries.slices.template
      // change the cursor on hover to make it apparent the object can be interacted with
      .cursorOverStyle = [
        {
          "property": "cursor",
          "value": "pointer"
        }
      ];

    pieSeries.alignLabels = false;
    pieSeries.labels.template.bent = true;
    pieSeries.labels.template.radius = 3;
    pieSeries.labels.template.padding(0,0,0,0);

    pieSeries.ticks.template.disabled = true;

    // Create a base filter effect (as if it's not there) for the hover to return to
    var shadow = pieSeries.slices.template.filters.push(new am4core.DropShadowFilter);
    shadow.opacity = 0;

    // Create hover state
    var hoverState = pieSeries.slices.template.states.getKey("hover"); // normally we have to create the hover state, in this case it already exists

    // Slightly shift the shadow and make it more prominent on hover
    var hoverShadow = hoverState.filters.push(new am4core.DropShadowFilter);
    hoverShadow.opacity = 0.7;
    hoverShadow.blur = 5;

    // Add a legend
    chart.legend = new am4charts.Legend();
    chart.legend.align = "right";
    chart.legend.position = "right";
    chart.data = [{
      "country": "Operation",
      "litres": 25.6,
      "color": am4core.color("#6993FF")
    },{
      "country": "Avariable",
      "litres": 40.7,
      "color": am4core.color("#1BC5BD")
    }, {
      "country": "Reprocess",
      "litres": 23.8,
      "color": am4core.color("#FFA800")
    }, {
      "country": "Repair",
      "litres": 9.9,
      "color": am4core.color("#F64E60")
    }];

    }); // end am4core.ready()
</script>
<script>
    const primary = '#6993FF';
    const success = '#1BC5BD';
    const info = '#8950FC';
    const warning = '#FFA800';
    const danger = '#F64E60';
    const secondary = '#545b62';
    function generateBubbleData(baseval, count, yrange) {
    var i = 0;
    var series = [];
    while (i < count) {
      var x = Math.floor(Math.random() * (750 - 1 + 1)) + 1;;
      var y = Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;
      var z = Math.floor(Math.random() * (75 - 15 + 1)) + 15;

      series.push([x, y, z]);
      baseval += 86400000;
      i++;
    }
    return series;
  }

    function generateData(count, yrange) {
            var i = 0;
            var series = [];
            while (i < count) {
                var x = 'w' + (i + 1).toString();
                var y = Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;

                series.push({
                    x: x,
                    y: y
                });
                i++;
            }
            return series;
        }

        var KTApexChartsDemo = function () {
            var _demo4 = function () {
            const apexChart = "#procedure_chart";
            var options = {
                series: [{
                    name: 'ชาย',
                    data: [44, 55, 50, 60, 70]
                }, {
                    name: 'หญิง',
                    data: [53, 32, 35, 40, 60]
                }],
                chart: {
                    type: 'bar',
                    height: 350,
                    stacked: true,
                },
                plotOptions: {
                    bar: {
                        horizontal: true,
                    },
                },
                stroke: {
                    width: 1,
                    colors: ['#fff']
                },
                title: {
                    text: 'Fiction Books Sales'
                },
                xaxis: {
                    categories: ['EGD', 'Colonoscopy' ,'Bronchoscop' ,'ERCP' ,'EUS'],
                    labels: {
                        formatter: function (val) {
                            return val + "K"
                        }
                    }
                },
                yaxis: {
                    title: {
                        text: undefined
                    },
                },
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return val + "K"
                        }
                    }
                },
                fill: {
                    opacity: 1
                },
                legend: {
                    position: 'top',
                    horizontalAlign: 'left',
                    offsetX: 40
                },
                colors: [primary, success, warning, danger, info]
            };

            var chart = new ApexCharts(document.querySelector(apexChart), options);
            chart.render();
        }
        return {
            // public functions
            init: function () {
                _demo4();
            }
        };
    }();

    jQuery(document).ready(function () {
        KTApexChartsDemo.init();
    });
</script>
<script>
    am4core.ready(function() {

        // Themes begin
        am4core.useTheme(am4themes_animated);
        // Themes end

        // Create chart instance
        var chart = am4core.create("icd10", am4charts.XYChart);

        // Add percent sign to all numbers
        chart.numberFormatter.numberFormat = "#.#'%'";

        // Add data
        chart.data = [{
            "country": "A",
            "year2004": 3.5,
        }, {
            "country": "B",
            "year2004": 1.7,
        }, {
            "country": "C",
            "year2004": 2.8,
        }, {
            "country": "D",
            "year2004": 2.6,
        }, {
            "country": "E",
            "year2004": 1.4,
        }, {
            "country": "F",
            "year2004": 2.6,
        }];

        // Create axes
        var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "country";
        categoryAxis.renderer.grid.template.location = 0;
        categoryAxis.renderer.minGridDistance = 30;

        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
        valueAxis.title.text = "ICD-10";
        valueAxis.title.fontWeight = 800;

        // Create series
        var series = chart.series.push(new am4charts.ColumnSeries());
        series.dataFields.valueY = "year2004";
        series.dataFields.categoryX = "country";
        series.clustered = false;
        series.tooltipText = "GDP grow in {categoryX} (2004): [bold]{valueY}[/]";



        chart.cursor = new am4charts.XYCursor();
        chart.cursor.lineX.disabled = true;
        chart.cursor.lineY.disabled = true;

    }); // end am4core.ready()
</script>
<script>
    am4core.ready(function() {

        // Themes begin
        am4core.useTheme(am4themes_animated);
        // Themes end

        // Create chart instance
        var chart = am4core.create("icd9", am4charts.XYChart);

        // Add percent sign to all numbers
        chart.numberFormatter.numberFormat = "#.#'%'";

        // Add data
        chart.data = [{
            "country": "A",
            "year2004": 3.5,
        }, {
            "country": "B",
            "year2004": 1.7,
        }, {
            "country": "C",
            "year2004": 2.8,
        }, {
            "country": "D",
            "year2004": 2.6,
        }, {
            "country": "E",
            "year2004": 1.4,
        }, {
            "country": "F",
            "year2004": 2.6,
        }];

        // Create axes
        var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
        categoryAxis.dataFields.category = "country";
        categoryAxis.renderer.grid.template.location = 0;
        categoryAxis.renderer.minGridDistance = 30;

        var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());
        valueAxis.title.text = "ICD-9";
        valueAxis.title.fontWeight = 800;

        // Create series
        var series = chart.series.push(new am4charts.ColumnSeries());
        series.dataFields.valueY = "year2004";
        series.dataFields.categoryX = "country";
        series.clustered = false;
        series.tooltipText = "GDP grow in {categoryX} (2004): [bold]{valueY}[/]";



        chart.cursor = new am4charts.XYCursor();
        chart.cursor.lineX.disabled = true;
        chart.cursor.lineY.disabled = true;

    }); // end am4core.ready()
</script>
@endsection
