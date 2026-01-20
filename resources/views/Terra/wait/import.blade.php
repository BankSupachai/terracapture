@extends('layouts.layout_capture')


@section('title', 'Endocapture')

@section('style')
<style>
.data-select-import{display: none;}
.data-select-import.active{display: block;}
</style>
<link rel="stylesheet" href="{{url("public/assets5/libs/dropzone/dropzone.css")}}" type="text/css" />
<link rel="stylesheet" href="{{url("public/assets5/libs/filepond/filepond.min.css")}}" type="text/css" />
<link rel="stylesheet" href="{{url("public/assets5/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.css")}}">
@endsection

@section('modal')

@endsection

@section('lpage')
Import
@endsection
@section('rpage')
Import
@endsection
@section('rppage')
Form import
@endsection

@section('content')
<div class="row p-4 mt-2">
    <div class="col-lg"></div>
    <div class="col-lg-10">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4 text-center">
                        <div class="box">

                            <div class="dropzone"  id="mydropzone">
                                <form id="demo-upload" action="/">
                                    <div class="fallback">
                                        {{-- multiple="multiple" --}}
                                        <input name="file" type="file">
                                    </div>
                                    <div class="dz-message needsclick">
                                        <div class="mb-3">
                                            <i class="display-4 text-muted ri-upload-cloud-2-fill"></i>
                                        </div>

                                        <h4>Drop files here or click to upload.</h4>
                                    </div>
                                </form>
                            </div>

                            {{-- <div>
                                <input id="file" name="file" type="file">
                            </div> --}}

                            <ul class="list-unstyled mb-0" id="dropzone-preview">
                                <li class="mt-2" id="dropzone-preview-list">
                                    <!-- This is used as the file preview template -->
                                    <div class="border rounded">
                                        <div class="d-flex p-2">
                                            <div class="flex-shrink-0 me-3">
                                                <div class="avatar-sm bg-light rounded">
                                                    <img data-dz-thumbnail class="img-fluid rounded d-block" src="#" alt="Dropzone-Image" />
                                                </div>
                                            </div>
                                            <div class="flex-grow-1">
                                                <div class="pt-1">
                                                    <h5 class="fs-14 mb-1" data-dz-name>&nbsp;</h5>
                                                    <p class="fs-13 text-muted mb-0" data-dz-size></p>
                                                    <strong class="error text-danger" data-dz-errormessage></strong>
                                                </div>
                                            </div>
                                            <div class="flex-shrink-0 ms-3">
                                                <button data-dz-remove class="btn btn-sm btn-danger">Delete</button>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <br>
                            <button class="btn btn-primary mt-2 img-profile-set">Change Photo</button>
                        </div>
                    </div>
                    <div class="col-lg"></div>
                    <div class="col-lg-7">
                        <div class="row">
                            <div class="col-lg-12"><h3 class="text-terralink">Select file format</h3></div>
                        </div>
                        <div class="row">
                            <div class="col-auto">
                                <label class="radio">
                                    <input type="radio" id="radio_dicom" name="radios1" class="check-form" value="dicom" checked/>
                                    <span></span>
                                    &nbsp; DICOM
                                </label>
                            </div>
                            <div class="col-auto">
                                <label class="radio">
                                    <input type="radio" id="radio_image" name="radios1" class="check-form" value="image" disabled/>
                                    <span></span>
                                    &nbsp; JPEG/PNG/BMP/PDF/MP4
                                </label>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-lg-12"><h3 class="text-terralink">Detail</h3></div>
                        </div>
                        <form action="{{url("terra/import")}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input id="file" name="file" type="file" accept=".jpeg, .jpg, .png, .pdf, .dcm, .dic, .bmp, .mp4" required>
                            <div class="row data-select-import active" id="dicom">
                                <input type="hidden" name="event" value="upload_file" >
                                <div class="col-lg-3 mt-2">Patient ID</div>
                                <div class="col-lg-5 mt-2">
                                    <input type="text" name="dicom_id" id="dicom_id" class="form-control form-control-sm mb-1" required>
                                    <label class="checkbox">
                                        <input type="checkbox" name="Checkboxes1"/>
                                        <span></span>
                                        &nbsp; Change value
                                    </label>
                                </div>
                                <div class="col-lg-4 mt-2"></div>

                                <div class="col-lg-3 mt-2">Name</div>
                                <div class="col-lg-5 mt-2">
                                    <input type="text" name="dicom_name" class="form-control form-control-sm mb-1" id="dicom_name" required>
                                    <label class="checkbox">
                                        <input type="checkbox" name="Checkboxes1"/>
                                        <span></span>
                                        &nbsp; Change value
                                    </label>
                                </div>
                                <div class="col-lg-4 mt-2"></div>

                                <div class="col-lg-3 mt-2">DOB</div>
                                <div class="col-lg-5 mt-2">
                                    <input type="date" name="dicom_dob" id="dicom_dob" class="form-control form-control-sm mb-1" required>
                                    <label class="checkbox">
                                        <input type="checkbox" name="Checkboxes1"/>
                                        <span></span>
                                        &nbsp; Change value
                                    </label>
                                </div>
                                <div class="col-lg-4 mt-2"></div>

                                <div class="col-lg-3 mt-2">Institution name</div>
                                <div class="col-lg-5 mt-2">
                                    <input type="text" name="dicom_int" id="dicom_int" class="form-control form-control-sm mb-1" required>
                                    <label class="checkbox">
                                        <input type="checkbox" name="Checkboxes1"/>
                                        <span></span>
                                        &nbsp; Change value
                                    </label>
                                </div>
                                <div class="col-lg-4 mt-2"></div>

                                <div class="col-lg-3 mt-2"></div>
                                <div class="col-lg-5 mt-2 text-right">
                                    <button class="btn btn-sm btn-light mr-2" onclick="location.reload();">Cancel</button>
                                    <button type="submit" class="btn btn-sm btn-primary" name="button" value="dicom">Import</button>
                                </div>
                                <div class="col-lg-3 mt-2"></div>
                        </div>
                        <div class="row data-select-import" id="image">
                                <div class="col-lg-3 mt-2">Patient ID <b class="text-danger">*</b></div>
                                <div class="col-lg-5 mt-2">
                                    <input type="text" name="other_id" id="other_id" class="form-control form-control-sm" oninput="check_id(this.value)">
                                </div>
                                <div class="col-lg-4 mt-2"></div>

                                <div class="col-lg-3 mt-2">Name <b class="text-danger">*</b></div>
                                <div class="col-lg-5 mt-2">
                                    <input type="text" name="other_name" id="other_name" class="form-control form-control-sm"  >
                                </div>
                                <div class="col-lg-4 mt-2"></div>

                                <div class="col-lg-3 mt-2">DOB <b class="text-danger">*</b></div>
                                <div class="col-lg-5 mt-2">
                                    <input type="date" name="other_dob" id="other_dob" class="form-control form-control-sm" >
                                </div>
                                <div class="col-lg-4 mt-2"></div>

                                <div class="col-lg-3 mt-2">Gender <b class="text-danger">*</b></div>
                                <div class="col-lg-5 mt-2">
                                    <input type="text" name="other_gender" id="other_gender" class="form-control form-control-sm" placeholder="ชาย/หญิง">
                                </div>
                                <div class="col-lg-4 mt-2"></div>

                                <div class="col-lg-3 mt-2">Study Date <b class="text-danger">*</b></div>
                                <div class="col-lg-5 mt-2">
                                    <input type="date" name="other_date" id="other_date" class="form-control form-control-sm" >
                                </div>
                                <div class="col-lg-4 mt-2"></div>

                                <div class="col-lg-3 mt-2"></div>
                                <div class="col-lg-5 mt-2 text-right">
                                    <button class="btn btn-sm btn-light mr-2" onclick="location.reload();">Cancel</button>
                                    <button type="submit" class="btn btn-sm btn-primary" name="button" value="image">Import</button>
                                </div>
                                <div class="col-lg-3 mt-2"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg"></div>
