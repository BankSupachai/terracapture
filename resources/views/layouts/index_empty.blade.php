<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-layout-mode="dark">

<head>


    <meta charset="utf-8" />
    <title>EndoINDEX</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="shortcut icon" href="{{ url('public/images/favicon.png') }}">

    <!-- One of the following themes -->
    <script src="{{ url('assets/js/layout.js') }}"></script>
    <script src="{{ url('public/js/jquery-3.6.0.min.js') }}"></script>

    <link rel="stylesheet" href="{{ url("assets/libs/dropzone/dropzone.css") }}" type="text/css" />
    <link rel="stylesheet" href="{{ url("assets/libs/filepond/filepond.min.css") }}" type="text/css" />
    <link rel="stylesheet" href="{{ url("assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.css")}}">

    <link href="{{ url('public/css/input/main.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ url('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ url('assets/libs/@simonwep/pickr/themes/classic.min.css') }}" rel="stylesheet" />
    <!-- 'classic' theme -->
    <link href="{{ url('assets/libs/@simonwep/pickr/themes/monolith.min.css') }}" rel="stylesheet" />
    <!-- 'monolith' theme -->
    <link href="{{ url('assets/libs/@simonwep/pickr/themes/nano.min.css') }}" rel="stylesheet" /> <!-- 'nano' theme -->
    <link href="{{ url('assets/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{url('public/css/photoviewer/photoviewer.css')}}" rel="stylesheet" type="text/css">
    <script src="{{ url('assets/js/select2.min.js') }}"></script>
    {{-- <script src="{{ url('assets/js/pages/select2.init.js') }}"></script> --}}
    <link href="{{ url('assets/libs/fullcalendar/main.min.css') }}" rel="stylesheet" type="text/css" />


@yield('style')

</head>

<body>
@yield('modal')
@yield('content')
<script src="{{url("assets/libs/dropzone/dropzone-min.js")}}"></script>
<script src="{{url("assets/libs/dropzone/dropzone-min.js")}}"></script>
<script src="{{url("assets/libs/filepond/filepond.min.js")}}"></script>
<script src="{{url("assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js")}}"></script>
<script src="{{url("assets/libs/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js")}}"></script>
<script src="{{url("assets/libs/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js")}}"></script>
<script src="{{url("assets/libs/filepond-plugin-file-encode/filepond-plugin-file-encode.min.js")}}"></script>
{{-- <script src="{{url("assets/js/pages/form-file-upload.init.js")}}"></script> --}}

<script src="{{ url('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ url('assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ url('assets/libs/node-waves/waves.min.js') }}"></script>
<script src="{{ url('assets/libs/feather-icons/feather.min.js') }}"></script>
<script src="{{ url('assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
{{-- <script src="{{url("assets/js/plugins.js")}}"></script> --}}
@include('layouts.layouts_index.plugins')
<script src="{{ url('assets/libs/@simonwep/pickr/pickr.min.js') }}"></script>
<script src="{{ url('assets/js/pages/form-pickers.init.js') }}"></script>
<script src="{{ url('assets/js/select2.min.js') }}"></script>
<script src="{{ url('assets/js/pages/select2.init.js') }}"></script>
<script src="{{ url('assets/libs/fullcalendar/main.min.js') }}"></script>
<script src="{{ url('assets/libs/cleave.js/cleave.min.js') }}"></script>
<script src="{{ url('assets/js/pages/form-masks.init.js') }}"></script>
<script src="{{ url('assets/js/pages/form-pickers.init.js') }}"></script>
<script src="{{ url('assets/js/app.js') }}"></script>


@yield('script')
</body>


</html>
