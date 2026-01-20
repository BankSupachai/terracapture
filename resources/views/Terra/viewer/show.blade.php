@extends('layouts.layout_empty')


@section('title', 'Endocapture')

@section('style')
<link href="{{url("public/assets5/css/viewer.css")}}" rel="stylesheet" type="text/css" />
<style>

    .background-head{
        background: #2B2E32;
        height: 155px;
    }
    .terra_logo{
        width: 120px;

    }
    .background-black{
        background: #000000;
        height: 200px;;
        margin-top: -5px;
    }
    .box-other{
        background: #2B2E32;
        width: 20%;
        right: 0;
        position: absolute;
        z-index: 999;
       text-align-last: center;
       /* display: none; */

    }

    .image-list-img-respondsive
        {
            width: 300px;
        }

    /* .btn-icon-terralink{
        font-size: 20px;
        background: transparent;
        color: #ffffff;

    } */

</style>
@section('modal')
<button type="button" id="capture_bt" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#capture_md">Standard Modal</button>
<div id="capture_md" class="modal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-sm modal-dialog-centered zoomIn">
        <div class="modal-content">
            <div class="modal-header">
                <button  type="button" style="display: none" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body text-center">
                <h5 class="fs-15">
                    ทำการบันทึกภาพเสร็จสิ้น
                </h5>
                <br>
                <button  id="close_bt" type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection


