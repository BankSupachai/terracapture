@extends('layouts.layout_empty')


@section('title', 'Endocapture')

@section('style')
<link href="{{url("public/assets5/css/viewer.css")}}" rel="stylesheet" type="text/css" />
<style>


</style>

@endsection

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
                <!-- LOGO -->
                <div class="navbar-brand-box horizontal-logo">
                    <a href="{{url('/')}}" class="logo logo-dark ">
                        <span class="logo-sm">
                            <img src="{{url('public/images/TERRA_ small_white.png')}}" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img alt="Logo" src="{{url('public/images/Group 9.png')}}" style="height:2.5em;"/>
                        </span>
                    </a>
                    <!-- Light Logo-->
                    <a href="{{url('/')}}" class="logo logo-light">
                        <span class="logo-sm">
                            <img src="{{url('public/images/TERRA_ small_white.png')}}" alt="" height="22">
                        </span>
                        <span class="logo-lg">
                            <img alt="Logo" src="{{url('public/images/Group 9.png')}}" style="height:2.5em;"/>
                        </span>
                    </a>
                </div>

            </div>
            <div class="d-flex">
                <ul class="nav nav-pills">

                    <li class="nav-item">
                        <a href="#custom-hover-reviews" data-bs-toggle="tab" aria-expanded="false" class="nav-link " onclick="choose_layout()">
                            <i class="ri-layout-4-line d-toggle"></i>
                            <h5 class="nav-titl nav-tab-position m-0">Layout</h5>
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
                    <li class="nav-item" onclick="scroll_image()">
                        <a href="#custom-hover-reviews" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                            <i class="mdi mdi-pan-vertical nav-icon nav-tab-position"></i>
                            <h5 class="nav-titl nav-tab-position m-0">Scroll</h5>
                        </a>
                    </li>
                    <li class="nav-item" onclick="pan_image()">
                        <a href="#custom-hover-customere" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                            <i class="las la-arrows-alt nav-icon nav-tab-position mt-1"></i>
                            <h5 class="nav-titl nav-tab-position m-0 mt-1">Pan</h5>
                        </a>
                    </li>
                    <li class="nav-item" onclick="zoom_image()">
                        <a href="#custom-hover-description" data-bs-toggle="tab" aria-expanded="true" class="nav-link">
                            <i class="mdi mdi-magnify-plus-outline nav-icon nav-tab-position"></i>
                            <h5 class="nav-titl nav-tab-position m-0">Zoom</h5>
                        </a>
                    </li>
                    <li class="nav-item" onclick="reset_image()">
                        <a href="#custom-hover-reviews" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                            <i class="las la-undo-alt nav-icon nav-tab-position mt-1"></i>
                            <h5 class="nav-titl nav-tab-position m-0 mt-1">Reset</h5>
                        </a>
                    </li>
                    <li class="nav-item" onclick="invert_color_image()">
                        <a href="#custom-hover-reviews" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                            <i class=" ri-layout-column-fill nav-icon nav-tab-position"></i>
                            <h5 class="nav-titl nav-tab-position m-0">Invert</h5>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#custom-hover-reviews" data-bs-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
                            <i class="ri-clockwise-fill nav-icon nav-tab-position"></i>
                            <h5 class="nav-titl nav-tab-position m-0">Rotate</h5>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="javascript:;" class="dropdown-item" onclick="rotate_right()">Rotate right</a></li>
                            <li><a href="javascript:;" class="dropdown-item" onclick="get_tools('magnify')">Magnify</a></li>
                            <li><a href="javascript:;" class="dropdown-item" onclick="invert_image_vertical()">Flip vertical</a></li>
                            <li><a href="javascript:;" class="dropdown-item" onclick="invert_image_horizontal()">Flip horizontal</a></li>
                        </ul>
                    </li>
                    <li class="nav-item" onclick="window_level_image()">
                        <a href="#custom-hover-reviews" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                            <i class="las la-adjust nav-icon nav-tab-position mt-2"></i>
                            <h5 class="nav-titl nav-tab-position m-0 mt-1">Contrast</h5>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="#custom-hover-reviews" data-bs-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
                            <i class="ri-file-edit-fill nav-icon nav-tab-position d-toggle"></i>
                            <h5 class="nav-titl nav-tab-position m-0">Anotate</h5>
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
                        <a href="#custom-hover-reviews" data-bs-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
                            <i class="ri-play-fill nav-icon nav-tab-position"></i>
                            <h5 class="nav-titl nav-tab-position m-0">Cine</h5>
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
                        <a href="#custom-hover-reviews" data-bs-toggle="tab" aria-expanded="false" class="nav-link" onclick="key_image()">
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
                            <i class=" ri-more-line nav-icon nav-tab-position mt-2"></i>
                            <h5 class="nav-titl nav-tab-position m-0 mt-1">Other</h5>
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
</header>

