@extends('layouts.layoutsManagePhoto')

@section('title', 'EndoINDEX')
@section('style')
    <link href="{{ url('public/extra/esign/colorpicker.css') }}" rel="stylesheet">
    <link href="{{ url('public/extra/esign/literally.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <style type="text/css">
        body {

            margin: 0;
            overflow: hidden;
        }
        /* .fs-container {
            width: 100%;
            height: 100%;
            margin: auto;
        } */
        .literally {
            width: 800px;
            height: 40vh;
        }
        #canvas{
            width: 1500px;
            height: 600px;
        }
        .toolbar{
            display:none;
        }
        .middle{
            margin-top: 5em !important;

        }
        .b-none{
            border: 0px ;
        }

        #preview_div {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            /* height: 300px;  */
            border: 2px dashed #ccc;
            overflow: hidden;
        }

        #preview_div img {
            max-width: 100%;
            max-height: 100%;
            object-fit: cover;
        }
    </style>
@endsection

@section('modal')

    <!-- Default Modals -->






<div class="modal fade" id="signed_modal"tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Signature</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        @if (isset($signed_data))
                            <img style="width: 100%" src="{{@$signed_data}}" alt="">
                        @else
                            <p>ไม่มีข้อมูลลายเซ็นในระบบ</p>
                        @endif
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                {{-- <button type="button" class="btn btn-primary ">Save Changes</button> --}}
            </div>
        </div>
    </div>
</div>

