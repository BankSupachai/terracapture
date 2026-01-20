@extends('layouts.layoutsManagePhoto')
{{-- <link href="{{ url('public/cropnew/cropper.css') }}" rel="stylesheet" /> --}}
{{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/3.6.95/css/materialdesignicons.css" rel="stylesheet"> --}}
{{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> --}}

{{-- <link href="{{ url('public/cropnew/bootstrap.min.css') }}" rel="stylesheet"> --}}
@section('Title')
    Crop Photo
@endsection
@section('style')
    <style>
        .container2 {
            width: 100%;
            /* height: 60%; */
            /* position: relative; */
        }



        html,
        body {
            width: 100%;
            height: 100%;
            overflow: hidden;
            margin: 0;
        }

        .btn-header {
            background-color: #666;
            border-color: #666;
        }
        .text-soft-blue{
            color: #325684bf
        }
        .btn-edit-photo{
            background: #F3F6F9;
            color: #245788;
            border-radius: 4px;
            width: 60px;
            height: 60px;

            box-shadow: 1px 1px 1px 1px #00000040;
        }
        .btn-edit-photo:hover{
            background: #245788;
            color: #F3F6F9;
            border-radius: 4px;
            width: 60px;
            height: 60px;

            box-shadow: 1px 1px 1px 1px #00000040;
        }
        .btn-clicked{
            background: #245788;
            color: #F3F6F9;
        }
        .big-icon {
         font-size: 30px;
        }

        .cropper-container{
            width: 100% !important;

        }

        .cropper-drag-box{

        }

        .cropper-wrap-box{

        }

        .cropper-crop-box{

        }

        .cropper-canvas{

        }

        .selected-div {
            border: 8px solid red;
        }

        image {


        }

        /* #text_canvas::selection{
            background-color: #245788;
        } */
    </style>
@endsection

@section('modal')

@endsection

@section('content')
    @php
        $cid = $_GET['cid'];
        $hn = $_GET['hn'];
        $photoname = $_GET['photoname'];
        $folderdate = $_GET['folderdate'];
        $caseuniq = $_GET['caseuniq'];
        $ppic = $_GET['ppic'];
        $photo_id = $_GET['photo_id'];
        $procedure_pic = isset($_GET['procedure_pic']) ? $_GET['procedure_pic'] : 'false';
    @endphp

@include('endocapture.crop.modal.allphoto_modal')
@include('endocapture.crop.modal.selectedphoto_modal')
@include('endocapture.crop.modal.warning_modal')

<div class="row m-0 p-3 " >
    <div class="bg-sortphoto ">
        <div class="col-12 d-flex justify-content-between p-3">
            <div class="fw-bold">
                <span class="text-sort-blue h3 ">Drawing Photo </span>
                <p class="text-sort-blue">Choose function in the left site for draw your photo
                </p>
            </div>
            <div>
                <button type="button" class="btn btn-success btn-label waves-effect right w-lg waves-light" id="reset_btn" hidden>
                    <i class="ri-refresh-line label-icon align-middle fs-16 ms-2" ></i> Reset
                </button>
                {{-- <a href="{{url('procedure')}}/{{@$cid}}" class="btn btn-danger btn-label waves-effect right w-lg waves-light" id="back_btn">
                    <i class="ri-arrow-go-back-line label-icon align-middle fs-16 ms-2" ></i> Cancel
                </a> --}}
                <a href="{{url('procedure')}}/{{@$cid}}#tablist" class="btn btn-danger btn-label waves-effect right w-lg waves-light" id="back_btn">
                    <i class="ri-arrow-go-back-line label-icon align-middle fs-16 ms-2" ></i> Cancel
                </a>
                <button type="button" class="btn btn-primary btn-label waves-effect right w-lg waves-light" id="confirm_btn">
                    <i class="ri-check-double-line  label-icon align-middle fs-16 ms-2"></i> Confirm
                </button>
            </div>
        </div>
        <div class="row" style="height: 82vh">
            <div class="col-3 px-4 h-100"  >


                <div class="mt-3 " id="edit_area">

                    <div class="row p-3" style="border: 1px solid #325684;" >
                        <div class="row" style="position: relative;">
                            <div class="col-2"><h5 class="text-sort-blue pt-2">DRAWING</h5></div>
                            <div class="col-5"></div>
                            <div class="col-5 p-0" class="">
                                <button class="btn btn-primary picrollbacknew" type="button"
                                style="background: transparent; border: 0px;position:absolute; right: 0px"
                                data-photoname="{{@$photoname}}" data-hn="{{@$hn}}" data-photo_id="{{@$photo_id}}" data-case_id="{{@$cid}}"
                                >
                                    <i class="ri-refresh-line label-icon align-middle fs-16 text-sort-blue" ></i>
                                    <span class="ms-2 text-sort-blue">Roll Back</span>
                                </button>
                            </div>
                        </div>
                        <div class="col-12 mt-3" >
                            <div class="row">
                                <div class="col-3">
                                    <button id="pen_btn" title="Pen" type="button" class="btn btn-edit-photo drawing drawing-tools">
                                        <i class="ri-pencil-fill big-icon"></i>
                                    </button>
                                </div>
                                <div class="col-3">
                                    <button id="arrow_btn" title="Arrow" type="button" class="btn btn-edit-photo drawing drawing-tools" style="" >
                                        <i class="ri-arrow-left-down-fill big-icon"></i>
                                    </button>
                                </div>
                                <div class="col-3">
                                    <button id="circle_btn" title="Circle" type="button" class="btn btn-edit-photo drawing drawing-tools">
                                        <i class="ri-checkbox-blank-circle-line big-icon"></i>
                                    </button>
                                </div>
                                <div class="col-3">
                                    <button id="rect_btn" title="Rectangle" type="button" class="btn btn-edit-photo drawing drawing-tools">
                                        <i class=" ri-checkbox-blank-line big-icon"></i>
                                    </button>
                                </div>
                                <div class="col-3 mt-4">
                                    <button id="text_btn" title="Add Text" type="button" class="btn btn-edit-photo drawing drawing-tools">
                                        <i class=" ri-text big-icon"></i>
                                    </button>
                                </div>
                                <div class="col-3 mt-4">
                                    <button id="undo_btn" title="Undo" type="button" class="btn btn-edit-photo drawing drawing-tools">
                                        <i class="ri-arrow-go-back-line big-icon"></i>
                                    </button>
                                </div>
                                <div class="col-3 mt-4">
                                    <button id="redo_btn" title="Redo" type="button" class="btn btn-edit-photo drawing drawing-tools">
                                        <i class="ri-arrow-go-forward-line big-icon"></i>
                                    </button>
                                </div>
                                <div class="col-3 mt-4">
                                    <button id="drag_btn" title="drag" type="button" class="btn btn-edit-photo drawing drawing-tools">
                                        <i class="ri-drag-move-2-fill big-icon"></i>
                                    </button>
                                </div>
                                <div class="row pt-3" >
                                    <div class="col-6 " >
                                        <div>
                                            {{-- <p>ffffjyjm</p> --}}
                                            <label for="basiInput" class="form-label m-0 mt-2 p-0 text-soft-blue">Width </label>
                                            {{-- <input type="range" class="form-range mt-2 drawing-tools" id="width_inp"   min="5" max="150" value="20" step="5" oninput="change_range(this.value, 'slider1-span')">
                                            <span class="example-val mt-2" id="slider1-span">20</span> --}}
                                            <input type="range" class="form-range mt-2 drawing-tools" id="width_inp"   min="5" max="150" value="30" step="5" oninput="change_range(this.value, 'slider1-span')">
                                            <span class="example-val mt-2" id="slider1-span">30</span>
                                            {{-- <input type="number" class="form-control" id="width_inp" placeholder="กำหนดขนาดของเส้น" value="18" oninput="validity.valid||(value='');"> --}}
                                        </div>
                                    </div>
                                    <div class="col-6 ">
                                        <div>
                                            <label for="basiInput" class="form-label m-0 mt-2 p-0 text-soft-blue drawing-tools">Color</label>
                                            <input type="color" class="form-control form-control-color w-100" id="color_inp" value="#0077E6" placeholder="#0077E6" >
                                        </div>
                                    </div>
                                    <div class="row p-3">
                                        {{-- <div class="col-6  text-end">
                                            <button class="btn btn-danger btn-label waves-effect right waves-light w-lg drawing-tools">Undo <i class="ri-arrow-go-back-line label-icon align-middle fs-16 ms-2"></i></button>
                                        </div> --}}
                                        <div class="col-4"></div>
                                        <div class="col-4 ">
                                            <button class="btn btn-success btn-label waves-effect right waves-light w-lg drawing-tools" id="recanvas_btn">Reset <i  class=" ri-refresh-line label-icon align-middle fs-16 ms-2"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-8 h-100 p-0" id="image_div"  >

                @php
                        $rand = rand(10000, 99999);
                    @endphp
                <img src="{{picurl("$hn/$folderdate/$photoname")}}?{{$rand}}" style="max-width:100%;height:100%; display:block" id="image_dummy"  alt="">
                <img src="{{picurl("$hn/$folderdate/$photoname")}}?{{$rand}}" style="width:100%;height:800px; display:none" id="image"  alt="">
                <input type="hidden" id="img_src" value="{{picurl("$hn/$folderdate/$photoname")}}?{{$rand}}">
                {{-- <img hidden  src="http://localhost/store/@fortest/2021-11-03/429_1_2021_11_03_12_19_0_366.jpg" style="width:100%;height:800px; display:block" id="image"  alt="">
                <input type="hidden" id="img_src" value="http://localhost/store/@fortest/2021-11-03/429_1_2021_11_03_12_19_0_366.jpg"> --}}

                {{-- <img hidden  src="https://images.unsplash.com/photo-1533167649158-6d508895b680?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1332&q=80" style="width:100%;height:800px; display:block" id="image"  alt="">
                <input type="hidden" id="img_src" value="https://images.unsplash.com/photo-1533167649158-6d508895b680?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1332&q=80">
                <canvas id="canvas_area" style="width:100%;height:800px; display:none"></canvas> --}}

            </div>
            <div id="crop_div" class="col-8 text-center h-100" style="display:none; padding-start: 20px">

            </div>
            <div id="text_cal" style="display: block; user-select: none" >

            </div>
            {{-- <p>
                Mouse pos: <b><span id="mouse-pos"></span></b>
              </p> --}}
        </div>
    </div>
    <div class="row g-3"  id="otherimg" hidden>
        @foreach (isset($allphoto)?$allphoto:[] as $index=>$photo)
            @php
                $rand = rand(10000, 99999);
            @endphp
            <img class="otherimg p-0 m-0 @if($photo == $photoname) self-img @else select-img  @endif" src="{{picurl("$hn/$folderdate/backup/$photo")}}?{{$rand}}" style="display:block" id="imagesel{{$index}}"  alt="" style="width:100%">
        @endforeach
    </div>
    {{-- <textarea name="" id="testarea" cols="30" rows="10"></textarea> --}}
    {{-- <p id="text_canvas" class="form-control" style="position: fixed; width: 450px; height: 250px; font-size: 18px; line-height: 1em; overflow: hidden; background: transparent; border: none; outline: none; left: 954px; top: 387px; color: rgb(255, 0, 0);" contenteditable="true">dddd</p> --}}
</div>
</div>
<div class="col-12 text-center" style="position: absolute; color: #ffffff80;">
    © 2023 EndoINDEX 6.0 by Medica Healthcare Co.,Ltd.
</div>
<form id="crop_form" action="{{url('crop')}}" method="post" hidden>
    @csrf
    <input type="text" name="event" value="crop_single">
    <input type="text" name="cid" value="{{@$cid}}">
    <input type="text" name="hn" value="{{@$hn}}">
    <input type="text" name="folderdate" value="{{@$folderdate}}">
    <input type="text" name="photoname" value="{{@$photoname}}">
    <input type="text" name="photodata" id="photodata">
</form>

<script src="{{ url('public/cropnew/jquery.min.js') }}"></script>
<script src="{{ url('public/js/html2canvas.min.js') }}"></script>

{{-- <script src="{{ url('public/cropnew/cropper.min.js') }}"></script> --}}
<script src="{{ url('public/cropnew/bootstrap.bundle.min.js') }}"></script>
<script>
    var cropper, canvas, cv, ctx, old_canvas;
    var from_x, from_y, to_x, to_y;
    var rotate_btn
    var down                = false
    var is_crop             = false
    var has_input           = false
    var warning_crop        = false
    var line_width          = $('#width_inp').val()
    var line_color          = $('#color_inp').val()
    var props               = []
    var croppers            = {}
    var div_width           = $('#image_div').width()
    var div_height          = $('#image_div').height()
    var selected_text       = ''

    // variable ที่เกี่ยวข้องกับ undo / redo button
    var canvas_hist         = []
    var tracked_textarr     = {}
    var tracked_btn         = ''
    var tracked_cvhist      = 0 // all drawing
    var tracked_elem        = 0
    var is_undo             = false
    var is_redo             = false
    var is_reset            = false // เพิ่มตัวแปรติดตามสถานะ reset

    var image;
    var image_src;

    localStorage.setItem("photo_id", "{{@$photo_id}}");
    localStorage.setItem("photoname", "{{@$photoname}}");

    document.addEventListener("DOMContentLoaded", function(){
        loadJS("{{ url('public/cropnew/cropper.min.js') }}", true)
    });

    for (let i = 0; i < $('.drawing-tools').length; i++) {
        $($('.drawing-tools')[i]).prop('disabled', true)
    }

    // load js filr via javascript
    function loadJS(FILE_URL, async = true) {
        let scriptEle = document.createElement("script");

        scriptEle.setAttribute("src", FILE_URL);
        scriptEle.setAttribute("type", "text/javascript");
        scriptEle.setAttribute("async", async);

        document.body.appendChild(scriptEle);

        // success event
        scriptEle.addEventListener("load", () => {
            console.log("File loaded")
            $('#image_div').css('display', 'none')
            image = document.querySelector('#image');
            image_src = $(image).attr('src')
            cropper = create_cropper_instance(image)
        });
        // error event
        scriptEle.addEventListener("error", (ev) => {
            console.log("Error on loading file", ev);
        });
    }

    function check_crop_status(type){
        // let is_allcrop = $('#allphoto_sel').prop('disabled')
        let is_hide = $('#allphoto_div').css('display')
        // if(!is_allcrop){
        if(is_hide == 'block'){
            warning_crop = true
            $('#allphoto_div').css('display', 'none')
            $('#selected_div').css('display', 'none')
            $('#warning_div').css('display', 'block')

            // $('#warning_btn').click()
        }
    }

    function img_to_base64(){
        let crop_cv     = $('#crop_div').find('canvas').get(0);
        let crop_src    = $(crop_cv).attr('src')
        let canvas      = document.createElement('canvas');
        let ctx         = canvas.getContext('2d');
        canvas.width    = crop_cv.width;
        canvas.height   = crop_cv.height;
        ctx.drawImage(crop_cv, 0, 0);
        // return canvas.toDataURL('image/png');
        let quality = 0.5
        return canvas.toDataURL('image/jpeg', quality);
    }

    function get_clean_base64(){
        // สร้าง canvas ใหม่ที่สะอาดจากรูปภาพต้นฉบับ
        let canvas      = document.createElement('canvas');
        let ctx         = canvas.getContext('2d');
        canvas.width    = div_width;
        canvas.height   = div_height;

        // วาดรูปภาพต้นฉบับ
        if (baseImageLoaded) {
            ctx.drawImage(baseImage, 0, 0, canvas.width, canvas.height);
        }

        let quality = 0.5
        return canvas.toDataURL('image/jpeg', quality);
    }

    function change_range(val, span_id){
        $(`#${span_id}`).text(val)
    }

    $('#warning_confirm_btn').on('click', function () {
        $(this).attr('disabled', true)
        // $('#warning_confirm_sp').css('display', 'block')
        // draw_alltext()
        // detect_crop_image()
        // var canvas      = $('#crop_div').find('canvas')
        // var this_canvas = $(canvas)
        // var base64      = this_canvas[0].toDataURL()
        // $('#photodata').val(base64)
        // setTimeout(() => {
        //     $('#crop_form').submit()
        // }, 1 * 500);
    })

    function draw_alltext() {
    if (Object.keys(init_text).length > 0) {
        for (const [key, value] of Object.entries(init_text)) {
            processTextEntry(key, value);
        }
    }
}

function processTextEntry(key, value) {
    let index = getTextAreaIndex(key);
    if (!index) return;

    let txtarea   = $(`#text_canvas${index}`).val();
    let this_color = $(`#text_canvas${index}`).css('color');
    let this_size  = $(`#text_canvas${index}`).css('font-size');
    let is_show    = $(`#text_canvas${index}`).css('display');

    if (shouldDraw(txtarea, is_show)) {
        drawEachLine(txtarea, value, this_color, this_size);
    }
}

function getTextAreaIndex(key) {
    let index = key.split('textarea')[1];
    return (index !== undefined && index !== '') ? index : null;
}

function shouldDraw(txtarea, is_show) {
    return txtarea !== '' && txtarea !== undefined && is_show !== 'none';
}

function drawEachLine(txtarea, value, color, size) {
    let lines = txtarea.split('\n');
    for (let i = 0; i < lines.length; i++) {
        let y = parseInt(value['top']) + (i * line_width);
        draw_text(lines[i], parseInt(value['left']), y, color, size);
    }
}


    // reset & cancel & confirm
    $('#clear_btn').on('click', function() {
        cropper.clear()
    })

    $('#reset_btn').on('click', function() {
        // ล้างข้อมูลการวาดทั้งหมด
        canvas_hist = []
        tracked_textarr = {}
        init_text = {}
        text_click = 0
        tracked_text = 0
        x_edit = 0
        y_edit = 0
        tracked_elem = 0
        tracked_cvhist = 0
        is_undo = false
        is_redo = false

        // ล้าง arrays ที่เก็บข้อมูลการวาด
        circles = []
        rects = []
        arrows = []
        pens = []
        circles_hist = []
        rects_hist = []
        arrows_hist = []
        pens_hist = []

        // ล้าง textarea และ tools
        $('.drawing-textarea').remove()
        $('.textarea-tools').remove()

        // รีเซ็ต UI
        $('#image_div').css('display', 'block')
        $('#crop_div').css('display', 'none')
        $('#clear_btn').click()
        let containerData = cropper.getContainerData();
        cropper.setCropBoxData({height: containerData.height, width: containerData.width})
        rotate_flip_status(false)

        // รีเซ็ตปุ่ม drawing tools
        for (let i = 0; i < $('.drawing').length; i++) {
            let is_clicked = $($('.drawing')[i]).hasClass('btn-clicked')
            if(is_clicked){
                $($('.drawing')[i]).removeClass('btn-clicked').addClass('btn-edit-photo')
            }
        }

                // รีเซ็ต tracked_btn
        tracked_btn = ''

        // ตั้งค่าสถานะ reset
        is_reset = true

        // สร้าง canvas ใหม่ที่สะอาด
        if (canvas && ctx) {
            // ล้าง canvas และวาดรูปภาพต้นฉบับใหม่
            ctx.clearRect(0, 0, canvas.width, canvas.height);
            if (baseImageLoaded) {
                ctx.drawImage(baseImage, 0, 0, canvas.width, canvas.height);
            }

            // อัปเดต canvas_hist ด้วย canvas ที่สะอาด
            canvas_hist = [canvas.toDataURL('image/jpeg', 0.5)]
            init_image = canvas.toDataURL('image/jpeg', 0.5)
        }

        // รีเซ็ตสถานะ reset หลังจากเสร็จสิ้น
        setTimeout(() => {
            is_reset = false;
        }, 100);
    })

    $('#recanvas_btn').on('click', function () {
        // ล้างข้อมูลการวาดทั้งหมด
        $('.drawing-textarea').remove()
        $('.textarea-tools').remove()
        canvas_hist = []
        tracked_textarr = {}
        init_text = {};
        text_click = 0
        tracked_text = 0
        x_edit = 0
        y_edit = 0
        tracked_elem = 0
        tracked_cvhist = 0
        is_undo = false
        is_redo = false

        // ล้าง arrays ที่เก็บข้อมูลการวาด
        circles = []
        rects = []
        arrows = []
        pens = []
        circles_hist = []
        rects_hist = []
        arrows_hist = []
        pens_hist = []

        $('#crop_div').html('')
        $('#crop_div').append(cropper.getCroppedCanvas({minWidth: div_width, minHeight: div_height,maxWidth: div_width,maxHeight: div_height,}))
        $('#image_div').css('display', 'none')

        // ใช้ canvas ที่สะอาด
        canvas_hist.push(get_clean_base64())
        init_image = get_clean_base64()

        let cv_index =  $('canvas').length == 1 ? 0 : 1
        canvas      = $('canvas').get(cv_index)
        ctx         = canvas.getContext('2d')
        cv          = $('canvas').get(cv_index)
        props['w']  = canvas.width
        props['h']  = canvas.height

        // ล้าง canvas และวาดรูปภาพต้นฉบับใหม่
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        if (baseImageLoaded) {
            ctx.drawImage(baseImage, 0, 0, canvas.width, canvas.height);
        }

        // console.log(tracked_btn, $(`#${tracked_btn}`));

        $(`#${tracked_btn}`).trigger('click').trigger('click')

    })

    $('.drawing').on('click', function () {
        let text_lg = $('.drawing-textarea').length
        let checked = Object.values(tracked_textarr)
        for (let j = 0; j < text_lg; j++) {
            let id = $($('.drawing-textarea')[j]).attr('id')
            if($(`#${id}`).val() == '' || $(`#${id}`).val == undefined){
                $(`#${id}`).remove()
                continue
            }
            let is_show = $($('.textarea-tools')[j]).css('display')
            if(is_show == 'block'){
                if(checked.indexOf(id) < 0) {
                    tracked_elem += 1
                    canvas_hist.push(img_to_base64())
                    tracked_textarr[tracked_elem] = `#${id}`
                }
            }
        }

        $(canvas).on('touchmove touchend', null)
        $(canvas).on('mousemove mouseup', null)

        $('.drawing-textarea').css('border', 'transparent')
        $('.textarea-tools').css('display', 'none')

        drawover_textarea()
    })

    function drawover_textarea() {
        for (let k = 0; k < $('.drawing-textarea').length; k++) {
            $($('.drawing-textarea')[k]).on('mousemove touchmove', function (e){
                get_elempos_in_canvas(e)
                if(tracked_btn != 'text_btn'){
                    $($('.drawing-textarea')[k]).css('cursor', 'default')
                } else {
                    $($('.drawing-textarea')[k]).css('cursor', 'move')
                }
            })
        }
    }

    $('#confirm_btn').on('click', function() {
        // $('#warning_btn').click()
        $(this).attr('disabled', true)
        draw_alltext()
        detect_crop_image()
        var canvas      = $('#crop_div').find('canvas')
        var this_canvas = $(canvas)
        var base64      = this_canvas[0].toDataURL()
        $('#photodata').val(base64)
        setTimeout(() => {
            $('#crop_form').submit()
            window.location.href = "{{url('procedure')}}/{{@$cid}}#tablist"
        }, 1 * 500);
    })

    // drawing
    let arrows = []
    let rects = []
    let circles = []
    let pens = [] // เพิ่ม array สำหรับเก็บ pen strokes
    let dragging = false
    let dragIndex = null

    // เพิ่มตัวแปรเก็บ history
    let arrows_hist = []
    let rects_hist = []
    let circles_hist = []
    let pens_hist = [] // เพิ่ม history สำหรับ pen

    function redrawAll() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        if (baseImageLoaded) {
            ctx.drawImage(baseImage, 0, 0, canvas.width, canvas.height);
        }
        redraw_circles();
        redraw_rects();
        redraw_arrows();
        redraw_pens();
    }

    function redraw_circles() {
        for (let c of circles) {
            ctx.beginPath();
            ctx.strokeStyle = c.color;
            ctx.lineWidth = c.width;
            ctx.arc(c.x, c.y, c.r, 0, 2 * Math.PI);
            ctx.stroke();
        }
    }

    function redraw_rects() {
        for (let r of rects) {
            ctx.beginPath();
            ctx.strokeStyle = r.color
            ctx.lineWidth = r.lineWidth
            ctx.rect(r.x, r.y, r.width, r.height);
            ctx.stroke();
        }
    }

    function redraw_arrows() {
        for (let a of arrows) {
            draw_arrow(ctx, a.fromx, a.fromy, a.tox, a.toy, a.width, a.color)
        }
    }

    function redraw_pens() {
        for (let p of pens) {
            ctx.beginPath();
            ctx.lineCap = 'round';
            ctx.strokeStyle = p.color;
            ctx.lineWidth = p.width;
            ctx.moveTo(p.fromX, p.fromY);
            ctx.lineTo(p.toX, p.toY);
            ctx.stroke();
        }
    }

    function clear_hist(){
        if(is_undo){
            // Clear all histories beyond current state
            canvas_hist = canvas_hist.slice(0, tracked_elem + 1)
            circles_hist = circles_hist.slice(0, tracked_elem)
            rects_hist = rects_hist.slice(0, tracked_elem)
            arrows_hist = arrows_hist.slice(0, tracked_elem)
            pens_hist = pens_hist.slice(0, tracked_elem)

            // Set current state from history
            if(tracked_elem > 0) {
                circles = circles_hist[tracked_elem - 1] ? [...circles_hist[tracked_elem - 1]] : []
                rects = rects_hist[tracked_elem - 1] ? [...rects_hist[tracked_elem - 1]] : []
                arrows = arrows_hist[tracked_elem - 1] ? [...arrows_hist[tracked_elem - 1]] : []
                pens = pens_hist[tracked_elem - 1] ? [...pens_hist[tracked_elem - 1]] : []
            } else {
                circles = []
                rects = []
                arrows = []
                pens = []
            }

            is_undo = false
            is_redo = false
        }
    }

    function update_history(){
        // Update all histories with current state
        canvas_hist.push(img_to_base64())
        circles_hist.push([...circles.map(circle => ({...circle}))])
        rects_hist.push([...rects.map(rect => ({...rect}))])
        arrows_hist.push([...arrows.map(arrow => ({...arrow}))])
        pens_hist.push([...pens.map(pen => ({...pen}))])
        tracked_cvhist = canvas_hist.length
        tracked_elem += 1
    }

    function draw_circle() {
        let r = Math.abs(to_x - from_x)
        let color = $('#color_inp').val()
        let width = $('#width_inp').val()

        ctx.beginPath();
        ctx.strokeStyle = color
        ctx.lineWidth   = width
        ctx.arc(from_x, from_y, r, 0, 2 * Math.PI);
        ctx.stroke()


        circles.push({
            x: from_x,
            y: from_y,
            r: r,
            color: color,
            width: width
        })
    }

    function get_mouse_pos(e) {
        let rect = cv.getBoundingClientRect()
        let clientX = e.clientX || e.touches?.[0]?.clientX
        let clientY = e.clientY || e.touches?.[0]?.clientY

        return {
            x: clientX - rect.left,
            y: clientY - rect.top
        }
    }

    $('#circle_btn').on('click', function(){
        check_btn_status(this.id)
        unbind_event()

        $(cv).bind('mousedown touchstart', function (e) {
            if(is_undo) {
                clear_hist()
            }
            drawover_textarea()
            down = true
            set_position(e, 'from')
            old_canvas = canvas.toDataURL()
            $(cv).bind('mousemove touchmove', function(e){
                if (!down) return;
                set_position(e, 'to')
                clear_canvas_simple(() => {
                    redrawAll();
                    const r = Math.abs(to_x - from_x)
                    ctx.beginPath()
                    ctx.strokeStyle = line_color
                    ctx.lineWidth = line_width
                    ctx.arc(from_x, from_y, r, 0, 2 * Math.PI)
                    ctx.stroke()
                })
            })
        })

        $(cv).bind('mouseup touchend', function(e) {
            if (!down) return;
            down = false
            set_position(e, 'to')

            const r = Math.abs(to_x - from_x)
            circles.push({
                x: from_x,
                y: from_y,
                r: r,
                color: line_color,
                width: line_width
            })

            clear_canvas_simple(() => {
                redrawAll()
            })

            update_history()
            $(cv).unbind('mousemove touchmove')
            from_x = to_x = from_y = to_y = 0
        })
    })

    function updateCirclePreview() {
        if (down && $('#circle_btn').hasClass('btn-clicked')) {
            clear_canvas_simple(() => {
                redrawAll();
                const r = Math.abs(to_x - from_x)
                ctx.beginPath()
                ctx.strokeStyle = line_color
                ctx.lineWidth = line_width
                ctx.arc(from_x, from_y, r, 0, 2 * Math.PI)
                ctx.stroke()
            })
        }
    }

    $('#rect_btn').on('click', function(){
        check_btn_status(this.id)
        unbind_event()

        $(cv).bind('mousedown touchstart', function (e) {
            if(is_undo) {
                clear_hist()
            }
            drawover_textarea()
            down = true
            set_position(e, 'from')
            old_canvas = canvas.toDataURL()
            $(cv).bind('mousemove touchmove', function(e){
                set_position(e, 'to')
                clear_canvas_simple(() => {
                    redrawAll();
                    let x = from_x > to_x ? to_x : from_x
                    let y = from_y > to_y ? to_y : from_y
                    ctx.beginPath();
                    ctx.strokeStyle = line_color
                    ctx.lineWidth = line_width
                    ctx.rect(x, y, Math.abs(to_x - from_x), Math.abs(to_y - from_y));
                    ctx.stroke();
                })
            })
        })

        $(cv).bind('mouseup touchend', function(e) {
            down = false
            set_position(e, 'to')

            let x = from_x > to_x ? to_x : from_x
            let y = from_y > to_y ? to_y : from_y
            rects.push({
                x: x,
                y: y,
                width: Math.abs(to_x - from_x),
                height: Math.abs(to_y - from_y),
                color: line_color,
                lineWidth: line_width
            })

            clear_canvas_simple(() => {
                redrawAll()
            })

            update_history()
            $(cv).unbind('mousemove touchmove')
            from_x = to_x = from_y = to_y = 0
        })
    })

    var baseImageSrc = $('#img_src').val();

    let baseImage = new Image();
    baseImage.src = $('#img_src').val();
    let baseImageLoaded = false;
    baseImage.onload = function() {
        baseImageLoaded = true;
    }

    function clear_canvas_simple(callback) {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        if (baseImageLoaded) {
            ctx.drawImage(baseImage, 0, 0, canvas.width, canvas.height);
            if (callback) callback();
        } else {
            baseImage.onload = function() {
                baseImageLoaded = true;
                ctx.drawImage(baseImage, 0, 0, canvas.width, canvas.height);
                if (callback) callback();
            }
        }
    }

    $('#drag_btn').on('click', function () {
        check_btn_status(this.id)
        unbind_event()

        let initialCirclePos = null;
        let isDragging = false;

        $(cv).on('mousedown touchstart', function(e) {
            const pos = get_mouse_pos(e)

            // Find the circle that was clicked (starting from the topmost circle)
            for (let i = circles.length - 1; i >= 0; i--) {
                const c = circles[i]
                const dx = pos.x - c.x
                const dy = pos.y - c.y
                const dist = Math.sqrt(dx*dx + dy*dy)

                if (dist <= c.r) {
                    isDragging = true
                    dragIndex = i
                    // Store initial position
                    initialCirclePos = {
                        x: c.x,
                        y: c.y,
                        r: c.r,
                        color: c.color,
                        width: c.width
                    }
                    break
                }
            }
        })

        $(cv).on('mousemove touchmove', function(e) {
            if (!isDragging || dragIndex === null) return
            const pos = get_mouse_pos(e)

            // Update circle position
            circles[dragIndex].x = pos.x
            circles[dragIndex].y = pos.y

            clear_canvas_simple(function() {
                redrawAll();
            });
        })

        $(cv).on('mouseup touchend', function() {
            if (isDragging && dragIndex !== null && initialCirclePos) {
                // Store final state in history after dragging ends
                update_history()
            }
            isDragging = false
            dragIndex = null
            initialCirclePos = null
        })
    })

    var init_text = {};
    var text_click = 0
    var tracked_text = 0
    var x_edit = 0
    var y_edit = 0
    $('#text_btn').on('click', function(){
        // detect_crop_image()
        check_btn_status(this.id)
        unbind_event()

        $(cv).bind('mousedown touchstart', function (e) {
            console.log('type', e.type);
            // if(e.type === 'touchstart'){
            //     let touch = e.touches[0];
            //     e.clientX = touch.clientX;
            //     e.clientY = touch.clientY;
            // }

            if(text_click == 0){
                // init_text = getCursorPosition(canvas, e)
                let rect = canvas.getBoundingClientRect();
                x_edit = e.clientX- 19 -rect.left
                y_edit = e.clientY- 18 - rect.top
            }
            add_input(e, e.clientX-19, e.clientY-18)
            // var rect = canvas.getBoundingClientRect();
            // x_edit = e.clientX- 19 -rect.left
            // y_edit = e.clientY- 18 - rect.top

            text_click += 1

            $(cv).bind('mousemove touchmove', function(e){
                set_position(e, 'to')
            })

        })

        $(cv).bind('mouseup touchend', function(e) {
            $('.drawing-textarea').css('border', 'transparent')
            $('.textarea-tools').css('display', 'none')


            if($(`#text_canvas${tracked_text}`).val() == '' || $(`#text_canvas${tracked_text}`).val() == undefined){
                $(`#text_canvas${tracked_text}`).remove()
                $(`#textarea_tools${tracked_text}`).remove()
            }

            down = false
            clear_hist()
            $(cv).unbind('mousemove touchmove')
            // canvas_hist.push(img_to_base64())

            // tracked_cvhist = canvas_hist.length
            // tracked_elem += 1

            if($('#text_canvas'+tracked_text) != undefined){
                tracked_textarr[tracked_elem] = '#text_canvas'+tracked_text
            }

            has_input = false
            text_click = 0
            new_txtX = ''
            new_txtY = ''
        })
    })

    function getSelText() {
        var txt = '';
        if (window.getSelection){
            txt = window.getSelection();
        }
        else if (document.getSelection){
            txt = document.getSelection();
        } else if (document.selection) {
            txt = document.selection.createRange().text;
        } else return;

        selected_text = txt.toString()

        return txt

        // document.aform.selectedtext.value =  txt;
    }

    $('#width_inp').on('input', function () {
        line_width = $(this).val()
        updateCirclePreview()
    })

    $('#color_inp').on('input', function () {
        line_color = $(this).val()
        updateCirclePreview()
    })

    $('#width_inp').on('click', function () {
        line_width = $(this).val()
    })

    function set_span_transparent(){
        let lg = $('.edit-text').length
        for (let i = 0; i < lg; i++) {
            $($('.edit-text')[i]).css('background-color', 'transparent')
        }
    }


    $('#redo_btn').on('click', function () {
        if(tracked_elem >= canvas_hist.length - 1){
            tracked_elem = canvas_hist.length - 1
            return
        }

        is_redo = true
        is_undo = false
        tracked_elem = tracked_elem + 1

        // Update current state from history
        circles = circles_hist[tracked_elem - 1] ? [...circles_hist[tracked_elem - 1]] : []
        rects = rects_hist[tracked_elem - 1] ? [...rects_hist[tracked_elem - 1]] : []
        arrows = arrows_hist[tracked_elem - 1] ? [...arrows_hist[tracked_elem - 1]] : []
        pens = pens_hist[tracked_elem - 1] ? [...pens_hist[tracked_elem - 1]] : []

        clear_canvas_simple(function() {
            redrawAll();
        });
    })

    $('#undo_btn').on('click', function () {
        if(tracked_elem <= 0){
            tracked_elem = 0
            return
        }

        is_undo = true
        is_redo = false
        tracked_elem = tracked_elem - 1

        // Update current state from history
        if(tracked_elem > 0) {
            circles = circles_hist[tracked_elem - 1] ? [...circles_hist[tracked_elem - 1]] : []
            rects = rects_hist[tracked_elem - 1] ? [...rects_hist[tracked_elem - 1]] : []
            arrows = arrows_hist[tracked_elem - 1] ? [...arrows_hist[tracked_elem - 1]] : []
            pens = pens_hist[tracked_elem - 1] ? [...pens_hist[tracked_elem - 1]] : []
        } else {
            circles = []
            rects = []
            arrows = []
            pens = []
        }

        clear_canvas_simple(function() {
            redrawAll();
        });
    })

    var init_image = ''
    function redrawing(index){
        let canvasdata = canvas_hist[index]
        let newImage = new Image()
        newImage.onload = function () {
            ctx.clearRect(0, 0, canvas.width, canvas.height)
            ctx.drawImage(newImage, 0, 0, props['w'], props['h'])
            redrawAll()
        }
        newImage.src = canvasdata
    }

    function set_cropbox_data(cropper, offset=0){
        let cropboxData = cropper.getCropBoxData()
        $('#crop_width').val(round_decimal(cropboxData.width, 1))
        $('#crop_height').val(round_decimal(cropboxData.height, 1))
    }

    function round_decimal(num, decimal) {
        let rounded = Math.round(num * (decimal * 10)) / (decimal * 10)
        return rounded
    }


    function detect_crop_image(){
        // ถ้าเป็นการ reset ให้ไม่ทำงาน
        if (is_reset) {
            return;
        }

        let is_crop = $('#crop_div').css('display')
        if(is_crop == 'none'){
            $('#crop_div').css('display', 'block')
            $('#crop_div').html('')
            $('#crop_div').append(cropper.getCroppedCanvas({minWidth: div_width, minHeight: div_height,maxWidth: div_width,maxHeight: div_height,}))
            $('#image_div').css('display', 'none')

            // ตรวจสอบว่าเป็นการ reset หรือไม่
            if (canvas_hist.length === 0) {
                // ถ้าเป็นการ reset ให้เริ่มต้นใหม่ด้วย canvas ที่สะอาด
                canvas_hist = [get_clean_base64()]
                init_image = get_clean_base64()
            } else {
                // ถ้าไม่ใช่การ reset ให้ push ข้อมูลใหม่
                canvas_hist.push(img_to_base64())
                init_image = img_to_base64()
            }

            let cv_index =  $('canvas').length == 1 ? 0 : 1
            canvas       = $('canvas').get(cv_index)
            ctx         = canvas.getContext('2d')
            cv          = $('canvas').get(cv_index)
            props['w']  = canvas.width
            props['h']  = canvas.height
        }

        var base64 = cropper.getCroppedCanvas().toDataURL()
        $('#photodata').val(base64)
    }

    function check_btn_status(id){
        let is_clicked = $(`#${id}`).hasClass('btn-edit-photo')
        if(is_clicked){
            $(`#${id}`).removeClass('btn-edit-photo').addClass('btn-clicked')
            rotate_flip_status(true)
        } else {
            $(`#${id}`).removeClass('btn-clicked').addClass('btn-edit-photo')
        }

        if(tracked_btn != id && tracked_btn != ''){
            $(`#${tracked_btn}`).removeClass('btn-clicked').addClass('btn-edit-photo')
        }

        tracked_btn = id
    }

    function rotate_flip_status(status){
        $('#rcc_btn').prop('disabled', status)
        $('#rc_btn').prop('disabled', status)
        $('#flip_vertical_btn').prop('disabled', status)
        $('#flip_horizontal_btn').prop('disabled', status)
    }

    function draw_arrow(ctx, fromx, fromy, tox, toy, arrowWidth, color){
        var minDistance = 1;
        var distance = Math.sqrt((tox - fromx) ** 2 + (toy - fromy) ** 2);

        if (distance < minDistance) {
            return;
        }

        var headlen = 10;
        var angle   = Math.atan2(toy-fromy,tox-fromx);

        ctx.save();
        ctx.strokeStyle = color;
        ctx.beginPath();
        ctx.lineCap = 'butt';
        ctx.moveTo(fromx, fromy);
        ctx.lineTo(tox, toy);
        ctx.lineWidth = arrowWidth;
        ctx.stroke();

        ctx.beginPath();
        ctx.moveTo(tox, toy);
        ctx.lineTo(tox-headlen*Math.cos(angle-Math.PI/7), toy-headlen*Math.sin(angle-Math.PI/7));

        ctx.lineTo(tox-headlen*Math.cos(angle+Math.PI/7), toy-headlen*Math.sin(angle+Math.PI/7));

        ctx.lineTo(tox, toy);
        ctx.lineTo(tox-headlen*Math.cos(angle-Math.PI/7), toy-headlen*Math.sin(angle-Math.PI/7));

        ctx.stroke();
        ctx.restore();
    }

    function draw_pen(e){
        if (!down) return;
        ctx.beginPath();
        ctx.lineCap = 'round';
        // draw_ctx()
        ctx.fillStyle = $('#color_inp').val()
        ctx.lineWidth = $('#width_inp').val()
        ctx.strokeStyle = $('#color_inp').val()
        ctx.moveTo(to_x, to_y);
        set_position(e, 'to')
        ctx.lineTo(to_x, to_y);
        ctx.stroke();

    }

    function draw_rect(){
        let x = from_x > to_x ? to_x : from_x
        let y = from_y > to_y ? to_y : from_y
        ctx.beginPath();
        ctx.strokeStyle = $('#color_inp').val()
        ctx.lineWidth   = $('#width_inp').val()
        ctx.rect(x, y, Math.abs(to_x - from_x), Math.abs(to_y - from_y));
        ctx.stroke();
    }

    function draw_text(text, x, y, color='', size) {
        console.log(text, x, y, color='', size);
        ctx.fillStyle = color=='' ? $('#color_inp').val() : color
        ctx.lineWidth   = size
        ctx.textBaseline    = 'top';
        ctx.textAlign       = 'left';
        ctx.font            =  `${size} Arial`
        ctx.fillText(text, x - 4, y - 4)
    }

    function getCursorPosition(canvas, event) {
        // let rect    = canvas.getBoundingClientRect()
        // let x       = event.clientX - rect.left
        // let y       = event.clientY - rect.top
        let rect    = canvas.getBoundingClientRect()
        let x, y
        if(event.touches){
            let touch = event.touches[0]
            x = touch.clientX - rect.left
            y = touch.clientY - rect.top
        } else {
            x  = event.clientX - rect.left
            y  = event.clientY - rect.top
        }

        return [x, y]
    }

    function set_position(e, type){
        let position = getCursorPosition(canvas, e)
        if(type == 'from'){
            from_x = position[0]
            from_y = position[1]
        } else if(type == 'to'){
            to_x = position[0]
            to_y = position[1]
        }
    }

    function unbind_event(){
        $(cv).unbind('mouseup touchend')
        $(cv).unbind('mousedown touchstart')
        $(cv).unbind('mousemove touchmove')
    }

    function draw_ctx(){
        ctx.fillStyle = line_color != '' && line_width != undefined ? $('#color_inp').val() : '#0077E6'
        ctx.lineWidth = line_width != '' && line_color != undefined ? $('#width_inp').val() : 18
    }


    function check_overcanvas(left, top, index){
        let leftPos  = $("canvas")[0].getBoundingClientRect().left   + $(window)['scrollLeft']();
        let rightPos = $("canvas")[0].getBoundingClientRect().right  + $(window)['scrollLeft']();
        let topPos   = $("canvas")[0].getBoundingClientRect().top    + $(window)['scrollTop']();
        let bottomPos= $("canvas")[0].getBoundingClientRect().bottom + $(window)['scrollTop']();
        // console.log(leftPos, rightPos, topPos, bottomPos);

        let txt_width = parseInt($(`#text_canvas${index}`).css('width'))
        let txt_height = parseInt($(`#text_canvas${index}`).css('height'))

        if(left <  leftPos){
            $(`#text_canvas${index}`).css('left', leftPos + 'px')
            $(`#textarea_tools${index}`).css('left', leftPos + 'px')
        }

        if(left > rightPos - txt_width ){
            $(`#text_canvas${index}`).css('left', rightPos - txt_width + 'px')
            $(`#textarea_tools${index}`).css('left', rightPos - txt_width + 'px')
        }

        if(top >  bottomPos - txt_height){
            $(`#text_canvas${index}`).css('top', bottomPos - txt_height + 'px')
            $(`#textarea_tools${index}`).css('top', bottomPos - txt_height - 50  + 'px')
        }

        if(top < topPos){
            $(`#text_canvas${index}`).css('top', topPos  + 'px')
            $(`#textarea_tools${index}`).css('top', (topPos - 50)  + 'px')
        }

    }


    var new_txtX = ''
    var new_txtY = ''
    function add_input(e, x, y){
        let all_txtarea = $('.drawing-textarea').length
        if(!has_input){
            let position = getCursorPosition(canvas, e)
            var input    = document.createElement('textarea');
            let input_width = 300
            let input_height = 50
            let p_left, p_top;
            // var input    = document.createElement('p');
            let line_width = $('#width_inp').val() != ''  && $('#width_inp').val() != undefined ? $('#width_inp').val() : 18
            let line_color = $('#color_inp').val() != ''  && $('#color_inp').val() != undefined  ? $('#color_inp').val() : '#0077E6'

            input.type              = 'text';
            input.id                = `text_canvas${all_txtarea}`
            input.className         = 'form-control drawing-textarea'
            input.placeholder       = ''
            input.style.position    = 'fixed';
            input.style.width       = input_width + 'px'
            input.style.height      = 'auto' // input_height + 'px'
            input.style.fontSize    = `${line_width}px`
            input.style.lineHeight  = '1.0em'
            input.style.overflow    = 'hidden'
            input.style.background  = 'transparent'
            input.style.backgroundColor = 'transparent'
            input.style.border      = '1px dashed black'
            input.style.outline     = 'none'
            input.style.cols        = 20
            input.style.rows        = 20
            input.style.left        = (x) + 'px';
            input.style.top         = (y) + 'px';
            input.style.color       = line_color
            input.contentEditable   = "true"
            input.style.position    = 'absolute';
            input.style.cursor      = 'move'
            input.style.overflow    = 'hidden'
            input.wrap              = 'off'
            input.style.userSelect  = 'none'

            // input.style.color       = 'transparent'
            // console.log(x,y);
            tracked_text = all_txtarea



            let this_cv = document.querySelector('canvas')
            let cvp = getPosition(this_cv)
            init_text[`textarea${all_txtarea}`] = {
                        'left' : (x - cvp.left) + 19,
                        'top'  : (y - cvp.top) + 19
                    }
                    console.log(init_text);

            let inp_id = `#text_canvas${all_txtarea}`
            document.body.appendChild(input);

            $(inp_id).click()

            let div_left = x // + input_width - 40
            let div_top = y - 40
            let tools = `
                <div id="textarea_tools${all_txtarea}" class="textarea-tools" style="left: ${div_left}px; top: ${div_top}px; position: absolute">
                    <button hidden id="save_btn${all_txtarea}" type="button" class="btn btn-primary waves-effect waves-light btn-txtarea" onclick="draw_textarea('${all_txtarea}')">
                        <i class="ri-check-line"></i>
                    </button>
                    <button id="close_btn${all_txtarea}" type="button" class="btn btn-danger waves-effect waves-light btn-txtarea" onclick="close_text('${all_txtarea}')">
                        <i class="ri-close-line"></i>
                    </button>
                </div>
            `
            $('body').append(tools)

            // for select all text textrea - not stable
            // $(inp_id).bind('input propertychange', function () {
            //     let this_text = this.value
            // })

            let offset = input.offsetHeight - input.clientHeight;

            input.onmousedown = inputDown
            input.onclick     = inputClick
            input.onmousemove = inputMoveOver
            canvas.onmouseup  = inputUp
            input.onmouseup   = inputUp
            input.oninput     = inputResize

            // touchevent
            $(input).on('touchstart', inputDown)
            $(input).on('touchmove', inputMoveOver)
            $(input).on('touchend', inputUp)
            $(input).on('touchend', inputUp)

            function inputDown(e){
                canvas.onmousemove = canvasMove
                input.onmousemove  = inputMove
                // touch event
                $(canvas).on('touchmove', canvasMove)
                $(input).on('touchmove', inputMove)

                // if have empty textarea remove it
                for (let k = 0; k < $('.drawing-textarea').length; k++) {
                    let txt = $($('.drawing-textarea')[k]).val()
                    let index = $($('.drawing-textarea')[k]).attr('id').replace('text_canvas', '')
                    if(index == all_txtarea){
                        continue
                    }

                    if(txt == '' || txt == undefined){
                        $($('.drawing-textarea')[k]).remove()
                        $(`#textarea_tools${index}`).remove()
                    }
                }
            }

            function inputClick(e){
                if(tracked_btn != 'text_btn'){
                    $(cv).trigger('mouseup touchend')
                }
                canvas.onmousemove = null
                input.onmousemove = null
                // touch event
                $(canvas).on('touchmove', null)
                $(input).on('touchmove', null)
                unbind_event_all('drawing-textarea', 'mousemove')
                unbind_event_all('drawing-textarea', 'touchmove')
                $(inp_id).css('border', '1px dashed black')
                $(`#textarea_tools${all_txtarea}`).css('display', 'block')
            }

            function inputUp(e){
                $(input).attr('readonly', false);
                $(input).css('user-select', '');
                $(input).focus()
                if(tracked_btn != 'text_btn'){
                    $(cv).trigger('mouseup touchend')
                }
                canvas.onmousemove = null
                input.onmousemove = null
                // touch event
                $(canvas).on('touchmove', null)
                $(input).on('touchmove', null)
                $('.drawing-textarea').focusout()
                unbind_event_all('drawing-textarea', 'mousemove')
                unbind_event_all('drawing-textarea', 'touchmove')
            }

            function inputMove(e) {
                $(input).attr('readonly', true);
                $(input).css('user-select', 'none');
                $(input).attr('user-unselectable', 'on');
                move_at(e)
            }

            function inputMoveOver(e) {
                drawing_pass(e)
                $('.drawing-textarea').focusout()
            }

            let new_line  = 0
            let max_text = 0
            function inputResize(e) {
                let this_elem = $(`#text_canvas${all_txtarea}`)
                let this_text = this_elem.val()
                let this_size = this_elem.css('font-size')
                let this_width = get_text_width(this_text, this_size)
                let this_new_width = get_text_width(this_text, this_size, true)
                if(this_width > input_width){
                    // let max_width = $(cv).css('width') + $(cv).css('left')
                    let max_width = $(cv).width() - init_text[`textarea${all_txtarea}`]['left']
                    if(this_width >= max_width){
                        this_elem.css('width', `${max_width}px`)
                        if(new_line == 0){
                            let text =  $(`#text_canvas${all_txtarea}`).val()
                            text = text + '\n'
                            $(`#text_canvas${all_txtarea}`).val(text)
                            new_line += 1
                        } else {
                            if(this_new_width >= this_width){
                                let text =  $(`#text_canvas${all_txtarea}`).val()
                                text = text + '\n'
                                $(`#text_canvas${all_txtarea}`).val(text)
                            }
                        }

                    } else {
                        this_elem.css('width', `${this_width}px`)
                        new_line = 0
                    }
                }
                e.target.style.height = e.target.scrollHeight + offset + 'px';
            }

            function canvasMove(e){
                $(input).attr('readonly', true);
                $(input).css('user-select', 'none');
                $(input).attr('user-unselectable', 'on');
                move_at(e)
            }

            function drawing_pass(e){
                get_elempos_in_canvas(e)
            }

            function move_at(e){
                // p_left = e.pageX - canvas.offsetLeft
                // p_top  = e.pageY - canvas.offsetTop
                let p_left, p_top;
                if(e.touches){
                    let touch = e.touches[0]
                    p_left = touch.pageX - canvas.offsetLeft
                    p_top = touch.pageY - canvas.offsetTop
                } else {
                    p_left = e.pageX - canvas.offsetLeft
                    p_top  = e.pageY - canvas.offsetTop
                }

                let sel_cv = document.querySelector('canvas')
                let sel_cvp = getPosition(sel_cv)
                let cv_left = sel_cvp['left']
                let cv_top  = sel_cvp['top']

                let right_inp = p_left + $(input).width() + 25
                let right_cv  = $(cv).offset().left + $(cv).width()
                let left_inp  = $(input).offset().left
                // boundary
                // top
                if(p_top - 25 <= cv_top){
                    p_top = cv_top + 25
                }
                // bottom
                if((p_top ) +  $(input).height() - 25 >= cv_top + $(sel_cv).height()){
                    p_top = Math.abs(cv_top - $(sel_cv).height()) + 35
                }
                // left
                if(p_left - (input_width/2) <= cv_left){
                    p_left = cv_left + (input_width/2)
                }
                // right
                if(right_inp - (input_width/2) + 5  >= right_cv){
                    p_left = left_inp + (input_width/2)
                }

                $(`#text_canvas${all_txtarea}`).css('left', p_left - (input_width/2)    + 'px')
                $(`#text_canvas${all_txtarea}`).css('top', p_top - 25 + 'px')
                $(`#textarea_tools${all_txtarea}`).css('left', p_left - (input_width/2)    + 'px') // p_left + input_width - (input_width/2) - 40
                $(`#textarea_tools${all_txtarea}`).css('top', p_top - 40 - 25 + 'px')

                let this_cv = document.querySelector('canvas')
                let cvp = getPosition(this_cv)
                // init_text[`textarea${all_txtarea}`] = {
                //     'left' : (p_left - cvp.left) + 19,//input.offsetLeft - cvp.left + 19,
                //     'top'  : (p_top - cvp.top) + 19 //input.offsetLeft - cvp.top + 19
                // }
                init_text[`textarea${all_txtarea}`] = {
                    'left' : (left_inp  - cvp.left) + 19,//input.offsetLeft - cvp.left + 19,
                    'top'  : (p_top - cvp.top) - 10//input.offsetLeft - cvp.top + 19
                }
                console.log(p_left - cvp.left, p_top - cvp.top);
                console.log(init_text);

            }

            setTimeout(() => {
                $(inp_id).focus()
            }, 1 * 500);

            has_input = true
        }
    }

    function get_text_width(text, size, new_line=false){
        if(text.indexOf('\n') > 0){
            text_arr = text.split('\n')
            let old_count = 0
            let new_count = 0
            for (let i = 0; i < text_arr.length; i++) {
                let line = text_arr[i]
                let count_char = line.length
                old_count = count_char
                if(old_count > new_count){
                    new_count = old_count
                    text = line
                }

                if(new_line){
                    text = line
                }
            }
        }
        let span = `<span style="font-size: ${size}; color: rgba(0, 0, 0, 0.0)">` + text + '</span>';
        $('#text_cal').html(span);
        var width = $('#text_cal').find('span:first').width() + 40;
        return width;
    };

    function getPosition(element) {
        var clientRect = element.getBoundingClientRect();
        return {left: clientRect.left + document.body.scrollLeft,
                top: clientRect.top + document.body.scrollTop};
    }

    function get_elempos_in_canvas(e){
        let this_cv = document.querySelector('canvas')
        let cvp = getPosition(this_cv)
        to_x = e.pageX - canvas.offsetLeft - cvp.left
        to_y   = e.pageY - canvas.offsetTop - cvp.top
        if(tracked_btn != 'pen_btn'){
            clear_canvas(tracked_btn.replace('_btn', ''))
        } else {
            draw_pen(e)
            set_position(e, 'to')
        }
    }

    function unbind_event_all(classname, event){
        for (let k = 0; k < $(`.${classname}`).length; k++) {
            $($(`.${classname}`)[k]).unbind(event)
        }
    }

    // textarea
    function close_text(txt_index){
        $(`#textarea_tools${txt_index}`).remove()
        $(`#text_canvas${txt_index}`).remove()

        let key = getKeyByValue(tracked_textarr, `#text_canvas${txt_index}`)
        // let new_txtindex = txt_index + 1
        // console.log(tracked_textarr[new_txtindex]);
        if(tracked_textarr[key] != undefined){
            // canvas_hist.splice(key, 1)
            delete tracked_textarr[key]
        }
        // init_text.forEach(a => delete a.textarea)

    }

    function getKeyByValue(object, value) {
        return Object.keys(object).find(key => object[key] === value);
    }

    function draw_textarea(txt_index) {

        // let txtarea = $(`#text_canvas${txt_index}`).val()
        // let position  = init_text[`textarea${txt_index}`]
        // let lines   = txtarea.split('\n')
        // for (let i = 0; i < lines.length; i++) {
        //     let y = parseInt(position['top']) + (i * line_width)
        //     draw_text(lines[i], parseInt(position['left']), y)
        // }

        let txtarea = $(`#text_canvas${txt_index}`).val()
        let this_color = $(`#text_canvas${txt_index}`).css('color')
        let this_size  = $(`#text_canvas${txt_index}`).css('font-size')
        let is_show    = $(`#text_canvas${txt_index}`).css('display')
        console.log(this_color, this_size);
        if(txtarea != '' && is_show != 'none' && txtarea != undefined){
            let lines   = txtarea.split('\n')
            for (let i = 0; i < lines.length; i++) {
                let y = parseInt( value['top']) + (i * line_width)
                draw_text(lines[i], parseInt(value['left']), y, this_color, this_size)
            }
        }
    }

    function change_cropbox_size(value, type){
        let data = cropper.getCropBoxData()
        data[type] = parseInt(value)
        cropper.setCropBoxData(data)
    }

    var first_cb;
    function create_cropper_instance(img, viewmode=1, action=''){
        let cropper = new Cropper(img, {
            dragMode: 'move',
            autocrop: false,
            background: true,
            viewMode: viewmode,
            // minContainerHeight: 800,
            minContainerWidth: 1200,
            minContainerHeight: div_height,
            // minContainerWidth: div_width,
            zoomable: false,
            zoomOnTouch: false,
            movable: false,
            autoCropArea: 1,
            // zoomOnWheel: false,
            ready: function() {
                $('.cropper-crop-box').css('display', 'none')
                detect_crop_image()
                // $('#arrow_btn').trigger('click')
                $('#text_btn').trigger('click')

                $('#image_dummy').css('display', 'none')
                for (let i = 0; i < $('.drawing-tools').length; i++) {
                    $($('.drawing-tools')[i]).prop('disabled', false)
                }
            },
        });
        return cropper
    }

    function reload_img(){
        cropper.destroy()
        d = new Date();
        $("#image").attr("src", "{{picurl('')}}"+"{{@$hn}}"+"/"+"{{@$folderdate}}"+"/"+"{{@$photoname}}"+"?"+d.getTime());
        cropper = create_cropper_instance(image)
    }

    $('.picrollbacknew').click(function(){
            let is_img_display = $('#image_div').css('display')
            if(is_img_display == 'none'){
                $('#image_div').css('display', 'block')
                $('#crop_div').css('display', 'none')
            }

            var folderdate   = '{{@$folderdate}}';
            var photoname    = $(this).data('photoname');
            var hn           = $(this).data('hn');
            var photo_status = $(this).data('status');
            var photo_id     = $(this).data('photo_id');
            var case_id      = $(this).data('case_id');
            var is_ppic      = "{{@$procedure_pic}}"
            var ppic         = "{{@$ppic}}"

            $.post("{{url("api/photomove")}}",{
                event       : 'photorollback',
                folderdate  : '{{@$folderdate}}',
                photo_id    : photo_id,
                hn          : hn,
                caseid      : case_id,
                photoname   : photoname,
                is_ppic     : is_ppic,
                ppic        : ppic
            },function(data,status){
                reload_img()
            });
            location.reload()
        });

    function updateCirclePreview() {
        if (down && $('#circle_btn').hasClass('btn-clicked')) {
            clear_canvas_simple(() => {
                redrawAll();
                const r = Math.abs(to_x - from_x)
                ctx.beginPath()
                ctx.strokeStyle = line_color
                ctx.lineWidth = line_width
                ctx.arc(from_x, from_y, r, 0, 2 * Math.PI)
                ctx.stroke()
            })
        }
    }

    function updateArrowPreview() {
        if (down && $('#arrow_btn').hasClass('btn-clicked')) {
            clear_canvas_simple(() => {
                redrawAll();
                draw_arrow(ctx, from_x, from_y, to_x, to_y, line_width, line_color);
            });
        }
    }

    function updateRectPreview() {
        if (down && $('#rect_btn').hasClass('btn-clicked')) {
            clear_canvas_simple(() => {
                redrawAll();
                let x = from_x > to_x ? to_x : from_x
                let y = from_y > to_y ? to_y : from_y
                ctx.beginPath();
                ctx.strokeStyle = line_color
                ctx.lineWidth = line_width
                ctx.rect(x, y, Math.abs(to_x - from_x), Math.abs(to_y - from_y));
                ctx.stroke();
            })
        }
    }

    $('#pen_btn').on('click', function(){
        check_btn_status(this.id)
        unbind_event()

        $(cv).bind('mousedown touchstart', function (e) {
            if(is_undo) {
                clear_hist()
            }
            drawover_textarea()
            down = true
            set_position(e, 'from')
            old_canvas = canvas.toDataURL()
        })

        $(cv).bind('mousemove touchmove', function(e) {
            if (!down) return;
            set_position(e, 'to')

            // Draw the pen stroke
            ctx.beginPath();
            ctx.lineCap = 'round';
            ctx.strokeStyle = line_color;
            ctx.lineWidth = line_width;
            ctx.moveTo(from_x, from_y);
            ctx.lineTo(to_x, to_y);
            ctx.stroke();

            // Store the pen stroke
            pens.push({
                fromX: from_x,
                fromY: from_y,
                toX: to_x,
                toY: to_y,
                color: line_color,
                width: line_width
            });

            // Update from position for next stroke
            from_x = to_x;
            from_y = to_y;
        })

        $(cv).bind('mouseup touchend', function(e) {
            if (!down) return;
            down = false

            update_history()
            from_x = to_x = from_y = to_y = 0
        })
    })

    $('#arrow_btn').on('click', function(){
        check_btn_status(this.id)
        unbind_event()

        $(cv).bind('mousedown touchstart', function (e) {
            if(is_undo) {
                clear_hist()
            }
            drawover_textarea()
            down = true
            set_position(e, 'from')
            old_canvas = canvas.toDataURL()
        })

        $(cv).bind('mousemove touchmove', function(e) {
            if (!down) return;
            set_position(e, 'to')

            clear_canvas_simple(() => {
                redrawAll();
                draw_arrow(ctx, from_x, from_y, to_x, to_y, line_width, line_color);
            });
        })

        $(cv).bind('mouseup touchend', function(e) {
            if (!down) return;
            down = false
            set_position(e, 'to')

            arrows.push({
                fromx: from_x,
                fromy: from_y,
                tox: to_x,
                toy: to_y,
                width: line_width,
                color: line_color
            })

            clear_canvas_simple(() => {
                redrawAll()
            })

            update_history()
            from_x = to_x = from_y = to_y = 0
        })
    })
</script>

<script>
    setTimeout(() => {
        $('#color_inp').val("#0077E6");
        // $("#text_btn").trigger("click");
        line_color = $('#color_inp').val()
    }, 500);
</script>



@endsection


