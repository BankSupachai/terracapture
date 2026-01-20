<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Camera Capture Video</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link href="{{ url('public/cropnew/cropper.css') }}" rel="stylesheet" />
    <style>
        body {
            background-color: #1F1F1F;
            color: #ffffff;
        }

        .card {
            background-color: #2D2D2D;
            border: 1px solid #3D3D3D;
        }

        .btn-incard{
            background: #EFF2F7;
            color: #192D4BCC;
        }
        .btn-incard:hover{
            background: #cfd3d8;
            color: #192D4BCC;
        }
        #pic_list {
            height: 75.5vh;
            overflow-y: scroll;
        }

        /* width */
        ::-webkit-scrollbar {
            width: 5px;
        }

        ::-webkit-scrollbar-track {
            background: #1F1F1F;
        }

        ::-webkit-scrollbar-thumb {
            background: #3D3D3D;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #4D4D4D;
        }
        .w-95{
            width: 95%;
        }

        #sidebarCol {
            position: fixed;
            right: 0;
            top: 0;
            height: 100vh;
            z-index: 99;
            background: white;
            transition: transform 0.3s ease-in-out;
        }

        #sidebarCol.d-none {
            transform: translateX(100%);
        }

        #sidebarCol .card {
            height: 100%;
            border-radius: 0;
            border-left: 1px solid rgba(0,0,0,0.125);
        }

        .btn {
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #2843cc !important;
            border-color: #2843cc !important;
        }

        .sidebar-toggle {
            width: 30px;
            height: 60px;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #292828;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            z-index: 10;
            position: fixed;
            right: 16.5%;
            top: 50%;
            transform: translateY(-50%);
            transition: right 0.3s ease-in-out;
        }

        #sidebarCol.d-none + .sidebar-toggle {
            right: 0;
        }

        .sidebar-toggle:hover {
            background-color: #3D3D3D !important;
        }

        .sidebar-toggle i {
            font-size: 20px;
        }

        .cropper-container {
            max-width: 100% !important;
            min-width: auto !important;
        }

        .row {
            margin-right: 0 !important;
            margin-left: 0 !important;
        }

        .container-fluid {
            padding-right: 0 !important;
            padding-left: 0 !important;
        }

        #mainContent {
            padding-right: 0 !important;
            padding-left: 0 !important;
        }

        .card-body {
            padding: 1rem !important;
        }

        .cropper-point {
            height: 15px !important;
            width: 15px !important;
        }

        .btn-edit-photo {
            background: #F3F6F9;
            color: #192D4B;
            border-radius: 4px;
            width: 60px;
            height: 60px;
            box-shadow: 1px 1px 1px 1px #00000040;
        }

        .btn-edit-photo:hover {
            background: #192D4B;
            color: #F3F6F9;
        }

        .btn-clicked {
            background: #192D4B;
            color: #F3F6F9;
        }

        .video-container {
            position: relative;
            overflow: hidden;
        }

        .video-container:hover::after {
            content: 'Preview';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 14px;
            pointer-events: none;
            z-index: 1000;
        }

        .cropper-container {
            position: absolute !important;
            top: 0 !important;
            left: 0 !important;
            width: 100% !important;
            height: 100% !important;
            z-index: 1;
        }

        .cropper-container canvas {
            max-width: 100% !important;
            max-height: 100% !important;
        }

        /* Image Modal Styles */
        .image-modal {

            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9);
        }

        .modal-content {
            margin: auto;
            display: block;
            max-width: 90%;
            max-height: 90vh;
            object-fit: contain;
        }

        .close-modal {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
            cursor: pointer;
        }

        .close-modal:hover {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }

        .imgnew {
            cursor: pointer;
            transition: 0.3s;
        }

        .imgnew:hover {
            opacity: 0.7;
        }
        #videoProgress {
            -webkit-appearance: none;
            width: 100%;
            height: 47px;
            background: transparent;
            outline: none;
            margin: 0;
            padding: 0;

        }
        #videoProgress::-moz-range-track {
            background-color: #EAEAEA33;
            height: 48px;
            border-radius: 4px;
        }
        #videoProgress::-moz-range-progress {
            background-color: red;
            height: 48px;
            border-radius: 4px;
        }
        #videoProgress::-webkit-slider-runnable-track {
            background-color: #eaeaea00;
            height: 48px;
            border-radius: 4px;
            z-index: 100;
        }
        #videoProgress::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 2px;
            height: 50px;
            background-color: #ffffff;
            border-radius: 10%;
            cursor: pointer;
            margin-top: -2px;
        }

        .btn-success:hover {
            background-color: #00cc00;
            border-color: #00cc00;
        }

        /* Flash effect styles */
        .flash-effect {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1000;
        }

        .flash-effect::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border: 12px solid white;
            opacity: 0;
        }

        @keyframes flash {
            0% { opacity: 0; }
            10% { opacity: 1; }
            20% { opacity: 0; }
            100% { opacity: 0; }
        }

        .flash::before {
            animation: flash 0.3s ease-out;
        }

        /* Add transition for video */
        #video {
            transition: transform 0.3s ease-out;
        }

        /* Add transition for video container */
        .vdeo-container {
            transition: transform 0.3s ease-out;
        }

        /* Thumbnail preview for progress bar */
        /* #thumbnailPreview {
            display: none;
            position: absolute;
            z-index: 2000;
            pointer-events: none;
            border: 2px solid #fff;
            border-radius: 6px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.5);
            background: #222;
            width: 160px;
            height: 90px;
            overflow: hidden;
            z-index: 10;
        }
        #thumbnailPreview img {
            width: 100%;
            height: 100%;
            object-fit: contain;
            z-index: 10;
        } */

        /* Filmstrip thumbnails */
        #filmstrip {
            position: absolute;
            left: 0; right: 0;
            top: 0;
            height: 48px;
            pointer-events: none;
            display: flex;
            align-items: center;
            justify-content: space-between;
            z-index: 10;
        }
        #filmstrip img {
            width: 75px;
            height: 48px;
            border-radius: 20%;
        }
    </style>
