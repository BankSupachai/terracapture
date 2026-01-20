<div class="card">
    <div class="card-header ribbon ribbon-top">
        <div class="ribbon-target bg-warning" style="top: -2px; left: 20px;">
            <i class="fas fa-undo text-light"></i>
        </div>
        <div class="col-12 text-center">
            เพศ และ อายุ   <a id="male">male</a> &nbsp; <a id="female">female</a>
        </div>
    </div>
    <div class="card-body">
        <div id="chart_gender" style="height: 250px;"></div>
    </div>
</div>




    <script>

        $('#male').click(function () {
            // alert('male');
            highlighColumn('male');
        });

        $('#female').click(function () {
            // alert('female');
            highlighColumn('female');
        });



        var chart_gender = am4core.create('chart_gender', am4charts.XYChart)
        chart_gender.colors.step = 2;
        chart_gender.legend = new am4charts.Legend()
        chart_gender.legend.position = 'top'
        chart_gender.legend.paddingBottom = 20
        chart_gender.legend.labels.template.maxWidth = 95

        var xAxis = chart_gender.xAxes.push(new am4charts.CategoryAxis())
        xAxis.dataFields.category = 'category'
        xAxis.renderer.cellStartLocation = 0.1
        xAxis.renderer.cellEndLocation = 0.9
        xAxis.renderer.grid.template.location = 0;

        var yAxis = chart_gender.yAxes.push(new am4charts.ValueAxis());
        yAxis.min = 0;

        function createSeries(value, name) {
            var series = chart_gender.series.push(new am4charts.ColumnSeries())
            series.dataFields.valueY = value
            series.dataFields.categoryX = 'category'
            series.name = name

            series.events.on("hidden", arrangeColumns);
            series.events.on("shown", arrangeColumns);




            var bullet = series.bullets.push(new am4charts.LabelBullet())
            bullet.interactionsEnabled = false
            bullet.dy = 30;
            bullet.label.text = '{valueY}'
            bullet.label.fill = am4core.color('#ffffff')

            return series;
        }

        chart_gender.data = [
            @foreach($age as $a =>$v)
                {
                    category: '{{$a}}',
                    first   : @php echo $v['male']; @endphp,
                    second  : @php echo $v['female']; @endphp,
                },
            @endforeach
        ]



        createSeries('first', 'ชาย');
        createSeries('second', 'หญิง');


        xAxis.renderer.labels.template.events.on("hit", highlighColumn);
        console.log(xAxis.renderer);

        xAxis.renderer.labels.template.cursorOverStyle = am4core.MouseCursorStyle.pointer;



        function arrangeColumns() {



            var series = chart_gender.series.getIndex(0);

            var w = 1 - xAxis.renderer.cellStartLocation - (1 - xAxis.renderer.cellEndLocation);
            if (series.dataItems.length > 1) {
                var x0 = xAxis.getX(series.dataItems.getIndex(0), "categoryX");
                var x1 = xAxis.getX(series.dataItems.getIndex(1), "categoryX");

                var delta = ((x1 - x0) / chart_gender.series.length) * w;
                if (am4core.isNumber(delta)) {
                    var middle = chart_gender.series.length / 2;

                    var newIndex = 0;
                    chart_gender.series.each(function(series) {
                        if (!series.isHidden && !series.isHiding) {
                            series.dummyData = newIndex;
                            newIndex++;
                        }
                        else {
                            series.dummyData = chart_gender.series.indexOf(series);
                        }
                    })

                    var visibleCount = newIndex;
                    var newMiddle = visibleCount / 2;

                    chart_gender.series.each(function(series) {
                        var trueIndex = chart_gender.series.indexOf(series);
                        var newIndex = series.dummyData;

                        var dx = (newIndex - trueIndex + middle - newMiddle) * delta

                        series.animate({ property: "dx", to: dx }, series.interpolationDuration, series.interpolationEasing);
                        series.bulletsContainer.animate({ property: "dx", to: dx }, series.interpolationDuration, series.interpolationEasing);
                    })
                }
            }
        }

    </script>
