<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" > --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> --}}
    <link href="{{ asset('public/css/bootstrap5.3.3.min.css') }}" rel="stylesheet" type="text/css" />

    <style>
        @font-face {
            font-family: 'kanit';
            font-style: normal;
            font-weight: normal;
            src: url("{{ url('public/fonts/Kanit-Regular.ttf') }}") format("truetype");
        }

        @font-face {
            font-family: 'kanit';
            font-style: normal;
            font-weight: bold;
            src: url("{{ url('public/fonts/Kanit-Bold.ttf') }}") format("truetype");
        }

        @font-face {
            font-family: 'kanit';
            font-style: italic;
            font-weight: normal;
            src: url("{{ url('public/fonts/Kanit-Italic.ttf') }}") format("truetype");
        }

        @font-face {
            font-family: 'kanit';
            font-style: italic;
            font-weight: bold;
            src: url("{{ url('public/fonts/Kanit-ExtraBoldItalic.ttf') }}") format("truetype");
        }

        * {
            font-family: 'kanit';
            color: #808080;
        }

        @media print {
            @page {
                size: landscape;
            }

            /* Force a page break after elements with the .page-break-after class */
            .page-break-after {
                break-after: page;
            }

            /* Force a page break before elements with the .page-break-before class */
            .page-break-before {
                break-before: page;
            }

            /* Avoid breaking inside elements with the .avoid-page-break class */
            .avoid-page-break {
                break-inside: avoid;
            }
        }

        html,
        body {
            width: 276mm;
            height: 190mm;
        }

        :root {
            --vz-blue: #000000 !important;

        }



        /* table {
        width: 100%;
        border-collapse: collapse;
    }
    table, th, td {
        border: 1px solid #ddd;
        font-size:9px;
    }
    th, td {
        padding: 8px;
        text-align: center;
    }
    th {
        background-color: #f2f2f2;
    } */

        .footer {
            text-align: center;
            margin-top: 20px;
        }

        .fs-16 {
            font-size: 16px;
        }

        .fs-14 {
            font-size: 14px;
        }
    </style>
</head>
@php
    $this_month = @$this_month . '' != 'false' ? $this_month : '';
@endphp

<button id="button" hidden>Generate PDF</button>

