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
            min-width: 1200px !important;
            /* max-width: 1200px !important; */

        }

        .cropper-drag-box{

        }

        .cropper-wrap-box{

        }

        .cropper-crop-box{

        }

        .cropper-canvas{
            min-width: 1200px !important;
            /* max-width: 1200px !important; */
        }

        .selected-div {
            border: 8px solid red;
        }

        image {


        }

        /* .inactive-div {
            background-color:white;
            opacity:0.6;
        }

        .active-div {
            background-color: transparent;
        } */

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
    @endphp

@include('endocapture.crop.modal.allphoto_modal')
@include('endocapture.crop.modal.selectedphoto_modal')
@include('endocapture.crop.modal.warning_modal')
@include('capture.crop.modal.multi_crop_modal')

<div class="row m-0 p-3 " >
    <div class="bg-sortphoto " >
        <div class="col-12 d-flex justify-content-between p-3">
            <div>
                <span class="text-sort-blue h3">Edit Photo </span>
                <p class="text-sort-blue">choose function in the left site for edit your photo
                </p>
            </div>
            <div>
                <button type="button" class="btn btn-success btn-label waves-effect right w-lg waves-light" id="reset2_btn">
                    <i class="ri-refresh-line label-icon align-middle fs-16 ms-2" ></i> Reset
                </button>
                <a href="{{url('procedure')}}/{{@$cid}}" class="btn btn-danger btn-label waves-effect right w-lg waves-light" id="back_btn">
                    <i class="ri-arrow-go-back-line label-icon align-middle fs-16 ms-2" ></i> Cancel
                </a>
                <button type="button" class="btn btn-primary btn-label waves-effect right w-lg waves-light" id="confirm_btn">
                    <i class="ri-check-double-line  label-icon align-middle fs-16 ms-2"></i> Confirm
                </button>
            </div>
        </div>
        <div class="row" style="height: 82vh">

            <div class="col-4 px-4 h-100" >
                <div class="row mb-3">
                    <div class="col-4"></div>
                    <div class="col-4">
                        <button type="button" id="show_crop" style="width:100%; " class="btn btn-primary btn-label waves-effect right w-lg waves-light" onclick="change_action_div('crop')">Crop</button>
                    </div>
                    <div class="col-4"></div>
                </div>
                <div class="row p-2 inactive-div crop-div" id="" style="border: 1px solid #325684;display: none">
                    <div class="row" style="position: relative;">
                        <div class="col-1"><h5 class="text-sort-blue pt-2">Crop</h5></div>
                        <div class="col-5">
                            <div class="form-check form-switch form-switch-md form-switch-success pt-1" dir="ltr" hidden>
                                <input type="checkbox" class="form-check-input" id="toggle_crop" value="1" onchange="change_action('crop')" >
                                <label class="form-check-label" for="customSwitchsizemd">Start Crop</label>
                            </div>
                        </div>
                        <div class="col-2"></div>
                        <div class="col-3 p-0" class="">
                            <button class="btn btn-primary picrollbacknew action-crop" type="button"
                            style="background: transparent; border: 0px;position:absolute; right: 0px"
                            data-photoname="{{@$photoname}}" data-hn="{{@$hn}}" data-photo_id="{{@$photo_id}}" data-case_id="{{@$cid}}"
                            >
                                <i class="ri-refresh-line label-icon align-middle fs-16 text-sort-blue" ></i>
                                <span class="ms-2 text-sort-blue">Roll Back</span>
                            </button>
                        </div>
                    </div>
                    <div class="col-lg-6 mb-3">
                        <div>
                            <label for="basiInput" class="form-label m-0 mt-2 p-0 text-soft-blue">Width</label>
                            <input type="number" class="form-control action-crop" id="crop_width" min="0" oninput="validity.valid||(value='');" onchange="change_cropbox_size(this.value, 'width')">
                        </div>
                    </div>
                    <div class="col-lg-6 mb-3">
                        <div>
                            <label for="basiInput" class="form-label m-0 mt-2 p-0 text-soft-blue">Height</label>
                            <input type="number" class="form-control action-crop" id="crop_height" oninput="validity.valid||(value='');" onchange="change_cropbox_size(this.value, 'height')">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-10">
                            {{-- New ui --}}
                            {{-- <div class="row text-sort-blue">
                                <div class="col-12">
                                    <!-- Base Radios -->
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="" checked>
                                        <label class="form-check-label" for="none_sel">
                                            Only this photo
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12" id="allphoto_div">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="" onclick="open_modal('allphoto')">
                                        <label class="form-check-label" for="allphoto_sel">
                                            All Photo
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12" id="selected_div">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input" type="radio" name="flexRadioDefault" id="" onclick="open_modal('selected')">
                                        <label class="form-check-label" for="selected_sel">
                                            Selected Photo
                                        </label>
                                    </div>
                                </div>
                            </div> --}}


                            <div class="row text-sort-blue">
                                <div class="col-3">
                                    <!-- Base Radios -->
                                    <div class="form-check mb-2">
                                        <input class="form-check-input action-crop" type="radio" name="flexRadioDefault" id="none_sel" checked>
                                        <label class="form-check-label" for="none_sel">
                                              None
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-3" id="allphoto_div">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input action-crop" type="radio" name="flexRadioDefault" id="allphoto_sel" onclick="open_modal('allphoto')">
                                        <label class="form-check-label" for="allphoto_sel">
                                            All Photo
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-5" id="selected_div">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input action-crop" type="radio" name="flexRadioDefault" id="selected_sel" onclick="open_modal('selected')">
                                        <label class="form-check-label" for="selected_sel">
                                            Selected Photo
                                        </label>
                                    </div>
                                </div>
                                <div class="col-lg-4" id="multi_crop_div">
                                    <div class="form-check mb-2">
                                        <input class="form-check-input action-crop" type="radio" name="flexRadioDefault" id="multi_crop_sel" onclick="open_modal('multi_crop')">
                                        <label class="form-check-label" for="multi_crop_sel">
                                            Multi-Crop (Individual)
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2" id="warning_div" style="display: none">
                                <span class="text-danger">หากทำการหมุนหรือขยายภาพ จะไม่สามารถทำการใช้ Crop All, Selected Photo และ Multi-Crop ได้</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <div class="row p-3 inactive-div crop-div" style="border: 1px solid #325684; display: none">
                        <h5 class="text-sort-blue">ROTATE & FLIP</h5>
                        <div class="col-12 mt-3">
                            <div class="row">
                                <div class="col-3">
                                    <button id="rcc_btn" class="btn btn-edit-photo action-crop">
                                        <i class="ri-anticlockwise-2-fill big-icon"></i>
                                    </button>
                                </div>
                                <div class="col-3">
                                    <button id="rc_btn"  class="btn btn-edit-photo action-crop">
                                        <i class="ri-clockwise-fill big-icon"></i>
                                    </button>
                                </div>
                                <div class="col-3">
                                    <button type="button" id="flip_horizontal_btn"  class="btn btn-edit-photo action-crop">
                                        <i class="bx bx-collapse-horizontal big-icon"></i>
                                    </button>
                                </div>
                                <div class="col-3">
                                    <button  id="flip_vertical_btn" class="btn btn-edit-photo action-crop">
                                        <i class=" bx bx-collapse-vertical big-icon"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-3 mt-3">
                    <div class="col-4"></div>
                    <div class="col-4">
                        <button type="button" id="drawing_crop" style="width:100%" class="btn btn-primary btn-label waves-effect right w-lg waves-light" onclick="change_action_div('drawing')">Drawing</button>
                    </div>
                    <div class="col-4"></div>
                </div>
                <div class="mt-3 " id="edit_area" >

                    <div class="row p-3 inactive-div drawing-div" style="border: 1px solid #325684; display:none" >
                        <div class="col-2"><h5 class="text-sort-blue">DRAWING</h5></div>
                        <div class="col-5">
                            <div class="form-check form-switch form-switch-md form-switch-success" dir="ltr" hidden>
                                <input type="checkbox" class="form-check-input" id="toggle_drawing" value="1" onchange="change_action('drawing')" >
                                <label class="form-check-label" for="customSwitchsizemd">Start Drawing</label>
                            </div>
                        </div>
                        <div class="col-12 mt-3" >
                            <div class="row">
                                <div class="col-3">
                                    <button id="pen_btn" title="Pen" type="button" class="btn btn-edit-photo drawing action-drawing">
                                        <i class="ri-pencil-fill big-icon"></i>
                                    </button>
                                </div>
                                <div class="col-3">
                                    <button id="arrow_btn" title="Arrow" type="button" class="btn btn-edit-photo drawing action-drawing" style="">
                                        <i class="ri-arrow-left-down-fill big-icon"></i>
                                    </button>
                                </div>
                                <div class="col-3">
                                    <button id="circle_btn" title="Circle" type="button" class="btn btn-edit-photo drawing action-drawing">
                                        <i class="ri-checkbox-blank-circle-line big-icon"></i>
                                    </button>
                                </div>
                                <div class="col-3">
                                    <button id="rect_btn" title="Rectangle" type="button" class="btn btn-edit-photo drawing action-drawing">
                                        <i class=" ri-checkbox-blank-line big-icon"></i>
                                    </button>
                                </div>
                                <div class="col-3 mt-4">
                                    <button id="text_btn" title="Add Text" type="button" class="btn btn-edit-photo drawing action-drawing">
                                        <i class=" ri-text big-icon"></i>
                                    </button>
                                </div>
                                <div class="col-3 mt-4">
                                    <button id="undo_btn" title="Undo" type="button" class="btn btn-edit-photo drawing action-drawing">
                                        <i class="ri-arrow-go-back-line big-icon"></i>
                                    </button>
                                </div>
                                <div class="col-3 mt-4">
                                    <button id="redo_btn" title="Redo" type="button" class="btn btn-edit-photo drawing action-drawing">
                                        <i class="ri-arrow-go-forward-line big-icon"></i>
                                    </button>
                                </div>
                                <div class="row mb-5 pb-5">
                                    <div class="col-6 ">
                                        <div>
                                            <label for="basiInput" class="form-label m-0 mt-2 p-0 text-soft-blue ">Width </label>
                                            <input type="number" class="form-control action-drawing" id="width_inp" placeholder="กำหนดขนาดของเส้น" value="18" oninput="validity.valid||(value='');">
                                        </div>
                                    </div>
                                    <div class="col-6 ">
                                        <div>
                                            <label for="basiInput" class="form-label m-0 mt-2 p-0 text-soft-blue">Color</label>
                                            <input type="color" class="form-control form-control-color w-100 action-drawing" id="color_inp" value="#03396c" placeholder="#3255788" >
                                        </div>
                                    </div>
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
                <img src="{{picurl("$hn/$folderdate/$photoname")}}?{{$rand}}" style="max-width:100%;height:100%; display:block" id="image_dummy"  alt="">

                <img src="{{picurl("$hn/$folderdate/$photoname")}}?{{$rand}}" style="max-width:100%;height:100%; display:none" id="image"  alt="">
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

    {{-- <script src="{{ url('public/cropnew/cropper.min.js') }}"></script> --}}
    <script src="{{ url('public/cropnew/bootstrap.bundle.min.js') }}"></script>
    <script>
        var cropper, canvas, cv, cvx, old_canvas;
        var from_x, from_y, to_x, to_y;
        var rotate_btn
        var down                = false
        var is_crop             = false
        var has_input           = false
        var warning_crop        = false
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

        var image;
        var image_src;
        var for_selected_num = $('.select-img').length


        var otherimg_lg = $('.otherimg').length
        for (let z = 0; z < otherimg_lg; z++) {
            $($('.otherimg')[z]).height(div_height).width(div_width)

        }

        $('#otherimg').width(div_width).height(div_height)

        // for (let i = 0; i < $('.action-crop').length; i++) {
        //     $($('.action-crop')[i]).prop('disabled', true)
        // }

        // for (let j = 0; j < $('.action-drawing').length; j++) {
        //     $($('.action-drawing')[j]).prop('disabled', true)
        // }

        document.addEventListener("DOMContentLoaded", function(){
            loadJS("{{ url('public/cropnew/cropper.min.js') }}", true)
        });

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

                // image = document.querySelector('#image');
                // image_src = $(image).attr('src')

                // cropper = create_cropper_instance(image)

                // for_selected_num = $('.select-img').length
                // for (let i = 0; i <= for_selected_num; i++) {
                //     let sel_image   = document.getElementById(`imagesel${i}`)
                //     if(!$(`#imagesel${i}`).hasClass('self-img')){
                //         let cropper = create_cropper_instance(sel_image)
                //         croppers[`imagesel${i}`] = cropper
                //     }
                // }
            });
            // error event
            scriptEle.addEventListener("error", (ev) => {
                console.log("Error on loading file", ev);
            });
        }

        function start_crop(action=''){
            console.log(action,'gsta');
            image     = document.querySelector('#image');
            image_src = $(image).attr('src')
            cropper   = create_cropper_instance(image, 1, action=action)
            if(action == ''){
                for_selected_num = $('.select-img').length
                for (let i = 0; i <= for_selected_num; i++) {
                    let sel_image   = document.getElementById(`imagesel${i}`)
                    if(!$(`#imagesel${i}`).hasClass('self-img')){
                        let cropper = create_cropper_instance(sel_image)
                        croppers[`imagesel${i}`] = cropper
                    }
                }
            }
        }

        function change_action_div(action){
            let elem = (action == 'crop') ? 'crop' : 'drawing'
            if(elem == 'crop'){
                $('.crop-div').css('display', 'block')
                $('.drawing-div').css('display', 'none')
                start_crop()
                $('#image_dummy').css('display', 'none')
            } else {
                $('.crop-div').css('display', 'none')
                $('.drawing-div').css('display', 'block')
                if(cropper == undefined){
                    start_crop('drawing')
                }
                $('#image_dummy').css('display', 'none')
                $('#show_crop').prop('disabled', true)
            }
        }

        function change_action(action){
            let is_check = $(`#toggle_${action}`).is(':checked')
            let elem_lg  = $(`.action-${action}`).length
            let status   = ''

            let other_action = action == 'crop' ?  'drawing' : 'crop'
            if(is_check){
                status = false
                $(`.${action}-div`).removeClass('inactive-div').addClass('active-div')
                $(`.${other_action}-div`).removeClass('active-div').addClass('inactive-div')
                console.log('action:', action);
                if(action == 'crop'){
                    start_crop()
                    $('#image_dummy').css('display', 'none')
                } else {
                    console.log('gggggg');
                    // start_drawing()
                    start_crop('drawing')
                    // detect_crop_image()

                    $('#image_dummy').css('display', 'none')
                }
            } else {
                status = true
                $(`.${action}-div`).removeClass('active-div').addClass('inactive-div')
                $(`.${other_action}-div`).removeClass('inactive-div').addClass('active-div')

            }

            $(`#toggle_${other_action}`).prop('checked', false)
            $(`#toggle_${action}`).prop('disabled', true)
            $(`#toggle_${other_action}`).prop('disabled', true)

            console.log(is_check, elem_lg, status);


            for (let i = 0; i < elem_lg; i++) {
                $($(`.action-${action}`)[i]).prop('disabled', status)
            }

        }

        function start_drawing(){
            let img = document.querySelector('#image')
            let base64 = ''
            console.log(base64);
            $('#crop_div').empty()
            $('#image_dummy').css('display', 'none')
            $('#crop_div').css('display', 'block')
            $('#image_div').css('display', 'none')

            // 2 case -> need to create canvas from image (#image), from cropper (cropper.dataurl)
            if(cropper == undefined || cropper == ''){
                while (base64 == '' || base64 == undefined) {
                    base64 = base64Img(img)
                    console.log('waiting...');
                }
                console.log(base64);
                drawing_img_on_canvas(base64)

            } else {

            }

        }

        function base64Img(img) {
            const canvas = document.createElement('canvas');
            const ctx = canvas.getContext('2d');
            canvas.width = img.width;
            canvas.height = img.height;
            ctx.drawImage(img, 0, 0);
            return canvas.toDataURL('image/jpeg');
        }

        function drawing_img_on_canvas(base64){
            // let canvas = document.createElement('canvas');
            // let context = canvas.getContext("2d");
            // canvas.id = "canvas_id";
            // canvas.className = "canvas";                  // should be className
            // canvas.minWidth = 500
            // canvas.minHeight = 500                          // should be numbers
            // canvas.maxWidth = 1200
            // canvas.maxHeight = 800
            // canvas.height = 800
            // canvas.weight = 1200


            // var img = new Image();
            // img.onload = function() {
            //     // or set canvas size = image, here: (this = currently loaded image)
            //     // canvas.width = this.width;
            //     // canvas.height = this.height;
            //     // canvas.width  = image.naturalWidth;
            //     // canvas.height = image.naturalHeight;
            //     var hRatio = (canvas.width / img.width )    ;
            //     var vRatio = (canvas.height / img.height)   ;
            //     // var ratio  = Math.min ( hRatio, vRatio );
            //     context.drawImage(this, 0,0, img.width, img.height, 0,0,img.width*vRatio, img.height*hRatio);
            //     // context.drawImage(this, 0, 0);              // draw at (0,0), size = image size

            //     // or, if you want to fill the canvas independent on image size:
            //     // context.drawImage(this, 0, 0, canvas.width, canvas.height);
            // }
            // // set src last (recommend to use relative paths where possible)
            // img.src = base64;
            // console.log(canvas);
            // $('#crop_div').append(canvas)
            // // document.body.appendChild(canvas);

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

        function check_crop_status(type){
            // let is_allcrop = $('#allphoto_sel').prop('disabled')
            let is_hide = $('#allphoto_div').css('display')
            // if(!is_allcrop){
            if(is_hide == 'block'){
                warning_crop = true
                $('#allphoto_div').css('display', 'none')
                $('#selected_div').css('display', 'none')
                $('#multi_crop_div').css('display', 'none')
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
            // console.log(crop_cv.width, crop_cv);
            ctx.drawImage(crop_cv, 0, 0);
            // console.log('hist:', canvas.toDataURL('image/png'));
            // return canvas.toDataURL('image/png');
            let quality = 0.5
            return canvas.toDataURL('image/jpeg', quality);
        }

        $('#warning_confirm_btn').on('click', function () {
            // warning_crop = true
            // $('#allphoto_sel').prop('disabled', true)
            // $('#selected_sel').prop('disabled', true)
            // $('#warning_close_btn').click()
            // if(rotate_btn == 'rc'){
            //     cropper.rotate(90)
            // } else if(rotate_btn == 'rcc'){
            //     cropper.rotate(-90)
            // }
            $(this).attr('disabled', true)
            $('#warning_confirm_sp').css('display', 'block')
            detect_crop_image()
            var canvas      = $('#crop_div').find('canvas')
            var this_canvas = $(canvas)
            var base64      = this_canvas[0].toDataURL()
            $('#photodata').val(base64)
            setTimeout(() => {
                $('#crop_form').submit()
            }, 1 * 500);
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

        $('#reset2_btn').on('click', function () {
            // $('#image_dummy').css('display', 'block')
            // $('#crop_div').empty()
            // $('canvas').remove()
            $('.picrollbacknew').click()
        })

        $('.drawing').on('click', function () {
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

        })

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

            $('#warning_btn').click()
        })

        // drawing
        $('#pen_btn').on('click', function(){
            detect_crop_image()
            check_btn_status(this.id)
            unbind_event()

            $(cv).bind('mousedown', function (e) {
                set_position(e, 'to')
                down = true
                $(cv).bind('mousemove', function (e) {
                    draw_pen(e)
                    set_position(e, 'to')
                })
            })

            $(cv).bind('mouseup', function (e) {
                down = false
                canvas_hist.push(img_to_base64())
                tracked_cvhist = canvas_hist.length
                $(cv).unbind('mousemove')
            })
        })

        $('#arrow_btn').on('click', function(){
            detect_crop_image()
            check_btn_status(this.id)
            unbind_event()

            $(cv).bind('mousedown', function (e) {
                down = true
                set_position(e, 'from')
                old_canvas = canvas.toDataURL()
                $(cv).bind('mousemove', function(e){
                    set_position(e, 'to')
                    clear_canvas('arrow')
                })
            })

            $(cv).bind('mouseup', function(e) {
                down = false
                canvas_hist.push(img_to_base64())
                tracked_cvhist = canvas_hist.length
                set_position(e, 'to')
                $(cv).unbind('mousemove')
                draw_arrow(ctx, from_x, from_y, to_x, to_y, line_width, line_color)
            })
        })

        $('#circle_btn').on('click', function(){
            detect_crop_image()
            check_btn_status(this.id)
            unbind_event()

            $(cv).bind('mousedown', function (e) {
                down = true
                set_position(e, 'from')
                old_canvas = canvas.toDataURL()
                $(cv).bind('mousemove', function(e){
                    set_position(e, 'to')
                    clear_canvas('circle')
                })
            })

            $(cv).bind('mouseup', function(e) {
                down = false
                canvas_hist.push(img_to_base64())
                tracked_cvhist = canvas_hist.length
                set_position(e, 'to')
                $(cv).unbind('mousemove')
                draw_circle()
            })
        })

        $('#rect_btn').on('click', function(){
            detect_crop_image()
            check_btn_status(this.id)
            unbind_event()

            $(cv).bind('mousedown', function (e) {
                down = true
                set_position(e, 'from')
                old_canvas = canvas.toDataURL()
                $(cv).bind('mousemove', function(e){
                    set_position(e, 'to')
                    clear_canvas('rect')
                })
            })

            $(cv).bind('mouseup', function(e) {
                down = false
                canvas_hist.push(img_to_base64())
                tracked_cvhist = canvas_hist.length
                set_position(e, 'to')
                $(cv).unbind('mousemove')
                draw_rect()
            })
        })


        var init_text = [];
        var text_click = 0
        var x_edit = 0
        var y_edit = 0
        $('#text_btn').on('click', function(){
            detect_crop_image()
            check_btn_status(this.id)
            unbind_event()

            $(cv).bind('mousedown', function (e) {
                if(text_click == 0){
                    init_text = getCursorPosition(canvas, e)
                    let rect = canvas.getBoundingClientRect();
                    x_edit = e.clientX- 19 -rect.left
                    y_edit = e.clientY- 18 - rect.top
                }
                add_input(e, e.clientX-19, e.clientY-18)

                // var rect = canvas.getBoundingClientRect();
                // x_edit = e.clientX- 19 -rect.left
                // y_edit = e.clientY- 18 - rect.top

                text_click += 1

                $(cv).bind('mousemove', function(e){
                    set_position(e, 'to')
                })
            })

            $(cv).bind('mouseup', function(e) {
                down = false
                $(cv).unbind('mousemove')
                if($('#text_canvas').val() != '' && $('#text_canvas').val() != undefined ){
                // if($('#text_canvas').html() != '' && $('#text_canvas').html() != undefined ){
                    let txtarea = $('#text_canvas').val()

                    let lines   = txtarea.split('\n')
                    for (let i = 0; i < lines.length; i++) {
                        let y = init_text[1] + (i * line_width)
                        draw_text(lines[i], init_text[0], y)
                    }

                    // canvas
                    // html2canvas(document.querySelector("#text_canvas"), {backgroundColor: null}).then(canvas => {
                    //     // document.body.appendChild(canvas)
                    //     let this_dataurl = canvas.toDataURL()
                    //     let this_img = new Image()
                    //     this_img.onload = function() {
                    //         ctx.drawImage(this_img, x_edit, y_edit)
                    //         console.log('finish');
                    //     }

                    //     this_img.src = this_dataurl
                    //     console.log(this_dataurl, x_edit, y_edit, ctx);

                    // });
                }
                canvas_hist.push(img_to_base64())
                tracked_cvhist = canvas_hist.length
                $('#text_canvas').remove()
                has_input = false
                text_click = 0
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
            console.log('sel',  txt.toString());

            selected_text = txt.toString()

            return txt

            // document.aform.selectedtext.value =  txt;
        }

        $('#width_inp').on('input', function () {
            line_width = $(this).val()
        })

        $('#color_inp').on('input', function () {
            line_color = $(this).val()
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
            if(tracked_cvhist > canvas_hist.length){
                tracked_cvhist = canvas_hist.length
                return
            }

            if(tracked_cvhist == canvas_hist.length){
                tracked_cvhist = canvas_hist.length
            }
            else if(tracked_cvhist > 0){
                tracked_cvhist = tracked_cvhist + 1
            }

            // console.log('redo',tracked_cvhist, canvas_hist.length);

            redrawing(tracked_cvhist)
        })

        $('#undo_btn').on('click', function () {
            if(tracked_cvhist > canvas_hist.length){
                tracked_cvhist = canvas_hist.length
                return
            }

            if(tracked_cvhist == 1){
                tracked_cvhist = 1
            }
            else if(tracked_cvhist > 0){
                tracked_cvhist = tracked_cvhist - 1
            }

            // console.log('undo',tracked_cvhist, canvas_hist.length);

            redrawing(tracked_cvhist)
        })

        function redrawing(index){
            let canvasdata  = canvas_hist[index-1]
            let newImage    = new Image()
            newImage.onload = function () {
                ctx.drawImage(newImage, 0, 0, props['w'], props['h'])
            }
            newImage.src    = canvasdata
        }
        //
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
            let is_crop = $('#crop_div').css('display')
            if(is_crop == 'none'){
                $('#crop_div').css('display', 'block')
                $('#crop_div').html('')
                $('#crop_div').append(cropper.getCroppedCanvas({minWidth: 1200, minHeight: 800,maxWidth: 1200,maxHeight: 800,}))
                $('#image_div').css('display', 'none')
                canvas_hist.push(img_to_base64())
                canvas      = document.querySelector('canvas')
                ctx         = canvas.getContext('2d')
                cv          = $('canvas').get(0)
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

        function draw_circle() {
            let r = Math.abs(to_x - from_x)
            ctx.beginPath();
            ctx.strokeStyle = line_color
            ctx.lineWidth   = line_width
            ctx.arc(from_x, from_y, r, 0, 2 * Math.PI);
            ctx.stroke()
        }

        function draw_rect(){
            let x = from_x > to_x ? to_x : from_x
            let y = from_y > to_y ? to_y : from_y
            ctx.beginPath();
            ctx.strokeStyle = line_color
            ctx.lineWidth   = line_width
            ctx.rect(x, y, Math.abs(to_x - from_x), Math.abs(to_y - from_y));
            ctx.stroke();
        }

        function draw_text(text, x, y) {
            draw_ctx()
            ctx.textBaseline    = 'top';
            ctx.textAlign       = 'left';
            ctx.font            = `${line_width}px Arial`
            ctx.fillText(text, x - 4, y - 4)
        }

        function getCursorPosition(canvas, event) {
            let rect    = canvas.getBoundingClientRect()
            let x       = event.clientX - rect.left
            let y       = event.clientY - rect.top
            // console.log(`get event x: ${event.clientX}, y: ${event.clientY}` );
            // console.log(`get rect left: ${rect.left}, top: ${rect.top}` );
            // console.log(`get x: ${x}, y: ${y}` );
            return [x, y]
        }

        function clear_canvas(type){
            if(down){
                let newImage    = new Image()
                newImage.onload = function () {
                    ctx.drawImage(newImage, 0, 0, props['w'], props['h'])
                    if(type == 'arrow'){
                        draw_arrow(ctx, from_x, from_y, to_x, to_y, line_width, line_color)
                    } else if(type == 'circle'){
                        draw_circle()
                    } else if(type == 'rect') {
                        draw_rect()
                    }
                }
                newImage.src    = old_canvas
            }
        }

        function set_position(e, type){
            let position = getCursorPosition(canvas, e)
            console.log(position);
            if(type == 'from'){
                from_x = position[0]
                from_y = position[1]
            } else if(type == 'to'){
                to_x = position[0]
                to_y = position[1]
            }
        }

        function unbind_event(){
            $(cv).unbind('mouseup')
            $(cv).unbind('mousedown')
            $(cv).unbind('mousemove')
        }

        function draw_ctx(){
            ctx.fillStyle = line_color != '' && line_width != undefined ? $('#color_inp').val() : '#000000'
            ctx.lineWidth = line_width != '' && line_color != undefined ? $('#width_inp').val() : 18
        }



        function add_input(e, x, y){
            if(!has_input){
                let position = getCursorPosition(canvas, e)
                var input    = document.createElement('textarea');
                // var input    = document.createElement('p');
                let line_width = $('#width_inp').val() != ''  && $('#width_inp').val() != undefined ? $('#width_inp').val() : 18
                let line_color = $('#color_inp').val() != ''  && $('#color_inp').val() != undefined  ? $('#color_inp').val() : '#000000'

                input.type              = 'text';
                input.id                = 'text_canvas'
                input.className         = 'form-control'
                input.placeholder       = 'Input text'
                input.style.position    = 'fixed';
                input.style.width       = '450px'
                input.style.height      = '250px'
                input.style.fontSize    = `${line_width}px`
                input.style.lineHeight  = '1.0em'
                input.style.overflow    = 'hidden'
                input.style.background  = 'transparent'
                input.style.backgroundColor = 'transparent'
                input.style.border      = '1px solid black'
                input.style.outline     = 'none'
                input.style.cols        = 20
                input.style.rows        = 20
                input.style.left        = (x) + 'px';
                input.style.top         = (y) + 'px';
                input.style.color       = line_color
                input.contentEditable   = "true"
                // input.style.color       = 'transparent'
                // console.log(x,y);

                document.body.appendChild(input);

                $('#text_canvas').click()

                // for textrea
                $('#text_canvas').bind('input propertychange', function () {
                    let this_text = this.value
                    // let selected_txt = selectedText()
                    console.log('text', this_text);
                })

                $('#text_canvas').bind('select', getSelText)

                setTimeout(() => {
                    $('#text_canvas').focus()
                }, 1 * 500);

                has_input = true
            }
        }

        function change_cropbox_size(value, type){
            let data = cropper.getCropBoxData()
            data[type] = parseInt(value)
            cropper.setCropBoxData(data)
        }

        var first_cb;
        function create_cropper_instance(img, viewmode=1, action=''){
            console.log(action, 'ggg');
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
                    console.log(dragbox_width, dragbox_height);

                    // cropper.setCropBoxData({height: (containerData.height/2), width: (containerData.width/2)-50, left:(containerData.width/4)})
                    cropper.setCropBoxData({height: dragbox_height, width: dragbox_width, left:(containerData.width)})
                    console.log(action);
                    if(action == 'drawing'){
                        detect_crop_image()
                    }

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

            var folderdate   = '{{$folderdate}}';
            var photoname    = $(this).data('photoname');
            var hn           = $(this).data('hn');
            var photo_status = $(this).data('status');
            var photo_id     = $(this).data('photo_id');
            var case_id      = $(this).data('case_id');

            $.post("{{url("api/photomove")}}",{
                event       : 'photorollback',
                folderdate  : '{{$folderdate}}',
                photo_id    : photo_id,
                hn          : hn,
                caseid      : case_id,
                photoname   : photoname,
            },function(data,status){
                reload_img()
            });

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
            location.reload()

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
            $(this).attr('disabled', true)
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
                }, 1 * 100);
            }

        })

        $('#confirm_all_btn').on('click', function () {
            sent_type = 'all'
            change_select_status('add')
            $('#confirm_select_btn').click()
            // $(this).css('display', 'none')
            $(this).attr('disabled', true)
            $('#confirm_selectall_sp').css('display', 'block')

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
