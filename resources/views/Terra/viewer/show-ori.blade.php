@extends('layouts.layout_empty')


@section('title', 'Endocapture')

@section('style')
<style>
    .nav-pills .nav-link.active, .nav-pills .show>.nav-link{
        background: none !important;
    }
    .left-list{}
    [data-layout-mode=dark]{
        --vz-topbar-user-bg: black;
        --vz-header-bg: black;
    }
    .left-list{
        padding: 15px 0 !important;
        background: #333333;
    }
    .form-control{
        padding: 15px 0 !important;
        background: #222222;
        border: none;
    }
    body{
        background: #222222;
    }

    .layoutChooser {
        border: 1px solid rgba(77,99,110,0.81);
        border-radius: 8px;
        padding: 5px 0;
        position: absolute;
        z-index: 5000;
    }
    .layoutChooser-dropdown-menu {
    /* position: absolute; */
    top: 100%;
    left: 0;
    /* z-index: 1000; */
    /* display: none; */
    float: left;
    /* min-width: 160px;
    padding: 5px 0; */
    margin: 2px 0 0;
    font-size: 14px;
    text-align: left;
    list-style: none;
    background-color: #fff;
    /* -webkit-background-clip: padding-box; */
    background-clip: padding-box;
    /* border: 1px solid #ccc; */
    /* border: 1px solid rgba(0,0,0,0.15); */
    /* border-radius: 4px; */
    /* -webkit-box-shadow: 0 6px 12px rgb(0 0 0 / 18%); */
    box-shadow: 0 6px 12px rgb(0 0 0 / 18%);
}

</style>

@endsection

@section('modal')

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
                <ul class="nav nav-pills custom-hover-nav-tabs">
                    <li class="nav-item" onclick="pan_image()">
                        <a href="#custom-hover-customere" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                            <i class="las la-arrows-alt nav-icon nav-tab-position"></i>
                            <h5 class="nav-titl nav-tab-position m-0">Pan</h5>
                        </a>
                    </li>
                    <li class="nav-item" onclick="zoom_image()">
                        <a href="#custom-hover-description" data-bs-toggle="tab" aria-expanded="true" class="nav-link">
                            <i class="mdi mdi-magnify-plus-outline nav-icon nav-tab-position"></i>
                            <h5 class="nav-titl nav-tab-position m-0">Zoom</h5>
                        </a>
                    </li>
                    <li class="nav-item" onclick="fit_image()">
                        <a href="#custom-hover-reviews" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                            <i class="las la-expand-arrows-alt nav-icon nav-tab-position"></i>
                            <h5 class="nav-titl nav-tab-position m-0">Fit (512x512px)</h5>
                        </a>
                    </li>
                    <li class="nav-item" onclick="invert_color_image()">
                        <a href="#custom-hover-reviews" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                            <i class="ri-star-half-line nav-icon nav-tab-position"></i>
                            <h5 class="nav-titl nav-tab-position m-0">Invert Color</h5>
                        </a>
                    </li>
                    <li class="nav-item" onclick="reset_image()">
                        <a href="#custom-hover-reviews" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                            <i class="las la-undo-alt nav-icon nav-tab-position"></i>
                            <h5 class="nav-titl nav-tab-position m-0">Reset</h5>
                        </a>
                    </li>
                    {{-- <li class="nav-item" onclick="invert_image_vertical()">
                        <a href="#custom-hover-reviews" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                            <i class="las la-grip-lines-vertical nav-icon nav-tab-position"></i>
                            <h5 class="nav-titl nav-tab-position m-0">Flip V</h5>
                        </a>
                    </li>
                    <li class="nav-item" onclick="invert_image_horizontal()">
                        <a href="#custom-hover-reviews" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                            <i class=" las la-grip-lines nav-icon nav-tab-position"></i>
                            <h5 class="nav-titl nav-tab-position m-0">Flip H</h5>
                        </a>
                    </li> --}}
                    <li class="nav-item" onclick="window_level_image()">
                        <a href="#custom-hover-reviews" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                            <i class="las la-adjust nav-icon nav-tab-position"></i>
                            <h5 class="nav-titl nav-tab-position m-0">Levels</h5>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="#custom-hover-reviews" data-bs-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
                            <i class="las la-tools nav-icon nav-tab-position"></i>
                            <h5 class="nav-titl nav-tab-position m-0">Annotati..</h5>
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
                    <li class="nav-item">
                        <a href="#custom-hover-reviews" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                            <i class="las la-video nav-icon nav-tab-position"></i>
                            <h5 class="nav-titl nav-tab-position m-0">Cine</h5>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#custom-hover-reviews" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                            <i class=" las la-file-alt nav-icon nav-tab-position"></i>
                            <h5 class="nav-titl nav-tab-position m-0">Report</h5>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#custom-hover-reviews" data-bs-toggle="tab" aria-expanded="false" class="nav-link" onclick="key_image()">
                            <i class=" las la-paperclip nav-icon nav-tab-position"></i>
                            <h5 class="nav-titl nav-tab-position m-0">Key Image</h5>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#custom-hover-reviews" data-bs-toggle="tab" aria-expanded="false" class="nav-link" onclick="scroll_image()">
                            <i class="mdi mdi-pan-vertical nav-icon nav-tab-position"></i>
                            <h5 class="nav-titl nav-tab-position m-0">Scroll</h5>
                        </a>
                    </li>
                    <li class="nav-item ">
                        <a href="#custom-hover-reviews" data-bs-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
                            <i class="las la-toolbox nav-icon nav-tab-position"></i>
                            <h5 class="nav-titl nav-tab-position m-0">More</h5>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="javascript:;" class="dropdown-item" onclick="rotate_right()">Rotate right</a></li>
                            <li><a href="javascript:;" class="dropdown-item" onclick="get_tools('magnify')">Magnify</a></li>
                            <li><a href="javascript:;" class="dropdown-item" onclick="invert_image_vertical()">Flip vertical</a></li>
                            <li><a href="javascript:;" class="dropdown-item" onclick="invert_image_horizontal()">Flip horizontal</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="#custom-hover-reviews" data-bs-toggle="tab" aria-expanded="false" class="nav-link" onclick="choose_layout()">
                            <i class="las la-border-all nav-icon nav-tab-position"></i>
                            <h5 class="nav-titl nav-tab-position m-0">Layout</h5>
                        </a>
                        <div id="layout_chooser" class="layoutChooser layoutChooser-dropdown-menu" role="menu" style="display: none; min-width: 68px;margin-left:85%; top:90%" onmouseout="clear_color_cell()">
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
                </ul>
            </div>
            <div class="d-flex">
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
        <video class="video" src="{{$video}}" type="video/mp4" controls style="width: 0px;"></video>
    @endforeach
