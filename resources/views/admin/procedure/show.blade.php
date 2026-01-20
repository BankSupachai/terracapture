@extends('layouts.layouts_index.main')


@section('title', 'EndoINDEX')

@section('style')
<link rel="stylesheet" type="text/css" href="{{url("public/assets5/libs/multi.js/multi.min.css")}}" />
<link rel="stylesheet" href="{{url("public/assets5/libs/@tarekraafat/autocomplete.js/css/autoComplete.css")}}">
<link rel="stylesheet" href="{{url("assets/css/jquery-ui.css")}}">

<link rel="stylesheet" href="{{url("public/assets5/libs/filepond/filepond.min.css" )}}" type="text/css" />
<link rel="stylesheet" href="{{url("public/assets5/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.css")}}">
<link rel="stylesheet" href="{{url("public/assets5/libs/dropzone/dropzone.css")}}" type="text/css" />
<style>
    .ri-upload-cloud-2-fill{font-size: xx-large !important;}
    .filepond--drop-label{
        background: white !important;
        border: 1px dotted gray !important;
        padding: 2em !important;
        border-radius: 8px !important;
    }
    .box-img{
        border: 1px solid rgb(211, 207, 207);
        border-radius: 5px;
        min-height: 9.9em;
    }
    .box-img:hover{
        transition: border 0.3s;
        border: none;
    }
    .box-img.active{border: 1px solid #0AB39C;}
    .sc_data{
        margin-top: 5px;
        width: 100%;
        height: 15em;
        overflow-y: auto;
    }
    .menu-phy-select{
        color: black;
    }
    .menu-phy-select .col,#check_list .col-lg-4{
        padding-top: 5px;
        padding-bottom: 5px;
    }
    .menu-phy-select:hover{
        transition: 0.2s;
        border-radius: 5px;
        background: #EFF2F7;
    }
    .menu-phy-select.active{
        background: #EFF2F7;
    }
    .change-form{
        padding-top: 5px;
    }
    .change-form:hover{
        background: #dbe0e7;
    }
    .form-control{
        background: #f3f6f9 !important;
        border: 0px !important;
    }
</style>
@endsection

@section('modal')
<div class="modal fade" id="adsp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">เพิ่มข้อมูล</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-bs-label="Close">
            {{-- <span aria-hidden="true">&times;</span> --}}
          </button>
        </div>
        <div class="modal-body">
            <form action="{{url('endo')}}/procedure-setting" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="nameprocedure">ชื่อ Procedure</label>
                    <input type="text" class="form-control" id="nameprocedure" name="sp_name" required>
                    <small id="nameprocedure" class="form-text text-muted">ชื่อ Procedure ต้องการเพิ่ม</small>
                </div>
                <div class="form-group">
                    <label for="procedureblade">ชื่อไฟล์</label>
                    <input type="text" class="form-control" id="procedureblade" name="sp_file" required>
                    <small id="procedureblade" class="form-text text-muted">ชื่อไฟล์ Procedure .Blade</small>
                </div>
                <button type="submit" class="btn btn-primary" name="add_sp" value="1" style="width: 100%;">เพิ่ม</button>
            </form>
        </div>
      </div>
    </div>
</div>
<div class="modal fade" id="edsp" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">เพิ่มข้อมูล</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-bs-label="Close">
            {{-- <span aria-hidden="true">&times;</span> --}}
          </button>
        </div>
        <div class="modal-body">
            <form action="{{url('endo')}}/procedure-setting/1" method="POST" enctype="multipart/form-data">
                @method('DELETE')
                {{csrf_field()}}
                <div class="form-group">
                    <label for="name_procedure">เลือก Procedure</label>
                    <select class="form-control" data-choices name="choices-single-default" placeholder="Procedure">
                        <option value="">Procedure</option>
                        @foreach ($procedure_all as $data)
                            <option value="{{@$data->code}}">{{@$data->name}}</option>
                        @endforeach
                    </select>
                    <small id="name_procedure" class="form-text text-muted">ชื่อ Procedure ที่ต้องการแก้ไข</small>
                </div>

                <div class="form-group mt-2">
                    <label for="nameprocedure">ชื่อ Procedure</label>
                    <input type="text" class="form-control" id="sp_name_edit" name="sp_name">
                    <small id="nameprocedure" class="form-text text-muted">ชื่อ Procedure</small>
                </div>
                <div class="form-group">
                    <label for="procedureblade">ชื่อไฟล์</label>
                    <input type="text" class="form-control" id="sp_file_edit" name="sp_file">
                    <small id="procedureblade" class="form-text text-muted">ชื่อไฟล์ Procedure .Blade</small>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-warning" name="btn_edit" value="1" style="width: 100%;">แก้ไข</button>
                </div>
                <div class="form-group mt-3">
                    <button type="submit" class="btn btn-danger" name="btn_del" value="1" style="width: 100%;">ลบ</button>
                </div>
            </form>
        </div>
      </div>
    </div>