</div>
@endsection






@section('script')
<script src="{{url("public/assets5/libs/dropzone/dropzone-min.js")}}"></script>
<script src="{{url("public/assets5/libs/filepond/filepond.min.js")}}"></script>
<script src="{{url("public/assets5/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js")}}"></script>
<script src="{{url("public/assets5/libs/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js")}}"></script>
<script src="{{url("public/assets5/libs/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js")}}"></script>
<script src="{{url("public/assets5/libs/filepond-plugin-file-encode/filepond-plugin-file-encode.min.js")}}"></script>
<script src="{{url("public/assets5/js/pages/form-file-upload.init.js")}}"></script>
<script src="{{asset('public/js/jquery.min.js')}}"></script>

<script src="{{asset('public/js/cornerstone/dicomParser.min.js')}}"></script>
<script src="{{asset('public/js/sweetalert2@11.js')}}"></script>
<script src="{{asset('public/js/moment.min.js')}}"></script>



<script>

    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});


    $(".check-form").click(function(){
        var data_check = $(".check-form:checked").val();
        if(data_check=='image'){
            if($("#image").hasClass('active')){
            }else{
                $("#image").addClass('active')
                $("#dicom").removeClass('active')
            }
        }else{
            if($("#dicom").hasClass('active')){
            }else{
                $("#dicom").addClass('active')
                $("#image").removeClass('active')
            }
        }
    })

    $('#file').on('change', function(e){
        var file = e.target.files[0]
        var file_name = file.name
        let is_dicom = file_name.includes('.dcm') || file_name.includes('.DCM') || file_name.includes('.dic')
        let is_other = file_name.includes('.png') || file_name.includes('.jpg') || file_name.includes('.jpeg')
                    || file_name.includes('.bmp') || file_name.includes('.pdf') || file_name.includes('.mp4')

        let dicom_required = ['dicom_id', 'dicom_name', 'dicom_dob' ,'dicom_int' ]
        let other_required = ['other_id', 'other_name', 'other_dob' ,'other_date', 'other_gender']


        if(is_dicom == true){
            $("#radio_dicom").prop('checked', true)
            $("#radio_image").prop('checked', false)
            $(`#radio_dicom`).prop('disabled', false)
            $(`#radio_image`).prop('disabled', true)
            $("#dicom").addClass('active')
            $("#image").removeClass('active')

            for(let i=0;i<dicom_required.length;i++){
                $(`#${dicom_required[i]}`).attr('required', true)
            }

            for(let j=0;j<other_required.length;j++){
                $(`#${other_required[j]}`).attr('required', false)
            }

            read_file(file)
        } else {
            if(is_other == true){
                $("#radio_image").prop('checked', true)
                $("#radio_dicom").prop('checked', false)
                $(`#radio_dicom`).prop('disabled', true)
                $(`#radio_image`).prop('disabled', false)
                $("#image").addClass('active')
                $("#dicom").removeClass('active')

                for(let i=0;i<dicom_required.length;i++){
                    $(`#${dicom_required[i]}`).attr('required', false)
                }

                for(let j=0;j<other_required.length;j++){
                    $(`#${other_required[j]}`).attr('required', true)
                }
            } else {
                Swal.fire('ไม่รองรับไฟล์ประเภทนี้')
                document.getElementById('file').value = "";
            }

        }
    })

    function read_file(file){
        var reader =  new FileReader()
        reader.onload = function (file) {
            var arrayBuffer = reader.result
            var byteArray = new Uint8Array(arrayBuffer)
            setTimeout(() => {
                var dataSet;
                try{
                    dataSet = dicomParser.parseDicom(byteArray);
                    dump_data(dataSet)
                } catch (err){
                    console.log(err);
                }
            }, 50);

        }

        reader.readAsArrayBuffer(file);
    }

    function dump_data(dataSet) {
        let attrs = ['x00100020', 'x00100010', 'x00100030', 'x00080080']
        let attr_name = ['id', 'name', 'dob', 'int']
        for(let i=0;i<attrs.length;i++){
            var element = dataSet.elements[attrs[i]];
            var text = "";
            if(element !== undefined)
            {
                var str = dataSet.string(attrs[i]);
                if(str !== undefined) {
                    text = str;
                    if(i==2){
                        text = moment(text).format("YYYY-MM-DD")
                    }
                }
            }
            $(`#dicom_${attr_name[i]}`).val(text);
        }
    }

    function check_id(id){
        $.post("{{url("terra/import")}}",
            {
                event   : "check_patient_id",
                id      : id,
            },
            function(data, status)
            {
                let is_match = data
                if(is_match != 0){
                    let parse = JSON.parse(is_match)
                    Swal.fire({
                        title: `กรุณายืนยันชื่อผู้ป่วยว่าใช่คุณ${parse.firstname} ${parse.lastname}หรือไม่`,
                        showDenyButton: true,
                        showCancelButton: false,
                        confirmButtonText: 'ยืนยัน',
                        denyButtonText: `ยกเลิก`,
                    }).then((result) => {
                        if (result.isConfirmed) {
                            let id = (parse.hn!=undefined && parse.hn!='') ? parse.hn : ''
                            let firstname = (parse.firstname!=undefined && parse.firstname!='') ? parse.firstname : ''
                            let lastname =  (parse.lastname!=undefined && parse.lastname!='') ? parse.lastname : ''
                            let name = `${firstname} ${lastname}`
                            let dob = (parse.birthdate!=undefined && parse.birthdate!='') ? moment(parse.birthdate).format("YYYY-MM-DD") : ''
                            let gender = (parse.gender!=undefined && parse.gender!='') ? parse.gender : ''
                            gender = gender!='' && gender==1 ? 'ชาย' : 'หญิง'

                            $(`#other_id`).val(id)
                            $(`#other_name`).val(name)
                            $(`#other_dob`).val(dob)
                            $(`#other_gender`).val(gender)

                        } else if (result.isDenied) {
                            $(`#other_id`).val('')
                        }
                    })
                }
            });
    }



</script>

@endsection