</div>
<div>
    @foreach ($pdfs as $pdf)
        <input type="hidden" class="pdf-list" value="{{$pdf}}">
    @endforeach
</div>

<div class="row m-0 h-100vh pt-6em">
    <div class="col-2 p-0 bg-black">
        <div class="row m-0 file-list">
            <div class="col-12 p-0">
                <select class="form-control text-center" id="choices-multiple-default" data-choices name="choices-multiple-default">
                    <option value="Choice 1" selected>MR</option>
                </select>
            </div>
            <div class="col-12 p-0">
                <select name="" class="form-control text-center"><option value="">Si Polan</option></select>
            </div>
            <div class="col-12 left-list text-center text-white p-0">{{date('d-m-Y H:i:s')}}</div>
            <div class="col-12 left-list text-center text-white p-0">KMEE</div>
            {{-- <div class="menu-list-image col-12 p-4 mt-2 text-center">
                <b class="text-white">COR T2</b>
                <img src="{{url('public/images/1.png')}}" class="w-100">
            </div> --}}
            <div class="menu-list-image col-12 p-4 mt-2 text-center image-list">
                <h4>IMAGE</h4>
                @foreach ($images as $img)
                    <img src="http://localhost/test/{{$img}}" class="w-100 mb-5 image-list-img" onclick="selected_left_menu(this.src, 'image')">
                @endforeach
            </div>
            <div class="menu-list-image col-12 p-4 text-center video-list"><h4>VIDEO</h4></div>
            <div class="menu-list-image col-12 p-4 text-center pdf-list-canvas"><h4>PDF</h4></div>
        </div>
    </div>
    <div class="col pr-0">
        <div class="row m-0 cn" id="preview_div">
            <div class="col-12 p-0 bg-black pt-3 pb-2" id="preview11_div">
                <div class="row m-0" id="preview_row">
                    <div class="col-6 p-0 text-white">2001</div>
                    <div class="col-6 p-0 text-end text-white">{{date('d-m-Y H:i_s')}}</div>
                    <div class="col-6 p-0 text-white">Si Polan</div>
                    <div class="col-6 p-0 text-end text-white">--</div>
                    <div class="col-6 p-0 text-white">0034Y</div>
                    <div class="col-6 p-0 text-end text-white"></div>
                    <div class="col-6 p-0 text-white">M</div>
                    <div class="col-6 p-0 text-end text-white"></div>
                    <div class="col-12 px-5 py-3" id="preview11">
                        <div id="dicomImage"
                            style="width:1000px;height: 800px"
                            oncontextmenu="return false"
                            onmousedown="return false">
                        </div>


                        {{-- <img src="{{url('public/images/1.png')}}" id="dicomImage" class="w-100"> --}}
                    </div>
                    <div class="col-12 text-white text-end">490.63%</div>
                    <div class="col-12 text-white text-end">T: 5.00 mm</div>
                    <div class="col-12 text-white text-end">L: -18.00mm</div>
                    <div class="col-6 p-0 text-white">1 (1/4)</div>
                    <div class="col-6 p-0 text-end text-white">WW: 64 WV: 1080</div>
                </div>
            </div>

            <div class="col-4 px-5 py-3" id="preview12" onclick="selected_div(this.id)"></div>
            <div class="col-4 px-5 py-3" id="preview13" onclick="selected_div(this.id)"></div>
            <div class="col-4 px-5 py-3" id="preview21" onclick="selected_div(this.id)"></div>
            <div class="col-4 px-5 py-3" id="preview22" onclick="selected_div(this.id)"></div>
            <div class="col-4 px-5 py-3" id="preview23" onclick="selected_div(this.id)"></div>
            <div class="col-4 px-5 py-3" id="preview31" onclick="selected_div(this.id)"></div>
            <div class="col-4 px-5 py-3" id="preview32" onclick="selected_div(this.id)"></div>
            <div class="col-4 px-5 py-3" id="preview33" onclick="selected_div(this.id)"></div>

            {{-- <div class="col-4 p-0 bg-black pt-3 pb-2">
                <div class="row m-0">
                    <div id="dicomImage" style="width:480px;height:480px" oncontextmenu="return false" onmousedown="return false"></div>
                </div>
            </div> --}}



            {{-- <div class="col-4 p-0 h-100 bg-black">
                <div class="row m-0">
                    <div class="col-6 p-0 text-white">2001</div>
                    <div class="col-6 p-0 text-end text-white">{{date('d-m-Y H:i_s')}}</div>
                    <div class="col-6 p-0 text-white">Si Polan</div>
                    <div class="col-6 p-0 text-end text-white">--</div>
                    <div class="col-6 p-0 text-white">0034Y</div>
                    <div class="col-6 p-0 text-end text-white"></div>
                    <div class="col-6 p-0 text-white">M</div>
                    <div class="col-6 p-0 text-end text-white"></div>
                    <div class="col-12 px-5 py-3">
                        <img src="{{url('public/images/2.png')}}" class="w-100">
                    </div>
                    <div class="col-12 text-white text-end">490.63%</div>
                    <div class="col-12 text-white text-end">T: 5.00 mm</div>
                    <div class="col-12 text-white text-end">L: -18.00mm</div>
                    <div class="col-6 p-0 text-white">1 (1/4)</div>
                    <div class="col-6 p-0 text-end text-white">WW: 64 WV: 1080</div>
                </div>
            </div> --}}

        </div>
    </div>

    <input type="hidden" id="selected_div" value="preview11">
