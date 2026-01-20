<div id="modal_sendto" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Send to</h5>
                <button type="button" id="sendto_close" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="border-bottom"></div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-8">
                        <span class="text-muted">Select your destination</span>
                    </div>
                    <div class="col-4 text-end" onclick="refresh_drive()">
                        <a href="javascript:;" class="p-1 fs-14 align-middle">Refresh <i id="refresh_drive" class="ri-refresh-line align-middle"></i></a>
                    </div>
                </div>
                @php

                $pacs = getCONFIG("pacs");
                @endphp


                <div class="row p-3">
                    <div class="form-check">
                        <input class="form-check-input" name="send_to" value="pacs" type="checkbox" id="formCheck1" checked>
                        <label class="form-check-label" for="formCheck1">
                            &ensp; PACs Server ({{@$pacs->pacsserver}})
                            <span class="d-block text-muted">  &ensp; Report and Photo</span>
                        </label>
                    </div>
                    @isset($disk_store)
                    @foreach($disk_store as $index=>$d)
                        @php
                            $disk = $d;
                            $drivename = isset($disk['drive']) ? str_replace('\\', '', $disk['drive']) : '';
                        @endphp
                        @if($drivename == '')
                            @php continue;  @endphp
                        @endif
                        <div class="form-check">
                            <input type="hidden" id="disk_name" value="{{@$drivename}}">
                            <div class="row">
                                <div class="col-8">
                                    <input class="form-check-input disk-name"  name="send_to" type="checkbox" value="pdf" id="{{@$drivename}}" data-disk="{{@$drivename}}">
                                    <label class="form-check-label" for="{{@$drivename}}">
                                        &ensp; Drive_Store ({{@$drivename}})
                                        <span class="d-block text-muted">  &ensp; Report and Photo</span>
                                    </label>
                                </div>
                                <div class="col-4">
                                    <span class="badge badge-soft-success status-badge" id="pdf_success{{@$index}}" style="display: none">SUCCESS</span>
                                    <span class="badge badge-soft-warning status-badge" id="pdf_pending{{@$index}}" style="display: none">PENDING</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    @endisset

                </div>


                {{-- <div class="row p-3" id="drive_list">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="formCheck1" checked>
                        <label class="form-check-label" for="formCheck1">
                            &ensp; Drive_Store ()
                            <span class="d-block text-muted">  &ensp; Report and Photo</span>
                        </label>
                    </div>
                </div> --}}
                {{-- <div class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-6">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="procedure_check1">
                                    <label class="form-check-label" for="procedure_check1">
                                        &ensp;  EGD
                                    </label>
                                </div>
                            </div>
                            <div class="col-6">
                                <span class="badge rounded-pill badge-soft-success fw-normal">Final</span>
                                 <a href="{{url("")}}"> &ensp; &ensp; <i class="ri-eye-fill"></i></a>
                            </div>
                            <div class="col-6">
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="checkbox" id="procedure_check2">
                                    <label class="form-check-label" for="procedure_check2">
                                        &ensp;  Colonoscopy
                                    </label>
                                </div>
                            </div>
                            <div class="col-6">
                                <span class="badge rounded-pill badge-soft-warning fw-normal">Draft</span>
                                 <a href="{{url("")}}"> &ensp; &ensp; <i class="ri-eye-fill"></i></a>
                            </div>
                        </div>
                    </div>

                </div> --}}
                <div class="hide-select">
                    <span class="text-muted">Select your file</span>
                    <div class="row">
                        <div class="col-4 mt-2 text-center p-2">
                                <div class="form-check mb-2  " style="border: 1px solid #D9D9D9;">
                                    <input class="form-check-input text-center " type="checkbox" id="formCheck4" checked>
                                    <label class="form-check-label " for="formCheck4">
                                        <i class="ri-dossier-fill ms-4 ri-4x text-color-index "></i><br>
                                    </label>
                                </div>
                            <span class="text-muted">Report</span>
                        </div>
                        <div class="col-4 mt-2 text-center p-2">
                            <div class="form-check mb-2  " style="border: 1px solid #D9D9D9;">
                                <input class="form-check-input text-center " type="checkbox" id="formCheck5">
                                <label class="form-check-label " for="formCheck5">
                                    <i class="ri-image-2-fill ms-4 ri-4x text-color-index "></i><br>
                                </label>
                            </div>
                        <span class="text-muted">Photo</span>
                        </div>
                        <div class="col-4 mt-2 text-center p-2">
                            <div class="form-check mb-2  " style="border: 1px solid #D9D9D9;">
                                <input class="form-check-input text-center " type="checkbox" id="formCheck6">
                                <label class="form-check-label " for="formCheck6">
                                    <i class="ri-video-fill ms-4 ri-4x text-color-index "></i><br>
                                </label>
                            </div>
                        <span class="text-muted">Video</span>
                        </div>
                    </div>
                    <span class="text-muted" id="total_text"> <span id="select_item">0</span> Selected items | total Size <span id="files_size_txt">0.00 mb</span> </span>
                </div>
            </div>
            <div id="divpacs" class="row align-self-center" style="display: none">
                <div class="col-3 ">
                    <div class="avatar-sm  text-ALCENTER">
                        <span id="icon_prepare" class="avatar-title bg-primary rounded-circle fs-2">
                            <i class="ri-file-copy-line "></i>
                        </span>
                    </div>
                    <span class="text-nowrap">Preparing File</span>
                </div>

                <div class="col-3 pd-1 text-center">
                    <div class="avatar-sm text-ALCENTER">

                        <span id="icon_dicom_start" class="avatar-title bg-soft-info rounded-circle fs-2">
                            <i class=" ri-image-2-line icon-text"></i>
                        </span>

                        <span id="icon_dicom_end" class="avatar-title bg-primary rounded-circle fs-2" style="display: none">
                            <i class=" ri-image-2-line "></i>
                        </span>
                    </div>
                    <span class="text-nowrap">DICOM Ready</span>
                </div>



                <div class="col-3 pd-1 text-center">
                    <div class="avatar-sm text-ALCENTER">
                        <span id="icon_sending_start" class="avatar-title bg-soft-info rounded-circle fs-2">
                            <i class=" ri-arrow-left-right-fill icon-text"></i>
                        </span>

                        <span id="icon_sending_end" class="avatar-title bg-primary rounded-circle fs-2" style="display: none">
                            <i class=" ri-arrow-left-right-fill"></i>
                        </span>
                    </div>
                    <span class="text-nowrap"> PACs Sending</span>
                </div>
                <div class="col-3 pd-1 text-center">
                    <div class="avatar-sm text-ALCENTER">

                        <span id="icon_finish_start" class="avatar-title bg-soft-info rounded-circle fs-2">
                            <i class=" ri-check-double-fill icon-text"></i>
                        </span>

                        <span id="icon_finish_end" class="avatar-title bg-primary rounded-circle fs-2" style="display: none">
                            <i class=" ri-check-double-fill"></i>
                        </span>
                    </div>
                    <span class="text-nowrap">   Finished</span>
                </div>



            </div>
            <div class="col-12 text-center mt-3">
                {{-- <button id="dicom_photopdf" type="button" class="btn btn-primary w-75 mb-4 dicom hide-btn">Confirm Sending</button> --}}
                <button id="confirm_sendto" type="button" class="btn btn-primary w-75 mb-4 dicom hide-btn">Confirm Sending</button>
                <button id="show-finish" type="button" class="btn btn-success w-75 mb-4 " style="display: none;" >Finish</button>

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

    $('.dicom').click(function(){
        $(".hide-select").hide();
    });

    $('.dicom').click(function() {
        // alert('PDF');
        let type = $('input[name^="send_to"]').filter(":checked").map(function () {
            return this.value;
        }).get()
        console.log(type, 'dddd');
        if(type.includes('pacs')){
        // if(true){
            $("#divpacs").fadeIn(1000);
            $(".hide-btn").hide();

            // var id  = $(this).attr('id');
            var id = "dicom_photopdf";
            var url = "{{$pdf_url}}";
            var text = '';
            // $.post("{{url('api/pacspython')}}", {
            $.post("http://endoindex/endoindex/api/pacspython", {
                event           : id,
                url             : url,
                hn              : "{{ $casedata->hn }}",
                folderdate      : "{{ $folderdate }}",
                cid             : "{{ $cid }}",
                pacs_caseuniq   : "{{ $casedata->caseuniq }}",
                pacs_comcreate  : "{{ $casedata->comcreate }}",
            }, function(data, status) {
                console.log(data);
                var json = JSON.parse(data);
                console.log(json.status);
                if(json.status=="success"){
                    $("#icon_dicom_start").hide();
                    $("#icon_dicom_end").show();

                    send_pacs();
                }
            });
        }

        if(type.includes('pdf') || true){

            let alldisk = $('.disk-name:checkbox:checked').map(function() {
                return this.id;
            }).get();
            $('#pdf_warning').css('display', 'block')
            console.log(alldisk);
            // $.post("{{url('api/siphconnect')}}", {
            $.post("http://endoindex/endoindex/api/siphconnect", {
                event           : "send_pdf",
                hn              : "{{ $casedata->hn }}",
                doctor          : "{{ @$casedata->case_physicians01 }}",
                folderdate      : "{{ $folderdate }}",
                cid             : "{{ $cid }}",
                pacs_caseuniq   : "{{ $casedata->caseuniq }}",
                pacs_comcreate  : "{{ $casedata->comcreate }}",
                accessno        : "{{ @$casedata->accessionno }}",
                diskname        : alldisk,
                procedure       : "{{ @$casedata->procedurename }}",
            }, function (data, status) {
                console.log(data);
                var json = JSON.parse(data);
                if(json.status == 'success'){
                    alldisk.forEach((e, i) => {
                        $(`#pdf_success${i}`).css('display', 'block')
                        $(`#pdf_warning${i}`).css('display', 'none')
                    });
                }
            })
        }
    });

    $('#show-finish').click(function() {
        location.reload();
    });

    $("#modal_sendto").on("hide.bs.modal", function () {
        $('#pdf_success').css('display', 'none')
        $('#pdf_warning').css('display', 'none')
    });



    function send_pacs(){
        // $.post("{{url('api/pacspython')}}",{
        $.post("http://endoindex/endoindex/api/pacspython",{
            event           : 'send_pacs',
            cid             : "{{$cid}}",
            pacs_caseuniq   : "{{ $casedata->caseuniq }}",
            pacs_comcreate  : "{{ $casedata->comcreate }}",
            hn              : "{{ $casedata->hn }}"
        },function(data, status) {
            console.log(data);
            var json = JSON.parse(data);
            console.log(json.status);
            if(json.status=="success"){
                $("#icon_sending_start").hide();
                $("#icon_sending_end").show();
                $("#icon_finish_start").hide();
                $("#icon_finish_end").show();
                $("#show-finish").show();

                // send_pacs();
            }
        });
    }