</head>
<body>

    <!-- Add Image Modal -->
    <div id="imageModal" class="image-modal">
        <span class="close-modal">&times;</span>
        <img class="modal-content" id="modalImage">
    </div>

    <div class="row m-0">
        <div class="col-lg-12" id="mainContent">
            <div class="card">
                {{-- <div class="card-body">
                    <div class="col-12" >
                        <h3>
                            Patient ID : {{ @$case->hn }}
                        </h3>
                    </div>

                    <div class="row fs-16 align-items-center">
                        <div class="col-3">
                            <span>
                                Name : {{ @$case->patientname }} ({{ @$case->age }} y)
                            </span>
                        </div>
                        <div class="col-3">
                            Procedure : {{ @$case->procedurename }}
                        </div>
                        <div class="col-3">
                            Procedure : {{ @$case->doctorname }}
                        </div>
                        <div class="col-3">
                            <a href="{{ url("capture/loadpic/$id") }}" class="btn btn-success w-100">Submit</a>
                        </div>
                    </div>
                </div> --}}
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="vdeo-container" style="position: relative;">
                        <div class="card-body p-4" style="height: 860px;">
                            @if (isset(getCONFIG('admin')->comname) && getCONFIG('admin')->comname == 'endocapture')
                                <video id="video" src="{{ $vdo_url }}" loop style="width:100%; height:100%"></video>
                            @else
                                <video id="video" src="{{ $vdo_url }}" loop style="width:100%; height:100%"></video>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="row " style="margin-left:100px;">
                    <div class="col-10 " style="position: relative;">
                        <input type="range" class="form-range" id="videoProgress" value="0">
                        <div id="filmstrip" style="z-index: 10;"></div>
                        <div id="thumbnailPreview"><img id="thumbnailImg" src=""></div>
                    </div>
                    <div class="col-2  text-light" style="font-size: 18px; ">
                        <span id="currentTime" style="color: #EFF2F7;">0:00</span> <span style="color: #EFF2F7;"> / </span>
                        <span id="duration" style="color: #EFF2F7;">0:00</span>

                    </div>
                </div>
                <div class="col-12">

                    <div class="">
                        <div class="" style="margin-left: 180px;">
                            <div class="d-flex justify-content-center align-items-center gap-2">
                                <button class="btn"  onclick="skip(-5)">
                                    <i style="color: #ffffff;" class="ri-skip-back-fill"></i>
                                    <br><span style="font-size: 11px; color: #ffffff;">5 Sec</span>
                                </button>
                                <button class="btn" onclick="skip(-0.25)">
                                    <i style="color: #ffffff;" class="ri-rewind-fill"></i>
                                    <br><span style="font-size: 11px; color: #ffffff;">0.25 Sec</span>
                                </button>
                                <button class="btn" onclick="playPause()" id="playPauseBtn">
                                    <i style="color: #ffffff;" class="ri-play-fill toggle_icon" id="toggleIcon"></i>
                                    <br><span style="font-size: 11px; color: #ffffff;">Play/Pause</span>
                                </button>
                                <script>
                                    document.addEventListener('keydown', function(event) {
                                        if (event.code === 'Space') {
                                            event.preventDefault();
                                            document.getElementById('playPauseBtn').click();
                                        }
                                    });
                                </script>
                                <button id="button" class="btn ">
                                    <i style="color: #ffffff;" class="ri-camera-fill"></i>
                                    <br><span style="font-size: 11px; color: #ffffff;">Capture</span>
                                </button>
                                <button class="btn" onclick="skip(0.25)">
                                    <i style="color: #ffffff;" class="ri-speed-fill"></i>
                                    <br><span style="font-size: 11px; color: #ffffff;">0.25 Sec</span>
                                </button>
                                <button class="btn" onclick="skip(5)">
                                    <i style="color: #ffffff;" class="ri-skip-forward-fill"></i>
                                    <br><span style="font-size: 11px; color: #ffffff;">5 Sec</span>
                                </button>

                                <button class="btn" id="montage_btn">
                                    <i style="color: #ffffff;" class="ri-grid-fill"></i>
                                    <br><span style="font-size: 11px; color: #ffffff;">Montage</span>
                                </button>

                                <button class="btn" id="montage_cancel_btn" style="display: none;">
                                    <i style="color: #ff0000;" class="ri-close-circle-fill"></i>
                                    <br><span style="font-size: 11px; color: #ff0000;">Cancel</span>
                                </button>

                                <button class="btn" id="crop_btn">
                                    <i style="color: #ffffff;" class="ri-crop-line"></i>
                                    <br><span style="font-size: 11px; color: #ffffff;">Crop</span>
                                </button>




                                <div class="col-1">
                                    <a style="margin-left: 450px;" href="{{ url("capture/loadpic/$id") }}" class="btn btn-primary w-100">Finish</a>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <div class="card">
                <div class="card-body">
                    <div class="row ">
                        <div class="col-auto align-self-center">
                            Progress (%)
                        </div>
                        <div class="col-6 align-self-center">
                           <div class="progress">
                                <div id="progress_vdo" class="progress-bar" role="progressbar" style="width: 0%;"
                                    aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                    <div id="progress_text">0</div>%
                                </div>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <button id="convert_btn" onclick="get_progress()" class="btn btn-danger">Change Size</button>
                            <a download href="{{ $vdo_url }}" class="btn btn-primary">Download</a>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
        <div class="col-lg-2 d-none" style="background-color:#1F1F1F;" id="sidebarCol">
            <div class="card">
                <div class="card-body p-4" data-spy="scroll">
                    <div id="pic_list"></div>
                </div>
            </div>
        </div>
        <button class="btn sidebar-toggle" onclick="toggleSidebar()">
            <i class="ri-arrow-left-s-line" id="sidebarToggleIcon"></i>
        </button>
    </div>
    <div style="display: none">
        <canvas id="canvas"></canvas>
    </div>

    <input type="hidden" name="" id="path_img" value="{{ url('../ScreenRecord') }}">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ url('assets/extra/shortcuts/shortcut.js') }}"></script>
    <script src="{{ url('public/cropnew/cropper.min.js') }}"></script>
    <script src="{{ url('public/cropnew/cropper.min.js') }}"></script>
    <script src="{{ domainnameport(':3000/socket.io/socket.io.js') }}"></script>