@section('content')






    <header id="page-topbar">
        <div class="layout-width">
            <div class="navbar-header">
                <div class="d-flex">
                    <div class="navbar-brand-box horizontal-logo">
                        <a href="{{url('/')}}" class="logo logo-dark ">
                            <span class="logo-sm">
                                <img src="{{url("public/image/EndoINDEX white logo.png")}}" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img alt="Logo" src="{{url("public/image/EndoINDEX white logo.png")}}" style="height:2.5em;"/>
                            </span>
                        </a>
                        <a href="{{url('/')}}" class="logo logo-light">
                            <span class="logo-sm">
                                <img src="{{url("public/image/EndoINDEX white logo.png")}}" alt="" height="22">
                            </span>
                            <span class="logo-lg">
                                <img alt="Logo" src="{{url("public/image/EndoINDEX white logo.png")}}" style="height:2.5em;"/>
                            </span>
                        </a>
                    </div>

                </div>


                <div class="d-flex margin-res">
                    <ul class="nav nav-pills">

                        <li class="nav-item tools" onclick="choose_layout()" id="layout_tool">
                            <a href="#custom-hover-reviews" data-bs-toggle="tab" aria-expanded="false" class="nav-link ">
                                <i class="ri-layout-4-line d-toggle check-video" ></i>
                                <h5 class="nav-titl nav-tab-position m-0 check-video">Layout</h5>
                            </a>
                            <div id="layout_chooser" class="layoutChooser layoutChooser-dropdown-menu" role="menu" style="display: none; min-width: 68px;margin-left:9.1%; top:90%" onmouseout="clear_color_cell()">
                                <table class="m-1">
                                    <tbody>
                                        <tr>
                                            <td id="cell11" style="width: 20px; height: 20px; border: 1px solid black;" onmouseover="color_cell(this.id)" onclick="set_layout(this.id)"></td>
                                            <td id="cell12" style="width: 20px; height: 20px; border: 1px solid black;" onmouseover="color_cell(this.id)" onclick="set_layout(this.id)"></td>
                                            <td id="cell13" style="width: 20px; height: 20px; border: 1px solid black;" onmouseover="color_cell(this.id)" onclick="set_layout(this.id)"></td>
                                        </tr>
                                        <tr>
                                            <td id="cell21" style="width: 20px; height: 20px; border: 1px solid black;" onmouseover="color_cell(this.id)" onclick="set_layout(this.id)"></td>
                                            <td id="cell22" style="width: 20px; height: 20px; border: 1px solid black;" onmouseover="color_cell(this.id)" onclick="set_layout(this.id)"></td>
                                            <td id="cell23" style="width: 20px; height: 20px; border: 1px solid black;" onmouseover="color_cell(this.id)" onclick="set_layout(this.id)"></td>
                                        </tr>
                                        <tr>
                                            <td id="cell31" style="width: 20px; height: 20px; border: 1px solid black;" onmouseover="color_cell(this.id)" onclick="set_layout(this.id)"></td>
                                            <td id="cell32" style="width: 20px; height: 20px; border: 1px solid black;" onmouseover="color_cell(this.id)" onclick="set_layout(this.id)"></td>
                                            <td id="cell33" style="width: 20px; height: 20px; border: 1px solid black;" onmouseover="color_cell(this.id)" onclick="set_layout(this.id)"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </li>
                        <li class="nav-item tools" onclick="scroll_image()" id="scroll_tool">
                            <a href="#custom-hover-reviews" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                <i class="mdi mdi-pan-vertical nav-icon nav-tab-position check-video"></i>
                                <h5 class="nav-titl nav-tab-position m-0  check-video">Scroll</h5>
                            </a>
                        </li>
                        <li class="nav-item" onclick="pan_image()" id="pan_tool">
                            <a href="#custom-hover-customere" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                <i class="ri-drag-move-2-fill nav-icon nav-tab-position check-video"></i>
                                <h5 class="nav-titl nav-tab-position m-0  check-video">Pan</h5>
                            </a>
                        </li>
                        <li class="nav-item" onclick="zoom_image()" id="zoom_tool">
                            <a href="#custom-hover-description" data-bs-toggle="tab" aria-expanded="true" class="nav-link">
                                <i class="ri-zoom-in-line nav-icon nav-tab-position  check-video"></i>
                                <h5 class="nav-titl nav-tab-position m-0  check-video">Zoom</h5>
                            </a>
                        </li>
                        <li class="nav-item" onclick="reset_image()" id="reset_tool">
                            <a href="#custom-hover-reviews" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                <i class="ri-arrow-go-back-line nav-icon nav-tab-position  check-video"></i>
                                <h5 class="nav-titl nav-tab-position m-0 check-video">Reset</h5>
                            </a>
                        </li>
                        <li class="nav-item" onclick="invert_color_image()" id="invert_color_tool">
                            <a href="#custom-hover-reviews" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                <i class=" ri-layout-column-fill nav-icon nav-tab-position check-video"></i>
                                <h5 class="nav-titl nav-tab-position m-0 check-video">Invert</h5>
                            </a>
                        </li>
                        <li class="nav-item" >
                            <a href="#custom-hover-reviews" data-bs-toggle="dropdown" role="button"  class="nav-link ">
                                <i class="ri-clockwise-fill nav-icon nav-tab-position check-video"></i>
                                <h5 class="nav-titl nav-tab-position m-0 check-video">Rotate</h5>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="javascript:;" class="dropdown-item" onclick="rotate_right()">Rotate right</a></li>
                                <li><a href="javascript:;" class="dropdown-item" onclick="get_tools('magnify')">Magnify</a></li>
                                <li><a href="javascript:;" class="dropdown-item" onclick="invert_image_vertical()">Flip vertical</a></li>
                                <li><a href="javascript:;" class="dropdown-item" onclick="invert_image_horizontal()">Flip horizontal</a></li>
                            </ul>
                        </li>
                        <li class="nav-item" onclick="window_level_image()" id="window_tool">
                            <a href="#custom-hover-reviews" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                <i class="las la-adjust nav-icon nav-tab-position mt-2 check-video"></i>
                                <h5 class="nav-titl nav-tab-position m-0 mt-1 check-video">Contrast</h5>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="#custom-hover-reviews" data-bs-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle " id="anotate">
                                <i class="ri-file-edit-fill nav-icon nav-tab-position d-toggle check-video"></i>
                                <h5 class="nav-titl nav-tab-position m-0 check-video">Anotate</h5>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="javascript:;" class="dropdown-item" onclick="get_tools('arrow')">Arrow</a></li>
                                <li><a href="javascript:;" class="dropdown-item" onclick="get_tools('text_marker')">Text Marker</a></li>
                                <li><a href="javascript:;" class="dropdown-item" onclick="get_tools('length')">Length</a></li>
                                <li><a href="javascript:;" class="dropdown-item" onclick="get_tools('ellipse')">Ellipse</a></li>
                                <li><a href="javascript:;" class="dropdown-item" onclick="get_tools('rectangle')">Rectangle</a></li>
                                <li><a href="javascript:;" class="dropdown-item" onclick="get_tools('polygon')">Polygon</a></li>
                                <li><a href="javascript:;" class="dropdown-item" onclick="get_tools('angle')">Angle</a></li>
                                <li><a href="javascript:;" class="dropdown-item" onclick="get_tools('cobb_angle')">Cobb Angle</a></li>
                                <li><a href="javascript:;" class="dropdown-item" onclick="get_tools('probe')">Probe</a></li>
                                <li><a href="javascript:;" class="dropdown-item" onclick="get_tools('bidirectional')">Bidirectional</a></li>
                                <li><a href="javascript:;" class="dropdown-item" onclick="get_tools('erasor')">Erasor</a></li>
                                <li><a href="javascript:;" class="dropdown-item" onclick="clear_tools()">Clear</a></li>
                            </ul>
                        </li>
                        <li class="nav-item ">
                            <a href="#custom-hover-reviews" id="play" data-bs-toggle="dropdown"  role="button" aria-expanded="false" class="nav-link dropdown-toggle">
                                <i class="ri-play-fill nav-icon nav-tab-position check-video"></i>
                                <h5 class="nav-titl nav-tab-position m-0 check-video">Cine</h5>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="javascript:;" class="dropdown-item" onclick="play_clip()">Play</a></li>
                                <li><a href="javascript:;" class="dropdown-item" onclick="stop_clip()">Stop</a></li>
                                <li>
                                    <div class="row">
                                        <div class="col-8"><input type="range" class="form-range" id="framerate_sld" data-slider-color="secondary" min="0" max="60" oninput="get_fps_slider()"></div>
                                        <div class="col-3" id="framerate_txt">30fps</div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        @if($type!='view')
                        <li class="nav-item">
                            <a href="#custom-hover-reviews" id="capture" data-bs-toggle="tab" aria-expanded="false" class="nav-link" onclick="key_image()">
                                <i class="ri-camera-lens-fill nav-icon nav-tab-position"></i>
                                <h5 class="nav-titl nav-tab-position m-0">Capture</h5>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#custom-hover-reviews" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                <i class=" ri-more-line nav-icon nav-tab-position mt-2"></i>
                                <h5 class="nav-titl nav-tab-position m-0 mt-1">Other</h5>
                            </a>
                        </li>
                        @else
                        <li class="nav-item">
                            <a href="#custom-hover-reviews" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                                <i class=" ri-more-line nav-icon nav-tab-position mt-2 check-video"></i>
                                <h5 class="nav-titl nav-tab-position m-0 mt-1 check-video">Other</h5>
                            </a>
                        </li>
                        <li class="nav-item">
                            <div class="nav-link">&emsp; &nbsp;  &nbsp; &nbsp; &nbsp;</div>
                        </li>
                        @endif

                    </ul>
                </div>
                <div class="d-flex ml-35">
                    <ul class="nav nav-pills">

                        @if($type!='view')
                            <li class="nav-item">
                                <a href="{{ url('') }}" class="nav-link">
                                    <i class="ri-arrow-go-back-fill nav-icon nav-tab-position"></i>
                                    <h5 class="nav-titl nav-tab-position m-0">Back</h5>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{url('procedure')}}/{{$id}}" class="nav-link">
                                    <i class="ri-file-text-line nav-icon nav-tab-position"></i>
                                    <h5 class="nav-titl nav-tab-position m-0">Report</h5>
                                </a>
                            </li>
                        @else
                            <li class="nav-item">
                                <div class="nav-link">&emsp; &emsp;  &emsp; &emsp; &nbsp;</div>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url()->previous() }}" class="nav-link">
                                    <i class="ri-arrow-go-back-fill nav-icon nav-tab-position"></i>
                                    <h5 class="nav-titl nav-tab-position m-0">Back</h5>
                                </a>
                            </li>

                        @endif
                    </ul>
                    <div class="">
                        <div class="dropdown ms-sm-3 header-item topbar-user">
                            <button type="button" class="btn" id="page-header-user-dropdown" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <span class="d-flex align-items-center">
                                    <img class="rounded-circle header-profile-user" src="{{url('public/images/avatar.png')}}"
                                        alt="Header Avatar">
                                    <span class="text-start ms-xl-2">
                                        <span class="d-none d-xl-inline-block ms-1 fw-medium user-name-text">Name</span>
                                    </span>
                                </span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <h6 class="dropdown-header">Welcome </h6>
                                <a class="dropdown-item" href="pages-profile.html"><i
                                        class="mdi mdi-account-circle text-muted fs-16 align-middle me-1"></i> <span
                                        class="align-middle">Profile</span></a>
                                <a class="dropdown-item" href="auth-logout-basic.html"><i
                                        class="mdi mdi-logout text-muted fs-16 align-middle me-1"></i> <span
                                        class="align-middle" data-key="t-logout">Logout</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <div class="row m-0 h-100vh">
        <div class="col-1 p-0 bg-black menu-left-list">
            <div class="row m-0 left-list cn">
                <div class="col-lg-2"></div>
                <div class="col-lg-10 text-white h5">
                    ID: {{@$hn}}
                </div>
                <div class="col-lg-2"></div>
                <div class="col-lg-10 text-white h5 mb-0">
                    Modality : {{@$tb_case->modality}}
                </div>
            </div>
            <div class="row m-0 file-list d-block">
                @php
                    $vdo_index = 0;
                @endphp
                @isset($count)
                    @if ($count > 1)
                        @foreach ($images as $key=>$img)
                            <div class="procedure-task">{{@$key}}</div>
                            <br>
                            <h4 class="text-center">IMAGE</h4>
                            @foreach ($img as $i)
                            @php
                                $img         = isset($i['na']) ? $i['na'] : '';
                                $exp         = isset($appointment) ? explode(" ", trim($appointment)) : null;
                                $date        = isset($exp[0]) ? $exp[0] : '';
                            @endphp
                            <div class="position-relative">
                                <img src="{{$url}}/store/{{$hn}}/{{$date}}/{{$img}}" class="w-100 image-list-img" onclick="selected_left_menu(this.src, 'image')">
                                <div class="box-number">1</div>
                            </div>
                            <br>
                            @endforeach
                            <br>
                            @isset($videos[$key])
                                <h4 class="text-center">VIDEO</h4>
                                @foreach ($videos[$key] as $video)
                                    @php
                                        $src = "http://localhost/recorder/$tb_case->_id/$video";
                                    @endphp
                                    <div class="position-relative">
                                        <video src="{{@$src}}" type="video/mp4" onclick="selected_left_menu('{{$src}}', 'video')" style="max-width: 130px; max-height: 150px; cursor: pointer;"></video>
                                    </div>
                                    <br>
                                @endforeach
                            @endisset

                        @endforeach

                    @else
                    <div class="procedure-task">{{@$tb_case->procedurename}}</div>
                        <div class="menu-list-image col-12 p-4 mt-2 text-center image-list" style="display: none">
                            @if (count($images) != 0)
                                <h4 class="text-center">IMAGE</h4>
                            @endif
                            @foreach ($images as $img)
                            @php
                                $img         = isset($img['na']) ? $img['na'] : '';
                                $exp         = isset($appointment) ? explode(" ", trim($appointment)) : null;
                                $date        = isset($exp[0]) ? $exp[0] : '';
                            @endphp
                                <div class="position-relative">
                                    <img src="{{$url}}/store/{{$hn}}/{{$date}}/{{$img}}" class="w-100 image-list-img" onclick="selected_left_menu(this.src, 'image')">
                                    <div class="box-number">1</div>
                                </div>
                            @endforeach
                        </div>
                        <div class="menu-list-image col-12 p-4 text-center video-list">
                            @if (count($videos) != 0)
                                <h4 class="text-center">VIDEO</h4>
                            @endif
                            @foreach ($videos as $video)
                                @php
                                    $src = "http://localhost/recorder/$tb_case->_id/$video";
                                @endphp
                                <div class="position-relative">
                                    <video src="{{@$src}}" type="video/mp4" onclick="selected_left_menu('{{$src}}', 'video')" style="max-width: 110px; max-height: 100px; cursor: pointer;"></video>
                                </div>
                            @endforeach
                        </div>

                    @endif
                @endisset
                {{-- <div class="menu-list-image col-12 p-4 text-center video-list" style="display:none">
                    <div class="position-relative"></div>
                    <h4>VIDEO</h4>
                </div> --}}
                <div class="menu-list-image col-12 p-4 text-center pdf-list-canvas" style="display: none">
                    <div class="position-relative"></div>
                    {{-- <h4>PDF</h4> --}}
                </div>
            </div>
        </div>
        <div class="col pr-0" id="main_div" style="height: 100%;">
            <div class="row m-0 cn" id="preview_div" style="height:100%; display:flex" >
                <div class="row align-items-start m-0" style="display:flex; flex-grown:1">
                <div class="row mt-4" >
                    <div class="col-sm bg-black div-border" id="preview11" onclick="selected_div(this.id)" style="display:none">
                        <div id="dicomImage"
                        class="img-fluid"
                            style="width:100%;height: 100%"
                            oncontextmenu="return false"
                            onmousedown="return false">
                        </div>
                    </div>
                    <div class="col-sm" id="preview12" onclick="selected_div(this.id)" style="display:none"></div>
                    <div class="col-sm" id="preview13" onclick="selected_div(this.id)" style="display:none"></div>
                </div>
                <div class="row">
                    <div class="col-sm" id="preview21" onclick="selected_div(this.id)" style="display:none"></div>
                    <div class="col-sm" id="preview22" onclick="selected_div(this.id)" style="display:none"></div>
                    <div class="col-sm" id="preview23" onclick="selected_div(this.id)" style="display:none"></div>
                </div>
                <div class="row">
                    <div class="col-sm" id="preview31" onclick="selected_div(this.id)" style="display:none"></div>
                    <div class="col-sm" id="preview32" onclick="selected_div(this.id)" style="display:none"></div>
                    <div class="col-sm" id="preview33" onclick="selected_div(this.id)" style="display:none"></div>
                </div>
            </div>
            </div>
        </div>

        <input type="hidden" id="selected_div" value="preview11">
    </div>


