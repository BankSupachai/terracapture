<div class="row">
    <div class="col-6 mb-2">
        <h4><b>Send to PACs</b></h4>
    </div>
    <div class="col-6 mb-2" style="display: flex; justify-content: flex-end">
        <span class="switch switch-icon">
        <label class="switch">
            <b>Send Status&nbsp;&nbsp;</b>
            <input
            type    ="checkbox"
            class   ="jsonboxSAVE"
            id      ="pacs_send_status"
            name    ="pacs_send_status"
            @if(@$json->pacs_send_status)
            checked
            @endif
            >
            <span></span>
        </label>
    </div>
    <div class="col-4" style="height:100%;">
        <button id="dicom_pdf" class="btn btn-warning text-center dicom" style="width: 100%;height:100%;">
            <i class="far fa-file-pdf"></i><br> PDF
        </button>
    </div>
    <div class="col-4" style="height:100%;">
        <button id="dicom_photo" class="btn btn-success text-center dicom" style="width: 100%;height:100%;">
            <i class="far fa-file-image"></i><br> PHOTO
        </button>
    </div>
    <div class="col-4" style="height:100%;">
        <button id="dicom_photopdf" class="btn btn-info text-center dicom" style="width: 100%;height:100%;">
            <i class="far fa-file-pdf"></i>&nbsp;
            <i class="fas fa-plus"></i>
            <i class="far fa-file-image"></i><br>
            PHOTO + PDF
        </button>
    </div>
    <div class="col-12 mt-2">
        @if(isset($casedata->case_pacs))
        @php
            $pacs = jsonDecode($casedata->case_pacs);
        @endphp
        @foreach ($pacs as $pc)
        @if(isset($pc->user))
            <div class="row m-0 mt-2">
                <div class="col-4">{{$pc->user}}</div>
                <div class="col-4">{{$pc->when}}</div>
                <div class="col-4">{{$pc->hn}}</div>
            </div>
        @endif
        @endforeach
        @endif
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

    $('.dicom').click(function() {
        $("#modal_process").modal('show')
        var id  = $(this).attr('id');
        var url = "{{$pdf_url}}";
        var text = '';
        $.post("{{url('api/pacspython')}}", {
            event           : id,
            url             : url,
            hn              : "{{ $casedata->hn }}",
            folderdate      : "{{ $folderdate }}",
            pacs_caseuniq   : "{{ $casedata->caseuniq }}",
            pacs_comcreate  : "{{ $casedata->comcreate }}",
        }, function(data, status) {
            if(data.length===8){
                $($('.modal-process')[1]).addClass('check');
                send_pacsx("{{ $casedata->hn }}","{{ $casedata->caseuniq }}")
            }else{
                $('.modal-process').addClass('delete');
                $('#process_btn').addClass('active');
            }
        });
    });


    function send_pacsx(hn,id){
        $.post("{{url('api/pacspython')}}",{
            event       : 'send_pacs',
            hn          : hn,
            name        : "{{uget("user_firstname")}}",
            id          : id
        },function(data, status) {
            if(data==hn){
                $($('.modal-process')[2]).addClass('check');
                setTimeout(() => {
                    $($('.modal-process')[3]).addClass('check');
                }, 300);
            }else{
                $($('.modal-process')[2]).addClass('delete');
                $($('.modal-process')[3]).addClass('delete');
            }
            $('#process_btn').addClass('active');
        })
    }

</script>