<div>
    @foreach ($videos as $video)
        <video class="video" src="http://localhost/terra/patient/{{$tb_case->case_hn}}/{{$tb_case->studydate}}/{{$video}}" type="video/mp4" controls style="width: 0px;"></video>
    @endforeach
</div>
<div>
    @foreach ($pdfs as $pdf)
        <input type="hidden" class="pdf-list" value="http://localhost/terra/patient/{{$tb_case->case_hn}}/{{$tb_case->studydate}}/{{$pdf}}">
    @endforeach
</div>

<div class="row m-0 h-100vh pt-6em">
    <div class="col-1 p-0 bg-black menu-left-list">
        <div class="row m-0 left-list cn">
            <div class="col-lg-2"></div>
            <div class="col-lg-10 text-white h5">
                ID: {{@$tb_case->hn}}
            </div>
            <div class="col-lg-2"></div>
            <div class="col-lg-10 text-white h5 mb-0">
                Modality : {{@$tb_case->modality}}
            </div>
        </div>
        <div class="row m-0 file-list d-block">

            <div class="procedure-task">{{@$tb_case->procedure_name}}</div>
            <div class="menu-list-image col-12 p-4 mt-2 text-center image-list">
                @foreach ($images as $img)
                    <div class="position-relative">
                        <img src="http://localhost/terra/patient/{{$tb_case->case_hn}}/{{$tb_case->studydate}}/{{$img}}" class="w-100 image-list-img" onclick="selected_left_menu(this.src, 'image')">
                        <div class="box-number">1</div>
                    </div>
                @endforeach
                @isset($dicom)
                    @foreach ($dicom as $dcm)
                        <div data-src="http://localhost/terra/patient/{{$tb_case->case_hn}}/{{$tb_case->studydate}}/{{$dcm}}" class="w-100 image-list-img position-relative" style="max-width: 100%" onclick="selected_left_menu('{{$dcm}}', 'image')"></div>
                    @endforeach
                @endisset




            </div>
            <div class="menu-list-image col-12 p-4 text-center video-list">
                <div class="position-relative"></div>
                {{-- <h4>VIDEO</h4> --}}
            </div>
            <div class="menu-list-image col-12 p-4 text-center pdf-list-canvas">
                <div class="position-relative"></div>
                {{-- <h4>PDF</h4> --}}
            </div>
        </div>
    </div>
    <div class="col pr-0" style="height: 100%;">
        <div class="row m-0 cn" id="preview_div" style="height: 100%;" >
            {{-- <div class="col-12 p-0 bg-black" id="preview11_div">
            </div> --}}

            <div class="col-12 px-5 py-3 bg-black div-border" id="preview11" onclick="selected_div(this.id)" style="height: 100%; min-width: 500px; position: relative">
                <div id="dicomImage"
                class="img-fluid"
                    style="width:100%;height: 100%"
                    oncontextmenu="return false"
                    onmousedown="return false">
                </div>

                {{-- <img src="{{url('public/images/1.png')}}" id="dicomImage" class="w-100"> --}}
            </div>

            <div class="col px-5 py-3" id="preview12" onclick="selected_div(this.id)" style="display: none; min-width: 500px;position: relative"></div>
            <div class="col px-5 py-3" id="preview13" onclick="selected_div(this.id)" style="display: none; min-width: 500px;position: relative"></div>
            <div class="col px-5 py-3" id="preview21" onclick="selected_div(this.id)" style="display: none; min-width: 500px;position: relative"></div>
            <div class="col px-5 py-3" id="preview22" onclick="selected_div(this.id)" style="display: none; min-width: 500px;position: relative"></div>
            <div class="col px-5 py-3" id="preview23" onclick="selected_div(this.id)" style="display: none; min-width: 500px;position: relative"></div>
            <div class="col px-5 py-3" id="preview31" onclick="selected_div(this.id)" style="display: none; min-width: 500px;position: relative"></div>
            <div class="col px-5 py-3" id="preview32" onclick="selected_div(this.id)" style="display: none; min-width: 500px;position: relative"></div>
            <div class="col px-5 py-3" id="preview33" onclick="selected_div(this.id)" style="display: none; min-width: 500px;position: relative"></div>
        </div>
    </div>

    <input type="hidden" id="selected_div" value="preview11">