{{-- <div class="card m-3" id="makepdf" style="border: 0"> --}}
<div class=" ms-3 mt-3" style="border: 0">
    <div class="row p-2">
        <div class="col-auto ">
            <img src="{{ url('public/images/medicalogo.png') }}" height="70" alt="">
        </div>
        <div class="col-6 align-self-center">
            <span class="fw-bold">โรงพยาบาลเมดิกา เฮลท์แคร์ จำกัด <br></span>
            <span> หน่วยส่องกล้องทางเดินอาหาร (Endoscopy Center) </span>
        </div>
        <div class="col-4 text-end align-self-center">
            <div class=" h5">Room Summary Report</div>
            <p class="text-danger m-0 fs-16">Period : @if (isset($this_month) && @$this_month != '')
                    <span class="text-danger fs-16">{{ @$this_month }}/</span>
                @endif <span class="text-danger fs-16">{{ @$this_year . '' }}</span></p>
        </div>

    </div>



    <hr class="my-1">

    <div class="fs-14">
        <p class="m-0">Summary Form: <span>{{ @$this_type }}</span></p>
        <p class="m-0">Calculated from: Time Stamp(Patient in) - Time Stamp(Patient out)</p>
    </div>
    <div class="page-break-after">

        @php
            $total = [];
            $total_cases_all = [];
            $total_procedure = [];
            $total_procedure_all = [];
        @endphp

        <table class="table table-nowrap mt-2 fs-14" id="{{ @$tbody_id }}_div">
            <thead class="table-light">
                <tr>
                    <td class="text-start" style="width: 25%;">Room/Month</td>
                    @foreach (isset($this_col) ? $this_col : [] as $col)
                        @if (isset($this_month))
                            @php
                                $exclude = [];
                                $col = isset($col) ? strval($col) : '';
                                if ($this_month == '02') {
                                    $exclude = ['29', '30', '31'];
                                } elseif (in_array($this_month, ['04', '06', '09', '11'])) {
                                    $exclude = ['31'];
                                }

                                if (in_array($col, $exclude)) {
                                    continue;
                                }

                                $total[] = $col;
                            @endphp
                        @else
                            @php
                                $total[] = $col;
                            @endphp
                        @endif
                        <td>{{ @$col }}</td>
                    @endforeach
                    <td>Total</td>
                </tr>
            </thead>
            <tbody id="{{ @$tbody_id }}">
                @foreach (isset($rooms) ? $rooms : [] as $room)
                    @php
                        $sum = 0;
                        $total_sum = 0;

                        $room_name = isset($room) ? $room : '';
                        if (!isset($room_name)) {
                            continue;
                        }
                        $total_procedure[] = $room_name;
                    @endphp
                    <tr>
                        <td class="text-start">{{ @$room_name }}</td>
                        @for ($i = 0; $i < count($total); $i++)
                            @php
                                $case_num = isset($data[$this_year][$total[$i]][$room_name])
                                    ? $data[$this_year][$total[$i]][$room_name]
                                    : 0;
                                $sum += $case_num;
                            @endphp
                            <td>{{ @round($case_num) }}</td>
                        @endfor
                        <td>{{ @round($round) }}</td>
                        @php
                            $total_procedure_all[] = isset($sum) ? $sum : 0;
                        @endphp
                    </tr>
                @endforeach

                <tr>
                    <td class="text-end">Total</td>
                    @for ($j = 0; $j < count($total); $j++)
                        @php
                            $total_cases = 0;
                            if (is_array($data[$this_year][$total[$j]])) {
                                $total_cases = array_sum($data[$this_year][$total[$j]]);
                                $total_cases_all[] = number_format($total_cases, 1);
                            }
                            $total_sum += $total_cases;
                        @endphp

                        <td>{{ @round($total_cases) }}</td>
                    @endfor
                    <td>{{ @round($total_sum) }}</td>
                </tr>
            </tbody>
        </table>

    </div>

    <div class=" row my-3">
        <div class="col-6" style="border: 1px solid #E9EBEC;height:300px;">
            <div class="card-body p-0 chart-div">
                <div id="line_case" data-colors='["--vz-primary", "--vz-success", "--vz-warning", "--vz-danger"]'
                    class="apex-charts chart" dir="ltr"></div>
            </div>
        </div>
        <div class="col-6">
            <div class="card-body p-0 " style="border: 1px solid #E9EBEC;height:300px">
                <div id="column_proc" data-colors='["--vz-primary", "--vz-success", "--vz-warning", "--vz-danger"]'
                    class="apex-charts chart" dir="ltr"></div>
            </div>
        </div>
    </div>

    @php
        $date_type = $have_month == 'true' ? 'Month' : 'Year';
    @endphp


    <div class="row my-3 p-0 avoid-page-break" style="border: 1px solid #E9EBEC;height:320px">
        <div id="column_age" data-colors='["--vz-primary", "--vz-success", "--vz-warning", "--vz-danger"]'
            class="apex-charts chart" dir="ltr"></div>
    </div>
    <div class="row my-3 p-0 page-break avoid-page-break" style="border: 1px solid #E9EBEC;height:320px">
        <div id="bar_line" data-colors='["--vz-primary", "--vz-success", "--vz-warning", "--vz-danger"]'
            class="apex-charts chart" dir="ltr"></div>
    </div>
