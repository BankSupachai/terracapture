<!DOCTYPE html>
<html lang="en" data-layout-mode="dark">
{{ bladelink('capture/camera/obs/01obs') }}

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ url('public/images/favicon.png') }}">
    <link rel="stylesheet" href="{{ url('assets/css/icons.min.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/css/app.min.css') }}" />
    <link rel="stylesheet" href="{{ url('assets/capture/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/capture/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/capture/camera-obs.css') }}" />
    <script src="{{ url('assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ url('assets/capture/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('assets/js/camera-api.js') }}"></script>
    {{-- <script src="{{ url('assets/js/camera-obs.js') }}"></script> --}}
    <title>Camera</title>
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

@include('capture.camera.modal.modal_scope_alert')
@include('capture.camera.mockup.livestream_modal')
@include('capture.camera.mockup.medi_modal')
@include('capture.camera.modal.modal_signal_lost')
@include('capture.camera.modal.modal_sms')
@include('capture.camera.modal.modal_new_case')
@include('capture.camera.modal.modal_progress_camera')
@include('capture.camera.modal.modal_casetest')
@include('capture.camera.modal.attendant')
@include('capture.camera.modal.modal_livestream')
@include('capture.camera.modal.modal_socket5restart')
@include('capture/camera/obs/js_socket')
@include('capture/camera/obs/js_onload')
@include('capture/camera/obs/js_hotkey')
@include('capture/camera/obs/js_checksignal')


<body data-cid="{{ $cid ?? '' }}" data-hn="{{ $hn ?? '' }}" data-caseuniq="{{ $case->caseuniq ?? '' }}">
    <div class="row p-1 m-0">
        <div class="col-xl-3 box-detail">
            @include('capture.camera.obs.div_left')
        </div>
        <div class="col-xl-9">
            <div class="row">
                <div id="div_video" class="col-12">
                    <div
                        style="position:absolute; top:0; left:0; width:100%; height:100%; z-index:10; pointer-events:auto; background:rgba(0,0,0,0);">
                    </div>
                    <iframe id="video1" src="http://localhost:8889/live/endo/" frameborder="0" allowfullscreen
                        width="100%" height="100%"></iframe>
                </div>
                <div class="row mt-2">
                    <div class="col-4">
                        @include('capture/camera/obs/manage_camera')
                    </div>
                    <div class="col-7">
                        @include('capture.camera.obs.captureandvdocontrol')
                    </div>
                    <div class="col-1 m-0 ps-1">
                        @include('capture.camera.obs.btncontrol')
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('capture.camera.obs.mainscript')

    <script>
        function case_update(key, value) {
            const cid = document.body.dataset.cid || '';
            if (cid) {
                CameraAPI.caseUpdate(cid, key, value).catch(function(error) {
                    console.error('Error updating case:', error);
                });
            }
        }
    </script>
</body>
</html>