<script>
var socket = io.connect("{{ domainnameport(':3000') }}");
        socket.on('chat message', function(msg) {
            if (msg != '' && msg != undefined) {
                if (msg == 1 || msg == '1') {
                    document.getElementById('button').click();

                    // var source_num = $('#camera_2').val();
                    // if (source_num == 1 || source_num == '1' || source_num == undefined) {
                    //     $("#btn-capture").trigger("click");
                    // } else if (source_num == 2 || source_num == '2') {
                    //     $("#btn-capture").trigger("click");
                    //     $("#btn-capture2").trigger("click");
                    // }
                }
            }
        });


</script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var myVideo = document.getElementById("video");
        var toggleIcon = document.getElementById("toggleIcon");
        let isCropping = false;
        let cropper = null;
        let currentCropData = null;
        let montageInterval = null;
        let montageCount = 0;
        const MONTAGE_TOTAL = 10;
        const MONTAGE_INTERVAL = 0.1; // seconds
        let isMontageCropping = false;
        let montageCropper = null;
        let montageCropData = null;
        let montageImages = []; // Array to store captured images

        function playPause() {
            if (myVideo.paused) {
                myVideo.play();
                toggleIcon.classList.remove("ri-play-fill");
                toggleIcon.classList.add("ri-pause-fill");
            } else {
                myVideo.pause();
                toggleIcon.classList.remove("ri-pause-fill");
                toggleIcon.classList.add("ri-play-fill");
            }
        }

        function skip(value) {
            var video = document.getElementById("video");
            video.currentTime += value;
        }

        const input = document.getElementById('file-input')
        const video = document.getElementById('video')
        const videoSource = document.createElement('source')
        const button = document.getElementById('button')
        const canvas = document.getElementById('canvas')
        const txtInp = document.getElementById('imageData')
        const cropBtn = document.getElementById('crop_btn')
        const resetCropBtn = document.getElementById('reset_crop_btn')

        var path_img = $("#path_img").val();


        cropBtn.addEventListener('click', () => {
            if (!isCropping) {

                isCropping = true;
                video.style.display = 'none';


                const cropperContainer = document.createElement('div');
                cropperContainer.style.position = 'absolute';
                cropperContainer.style.top = '0';
                cropperContainer.style.left = '0';
                cropperContainer.style.width = '100%';
                cropperContainer.style.height = '100%';
                cropperContainer.style.display = 'block';
                cropperContainer.style.zIndex = '1';
                video.parentElement.appendChild(cropperContainer);


                const canvas = document.createElement('canvas');
                canvas.style.width = '100%';
                canvas.style.height = '100%';
                cropperContainer.appendChild(canvas);


                const ctx = canvas.getContext('2d');
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                ctx.drawImage(video, 0, 0, canvas.width, canvas.height);


                cropper = new Cropper(canvas, {
                    aspectRatio: NaN,
                    viewMode: 1,
                    autoCropArea: 1,
                    responsive: true,
                    restore: false,
                    modal: false,
                    guides: true,
                    highlight: true,
                    cropBoxMovable: true,
                    cropBoxResizable: true,
                    toggleDragModeOnDblclick: false,
                    ready: function() {
                        const containerData = this.cropper.getContainerData();
                        this.cropper.setCropBoxData({
                            width: containerData.width * 0.8,
                            height: containerData.height * 0.8,
                            left: containerData.width * 0.1,
                            top: containerData.height * 0.1
                        });
                    },
                    crop: function(event) {
                        currentCropData = event.detail;
                    }
                });

                video.pause();
                if (toggleIcon) {
                    toggleIcon.classList.remove("ri-pause-fill");
                    toggleIcon.classList.add("ri-play-fill");
                }
                cropBtn.classList.add('btn-clicked');
            } else {

                if (cropper) {
                    cropper.destroy();
                    cropper = null;
                }
                const cropperContainer = video.parentElement.querySelector('div[style*="position: absolute"]');
                if (cropperContainer) {
                    cropperContainer.remove();
                }
                video.style.display = 'block';
                isCropping = false;
                cropBtn.classList.remove('btn-clicked');
                currentCropData = null; // Clear crop data

                video.style.objectFit = 'contain';
                video.style.width = '100%';
                video.style.height = '100%';
            }
        });

        $('#button').click(function() {

            const flash = document.createElement('div');
            flash.className = 'flash-effect';
            const videoContainer = document.querySelector('.vdeo-container');
            videoContainer.appendChild(flash);
            flash.classList.add('flash');

            const video = document.getElementById('video');
            video.style.transform = 'scale(1.05)';
            setTimeout(() => {
                video.style.transform = 'scale(1)';
            }, 150);

            setTimeout(() => {
                flash.remove();
            }, 300);

            const canvas = document.getElementById('canvas');
            const ctx = canvas.getContext('2d');

            if (currentCropData) {
                const sourceX = currentCropData.x;
                const sourceY = currentCropData.y;
                const sourceWidth = currentCropData.width;
                const sourceHeight = currentCropData.height;

                canvas.width = sourceWidth;
                canvas.height = sourceHeight;

                ctx.drawImage(
                    video,
                    sourceX, sourceY,
                    sourceWidth, sourceHeight,
                    0, 0,
                    sourceWidth, sourceHeight   // Destination Width, Height (size on canvas)
                );
            } else {
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
            }

            var dataURL = canvas.toDataURL('image/png');

            $.post('{{ url('camera') }}', {
                event: 'takephoto',
                datapic: dataURL,
                scope: "vdo",
                hn: '{{ $case->case_hn }}',
                case_id: "{{ $id }}"
            }, function(data, status) {
                var json_name = JSON.parse(data);
                var numtext = $("#num_img").text();
                $("#num_img").text(parseInt(numtext) + 1);
                var number = $("#num_img").text();
                $("#pic_list").prepend("<img src='" + path_img + "/" + json_name.picname + "' class='imgnew w-95'><br><br><div class='count_img'>" + number + "</div>");
            });
        });

        var progress = 0

        function get_progress() {
            $.post("{{ url('cameracapvdo') }}", {
                    event: 'change_bitrate',
                    vdo_input: "{{ $pathORI }}",
                    vdo_output: "{{ $pathCOPY }}"
                },
                function(data, status) {});

            var intervalID = setInterval(() => {
                $('#interval_text').html('in')
                if (progress < 100) {
                    read_progress_text($('#videoin_path').val())
                } else {
                    clearInterval(intervalID)
                    $('#interval_text').html('out')
                }
            }, 1000);
        }

        function read_progress_text(file_input, text) {
            $.post("{{ url('cameracapvdo') }}", {
                    event: 'get_progress',
                    vdo_input: "{{ $pathORI }}",
                },
                function(data, status) {
                    $("#progress_vdo").attr("style", "width: " + data + "%")
                    $("#progress_vdo").attr("aria-valuenow", data)
                    $('#progress_text').html(data)
                    if (data == 100) {
                        window.location.replace("{{ url()->full() }}&renameVDO=true");
                    }
                })
        }

        function toggleSidebar() {
            const toggleIcon = document.getElementById('sidebarToggleIcon');
            const mainContent = document.getElementById('mainContent');
            const sidebarCol = document.getElementById('sidebarCol');
            const confirmButton = document.querySelector('a.btn-success');

            if (sidebarCol.classList.contains('d-none')) {
                // Expanding
                sidebarCol.classList.remove('d-none');
                mainContent.classList.remove('col-lg-12');
                mainContent.classList.add('col-lg-10');
                toggleIcon.classList.remove('ri-arrow-left-s-line');
                toggleIcon.classList.add('ri-arrow-right-s-line');
                confirmButton.style.marginLeft = '300px';
            } else {
                sidebarCol.classList.add('d-none');
                mainContent.classList.remove('col-lg-10');
                mainContent.classList.add('col-lg-12');
                toggleIcon.classList.remove('ri-arrow-right-s-line');
                toggleIcon.classList.add('ri-arrow-left-s-line');
                confirmButton.style.marginLeft = '450px';
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const sidebarCol = document.getElementById('sidebarCol');
            if (!sidebarCol.classList.contains('d-none')) {
                document.querySelector('.col-lg-10').classList.remove('col-lg-12');
            }
        });

        function startMontage() {
            if (montageInterval) {
                clearInterval(montageInterval);
                montageInterval = null;
                montageCount = 0;
                montageImages = [];
                return;
            }

            if (!isMontageCropping) {
                isMontageCropping = true;
                video.style.display = 'none';
                document.getElementById('montage_cancel_btn').style.display = 'block';

                const montageBtn = document.getElementById('montage_btn');
                montageBtn.innerHTML = '<i style="color: #00ff00;" class="ri-check-line"></i><br><span style="font-size: 11px; color: #00ff00;">Confirm</span>';

                const cropperContainer = document.createElement('div');
                cropperContainer.style.position = 'absolute';
                cropperContainer.style.top = '0';
                cropperContainer.style.left = '0';
                cropperContainer.style.width = '100%';
                cropperContainer.style.height = '100%';
                cropperContainer.style.display = 'block';
                cropperContainer.style.zIndex = '1';
                video.parentElement.appendChild(cropperContainer);

                const canvas = document.createElement('canvas');
                canvas.style.width = '100%';
                canvas.style.height = '100%';
                cropperContainer.appendChild(canvas);

                const ctx = canvas.getContext('2d');
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                ctx.drawImage(video, 0, 0, canvas.width, canvas.height);

                montageCropper = new Cropper(canvas, {
                    aspectRatio: 384/540,
                    viewMode: 1,
                    autoCropArea: 1,
                    responsive: true,
                    restore: false,
                    modal: false,
                    guides: true,
                    highlight: true,
                    cropBoxMovable: true,
                    cropBoxResizable: true,
                    toggleDragModeOnDblclick: false,
                    ready: function() {
                        const containerData = this.cropper.getContainerData();
                        this.cropper.setCropBoxData({
                            width: 384,
                            height: 540,
                            left: (containerData.width - 384) / 2,
                            top: (containerData.height - 540) / 2
                        });
                    },
                    crop: function(event) {
                        montageCropData = event.detail;
                    }
                });

                video.pause();
                if (toggleIcon) {
                    toggleIcon.classList.remove("ri-pause-fill");
                    toggleIcon.classList.add("ri-play-fill");
                }
            } else {
                if (montageCropper) {
                    montageCropData = montageCropper.getData();
                    montageCropper.destroy();
                    montageCropper = null;
                }
                const cropperContainer = video.parentElement.querySelector('div[style*="position: absolute"]');
                if (cropperContainer) {
                    cropperContainer.remove();
                }
                video.style.display = 'block';
                isMontageCropping = false;

                const montageBtn = document.getElementById('montage_btn');
                montageBtn.innerHTML = '<i style="color: #ffffff;" class="ri-grid-fill"></i><br><span style="font-size: 11px; color: #ffffff;">Montage</span>';
                document.getElementById('montage_cancel_btn').style.display = 'none';

                montageCount = 0;
                montageImages = [];
                captureMontageImage();

                montageInterval = setInterval(() => {
                    if (montageCount < MONTAGE_TOTAL) {
                        captureMontageImage();
                    } else {
                        clearInterval(montageInterval);
                        montageInterval = null;
                        combineMontageImages();
                        montageCount = 0;
                        montageCropData = null;
                    }
                }, 500);
            }
        }

        function captureMontageImage() {
            if (montageCount >= MONTAGE_TOTAL) {
                return;
            }

            const video = document.getElementById('video');
            const canvas = document.createElement('canvas');
            const ctx = canvas.getContext('2d');

            if (montageCropData) {
                const sourceX = montageCropData.x;
                const sourceY = montageCropData.y;
                const sourceWidth = montageCropData.width;
                const sourceHeight = montageCropData.height;

                canvas.width = sourceWidth;
                canvas.height = sourceHeight;

                ctx.drawImage(
                    video,
                    sourceX, sourceY,
                    sourceWidth, sourceHeight,
                    0, 0,
                    sourceWidth, sourceHeight
                );
            } else {
                canvas.width = video.videoWidth;
                canvas.height = video.videoHeight;
                ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
            }

            montageImages.push(canvas.toDataURL('image/png'));

            montageCount++;

            if (montageCount < MONTAGE_TOTAL) {
                video.currentTime += MONTAGE_INTERVAL;
            }
        }

        function combineMontageImages() {
            const combinedCanvas = document.createElement('canvas');
            const ctx = combinedCanvas.getContext('2d');

            const cols = 5;
            const rows = 2;
            const imgWidth = 384;
            const imgHeight = 540;
            const padding = 10;

            combinedCanvas.width = (imgWidth * cols) + (padding * (cols + 1));
            combinedCanvas.height = (imgHeight * rows) + (padding * (rows + 1));


            const loadedImages = [];
            let imagesLoaded = 0;

            function checkAllImagesLoaded() {
                if (imagesLoaded === montageImages.length) {
                    for (let i = 0; i < loadedImages.length; i++) {
                        const col = i % cols;
                        const row = Math.floor(i / cols);
                        const x = padding + (col * (imgWidth + padding));
                        const y = padding + (row * (imgHeight + padding));
                        ctx.drawImage(loadedImages[i], x, y, imgWidth, imgHeight);
                    }

                    const dataURL = combinedCanvas.toDataURL('image/png');

                    $.post('{{ url('camera') }}', {
                        event: 'takephoto',
                        datapic: dataURL,
                        scope: "vdo",
                        hn: '{{ $case->case_hn }}',
                        case_id: "{{ $id }}"
                    }, function(data, status) {
                        var json_name = JSON.parse(data);
                        var numtext = $("#num_img").text();
                        $("#num_img").text(parseInt(numtext) + 1);
                        var number = $("#num_img").text();
                        $("#pic_list").prepend("<img src='" + path_img + "/" + json_name.picname + "' class='imgnew w-95'><br><br><div class='count_img'>" + number + "</div>");
                    });

                    montageImages = [];
                }
            }

            for (let i = 0; i < montageImages.length; i++) {
                const img = new Image();
                img.onload = function() {
                    loadedImages[i] = img;
                    imagesLoaded++;
                    checkAllImagesLoaded();
                };
                img.src = montageImages[i];
            }
        }

        function cancelMontage() {
            if (montageCropper) {
                montageCropper.destroy();
                montageCropper = null;
            }
            const cropperContainer = video.parentElement.querySelector('div[style*="position: absolute"]');
            if (cropperContainer) {
                cropperContainer.remove();
            }
            video.style.display = 'block';
            isMontageCropping = false;
            document.getElementById('montage_cancel_btn').style.display = 'none';
            montageCropData = null;
            montageImages = []; // Clear stored images

            const montageBtn = document.getElementById('montage_btn');
            montageBtn.innerHTML = '<i style="color: #ffffff;" class="ri-grid-fill"></i><br><span style="font-size: 11px; color: #ffffff;">Montage</span>';
        }

        document.getElementById('montage_btn').addEventListener('click', startMontage);

        document.getElementById('montage_cancel_btn').addEventListener('click', cancelMontage);

        const modal = document.getElementById("imageModal");
        const modalImg = document.getElementById("modalImage");
        const closeModal = document.getElementsByClassName("close-modal")[0];

        document.getElementById('pic_list').addEventListener('click', function(e) {
            if (e.target.classList.contains('imgnew')) {
                modal.style.display = "block";
                modalImg.src = e.target.src;
            }
        });

        closeModal.onclick = function() {
            modal.style.display = "none";
        }

        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        myVideo.addEventListener('wheel', function(event) {
            event.preventDefault();

            // Define how many seconds to skip per scroll delta
            const skipAmount = 0.1; // second per scroll step

            if (event.deltaY < 0) {
                // Scrolling up - go forward
                myVideo.currentTime = Math.min(myVideo.currentTime + skipAmount, myVideo.duration);
            } else {
                // Scrolling down - go backward
                myVideo.currentTime = Math.max(myVideo.currentTime - skipAmount, 0);
            }
        });

        myVideo.style.cursor = 'ns-resize';

        const progressBar = document.getElementById('videoProgress');
        const currentTimeDisplay = document.getElementById('currentTime');
        const durationDisplay = document.getElementById('duration');

        myVideo.addEventListener('loadedmetadata', function() {
            progressBar.max = myVideo.duration;
            durationDisplay.textContent = formatTime(myVideo.duration);
        });

        myVideo.addEventListener('timeupdate', function() {
            progressBar.value = myVideo.currentTime;
            currentTimeDisplay.textContent = formatTime(myVideo.currentTime);

            const percentage = (myVideo.currentTime / myVideo.duration) * 100;
            progressBar.style.background = `linear-gradient(to right , black ${percentage}%)`;
        });

        progressBar.addEventListener('input', function() {
            myVideo.currentTime = progressBar.value;
        });

        function formatTime(seconds) {
            const minutes = Math.floor(seconds / 60);
            const remainingSeconds = Math.floor(seconds % 60);
            const milliseconds = Math.floor((seconds % 1) * 100);
            return `${minutes}:${remainingSeconds.toString().padStart(2, '0')}.${milliseconds.toString().padStart(2, '0')}`;
        }

        const filmstrip = document.getElementById('filmstrip');
        const numThumbs = 20;
        const thumbWidth = 100, thumbHeight = 50;


        let filmstripImgs = [];
        for (let i = 0; i < numThumbs; i++) {
            const img = document.createElement('img');
            img.width = thumbWidth;
            img.height = thumbHeight;
            img.src = '';
            filmstrip.appendChild(img);
            filmstripImgs.push(img);

        }

        const thumbCanvas = document.createElement('canvas');
        const thumbCtx = thumbCanvas.getContext('2d');

        function generateFilmstripThumbnails() {
            if (!myVideo.duration || myVideo.readyState < 2) {
                setTimeout(generateFilmstripThumbnails, 500);
                return;
            }
            let currentIdx = 0;
            const oldTime = myVideo.currentTime;
            const wasPaused = myVideo.paused;
            function seekAndCapture(idx) {
                if (idx >= numThumbs) {
                    // restore
                    myVideo.currentTime = oldTime;
                    if (!wasPaused) myVideo.play();
                    return;
                }
                const percent = idx / (numThumbs-1);
                const time = percent * myVideo.duration;
                myVideo.pause();
                myVideo.currentTime = time;
                myVideo.addEventListener('seeked', function handler() {
                    // วาด frame ลง canvas
                    thumbCanvas.width = thumbWidth;
                    thumbCanvas.height = thumbHeight;
                    thumbCtx.fillStyle = '#000000';
                    thumbCtx.fillRect(0,0,thumbWidth,thumbHeight);
                    if (myVideo.videoWidth && myVideo.videoHeight) {
                        // วาดแบบ cover (crop เป็นวงกลม)
                        let scale = Math.max(thumbWidth / myVideo.videoWidth, thumbHeight / myVideo.videoHeight);
                        let w = myVideo.videoWidth * scale;
                        let h = myVideo.videoHeight * scale;
                        let x = (thumbWidth - w) / 2;
                        let y = (thumbHeight - h) / 2;
                        thumbCtx.save();
                        thumbCtx.beginPath();
                        thumbCtx.arc(thumbWidth/2, thumbHeight/2, thumbWidth/2-2, 0, 2*Math.PI);
                        thumbCtx.closePath();
                        thumbCtx.clip();
                        thumbCtx.drawImage(myVideo, x, y, w, h);
                        thumbCtx.restore();
                    }
                    filmstripImgs[idx].src = thumbCanvas.toDataURL('image/png');
                    myVideo.removeEventListener('seeked', handler);
                    seekAndCapture(idx+1);
                });
            }
            seekAndCapture(0);
        }
        // เรียกเมื่อ video โหลดข้อมูลแล้ว
        myVideo.addEventListener('loadedmetadata', generateFilmstripThumbnails);
        // ถ้าเปลี่ยนวิดีโอใหม่ ให้ clear filmstrip
        myVideo.addEventListener('emptied', function(){
            filmstripImgs.forEach(img=>img.src='');
        });
    </script>
</body>
</html>
