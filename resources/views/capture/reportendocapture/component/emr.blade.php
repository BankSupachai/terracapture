<div class="row">
    <div class="col-12 mb-2">
        <h4><b>Send to EMR</b></h4>
    </div>
    <div class="col-4" style="height:100%;">
        <button id="emr_pdf" class="btn btn-warning text-center emr" style="width: 100%;height:100%;">
            <i class="far fa-file-pdf"></i><br> PDF
        </button>
    </div>
    <div class="col-4" style="height:100%;">
        <button id="emr_photo" class="btn btn-success text-center emr" style="width: 100%;height:100%;">
            <i class="far fa-file-image"></i><br> PHOTO
        </button>
    </div>
    <div class="col-4" style="height:100%;">
        <button id="emr_photopdf" class="btn btn-info text-center emr" style="width: 100%;height:100%;">
            <i class="far fa-file-pdf"></i>&nbsp;
            <i class="fas fa-plus"></i>
            <i class="far fa-file-image"></i><br>
            PHOTO + PDF
        </button>
    </div>
    <div class="col-12">
        <hr>
    </div>
</div>

@php
    $pdf_type   = @$_GET['type'];
    $app_url    = url("");
    $pdf_url    = "$app_url/api/pdf?id=$id+type=$pdf_type";
@endphp

<script>
    $('.emr').click(function() {
        $("#modal_waitingcreatedicom").modal("show");
        var id  = $(this).attr('id');
        var url = "{{$pdf_url}}";
        var text = '';
        $.post("{{url('api/emr')}}", {
            event           : id,
            url             : url,
            folderdate      : "{{ $folderdate }}",
            pacs_caseuniq   : "{{ $casedata->caseuniq }}",
            pacs_comcreate  : "{{ $casedata->comcreate }}",
        }, function(data, status) {
            $("#modal_waitingcreatedicom").modal("hide");
        });
    });


    function send_pacs(dicom_name){
        var filename = dicom_name
        $.post("{{url('api/pacs')}}",
        {
            event       : 'dicom_pacs',
            name        : filename,
            folderdate      : "{{ $folderdate }}",
            pacs_caseuniq   : "{{ $casedata->caseuniq }}",
            pacs_comcreate  : "{{ $casedata->comcreate }}",
        },
        function(data, status) {
            let send = data
            if(send=='1'){
                Swal.fire("Success", "สร้างไฟล์ Dicom สำเร็จ <br> ส่ง PACs สำเร็จ", "success");
            }else{
                Swal.fire("Warning!", "สร้างไฟล์ Dicom สำเร็จ <br><font class='text-danger'> ส่ง PACs ไม่สำเร็จ</font>", "warning");
            }
        })
    }

</script>