</div>

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



{{-- <script src="https://cdn.jsdelivr.net/npm/hammerjs@2.0.8"></script>
<script src="https://cdn.jsdelivr.net/npm/cornerstone-math@0.1.6/dist/cornerstoneMath.js"></script>
<script src="https://cdn.jsdelivr.net/npm/cornerstone-core@2.2.4/dist/cornerstone.js"></script>
<script src="https://cdn.jsdelivr.net/npm/cornerstone-web-image-loader@2.1.0/dist/cornerstoneWebImageLoader.js"></script>
<script src="https://cdn.jsdelivr.net/npm/cornerstone-tools@3.0.0-b.641/dist/cornerstoneTools.js"></script> --}}

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script> --}}

<script src="{{asset('public/js/jquery.min.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

<script src="{{asset('public/js/moment.min.js')}}"></script>

<script>

    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

    const getBase64StringFromDataURL = (dataURL) => dataURL.replace('data:', '').replace(/^.+,/, '');

    _initCornerstoneImageLoader()
    _initCornerstoneWADOImageLoader()
    var element = document.getElementById('dicomImage')

    // Init cornerstone tools
    cornerstoneTools.init();

    cornerstone.enable(element)

    // var url = "{{url("")}}/public/images"
    var url = "http://localhost/endocapture5.0/public/dicom"

    const imageIds = [
        `${url}/key1.png`,
        `${url}/key2.png`,
    ];



    // const stack = {
    //     currentImageIdIndex: 0,
    //     imageIds: imageIds,
    // };

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


    if(img_lg > 0){
        // img_arr[0] = 'wadouri:http://localhost/endocapture5.0/public/images/0002.DCM'
        let src = img_arr[0]

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
            <video class="video" src="${src}" type="video/mp4" width='1200' height='600'  controls></video>
        `)
        $('#preview11').prop('style', 'width: 800px;height: 1000px')
    } else if (pdf_lg > 0){
        let pdf_name = $($('.pdf-list')[0]).val()
        pdf_name = pdf_name.replaceAll(' ', '%20')
        $('#dicomImage').attr("hidden",true);
        $('#preview11').append(`
            <iframe src="http://localhost/test/${pdf_name}" frameborder="0" height="100%" width="100%"></iframe>
        `)
        $('#preview11').prop('style', 'width: 1500px;height: 1000px')
    }
    //

    function pan_image(){
        disableAllTools()
        const PanTool = cornerstoneTools.PanTool;
        cornerstoneTools.addTool(PanTool)
        cornerstoneTools.setToolActive('Pan', { mouseButtonMask: 1 })
    }

    function zoom_image(){
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

        $('#dicomImage').width(500).height(500)
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
        disableAllTools()
        const WwwcTool = cornerstoneTools.WwwcTool;

        cornerstoneTools.addTool(WwwcTool)
        cornerstoneTools.setToolActive('Wwwc', { mouseButtonMask: 1 })
    }

    function invert_color_image(){
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
        cornerstone.reset(element)
        var toolStateManager = cornerstoneTools.globalImageIdSpecificToolStateManager;
        toolStateManager.clear(element);
        cornerstoneTools.external.cornerstone.updateImage(element);
    }

    function scroll_image(params) {
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

    function choose_layout() {
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

    arr_elements = []
    var arr_src = []
    var arr_div = []
    function set_layout(id){
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
            src = `http://localhost/test/${pdf_name}`
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

        let divw = 400
        let divh = $('#preview_div').height() / parseInt(num_x)
        divh = ((num_x == '1') && (num_y == '2' || num_y == '3')) ? $('#preview_div').height() / 2 : $('#preview_div').height() / parseInt(num_x)
        divw = ((num_x == '1') && (num_y == '2' || num_y == '3')) ? ($('#preview_div').width() / parseInt(num_y)) - 20 : divw
        console.log('h', divh);

        arr_index = 0
        arr_elements_index = 0
        for(i=1;i<=parseInt(num_x);i++){
            for(j=1;j<=parseInt(num_y);j++){

                if((num_x > num_y) || ((num_x == 2 || num_x == 3) && num_y == 2)){
                // if(((num_x > num_y) || ((num_x == 2 || num_x == 3) && num_y == 2)) || ((num_x == '1') && (num_y == '2' || num_y == '3'))){
                    $(`#preview${i}${j}`).removeClass('col')
                    $(`#preview${i}${j}`).css('min-width', '')
                    let max_width =($('#preview_div').width() / parseInt(num_y)) - 20
                    $(`#preview${i}${j}`).css('max-width', max_width+'px')
                    divw = max_width
                } else {
                    $(`#preview${i}${j}`).css('max-width', '')
                }

                if(i==1 && j==1){
                    $(`#preview${i}${j}_div`).removeClass('col-12').addClass('col')
                    $(`#preview${i}${j}_div`).width(500).height(500)

                    $(`#preview${i}${j}`).removeClass('col-12').addClass('col')

                    if((num_x == '1') && (num_y == '2' || num_y == '3')){
                    $(`#preview${i}${j}`).removeClass('col')
                    $(`#preview${i}${j}`).css('max-width', `${divw}px`)
                }

                    $(`#preview${i}${j}`).width(divw).height(divh)

                    // $(`#preview${i}${j}`).attr('min-height', `${h}px`)
                    $(`#preview${i}${j}`).find('.video-preview').attr({width: '400px', height: '400px'})

                    $('#dicomImage').find('.cornerstone-canvas')[0].style = `display:${canvas_status};width: ${divw};height:${divh};`
                    $('#dicomImage .cornerstone-canvas').addClass('img-fluid').addClass('m-auto')
                } else {
                    $(`#preview${i}${j}`).width(divw).height(divh)

                    if($(`#preview${i}${j}`).hasClass('col') == false && !((num_x > num_y) || ((num_x == 2 || num_x == 3) && num_y == 2))){
                        $(`#preview${i}${j}`).addClass('col')
                        $(`#preview${i}${j}`).css('min-width', '500px')
                    }
                    //
                    let w = $(`#preview${i}${j}`).width()
                    let h = $(`#preview${i}${j}`).height()
                    $(`#preview${i}${j}`).empty()

                    let ori_src = arr[arr_index]

                    if(arr_elements_index < arr_elements.length){
                        $(`#preview${i}${j}`).addClass('bg-black')
                        arr_elements[arr_elements_index].id = `preview${i}${j}img`

                        $(`#preview${i}${j}`).css('display', 'block', arr_elements_index)
                        $(`#preview${i}${j}`).append(arr_elements[arr_elements_index])

                        if((arr_src[arr_elements_index].includes('.DCM') || arr_src[arr_elements_index].includes('.dcm')) == true && (arr_div[arr_elements_index] != undefined) ){
                            arr_div[arr_elements_index].id = `preview${i}${j}p`
                            $(`#preview${i}${j}`).append(arr_div[arr_elements_index])
                            // get_dicom_data(arr_src[arr_elements_index], `preview${i}${j}`)
                        }

                        arr_elements_index += 1

                        $(`#preview${i}${j}img .cornerstone-canvas`).attr('style' , `display: block;width:${w}px;height:${h}px`)
                        $(`#preview${i}${j}`).find('.cornerstone-canvas')[0].width = w
                        $(`#preview${i}${j}`).find('.cornerstone-canvas')[0].height = h


                    }
                    //

                    if($(`#preview${i}${j}`).children().length == 0){
                        // $(`#preview${i}${j}`).removeClass('col-auto').addClass('col')
                        $(`#preview${i}${j}`).addClass('bg-black')
                        // $(`#preview${i}${j}`).empty()
                        $(`#preview${i}${j}`).css('display', 'block')




                        if(arr_index < arr.length){
                            if(arr[arr_index].includes('.pdf') == true){
                                $(`#preview${i}${j}`).append(`
                                    <iframe class="pdf-file" src="${arr[arr_index]}" frameborder="0" style="width: 100%;height: 100%"></iframe>
                                `)
                            } else if(arr[arr_index].includes('.mp4') == true) {
                                $(`#preview${i}${j}`).append(`
                                    <video class="video-preview" src="${arr[arr_index]}" type="video/mp4" style="width: 100%;height: 100%" controls></video>
                                `)
                            } else if(arr[arr_index].includes('.png') == true || arr[arr_index].includes('.jpg') == true || arr[arr_index].includes('.dcm') == true || arr[arr_index].includes('.DCM') == true) {
                                $(`#preview${i}${j}`).append(`
                                    <div id="preview${i}${j}img" class="image-preview img-fluid" style="width: 100%;height: 100%" oncontextmenu="return false" onmousedown="return false"></div>
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

                                $(`#preview${i}${j}img .cornerstone-canvas`).attr('style' , `display: block;width:${w}px;height:${h}px`)
                                $(`#preview${i}${j}`).find('.cornerstone-canvas')[0].width = w
                                $(`#preview${i}${j}`).find('.cornerstone-canvas')[0].height = h
                            }
                        }
                        arr_index += 1
                    }
                }
                num_arr.splice(num_arr.indexOf(`${i}${j}`), 1)
            }
        }
        let w = num_x == 1 && num_y == 1 ? 1500 : $(`#preview11`).width()
        $('#dicomImage').find('.cornerstone-canvas')[0].width = w
        $('#dicomImage').find('.cornerstone-canvas')[0].height = $(`#preview11`).height()
        // $(`#dicomImage .cornerstone-canvas`).attr('style' , `display: block;width:${w}px;height:${$(`#preview11`).height()}px`)
        console.log(num_arr);

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

        console.log(num_arr, 'fff');

        for(y=0;y<num_arr.length;y++){
            // $(`#preview${num_arr[y]}`).empty()
            $(`#preview${num_arr[y]}`).css('display', 'none')
        }

        $('#layout_chooser').hide()
    }

    // video
    var count_vdo = $(".video").length
    setTimeout(() => {
        if(count_vdo!==0){
        for(i=0;i<count_vdo;i++){
            var video = document.getElementsByClassName('video')[i];
            let src = $($(".video")[i]).attr('src')
            $(".video-list .position-relative").append(`<video src="${src}" class="image-list-img" onclick="selected_left_menu('${src}', 'video')" width="100%"></video><div class='box-number b04'>1</div>`)
        }
    }
    }, 300);

    function call_vdo(src){
        alert(src)
    }

    // dicom
    var count_img = $('.image-list-img').length
    console.log('ggg', count_img);
    for(n=0;n<count_img;n++){
        let img_src = $($('.image-list-img')[n]).attr('src')
        console.log(img_src);
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

    // pdf
    var pdf_length = $('.pdf-list').length
    for(j=0;j<pdf_length;j++){
        let pdf_name = $($('.pdf-list')[j]).val()
        pdf_name = pdf_name.replaceAll(' ', '%20')
        var loadingTask = pdfjsLib.getDocument(`${url}/`+pdf_name);
        $(".pdf-list-canvas .position-relative").append(`<canvas id='canvas_${pdf_name}' class='pdf-canvas image-list-img' onclick="selected_left_menu('${url}/${pdf_name}', 'pdf')"></canvas><div class='box-number b04'>1</div>`)

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

    function get_pdf_name(canvas_id) {
        let pdf_name = (canvas_id.substring(7)).replaceAll('%20', ' ')
        let url = `http://localhost/test/${pdf_name}`
        alert(url)

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

        // alert(url)
        // alert(src)

        let choosen_div = $('#selected_div').val() // default at preview11
        if(choosen_div == 'preview11'){
            $('#dicomImage').attr("hidden",true);
        }

        if(type == 'image'){
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

            // alert(ori_src);
            // alert(src);


            if((src.includes('DCM') || src.includes('dcm')) == true){
                get_dicom_dataset(element, ori_src)
            } else {
                src = src.replace('wadouri:','')
                cornerstone.loadImage(src).then(function(image) {
                    cornerstone.displayImage(element, image);
                });
            }





        } else if(type == 'video'){
            $(`#${choosen_div}`).find('*').not('#dicomImage').not('.cornerstone-canvas').remove();
            $(`#${choosen_div}`).append(`
                <video class="video-preview" src="${src}" type="video/mp4" width='100%' height='100%'  controls></video>
            `)
        } else if(type == 'pdf'){
            $(`#${choosen_div}`).find('*').not('#dicomImage').not('.cornerstone-canvas').remove();
            $(`#${choosen_div}`).append(`
                <iframe class="pdf-file" src="${src}" frameborder="0" height="100%" width="100%"></iframe>
            `)

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

</script>

@endsection
