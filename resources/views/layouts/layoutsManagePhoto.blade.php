<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('Title')</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="description" content="File Upload widget with multiple file selection, drag&amp;drop support, progress bars, validation and preview images, audio and video for jQuery. Supports cross-domain, chunked and resumable file uploads and client-side image resizing. Works with any server-side platform (PHP, Python, Ruby on Rails, Java, Node.js, Go etc.) that supports standard HTML form file uploads.">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

{{-- <link rel="stylesheet" href="{{url('public/selfupload/css/style.css')}}"> --}}
{{-- <link rel="stylesheet" href="{{url('public/selfupload/css/jquery.fileupload.css')}}"> --}}
{{-- <noscript><link rel="stylesheet" href="{{url('public/selfupload/css/jquery.fileupload-noscript.css')}}"></noscript>
<noscript><link rel="stylesheet" href="{{url('public/selfupload/css/jquery.fileupload-ui-noscript.css')}}"></noscript> --}}


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
<style>
     body{
            background: linear-gradient(-90deg,  #193D61, #326172, #388397, #3B899B, #388397, #326172, #193D61);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
            height: 100vh;
            /* width: 100vh; */

        }
        :root {
            --vz-input-bg: #F3F6F9;

        }
        .bg-sortphoto {
        background: #ffffffa6;

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

        ::-webkit-scrollbar {
            width: 5px;
            }
            ::-webkit-scrollbar-thumb {
                background: #c3c3c3;
                }
                            ::-webkit-scrollbar-track {
                background: transparent;
                }
        .box {
        width: 100%;
        height: 300px;
        border-radius: 16px;
    }

    .dotted {
        border: dotted 3px #c3c3c3;
    }
    .text-sort-blue {
            color: #325684;
        }

        .bg-sortphoto {
            background: #ffffffa6;
        }
        .text-blue-upload{
            color: #325684;
        }
        .pos-text {
    position: absolute;
    top: 35%;
    left:0;
    right:0;
    margin: auto;
            color: #ffffff80
}
.btn-dark-primary{
    background: #245788;
    color: #fff;
}
.btn-dark-primary:hover{
    background: #1c3e5e;
    color: #fff;
}


</style>
@yield('style')

</head>
<body>

    @yield('content')






    @yield('script')
    <script src="{{ url('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ url('assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ url('assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ url('assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ url('assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{asset('public/js/sweetalert2@11.js')}}"></script>

    {{-- <script src="{{url("assets/js/plugins.js")}}"></script> --}}
    @include('layouts.layouts_index.plugins')



</body>
</html>
