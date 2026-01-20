@php
    $pacs = getCONFIG('pacs');
    $pdfdisk = str_replace(':\\', '', @$lumina->pdf_path . '');

    $pdf_type = @$_GET['type'];
    if (isset($_GET['type'])) {
        $pdf_type = $_GET['type'];
    } else {
        $pdf_type = '';
    }
    $app_url = url('');
    $pdf_url = "$app_url/api/pdf?id=$id+type=$pdf_type";
@endphp

<style>
    .btn-status-pacs {
        color: #245788;
        background: #2457881A;
        width: 86.76px;

    }

    .btn-status-pacs:hover {
        color: #245788;
        background: #2457881A;
    }

    .text-spin-primary {
        color: #245788;
    }

    .badge-soft-blue {
        color: #245788;
        background: #2457881A;

    }
</style>

<div id="modal_sendto" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content">
            <div class="modal-header">
                <span class="modal-title h5" id="myModalLabel">Send to</span>
                <button type="button" id="sendto_close" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="border-bottom"></div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-8">
                        <span class="text-muted">Select your destination </span>
                    </div>
                    <div class="col-4 text-end " onclick="refresh_drive()">
                        <a href="javascript:;" class="p-1 fs-14 align-middle ">
                            <span class="text-spin-primary">Refresh</span>
                            <i id="refresh_drive" class="ri-refresh-line align-middle"></i></a>
                    </div>
                </div>
                <div class="row py-3">
                    @include('reportendocapture.component.feature.softcon')
                    @include('reportendocapture.component.feature.vna')
                    @include('reportendocapture.component.feature.pacs')
                    @include('reportendocapture.component.feature.emrsiph')
                    @include('reportendocapture.component.feature.emr')
                </div>
                <div class="">
                    @include('reportendocapture.component.feature.sendtype')
                </div>
            </div>
        </div>
    </div>
</div>



<script>
    $('#show-finish').click(function() {
        location.reload();
    });
    $("#modal_sendto").on("hide.bs.modal", function() {
        $('#pdf_success').css('display', 'none')
        $('#pdf_warning').css('display', 'none')
    });
    $('#modal_sendto').on('shown.bs.modal', function(e) {
        $('.status-badge').css('display', 'none')
        $('.focus').focus();
    })
</script>


