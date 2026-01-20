<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign In | EndoINDEX</title>
    @include("csrf.meta")
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <script src="{{ url('assets/js/layout.js') }}"></script>
    <link href="{{ url('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />

    <script src="{{ url('assets/js/jsmain.js') }}"></script>
    <script src="{{ url('assets/extra/select2/select2.min.js') }}"></script>

    <link rel="stylesheet" href="{{ url('assets/extra/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/libs/dropzone/dropzone.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ url('assets/libs/filepond/filepond.min.css') }}" type="text/css" />
    <link rel="stylesheet" href="{{ url('assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.css') }}">

    <link href="{{ url('public/css/input/main.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/libs/@simonwep/pickr/themes/classic.min.css') }}" rel="stylesheet" />
    <!-- 'classic' theme -->
    <link href="{{ url('assets/libs/@simonwep/pickr/themes/monolith.min.css') }}" rel="stylesheet" />
    <!-- 'monolith' theme -->
    <link href="{{ url('assets/libs/@simonwep/pickr/themes/nano.min.css') }}" rel="stylesheet" />
    <title>Document</title>
    <style>
        body {
            background: linear-gradient(-90deg, #193D61, #326172, #388397, #3B899B, #388397, #326172, #193D61);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;

        }

        * {
            font-family: 'Kanit', sans-serif !important;
            font-weight: normal !important;
            --vz-body-color: #495057;
        }

        @font-face {
            font-family: 'kanit';
            font-style: normal;
            font-weight: Light;
            src: url("{{ url('public/fonts/Kanit-Light.ttf') }}") format("truetype");
        }

        @font-face {
            font-family: 'kanit';
            font-style: normal;
            font-weight: bold;
            src: url("{{ url('public/fonts/Kanit-Bold.ttf') }}") format("truetype");
        }

        @font-face {
            font-family: 'kanit';
            font-weight: 400;
            src: url("{{ url('public/fonts/Kanit-Regular.ttf') }}") format("truetype");
        }

        @font-face {
            font-family: 'kanit';
            font-style: normal;
            font-weight: 500;
            src: url("{{ url('public/fonts/Kanit-Medium.ttf') }}") format("truetype");
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

        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .container {
            padding: 250px;
        }

        .box-white {
            background: #ffffff;
            width: 935px;
            height: 552px;
            position: absolute;
            top: 15%;
            left: 26%;
            border-radius: 4px;
        }

        .text-gray {
            color: #878A99;
            /* font-size: 16px; */
        }

        .footer-server {
            background: transparent;
            color: #FFFFFF80;
            position: absolute;
            bottom: 2em;
            width: 100%;
            text-align: center;
            font-size: 16px;
        }
        .btn-position{
            position: absolute;
            bottom: 2em;
            padding-right: 3em;
        }
    </style>
</head>

<body>
    @php

        $menu = getCONFIG('menu');
        $feature = getCONFIG('feature');

    @endphp
    <div class="container">
        <div class="box-white">
            <div class="row p-5 ">

                <div class="col-6">
                    <h4>Client Connection</h4>

                    <div class="row text-gray mt-4">
                        <div class="col-4">
                            Comname
                        </div>
                        <div class="col-4 ">
                            Department
                        </div>
                        <div class="col-4 ">
                            Status
                        </div>
                    </div>
                    <div class="row text-gray mt-2">

                        @foreach ($all_client as $data)
                            <div class="col-4 ">
                                {{ $data }}
                            </div>
                            <div class="col-4 ">
                                @php
                                    $department = str_replace('0', '', $data);
                                    $department = str_replace('1', '', $department);
                                    $department = str_replace('2', '', $department);
                                    $department = str_replace('3', '', $department);
                                    $department = str_replace('4', '', $department);
                                    $department = str_replace('5', '', $department);
                                    $department = str_replace('6', '', $department);
                                    $department = str_replace('7', '', $department);
                                    $department = str_replace('8', '', $department);
                                    $department = str_replace('9', '', $department);
                                @endphp

                                &ensp;&ensp;&ensp;&ensp; {{ strtoupper($department) }}
                            </div>
                            <div class="col-4 text-success">
                                <span id="status_online_{{ $data }}"></span>
                            </div>
                        @endforeach

                    </div>

                </div>
                <div class="col-6">
                    <h4>Service Status</h4>
                    <div class="row text-gray mt-4">
                        <div class="col-4">
                            Service
                        </div>
                        <div class="col-4 "></div>
                        <div class="col-4 ">
                            Status
                        </div>
                    </div>
                    <div class="row text-gray  mt-2">
                        <div class="col-8">
                            FTP Server (Port:6000)
                        </div>

                        <div class="col-4 text-success">
                            &ensp; &nbsp;<span id="ftplocalhost"></span>
                        </div>
                    </div>
                    <div class="row text-gray ">
                        <div class="col-8">
                            PACs Server (Port:104)
                        </div>

                        <div class="col-4 text-success">
                            &ensp; &nbsp;<span id="pacspacs"></span>
                        </div>
                    </div>
                    @foreach ($disk_store as $data)
                        <div class="row text-gray ">
                            <div class="col-8">
                                File Send to {{$data['drive']}} ({{$data['department']}})
                            </div>

                            <div class="col-4 text-success">
                                &ensp; &nbsp;<i class="ri-checkbox-circle-fill"></i>
                            </div>
                        </div>
                    @endforeach


                </div>
                <div class="row btn-position">
                    <div class="col-10">
                        <button class="btn btn-success w-100 test">Back to Case List</button>
                    </div>
                    <div class="col-2">
                        <button class="btn btn-danger w-100">Re Analyze</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="footer-server">
        © 2023 EndoINDEX 6.0 by Medica Healthcare Co.,Ltd.
    </div>

    @include("csrf.js")
    <script src="{{ url('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ url('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ url('assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ url('assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>

    <script>
        function checkport(comname, port,id_prefix) {
            $.post("{{url('server')}}",{
                event:"checkport",
                comname:comname,
                port:port,
            },function(d,s){
                const obj = JSON.parse(d);
                if(obj.status){
                    $("#"+id_prefix+comname).html('&ensp; &nbsp;<i class="ri-checkbox-circle-fill text-success"></i>')
                }else{
                    $("#"+id_prefix+comname).html('&ensp; &nbsp;<i class="ri-close-circle-fill text-danger"></i>')
                }
            });
        }
    </script>

    @foreach ($all_client as $data)
        <script>
            checkport("{{$data}}",80,"status_online_");
        </script>
    @endforeach

    <script>
        checkport("pacs",104,"pacs");
        checkport("localhost",6000,"ftp");
    </script>
</body>

</html>
