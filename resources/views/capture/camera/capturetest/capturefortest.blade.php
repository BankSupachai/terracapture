{{ bladelink('capture/camera/obs/01obs') }}
<!DOCTYPE html>
<html lang="en" data-layout-mode="dark">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ url('public/images/favicon.png') }}">
    <link rel="stylesheet" href="{{ url('assets/css/icons.min.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/css/app.min.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/capture/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/capture/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/capture/camera-obs.css') }}" />
    <script src="{{ url('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ url('assets/capture/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('assets/js/camera-api.js') }}"></script>

    <title>Camera TEST</title>
    <style>
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
    </style>
</head>
@include('capture.camera.modal.modal_signal_lost')
@include('capture.camera.modal.modal_casetest')
@include('capture/camera/obs/js_socket')
@include('capture/camera/obs/js_onload')
@include('capture/camera/obs/js_hotkey')
@include('capture/camera/obs/js_checksignal')


<body>
    <div class="row p-1 m-0">
        <div class="col-xl-3 box-detail">
            @include('capture.camera.capturetest.div_left')
        </div>
        <div class="col-xl-9">
            <div class="row">
                <div id="div_video" class="col-12">
                    <div style="position:absolute; top:0; left:0; width:100%; height:100%; z-index:10; pointer-events:auto; background:rgba(0,0,0,0);">
                    </div>
                    <iframe id="video1" src="http://localhost:8889/live/endo/" frameborder="0" allowfullscreen
                        width="100%" height="100%"></iframe>
                </div>
                <div class="row mt-2">
                    <div class="col-12">
                        @include('capture.camera.capturetest.captureandvdocontrol')
                    </div>
                    {{-- <div class="col-1 m-0 ps-1">
                        @include('capture.camera.obs.btncontrol')
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
    @include('capture.camera.obs.mainscript')
</body>

</html>
