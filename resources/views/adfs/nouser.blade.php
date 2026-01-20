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

            .box-white2{
                background: #ffffff;
                width: 520px;
                height: 371px;
                position: absolute;
                top: 33%;
                left: 37%;

                border-radius: 4px;
            }

            i{
                color: #f06548;
                font-size: 64px;
            }
            .text-dark-error{
                color: #495057;
                font-size: 19px;
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

        <div class="box-white2">
            <div class="row p-3 ">
                <div class="col-12 mt-2 " style="text-align: -webkit-center;">
                        <img src="{{url("public/image/tea-server.png")}}" width="150px" height="150px" alt="">
                </div>
                <div class="col-12 text-center">
                    <span class="text-dark-error">Sorry</span>
                </div>
                <div class="col-12  text-center mt-2">
                    <span class="fs-16 text-muted fs-normal ">
                        User is not register in system, Please contact administrator
                    </span>
                </div>
                <div class="col-12 text-center mt-2">
                    <span class="text-muted ">ไม่มีชื่อผู้ใช้งานนี้ในระบบ กรุณาติดต่อ ผู้ดูแล ระบบเพื่อเพิ่มชื่อผู้ใช้งาน</span>
                </div>
                <div class="col-12 text-center mt-4 ">
                    <a href="{{@$urlredirect}}" class="btn btn-success w-90">Login with another user</a>
                </div>
            </div>
        </div>

    </div>
    <footer>© 2023 EndoINDEX 6.0 by Medica Healthcare Co.,Ltd.</footer>
</div>


</body>
</html>
