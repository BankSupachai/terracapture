<div class="row">
    <div class="col-12">
            <form action="{{url('admin/procedure')}}/{{@$data->code}}" method="post" class="card">
            @method('PUT')
            @csrf
            <div class="card-body pb-4">
                <div class="row">
                    <div class="col-lg-12">
                        <h4>General Information</h4>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="procedure_id">Procedure ID</label>
                            <input type="text" class="form-control" id="procedure_id" placeholder="Procedure ID" value="{{@$data->code}}" readonly>
                        </div>
                        <div class="form-group mt-3">
                            <label for="procedure_name">Procedure Name</label>
                            <input type="text" class="form-control" id="procedure_name" name="name" placeholder="Procedure Name" value="{{@$data->name}}">
                        </div>
                        <div class="form-group mt-3">
                            <label for="procedure_name_show">Procedure Name (Show)</label>
                            <input type="text" class="form-control" id="procedure_name_show" placeholder="Procedure Name (Show)" value="{{@$data->name}}">
                        </div>
                        <div class="form-group mt-3">
                            <label for="modality">Modality</label>
                            <select name="Modality" id="modality" class="form-control" >
                                <option value="ES">ES</option>
                            </select>
                        </div>
                        <div class="form-group mt-3">
                            <label for="color">Color</label>
                            <input type="color" name="color" class="form-control p-1" id="color" value="{{@$data->color}}">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        {{-- <input type="file" id="drop_file" name="file" class="filepond filepond-input-multiple" multiple name="filepond" data-allow-reorder="true" data-max-file-size="20MB" data-max-files="6"> --}}
                        <input type="file" name="" id="file_input" multiple hidden>
                        <div class="filepond" id="upload_div" id="drop_zone" style="cursor: pointer;border: dotted 1px #6d7080;border-radius: 5px;"
                            onclick="open_file_input()" ondrop="dropHandler(event);"
                            ondragover="dragOverHandler(event);">
                            <div class="row mt-3">
                                <div class="col-1 me-2"></div>
                                <div class="col-10">
                                    <p style="color:#4f4f4f; font-size:16px" class="btn text-center text-dark-upload pos-text">Drag & Drop your files or <u>Browse</u> </p>
                                </div>
                                <div class="col-1"></div>
                            </div>
                        </div>
                        
                        <br>
                        <b>Click for choose default picture</b>
                        <div class="row mt-3" id="images_div">
                            <div class="col-3 mt-1" data-index="1">
                                @if(isset($data->img))
                                <img id="image01div" data-index="1" class="box-img img-fluid active show-img" src="{{fileconfig("procedure/".$data->img)}}">
                                @else
                                <div id="image01div" data-index="1" class="box-img img-fluid"></div>
                                @endif
                            </div>
                            {{-- <div class="col-3">
                                <div id="image02div" class="box-img img-fluid"></div>
                            </div>
                            <div class="col-3">
                                <div id="image03div" class="box-img img-fluid"></div>
                            </div>
                            <div class="col-3">
                                <div id="image04div" class="box-img img-fluid"></div>
                            </div> --}}
                        </div>
                    </div>
                </div>
                <div class="col-12 text-end mt-5">
                    <button type="submit" name="general" value="1" class="btn btn-primary btn-label waves-effect right waves-light"><i class="ri-play-mini-fill label-icon align-middle fs-16 ms-2"></i> Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var all_files = []
        var count_file = 0
        var submit_status = true

        function open_file_input() {
            $('#file_input').trigger("click");
        }

        $('#file_input').on('change', function(e) {
            // var all_index = $('.file-index').length
            var files = [...e.target.files]
            files.forEach((file, i) => {
                if (file.type == 'image/jpeg' || file.type == 'image/png') {
                        count_file += 1
                        append_file(file, count_file)
                } else {
                    call_alert('wrong type',
                        'Uploaded file is not a valid file. Only JPG, PNG and MP4 files are allowed.')
                }
            })
        })

        function clear_img_active(classname){
            for (let i = 0; i < $(`.${classname}`).length; i++) {
                $($(`.${classname}`)[i]).removeClass('active')
            }
        }

        function add_class_active(elem_id, classname){
            console.log(elem_id, classname);
            clear_img_active(classname)
            $(`#${elem_id}`).addClass('active')
        }

        function dropHandler(ev) {
            ev.preventDefault();
            if (ev.dataTransfer.items) {
                [...ev.dataTransfer.items].forEach((item, i) => {
                    if (item.kind === "file" && (item.type == 'image/jpeg' || item.type == 'image/png' || item
                            .type == 'video/mp4')) {
                        const file = item.getAsFile();
                        count_file += 1
                        append_file(file, count_file)
                    } else {
                        call_alert('wrong type',
                            'Uploaded file is not a valid file. Only JPG and PNG files are allowed.')
                    }
                });
            }
        }

        function dragOverHandler(ev) {
            ev.preventDefault();
        }

        function append_file(file, i) {
            i = i + 1
            if(i.length == 1){ i = `0${i}` }

            let img_div = `
                <div class="col-3 mt-1" onclick="add_class_active('image${i}div', 'show-img')"  data-index="${i}">
                    <img id="image${i}div" data-index="${i}" class="box-img img-fluid show-img" src="" alt=""   onerror='this.style.display = "none"'>
                </div>
            `

            $('#images_div').append(img_div)

            if (file.type == 'image/jpeg' || file.type == 'image/png') {
                document.getElementById(`image${i}div`).src = window.URL.createObjectURL(file)
                document.getElementById(`image${i}div`).style.display = 'block'
            }

            all_files.push(file)
        }


        function delete_file(index, file_name) {
            $(`#image${i}div`).remove()
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
</script>