<script>
    var haveval = false;

    $(".input_assesion").keyup(function() {
        if ($(this).val().trim() !== '') {
            haveval = true;
            $(".btn-verify").css("background-color", "#245788");
        } else {
            haveval = false;
            $(".btn-verify").css("background-color", "#bbbbbb");
            $(".verify-btn").css('display', 'block')
            $(".verify-btn").css('background-color', '#245788')
            $(".verify-btn").prop('disabled', false)
        }
    });


    $('.dicom').click(function() {
        let type = $('input[name^="send_to"]').filter(":checked").map(function() {
            return this.value;
        }).get();
        if (type.includes('pacs')) {
            $("#pacsreload").css('display', 'flex');
        }
        if (type.includes('vna')) {
            $("#vnareload").css('display', 'flex');
        }
        if (type.includes('softcon')) {
            $("#softconreload").css('display', 'flex');
        }

    });

    $('.dicom').click(function() {
        let type = $('input[name^="send_to"]').filter(":checked").map(function() {
            return this.value;
        }).get();
        if (type.includes('vna')) {
            create_vna();
        }
        if (type.includes('softcon')) {
            create_softcon();
        }
        if (type.includes('pacs')) {
            create_dicom();
        }
        if (type.includes('pdf')) {
            send_pdf();
        }
        if ($('#video_sendto').is(':checked')) {
            send_video();
        }
    });

    function send_video() {
        var video_drive = $('.disk-name:checked').map(function() {
            return this.id;
        }).get();

        $.post("{{ url('api/sendto') }}", {
            event: "send_video",
            drive: video_drive,
            cid: '{{ @$cid }}',
        }, function(data, status) {
            $('#pacsreload').hide()
            if (data == 1 || data == "1") {
                $('#pacssuccess').show()
            } else {
                $('#pacsnotsuccess').show()
            }
        })
    }


    $("#btn_vna_encounter").click(function() {
        $("#vna_encounter").show();
    });



    function create_softcon() {
        // ยังทำไม่เสร็จ
        let sendtype = "";
        $("input:checkbox[name=pacs_type]:checked").each(function() {
            sendtype = sendtype + $(this).val();
        });

        if (sendtype != "") {

            if (sendtype != "nursereport") {
                $("#softconsuccess").hide();
                $("#softconnotsuccess").hide();
                $("#softconnotsuccess_text").hide();
                $.post("{{ url('api/softcon') }}", {
                    event: "sendphoto2softcon",
                    cid: "{{ $casedata->id }}",
                    sendtype: sendtype,
                }, function(data, status) {
                    const obj = JSON.parse(data);
                    $("#softconreload").css('display', 'none');
                    if (obj.Status == "success") {
                        $("#softconsuccess").show();
                        $("#show-finish").show();
                        $("#confirm_sendto").hide();
                    } else {
                        $("#softconnotsuccess_text").show();
                        $("#softconnotsuccess").show();
                        $("#softconnotsuccess_text").html(obj.Message);
                    }
                });
            }


            if (sendtype == "nursereport") {
                $("#softconsuccess").hide();
                $("#softconnotsuccess").hide();
                $("#softconnotsuccess_text").hide();
                $.post("{{ url('api/softcon') }}", {
                    event: "sendphoto2softcon",
                    cid: "{{ $casedata->id }}",
                    sendtype: sendtype,
                }, function(data, status) {
                    const obj = JSON.parse(data);
                    $("#softconreload").css('display', 'none');
                    if (obj.Status == "success") {
                        $("#softconsuccess").show();
                        $("#show-finish").show();
                        $("#confirm_sendto").hide();
                    } else {
                        $("#softconnotsuccess_text").show();
                        $("#softconnotsuccess").show();
                        $("#softconnotsuccess_text").html(obj.Message);
                    }
                });
            }
        }
    }


    function create_vna() {
        // ยังทำไม่เสร็จ
        let vnatype = "vna_";
        $("input:checkbox[name=pacs_type]:checked").each(function() {
            vnatype = vnatype + $(this).val();
        });
        if (vnatype != "vna_") {
            $("#vnasuccess").hide();
            $("#vnanotsuccess").hide();
            $("#vnanotsuccess_text").hide();

            var id = vnatype;
            // var cid             = "{{ $cid }}";
            var url = "{{ $pdf_url }}";
            var vna_usercode = $('#vna_usercode').val();
            var vna_procedure = "{{ $casedata->procedurename }}";
            var vna_comment = $("#vna_comment").val();
            var vna_physician = "{{ @$doctorname }}";
            var vna_age = "{{ @$json->age }}";
            var vna_hn = "{{ $casedata->case_hn }}";
            let pdf_type = $('.pdf-type:checked').data('type')
            console.log(vna_procedure, vna_usercode, vnatype, pdf_type);
            $.post("{{ url('api/ramaconnect') }}", {
                event: id,
                url: url,
                caseid: "{{ $cid }}",
                vna_usercode: vna_usercode,
                vna_procedure: vna_procedure,
                vna_hn: vna_hn,
                vna_comment: vna_comment,
                vna_physician: vna_physician,
                vna_encounter: $("#vna_encounter").val(),
                vna_age: vna_age,
                folderdate: "{{ $folderdate }}",
                cid: "{{ $casedata->id }}",
                pacs_caseuniq: "{{ $casedata->caseuniq }}",
                pacs_comcreate: "{{ $casedata->comcreate }}",
                pdf_type: pdf_type,
            }, function(data, status) {
                console.log(data);
                $("#modal_vna").modal("hide");
                const obj = JSON.parse(data);
                if (obj.code == "200") {
                    $("#vnasuccess").show();
                    $("#show-finish").show();
                    $("#confirm_sendto").hide();
                } else {
                    $("#vnanotsuccess_text").show();
                    $("#vnanotsuccess").show();
                    $("#vnanotsuccess_text").html(obj.message);
                }
                $("#vnareload").css('display', 'none');
            });
        }
    }



    function send_pdf() {
        var url = $("#iframepdf").attr('src');
        let alldisk = $('.disk-name:checkbox:checked').map(function() {
            return this.id;
        }).get();
        $('#pdf_warning').css('display', 'block')
        $.post("{{ url('api/siphconnect') }}", {
            event: "send_pdf",
            url: url,
            cid: "{{ $cid }}",
            hn: "{{ $casedata->hn }}",
            doctor: "{{ @$casedata->case_physicians01 }}",
            accessno: "{{ @$casedata->accessionno }}",
            folderdate: "{{ $folderdate }}",
            pacs_caseuniq: "{{ $casedata->caseuniq }}",
            pacs_comcreate: "{{ $casedata->comcreate }}",
            diskname: alldisk,
            procedure: "{{ @$casedata->procedurename }}",
        }, function(data, status) {
            var json = JSON.parse(data);
            if (json.status == 'success') {
                alldisk.forEach((e, aaa) => {
                    let z = e.replace(":", "");
                    $(`#pdf_success${z}`).css('display', 'block')
                    $(`#pdf_warning${z}`).css('display', 'none')
                });
            } else if (json.status == 'No accession number') {
                alldisk.forEach((e, aaa) => {
                    let diskname = json.disk.toLowerCase()
                    if (diskname.includes(e)) {
                        let z = e.replace(":", "");
                        $(`#pdf_success${z}`).css('display', 'none')
                        $(`#pdf_pending${z}`).css('display', 'block')
                        $(`#pdf_pending${z}`).html('ERROR.')
                    }
                });
            }
        })
    }


    function create_dicom() {
        let dicomtype = "dicom_";
        $("input:checkbox[name=pacs_type]:checked").each(function() {
            dicomtype = dicomtype + $(this).val();
        });

        if (dicomtype != "dicom_") {
            // alert("Please select");
            $("#divpacs").fadeIn(1000);
            $(".hide-btn").hide();
            var id = "dicom_photopdf";
            $.post("{{ url('api/pacspython') }}", {
                event: dicomtype,
                cid: "{{ $cid }}",
            }, function(data, status) {
                var json = JSON.parse(data);
                if (json.status == "success") {
                    send_pacs();
                } else {
                    $("#pacsreload").css('display', 'none');
                    $("#pacsnotsuccess").show();
                    $("#icon_dicom_start").hide();
                    $("#icon_dicom_end").show();
                }
            });
        }
    }

    function send_pacs() {
        $.post("{{ url('api/pacspython') }}", {
            event: 'send_pacs',
            cid: "{{ $cid }}",
            pacs_caseuniq: "{{ $casedata->caseuniq }}",
            pacs_comcreate: "{{ $casedata->comcreate }}",
            hn: "{{ $casedata->hn }}"
        }, function(data, status) {
            var json = JSON.parse(data);
            if (json.status == "success") {
                $("#pacsreload").css('display', 'none');
                $("#pacssuccess").show();
                $("#icon_sending_start").hide();
                $("#icon_sending_end").show();
                $("#icon_finish_start").hide();
                $("#icon_finish_end").show();
                $("#show-finish").show();
                $("#confirm_sendto").hide();
            } else {
                $("#pacsreload").css('display', 'none');
                $("#pacsnotsuccess").show();
                $("#icon_dicom_start").hide();
                $("#icon_dicom_end").show();
            }
        });
    }

    $('.btn-verify, .verify-btn').on('click', function() {
        let input = $('.input_assesion').val()
        if (input) {
            $.post("{{ url('api/siphconnect') }}", {
                event: "getinfo_accessionnumber",
                accessno: input,
                cid: "{{ @$cid }}",
                from: 'browser',
            }, function(data, status) {
                let parse = JSON.parse(data)
                if (parse != 'error') {
                    let hn = parse.case_hn ?? ''
                    let patientname = parse.patientname ?? ''
                    let procedurename = parse.procedurename ?? ''
                    let visitno = parse.visitno ?? ''
                    let pdfdisk = "{{ @$pdfdisk }}"
                    $('.hn-detail').html(hn)
                    $('.patientname-detail').html(patientname)
                    $('.procedurename-detail').html(procedurename)
                    $('.visitno-detail').html(visitno)
                    $('.patient-detail-success').css('display', 'block')
                    $('.patient-detail-warning').css('display', 'none')
                    $('.ck-pacs').prop('disabled', false)
                    $(".disk-sap").prop('disabled', false)
                } else {
                    $('.patient-detail-success').css('display', 'none')
                    $('.patient-detail-warning').css('display', 'block')
                }
            })
        }
    })

</script>