</div>
<script src="{{ url('assets/libs/cleave.js/cleave.min.js') }}"></script>
<script src="{{ url('assets/libs/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ url('assets/js/pages/form-masks.init.js') }}"></script>
<script src="{{ url('assets/libs/chart.js/chart.min.js') }}"></script>
<script src="{{ url('assets/js/pages/chartjs.init.js') }}"></script>
<script src="{{ url('assets/js/pages/apexcharts-pie.init.js') }}"></script>
<script src="{{ url('assets/js/pages/apexcharts-bar.init.js') }}"></script>
<script src="{{ url('assets/js/pages/apexcharts-column.init.js') }}"></script>
<script src="{{ url('assets/js/pages/apexcharts-radialbar.init.js') }}"></script>
<script src="{{ url('public/js/html2pdf.min.js') }}"></script>
<script src="{{ url('public/crop_img/jquery.min.js') }}"></script>
<script src="{{ asset('public/js/moment.min.js') }}"></script>
<script src="{{ asset('public/js/bootstrap5.3.3.bundle.min.js') }}"></script>
<script>
    let button = document.getElementById("button");
    let makepdf = document.getElementById("makepdf");
    var total_chart = document.getElementsByClassName('chart').length
    var chart_rendered = 0

    setTimeout(() => {
        try {
            window.close();
        } catch (e) {
            console.log("The tab could not be closed programmatically due to browser security settings.");
        }
    }, 1000);

    function finishRendering() {
        chart_rendered++;
        $('.apexcharts-toolbar').css('display', 'none')
        setTimeout(() => {
            // checkAllChartsRendered()

        }, 1000);
        console.log(chart_rendered, 'total');
    }

    $(button).on('click', function() {
        console.log('click!');
        var opt = {
            filename: 'myfile.pdf',
            image: {
                type: 'png',
                quality: 0.98
            },
            html2canvas: {
                scale: 1
            },
            jsPDF: {
                unit: 'in',
                format: 'a4',
                orientation: 'l'
            },
            pagebreak: {
                before: '.page-break',
                avoid: ['.chart']
            }
        };
        html2pdf().set(opt).from(makepdf).save();
    })



    function checkAllChartsRendered() {
        console.log(chart_rendered);
        if (chart_rendered === total_chart) {
            var opt = {
                filename: 'myfile.pdf',
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 1
                },
                jsPDF: {
                    unit: 'in',
                    format: 'a4',
                    orientation: 'l'
                },
                pagebreak: {
                    before: '.page-break',
                    avoid: ['.chart']
                }
            };
            html2pdf().set(opt).from(makepdf).save();
            setTimeout(() => {
                try {
                    window.close();
                } catch (e) {
                    console.log(
                        "The tab could not be closed programmatically due to browser security settings.");
                }
            }, 1000);
        }
    }

    var cases_y = @json($total_cases_all);
    var cases_x = @json($total);
    console.log(cases_y);

    var options = {
        series: [{
            name: "Total cases",
            data: cases_y,

        }],
        chart: {
            height: 300,
            type: 'line',
            zoom: {
                enabled: false
            },
            animations: {
                enabled: false,
            },
        },
        dataLabels: {
            enabled: false
        },
        colors: ['#245788'],
        stroke: {
            curve: 'smooth'
        },
        title: {
            text: 'Total Cases in {{ @$date_type }}',
            align: 'left',
            margin: 5,
            style: {
                fontSize: '12px',
                fontWeight: 'normal',
                fontFamily: 'kanit',
                color: '#808080'
            },
            xaxis: {
                categories: cases_x,
                tickAmount: 4,
            },
            yaxis: {
                labels: {
                    formatter: (val) => {
                        return parseFloat(val).toFixed(0);
                        console.log(parseFloat(val).toFixed(0));
                    },
                }
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return parseFloat(val).toFixed(1)
                    }
                }
            }
        }
    }

    var chart = new ApexCharts(document.querySelector("#line_case"), options);
    chart.render().then(() => finishRendering());
</script>

<script>
    var procedure_y = @json($total_procedure_all);
    var procedure_x = @json($total_procedure);
    var options = {
        series: [{
            name: 'Total hour',
            data: procedure_y
        }, ],
        chart: {
            type: 'bar',
            height: 300,
            animations: {
                enabled: false,
            },
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                endingShape: 'rounded'
            },
        },
        dataLabels: {
            enabled: false
        },
        colors: ["#245788"],
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        xaxis: {
            categories: procedure_x,
        },
        yaxis: {
            labels: {
                formatter: (val) => {
                    return parseFloat(val).toFixed(0)
                },
            }
        },
        fill: {
            opacity: 1
        },
        title: {
            text: 'Room usage (hours) in {{ @$date_type }}',
            align: 'left',
            margin: 5,
            style: {
                fontSize: '12px',
                fontWeight: 'normal',
                fontFamily: 'kanit',
                color: '#808080'
            },
        },
        tooltip: {
            y: {
                formatter: function(val) {
                    return parseFloat(val).toFixed(1)
                }
            }
        },
    };

    var chart = new ApexCharts(document.querySelector("#column_proc"), options);
    chart.render().then(() => finishRendering());
</script>

