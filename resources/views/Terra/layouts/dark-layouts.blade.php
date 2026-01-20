<html lang="en" class="light">
    <!-- BEGIN: Head -->
    <head>
        <meta charset="utf-8">
        <link href="{{url("public/dist/images/logo.svg")}}" rel="shortcut icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Enigma admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
        <meta name="keywords" content="admin template, Enigma Admin Template, dashboard template, flat admin template, responsive admin template, web app">
        <meta name="author" content="LEFT4CODE">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Terra Link</title>
        <!-- BEGIN: CSS Assets-->
        <link rel="stylesheet" href="{{url("public/dist/css/app.css")}}" />
        <!-- END: CSS Assets-->
        <style>
            .content{
                position: fixed;
                height: 100vh;
                width: 100%;
                background: black;
                margin: 0;
                padding: 0px;
            }
            .menu-nav{
                min-height: 3em;
                padding: 5px 1em !important;
            }
            .w-10em{
                width: 10em;
            }
        </style>
        @yield('style')
    </head>
    <!-- END: Head -->

    <body class="py-5 md:py-0 ">




        @yield('modal')
        {{-- <div class="flex overflow-hidden"> --}}

        @yield('content')
            </div>
        {{-- </div> --}}

        {{-- <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key=["your-google-map-api"]&libraries=places"></script> --}}
        <script src="{{url("public/dist/js/app.js")}}"></script>
        @yield('script')
    </body>
</html>