{{-- <div class="respondsive-div">
<div class="col-12 ">
    <!-- Base Examples -->
<div class="background-head p-0 m-0">
    <div class="row px-2">
        <div class="col-6">
            <a class="btn btn-light mt-2" data-bs-toggle="offcanvas" href="#offcanvasExample" role="button" aria-controls="offcanvasExample">
                <i class="ri-menu-2-line ri-2x"></i>
            </a>
        </div>
        <div class="col-6 text-end mt-2">
            <img src="{{url("public/images/TERRALINK1.PNG")}}" class="terra_logo"  alt="" >
        </div>
    </div>
    <div class="row text-center px-3">
        <div class="col-2 p-0" onclick="zoom_image()" id="zoom_tool">
            <a href="#custom-hover-description " data-bs-toggle="tab" aria-expanded="true" class="nav-link ">
                <i class=" ri-zoom-in-line nav-icon nav-tab-position check-video"></i>
                <h6 class="nav-titl nav-tab-position m-0 check-video">Zoom</h6>
            </a>
        </div>
        <div class="col-2 p-0 "  onclick="pan_image()" id="pan_tool">
            <a href="#custom-hover-customere" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                <i class="ri-drag-move-2-line nav-icon nav-tab-position  check-video"></i>
                <h6 class="nav-titl nav-tab-position m-0   check-video">Pan</h6>
            </a>
        </div>
        <div class="col-2 p-0" onclick="invert_color_image()" id="invert_color_tool">
            <a href="#custom-hover-reviews" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                <i class=" ri-layout-column-fill nav-icon nav-tab-position check-video"></i>
                <h6 class="nav-titl nav-tab-position m-0 check-video">Invert</h6>
            </a>
        </div>
        <div class="col-2 p-0">
             <a href="#custom-hover-reviews" data-bs-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
                <i class="ri-clockwise-fill nav-icon nav-tab-position check-video"></i>
                <h6 class="nav-titl nav-tab-position m-0 check-video">Rotate</h6>
            </a>
        </div>
        <div class="col-2 p-0"  onclick="window_level_image()" id="window_tool">
            <a href="#custom-hover-reviews" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                <i class="ri-contrast-fill nav-icon nav-tab-position mt-2 check-video"></i>
                <h6 class="nav-titl nav-tab-position m-0  check-video">Contrast</h6>
            </a>
        </div>
        <div class="col-2 p-0" >
            <button class=" btn nav-link btn-toggle-other">
                <i class=" ri-more-2-line nav-icon nav-tab-position  check-video"></i>
                <h6 class="nav-titl nav-tab-position m-0 check-video">Other</h6>
            </button>
        </div>
    </div>
    <div class="toggle-other">
        <div class="box-other">

            <div class="">
                <a href="#custom-hover-reviews" class="nav-link dropdown-toggle">
                    <i class="ri-file-edit-line nav-icon nav-tab-position d-toggle check-video"></i>
                    <h6 class="nav-titl nav-tab-position m-0 check-video">Anotate</h6>
                </a>
            </div>
            <div class="">
                <a href="#custom-hover-reviews"  class="nav-link dropdown-toggle">
                    <i class="ri-play-mini-fill nav-icon nav-tab-position d-toggle check-video"></i>
                    <h6 class="nav-titl nav-tab-position m-0 check-video">Cine</h6>
                </a>
            </div>
        </div>
    </div>


</div>
<img src="{{url("public/images/key1.png")}}" alt="">

<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Offcanvas</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        ...
    </div>
</div>
</div>
</div>
 --}}




@endsection

@section('script')


{{-- <script src="https://unpkg.com/hammerjs@2.0.8/hammer.js"></script> --}}
{{-- <script src="https://unpkg.com/dicom-parser@1.8.3/dist/dicomParser.min.js"></script> --}}

{{-- <script src="https://unpkg.com/cornerstone-core"></script>
<script src="https://unpkg.com/cornerstone-math"></script>
<script src="https://unpkg.com/cornerstone-wado-image-loader"></script>
<script src="https://unpkg.com/cornerstone-web-image-loader@2.1.1/dist/cornerstoneWebImageLoader.js"></script>
<script src="https://unpkg.com/cornerstone-tools@%5E4"></script> --}}

<script src="{{asset('public/js/cornerstone/hammer.js')}}"></script>
<script src="{{asset('public/js/cornerstone/dicomParser.min.js')}}"></script>
<script src="{{asset('public/js/cornerstone/cornerstone.js')}}"></script>
<script src="{{asset('public/js/cornerstone/cornerstoneMath.min.js')}}"></script>
<script src="{{asset('public/js/cornerstone/cornerstoneTools.js')}}"></script>
<script src="{{asset('public/js/cornerstone/cornerstoneWADOImageLoader.bundle.min.js')}}"></script>
<script src="{{asset('public/js/cornerstone/cornerstoneWebImageLoader.js')}}"></script>

