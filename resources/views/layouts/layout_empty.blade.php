<!doctype html>
<html lang="en" data-layout="horizontal" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-layout-mode="dark" data-layout-width="fluid" data-layout-position="fixed" data-layout-style="default">
<head>
    <meta charset="utf-8" />
    <title>EndoINDEX</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <link href="{{asset('public/images/favicon.png')}}"                                rel="shortcut icon">
    <script src="{{url("public/assets5/js/layout.js")}}"></script>
    <link href="{{url("public/assets5/css/bootstrap.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{url("public/assets5/css/icons.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{url("public/assets5/css/app.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{url("public/assets5/css/custom.min.css")}}" rel="stylesheet" type="text/css" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
<style>
    [data-layout=horizontal] .container-fluid, [data-layout=horizontal] .layout-width{
        max-width: 100%;
    }
    .cn{
        align-items: center;
    }
    .h-100vh{height: 100vh;}
    .pt-6em{
        padding-top: 4em;
    }
    .pr-0{padding-right: 0 !important}
    body{
        overflow: hidden;
    }
    .file-list{
        height: 90vh;
        overflow-y: auto;
        padding-bottom: 10vh;
    }
    ::-webkit-scrollbar {
        width: 0;
    }

    /* Track */
    ::-webkit-scrollbar-track {
        background: #f1f1f1;
    }

    /* Handle */
    ::-webkit-scrollbar-thumb {
        background: #888;
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
    .cn{
        align-items: center;
    }
</style>
    @yield('style')
</head>

<body id="body">

    @yield('modal')

    @yield('content')


    <!-- JAVASCRIPT -->
    <script src="{{url("public/assets5/libs/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
    <script src="{{url("public/assets5/libs/simplebar/simplebar.min.js")}}"></script>
    <script src="{{url("public/assets5/libs/node-waves/waves.min.js")}}"></script>
    <script src="{{url("public/assets5/libs/feather-icons/feather.min.js")}}"></script>
    <script src="{{url("public/assets5/js/pages/plugins/lord-icon-2.1.0.js")}}"></script>
    <script src="{{url("public/assets5/js/plugins.js")}}"></script>

    <!-- App js -->
    <script src="{{url("public/assets5/libs/prismjs/prism.js")}}"></script>

    <script src="{{url("public/assets5/js/app.js")}}"></script>
    @yield('script')

</body>

</html>
