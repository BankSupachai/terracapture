<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Cropper.js</title>
  <link href="{{url("public/cropnew/cropper.css")}}" rel="stylesheet"/>
  <link href="{{url("public/cropnew/bootstrap.min.css")}}" rel="stylesheet">
  <style>
    .container2 {
        width: 100%;
        /* height: 60%; */
        /* position: relative; */
    }

    img {
        max-width: 640px;
        /* max-height: 50%; */
    }

    html, body{
        width: 100%;
        height: 100%;
        overflow: hidden;
        margin: 0;
    }

    .btn-header {
        background-color: #666;
        border-color: #666;
    }

  </style>
</head>
<body style="background-color: #333333">

    @php
        $cid        = $_GET['cid'];
        $hn         = $_GET['hn'];
        $photoname  = $_GET['photoname'];
        $folderdate = $_GET['folderdate'];
        $caseuniq   = $_GET['caseuniq'];
        $ppic       = $_GET['ppic'];

    @endphp

    <div style="background-color: #666; color: white; ">
        <div class="row">
            {{-- <div style="width:0.5rem"></div> --}}
            <div class="col-auto mt-2 ms-2">
                <a href="{{url('procedure')}}/{{$cid}}" type="button" class="btn btn-dark waves-effect waves-light btn-header">Back</a>
            </div>
            <div class="col-4 mt-2">
                {{-- <h1 class="display-6">Crop Photo</h1> --}}
                <p class="fs-5 mt-1">Crop Photo </p>
            </div>
            <div class="col-6 mt-2"></div>
            <div style="width:0.5rem"></div>
            <div class="col-auto mt-2 p-0">
                <button id="clear_btn" type="button" class="btn btn-dark waves-effect waves-light btn-header" style="display: none; ">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle text-white" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
                      </svg>
                </button>
            </div>
            <div class="col-auto mt-2 p-0">
                <button id="select_crop_btn"  type="button" class="btn btn-dark waves-effect waves-light btn-header" style="display: none;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-circle text-white" viewBox="0 0 16 16">
                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                        <path d="M10.97 4.97a.235.235 0 0 0-.02.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05z"/>
                    </svg>
                </button>
            </div>
            <div class="col-auto mt-2 p-0">
                <button id="download_crop_btn" type="button" class="btn btn-dark waves-effect waves-light btn-header" style="display: none;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-download text-white" viewBox="0 0 16 16">
                        <path d="M.5 9.9a.5.5 0 0 1 .5.5v2.5a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1v-2.5a.5.5 0 0 1 1 0v2.5a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2v-2.5a.5.5 0 0 1 .5-.5z"/>
                        <path d="M7.646 11.854a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V1.5a.5.5 0 0 0-1 0v8.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3z"/>
                    </svg>
                </button>
            </div>

            {{--  --}}
            <div class="col-auto mt-2 p-0">
                <button id="cancel_btn" type="button" class="btn btn-dark waves-effect waves-light btn-header" style="display: none;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-counterclockwise text-white" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M8 3a5 5 0 1 1-4.546 2.914.5.5 0 0 0-.908-.417A6 6 0 1 0 8 2v1z"/>
                        <path d="M8 4.466V.534a.25.25 0 0 0-.41-.192L5.23 2.308a.25.25 0 0 0 0 .384l2.36 1.966A.25.25 0 0 0 8 4.466z"/>
                      </svg>
                </button>
            </div>
            <div class="col-auto mt-2 p-0">
                <button id="selected_btn" type="button" class="btn btn-dark waves-effect waves-light btn-header" style="display: none;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-check-lg text-white" viewBox="0 0 16 16">
                        <path d="M12.736 3.97a.733.733 0 0 1 1.047 0c.286.289.29.756.01 1.05L7.88 12.01a.733.733 0 0 1-1.065.02L3.217 8.384a.757.757 0 0 1 0-1.06.733.733 0 0 1 1.047 0l3.052 3.093 5.4-6.425a.247.247 0 0 1 .02-.022Z"/>
                      </svg>
                </button>
            </div>


        </div>
    </div>

    <div id="edit_area" class="row" style="width: 100%">
        <div class="col-12">
            @php
                $rand = rand(10000, 99999);
            @endphp
            <div id="image_div" style="height:550px">
                <img id="image" src="{{picurl("$hn/$folderdate/$photoname")}}?{{$rand}}" >
            </div>
        </div>
        <div id="crop_div" class="col-12 text-center m-3" style="">

        </div>
        <div class="row">
            <div class="col-4"></div>
            <div class="col-6">
                <div class="mt-2" style="background-color: #333333; text-align:center; position: absolute; display: inline-block;" >
                    <div style="margin-left: auto; margin-right: auto; background-color: #212529; display:block" >
                        <button id="move_btn" type="button" class="btn btn-dark waves-effect waves-light">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrows-mov text-white" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M7.646.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1-.708.708L8.5 1.707V5.5a.5.5 0 0 1-1 0V1.707L6.354 2.854a.5.5 0 1 1-.708-.708l2-2zM8 10a.5.5 0 0 1 .5.5v3.793l1.146-1.147a.5.5 0 0 1 .708.708l-2 2a.5.5 0 0 1-.708 0l-2-2a.5.5 0 0 1 .708-.708L7.5 14.293V10.5A.5.5 0 0 1 8 10zM.146 8.354a.5.5 0 0 1 0-.708l2-2a.5.5 0 1 1 .708.708L1.707 7.5H5.5a.5.5 0 0 1 0 1H1.707l1.147 1.146a.5.5 0 0 1-.708.708l-2-2zM10 8a.5.5 0 0 1 .5-.5h3.793l-1.147-1.146a.5.5 0 0 1 .708-.708l2 2a.5.5 0 0 1 0 .708l-2 2a.5.5 0 0 1-.708-.708L14.293 8.5H10.5A.5.5 0 0 1 10 8z"/>
                            </svg>
                        </button>
                        <button id="show_crop_btn" type="button" class="btn btn-dark waves-effect waves-light">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-crop text-white" viewBox="0 0 16 16">
                                <path d="M3.5.5A.5.5 0 0 1 4 1v13h13a.5.5 0 0 1 0 1h-2v2a.5.5 0 0 1-1 0v-2H3.5a.5.5 0 0 1-.5-.5V4H1a.5.5 0 0 1 0-1h2V1a.5.5 0 0 1 .5-.5zm2.5 3a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v8a.5.5 0 0 1-1 0V4H6.5a.5.5 0 0 1-.5-.5z"/>
                                </svg>
                        </button>
                        <button id="zoomin_btn" type="button" class="btn btn-dark waves-effect waves-light">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-zoom-in text-white" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                                <path d="M10.344 11.742c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1 6.538 6.538 0 0 1-1.398 1.4z"/>
                                <path fill-rule="evenodd" d="M6.5 3a.5.5 0 0 1 .5.5V6h2.5a.5.5 0 0 1 0 1H7v2.5a.5.5 0 0 1-1 0V7H3.5a.5.5 0 0 1 0-1H6V3.5a.5.5 0 0 1 .5-.5z"/>
                            </svg>
                        </button>
                        <button id="zoomout_btn" type="button" class="btn btn-dark waves-effect waves-light">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-zoom-out text-white" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M6.5 12a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zM13 6.5a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0z"/>
                                <path d="M10.344 11.742c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1 6.538 6.538 0 0 1-1.398 1.4z"/>
                                <path fill-rule="evenodd" d="M3 6.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5z"/>
                            </svg>
                        </button>
                        <button id="rc_btn" type="button" class="btn btn-dark waves-effect waves-light">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-counterclockwise text-white" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 3a5 5 0 1 1-4.546 2.914.5.5 0 0 0-.908-.417A6 6 0 1 0 8 2v1z"/>
                                <path d="M8 4.466V.534a.25.25 0 0 0-.41-.192L5.23 2.308a.25.25 0 0 0 0 .384l2.36 1.966A.25.25 0 0 0 8 4.466z"/>
                            </svg>
                        </button>
                        <button id="rcc_btn" type="button" class="btn btn-dark waves-effect waves-light">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-clockwise text-white" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 3a5 5 0 1 0 4.546 2.914.5.5 0 0 1 .908-.417A6 6 0 1 1 8 2v1z"/>
                                <path d="M8 4.466V.534a.25.25 0 0 1 .41-.192l2.36 1.966c.12.1.12.284 0 .384L8.41 4.658A.25.25 0 0 1 8 4.466z"/>
                            </svg>
                        </button>
                        <button id="flip_vertical_btn" type="button" class="btn btn-dark waves-effect waves-light">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-up text-white" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M11.5 15a.5.5 0 0 0 .5-.5V2.707l3.146 3.147a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 1 0 .708.708L11 2.707V14.5a.5.5 0 0 0 .5.5zm-7-14a.5.5 0 0 1 .5.5v11.793l3.146-3.147a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 .708-.708L4 13.293V1.5a.5.5 0 0 1 .5-.5z"/>
                            </svg>
                        </button>
                        <button id="flip_horizontal_btn" type="button" class="btn btn-dark waves-effect waves-light">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-right text-white" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M1 11.5a.5.5 0 0 0 .5.5h11.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 11H1.5a.5.5 0 0 0-.5.5zm14-7a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H14.5a.5.5 0 0 1 .5.5z"/>
                                </svg>
                        </button>

                    </div>
                </div>
            </div>
            <div class="col-3"></div>
        </div>
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


    {{-- <div id="result"></div> --}}
  </div>

  <script src="{{url("public/cropnew/jquery.min.js")}}"></script>
  <script src="{{url("public/cropnew/cropper.min.js")}}"></script>
  <script src="{{url("public/cropnew/bootstrap.bundle.min.js")}}"></script>
  <script>

    $('#waiting_btn').click()

    var cropper;
    var is_flip_vertical = false
    var is_flip_horizontal = false
    var is_crop = false

    // window.addEventListener('DOMContentLoaded', function () {

    var image = document.querySelector('#image');
    var minAspectRatio = 0.5;
    var maxAspectRatio = 1.5;

    cropper = new Cropper(image, {
        dragMode: 'none',
        autocrop: false,
        background: false,
        ready: function () {
            var cropper = this.cropper;
            var containerData = cropper.getContainerData();
            var cropBoxData = cropper.getCropBoxData();
            var aspectRatio = cropBoxData.width / cropBoxData.height;
            var newCropBoxWidth;

            if (aspectRatio < minAspectRatio || aspectRatio > maxAspectRatio) {
                console.log('rrr');
                newCropBoxWidth = cropBoxData.height * ((minAspectRatio + maxAspectRatio) / 2);

                cropper.setCropBoxData({
                left: (containerData.width - newCropBoxWidth) / 2,
                width: newCropBoxWidth
                });
            }


            this.cropper.clear()
            // $('#close_waiting').click()
            this.cropper.setDragMode('move')
        },
    });




    $('#move_btn').on('click', function () {
        cropper.setDragMode('move')
    })

    $('#show_crop_btn').on('click', function () {
        set_display('crop', 'block')
        // cropper.crop()
        console.log(is_crop);
        var crop_status = false
        if(!is_crop){
            cropper.setDragMode('crop')
            crop_status = true
        } else {
            $('#clear_btn').click()
            // cropper.setDragMode('crop')
            crop_status = false
        }
        is_crop = crop_status
    })

    $('#zoomin_btn').on('click', function(){
        cropper.zoom(0.1);
    })

    $('#zoomout_btn').on('click', function(){
        cropper.zoom(-0.1);
    })

    $('#rc_btn').on('click', function () {
        cropper.rotate(90)
    })

    $('#rcc_btn').on('click', function () {
        cropper.rotate(-90)
    })

    $('#flip_horizontal_btn').on('click', function(){
        var horizital_status = ''
        console.log(is_flip_horizontal);
        if(!is_flip_horizontal){
            cropper.scale(-1, 1)
            horizital_status = true
        } else {
            cropper.scale(1, 1)
            horizital_status = false
        }
        is_flip_horizontal = horizital_status
    })

    $('#flip_vertical_btn').on('click', function (){
        var vertical_status = ''
        if(!is_flip_vertical){
            cropper.scale(1, 1)
            vertical_status = true
        } else {
            cropper.scale(1, -1)
            vertical_status = false
        }
        is_flip_vertical = vertical_status
    })

    $('#clear_btn').on('click', function () {
        cropper.clear()
    })

    $('#crop_btn').on('click', function () {
      $('#result').html('')
      $('#result').append(cropper.getCroppedCanvas())
    })

    $('#download_crop_btn').on('click', function () {
        cropper.getCroppedCanvas().toBlob((blob) => {
            var file   = new File([blob], {type: "image/png", lastModified: new Date()})
            var a      = document.createElement('a')
            a.id       = 'temp_link'
            a.href     = window.URL.createObjectURL(file)
            a.download = 'crop.png'
            a.click()
            $('#temp_link').remove()
        })
    })

    $('#select_crop_btn').on('click', function () {
        // $('#crop_div').css('display', 'block')
        // $('#crop_div').html('')
        // $('#crop_div').append(cropper.getCroppedCanvas({minWidth: 256, minHeight: 256,maxWidth: 500,maxHeight: 500,}))
        // $('#image_div').css('display', 'none')
        // set_display('donecrop', 'block')
        // set_display('crop', 'none')

        var base64 = cropper.getCroppedCanvas().toDataURL()
        $('#photodata').val(base64)
        $('#crop_form').submit()
    })

    $('#cancel_btn').on('click', function () {
        $('#image_div').css('display', 'block')
        // $('#crop_div').html('')
        $('#crop_div').css('display', 'none')
        set_display('donecrop', 'none')
        set_display('crop', 'block')
    })

    $('#selected_btn').on('click', function () {
        var canvas = $('#crop_div').find('canvas')
        var this_canvas = $(canvas)
        var base64 = this_canvas[0].toDataURL()
        $('#photodata').val(base64)

        $('#crop_form').submit()
        // console.log(base64);
    })

    function set_display(when, status){
        if(when == 'crop'){
            $('#clear_btn').css('display', status)
            $('#select_crop_btn').css('display', status)
            $('#download_crop_btn').css('display', status)
        } else if(when == 'donecrop') {
            $('#cancel_btn').css('display', status)
            $('#selected_btn').css('display', status)
        }
    }

  </script>
</body>
</html>