</div>
@endsection

@section('title-left')
    <h4 class="mb-sm-0">PROCEDURE SETTING</h4>
@endsection
@section('title-right')
    <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><a href="javascript: void(0);">PROCEDURE SETTING</a></li>
        <li class="breadcrumb-item active">Setting</li>
    </ol>
@endsection
@section('modal')

@endsection
@section('content')
<div class="row m-0">
    <div class="col-lg-3 px-1">
        <div class="card card-bg mb-3 bg-dark-primary">
            <div class="card-body">
                <div class="text-white h3">EGD</div>
                <div class="text-white h6 mt-4">Modality : ES</div>
                <div class="text-white h6">Last modified : 06 Apr, 2021</div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <h5>Setting Menu</h5>
                <div class="nav flex-column nav-pills text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    {{-- <a class="nav-link mb-2 border p-2 text-start ps-4 @if($tab=='general') active @endif" id="general-information-tab" data-bs-toggle="pill" href="#general-information" role="tab" aria-controls="general-information" aria-selected="true">General Information</a> --}}
                    {{-- <a class="nav-link mb-2 border p-2 text-start ps-4" id="physician-record-tab" data-bs-toggle="pill" href="#physician-record" role="tab" aria-controls="physician-record" aria-selected="false">Physician Record</a> --}}
                    {{-- <a class="nav-link mb-2 border p-2 text-start ps-4" id="nurse-record-tab" data-bs-toggle="pill" href="#nurse-record" role="tab" aria-controls="nurse-record" aria-selected="false">Nurse Record</a> --}}
                    {{-- <a class="nav-link mb-2 border p-2 text-start ps-4" id="accessory-record-tab" data-bs-toggle="pill" href="#accessory-record" role="tab" aria-controls="accessory-record" aria-selected="false">Accessory Record</a> --}}
                    <a class="nav-link mb-2 border p-2 text-start ps-4 active" id="pdf-physician-tab" data-bs-toggle="pill" href="#pdf-physician" role="tab" aria-controls="pdf-physician" aria-selected="false">PDF Physician</a>
                    {{-- <a class="nav-link mb-2 border p-2 text-start ps-4" id="pdf-nurse-tab" data-bs-toggle="pill" href="#pdf-nurse" role="tab" aria-controls="pdf-nurse" aria-selected="false">PDF Nurse</a> --}}
                    {{-- <a class="nav-link mb-2 border p-2 text-start ps-4" id="pdf-billing-tab" data-bs-toggle="pill" href="#pdf-billing" role="tab" aria-controls="pdf-billing" aria-selected="false">PDF Billing</a> --}}
                    {{-- <a class="nav-link mb-2 border p-2 text-start ps-4" id="pdf-appoint-tab" data-bs-toggle="pill" href="#pdf-appoint" role="tab" aria-controls="pdf-appoint" aria-selected="false">PDF Appoint</a> --}}
                    {{-- <a class="nav-link mb-2 border p-2 text-start ps-4" id="pdf-health-record-tab" data-bs-toggle="pill" href="#pdf-health-record" role="tab" aria-controls="pdf-health-record" aria-selected="false">PDF Health Record</a> --}}
                    {{-- <a class="nav-link mb-2 border p-2 text-start ps-4" id="data-dictionary-tab" data-bs-toggle="pill" href="#data-dictionary" role="tab" aria-controls="data-dictionary" aria-selected="false">Data Dictionary</a> --}}
                    {{-- <a class="nav-link mb-2 border p-2 text-start ps-4" id="data-post-diagnosis-tap" data-bs-toggle="pill" href="#data-post-diagnosis" role="tab" aria-controls="data-post-diagnosis" aria-selected="false">Post-Diagnosis</a> --}}









                    <a class="nav-link mb-2 border p-2 text-start ps-4" id="data-post-diagnosis-tap" data-bs-toggle="pill" href="#data-post-diagnosis" role="tab" aria-controls="data-post-diagnosis" aria-selected="false">Brief History</a>


                </div>
                <div class="col-12 text-center mt-3">
                    <a href="{{url('admin/procedure')}}" class="btn btn-primary waves-effect waves-light"> Back to list</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-9 px-1">
        <div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent">
            <div class="tab-pane fade @if($tab=='general') @endif" id="general-information" role="tabpanel" aria-labelledby="general-information-tab"> <!-- show active -->
                @component('admin.procedure.components.general_information',['data' => $procedure]) @endcomponent
            </div>
            {{-- <div class="tab-pane fade" id="physician-record" role="tabpanel" aria-labelledby="physician-record-tab">
                @component('admin.procedure.components.physician_record', ['procedure_code' => $procedure['code']]  ) @endcomponent
            </div>
            <div class="tab-pane fade" id="nurse-record" role="tabpanel" aria-labelledby="nurse-record-tab">
                @component('admin.procedure.components.nurse_record') @endcomponent
            </div>
            <div class="tab-pane fade" id="accessory-record" role="tabpanel" aria-labelledby="accessory-record-tab">
                @component('admin.procedure.components.accessory_record') @endcomponent
            </div> --}}
            <div class="tab-pane fade active show" id="pdf-physician" role="tabpanel" aria-labelledby="pdf-physician-tab">
                @include('admin.procedure.components.pdf_physician')
            </div>
            {{-- <div class="tab-pane fade" id="pdf-nurse" role="tabpanel" aria-labelledby="pdf-nurse-tab">
                @component('admin.procedure.components.pdf_nurse') @endcomponent
            </div>
            <div class="tab-pane fade" id="pdf-billing" role="tabpanel" aria-labelledby="pdf-billing-tab">
                @component('admin.procedure.components.pdf_billing') @endcomponent
            </div>
            <div class="tab-pane fade" id="pdf-appoint" role="tabpanel" aria-labelledby="pdf-appoint-tab">
                @component('admin.procedure.components.pdf_appoint') @endcomponent
            </div>
            <div class="tab-pane fade" id="pdf-health-record" role="tabpanel" aria-labelledby="pdf-health-record-tab">
                @component('admin.procedure.components.pdf_health_record') @endcomponent
            </div>
            <div class="tab-pane fade" id="data-dictionary" role="tabpanel" aria-labelledby="data-dictionary-tab">
                @component('admin.procedure.components.data_dictionary') @endcomponent
            </div>
            <div class="tab-pane fade active  " id="data-post-diagnosis" role="tabpanel" aria-labelledby="data-post-diagnosis-tap">
                <div class="card p-4">
                    @component('admin.procedure.components.custom_icd9') @endcomponent
                </div>

            </div> --}}

            <input id="autoCompleteFruit" hidden>
            <input id="autoCompleteCars" hidden>
            <button id="back-to-top" hidden></button>
        </div>
    </div>
