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
    <link href="{{ asset('public/images/favicon.png') }}" rel="shortcut icon">
    <script src="{{ url('public/assets5/js/layout.js') }}"></script>
    <link href="{{ url('public/assets5/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('public/assets5/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('public/assets5/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('public/assets5/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
    <title>Document</title>
    <style>
        body {
            background: linear-gradient(-90deg, #193D61, #326172, #388397, #3B899B, #388397, #326172, #193D61);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;

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
            height: 345px;
            position: absolute;
            top: 33%;
            left: 37%;

            border-radius: 4px;
        }

        .box-icon {
            height: 96px;
            width: 96px;
            background: #F3F6F9;
            border-radius: 50%;
        }



        .text-dark-error {
            color: #495057;
            font-size: 19px;
        }

        .w-90 {
            width: 90%
        }
        .mt-7rem-custom{margin-top: 7rem;}
        strong{color: #245788; font-size: 32px; font-weight: normal;}
    </style>
</head>

<body>
    <div class="container">
        <div class="box-white">
            <div class="row p-3 ">
                <div class="col-12 mt-7rem-custom " style="text-align: -webkit-center;">
                   <strong>Sorry 😭</strong>

                </div>
                <div class="col-12 mt-3 text-center">
                    <span class="text-dark-error ">WE CAN’T CONNECT TO SERVER.</span>
                </div>
                <div class="col-12 mt-1 text-center">
                    <span class="text-muted ">Report function is available although disconnect server. </span>
                </div>
                <div class="col-12 text-center mt-4 ">
                    <a href="{{ url('home') }}" class="btn btn-success w-90">Back to Case List (Normal Use)</a>
                </div>
            </div>
        </div>

    </div>


</body>

</html>