</script>



<script src="http://{{ $_SERVER['SERVER_NAME'] }}:3000/socket.io/socket.io.js"></script>
<script>
    var socket = io.connect('http://{{ $_SERVER['SERVER_NAME'] }}:3000');

    $('#modal_sendto').on('shown.bs.modal', function (e) {
        // socket.emit('chat message',"read_drive");
        $('.status-badge').css('display', 'none')
    })

    socket.on('chat message', function (msg) {
        if(msg.includes('drive')){
            try {
                $('#drive_list').empty()
                var parse = JSON.parse(msg)
                console.log(parse);
                parse.forEach( (e,i) => {
                    var drive_name = (e.drive != undefined || e.drive != '') ? (e.drive).replace(/[^a-zA-Z0-9 ]/g, '') : ''
                    var free_space = (e.free != undefined  || e.free != '')  ? e.free  : ''
                    $('#drive_list').append(`
                        <div class="form-check mt-2 each-drive">
                            <div class="col-11">
                                <div class="row">
                                    <div class="col-11">
                                        <input class="form-check-input" type="checkbox" name="disk_name" value="${drive_name}" type="checkbox" id="ck${i}" onclick="check_drive()">
                                        <label class="form-check-label" for="formCheck1">
                                            &ensp; ${drive_name} Flash Drive(${drive_name}:)
                                            <span class="d-block text-muted">  &ensp; Available space : <span id="free_space${i}">${free_space}</span> GB</span>
                                            <p id="check_space${i}" style="color:black" ></p>
                                        </label>
                                    </div>
                                    <div class="col-1">
                                        <i id="status_${drive_name}" class="h2 ri-indeterminate-circle-fill text-warning m-0" style="display:none"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="col-1"></div>
                        </div>
                        <br>
                    `)
                });
            } catch (error) {
                console.log(error);
                // alert(error)
            }
        }
    })

    function refresh_drive() {
        // socket.emit('chat message',"read_drive");
    }
</script>
