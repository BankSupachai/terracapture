@extends('layouts.layoutsManagePhoto')
@section('Title')
    Upload Photo
@endsection
@section('style')
    <style>
        .box {
            width: 100%;
            height: 300px;
            border-radius: 16px;
        }

        .dotted {
            border: dotted 3px #c3c3c3;
        }

        .text-blue-upload {
            color: #325684;
        }
        .text-dark-upload{
        }
        .pos-text {
            position: absolute;
            top: 28%;
            left: 0;
            right: 0;
            margin: auto;
            color: #212529;

        }

        .h86vh {
            height: 86vh;
        }

        .pt-6 {
            padding-top: 5em;

        }

        .form-select {
            border: 0px !important;
        }

        .disabled-div {
            pointer-events: none;
        }
    </style>
@endsection

@section('content')
    <div class="row m-0" style="height: 100vh;">
        <div class="col-xxl-1"></div>
        <div class="col-xxl pt-6">
            <div class="card bg-white p-5 h86vh">
                <div class="col-12">
                    <div class="d-flex justify-content-between">
                        <span class="text-blue-upload h3">Upload File</span>
                        <div>
                            <a href="{{ url('procedure') }}/{{ $case_id }}"
                                class="btn btn-info btn-label waves-effect right w-lg waves-light btn-loading"><i
                                    class="ri-file-list-2-line label-icon align-middle fs-16 ms-2 "></i> Back</a>
                            <button type="button" id="clear_all"
                                class="btn btn-danger btn-label waves-effect right w-lg waves-light" onclick="window.location.reload();"><i
                                    class="ri-delete-bin-5-line label-icon align-middle fs-16 ms-2"></i> Clear All</button>
                            <button type="button" id="save_file"
                                class="btn btn-primary btn-label waves-effect right w-lg waves-light"><i
                                    class="ri-check-double-line label-icon align-middle fs-16 ms-2"></i> Confirm</button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-4">
                        <div class="col-12 mt-4">
                            <input type="file" name="" id="file_input" multiple hidden>
                            <div class="box dotted" id="upload_div" id="drop_zone" style="cursor: pointer;"
                                onclick="open_file_input()" ondrop="dropHandler(event);"
                                ondragover="dragOverHandler(event);">
                                <p class="btn text-center text-dark-upload pos-text">Drag & Drop your files or Browse </p>
                            </div>
                        </div>
                        <div class="col-12 mt-3 h5">
                            Image Crop
                        </div>
                        <div class="col-12 mt-3">
                            <select id="scope_select" class="form-select atc" data-choices>
                                <option value="0" selected>AutoCrop</option>
                                @foreach ($scopes as $scope)
                                    @php
                                        $scope = (object) $scope;
                                    @endphp
                                    <option value="{{ @$scope->scope_id }}">{{ @$scope->scope_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-12 mt-3 mb-2 h5">
                            Support file format
                        </div>
                        <div class="h5 text-danger fw-light mt-2">
                            <div class="row">
                                <div class="col-6">
                                    <span><i class="ri-image-2-fill"></i> JPG, JPEG,PNG, TIFF </span>
                                </div>
                                <div class="col-6">
                                    <span><i class="ri-video-fill"></i> MP4 </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-8">
                        <br>
                        <span class="h5">Upload up to 100 Files - Total Files: <span id="total_file">0</span> file(s) -
                            Current uploaded file: <span id="curr_file">0</span></span>
                        <div class="col-12 mt-2">
                            <form id="fileupload" action="{{ url('selfupload') }}" method="POST"
                                enctype="multipart/form-data" style="width: 100%;">
                                @csrf
                                <noscript><input type="hidden" name="redirect" value="add_photo.php"></noscript>
                                <div style="height: 61vh; overflow:auto;">

                                    <table id="upload_table">
                                        {{-- content --}}
                                    </table>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xxl-1"></div>
        <div class="col-xxl-12 text-center" style="position: absolute; bottom: 22px; color: #ffffff80;">
            © 2023 EndoINDEX 6.0 by Medica Healthcare Co.,Ltd.
        </div>


    </div>
@endsection
@section('script')
    <script src="{{ url('public/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{asset('public/js/cornerstone/hammer.js')}}"></script>
    <script src="{{asset('public/js/cornerstone/dicomParser.min.js')}}"></script>
    <script src="{{asset('public/js/cornerstone/cornerstone.js')}}"></script>
    <script src="{{asset('public/js/cornerstone/cornerstoneMath.min.js')}}"></script>
    <script src="{{asset('public/js/cornerstone/cornerstoneTools.js')}}"></script>
    <script src="{{asset('public/js/cornerstone/cornerstoneWADOImageLoader.bundle.min.js')}}"></script>
    <script src="{{asset('public/js/cornerstone/cornerstoneWebImageLoader.js')}}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var all_files = []
        var count_file = 0
        var submit_status = true

        _initCornerstoneWADOImageLoader()

        console.log(cornerstone);

        function open_file_input() {
            $('#file_input').trigger("click");
        }

        $('#file_input').on('change', function(e) {
            var files = [...e.target.files]
            console.log(files);
            upload_files(files, 'manual')
        })

        function dropHandler(ev) {
            ev.preventDefault();
            if (ev.dataTransfer.items) {
                var files = [...ev.dataTransfer.items]
                upload_files(files, 'drop')
            }
        }

        function compare_datetimestr(date_a, date_b){
            let filename_a = date_a.getAsFile().name;
            let filename_b = date_b.getAsFile().name;
            let datetime_a = filename_a.slice(35, 50)
            let datetime_b = filename_b.slice(35, 50)
            return datetime_a.localeCompare(datetime_b)
        }

        function compare_datetimestr_manual(file_a, file_b){
            let filename_a = file_a.name;
            let filename_b = file_b.name;
            let datetime_a = filename_a.slice(35, 50)
            let datetime_b = filename_b.slice(35, 50)
            return datetime_a.localeCompare(datetime_b)
        }
        // alert()
        function upload_files(files, event_type){
            let file_temp = []
            files.forEach((item, i) => {
                let name = item.name
                let ext  = name.split('.').pop().toLowerCase()
                let forbid_ext = ['exe', 'pdf','tiff','tif', 'js', 'xlsx', 'webm', 'pptx', 'mp3', 'sql', 'zip'];
                if ((item.type == 'image/jpeg' || item.type == 'image/png' || item.type == 'video/mp4') || item.type == 'image/tiff'|| item.type == 'image/tif' || item.type === 'application/dicom' || ext.includes('dcm')) {
                    file_temp.push(item)
                } else if(forbid_ext.includes(ext)){
                    call_alert('wrong type',
                        'Uploaded file is not a valid file. Only JPG, PNG, TIFF and MP4 files are allowed.')
                } else {
                    file_temp.push(item)
                }
            })

            // เรียงลำดับไฟล์ตามชื่อ
            try{
                if(event_type == 'drop'){
                    file_temp.sort(compare_datetimestr)
                } else {
                    file_temp.sort(compare_datetimestr_manual)
                }
                console.log('Files sorted:', file_temp.map(f => f.name || f.getAsFile().name))
            } catch(e) {
                console.log('Sorting error:', e)
                // ถ้าเรียงไม่ได้ ให้เรียงตามชื่อไฟล์
                if(event_type == 'drop'){
                    file_temp.sort((a, b) => a.getAsFile().name.localeCompare(b.getAsFile().name))
                } else {
                    file_temp.sort((a, b) => a.name.localeCompare(b.name))
                }
            }

            if(event_type == 'drop'){
                file_temp.forEach((item, i) => {
                    let file = item.getAsFile();
                    count_file += 1
                    append_file(file, count_file)
                });
            } else {
                file_temp.forEach((file, i) => {
                    count_file += 1
                    append_file(file, count_file)
                });
            }
        }


        function dragOverHandler(ev) {
            ev.preventDefault();
        }

        function append_file(file, i) {
            console.log(file);
            var filesize = formatBytes(parseInt(file.size))
            var inp = ''
            let name = file.name
            let ext  = name.split('.').pop().toLowerCase()
            let forbid_ext = ['exe', 'pdf', 'js', 'xlsx', 'webm', 'pptx', 'mp3', 'sql', 'zip'];
            if (file.type == 'image/jpeg' || file.type == 'image/png') {
                inp = `<img id="preview${i}" src="" width="100px" alt="">`
            }  else if(file.type == 'video/mp4'){
                inp = `<video width="100" autoplay>
                          <source src="" id="preview${i}">
                       </video>`
            // } else if(file.type === 'application/dicom' || ext.toLowerCase().includes('dcm')){
            } else {
                inp = `<div id="dicom${i}" width="100px"></div>`
            }
            // else {
            //     inp = `<video width="100" autoplay>
            //                 <source src="" id="preview${i}">
            //             </video>`
            // }

            $('#upload_table').append(`
                <tr class="h5 mt-2 file-upload" id="file${i}">
                    <td style="width: 5em;" class="file-index">${i}</td>
                    <td style="width: 10em;" >
                        ${inp}
                    </td>
                    <td style="width: 25em;">${file.name}</td>
                    <td style="width: 10em;">${filesize}</td>
                    <td  style="width: 10em;">
                        <div class="progress">
                            <div data-fileid="file${i}" id="pg_file${i}"  class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
                        </div>
                    </td>
                    <td style="width: 2em"></td>
                    <td><button onclick="delete_file('${i}', '${file.name}')" class="btn btn-icon btn-danger" ><i class="ri-delete-bin-6-line"></i></button></td>
                </tr>
            `)

            $('#total_file').html(`${i}`)

            // <td id="sp_file${i}" style="width: 5em;display: none">
            //             <div class="spinner-border spinner-border-sm text-primary" role="status" >
            //                 <span class="visually-hidden">Loading...</span>
            //             </div>
            //         </td>

            // $('#sp_file1').css('display', 'block')

            if (file.type == 'image/jpeg' || file.type == 'image/png') {
                document.getElementById(`preview${i}`).src = window.URL.createObjectURL(file)
            }
            else if(file.type == 'video/mp4') {
                var source = $(`#preview${i}`);
                source[0].src = URL.createObjectURL(file);
                source.parent()[0].load();
            }
            // else (file.type === 'application/dicom' || ext.toLowerCase().includes('dcm')){
            else {
                imageId = cornerstoneWADOImageLoader.wadouri.fileManager.add(file)
                let elem = document.getElementById(`dicom${i}`)
                cornerstone.enable(elem)
                try{
                    loadImage(imageId, elem, i)
                } catch (err) {
                    console.log('error');
                }

                // setTimeout(() => {
                //     let div_cv = elem.querySelector('canvas')
                //     let is_empty = checkCanvas(div_cv)
                //     if(is_empty){
                //         loadPlaceholderImage(elem)
                //     }
                // }, 1000);

            }

            all_files.push(file)
            submit_status = true
        }

        function formatBytes(bytes, decimals = 2) {
            if (!+bytes) return '0 Bytes'
            const k = 1024
            const dm = decimals < 0 ? 0 : decimals
            const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB']
            const i = Math.floor(Math.log(bytes) / Math.log(k))
            return `${parseFloat((bytes / Math.pow(k, i)).toFixed(dm))} ${sizes[i]}`
        }

        function delete_file(num, file_name) {
            $(`#file${num}`).remove()
            var file_index = 99
            all_files.forEach((file, i) => {
                if (file.name == file_name) {
                    file_index = i
                }
            })
            all_files.splice(file_index, 1)
            count_file -= 1
            if(count_file < 0){
                count_file = 0
            }
            $('#total_file').html(`${count_file}`)

            reindex_file()
        }

        function reindex_file(){
            // reindex file
            let files_index = $('.file-index').length
            for (let i = 0; i < files_index; i++) {
                $($('.file-index')[i]).html(i+1)
            }
        }

        var scope_id = 0
        var div_id = []

        $('#save_file').on('click', function() {

            if (count_file > 0) {
                $(this).attr('disabled', true)
                $('#clear_all').attr('disabled', true)
                scope_id = $('#scope_select').val()
                $('#upload_div').addClass('disabled-div')
                var total_files = $('.file-upload').length
                for (let j = 0; j < total_files; j++) {
                    div_id.push($($('.file-upload')[j]).prop('id'))
                }

                console.log('All files to upload:', all_files.map(f => f.name))
                console.log('Submit status:', submit_status);

                if (submit_status) {
                    setTimeout(() => {
                        post(all_files[0], 0)
                    }, 1000);
                    submit_status = false
                }
            }
        })

        function post(file, index) {
            var formData = new FormData()
            formData.append('files', file)
            formData.append('scope_id', scope_id)
            formData.append('event', 'upload_photo')
            formData.append('_id', '{{ @$case_id }}')
            formData.append('hn', '{{ @$hn }}')
            formData.append('caseuniq', '{{ @$caseuniq }}')
            formData.append('index', index)
            formData.append('file_order', index + 1) // ลำดับของไฟล์ (1-based)
            formData.append('total_files', all_files.length) // จำนวนไฟล์ทั้งหมด
            formData.append('file_name', file.name) // ชื่อไฟล์เพื่อ debug
            console.log('Uploading file:', file.name, 'Order:', index + 1, 'Total:', all_files.length);


            var ajax = new XMLHttpRequest()
            ajax.upload.addEventListener("progress", progressHandler, false)
            ajax.addEventListener("load", completeHandler, false);
            ajax.addEventListener("error", errorHandler, false);
            ajax.open("POST", "{{url("api/photo")}}");
            ajax.send(formData)

            let id = div_id[index]


            function progressHandler(evt) {
                // console.log(evt.total, evt.loaded);
                if (evt.lengthComputable) {
                    var percentComplete = evt.loaded / evt.total;
                    percentComplete = parseInt(percentComplete * 100);
                    $(`#pg_${div_id[index]}`).css('width', `${percentComplete}%`).html(`${percentComplete}%`)
                    if (percentComplete === 100) {
                        setTimeout(() => {
                            if(id != "" && id != undefined){
                                if($('#file'+index).find('#dicom'+index).length < 0){
                                    $(`#${id}`).remove()
                                }
                            }
                        }, 100);
                        $('#curr_file').html(`${index + 1}`)
                        count_file = $('.file-upload').length
                        // reindex_file()
                    }
                }
            }

            function errorHandler() {
                // $(`#${div_id[index]}`).remove()
                // count_file = $('.file-upload').length
                swal.close()
                count_file = $('.file-upload').length
                $('#curr_file').html(`${count_file}`)
                // $('#total_file').html(`0`)
                // $('#curr_file').html(`0`)
            }

            function completeHandler(e) {
                var res = e.target.responseText;
                console.log('Upload completed for file:', all_files[index].name, 'Response:', res);

                if(res == 'success'){
                    $(`#${id}`).remove()
                }

                if (index < all_files.length - 1) {
                    console.log('Uploading next file:', all_files[index + 1].name, 'Order:', index + 2);
                    // ลดเวลาหน่วงเวลาเพื่อให้การอัปโหลดเร็วขึ้นและรักษาลำดับ
                    setTimeout(() => {
                        post(all_files[index + 1], index + 1)
                    }, 200); // ลดเวลาหน่วงเวลาเหลือ 200ms
                } else if (index == all_files.length - 1) {
                    console.log('All files uploaded successfully');
                    submit_status = true
                    $('#save_file').attr('disabled', false)
                    $('#clear_all').attr('disabled', false)
                    $('#upload_div').removeClass('disabled-div')
                    all_files = []
                    count_file = 0
                    $('#upload_table').empty()
                    swal.close()
                    $('#total_file').html(`0`)
                    $('#curr_file').html(`0`)
                    // location.reload()
                }
            }

        }

        function call_alert(type, text) {
            var options = []
            if (type == 'wrong type') {
                options['icon'] = 'error'
            } else if (type == 'waiting') {
                options['icon'] = 'info'
                options['allowOutsideClick'] = false
                options['allowEscapeKey'] = false
                options['showConfirmButton'] = false
            } else if (type == 'max file') {
                options['icon'] = 'error'
            }
            options['text'] = text
            Swal.fire(options)
        }


        function _initCornerstoneWADOImageLoader() {
            let baseUrl = "{{asset('public/js/cornerstone')}}"

            cornerstoneWADOImageLoader.external.cornerstone = cornerstone;
            cornerstoneWADOImageLoader.external.dicomParser = dicomParser;
            // Image Loader
            const config = {
                webWorkerPath: `${baseUrl}/cornerstoneWADOImageLoaderWebWorker.js`,
                taskConfiguration: {
                decodeTask: {
                    codecsPath: `${baseUrl}/cornerstoneWADOImageLoaderCodecs.js`,
                    usePDFJS: false,
                    loadCodecsOnStartup: true,
                },
                },
            };
            cornerstoneWADOImageLoader.webWorkerManager.initialize(config);
        }

        const loadImage = (imageId, imageContainer, i) => {
            cornerstone.loadImage(imageId).then((image) => {
                cornerstone.displayImage(imageContainer, image);
            }).catch(err => {});

            setTimeout(() => {
                let canvas = document.getElementsByClassName('cornerstone-canvas');
                canvas[i-1].style.width = '100px'
            }, 100);
        }

        const loadPlaceholderImage = (elem) => {
            const img = document.createElement('img');
            img.src = '{{url("public")}}/image/bg-sortphoto.png';
            img.style.width = '100px'
            img.alt = 'Placeholder';
            elem.appendChild(img);
            let canvas = elem.querySelector('.cornerstone-canvas');
            if (canvas) { elem.removeChild(canvas);}
        }

        const checkCanvas = (canvas) => {
            let ctx = canvas.getContext('2d');
            let isRendered = true;
            let imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
            let data = imageData.data;
            for (let i = 0; i < data.length; i += 4) {
                if (data[i] !== 255 || data[i+1] !== 255 || data[i+2] !== 255 || data[i+3] !== 255) {
                    isRendered = false;
                    break;
                }
            }
            return isRendered
        }
        $(".btn-loading").click(function(e) {
            if ($(this).hasClass('disabled')) {
                e.preventDefault();
                return false;
            }
            $(this).addClass('disabled');
            var originalText = $(this).html();
            $(this).data('original-text', originalText);
            $(this).html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> &ensp; Loading...'
            );
            if ($(this).attr('href')) {
                e.preventDefault();
                var href = $(this).attr('href');
                setTimeout(function() {
                    window.location.href = href;
                }, 500);
            }
        });
    </script>
@endsection