<script src="{{asset('public/js/jquery.min.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<script src="{{asset('public/js/moment.min.js')}}"></script>
<script>

    $(".btn-toggle-other").click(function(){
        $(".toggle-other").slideToggle();
    })
</script>
<script>

    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

    const getBase64StringFromDataURL = (dataURL) => dataURL.replace('data:', '').replace(/^.+,/, '');

    _initCornerstoneImageLoader()
    _initCornerstoneWADOImageLoader()
    var element = document.getElementById('dicomImage')

    // Init cornerstone tools
    cornerstoneTools.init();

    // cornerstone.enable(element)

    // create image list here
    var img_lg = $('.image-list-img').length
    var vdo_lg = $(".video").length
    var pdf_lg = $('.pdf-list').length
    var img_arr = []
    for(k=0;k<img_lg;k++){
        // let src = $($(".image-list-img")[k]).attr('src')
        let src = $($(".image-list-img")[k]).attr('src') != undefined ? $($(".image-list-img")[k]).attr('src') : $($(".image-list-img")[k]).data('src')
        img_arr.push(src)
    }

    let height11 = get_previewdiv_height(1)
    let width11  = get_previewdiv_width(1)
    $('#preview11').css('display', 'block')

    if(img_lg > 0){
        // img_arr[0] = 'wadouri:http://localhost/endocapture5.0/public/images/0002.DCM'
        let src = img_arr[0]

        $('#dicomImage').css('height', `${height11}px`)
        cornerstone.enable(element)

        img_arr[0] = (img_arr[0].includes('DCM') || img_arr[0].includes('DCM')) ? 'wadouri:' + img_arr[0] : img_arr[0]

        if((img_arr[0].includes('DCM') == true || img_arr[0].includes('DCM') == true)){
            get_dicom_dataset(element, src)
            get_dicom_data(src, 'dicomImage')
        } else {
            cornerstone.loadImage(img_arr[0]).then(function(image) {
                cornerstone.displayImage(element, image);
            });
        }

        $('#dicomImage').data("src",img_arr[0])
    }
    else if (vdo_lg > 0){
        let video = document.getElementsByClassName('video')[0];
        let src = $($(".video")[0]).attr('src')
        $('#dicomImage').attr("hidden",true);
        $('#preview11').append(`
            <video class="video-preview" src="${src}" type="video/mp4" height='${height11}' controls></video>
        `)
    } else if (pdf_lg > 0){
        let pdf_name = $($('.pdf-list')[0]).val()
        pdf_name = pdf_name.replaceAll(' ', '%20')
        $('#dicomImage').attr("hidden",true);
        $('#preview11').append(`
            <iframe src="${pdf_name}" frameborder="0" width="${width11-100}"  height="${height11}"></iframe>
        `)
    }

    // image
    var count_img = $('.image-list-img').length
    if(count_img!=0){
        $('.image-list').css('display', 'block')
        for(n=0;n<count_img;n++){
            let img_src = $($('.image-list-img')[n]).attr('src')
            if(img_src == undefined){
                let element = document.getElementsByClassName('image-list-img')[n]
                let src = 'wadouri:' + $($('.image-list-img')[n]).data('src')

                get_dicom_dataset(element, $($('.image-list-img')[n]).data('src'), get_only_imgno=true)

                cornerstone.enable(element)
                cornerstone.loadImage(src).then(function(image) {
                    cornerstone.displayImage(element, image);
                });

            }
    }
    }

    // pdf
    var url = '{{url("")}}/terra/patient/{{$hn}}/{{$studydate}}'
    var pdf_length = $('.pdf-list').length
    if(pdf_length != 0){
        $('.pdf-list-canvas').css('display', 'block')
        for(j=0;j<pdf_length;j++){
            let pdf_name = $($('.pdf-list')[j]).val()
            pdf_name = pdf_name.replaceAll(' ', '%20')
            var loadingTask = pdfjsLib.getDocument(pdf_name);
            // image-list-img
            $(".pdf-list-canvas .position-relative").append(`<canvas id='canvas_${pdf_name}' class='pdf-canvas' onclick="selected_left_menu('${pdf_name}', 'pdf')"></canvas><div class='box-number b04'>1</div>`)

            loadingTask.promise.then(function(pdf) {
                pdf.getPage(1).then(function(page) {
                    var scale = 1.5;
                    var viewport = page.getViewport({ scale: scale, });
                    var outputScale = window.devicePixelRatio || 1;

                    var canvas = document.getElementById(`canvas_${pdf_name}`);
                    var context = canvas.getContext('2d');

                    canvas.width = Math.floor(viewport.width * outputScale);
                    canvas.height = Math.floor(viewport.height * outputScale);
                    canvas.style.width = "100%";
                    canvas.style.height =  "auto";

                    var transform = outputScale !== 1
                    ? [outputScale, 0, 0, outputScale, 0, 0]
                    : null;

                    var renderContext = {
                        canvasContext: context,
                        transform: transform,
                        viewport: viewport
                    };
                    page.render(renderContext);
                });
            });
        }
    }

    function call_vdo(src){
        alert(src)
    }



    // dicom
    var count_img = $('.image-list-img').length
    for(n=0;n<count_img;n++){
        let img_src = $($('.image-list-img')[n]).attr('src')
        if(img_src == undefined){
            let element = document.getElementsByClassName('image-list-img')[n]
            let src = 'wadouri:' + $($('.image-list-img')[n]).data('src')


            get_dicom_dataset(element, $($('.image-list-img')[n]).data('src'), get_only_imgno=true)

            cornerstone.enable(element)
            cornerstone.loadImage(src).then(function(image) {
                cornerstone.displayImage(element, image);
            });

        }
    }

    // ----------------------------------------------------------------- //
    function get_dicom_data(src, choosen_div){
        var hn = "{{$hn}}"
        var studydate = "{{$studydate}}"
        var url = `http://localhost/terra/patient/${hn}/${studydate}`
        var src = (src.includes(url)) ? src : `${url}/` + src
        var oReq = new XMLHttpRequest();
        try {
            oReq.open("get", src, true);
        }
        catch(err){
            return false;
        }

        oReq.responseType = "arraybuffer";
        oReq.onreadystatechange = function(oEvent){
            if(oReq.readyState == 4){
                if(oReq.status == 200){
                    var byteArray = new Uint8Array(oReq.response);
                    dumpByteArray(byteArray, choosen_div);
                }
            }
        };
        oReq.send();

        return false;
    }

    function dumpByteArray(byteArray, choosen_div){
        var dataSet = dicomParser.parseDicom(byteArray)
        var tags = ['x00100010', 'x00100020', 'x00080060', 'x00100030', 'x00100040']

        var numFrames = !(dataSet.intString('x00280008')) ? 1 : dataSet.intString('x00280008')

        var name = dataSet.string(tags[0]) != undefined ? dataSet.string(tags[0]) : ''
        var id = dataSet.string(tags[1]) != undefined ? dataSet.string(tags[1]) : ''
        var modality = dataSet.string(tags[2]) != undefined ? dataSet.string(tags[2]) : ''
        var birthdate = dataSet.string(tags[2]) != undefined ? moment(dataSet.string(tags[3])).format('LL')  : ''
        var sex = dataSet.string(tags[2]) != undefined ? dataSet.string(tags[4]) : ''

        if(sex == 'M'){
            sex = 'Male'
        } else if(sex == 'F'){
            sex = 'Female'
        } else if (sex == 'O'){
            sex = 'Other'
        }

        $(`#${choosen_div}`).append(`
            <div id="${choosen_div}p" style="position: absolute; top:20px;left:0;right:0;left:20px">
                <p class="dcm-id">Patient ID: ${id}</p>
                <p class="dcm-name">Patient Name: ${name}</p>
                <p class="dcm-birthdate">Patient Birthdate: ${birthdate}</p>
                <p class="dcm-sex">Patient Sex: ${sex}</p>
                <p class="dcm-modality">Modality: ${modality}</p>
                Img: <input class="dcm-img-no" id="dcm_${choosen_div}" type="text" style="background-color : black; color:white;border:none; width: 10%" value="1/${numFrames}">
            </div>
        `)
    }

    function get_dicom_dataset(element, src, get_only_imgno=false){
        var loaded = false
        // var src = (src.includes(url)) ? src : `${url}/` + src
        var oReq = new XMLHttpRequest();
        var dataset;
        try {
            oReq.open("get", src, true);
            oReq.responseType = "arraybuffer";
            oReq.onreadystatechange = function(oEvent){
                if(oReq.readyState == 4){
                    if(oReq.status == 200){
                        var byteArray = new Uint8Array(oReq.response);
                        dataset = dicomParser.parseDicom(byteArray)
                        if(get_only_imgno == true){
                            let numFrames = (dataset.intString('x00280008') != undefined) ? dataset.intString('x00280008') : 1
                            let num_div = document.createElement("div");
                            num_div.classList.add('box-number')
                            num_div.innerHTML = numFrames
                            element.append(num_div)
                        } else {
                            init_multiframe_images(dataset, element, src, loaded)
                        }
                    }
                }
            };
            oReq.send();
        }
        catch(err){
            return false;
        }

    }

    function init_multiframe_images(dataSet, element, url, loaded) {
        var numFrames = dataSet.intString('x00280008');
        var FrameRate = 1000/dataSet.floatString('x00181063');
        if(!numFrames) {
            numFrames = 1
        }

        var imageIds = [];
        var imageIdRoot = 'wadouri:' + url;

        for(var i=0; i < numFrames; i++) {
            var imageId = imageIdRoot + "?frame="+i;
            imageIds.push(imageId);
        }

        var stack = {
            currentImageIdIndex : 0,
            imageIds: imageIds
        };

        cornerstone.loadAndCacheImage(imageIds[0]).then(function(image) {
            cornerstoneWADOImageLoader.wadouri.dataSetCacheManager.unload(url);
            cornerstone.displayImage(element, image);
            if(loaded === false) {
                const StackScrollMouseWheelTool = cornerstoneTools.StackScrollMouseWheelTool
                cornerstoneTools.addTool(StackScrollMouseWheelTool)
                cornerstoneTools.setToolActive('StackScrollMouseWheel', {  })

                let img_index;
                element.addEventListener('cornerstonenewimage', function (e) {
                    let id = element.id
                    id = $(`#${id}`).parent()[0].id
                    img_index = e.detail.image.imageId.replace(`wadouri:${url}?frame=`, '')
                    $(`#dcm_${id}`).val(`${parseInt(img_index) + 1}/${numFrames}`)
                })

                cornerstoneTools.addStackStateManager(element, ['stack', 'playClip']);
                cornerstoneTools.addToolState(element, 'stack', stack);
                loaded = true;
            }
        }, function(err) {
            alert(err);
        });
    }

    function get_fps_slider(){
        let fps = $("#framerate_sld").val()
        $("#framerate_txt").text(`${fps}fps`)

        let choosen_div = $('#selected_div').val()
        let element_id = choosen_div == 'preview11' ? 'dicomImage' : `${choosen_div}img`
        let element = document.getElementById(element_id)
        cornerstoneTools.playClip(element, fps);
    }

    function _initCornerstoneImageLoader() {
        cornerstoneWebImageLoader.external.cornerstone = cornerstone;
    }

    function _initCornerstoneWADOImageLoader() {
        let baseUrl = 'https://tools.cornerstonejs.org/examples/'

        cornerstoneWADOImageLoader.external.cornerstone = cornerstone;
        cornerstoneWADOImageLoader.external.dicomParser = dicomParser;
        // Image Loader
        const config = {
            webWorkerPath: `${baseUrl}assets/image-loader/cornerstoneWADOImageLoaderWebWorker.js`,
            taskConfiguration: {
            decodeTask: {
                codecsPath: `${baseUrl}assets/image-loader/cornerstoneWADOImageLoaderCodecs.js`,
            },
            },
        };
        cornerstoneWADOImageLoader.webWorkerManager.initialize(config);
    }

    // --------------------------------------------------------------------- //

    function get_previewdiv_height(row) {
        let height = $('#preview_div').height()
        let child_height = (height / row) - 20
        return child_height
    }

    function get_previewdiv_width(column) {
        let width = $('#preview_div').width()
        let child_width = (width / column) - 20
        return child_width
    }

    function get_xy_from_divid(string) {
        let xy = string.replace('preview', '').split('')
        let arr = []
        arr['x'] = xy[0]
        arr['y'] = xy[1]
        return arr
    }

    function get_last_display_div(){
        let last_div = ''
        for(let i=1;i<=3;i++){
            for(let j=1;j<=3;j++){
                if($(`#preview${i}${j}`).css('display') == 'block' || $(`#preview${i}${j}`).css('display') == 'flex'){
                    last_div = `preview${i}${j}`
                }
            }
        }
        return last_div
    }

    // --------------------------------------------------------------------- //

    function choose_layout() {
        if ( $('#layout_tool').hasClass('is-video') ) {
            return false;
        }

        let is_show = $('#layout_chooser').is(':visible')
        if(is_show == true){
            $('#layout_chooser').hide()
        } else {
            $('#layout_chooser').show()
        }
    }

    function color_cell(id){
        let num_x = id.substring(4,5)
        let num_y = id.substring(5,6)

        for(let i=1;i<=num_x;i++){
            for(let j=1;j<=num_y;j++){
                $(`#cell${i}${j}`).attr('style', 'background-color:#274472;width: 20px; height: 20px; border: 1px solid black;')
            }
        }
    }

    function clear_color_cell(){
        let num_x = 3
        let num_y = 3

        for(let i=1;i<=num_x;i++){
            for(let j=1;j<=num_y;j++){
                $(`#cell${i}${j}`).attr('style', 'width: 20px; height: 20px; border: 1px solid black;')
            }
        }
    }

    // function to onclick previewdiv
    function selected_div(id) {
        $('#selected_div').val(id)
        for(i=1;i<=3;i++){
            for(j=1;j<=3;j++){
                let id_txt = `#preview${i}${j}`
                $(id_txt).removeClass('div-border')
                if(id_txt == `#${id}`){
                    $(id_txt).addClass('div-border')
                }
            }
        }
    }

    // function to onclick left item menu
    function selected_left_menu(src, type) {

        var newurl = "http://localhost/terra/patient/53451020220519/20220519";
        var newurl = "{{$patientdicom}}";
        url = newurl;

        let choosen_div = $('#selected_div').val() // default at preview11
        // get x and y
        let pos  = get_xy_from_divid(get_last_display_div())
        let xrow = pos['x']
        let yrow = pos['y']
        let width = get_previewdiv_width(yrow) - ( 30 * (4 - yrow))
        let height = get_previewdiv_height(xrow) - (30 * (4 - xrow))

        if(choosen_div == 'preview11'){
            $('#dicomImage').attr("hidden",true);
        }


        if(type == 'image'){
            change_tool_status(type)


            $(`#${choosen_div}`).find('*').not('#dicomImage').not('.cornerstone-canvas').remove();

            if(choosen_div == 'preview11'){
                element = document.getElementById('dicomImage')
                $('#dicomImage').attr("hidden",false);
                $('#dicomImage').find('.cornerstone-canvas')[0].style = `display:block;`
                $('#dicomImage').find('.cornerstone-canvas')[0].width = $(`#preview11`).width()
                $('#dicomImage').find('.cornerstone-canvas')[0].height = $(`#preview11`).height()
                $(`#dicomImage`).data("src",`${url}/` + src)
            } else {
                $(`#${choosen_div}`).append(`
                    <div id="${choosen_div}img" class="image-preview" style="width:100%;height:100%" oncontextmenu="return false" onmousedown="return false"></div>
                `)
                let txt = `${choosen_div}img`
                element = document.getElementById(txt)
                cornerstone.enable(element)
                src = src.includes('DCM') || src.includes('dcm') ? `${url}/` + src : src
                $(`#${choosen_div}img`).data("src",src)
            }

            if(src.includes('DCM') == true || src.includes('dcm') == true){
                get_dicom_data(src, choosen_div)
            }

            let ori_src = (src.includes(url) == false) ? `${url}/` + src : src
            src = (src.includes('DCM') == true || src.includes('dcm') == true) && (src.includes(url) == false)? `wadouri:${url}/` + src : `wadouri:${src}`

            if((src.includes('DCM') || src.includes('dcm')) == true){
                get_dicom_dataset(element, ori_src)
            } else {
                src = src.replace('wadouri:','')
                cornerstone.loadImage(src).then(function(image) {
                    cornerstone.displayImage(element, image);
                });
            }

        } else if(type == 'video'){
            change_tool_status(type)


            $(`#${choosen_div}`).find('*').not('#dicomImage').not('.cornerstone-canvas').remove();
            $(`#${choosen_div}`).append(`
                <video class="video-preview" src="${src}" type="video/mp4" width='${width}' height='${height}'  controls></video>
            `)
        } else if(type == 'pdf'){
            $(`#${choosen_div}`).find('*').not('#dicomImage').not('.cornerstone-canvas').remove();
            $(`#${choosen_div}`).append(`
                <iframe class="pdf-file" src="${src}" frameborder="0" height="${height}" width="${width}"></iframe>
            `)

        }
    }

    function change_tool_status(file_type){
        // show or hide tool tab
        var ck_lg = $('.check-video').length
        if(file_type == 'video'){
            $('#layout_tool').addClass('is-video')
            $('#scroll_tool').addClass('is-video')
            $('#pan_tool').addClass('is-video')
            $('#zoom_tool').addClass('is-video')
            $('#reset_tool').addClass('is-video')
            $('#invert_color_tool').addClass('is-video')
            $('#window_tool').addClass('is-video')
            $('.dropdown-toggle').attr('data-bs-toggle', '')

            for (let i = 0; i < ck_lg; i++) {
                $($('.check-video')[i]).addClass('text-muted')
            }
        } else {
            $('#pan_tool').removeClass('is-video')
            $('#zoom_tool').removeClass('is-video')
            $('#reset_tool').removeClass('is-video')
            $('#scroll_tool').removeClass('is-video')
            $('#layout_tool').removeClass('is-video')
            $('#window_tool').removeClass('is-video')
            $('.dropdown-toggle').attr('data-bs-toggle', 'dropdown')
            $('#invert_color_tool').removeClass('is-video')

            for (let i = 0; i < ck_lg; i++) {
                $($('.check-video')[i]).removeClass('text-muted')
            }
        }
    }

    function selected_first_active_div(){
        for(i=1;i<=3;i++){
            for(j=1;j<=3;j++){
                let have_class = $(`#preview${i}${j}`).hasClass('div-border')
                if(have_class == true){
                    $(`#preview${i}${j}`).removeClass('div-border')
                }
            }
        }
        $(`#preview11`).addClass('div-border')
        $('#selected_div').val('preview11')
    }

    arr_elements = []
    var arr_src = []
    var arr_div = []
    function set_layout(id){
        let prev_selected = get_last_display_div().replace('preview', 'cell')
        if(prev_selected == id){
            return;
        }

        selected_first_active_div()
        let num_x = id.substring(4,5)
        let num_y = id.substring(5)

        var img_lg = $('.image-list-img').length
        var vdo_lg = $(".video").length
        var pdf_lg = $('.pdf-list').length
        var arr = []
        var num_arr = []
        for(k=0;k<img_lg;k++){
            let src = $($(".image-list-img")[k]).attr('src')
            src = (src == undefined) ? $($(".image-list-img")[k]).data('src') : src
            arr.push(src)
        }
        for(k=0;k<vdo_lg;k++){
            let src = $($(".video")[k]).attr('src')
            arr.push(src)
        }
        for(k=0;k<pdf_lg;k++){
            let pdf_name = $($('.pdf-list')[k]).val()
            pdf_name = pdf_name.replaceAll(' ', '%20')
            src = `${pdf_name}`
            arr.push(src)
        }

        for(i=1;i<=3;i++){
            for(j=1;j<=3;j++){
                num_arr.push(`${i}${j}`)
                if( i==1 && j==1){
                    let src = $(`#dicomImage`).data('src')
                    arr.splice(arr.indexOf(src), 1)

                    // arr_elements.push($('#dicomImage')[0])
                } else {
                    let src = $(`#preview${i}${j}img`).data('src')
                    if((src != null || src != undefined) && arr.indexOf(src) > -1){
                        arr.splice(arr.indexOf(src), 1)
                    }

                    let image_preview = $(`#preview${i}${j} #preview${i}${j}img`)
                    let div_preview = $(`#preview${i}${j} #preview${i}${j}p`)
                    if (image_preview.length > 0 && arr_elements.indexOf(image_preview[0]) == -1){
                        arr_elements.push(image_preview[0])
                        arr_div.push(div_preview[0])
                        let src = $(`#preview${i}${j}img`).data("src")
                        src = (src.includes('wadouri:')) ? src.replace('wadouri:','') : src
                        arr_src.push(src)
                    }
                }
            }
        }

        // if exist in arr from arr_src, remove!
        let src_length = arr_src.length
        for(z=0;z<src_length;z++){
            if(arr.indexOf(arr_src[z]) > -1){
                arr.splice(arr.indexOf(arr_src[z]), 1)
            }
        }

        let src11_canvas_status = $('#dicomImage').is(":visible")
        let canvas_status = src11_canvas_status == true ? 'block' : 'none'

        // get x and y
        let pos  = get_xy_from_divid(get_last_display_div())
        let xrow = pos['x']
        let yrow = pos['y']
        let width = get_previewdiv_width(yrow) - ( 30 * (4 - yrow))
        let height = get_previewdiv_height(xrow) - (30 * (4 - xrow))

        let margin_left =  0

        let divw = 400
        let divh = $('#preview_div').height() / parseInt(num_x)
        divh = ((num_x == '1') && (num_y == '2' || num_y == '3')) ? ($('#preview_div').height() / 2) - 30 : ($('#preview_div').height() / parseInt(num_x)) - 30
        divw = ((num_x == '1') && (num_y == '2' || num_y == '3')) ? ($('#preview_div').width() / parseInt(num_y)) - 20 : divw

        if(num_x == 1 && num_y == 1){
            divh = $('#preview_div').height() - 50
            divw = $('#preview_div').width() - 50
        }

        arr_index = 0
        arr_elements_index = 0
        for(i=1;i<=parseInt(num_x);i++){
            for(j=1;j<=parseInt(num_y);j++){
                margin_left = ((num_y == '1') && (num_x == '2' || num_x == '3')) ? 85 : 0

                if(((num_y == '2') && (num_x == '2')) ){
                    margin_left = 20
                } else if (((num_y == '2') && (num_x == '3'))){
                    margin_left = 30
                }

                if(num_x == '1' && num_y == '1'){
                    $('#preview_div').width($('#main_div').width()-10)
                    $('#preview_div').height($('#main_div').height()-50)
                }

                if(i==1 && j==1){
                    $(`#preview${i}${j}`).width(divw).height(divh)

                    $(`#preview${i}${j}`).find('.cornerstone-canvas')[0].width = divw
                    $(`#preview${i}${j}`).find('.cornerstone-canvas')[0].height = divh

                    $(`#preview${i}${j}`).find('.video-preview').attr({width: `${divw}px`, height: `${divh}px`})

                    if((num_y == '1') && (num_x == '2' || num_x == '3')){
                         margin_left = 30
                    } else if((num_y == '2') && (num_x == '2') ){
                        margin_left = 15
                    } else if((num_y == '2') && (num_x == '3') ){
                        margin_left = 20
                    }

                    $('#dicomImage').find('.cornerstone-canvas')[0].style = `display:${canvas_status};width: ${divw};height:${divh};margin-left:${margin_left}%;`
                    $('#dicomImage .cornerstone-canvas').addClass('img-fluid')
                    console.log('ff', divw);
                } else {
                    if(i == 2 || i == 3){
                        $(`#preview${i}${j}`).css('min-width', `${divw}px`)
                        $(`#preview${i}${j}`).css('min-height', `${divh}px`)
                    } else {
                        $(`#preview${i}${j}`).css('min-width', ``)
                        $(`#preview${i}${j}`).css('min-height', ``)
                    }
                    $(`#preview${i}${j}`).width(divw).height(divh)

                    $(`#preview${i}${j}`).empty()

                    let ori_src = arr[arr_index]

                    if(arr_elements_index < arr_elements.length){
                        // Problem here
                        $(`#preview${i}${j}`).addClass('bg-black')
                        arr_elements[arr_elements_index].id = `preview${i}${j}img`
                        $(`#preview${i}${j}`).css('display', 'block', arr_elements_index)
                        $(`#preview${i}${j}`).append(arr_elements[arr_elements_index])

                        if((arr_src[arr_elements_index].includes('.DCM') || arr_src[arr_elements_index].includes('.dcm')) == true && (arr_div[arr_elements_index] != undefined) ){
                            arr_div[arr_elements_index].id = `preview${i}${j}p`
                            $(`#preview${i}${j}`).append(arr_div[arr_elements_index])
                        }

                        arr_elements_index += 1

                        $(`#preview${i}${j}img .cornerstone-canvas`).attr('style' , `display: block;width:${divw}px;height:${divh}px;margin-left:${margin_left}%`)
                        $(`#preview${i}${j}`).find('.cornerstone-canvas')[0].width = divw
                        $(`#preview${i}${j}`).find('.cornerstone-canvas')[0].height = divh

                        var element = document.getElementById(`preview${i}${j}`)
                        cornerstone.enable(element)
                        const viewport = cornerstone.getViewport(element);

                        $(`#preview${i}${j}img`).css('z-index', 3000);

                        $(`#preview${i}${j}p`).css('z-index', 3000);
                    }

                    if($(`#preview${i}${j}`).children().length == 0){
                        $(`#preview${i}${j}`).addClass('bg-black')
                        $(`#preview${i}${j}`).css('display', 'block')

                        if(arr_index < arr.length){
                            if(arr[arr_index].includes('.pdf') == true){
                                $(`#preview${i}${j}`).append(`
                                    <iframe class="pdf-file" src="${arr[arr_index]}" frameborder="0" style="width: ${divw}px;height: ${divh}px"></iframe>
                                `)
                            } else if(arr[arr_index].includes('.mp4') == true) {
                                $(`#preview${i}${j}`).append(`
                                    <video class="video-preview" src="${arr[arr_index]}" type="video/mp4" style="width: ${divw}px;height: ${divh}px" controls></video>
                                `)
                            } else if(arr[arr_index].includes('.png') == true || arr[arr_index].includes('.jpg') == true || arr[arr_index].includes('.dcm') == true || arr[arr_index].includes('.DCM') == true) {
                                $(`#preview${i}${j}`).append(`
                                    <div id="preview${i}${j}img" class="image-preview img-fluid" style="width: ${divw}px;height: ${divh}px" oncontextmenu="return false" onmousedown="return false"></div>
                                `)

                                let element = document.getElementById(`preview${i}${j}img`)
                                cornerstone.enable(element)

                                arr[arr_index] = (arr[arr_index].includes('.dcm') == true || arr[arr_index].includes('.DCM') == true) ? 'wadouri:' + arr[arr_index] : arr[arr_index]
                                if((arr[arr_index].includes('DCM') || arr[arr_index].includes('dcm')) == true){
                                    get_dicom_dataset(element, ori_src)
                                    get_dicom_data(ori_src, `preview${i}${j}`)
                                } else {
                                    cornerstone.loadImage(arr[arr_index]).then(function(image) {
                                        cornerstone.displayImage(element, image);
                                    });
                                }

                                $(`#preview${i}${j}img`).data("src",arr[arr_index])

                                $(`#preview${i}${j}img .cornerstone-canvas`).addClass('img-fluid')

                                $(`#preview${i}${j}img .cornerstone-canvas`).attr('style' , `display: block;width:${divw}px;height:${divh}px;margin-left:${margin_left}%`)
                                $(`#preview${i}${j}`).find('.cornerstone-canvas')[0].width = divw
                                $(`#preview${i}${j}`).find('.cornerstone-canvas')[0].height = divh
                                // $(`#preview${i}${j}img .cornerstone-canvas`).addClass('img-fluid').addClass('m-auto')
                            }
                        }
                        arr_index += 1
                    }
                }
                // $(`#dicomImage`).width(divw).height(divh)

                $(`#preview11`).find('.cornerstone-canvas')[0].width = divw
                $(`#preview11`).find('.cornerstone-canvas')[0].height = divh
                console.log(divw);
                num_arr.splice(num_arr.indexOf(`${i}${j}`), 1)
            }
        }

        let to_exist = []
        if(num_x == '1' && num_y == '2'){
            to_exist = ['21','22']
        } else if (num_x == '1' && num_y == '3'){
            to_exist = ['21','22','23']
        }


        if(to_exist.length > 0){
            for(n=0;n<to_exist.length;n++){
                $(`#preview${to_exist[n]}`).css('display', 'block')
                $(`#preview${to_exist[n]}`).addClass('bg-black')
                $(`#preview${to_exist[n]}`).css('min-height',`${divh}px`)
                if(num_arr.indexOf(to_exist[n]) > -1){
                    num_arr.splice(num_arr.indexOf(to_exist[n]), 1)
                }
            }
        }

        for(y=0;y<num_arr.length;y++){
            // $(`#preview${num_arr[y]}`).empty()
            $(`#preview${num_arr[y]}`).css('display', 'none')
        }

        $('#layout_chooser').hide()
    }

    // ----------------------------------------------------------------- //

    // tools
    function pan_image(){
        if ( $('#pan_tool').hasClass('is-video') ) {
            return false;
        }

        disableAllTools()
        const PanTool = cornerstoneTools.PanTool;
        cornerstoneTools.addTool(PanTool)
        cornerstoneTools.setToolActive('Pan', { mouseButtonMask: 1 })
    }

    function zoom_image(){
        if ( $('#zoom_tool').hasClass('is-video') ) {
            return false;
        }

        disableAllTools()
        const ZoomTool = cornerstoneTools.ZoomTool;
        cornerstoneTools.addTool(ZoomTool)
        cornerstoneTools.setToolActive('Zoom', { mouseButtonMask: 1 })
    }

    function invert_image_vertical(){
        disableAllTools()
        const viewport = cornerstone.getViewport(element);
        viewport.vflip = !viewport.vflip;
        cornerstone.setViewport(element, viewport);
    }

    function invert_image_horizontal(){
        disableAllTools()
        const viewport = cornerstone.getViewport(element);
        viewport.hflip = !viewport.hflip;
        cornerstone.setViewport(element, viewport);
    }

    function key_image(){
        disableAllTools()
        let selected_div_id = $('#selected_div').val()
        var canvas = $(`#${selected_div_id}`).find('.cornerstone-canvas')[0]
        var formData = new FormData()
        canvas.toBlob(function(blob){
            let datetime = moment().format('YYMMDDHHmmss')
            let date = moment().format('YYYY-MM-DD')
            let image_name = `${datetime}.png`
            let hn = "{{$hn}}"
            formData.append('image', blob, image_name)
            formData.append('date', date)
            formData.append('hn', hn)
            formData.append('event', 'capture_image')

            let url = "{{url("")}}"
            $.ajax({
                data: formData,
                type: "POST",
                dataType: "JSON",
                url: `${url}/terra/viewer`,
                processData: false,
                contentType: false,
            });
        }, 'image/jpeg', 0.95)

        $('#capture_bt').click()

        // $('#dicomImage').width(500).height(500)
    }

    $('#capture_bt').on('click', () =>{
        setTimeout(() => {
            $('#capture_md').modal('hide')
        }, 500);
    })

    function cap_image(){
        html2canvas(document.querySelector("#preview_div")).then(canvas => {
            document.body.appendChild(canvas)
        });
    }

    function window_level_image(){
        if ( $('#window_tool').hasClass('is-video') ) {
            return false;
        }

        disableAllTools()
        const WwwcTool = cornerstoneTools.WwwcTool;

        cornerstoneTools.addTool(WwwcTool)
        cornerstoneTools.setToolActive('Wwwc', { mouseButtonMask: 1 })
    }

    function invert_color_image(){
        if ( $('#invert_color_tool').hasClass('is-video') ) {
            return false;
        }

        disableAllTools()
        const viewport = cornerstone.getViewport(element);
        viewport.invert = !viewport.invert;
        cornerstone.setViewport(element, viewport);
    }

    function get_tools(toolname){
        switch (toolname) {
            case 'arrow':
                const ArrowAnnotateTool = cornerstoneTools.ArrowAnnotateTool;
                cornerstoneTools.addTool(ArrowAnnotateTool)
                cornerstoneTools.setToolActive('ArrowAnnotate', { mouseButtonMask: 1 })
                break;
            case 'text_marker':
                const TextMarkerTool = cornerstoneTools.TextMarkerTool
                const configuration = {
                    markers: ['F5', 'F4', 'F3', 'F2', 'F1'],
                    current: 'F5',
                    ascending: true,
                    loop: true,
                }
                cornerstoneTools.addTool(TextMarkerTool, { configuration })
                cornerstoneTools.setToolActive('TextMarker', { mouseButtonMask: 1 })
                break;
            case 'length':
                const LengthTool = cornerstoneTools.LengthTool;
                cornerstoneTools.addTool(LengthTool)
                cornerstoneTools.setToolActive('Length', { mouseButtonMask: 1 })
                break;
            case 'ellipse':
                const EllipticalRoiTool = cornerstoneTools.EllipticalRoiTool;
                cornerstoneTools.addTool(EllipticalRoiTool)
                cornerstoneTools.setToolActive('EllipticalRoi', { mouseButtonMask: 1 })
                break;
            case 'rectangle':
                const RectangleRoiTool = cornerstoneTools.RectangleRoiTool;
                cornerstoneTools.addTool(RectangleRoiTool)
                cornerstoneTools.setToolActive('RectangleRoi', { mouseButtonMask: 1 })
                break;
            case 'polygon':
                const FreehandRoiTool = cornerstoneTools.FreehandRoiTool;
                cornerstoneTools.addTool(FreehandRoiTool)
                cornerstoneTools.setToolActive('FreehandRoi', { mouseButtonMask: 1 })
                break;
            case 'angle':
                const AngleTool = cornerstoneTools.AngleTool;
                cornerstoneTools.addTool(AngleTool)
                cornerstoneTools.setToolActive('Angle', { mouseButtonMask: 1 })
                break;
            case 'cobb_angle':
                const CobbAngleTool = cornerstoneTools.CobbAngleTool;
                cornerstoneTools.addTool(CobbAngleTool)
                cornerstoneTools.setToolActive('CobbAngle', { mouseButtonMask: 1 })
                break;
            case 'probe':
                const ProbeTool = cornerstoneTools.ProbeTool;
                cornerstoneTools.addTool(ProbeTool)
                cornerstoneTools.setToolActive('Probe', { mouseButtonMask: 1 })
                break;
            case 'bidirectional':
                const BidirectionalTool = cornerstoneTools.BidirectionalTool;
                cornerstoneTools.addTool(BidirectionalTool)
                cornerstoneTools.setToolActive('Bidirectional', { mouseButtonMask: 1 })
                break;
            case 'erasor':
                const EraserTool = cornerstoneTools.EraserTool;
                cornerstoneTools.addTool(EraserTool);
                cornerstoneTools.setToolActive("Eraser", { mouseButtonMask: 1 });
                break;
            case 'magnify':
                const MagnifyTool = cornerstoneTools.MagnifyTool;
                cornerstoneTools.addTool(MagnifyTool)
                cornerstoneTools.setToolActive('Magnify', { mouseButtonMask: 1 })
                break;
        }
    }

    function fit_image(){
        element.style.width = '512x';
        element.style.height = '512px';
        cornerstone.resize(element);
    }

    function reset_image(){
        if ( $('#reset_tool').hasClass('is-video') ) {
            return false;
        }

        cornerstone.reset(element)
        var toolStateManager = cornerstoneTools.globalImageIdSpecificToolStateManager;
        toolStateManager.clear(element);
        cornerstoneTools.external.cornerstone.updateImage(element);
    }

    function scroll_image(params) {
        if ( $('#scroll_tool').hasClass('is-video') ) {
            return false;
        }

        disableAllTools()
        const StackScrollMouseWheelTool = cornerstoneTools.StackScrollMouseWheelTool
        cornerstoneTools.addTool(StackScrollMouseWheelTool)
        cornerstoneTools.setToolActive('StackScrollMouseWheel', { })
    }

    function rotate_right(){
        disableAllTools()
        const viewport = cornerstone.getViewport(element);
        viewport.rotation += 90;
        cornerstone.setViewport(element, viewport);
    }

    function disableAllTools() {
        const options = {
            mouseButtonMask: 4
          };

        const tool_names = ['Angle', 'ArrowAnnotate', 'CobbAngle', 'EllipticalRoi', 'FreehandRoi',
        'Length', 'Probe', 'RectangleRoi', 'TextMarker', 'Magnify', 'Erasor',
        'Bidirectional']

        for(i=0;i<tool_names.length;i++){
            cornerstoneTools[`setToolPassive`](tool_names[i], options);
        }

    }

    function play_clip(){
        let choosen_div = $('#selected_div').val()
        let element_id = choosen_div == 'preview11' ? 'dicomImage' : `${choosen_div}img`
        let element = document.getElementById(element_id)
        let FrameRate = $("#framerate_sld").val()
        cornerstoneTools.playClip(element, FrameRate);
    }

    function stop_clip(){
        let choosen_div = $('#selected_div').val()
        let element_id = choosen_div == 'preview11' ? 'dicomImage' : `${choosen_div}img`
        let element = document.getElementById(element_id)
        cornerstoneTools.stopClip(element);
    }

    function clear_tools(){
        var toolStateManager = cornerstoneTools.globalImageIdSpecificToolStateManager;
        toolStateManager.clear(element);
        cornerstoneTools.external.cornerstone.updateImage(element);
        disableAllTools()
    }


</script>

@endsection