</div>

@endsection









@section('script')
<script src="https://unpkg.com/hammerjs@2.0.8/hammer.js"></script>
<script src="https://unpkg.com/dicom-parser@1.8.3/dist/dicomParser.min.js"></script>

<script src="https://unpkg.com/cornerstone-core"></script>
<script src="https://unpkg.com/cornerstone-math"></script>
<script src="https://unpkg.com/cornerstone-wado-image-loader"></script>
<script src="https://unpkg.com/cornerstone-web-image-loader@2.1.1/dist/cornerstoneWebImageLoader.js"></script>

<script src="https://unpkg.com/cornerstone-tools@%5E4"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>

<script src="{{asset('public/js/jquery.min.js')}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.16.105/pdf.min.js"></script>


{{-- <script src="{{url("")}}/public/js/moment.min.js"></script> --}}

<script>

    const getBase64StringFromDataURL = (dataURL) => dataURL.replace('data:', '').replace(/^.+,/, '');

    _initCornerstoneImageLoader()
    var element = document.getElementById('dicomImage')

    // Init cornerstone tools
    cornerstoneTools.init();

    cornerstone.enable(element)

    // var url = "{{url("")}}/public/images"
    var url = "http://localhost/endocapture5.0/public/images"

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
        let src = $($(".image-list-img")[k]).attr('src')
        img_arr.push(src)
    }

    if(img_lg > 0){
        const stack = {
            currentImageIdIndex: 0,
            imageIds: img_arr,
        };

        cornerstone.loadImage(img_arr[0]).then(function(image) {
            cornerstoneTools.addStackStateManager(element, ['stack']);
            cornerstoneTools.addToolState(element, 'stack', stack);
            cornerstone.displayImage(element, image);
        });
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
        const ZoomMouseWheelTool = cornerstoneTools.ZoomMouseWheelTool;
        cornerstoneTools.addTool(ZoomMouseWheelTool)
        cornerstoneTools.setToolActive('ZoomMouseWheel', { mouseButtonMask: 1 })
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
        var link = document.createElement('a');
        var canvas = document.getElementsByClassName("cornerstone-canvas")[0]

        let r = (Math.random() + 1).toString(36).substring(7);
        let datetime = moment().format('YYYY-MM-DD HH:mm')

        link.download = `dicom-img_${datetime}.png`;
        link.href = canvas.toDataURL()
        link.click();
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
        'Length', 'Probe', 'RectangleRoi', 'TextMarker', 'StackScrollMouseWheel', 'Magnify', 'Erasor',
        'Bidirectional']

        for(i=0;i<tool_names.length;i++){
            cornerstoneTools[`setToolPassive`](tool_names[i], options);
        }

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

    function set_layout(id){
        console.log(id);
        let num_x = id.substring(4,5)
        let num_y = id.substring(5)

        //
        var img_lg = $('.image-list-img').length
        var vdo_lg = $(".video").length
        var pdf_lg = $('.pdf-list').length
        var arr = []
        for(k=0;k<img_lg;k++){
            let src = $($(".image-list-img")[k]).attr('src')
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
        console.log(arr);


        for(i=1;i<=3;i++){
            for(j=1;j<=3;j++){
                $(`#preview${i}${j}`).css('border-color', 'black')
            }
        }

        //
        console.log(num_x, num_y);
        arr_index = 0
        for(i=1;i<=num_x;i++){
            console.log('gggg');
            for(j=1;j<=num_y;j++){
                console.log(i,j);
                if(i==1 && j==1){
                    // change div width height
                    console.log(i,j);
                    $(`#preview${i}${j}_div`).removeClass('col-12').addClass('col-4')
                    $(`#preview${i}${j}_div`).css('border-color', 'white')
                    $('#dicomImage').width(400).height(400)

                    var canvas = document.getElementsByClassName('cornerstone-canvas')[0];
                    canvas.width = 400;
                    canvas.height = 400;
                } else {
                    $(`#preview${i}${j}`).removeClass('col-12').addClass('col-4')
                    $(`#preview${i}${j}`).empty()
                    $(`#preview${i}${j}`).css('border-color', 'white')
                    if(arr_index <= arr.length){
                        if(src.includes('.pdf') == true){
                            $(`#preview${i}${j}`).append(`
                                <iframe src="${src}" frameborder="0" height="100%" width="100%"></iframe>
                            `)
                        } else {
                            $(`#preview${i}${j}`).append(`
                                <video class="video" src="${src}" type="video/mp4" width='500' height='400'  controls></video>
                            `)
                        }
                    }
                }
                arr_index += 1
            }
        }
    }

    // video
    var count_vdo = $(".video").length
    setTimeout(() => {
        if(count_vdo!==0){
        for(i=0;i<count_vdo;i++){
            var video = document.getElementsByClassName('video')[i];
            let src = $($(".video")[i]).attr('src')
            $(".video-list").append(`<canvas class='canvas mb-5' onclick="selected_left_menu('${src}', 'video')"></canvas>`)
            var canvas = document.getElementsByClassName('canvas')[i];
            canvas.width = 280;
            canvas.height = video.videoHeight;
            canvas.getContext('2d').drawImage(video, 0, 0, video.videoWidth, video.videoHeight);

            // $("#preview_div").append(`
            //     <div class="col-4 p-0 bg-black pt-3 pb-2" style="text-align: center; display: none">
            //         <video class="video" src="${src}" type="video/mp4"  controls></video>
            //     </div>
            // `)
        }
    }
    }, 300);

    function call_vdo(src){
        alert(src)
    }

    // pdf
    var pdf_length = $('.pdf-list').length
    for(j=0;j<pdf_length;j++){
        let pdf_name = $($('.pdf-list')[j]).val()
        pdf_name = pdf_name.replaceAll(' ', '%20')
        console.log('pdf_name', pdf_name);
        var loadingTask = pdfjsLib.getDocument(`http://localhost/test/`+pdf_name);
        $(".pdf-list-canvas").append(`<canvas id='canvas_${pdf_name}' class='pdf-canvas mb-5' onclick="selected_left_menu('http://localhost/test/${pdf_name}', 'pdf')"></canvas>`)

        loadingTask.promise.then(function(pdf) {
            pdf.getPage(1).then(function(page) {
                var scale = 1.5;
                var viewport = page.getViewport({ scale: scale, });
                var outputScale = window.devicePixelRatio || 1;

                var canvas = document.getElementById(`canvas_${pdf_name}`);
                var context = canvas.getContext('2d');

                canvas.width = Math.floor(viewport.width * outputScale);
                canvas.height = Math.floor(viewport.height * outputScale);
                canvas.style.width = "220px";
                canvas.style.height =  "250px";

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

        // $("#preview_div").append(`
        //     <div class="col-4 p-0 bg-black pt-3 pb-2" style="text-align: center;height: 600px;width:600px; display: none">
        //         <iframe src="http://localhost/test/${pdf_name}" frameborder="0" height="100%" width="100%"></iframe>
        //     </div>
        // `)
    }

    function get_pdf_name(canvas_id) {
        let pdf_name = (canvas_id.substring(7)).replaceAll('%20', ' ')
        let url = `http://localhost/test/${pdf_name}`
        alert(url)

    }

    // function to onclick previewdiv
    function selected_div(id) {
        $('#selected_div').val(id)
    }

    // function to onclick left item menu
    function selected_left_menu(src, type) {

        let choosen_div = $('#selected_div').val() // default at preview11
        if(type == 'image'){
            console.log(src);
            $('#dicomImage').attr("hidden",false);
            $(`#${choosen_div}`).find('*').not('#dicomImage').not('.cornerstone-canvas').remove();

            // var element = document.getElementById('dicomImage')
            const stack = {
                currentImageIdIndex: 0,
                imageIds: img_arr,
            };
            cornerstone.loadImage(src).then(function(image) {
                cornerstoneTools.addStackStateManager(element, ['stack']);
                cornerstoneTools.addToolState(element, 'stack', stack);
                cornerstone.displayImage(element, image);
            });

        } else if(type == 'video'){
            $('#dicomImage').attr("hidden",true);
            $(`#${choosen_div}`).find('*').not('#dicomImage').not('.cornerstone-canvas').remove();
            $('#preview11').append(`
                <video class="video" src="${src}" type="video/mp4" width='1200' height='600'  controls></video>
            `)
            $('#preview11').prop('style', 'width: 800px;height: 1000px')
        } else if(type == 'pdf'){
            console.log('pdf', src);
            $('#dicomImage').attr("hidden",true);
            $(`#${choosen_div}`).find('*').not('#dicomImage').not('.cornerstone-canvas').remove();
            $('#preview11').append(`
                <iframe src="${src}" frameborder="0" height="100%" width="100%"></iframe>
            `)
            $('#preview11').prop('style', 'width: 800px;height: 1000px')
        }
    }

    function resize_canvas(obj,w,h){
        var c = obj[0]
        c.width = w;
        c.height = h
    }


</script>

@endsection