</div>
<input type="hidden" name="" id="change_setting">
@endsection

@section('script')
<script src="{{url("public/assets5/libs/multi.js/multi.min.js")}}"></script>
<script src="{{url("public/assets5/libs/@tarekraafat/autocomplete.js/autoComplete.min.js")}}"></script>
<script src="{{url("public/assets5/js/pages/form-advanced.init.js")}}"></script>
<script src="{{url("public/assets5/js/pages/form-input-spin.init.js")}}"></script>
<script src="{{url("public/assets5/libs/dropzone/dropzone-min.js")}}"></script>
<script src="{{url("public/assets5/libs/filepond/filepond.min.js")}}"></script>
<script src="{{url("public/assets5/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js")}}"></script>
<script src="{{url("public/assets5/libs/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js")}}"></script>
<script src="{{url("public/assets5/libs/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js")}}"></script>
<script src="{{url("public/assets5/libs/filepond-plugin-file-encode/filepond-plugin-file-encode.min.js")}}"></script>
<script src="{{url("public/assets5/js\pages\apps-nft-create.init.js")}}"></script>
<script src="{{url("public/js/sweetalert2@11.js")}}"></script>

<script src="{{url("public/js/jquery-ui.js")}}"></script>

<script>
    $("#procedure_name_show").keyup(function(){
        var this_name = $(this).val()
        $("#procedure_name").val(this_name)

    })
    $("#procedure_name").keyup(function(){
        var this_name = $(this).val()
        $("#procedure_name_show").val(this_name)
    })
    $('.ck-template').click(function(){
        var id = $(this).val()
        $(".template").removeClass('border-select')
        $('#'+id).addClass('border-select')
    })
    $('.ck-body').click(function(){
        var id = $(this).val()
        $(".body").removeClass('border-select')
        $('#'+id).addClass('border-select')
    })
    $(".box-img").click(function(){
        $('.box-img').removeClass('active')
        $(this).addClass('active')
    })
    $(".make-form").change(function(e){
        var this_id = e.target.id;
        var num = this_id.replace('case_inp', '')
        if($(this).is(":checked")){
            generate_form(this_id)
        }else{
            console.log('remove' + this_id, num);
            remove_form(num)
        }
    })