<div id="upload_modal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Upload Signature</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12"><img src="" class="img-fluid mb-3" id="signed_img" ></div>
                    <div class="col-12"><button id="upload_dummy_btn" class="btn btn-info" style="width:100%">Upload</button></div>
                    <div class="col-12"><button id="clear_upload_btn" class="btn btn-danger mt-3" style="width:100%">Clear</button></div>
                </div>
            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            </div> --}}
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row middle">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <form action="{{url("esign")}}" method="POST" enctype="multipart/form-data" id="edit_form" onsubmit="return validateForm()">
                <div class="row mb-3 p-4">
                    <div class="col-6">
                        <span class="h2 text-primary">{{@$user->user_prefix}} {{@$user->user_firstname}}&nbsp;&nbsp;{{@$user->user_lastname}}</span>
                    </div>
                    <div class="col-6 text-end">
                            @csrf
                            <input type="hidden" name="event" value="save_sign">
                            <input type="hidden" name="userID" value="{{@$userID}}">
                            <input type="hidden" name="caseid" value="{{@$cid}}">
                            <input type="hidden" name="usercode" id="usercode">
                            @isset($from)
                                <input type="hidden" name="from" value="{{@$from}}">
                            @endisset
                            <a href="{{ url('reportendocapture') }}/{{ $cid }}"
                            class="btn btn-danger btn-load btn-label waves-effect right w-lg waves-light"><i
                                class="ri-file-list-2-line label-icon align-middle fs-16 ms-2"></i> Back</a>
                            <button type="submit" id="submit_btn"
                            class="btn btn-primary btn-loading btn-label waves-effect right w-lg waves-light">
                            <i class="ri-check-double-line label-icon align-middle fs-16 ms-2"></i> Confirm</button>

                        </div>

                        {{-- <div class="col-2"><button type="button" id="clear_canvas" class="btn btn-danger">Clear Drawing</button></div> --}}
                        <div class="col-12 my-2 mt-4 fw-bold">
                            Create ID
                        </div>
                        <div class="col-4 ">
                            <input type="hidden" class="form-control bg-light" id="user_code" name="user_code" value="{{@$user->user_code}}">
                            <textarea name="user_code_dataurl" id="user_code_dataurl" cols="30" rows="10" hidden></textarea>
                            <input type="text" name="user_code_esign" id="user_code_esign" class="form-control b-none" placeholder="Enter ID..." value="{{@$user->user_code}}">
                        </div>
                    </div>

                </form>
                <div class="row">
                    <ul class="nav nav-tabs nav-justified nav-border-top nav-border-top-success mb-3" role="tablist">
                        <li class="nav-item ">
                            <a class="nav-link active" data-bs-toggle="tab" href="#nav-border-sign" role="tab" aria-selected="false">
                                <i class="ri-ball-pen-fill align-middle me-1"></i> Sign
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#nav-border-upload" role="tab" aria-selected="false">
                                <i class="ri-upload-2-line me-1 align-middle"></i> Upload
                            </a>
                        </li>

                    </ul>
                    <div class="tab-content text-muted">
                        <div class="tab-pane active" id="nav-border-sign" role="tabpanel">
                            <div class="fs-container" >
                                <div class="literally">
                                    <canvas id="canvas"></canvas>
                                </div>
                            </div>
                            <div class="row mb-2 justify-content-center">
                                <div class="col-4 text-center">
                                    <button class="btn btn-dark w-50  py-3" id="clear_canvas">Clear E-Signature</button>
                                    {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-target="#signed_modal">Signed</button>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-target="#upload_modal">Upload</button> --}}
                                </div>
                           </div>
                        </div>
                        <div class="tab-pane mb-5 pb-1" id="nav-border-upload" role="tabpanel">
                            <input type="file" name="" id="upload_esign" accept=".jpg, .jpeg, .png" onchange="previewFile()"  hidden>

                            <div class="row">
                                <div class="col-6">
                                    <div class="box dotted" id="upload_div" id="drop_zone" style="cursor: pointer;"
                                        onclick="open_file_input()" ondrop="dropHandler(event);"
                                        ondragover="dragOverHandler(event);">
                                        <p class="btn text-center text-dark pos-text">Drag & Drop your files or Browse </p>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="box dotted" id="preview_div">
                                    <p class="btn text-center text-dark pos-text">Preview </p>
                                </div>
                                </div>
                            </div>
                            <br>
                            <div class="row mt-2 mb-2 justify-content-center">
                                <div class="col-4 text-center">
                                    <button class="btn btn-dark w-50  py-3" id="clear_file">Clear</button>
                                </div>
                           </div>
                        </div>

                    </div>

                    <div class="col-12">
                        <form action="{{url("esign")}}" method="POST" enctype="multipart/form-data" id="edit_form" onsubmit="return validateForm()">
                            @csrf
                            <input type="hidden" name="event" value="save_sign">
                            <input type="hidden" name="userID" value="{{@$userID}}">
                            <input type="hidden" name="caseid" value="{{@$cid}}">
                            @isset($from)
                                <input type="hidden" name="from" value="{{@$from}}">
                            @endisset
                            {{-- <div class="row mb-2 justify-content-center">
                                <div class="col-4 text-center">
                                    <button class="btn btn-dark w-50  py-3">Clear E-Signature</button>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#signed_modal">Signed</button>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#upload_modal">Upload</button>
                                </div>

                           </div> --}}

                            <input class="form-control input-pos mb-3" id="signed_img_inp" name="user_sign_upload" type="file" accept="image/*" onchange="loadFile(event, 'signed_img')" style="display:block" hidden>
                            {{-- <input type="text" name="user_code" class="form-control" placeholder="พิมพ์รหัส 5 ตัวอักษร"> --}}
                            {{-- <br> --}}
                            {{-- <button id="submit_btn" class="btn btn-primary btn-block" type="submit">บันทึก</button> --}}
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
<script src="{{asset('public/js/sweetalert2@11.js')}}"></script>
<script src="{{ url('public/extra/esign/literallycanvas.fat.js') }}"></script>
<script type="text/javascript">

        // $(window).on('load', function() {
        //         $('#upload_modal').modal('show');
        //     });



    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var literally_obj;

    $(document).ready(function() {
        literally_obj = $('.literally').literallycanvas();
        $('.toolbar').css('display', 'none')
    });

    function updateDataURL() {
        let canvas = document.getElementById('canvas');
        let dataURL = canvas.toDataURL();
        $('#user_code_dataurl').val(dataURL);
    }

    $('#canvas').on('mouseup touchend', function() {
        updateDataURL()
    });

    $('#upload_dummy_btn').on('click', function () {
        $('#signed_img_inp').click()
    })

    $('#clear_upload_btn').on('click', function () {
        removeFileFromFileList(0, 'signed_img_inp')
        $('#signed_img').attr('src', '')
    })

    $('#clear_canvas').on('click', function () {
        literally_obj = $('.literally').literallycanvas();
    })

    var loadFile = function(event, img_id) {
        var output = document.getElementById(img_id);
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }
    };

    function open_file_input() {
        $("#upload_esign").trigger("click");
    }

    function dropHandler(event) {
        event.preventDefault()
        if(event.dataTransfer.items){
            if(event.DataTransfer.items[0].kind === 'file'){
                let file = event.dataTransfer.items[0].getAsFile()
                handleFile(file)
            }
        } else {
            handleFile(event.dataTransfer.files[0])
        }
    }

    function previewFile() {
        let file = document.getElementById('upload_esign').files[0]
        handleFile(file)
    }

    function handleFile(file) {
        let validExt = ['image/jpeg', 'image/png', 'image/jpg']
        if(validExt.includes(file.type)){
            let reader = new FileReader()
            reader.onload = function (e) {
                $('#preview_div').html('<img src="' + e.target.result + '" alt="Preview" style="max-width: 100%; max-height: 100%;">')
                $('#user_code_dataurl').val(e.target.result);
            }
            reader.readAsDataURL(file)
        } else{
            Swal.fire('Only JPG, JPEG, and PNG files are allowed.')
        }
    }

    $('#clear_file').on('click', function(e) {
        e.preventDefault();
        $('#upload_esign').val('');
        $('#preview_div').html('<p class="btn text-center text-dark pos-text">Preview</p>');
        $('#user_code_dataurl').val('');
    });

    $('#user_code_esign').on('input', function () {
        let elem = $(this)
        check_doctorcode(elem)
    })

    function validateForm() {
        // var user_code = $('#user_code').val()
        var user_code_esign = $('#user_code_esign').val()
        let dataurl = $('#user_code_dataurl').val()
        var check_file_inp = $('#signed_img_inp').get(0).files.length
        let check = true
        // Check if user_code_esign is empty
        if (user_code_esign === '') {
            Swal.fire('Please enter doctor code');
            return false;
        }
        // Check if dataurl is empty
        if (dataurl === '') {
            Swal.fire('Please upload or draw the signature image');
            return false;
        }
        $('#usercode').val(user_code_esign)
        return check_doctorcode($('#user_code_esign'));
    }

    function check_doctorcode(elem){
        $.post('{{url("api/esign")}}', {
            event:"check_doctorcode",
            code: elem.val(),
            id: '{{@$userID}}'
        }, function (data, status){
            console.log(data);
            if(data == "duplicate"){
                Swal.fire('This doctor code is already in the system.')
                elem.val('')
                return false
            } else {
                return true
            }
        })
    }

    function removeFileFromFileList(index, inp_file_id) {
        const dt = new DataTransfer()
        const input = document.getElementById(inp_file_id)
        const { files } = input

        for (let i = 0; i < files.length; i++) {
            const file = files[i]
            if (index !== i)
            dt.items.add(file)
        }

        input.files = dt.files
    }
    $(".btn-load").click(function(){
        $(this).addClass('disabled');
        $(this).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> &ensp; Loading...');
        setTimeout(() => {
            $(this).removeClass('disabled');
            $(this).html('<i class="ri-check-double-line label-icon align-middle fs-16 ms-2"></i> Confirm');
        }, 3000);
});
$(".btn-loading").click(function(){
    if ($(this).closest('form')[0].checkValidity()) {
        $(this).addClass('disabled');
        $(this).html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> &ensp; Loading...');
        setTimeout(() => {
            $(this).removeClass('disabled');
        }, 3000);
    }
});

</script>






@endsection
