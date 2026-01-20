<div class="row">

    <div class="col-12">
        <h4><b>Send to VNA</b> &nbsp;
            @isset($json->vna)

            @else
                <font style="color: red">* ยังไม่ได้ทำการส่ง VNA</font>
            @endisset

        </h4>
    </div>
    <div class="col-4" style="height:100%;">
        <button id="vna_pdf" class="btn btn-warning text-center vna" style="width: 100%;height:100%;">
            <i class="far fa-file-pdf"></i>
            <br> PDF
        </button>
    </div>
    <div class="col-4" style="height:100%;">
        <button id="vna_photo" class="btn btn-success text-center vna" style="width: 100%;height:100%;">
            <i class="far fa-file-image"></i>
            <br> PHOTO
        </button>
    </div>
    <div class="col-4" style="height:100%;">
        <button id="vna_photopdf" class="btn btn-info text-center vna" style="width: 100%;height:100%;">
            <i class="far fa-file-pdf"></i>&nbsp;
            <i class="fas fa-plus"></i>
            <i class="far fa-file-image"></i>
            <br> PHOTO + PDF
        </button>
    </div>
    <div class="col-12">
        @isset($json->vna)
            @foreach($json->vna as $vna)
                @if($vna->code =="200")
                    Complete {{$vna->time}}<br>
                @else
                    No complete {{$vna->time}}<br>
                @endif
            @endforeach
        @endisset
        <hr>
    </div>
</div>


<div class="modal fade" id="modal_vna" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content" style="box-shadow: none; border: none;">
            <div class="modal-body row">
                <div class="col-6">
                <input id="vna_filetype" type="hidden">
				<h1>User CODE:</h1>
                </div>

                <div class="col-6" style="display: flex; justify-content: flex-end">
                    <a id="btn_encounter">EncounterID</a>
                </div>

                <div class="col-12">
                    <input id="vna_usercode" class="form-control" autocomplete="off">

                    <div id="div_encounter" style="display:none">
                    <h1>EncounterID:</h1>
                    <input id="vna_encounter" class="form-control" autocomplete="off">
                    </div>
                    <br>
                    <button id="vna_btnsend" class="btn btn-primary btn-block">Send VNA</button>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modal_vna_success" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content" style="box-shadow: none; border: none;">
            <div class="modal-body">
                <center>
                    <h1>ส่งข้อมูล สำเร็จ</h1>
                    <a id="btn_vna_refresh" class="btn btn-success btn-block"> OK</a>
                </center>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal_vna_unsuccess" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered" role="document">
        <div class="modal-content" style="box-shadow: none; border: none;">
            <div class="modal-body">
                <h1>ส่งข้อมูล ไม่สำเร็จ</h1>
                <input type="hidden" id="vna_comment" value="{{ @$json->case_comment }}">
            </div>
        </div>
    </div>
</div>

@php
    $pdf_type   = @$_GET['type'];
    $app_url    = url("");
    $pdf_url    = "$app_url/api/pdf?id=$id+type=$pdf_type";
@endphp

<script>
    $('.vna').click(function() {
        $('#vna_usercode').val("");
        $("#modal_vna").modal("show");
        var id = $(this).attr('id');
        $('#vna_filetype').val(id);

        setTimeout(() => {
            $("#vna_usercode").focus()
        }, 1000);
    });

    $("#btn_vna_refresh").click(function(){
        location.reload();
    });

    $("#btn_encounter").click(function () {
        $("#div_encounter").show();
    });



    $('#vna_btnsend').click(function() {
        var id              = $('#vna_filetype').val();
        var url             = "{{$pdf_url}}";
        var vna_usercode    = $('#vna_usercode').val();
        var vna_procedure   = "{{ @$casedata->procedure_name }}";
        var vna_comment     = $("#vna_comment").val();
        var vna_physician   = "{{ @$doctorname }}";
        var vna_age         = "{{ @$json->age }}";

        $.post("{{ url('api/ramaconnect') }}", {
            event           : id,
            url             : url,
            vna_usercode    : vna_usercode,
            vna_procedure   : vna_procedure,
            vna_comment     : vna_comment,
            vna_physician   : vna_physician,
			vna_encounter   : $("#vna_encounter").val(),
            vna_age         : vna_age,
            folderdate      : "{{ $folderdate }}",
            cid             : "{{ $casedata->case_id}}",
            pacs_caseuniq   : "{{ $casedata->caseuniq }}",
            pacs_comcreate  : "{{ $casedata->comcreate }}",
        }, function(data, status) {
            console.log(data);
            $("#modal_vna").modal("hide");
            const obj = JSON.parse(data);
            if(obj.code=="200"){
                $("#modal_vna_success").modal("show");
            }else{
                $("#modal_vna_unsuccess").modal("show");
            }
        });
    })
</script>
