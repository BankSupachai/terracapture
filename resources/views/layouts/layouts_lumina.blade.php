<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-layout-mode="dark" data-layout-width="fluid" data-layout-position="fixed" data-layout-style="default">

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta charset="utf-8" />
    <title>Lumina Capture</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />

    {{-- link ใหม่ --}}
    <link href="{{asset('public/recorder/luminaicon.png')}}" rel="shortcut icon">
    <script src="{{url("assets/js/layout.js")}}"></script>
    <link href="{{url("assets/css/bootstrap.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{url("assets/css/icons.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{url("assets/css/app.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{url("assets/css/custom.min.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{url("public/recorder/small-scale.css")}}" rel="stylesheet" type="text/css" />
 <script src="{{url("assets/libs/bootstrap/js/bootstrap.bundle.min.js")}}"></script>
<script src="{{url("assets/libs/simplebar/simplebar.min.js")}}"></script>
<script src="{{url("assets/libs/node-waves/waves.min.js")}}"></script>
<script src="{{url("assets/libs/feather-icons/feather.min.js")}}"></script>
<script src="{{url("assets/js/pages/plugins/lord-icon-2.1.0.js")}}"></script>
<script src="{{url("public/recorder/jquery.min.js")}}"></script>
    @yield('style')
    <style>
        body{
        overflow-y: hidden;
        --vz-body-bg: #000000;
        }
        *{
            font-family: 'Anuphan', sans-serif;
        }
        .progress-bar.bg-deepblue {
            background: #245788 !important;
        }
        .btn-select:hover {
            background: #193d5f;
            color: #fff;
        }
        .input-dark-2{
            background: #383838;
            font-size: 26px;
        }
        .btn-dark-primary{
        background: #245788;
        color:white !important;
    }
    .btn-dark-primary:hover{
        background: #204e79;
        color:white !important;
    }

        input::placeholder{
            color: #ffffff80 !important;
        }
        .form-check label {
            color: #ffffff80;

        }
        .card-user-setting{
        background: #222529;
        height: 100vh;
    }
        @font-face{
            font-family: 'kanit';
            font-style: normal;
            font-weight: normal;
            src: url("{{url('public/fonts/Kanit-Regular.ttf')}}") format("truetype");
        }
        @font-face{
            font-family: 'kanit';
            font-style: normal;
            font-weight: bold;
            src: url("{{url('public/fonts/Kanit-Bold.ttf')}}") format("truetype");
        }
        @font-face{
            font-family: 'kanit';
            font-style: italic;
            font-weight: normal;
            src: url("{{url('public/fonts/Kanit-Italic.ttf')}}") format("truetype");
        }
        @font-face{
            font-family: 'kanit';
            font-style: italic;
            font-weight: bold;
            src: url("{{url('public/fonts/Kanit-ExtraBoldItalic.ttf')}}") format("truetype");
        }


        @font-face{
            font-family: 'Anuphan';
            font-style: normal;
            font-weight: 100;
            src: url("{{url('public/fonts/Anuphan-Thin.ttf')}}") format("truetype");
        }
        @font-face{
            font-family: 'Anuphan';
            font-style: normal;
            font-weight: 200;
            src: url("{{url('public/fonts/Anuphan-ExtraLight.ttf')}}") format("truetype");
        }
        @font-face{
            font-family: 'Anuphan';
            font-style: normal;
            font-weight: 300;
            src: url("{{url('public/fonts/Anuphan-Light.ttf')}}") format("truetype");
        }
        @font-face{
            font-family: 'Anuphan';
            font-style: normal;
            font-weight: 400;
            src: url("{{url('public/fonts/Anuphan-Regular.ttf')}}") format("truetype");
        }
        @font-face{
            font-family: 'Anuphan';
            font-style: normal;
            font-weight: 500;
            src: url("{{url('public/fonts/Anuphan-Medium.ttf')}}") format("truetype");
        }
        @font-face{
            font-family: 'Anuphan';
            font-style: normal;
            font-weight: 600;
            src: url("{{url('public/fonts/Anuphan-SemiBold.ttf')}}") format("truetype");
        }
        @font-face{
            font-family: 'Anuphan';
            font-style: italic;
            font-weight: 700;
            src: url("{{url('public/fonts/Anuphan-Bold.ttf')}}") format("truetype");
        }
        .fs-35{
            font-size: 35px;
        }
        .fs-26{
            font-size: 26px;
         }
        .fs-22{
            font-size: 22px;
         }
         .fs-20{
            font-size: 20px ;
         }
         .fs-18{
            font-size: 18px ;
         }
    </style>
</head>

<body id="body">
    @yield('modal')
    @include('lumina.component.modal_loading')
    @include('lumina.component.modal_wkstatus')

    @php
        $ds             = ((disk_total_space("D:/")/1024)/1024)/1024;
        $ds             = intval($ds);
        $drive          = ((disk_free_space("D:/")/1024)/1024)/1024;
        $drive          = intval($drive);
        $percent         = ($drive*100)/$ds;
        $percent         = 100-intval($percent);
        $drive_color    = 'bg-success';
        if($percent<=24){
            $drive_color = ' ';
        }
        if($percent>25 && $percent<=49){
            $drive_color = 'bg-success';
        }
        if($percent>=50 && $percent<=74){
            $drive_color = 'bg-info';
        }
        if($percent>=75 && $percent<=84){
            $drive_color = 'bg-warning';
        }
        if($percent>=85){
            $drive_color = 'bg-danger';
        }
    @endphp
    <div class="row top-nav fs-18">
        <div class="col-4">
            <div class="row cn">
                <a href="{{url('lumina/record')}}" class="col-auto">
                    <img src="{{url('public/recorder/images/luminalogo.png')}}" class="img-logo">
                </a>
                <div class="col pt-2 pr-5">
                    <label for="disk" class="text-white mt-1">{{$drive}} GB / {{$ds}} GB ({{$percent}}%)</label>
                    <div class="progress mb-4">
                        <div class="progress-bar bg-deepblue text-success {{$drive_color}}" id="disk" role="progressbar" style="width: {{$percent}}% " aria-valuenow="{{$percent}}" aria-valuemin="0" aria-valuemax="100" ></div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-8 p-0 dropdown ">
            <div class="row cn">
                @if(Request::segment(2) !='worklist' && Request::segment(2) !='server')
                    @php
                        $scope_type = get_config_scope();
                    @endphp
                        <a class="col @if(Request::segment(2)=='record') active-url @endif" href="{{url('lumina/record')}}">
                            <i class="ri-record-circle-line text-white align-middle"></i>&nbsp;
                            <span class="align-middle">Record</span>
                            {{-- <i class="ri-record-circle-fill  record-icon active"></i> --}}
                        </a>
                    <a class="col @if(Request::segment(2)=='caselist' || Request::segment(2)==null) active-url @endif" href="{{url('lumina/caselist')}}"><i class="ri-file-list-fill text-white align-middle"></i>&nbsp; <span class="align-middle">Case List</span></a>
                    <a class="col @if(Request::segment(2)=='storage') active-url @endif" href="{{url('lumina/storage')}}"><i class="ri-database-fill text-white align-middle"></i>&nbsp; <span class="align-middle">Storage</span></a>
                    <label class="dropdown-toggle col m-0  @if(Request::segment(2)=='setting') active-url @endif" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="ri-settings-5-fill text-white align-middle"></i>&nbsp; <span class="align-middle">Setting</span>
                    </label>
                    <div class="dropdown-menu " aria-labelledby="dropdownMenuButton">
                        {{-- <a class="dropdown-item text-center" href="{{url('lumina/setting/video')}}"><i class="bx bx-video text-white align-middle"></i>&nbsp; <span class="align-middle">Video</span></a>
                        <a class="dropdown-item text-center" hre f="{{url('lumina/setting/sound')}}"><i class="bx bx-volume-full text-white align-middle"></i>&nbsp; <span class="align-middle">Sound</span></a>
                        <a class="dropdown-item text-center" href="{{url('lumina/setting/storage')}}"><i class="ri-server-fill text-white align-middle"></i>&nbsp; <span class="align-middle">Storage</span></a>
                        <a class="dropdown-item text-center" href="{{url('lumina/setting/connection')}}"><i class="bx bx-broadcast text-white align-middle"></i>&nbsp; <span class="align-middle">Connection</span></a> --}}
                        <a class="dropdown-item d-flex justify-content-between " href="{{url('lumina/setting/user_setting')}}"><i class="ri-apps-fill text-white align-middle"></i>&nbsp; <span class="align-middle">User Setting</span></a>
                        <a class="dropdown-item d-flex justify-content-between " href="{{url('lumina/setting/about')}}"><i class="ri-error-warning-line text-white align-middle"></i>&nbsp; <span class="align-middle">About</span></a>
                        <a id="file_explorer" class="dropdown-item d-flex justify-content-between "><i class="ri-folder-open-line text-white align-middle"></i>&nbsp; <span class="align-middle">File Explorer</span></a>
                        <a id="restart_nav" class="dropdown-item d-flex justify-content-between "><i class="ri-restart-line text-white align-middle"></i>&nbsp; <span class="align-middle">Restart</span></a>
                        <a class="dropdown-item d-flex justify-content-between" href="{{url('lumina/setting/shutdown')}}"><i class="ri-shut-down-line text-white align-middle"></i>&nbsp; <span class="align-middle">Shutdown</span></a>
                    </div>
                @else
                    <div class="col" style="visibility: hidden"></div>
                    <div class="col" style="visibility: hidden"></div>
                    <div class="col" style="visibility: hidden"></div>
                    <div class="col" style="visibility: hidden"></div>
                    @if(Request::segment(2)=='worklist')
                    @if(@$page_type)
                        <a class="col" href="{{url('lumina/patient')}}/{{@$instant_cid}}"><i class="ri-arrow-go-back-fill text-white align-middle"></i>&nbsp; <span class="align-middle">Register</span></a>
                    @else
                        <a class="col" href="{{url('lumina/caselist')}}"><i class="ri-arrow-go-back-fill text-white align-middle"></i>&nbsp; <span class="align-middle">Case List</span></a>
                    @endif
                    @elseif(Request::segment(2)=='server')
                        <button class="col to-camera" type="button"><i class="ri-arrow-go-back-fill text-white align-middle"></i>&nbsp; <span class="align-middle">Camera</span></button>
                    @endif
                @endif
            </div>
        </div>

    </div>
    @yield('content')


{{-- link ใหม่ --}}






@yield('script')
<script src="{{asset('public/js/qwebchannel.js')}}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // callmodal()
    });

    function connectToPyqt() {
            new QWebChannel(qt.webChannelTransport, function (channel){
                window.backend = channel.objects.backend
            })
        }

    window.onload = connectToPyqt;

    function callmodal(){
        let loadingModal = new bootstrap.Modal(document.getElementById('loadingModal'), {
            keyboard: false,
            backdrop: 'static'
        });
        loadingModal.show();

        setTimeout(function() {
            loadingModal.hide();
        }, 500);
    }
</script>

<script>
    var is_python = "{{@$scope_type}}"
    $("#file_explorer").click(function() {
        if(is_python == 1 || is_python == 'true'){
            // socket.emit('chat message', 'file_explorer')
            if (window.backend) {
                window.backend.close_and_open_explorer();
            }
            // socket.emit('chat message', 'shutdown_python')
        }
    })

    $("#restart_nav").click(function(){
        if(is_python == 1 || is_python == 'true'){
            if (window.backend) {
                window.backend.restart_app();
            }
            // socket.emit('chat message', 'restart_python')
        }
    });
</script>


<script>
    function searchmodal(type) {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById(`search-${type}-recorder`);
        filter = input.value.toUpperCase();
        table = document.getElementById(`table-${type}-recorder`);
        console.log(input, table, type, `table-${type}`);
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
            txtValue = td.textContent || td.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
                tr[i].style.display = "";
            } else {
                tr[i].style.display = "none";
            }
            }
        }
    }
</script>

</body>

</html>
