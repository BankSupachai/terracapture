<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign In | EndoINDEX</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <link href="{{asset('public/images/favicon.png')}}" rel="shortcut icon">
    <script src="{{url('public/assets5/js/layout.js')}}"></script>
    <link href="{{url('public/assets5/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('public/assets5/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('public/assets5/css/app.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{url('public/assets5/css/custom.min.css')}}" rel="stylesheet" type="text/css" />
    <title>Document</title>
    <style>
    body {
                background: linear-gradient(-90deg,  #193D61, #326172, #388397, #3B899B, #388397, #326172, #193D61);
                background-size: 400% 400%;
                animation: gradient 15s ease infinite;

            }
            * {
            font-family: 'Kanit', sans-serif !important;
            font-weight: normal !important;
            --vz-body-color: #495057 ;
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
            .container{
                padding: 250px;
            }
            .box-white1{
                background: #ffffff;
                width: 500px;
                height: 345px;
                position: absolute;
                left: 21%;
                top: 33%;
                border-radius: 4px;

                margin: 0;
            }
            .box-white2{
                background: #ffffff;
                width: 500px;
                height: 345px;
                position: absolute;
                top: 33%;
                left: 50%;

                border-radius: 4px;
            }
            .box-icon{
                height: 96px;
                width: 96px;
                background: #F3F6F9;
                border-radius: 50%;
            }
            i{
                color: #f06548;
                font-size: 64px;
            }
            .text-dark-error{
                color: #495057;
                font-size : 19px;
            }
            .w-90{
                width: 90%
            }
            footer{
                position: absolute;
                bottom: 2%;
                left: 42%;
                color: #ffffff80;
            }
    </style>
</head>
<body>
<div class="container">
    <div class="row w-100">
        <div class="box-white1">
            <video width="100%" height="100%"  autoplay controls loop muted>
                <source src="{{url("public/video/Semivideo.mp4")}}" type="video/mp4">
              </video>
        </div>
        <div class="box-white2">
            <div class="row p-3 ">
                <div class="col-12 mt-5 " style="text-align: -webkit-center;">
                    <div class="box-icon">
                        <i class="ri-close-circle-fill "></i>
                    </div>
                </div>
                <div class="col-12 mt-3 text-center">
                    <span class="text-dark-error ">WE CAN’T CONNECT TO SERVER.</span>
                </div>
                <div class="col-12 mt-1 text-center">
                    <span class="text-muted ">Report function is available although disconnect server. </span>
                </div>
                <div class="col-12 text-center mt-4 ">
                    <a href="{{url("home")}}" class="btn btn-success w-90">Back to Case List (Normal Use)</a>
                </div>
            </div>
        </div>

    </div>
    <footer>© 2023 EndoINDEX 6.0 by Medica Healthcare Co.,Ltd.</footer>
</div>


</body>
</html>
