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
                <a href="{{url('procedure')}}/{{$cid}}" class="btn btn-danger btn-label waves-effect right w-lg waves-light" id="back_btn">
                    <i class="ri-arrow-go-back-line label-icon align-middle fs-16 ms-2" ></i> Cancel
                </a>
                <button type="button" class="btn btn-primary btn-label waves-effect right w-lg waves-light" id="confirm_btn">
                    <i class="ri-check-double-line  label-icon align-middle fs-16 ms-2"></i> Confirm
                </button>
            </div>
        </div>
        <div class="row" style="height: 82vh">
            <div class="col-4 px-4 h-100"  >


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
                                    <button id="pen_btn" title="Pen" type="button" class="btn btn-edit-photo drawing">
                                        <i class="ri-pencil-fill big-icon"></i>
                                    </button>
                                </div>
                                <div class="col-3">
                                    <button id="arrow_btn" title="Arrow" type="button" class="btn btn-edit-photo drawing" style="">
                                        <i class="ri-arrow-left-down-fill big-icon"></i>
                                    </button>
                                </div>
                                <div class="col-3">
                                    <button id="circle_btn" title="Circle" type="button" class="btn btn-edit-photo drawing">
                                        <i class="ri-checkbox-blank-circle-line big-icon"></i>
                                    </button>
                                </div>
                                <div class="col-3">
                                    <button id="rect_btn" title="Rectangle" type="button" class="btn btn-edit-photo drawing">
                                        <i class=" ri-checkbox-blank-line big-icon"></i>
                                    </button>
                                </div>
                                <div class="col-3 mt-4">
                                    <button id="text_btn" title="Add Text" type="button" class="btn btn-edit-photo drawing">
                                        <i class=" ri-text big-icon"></i>
                                    </button>
                                </div>
                                <div class="col-3 mt-4">
                                    <button id="undo_btn" title="Undo" type="button" class="btn btn-edit-photo drawing">
                                        <i class="ri-arrow-go-back-line big-icon"></i>
                                    </button>
                                </div>
                                <div class="col-3 mt-4">
                                    <button id="redo_btn" title="Redo" type="button" class="btn btn-edit-photo drawing">
                                        <i class="ri-arrow-go-forward-line big-icon"></i>
                                    </button>
                                </div>
                                <div class="row " style="padding-top: 100px">
                                    <div class="col-6 " >
                                        <div>
                                            <label for="basiInput" class="form-label m-0 mt-2 p-0 text-soft-blue">Width </label>
                                            <input type="range" class="form-range mt-2" id="width_inp"   min="0" max="150" value="36">
                                            <span class="example-val mt-2" id="slider1-span">36</span>
                                            {{-- <input type="number" class="form-control" id="width_inp" placeholder="กำหนดขนาดของเส้น" value="18" oninput="validity.valid||(value='');"> --}}
                                        </div>
                                    </div>
                                    <div class="col-6 ">
                                        <div>
                                            <label for="basiInput" class="form-label m-0 mt-2 p-0 text-soft-blue">Color</label>
                                            {{-- <input type="color" class="form-control form-control-color w-100" id="color_inp" value="#FF0000" placeholder="#3255788" > --}}
                                            <input type="text" class="form-control form-control-color w-100" id="color_inp" style="background-color: #ffffff; border:0" readonly>
                                        </div>
                                    </div>
                                    <div class="row p-3">
                                        <div class="col-6  text-end">
                                            <button id="" class="btn btn-danger btn-label waves-effect right waves-light w-lg">Undo <i class="ri-arrow-go-back-line label-icon align-middle fs-16 ms-2"></i></button>
                                        </div>
                                        <div class="col-6 ">
                                            <button id="reset2_btn" class="btn btn-success btn-label waves-effect right waves-light w-lg">Reset <i class=" ri-refresh-line label-icon align-middle fs-16 ms-2"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-8 h-100 px-4" id="image_div"  >

                @php
                        $rand = rand(10000, 99999);
                    @endphp
                <img src="{{picurl("$hn/$folderdate/$photoname")}}?{{$rand}}" style="width:100%;height:800px; display:block" id="image"  alt="">
                {{-- <img src="" style="width:100%;height:800px; display:block" id="image"  alt=""> --}}

            </div>
            <div id="crop_div2"></div>
            <div id="crop_div" class="col-7 text-center" style="display:none; padding-start: 20px">

            </div>
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
    {{-- <div style="width:0.5rem"></div> --}}