<script>
    var hours = @json($hours);
    var countcase = @json($count_case);
    var options = {
        series: [{
            name: 'Mon.',
            data: countcase['mon']
        }, {
            name: 'Tue.',
            data: countcase['tue']
        }, {
            name: 'Wed.',
            data: countcase['wed']
        }, {
            name: 'Thus.',
            data: countcase['thu']
        }, {
            name: 'Fri.',
            data: countcase['fri']
        }, {
            name: 'Sat.',
            data: countcase['sat']
        }, {
            name: 'Sun.',
            data: countcase['sun']
        }],
        chart: {
            type: 'bar',
            stacked: true,
            height: 300,
            width: '100%',
            animations: {
                enabled: false,
            },
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '55%',
                endingShape: 'rounded'
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        xaxis: {
            categories: hours,
        },
        yaxis: {
            title: {
                text: ''

            },
            labels: {
                formatter: function(value) {
                    return Math.floor(value);
                }
            }
        },
        fill: {
            opacity: 1,
            colors: ['#F7B84B', '#FF7F9F', '#0AB39C', '#F06548', '#299CDB', '#245788', '#212529'],
        },
        tooltip: {
            y: {
                formatter: function(val) {
                    return val + " เคส"
                }
            }
        },
        legend: {
            show: true,
            position: 'right',
            horizontalAlign: 'center',
        },
        //  colors: ['#05445E', '#189AB4', '#75E6DA', '#21B6A8', '#A3EBB1', '#18A558'],
        colors: ['#F7B84B', '#FF7F9F', '#0AB39C', '#F06548', '#299CDB', '#245788', '#212529'],
        title: {
            text: 'Room usage (Period) in Month',
            align: 'left',
            margin: 5,
            style: {
                fontSize: '12px',
                fontWeight: 'normal',
                fontFamily: 'kanit',
                color: '#808080'
            },
        },
    };

    var chart = new ApexCharts(document.querySelector("#column_age"), options);
    chart.render().then(() => finishRendering());
</script>

@php
    $casetime_array = $casetime ?? [];
    $count_timecase = $casetime['case'] ?? [];
    $count_time = $casetime['time'] ?? [];

    if (count($this_col) == 12) {
        $this_col = array_map(function ($this_col) {
            $date = DateTime::createFromFormat('m', $this_col);
            return $date->format('M');
        }, $this_col);
    }
@endphp

<script>
    var times = @json($this_col);
    var count_case = @json($count_timecase);
    var count_time = @json($count_time);

    var options = {
        series: [{
            name: 'Room usage (Minutes/ cases)',
            type: 'column',
            data: count_time,
        }, {
            name: 'Cases',
            type: 'line',
            data: count_case,
        }],
        chart: {
            height: 300,
            type: 'line',
            animations: {
                enabled: false,
            },
        },
        stroke: {
            width: [0, 4]
        },
        title: {
            text: 'Room usage (Minutes/ cases) in year/month'
        },
        dataLabels: {
            enabled: true,
            enabledOnSeries: [1]
        },
        labels: times,
        xaxis: {
            // type: 'datetime',
        },
        yaxis: [{
            title: {
                text: 'Usage time (min)',
                align: 'left',
                margin: 5,
                style: {
                    fontSize: '12px',
                    fontWeight: 'normal',
                    fontFamily: undefined,
                    color: '#ADB5BD'
                },
            },
            labels: {
                formatter: function(value) {
                    return Math.floor(value);
                }
            }

        }, {
            opposite: true,
            title: {
                text: 'Cases',
                align: 'left',
                margin: 5,
                style: {
                    fontSize: '12px',
                    fontWeight: 'normal',
                    fontFamily: undefined,
                    color: '#ADB5BD'
                },
            },
            labels: {
                formatter: function(value) {
                    return Math.floor(value);
                }
            }
        }],
        legend: {
            show: true,
            position: 'bottom',
            horizontalAlign: 'center',
        },
        colors: ['#245788', '#0AB39C'],
        title: {
            text: 'Total Room usage (Hours) in Month',
            align: 'left',
            margin: 5,
            style: {
                fontSize: '12px',
                fontWeight: 'normal',
                fontFamily: undefined,
                color: '#ADB5BD'
            },
        },
    };

    var chart = new ApexCharts(document.querySelector("#bar_line"), options);
    chart.render().then(() => finishRendering());
</script>


</body>

</html>
