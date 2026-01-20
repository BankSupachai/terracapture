<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ url('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ url('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <title>Document</title>
    <style>
        body {
            background: linear-gradient(to bottom, #193D61, #245788);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .center-content img {
        width: 40%;
        height: auto;
        }

        .white {
            color: #ffffff;
        }
    </style>
</head>

<body>
    <div class="center-content" style="display: flex; align-items: center; justify-content: center;">
        <img src="{{ url('public/image/rocket.png')}}" alt="">
    </div>
    <div class="text-center" style="margin-top:25px;">
        <h3 class="white">Get notified when we launch</h3>
    </div>
    <div class="text-center">
        <h4 class="white">เราจะเปิดบริการทั้งหมดเร็วๆ นี้</h4>
    </div>
</body>

</html>