</script>
<script>

    const input = document.getElementById('drop_file');
    const pond = FilePond.create(input);
    pond.setOptions({
        maxFiles: 6,
        allowMultiple: true,
        allowImagePreview: false
    });

    pond.on('addfile', (error, file) => {
        if (error) {
            console.log('Oh no');
            return;
        }

        num = 1
        for(i=1;i<=$('.box-img').length;i++){
            let preview = $(`#image0${i}div`).find('.img-preview').get()
            console.log(preview);
            if(preview.length == 0){
                num = i
                break
            }
        }

        let type = file.source.type
        if(type.includes('image')){
            $(`#image0${num}div`).append(`<img id="output${i}" class="img-preview" style="width:100%;height:100%;" src="" alt="">`)
            var output = document.getElementById(`output${i}`)
            output.src = URL.createObjectURL(file.source)
            output.onload = function() {
                URL.revokeObjectURL(output.src)
            }
        }
    });

</script>

<script>
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

    var procedure_code = '{{$procedure->code}}'

    // physician
    function select_pdset(value, id){
        let selected_arr = $(`#${id} :selected`).map(function(i, el) {
            return $(el).val();
        }).get();
        let json = JSON.stringify(selected_arr)
        $.post("{{url('endo')}}/procedure-setting",
            {
                event          : "edit_procedure",
                procedure_code : procedure_code,
                procedure_set  : json,
            },
            function(data, status)
            {
                console.log(data);
            });
    }


    function save_case(){
        let nav_lg = $('.dragnav').length
        let preview_nav = []
        let preview_num = []
        for(i=0;i<nav_lg;i++){
            let nav_id = $($(`.dragnav`)[i]).attr('id')
            let nav_num = nav_id.replace('head_case_inp', '')
            preview_nav.push(nav_num)

            let form_lg = $(`#row_case_inp${nav_num} .field-form`).length
            let preview_sub = []
            for(j=0;j<form_lg;j++){
                let form_id = $($(`#row_case_inp${nav_num} .field-form`)[j]).data('field')
                preview_sub.push(form_id)
            }
            preview_num.push(preview_sub)
        }

        let json = JSON.stringify(preview_num)
        let nav_json = JSON.stringify(preview_nav)
        console.log(preview_num, preview_nav);
        console.log(json, nav_json);

        $.post("{{url('endo')}}/procedure-setting",
            {
                event          : "edit_physician_record",
                procedure_code : procedure_code,
                procedure_json : json,
                nav            : nav_json
            },
            function(data, status)
            {
                let parse = JSON.parse(data)
                console.log(data, parse);
                if(parse.status == 1){
                    Swal.fire('ทำการบันทึกเสร็จสิ้น')
                }
            });
    }

    function convert_name(name) {
        let str = name.replaceAll('_', ' ')
        let exp = str.split(' ')
        let to_upper = ''
        exp.forEach((e) => {
            let txt = ''
            if(e[0] == '('){
                let first_letter = e[1]
                let upper_first_letter = first_letter.toUpperCase()
                txt = e.replace(first_letter, upper_first_letter)
            } else {
                txt = cap_first_letter(e)
            }
            to_upper = to_upper+txt+' '
        })
        to_upper = to_upper.trim()
        return to_upper
    }

    function cap_first_letter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

    $(".ck-append").click(function(){
        alert()
    })
</script>
@endsection
