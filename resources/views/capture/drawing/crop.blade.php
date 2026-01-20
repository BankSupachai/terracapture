@extends('layouts.layoutsManagePhoto')
<link href="{{ url('public/cropnew/cropper.css') }}" rel="stylesheet" />

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
            /* width: 100% !important; */
            min-width: 800px !important;
            /* max-width: 1000px !important; */
        }

        .cropper-point{
            height: 15px !important;
            width: 15px !important;
        }

        .cropper-drag-box{

        }

        .cropper-wrap-box{

        }

        .cropper-crop-box{

        }

        .cropper-canvas{
            min-width: 800px !important;
            /* max-width: 1200px !important; */
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
        @$ppic = $_GET['ppic'];
        $photo_id = $_GET['photo_id'];
    @endphp

@include('capture.crop.modal.allphoto_modal')
@include('capture.crop.modal.selectedphoto_modal')
@include('capture.crop.modal.warning_modal')
@include('capture.crop.modal.multi_crop_modal')

<div class="row m-0 p-3 " >
    <div class="bg-sortphoto ">
        <div class="col-12 d-flex justify-content-between p-3">
            <div>
                <span class="text-sort-blue h3">Edit Photo </span>
                <p class="text-sort-blue">choose function in the left site for edit your photo
                </p>
            </div>
            <div>
                <button type="button" class="btn btn-success btn-label waves-effect right w-lg waves-light" id="reset_btn" hidden>
                    <i class="ri-refresh-line label-icon align-middle fs-16 ms-2" ></i> Reset
                </button>
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
                <div class="row p-2" style="border: 1px solid #325684;">
                    <div class="row" style="position: relative;">
                        <div class="col-2"><h5 class="text-sort-blue pt-2">Crop</h5></div>
                        <div class="col-5"></div>
                        <div class="col-5 p-0" class="">
                            <button class="btn btn-primary picrollbacknew w-100" type="button"
                            style="background: transparent; border: 0px;position:absolute; right: 0px"
                            data-photoname="{{@$photoname}}" data-hn="{{@$hn}}" data-photo_id="{{@$photo_id}}" data-case_id="{{@$cid}}"
                            >
                                <i class="ri-refresh-line label-icon align-middle fs-16 text-sort-blue" ></i>
                                <span class="text-sort-blue">Roll Back</span>
                            </button>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-3">
                        <div>
                            <label for="basiInput" class="form-label m-0 mt-2 p-0 text-soft-blue">Width</label>
                            <input type="number" class="form-control crop-tools" id="crop_width" min="0" oninput="validity.valid||(value='');" onchange="change_cropbox_size(this.value, 'width')">
                        </div>
                    </div>
                    <div class="col-lg-6 mb-3">
                        <div>
                            <label for="basiInput" class="form-label m-0 mt-2 p-0 text-soft-blue">Height</label>
                            <input type="number" class="form-control crop-tools" id="crop_height" oninput="validity.valid||(value='');" onchange="change_cropbox_size(this.value, 'height')">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-10">
                            {{-- New ui --}}
                            <div class="row text-sort-blue">
                                <div class="col-12">
                                    <!-- Base Radios -->
                                    <div class="form-check mb-2">
                                        <input class="form-check-input crop-tools" type="radio" name="flexRadioDefault" id="none_sel" checked>
                                        <label class="form-check-label" for="none_sel">
                                            Only this photo
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12" id="allphoto_div">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input crop-tools" type="radio" name="flexRadioDefault" id="allphoto_sel">
                                        <label class="form-check-label" for="allphoto_sel">
                                            All Photo (ขนาดภาพเท่ากัน)
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12" id="selected_div">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input crop-tools" type="radio" name="flexRadioDefault" id="selected_sel">
                                        <label class="form-check-label" for="selected_sel">
                                            Selected Photo
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12" id="multi_crop_div">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input crop-tools" type="radio" name="flexRadioDefault" id="multi_crop_sel">
                                        <label class="form-check-label" for="multi_crop_sel">
                                            Multi-Crop
                                        </label>
                                    </div>
                                </div>
                            </div>


                            {{-- <div class="row text-sort-blue">
                                <div class="col-3">
                                    <!-- Base Radios -->
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="none_sel" checked>
                                        <label class="form-check-label" for="none_sel">
                                              None
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-3" id="allphoto_div">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="allphoto_sel" onclick="open_modal('allphoto')">
                                        <label class="form-check-label" for="allphoto_sel">
                                            All Photo
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-5" id="selected_div">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="selected_sel" onclick="open_modal('selected')">
                                        <label class="form-check-label" for="selected_sel">
                                            Selected Photo
                                        </label>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="row mb-2" id="warning_div" style="display: none">
                                <span class="text-danger">หากทำการหมุนหรือขยายภาพ จะไม่สามารถทำการใช้ Crop All, Selected Photo และ Multi-Crop ได้</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <div class="row p-3" style="border: 1px solid #325684;">
                        <h5 class="text-sort-blue">ROTATE & FLIP</h5>
                        <div class="col-12 mt-3">
                            <div class="row">
                                <div class="col-3">
                                    <button id="rcc_btn" class="btn btn-edit-photo crop-tools">
                                        <i class="ri-anticlockwise-2-fill big-icon"></i>
                                    </button>
                                </div>
                                <div class="col-3">
                                    <button id="rc_btn"  class="btn btn-edit-photo crop-tools">
                                        <i class="ri-clockwise-fill big-icon"></i>
                                    </button>
                                </div>
                                <div class="col-3">
                                    <button type="button" id="flip_horizontal_btn"  class="btn btn-edit-photo crop-tools">
                                        <i class="bx bx-collapse-horizontal big-icon"></i>
                                    </button>
                                </div>
                                <div class="col-3">
                                    <button  id="flip_vertical_btn" class="btn btn-edit-photo crop-tools">
                                        <i class=" bx bx-collapse-vertical big-icon"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-7 h-100 px-4 img-container" id="image_div"   >
                @php
                    $rand = rand(10000, 99999);
                @endphp
                    {{-- <img hidden  src="https://images.unsplash.com/photo-1533167649158-6d508895b680?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1332&q=80" style="width:100%;height:800px; display:block" id="image"  alt="">
                    <input type="hidden" id="img_src" value="https://images.unsplash.com/photo-1533167649158-6d508895b680?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1332&q=80"> --}}

                <img src="{{picurl("$hn/$folderdate/$photoname")}}?{{$rand}}" style="max-width:100%;height:100%; display:block" id="image_dummy"  alt="">
                <img src="{{picurl("$hn/$folderdate/$photoname")}}?{{$rand}}" style="max-width:100%;height:100%; display:none" id="image"  alt="">

                <input type="hidden" id="img_src" value="{{picurl("$hn/$folderdate/$photoname")}}?{{$rand}}">
            </div>
            <div id="crop_div" class="col-7 text-center" style="display:none; padding-start: 20px">

            </div>
        </div>
    </div>
    <div class="row g-3"  id="otherimg" style="visibility: hidden;">
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
    {{-- <div style="width:0.5rem"></div> --}}
@endsection
@section('script')
    <script src="{{ url('public/cropnew/jquery.min.js') }}"></script>
    <script src="{{ url('public/js/html2canvas.min.js') }}"></script>

    <script src="{{ url('public/cropnew/cropper.min.js') }}"></script>
    <script src="{{ url('public/cropnew/bootstrap.bundle.min.js') }}"></script>
    <script>
        var cropper, canvas, cv, cvx, old_canvas;
        var from_x, from_y, to_x, to_y;
        var resize;
        var rotate_btn
        var down                = false
        var is_crop             = false
        var has_input           = false
        var warning_crop        = false
        // var is_flip_vertical    = false
        // var is_flip_horizontal  = false
        var is_filp_rotate      = 0
        var line_width          = $('#width_inp').val()
        var line_color          = $('#color_inp').val()
        var props               = []
        var croppers            = {}
        var canvas_hist         = []
        var line_click          = 0
        var tracked_btn         = ''
        var tracked_cvhist      = 0
        var div_width           = $('#image_div').width()
        var div_height          = $('#image_div').height()
        var selected_text       = ''
        var is_rollback_pending = false
        var rollback_original_src = ''

        var image;
        var image_src;
        var for_selected_num = $('.select-img').length


        var otherimg_lg = $('.otherimg').length
        for (let z = 0; z < otherimg_lg; z++) {
            $($('.otherimg')[z]).height(div_height).width(div_width)

        }

        $('#otherimg').width(div_width).height(div_height)

        // var image = document.querySelector('#image');
        // var image_src = $(image).attr('src')
        // console.log(image_src, );

        // cropper = create_cropper_instance(image)

        // var for_selected_num = $('.select-img').length
        // for (let i = 0; i <= for_selected_num; i++) {
        //     let sel_image   = document.getElementById(`imagesel${i}`)
        //     if(!$(`#imagesel${i}`).hasClass('self-img')){
        //         let cropper = create_cropper_instance(sel_image)
        //         croppers.push(cropper)
        //     }
        // }

        window.addEventListener("resize", fix_cropbox);
        function fix_cropbox() {
            clearTimeout(resize);
            cropper.disable()
            resize = setTimeout(() => {
                cropper.enable()
            }, 100);
        }

        document.addEventListener("DOMContentLoaded", function(){
            loadJS("{{ url('public/cropnew/cropper.min.js') }}", true)
        });

        for (let i = 0; i < $('.crop-tools').length; i++) {
            $($('.crop-tools')[i]).prop('disabled', true)
        }

        const loadImage = src => new Promise((resolve, reject) => {
            const img = new Image();
            img.onload = () => resolve(img);
            img.onerror = reject;
            img.src = src;
        })

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

                image = document.querySelector('#image');
                image_src = $(image).attr('src')

                cropper = create_cropper_instance(image)

                for_selected_num = $('.select-img').length
                for (let i = 0; i <= for_selected_num; i++) {
                    let sel_image   = document.getElementById(`imagesel${i}`)
                    if(!$(`#imagesel${i}`).hasClass('self-img')){
                        let cropper = create_cropper_instance(sel_image)
                        croppers[`imagesel${i}`] = cropper
                    }
                }
            });
            // error event
            scriptEle.addEventListener("error", (ev) => {
                console.log("Error on loading file", ev);
            });
        }

        // rotate & flip
        $('#rc_btn').on('click', function() {
            is_filp_rotate += 1
            change_viewmode('rotate90')
            rotate_btn = 'rc'
            check_crop_status('rc')
            if(warning_crop){
                cropper.rotate(90)
                if(is_filp_rotate == 1){
                    // cropper.zoom(-0.5)
                    let canvasdata = cropper.getCanvasData()
                    canvasdata['top'] = canvasdata['top'] + 30
                    cropper.setCanvasData(canvasdata)
                }
            }
        })

        function change_viewmode(action){

            if(is_filp_rotate == 1){
                cropper.destroy()
                cropper = create_cropper_instance(image, 0, action)
                if(action != ''){
                    setTimeout(() => {

                        if(action.includes('rotate90')){
                            cropper.rotate(90)
                        } else if(action.includes('rotate-90')){
                            cropper.rotate(-90)
                        } else if(action.includes('fliph')){
                            flip_horizontal()
                        } else if(action.includes('flipv')){
                            flip_verticle()
                        }
                    }, 100);
                }
            }
        }

        $('#rcc_btn').on('click', function() {
            is_filp_rotate += 1
            change_viewmode('rotate-90')
            rotate_btn = 'rcc'
            check_crop_status('rcc')
            if(warning_crop){
                cropper.rotate(-90)

            }
        })

        $('#flip_horizontal_btn').on('click', function() {
            is_filp_rotate += 1
            change_viewmode('fliph')
            check_crop_status('rcc')
            flip_horizontal()

        })

        function flip_horizontal() {
            if (cropper.getData().rotate == 90 || cropper.getData().rotate == 270) {
                return cropper.scaleY(-cropper.getData().scaleY)
            }

            cropper.scaleX(-cropper.getData().scaleX)

        }

        $('#flip_vertical_btn').on('click', function() {
            // alert(1);
            is_filp_rotate += 1
            change_viewmode('flipv')
            check_crop_status('rcc')
            flip_verticle()

        })

        function flip_verticle(){
            if (cropper.getData().rotate == 90 || cropper.getData().rotate == 270) {
                return cropper.scaleX(-cropper.getData().scaleX)
            }
            cropper.scaleY(-cropper.getData().scaleY)
        }

        // reset & cancel & confirm
        $('#clear_btn').on('click', function() {
            cropper.clear()
        })

        function check_crop_status(type){
            // console.log(type);


            let is_hide = $('#allphoto_div').css('display')
            // if(!is_allcrop){
            if(is_hide == 'block'){
                warning_crop = true
                $('#allphoto_div').css('display', 'none')
                $('#selected_div').css('display', 'none')
                $('#multi_crop_div').css('display', 'none')
                $('#warning_div').css('display', 'block')
            }
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




        function img_to_base64(){
            let crop_cv     = $('#crop_div').find('canvas').get(0);
            let crop_src    = $(crop_cv).attr('src')
            let canvas      = document.createElement('canvas');
            let ctx         = canvas.getContext('2d');
            canvas.width    = crop_cv.width;
            canvas.height   = crop_cv.height;
            // console.log(crop_cv.width, crop_cv);
            ctx.drawImage(crop_cv, 0, 0);
            // console.log('hist:', canvas.toDataURL('image/png'));
            // return canvas.toDataURL('image/png');
            let quality = 0.5
            return canvas.toDataURL('image/jpeg', quality);
        }

        $('#confirm_btn').on('click', function() {
            if($('#text_canvas').val() != '' && $('#text_canvas').val() != undefined){
                let txtarea = $('#text_canvas').val()
                let lines   = txtarea.split('\n')
                for (let i = 0; i < lines.length; i++) {
                    let y = init_text[1] + (i * line_width)
                    draw_text(lines[i], init_text[0], y)
                }

                canvas_hist.push(img_to_base64())
                tracked_cvhist = canvas_hist.length
                $('#text_canvas').remove()
                has_input = false
                text_click = 0
            }

            // Check which crop option is selected
            if($('#allphoto_sel').is(':checked')) {
                // Open all photo modal
                open_modal('allphoto')
            } else if($('#selected_sel').is(':checked')) {
                // Open selected photo modal
                open_modal('selected')
            } else if($('#multi_crop_sel').is(':checked')) {
                // Open multi-crop modal
                open_modal('multi_crop')
            } else {
                // Only this photo - proceed with warning modal
                $('#warning_btn').click()
            }
        })

        $('#warning_confirm_btn').on('click', function () {
            $(this).attr('disabled', true)
            $('#warning_confirm_sp').css('display', 'block')
            detect_crop_image()
            // Submit form immediately without delay
            $('#crop_form').submit()
        })

        function detect_crop_image(){
            let is_crop = $('#crop_div').css('display')
            if(is_crop == 'none'){
                $('#crop_div').css('display', 'block')
                $('#crop_div').html('')
                $('#crop_div').append(cropper.getCroppedCanvas({minWidth: 500, minHeight: 500,maxWidth: 1000,maxHeight: 600,}))
                $('#image_div').css('display', 'none')
                canvas_hist.push(img_to_base64())
                canvas      = $('canvas').get(0)
                ctx         = canvas.getContext('2d')
                cv          = $('canvas').get(0)
                props['w']  = canvas.width
                props['h']  = canvas.height
            }

            var base64 = cropper.getCroppedCanvas().toDataURL()
            $('#photodata').val(base64)
        }



        $('#reset_btn').on('click', function() {
            canvas_hist = []
            $('#image_div').css('display', 'block')
            $('#crop_div').css('display', 'none')
            $('#clear_btn').click()
            let containerData = cropper.getContainerData();
            cropper.setCropBoxData({height: containerData.height, width: containerData.width})
            rotate_flip_status(false)
            for (let i = 0; i < $('.drawing').length; i++) {
                let is_clicked = $($('.drawing')[i]).hasClass('btn-clicked')
                if(is_clicked){
                    $($('.drawing')[i]).removeClass('btn-clicked').addClass('btn-edit-photo')
                }
            }

        })


        $('#back_btn').on('click', function(e) {
            if(is_rollback_pending) {
                e.preventDefault();

                var cancel_url = $(this).attr('href');

                is_rollback_pending = false;
                rollback_original_src = '';

                window.location.href = cancel_url;
            }
        })

        function change_cropbox_size(value, type){
            let data = cropper.getCropBoxData()
            data[type] = parseInt(value)
            cropper.setCropBoxData(data)
        }

        var first_cb;
        function create_cropper_instance(img, viewmode=1, action=''){
            console.log(img);
            let cropper = new Cropper(img, {
                dragMode: 'move',
                autocrop: false,
                background: true,
                viewMode: viewmode,
                // minContainerHeight: 800,
                minContainerWidth: 800,
                minContainerHeight: div_height,
                // minContainerWidth: div_width,
                zoomable: false,
                movable: false,
                scalable: false,
                restore: false,
                zoomOnTouch: false,
                autoCropArea: 1,
                zoomOnWheel: false,
                ready: function() {
                    var cropper         = this.cropper;
                    var containerData   = cropper.getContainerData();
                    var cropBoxData     = cropper.getCropBoxData();
                    var canvasBoxData   = cropper.getCanvasData();
                    if($(img).attr('id') == 'image'){
                        set_cropbox_data(cropper)
                        img.addEventListener('cropmove', (event) => {
                            set_cropbox_data(cropper)

                            if($(this).attr('id') == 'image'){
                                first_cb = offset_cropbox(cropper.getCropBoxData())
                            }

                            let select_img = $('.select-img')
                            Array.from(select_img).forEach((e, i) => {
                                let this_id = $($(e)[0]).attr('id')
                                croppers[this_id].setCropBoxData(first_cb)
                            })

                        })

                        $('#image_dummy').css('display', 'none')
                        for (let i = 0; i < $('.crop-tools').length; i++) {
                            $($('.crop-tools')[i]).prop('disabled', false)
                        }

                    } else {

                    }

                    cropper.zoom(-0.1);
                    if($(img).attr('id') == 'image'){
                        image.addEventListener('zoom', (event) => {
                            // Zoom in
                            if (event.detail.ratio > event.detail.oldRatio) {
                                // event.preventDefault(); // Prevent zoom in
                                check_crop_status('')
                            } else {
                                check_crop_status('')
                            }
                        });
                    }

                    let dragbox_width = $('.cropper-container').find('.cropper-drag-box').css('width')
                    let dragbox_height = $('.cropper-container').find('.cropper-drag-box').css('height')
                    // cropper.setCropBoxData({height: (containerData.height/2), width: (containerData.width/2)-50, left:(containerData.width/4)})
                    cropper.setCropBoxData({height: dragbox_height, width: dragbox_width, left:(containerData.width)})

                },
            });
            return cropper
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

            rollback_original_src = $("#image").attr("src");
            if(rollback_original_src.indexOf('?') > -1) {
                rollback_original_src = rollback_original_src.split('?')[0];
            }

            is_rollback_pending = true;

            cropper.destroy()
            d = new Date();
            var backup_url = "{{picurl('')}}"+"{{@$hn}}"+"/"+"{{@$folderdate}}"+"/backup/"+"{{@$photoname}}"+"?"+d.getTime();
            $("#image").attr("src", backup_url);
            $("#image_dummy").attr("src", backup_url);
            cropper = create_cropper_instance(image)

            canvas_hist         = []
            tracked_cvhist      = 0
            warning_crop        = false
            down                = false
            is_crop             = false
            has_input           = false
            // is_flip_vertical    = false
            // is_flip_horizontal  = false
            is_filp_rotate      = 0
            line_click          = 0
            tracked_btn         = ''
            // $('#allphoto_sel').prop('disabled', false)
            // $('#selected_sel').prop('disabled', false)
            $('#allphoto_div').css('display', 'block')
            $('#selected_div').css('display', 'block')
            $('#warning_div').css('display', 'none')
            $('#text_canvas').remove()
            rotate_flip_status(false)
            for (let i = 0; i < $('.drawing').length; i++) {
                let is_clicked = $($('.drawing')[i]).hasClass('btn-clicked')
                if(is_clicked){
                    $($('.drawing')[i]).removeClass('btn-clicked').addClass('btn-edit-photo')
                }
            }

        });

        function offset_cropbox(data){
            data['height'] = data['height'] - 10
            data['left'] = data['left']
            data['top'] = data['top'] - 10
            data['width'] = data['width']  - 20
            return data
        }

        function reload_img(){
            cropper.destroy()
            d = new Date();
            $("#image").attr("src", "{{picurl('')}}"+"{{@$hn}}"+"/"+"{{@$folderdate}}"+"/"+"{{@$photoname}}"+"?"+d.getTime());
            cropper = create_cropper_instance(image)
        }

    </script>

    <script>
        // modal
        var base64arr       = []
        var finish_upload   = 0
        var photonames      = []
        var sent_type       = false

        function open_modal(type){
            let id = `#${type}_btn`
            $(id).click()
            $('.modal-dialog').width(div_width)
        }

        function select_div(index, is_self) {
            if(is_self.includes('self')){
                return 0;
            }

            let is_selected = $(`#select_div${index}`).hasClass('selected-div')
            if(!is_selected){
                $(`#select_div${index}`).addClass('selected-div')
            } else {
                $(`#select_div${index}`).removeClass('selected-div')
            }
        }

        function post_data(photoname, base64, index, num){
            var formdata = new FormData()
            formdata.append('event', 'multiple_crop')
            formdata.append('photoname', photoname)
            formdata.append('cid', "{{@$cid}}")
            formdata.append('hn', "{{@$hn}}")
            formdata.append('folderdate', "{{@$folderdate}}")
            formdata.append('imagedata', dataURLtoBlob(base64))

            $.ajax('{{url("api")}}/photo', {
                method: 'POST',
                data: formdata,
                processData: false,
                contentType: false,
            success() {
                finish_upload += 1
                console.log('Upload success', 'crop', finish_upload);
                if(finish_upload == num){
                    location.href = "{{url('procedure')}}/{{@$cid}}"
                    set_after_sent()
                } else {
                    post_data(photonames[finish_upload],base64arr[finish_upload], finish_upload, num)
                }
            },
            error() {
                console.log('Upload error');
                finish_upload += 1
                if(finish_upload == num){
                    location.href = "{{url('procedure')}}/{{@$cid}}"
                    set_after_sent()
                } else {
                    post_data(photonames[finish_upload], base64arr[finish_upload], finish_upload, num)
                }
            },
            });

        }

        $('#confirm_select_btn').on('click', function () {
            console.log('click');
            $('#select_close').css('display', 'none')
            $(this).prop('disabled', true)
            $('#confirm_select_sp').css('display', 'block')
            let select_num = $('.selected-div').not('.self-div').length
            let other_num  = $('.other-img').length
            let select_div = $('.selected-div').length

            let select_num_elem = $('.selected-div').not('.self-div')

            photonames.push("{{@$photoname}}")
            base64arr.push(cropper.getCroppedCanvas().toDataURL())
            if(select_num >= 0){
                // console.log(select_num, other_num, select_div, select_num_elem, croppers);
                Array.from(select_num_elem).forEach((e, i) => {
                    let this_photo = $($(e)[0]).data('photoname')
                    let this_index = $($(e)[0]).data('index')
                    photonames.push(this_photo)
                    base64arr.push(croppers[`imagesel${this_index}`].getCroppedCanvas().toDataURL())
                })

                setTimeout(() => {
                    post_data(photonames[0], base64arr[finish_upload], finish_upload, select_num+1)
                }, 100);
            }

        })

        $('#confirm_all_btn').on('click', function () {
            console.log('lock...');
            sent_type = 'all'
            $('#confirm_all_btn').prop('disabled', true)
            $('#cancel_all_btn').prop('disabled', true)
            $('#confirm_selectall_sp').css('display', 'block')
            setTimeout(() => { change_select_status('add') }, 100);
            setTimeout(() => { $('#confirm_select_btn').click() }, 1000);
        })

        function set_after_sent(){
            $('#select_close').click()
            $('#all_close').click()
            $('#multi_crop_close').click()
            reload_img()
            base64arr = []
            photonames = []
            sent_type = false
            change_select_status('remove')
            $('#confirm_select_btn').attr('disabled', false)
            $('#confirm_all_btn').attr('disabled', false)
            $('#confirm_multi_crop_btn').attr('disabled', false)
        }

        function change_select_status(type) {
            let other_num = $('.other-img').length
            for (let i = 0; i < other_num; i++) {
                if(!$($('.other-img')[i]).hasClass('selected-div')){
                   if(type == 'remove'){
                        $($('.other-img')[i]).removeClass('selected-div')
                   } else {
                        $($('.other-img')[i]).addClass('selected-div')
                   }
                }
            }
        }

        function dataURLtoBlob(dataurl) {
            console.log(dataurl);
            var arr     = dataurl.split(','), mime = arr[0].match(/:(.*?);/)[1],
                bstr    = atob(arr[1]), n = bstr.length, u8arr = new Uint8Array(n);
            while(n--){
                u8arr[n] = bstr.charCodeAt(n);
            }
            return new Blob([u8arr], {type:mime});
        }

        // Multi-crop functionality
        var multiCropCroppers = {};
        var multiCropPhotos = [];

        function initializeMultiCropModal() {
            console.log('Initializing multi-crop modal');
            const container = $('#multi_crop_container');
            container.empty();

            // Disable sync button initially
            $('#sync_crop_size_btn').prop('disabled', true);

            // Reset sync movement state - default to enabled
            window.syncCropMovement = true;

            // Get all photos including the current one
            multiCropPhotos = [];
            multiCropPhotos.push({
                photoname: "{{@$photoname}}",
                src: "{{picurl('')}}/{{@$hn}}/{{@$folderdate}}/{{@$photoname}}",
                index: 'current'
            });

            // Add other photos
            @foreach (isset($allphoto)?$allphoto:[] as $index=>$photo)
                @if($photo != $photoname)
                    multiCropPhotos.push({
                        photoname: "{{$photo}}",
                        src: "{{picurl('')}}/{{@$hn}}/{{@$folderdate}}/backup/{{$photo}}",
                        index: {{$index}}
                    });
                @endif
            @endforeach

            // Create photo containers - 2 photos per row
            for (let i = 0; i < multiCropPhotos.length; i += 2) {
                const row = $('<div class="row mb-4"></div>');

                // First photo in row
                const photo1 = multiCropPhotos[i];
                const col1 = $(`
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h6 class="text-sort-blue mb-0">Photo ${i + 1}: ${photo1.photoname}</h6>
                            </div>
                            <div class="card-body p-2">
                                <div class="position-relative" style="max-height: 350px; overflow: hidden;">
                                    <img src="${photo1.src}"
                                         id="multi_crop_img_${i}"
                                         style="max-width: 100%; max-height: 350px; display: block;"
                                         data-photoname="${photo1.photoname}"
                                         data-index="${photo1.index}">
                                </div>
                            </div>
                        </div>
                    </div>
                `);
                row.append(col1);

                // Second photo in row (if exists)
                if (i + 1 < multiCropPhotos.length) {
                    const photo2 = multiCropPhotos[i + 1];
                    const col2 = $(`
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="text-sort-blue mb-0">Photo ${i + 2}: ${photo2.photoname}</h6>
                                </div>
                                <div class="card-body p-2">
                                    <div class="position-relative" style="max-height: 350px; overflow: hidden;">
                                        <img src="${photo2.src}"
                                             id="multi_crop_img_${i + 1}"
                                             style="max-width: 100%; max-height: 350px; display: block;"
                                             data-photoname="${photo2.photoname}"
                                             data-index="${photo2.index}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    `);
                    row.append(col2);
                }

                container.append(row);
            }

            // Initialize croppers after images are loaded
            setTimeout(() => {
                let croppersReady = 0;
                multiCropPhotos.forEach((photo, index) => {
                    const imgElement = document.getElementById(`multi_crop_img_${index}`);
                    if (imgElement) {
                        try {
                            const cropper = new Cropper(imgElement, {
                                dragMode: 'move',
                                autocrop: false,
                                background: true,
                                viewMode: 1,
                                minContainerWidth: 400,
                                minContainerHeight: 250,
                                zoomable: false,
                                movable: false,
                                scalable: false,
                                restore: false,
                                zoomOnTouch: false,
                                autoCropArea: 1,
                                zoomOnWheel: false,
                                                                ready: function() {
                                    console.log(`Multi-crop cropper ${index} ready`);
                                    croppersReady++;

                                    // Enable sync button when all croppers are ready
                                    if (croppersReady === multiCropPhotos.length) {
                                        $('#sync_crop_size_btn').prop('disabled', false);
                                        console.log('All multi-crop croppers are ready');
                                    }
                                },
                                                                cropmove: function(event) {
                                    // Sync movement and resize across all croppers
                                    if (window.syncCropMovement) {
                                        const currentCropData = this.cropper.getCropBoxData();
                                        const currentIndex = parseInt(this.cropper.element.id.replace('multi_crop_img_', ''));

                                        // Calculate changes in position and size
                                        const deltaLeft = currentCropData.left - window.lastCropData[currentIndex].left;
                                        const deltaTop = currentCropData.top - window.lastCropData[currentIndex].top;
                                        const deltaWidth = currentCropData.width - window.lastCropData[currentIndex].width;
                                        const deltaHeight = currentCropData.height - window.lastCropData[currentIndex].height;

                                        // Apply the same changes to all other croppers
                                        multiCropPhotos.forEach((photo, index) => {
                                            if (index !== currentIndex) {
                                                const otherCropperId = `multi_crop_img_${index}`;
                                                const otherCropper = multiCropCroppers[otherCropperId];

                                                if (otherCropper) {
                                                    const otherCropData = otherCropper.getCropBoxData();
                                                    const newCropData = {
                                                        left: otherCropData.left + deltaLeft,
                                                        top: otherCropData.top + deltaTop,
                                                        width: otherCropData.width + deltaWidth,
                                                        height: otherCropData.height + deltaHeight
                                                    };
                                                    otherCropper.setCropBoxData(newCropData);
                                                }
                                            }
                                        });

                                        // Update last crop data
                                        window.lastCropData[currentIndex] = currentCropData;
                                    }
                                },
                                cropstart: function(event) {
                                    // Initialize last crop data for movement tracking
                                    if (!window.lastCropData) {
                                        window.lastCropData = {};
                                    }
                                    const currentIndex = parseInt(this.cropper.element.id.replace('multi_crop_img_', ''));
                                    window.lastCropData[currentIndex] = this.cropper.getCropBoxData();
                                }
                            });
                            multiCropCroppers[`multi_crop_img_${index}`] = cropper;
                        } catch (error) {
                            console.error(`Failed to create multi-crop cropper for ${index}:`, error);
                        }
                    }
                });
            }, 500);
        }

        $('#multi_crop_btn').on('click', function() {
            initializeMultiCropModal();
        });

                // Sync crop sizes to first photo
        $('#sync_crop_size_btn').on('click', function() {
            console.log('Syncing crop sizes to first photo');
            $(this).prop('disabled', true);
            $('#sync_crop_sp').css('display', 'inline-block');

            // Get the first photo's crop box data
            const firstCropperId = 'multi_crop_img_0';
            const firstCropper = multiCropCroppers[firstCropperId];

            if (firstCropper) {
                const firstCropData = firstCropper.getCropBoxData();
                console.log('First photo crop data:', firstCropData);

                // Apply the same crop box data to all other photos
                multiCropPhotos.forEach((photo, index) => {
                    if (index > 0) { // Skip the first photo
                        const cropperId = `multi_crop_img_${index}`;
                        const cropper = multiCropCroppers[cropperId];

                        if (cropper) {
                            try {
                                // Get current crop data to preserve position
                                const currentCropData = cropper.getCropBoxData();

                                // Apply first photo's dimensions but keep current position
                                const newCropData = {
                                    left: currentCropData.left,
                                    top: currentCropData.top,
                                    width: firstCropData.width,
                                    height: firstCropData.height
                                };

                                cropper.setCropBoxData(newCropData);
                                console.log(`Applied sync to ${cropperId}:`, newCropData);
                            } catch (error) {
                                console.error(`Failed to sync crop for ${cropperId}:`, error);
                            }
                        }
                    }
                });
            }

            // Re-enable button and hide spinner
            setTimeout(() => {
                $(this).prop('disabled', false);
                $('#sync_crop_sp').css('display', 'none');
            }, 500);
        });

        // Toggle sync movement - default enabled
        $('#sync_movement_btn').on('click', function() {
            if (window.syncCropMovement) {
                // Disable sync movement
                window.syncCropMovement = false;
                $(this).removeClass('btn-success').addClass('btn-info');
                $('#sync_movement_text').text('Enable Sync All');
                console.log('Sync movement disabled');
            } else {
                // Enable sync movement
                window.syncCropMovement = true;
                $(this).removeClass('btn-info').addClass('btn-success');
                $('#sync_movement_text').text('Disable Sync All');
                console.log('Sync movement enabled');
            }
        });

        $('#confirm_multi_crop_btn').on('click', function() {
            console.log('Confirming multi-crop');
            $(this).prop('disabled', true);
            $('#confirm_multi_crop_sp').css('display', 'block');

            // Collect all cropped data
            photonames = [];
            base64arr = [];

            multiCropPhotos.forEach((photo, index) => {
                const cropperId = `multi_crop_img_${index}`;
                const cropper = multiCropCroppers[cropperId];

                if (cropper) {
                    photonames.push(photo.photoname);
                    base64arr.push(cropper.getCroppedCanvas().toDataURL());
                    console.log(`Added ${photo.photoname} to upload queue`);
                }
            });

            // Start upload process
            if (photonames.length > 0) {
                setTimeout(() => {
                    post_data(photonames[0], base64arr[0], 0, photonames.length);
                }, 100);
            }
        });

        // Clean up multi-crop croppers when modal is closed
        $('#multi_crop_close').on('click', function() {
            Object.keys(multiCropCroppers).forEach(cropperId => {
                const cropper = multiCropCroppers[cropperId];
                if (cropper && typeof cropper.destroy === 'function') {
                    cropper.destroy();
                }
            });
            multiCropCroppers = {};
            multiCropPhotos = [];

            // Reset sync button
            $('#sync_crop_size_btn').prop('disabled', true);
            $('#sync_crop_sp').css('display', 'none');

            // Reset sync movement - default to enabled
            window.syncCropMovement = true;
            $('#sync_movement_btn').removeClass('btn-info').addClass('btn-success');
            $('#sync_movement_text').text('Disable Sync All');
        });

    </script>
@endsection