@endsection

<script src="{{ url('public/js/painterro-1.2.82.min.js') }}"></script>
<script src="{{ url('public/cropnew/jquery.min.js') }}"></script>
<script src="{{ url('public/cropnew/bootstrap.bundle.min.js') }}"></script>

<script>
    var div_width, div_height, tracked_btn, paint, paint_color_elem, paint_width;
    var props = []
    var default_color = '#0077E6'
    var default_size  = 36

    window.onload = function(){
        console.log('onload');
        div_width           = $('#image_div').width()
        div_height          = $('#image_div').height()
        var cropper, canvas, cv, ctx, old_canvas;

        loadJS("{{ url('public/cropnew/cropper.min.js') }}", true)
        console.log(div_height, div_width);

        for (let i = 0; i < $('.drawing-tools').length; i++) {
            $($('.drawing-tools')[i]).prop('disabled', true)
        }

        $('#pen_btn').on('click', function (){
            check_btn_status('pen_btn')
            get_tool_active('Brush')
            init_width('lineWidth')
        })

        $('#arrow_btn').on('click', function () {
            check_btn_status('arrow_btn')
            get_tool_active('arrow')
            init_width('arrowLength')
        })

        $('#circle_btn').on('click', function () {
            check_btn_status('circle_btn')
            get_tool_active('ellipse')
            init_width('lineWidth')
        })

        $('#rect_btn').on('click', function () {
            check_btn_status('rect_btn')
            get_tool_active('rectangle')
            init_width('lineWidth')
        })

        $('#text_btn').on('click', function () {
            check_btn_status('rect_btn')
            get_tool_active('text')
            init_width('fontSize')


        })

        $('#redo_btn').on('click', function () {
            check_btn_status('redo_btn')
            get_tool_active('Redo')
        } )

        $('#undo_btn').on('click', function () {
            check_btn_status('undo_btn')
            get_tool_active('Undo')
        })

        $('#reset2_btn').on('click', function (){
            get_tool_active('Close')
            $('#crop_div').empty()
            create_new_paint()
        })

        $('#color_inp').on('click', function (e) {
            // let this_color = $(this).val()
            // init_color()
            $(".ptro-tool-controls").find(`[data-id='line']`).click()
            // get_tool_active('line')
        })

        $('#confirm_btn').on('click', function() {
            $('#warning_btn').click()
        })

        $('#warning_btn').on('click', function () {
            get_tool_active('Save')
            let save_elem = $(".ptro-bar-right").find('.ptro-icon-btn.ptro-color-control').get(0)
            $(save_elem).prop('disabled', false)
            if($('#photodata').val() != ''){
                setTimeout(() => {
                    $('#crop_form').submit()
                }, 1 * 500);
            }
        })





        $('#width_inp').on('change', function () {
            let this_width = $(this).val()
            if(tracked_btn == 'arrow_btn'){
                data_id = "arrowLength"
            } else if(tracked_btn == 'pen_btn' || tracked_btn == 'rect_btn' || tracked_btn == 'circle_btn'){
                data_id = "lineWidth"
            } else if(tracked_btn == 'text_btn'){
                data_id = "fontSize"
            }
            let paint_width = $(".ptro-tool-controls").find(`[data-id='${data_id}']`)

            // trigger input events
            let elem_id = $(paint_width).attr('id')
            $(paint_width).val(this_width).trigger('change')
            let element = document.getElementById(elem_id)
            element.dispatchEvent(new Event('input', { bubbles: true }))

            $('#slider1-span').html(this_width)
        })

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
            },
        });
        return cropper
    }

    function detect_crop_image(){
        console.log('in');
        let is_crop = $('#crop_div').css('display')
        if(is_crop == 'none'){
            console.log('gg', div_width, div_height);
            $('#crop_div').css('display', 'block')
            $('#crop_div').html('')
            $('#crop_div2').append(cropper.getCroppedCanvas({minWidth: 500, minHeight: 500,maxWidth: div_width,maxHeight: div_height,}))
            $('#image_div').css('display', 'none')
            // canvas_hist.push(img_to_base64())
            // init_image = img_to_base64()
            let cv_index =  $('canvas').length == 1 ? 0 : 1
            canvas       = $('canvas').get(cv_index)
            ctx         = canvas.getContext('2d')
            cv          = $('canvas').get(cv_index)
            props['w']  = canvas.width
            props['h']  = canvas.height
            $(canvas).css('display', 'none')
            $('#crop_div2').css('display', 'none')
        }

        create_new_paint()
        $('#arrow_btn').click()
    }

    function create_new_paint(){
        var base64 = cropper.getCroppedCanvas().toDataURL()
        paint = Painterro({
            id: 'crop_div',
            activeColor: '#000000',
            activeColorAlpha: 0.5,
            defaultPrimitiveShadowOn: false,
            defaultTextStrokeAndShadow: false,
            // activeFillColor: '#0077E6',
            hiddenTools: [],
            defaultTool: 'arrow',
            initTextColor: '#0077E6',
            initTextStyle:'',
            backgroundFillColor: '#BAD5DB',
            defaultFontSize: default_size,

            colorScheme: {
                // backgroundColor: '#FFFFFFA6',
                // activeControl: '#7485B1',
                // inputText: '#ffffff',
                // inputBackground: '#7485B1',

            },
            saveHandler: function (image, done) {
                let dataurl = image.asDataURL('image/jpeg', 0.9)
                $('#photodata').val(dataurl)
                done(false)
                // console.log(dataurl, );
            }
        })
        paint.show(`${base64}`)
        init_color()

        $('.ptro-named-btn.ptro-close-color-picker').on('click', function () {
            get_color_from_input()
        })

        $(".ptro-tool-controls").find(`[data-id='line']`).click()
        get_color_from_input()
        $('.ptro-named-btn.ptro-close-color-picker').click()

        $('#crop_div-bar').css('display', 'none')
    }

    function get_color_from_input(params) {
        let this_color = $('.ptro-input.ptro-color').val()
        $('#color_inp').css('background-color', this_color)
    }

    function get_tool_active(tool_name) {
        for (let i = 0; i < $('.ptro-icon-btn').length; i++) {
            let this_tooltitle = $($('.ptro-icon-btn')[i]).attr('title')
                if(this_tooltitle != undefined){
                    if(this_tooltitle.includes(tool_name)){
                    $($('.ptro-icon-btn')[i]).click()
                }
            }
        }
    }

    function check_btn_status(id){
        let is_clicked = $(`#${id}`).hasClass('btn-edit-photo')
        if(is_clicked){
            $(`#${id}`).removeClass('btn-edit-photo').addClass('btn-clicked')
        } else {
            $(`#${id}`).removeClass('btn-clicked').addClass('btn-edit-photo')
        }

        if(tracked_btn != id && tracked_btn != ''){
            $(`#${tracked_btn}`).removeClass('btn-clicked').addClass('btn-edit-photo')
        }

        tracked_btn = id
    }

    function init_width(data_id){
        let arrow_width_inp = $(".ptro-tool-controls").find(`[data-id='${data_id}']`)
        let width_inp = $('#width_inp').val()
        let elem_id = $(arrow_width_inp).attr('id')
        let element = document.getElementById(elem_id)
        // trigger input events
        $(arrow_width_inp).val(width_inp).trigger('change')
        element.dispatchEvent(new Event('input', { bubbles: true }))
    }

    function init_color(){
        // need way to trigger keydown in input
        // let color_tool_inp = $('.ptro-color-edit').find('.ptro-color')
    }





</script>
