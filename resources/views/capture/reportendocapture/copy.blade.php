{{-- @extends('layouts.app') --}}
{{-- @extends('layouts.layouts_index.main') --}}
@extends('capture.layoutv6')

@section('title', 'EndoINDEX')

@section('style')

    <style>
        .btn-final {
            background: #3577F1;
            color: #fff;
        }

        .btn-final:hover {
            background: #2a56a8;
            color: #fff;
        }

        .text-red {
            color: #FF0000;
        }

        .icon-text {
            color: #299cdb;
        }

        .text-ALCENTER {
            margin-left: 0.8rem;
        }

        .pd-1 {
            padding-left: 1.5rem;
        }

        #switch_setting {
            cursor: pointer;
        }

        .form-check-input {
            border: 1px solid #000000 !important;
        }

        .form-check-input:disabled {
            opacity: 1 !important;
        }

        .btn-edit {
            background: #f7b84b;
            color: #ffffff;
            width: 80px;
        }

        .btn-edit:hover {
            background: #f7b84b;
            color: #ffffff;
            width: 80px;
        }

        .text-primary {

            color: #192D4B !important;
        }

        /* .btn-position{
                                    position: absolute;
                                    left: 25em;
                                    top: 25em;
                                    z-index: 99999999;
                                } */
    </style>
@endsection

{{-- @section('title-left')
    <h4 class="mb-sm-0">REPORT</h4>
@endsection --}}

{{-- @section('title-right')
    <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><a href="javascript: void(0);">Cases List</a></li>
        <li class="breadcrumb-item active">Report</li>
    </ol>
@endsection --}}







@section('content')

    <div class="row mt-13 ">
        <div class="col-lg  ">
            @php
                if (isset($_GET['type'])) {
                    $type = '&type=' . $_GET['type'];
                } else {
                    $type = '';
                }
            @endphp
            <div class="card">
                {{-- <button id="print-note">print</button> --}}
                <div class="col-12" id="card_setting" style="display: none;">
                    <div class="row m-0">
                        <div class="col-12">
                            <div class="row">
                                @php
                                    $swicth = 'EndoCAPTURE.superadmin.component.switch';
                                    $textbox = 'EndoCAPTURE.superadmin.component.textbox';
                                @endphp
                                @component($swicth, ['type' => 'admin', 'name' => 'PDF findding normal', 'id' => 'pdf_findding_normal'])
                                @endcomponent
                                @component($textbox, ['type' => 'pdf', 'name' => 'PDF Folder HEAD Hospital', 'id' => 'pdf_folder_head'])
                                @endcomponent
                                @component($textbox, ['type' => 'admin', 'name' => 'PDF Procedure pic', 'id' => 'pdf_procedure_pic'])
                                @endcomponent
                                @component($textbox, ['type' => 'admin', 'name' => 'pdf_exit', 'id' => 'pdf_exit'])
                                @endcomponent

                                @component($textbox, ['type' => 'pdf', 'name' => 'pdf_page_margin_top', 'id' => 'pdf_page_margin_top'])
                                @endcomponent
                                @component($textbox, ['type' => 'pdf', 'name' => 'pdf_header_margin_top', 'id' => 'pdf_header_margin_top'])
                                @endcomponent
                                @component($textbox, ['type' => 'pdf', 'name' => 'pdf_content_left_top', 'id' => 'pdf_content_left_top'])
                                @endcomponent
                                @component($textbox, ['type' => 'pdf', 'name' => 'pdf_content_right_top', 'id' => 'pdf_content_right_top'])
                                @endcomponent

                                <div class="col-3">
                                    <h3>pdf_default&emsp;&nbsp;</h3>
                                </div>
                                <div class="col-1"></div>
                                <div class="col-6">
                                    <select id="pdf_default" class="form-control configtext">
                                        {{-- <option value="auto" @if (@$config->pdf_default == 'auto') selected @endif>auto
                                        </option> --}}
                                        <option value="procedure" @if (@$config->pdf_default == 'procedure') selected @endif>
                                            Standard report (8 Pics)</option>

                                        <option value="ent_standard" @if (@$config->pdf_default == 'ent_standard') selected @endif>
                                            ENT report (4 Pics)</option>
                                        <option value="prc_std7" @if (@$config->pdf_default == 'prc_std7') selected @endif>
                                            Standard with procedure picture (7 Pics)</option>
                                        <option value="long_writing" @if (@$config->pdf_default == 'long_writing') selected @endif>
                                            Long writing report (4 Pics)</option>
                                        {{-- <option value="drawing" @if (@$config->pdf_default == 'drawing') selected @endif>
                                            Custom report
                                        </option> --}}
                                        <option value="onlypicture" @if (@$config->pdf_default == 'onlypicture') selected @endif>
                                            Picture only </option>
                                        <option value="pdf_picturebottom" @if (@$config->pdf_default == 'pdf_picturebottom') selected @endif>
                                            Picture bottom </option>

                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    @php
                        $head_line = configTYPE('pdf', 'head_line');
                        $body_line = configTYPE('pdf', 'body_line');
                        $pagetwo = configTYPE('pdf', 'pagetwo');
                    @endphp
                    <div class="row mt-2">
                        <div class="col-3 h3">Head special</div>
                        <div class="col-1"></div>
                        <div class="col-6"><input type="number" name="" id="head_line"
                                class="form-control config_type" config_type="pdf" value="{{ $head_line }}"></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-3 h3">Line special</div>
                        <div class="col-1"></div>
                        <div class="col-6"><input type="number" name="" id="body_line"
                                class="form-control config_type" config_type="pdf" value="{{ $body_line }}"></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-3 h3">Image Page 2</div>
                        <div class="col-1"></div>
                        <div class="col-6"><input type="number" name="" id="pagetwo"
                                class="form-control config_type" config_type="pdf" value="{{ $pagetwo }}"></div>
                    </div>
                    <div class="row mb-3 mt-2">
                        <div class="col text-end">
                            <button class="btn btn-primary" id="open_file_location">Open File Location</button>
                            <a id="pdf_setting_save" class="btn btn-success">Save</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="text-end" style="margin-top: -20px;">
                        <a href="javascript:void(0)" onclick="openPdfFullscreen('{{ url('api/pdf?id=') }}{{ Request::segment(2) }}')" class="btn btn-lg">
                            <i class="ri-fullscreen-fill text-success"></i>
                        </a>
                    </div>
                    <div class="col-12 text-end">
                        <button class="btn btn-outline-primary btn-icon " style="display:none;" id="btn_printnursenote"><i
                                class=" ri-printer-fill"></i></button>
                    </div>
                    <iframe class="" id="iframepdf" src="{{ url("api/pdf/$cid") }}" width="100%"
                        height="1200"></iframe>
                </div>
            </div>
        </div>
        <div class="col-lg-3 hide-content">
            <div class="card ribbon-box">
                {{-- <div class="card-body px-0 py-1">
                    <div class="row m-0 py-0 mb-3">
                        <div class="col-lg-6 p-0 m-0">

                        </div>

                    </div> --}}


                {{--
                    @foreach ($casetoday as $in => $data)
                        @php
                            $data = (object) $data;
                            $folderdate = isset($data->appointment) ? explode(' ', $data->appointment)[0] : '';
                        @endphp


                        <div class="row  m-0">
                            <div class="col-8">
                                <a class="form-check-label" href="{{ url("capture/report/$data->id") }}">
                                    <div class="border p-2 mb-1">
                                        <input type="radio" class="form-check-input mt-1"
                                            id="procedureradio_{{ @$data->id }}" name="radios1" disabled
                                            onclick="change_pdf('case', '{{ @$data->id }}')"
                                            @if ($id == $data->id) checked @endif>
                                        <span>{{ @$data->procedurename }}</span>
                                </a>
                            </div>

                        </div>
                        @php
                            $statusvna = isset($data->vna) ? $data->vna : [];
                            $numpacs = 0;

                        @endphp
                        @if (@$data->statuspacs[$numpacs])
                            <div class="col-auto p-0 m-0 align-self-center">
                                <i class="ri-checkbox-circle-fill ri-lg text-success"></i>
                            </div>
                        @else
                            <div class="col-auto p-0 m-0 align-self-center" style="visibility: hidden;">
                                <i class="ri-checkbox-circle-fill ri-lg text-success"></i>
                            </div>
                        @endif
                        @if (isset($statusvna[$numpacs]))
                            <div class="col-auto p-0 m-0 align-self-center">
                                <i class="ri-checkbox-circle-fill ri-lg text-success"></i>
                            </div>
                        @else
                            <div class="col-auto p-0 m-0 align-self-center" style="visibility: hidden;">
                                <i class="ri-checkbox-circle-fill ri-lg text-success"></i>
                            </div>
                        @endif
                    @endforeach

                </div>
            </div>
        </div> --}}
            </div>
            <div class="card ribbon-box mb-2">
                <div class="card-body">
                    <div class="row px-0">
                        <div class="col-lg-5 mb-3 d-flex justify-content-between">


                            {{-- <button type="button" class="btn btn-soft-success btn-icon waves-effect waves-light" ><i
                                        class="ri-settings-3-line"></i></button> --}}
                        </div>
                        <div class="col-lg-7  text-end">
                            <span class="text-red h5"><b>Patient ID :
                                    {{ @$casetoday[0]->case_hn }}</b></span>
                        </div>


                        <div class="col-6 mb-6 d-flex justify-content-between">
                            <div class="ribbon ribbon-success round-shape" id="switch_setting">
                                <i class="ri-file-list-3-line"></i>&ensp; Report
                            </div>
                        </div>
                    </div>



                    @if(uget("department") == "ENT")
                    <div class="row m-0 mt-2" style="padding-top: 50px;">
                        <div class="col">
                            <div class="border p-2">
                                <input class="form-check-input pdf-type" data-type="case_writing" type="radio"
                                    name="flexRadioDefault" id="flexRadioDefault6"
                                    onclick="change_pdf('ent_standard')" checked>
                                <label class="form-check-label" for="flexRadioDefault6">
                                    Standard report (4 Pics)
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row m-0 mt-2">
                        <div class="col">
                            <div class="border p-2">
                                <input class="form-check-input pdf-type" data-type="pdf_picturebottom" type="radio"
                                    name="flexRadioDefault" @checked(@$casedata->pdftype == 'pdf_picturebottom' || @$config->pdf_default == 'pdf_picturebottom') id="flexRadioDefault7"
                                    onclick="change_pdf('pdf_picturebottom')">
                                <label class="form-check-label" for="flexRadioDefault7">
                                    Picture bottom
                                </label>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="row m-0" style="padding-top: 50px;">
                        <div class="col">
                            <div class="border p-2">

                                <input class="form-check-input pdf-type" data-type="case_normal" type="radio"
                                    name="flexRadioDefault" id="flexRadioDefault5" @checked(@$casedata->pdftype == 'procedure' || @$config->pdf_default == 'procedure')
                                    onclick="change_pdf('procedure')" checked>
                                <label class="form-check-label" for="flexRadioDefault5">
                                    Standard report (8 Pics)
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row m-0 mt-2">
                        <div class="col">
                            <div class="border p-2">
                                <input class="form-check-input pdf-type" data-type="prc_std7" type="radio"
                                    name="flexRadioDefault" id="flexRadioDefault8" @checked(@$casedata->pdftype == 'prc_std7' || @$config->pdf_default == 'prc_std7')
                                    onclick="change_pdf('prc_std7')">
                                <label class="form-check-label" for="flexRadioDefault8">
                                    Standard with procedure picture (7 Pics)
                                </label>
                            </div>
                        </div>

                    </div>
                    <div class="row m-0 mt-2">
                        <div class="col">
                            <div class="border p-2">
                                <input class="form-check-input pdf-type" data-type="case_writing" type="radio"
                                    name="flexRadioDefault" id="flexRadioDefault6" @checked(@$casedata->pdftype == 'long_writing' || @$config->pdf_default == 'long_writing')
                                    onclick="change_pdf('long_writing')">
                                <label class="form-check-label" for="flexRadioDefault6">
                                    Long writing report (4 Pics)
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="row m-0 mt-2">
                        <div class="col">
                            <div class="border p-2">
                                <input class="form-check-input pdf-type" data-type="pdf_picturebottom" type="radio"
                                    name="flexRadioDefault" @checked(@$casedata->pdftype == 'pdf_picturebottom' || @$config->pdf_default == 'pdf_picturebottom') id="flexRadioDefault7"
                                    onclick="change_pdf('pdf_picturebottom')">
                                <label class="form-check-label" for="flexRadioDefault7">
                                    Picture bottom
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="row m-0 mt-2">
                        <div class="col">
                            <div class="border p-2">
                                <input class="form-check-input pdf-type" data-type="onlypicture" type="radio"
                                    name="flexRadioDefault" @checked(@$casedata->pdftype == 'onlypicture') id="flexRadioDefault9"
                                    onclick="change_pdf('onlypicture')">
                                <label class="form-check-label" for="flexRadioDefault9">
                                    Picture only
                                </label>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="row pt-3">
                        <div class="col-6 pe-0">
                            <a href="{{ url("loadpic/$casedata->id") }}" class="btn w-lg btn-edit" style="width:185px; ">
                                <i class="ri-edit-box-line"></i> Edit</a>
                        </div>
                        <div class="col-6 ps-0">
                            @if (@$feature->esign)
                                <button id="signed_btn{{ @$in }}" data-index="{{ @$in }}"
                                    type="button" class="btn btn-secondary w-lg signed_btn" style="width:185px;"
                                    data-caseid="{{ @$casedata->id }}" data-doctorname="{{ @$casedata->doctorname }}"
                                    data-doctorid="{{ @$casedata->case_physicians01 }}"
                                    data-folderdate="{{ @$folderdate }}" data-caseuniq="{{ @$casedata->caseuniq }}"
                                    data-comcreate="{{ @$casedata->comcreate }}" data-hn="{{ @$casedata->hn }}"
                                    onclick="show_modal('signed_modal', 'signed_btn{{ @$in }}')"><i
                                        class="ri-ball-pen-fill"></i>E-Sign
                                </button>
                            @endif
                        </div>
                    </div>

                    {{-- @if (@$feature->nursenote)
                    <div class="row m-0 mt-2">
                        <div class="col">
                            <div class="border p-2">

                                <input type="radio" class="form-check-input" name="pdftype" value="nurse"
                                    id="pdf2" onclick="extra_pdf('nurse')" />

                                <label class="form-check-label" for="pdf2">
                                    &emsp; Nurse Report
                                </label>
                            </div>
                        </div>

                    </div>
                    <div class="row m-0 mt-2">
                        <div class="col">
                            <div class="border p-2">
                                <input type="radio" class="form-check-input" name="pdftype" id="pdf3"
                                    value="billing" onclick="extra_pdf('billing')" />
                                <label class="form-check-label" for="pdf3">
                                    &emsp; Billing Report
                                </label>
                            </div>
                        </div>

                    </div>
                    <div class="row m-0 mt-2">
                        <div class="col">
                            <div class="border p-2">
                                <input type="radio" name="pdftype" class="form-check-input" value="followup"
                                    id="pdf4" onclick="extra_pdf('followup')" />
                                <label class="form-check-label" for="pdf4">
                                    &emsp; Follow Up Report
                                </label>
                            </div>
                        </div>
                    </div>
                @endif --}}

                </>
                <div class="col-12 m-0 p-0">
                    <hr>
                </div>
                <div class="m-0">
                    <div class="card-body pb-0 px-0">

                        <div class="row m-0 mb-1 px-3">
                            <div class="col-12 p-0">
                                {{-- <div class="ribbon ribbon-success round-shape"><i class="ri-external-link-fill"></i> Send Report</div> --}}
                                <h5> Send Report</h5>
                            </div>
                        </div>

                        {{-- <div class="row m-0 mt-2">
                            <div class="col">

                            </div>
                        </div> --}}

                        <div class="col-12 mt-1 m-0 px-3">
                            <button id="btn_callmodalsendto"
                                class="btn btn-primary btn-label waves-effect waves-light w-lg" type="button">
                                <i class="bx bx-server label-icon align-middle fs-16 me-2"></i>
                                Send to
                            </button>


                            <script>
                                $("#btn_callmodalsendto").click(function() {
                                    let txt_accessionno = $("#txt_accessionno").val();
                                    if (txt_accessionno != "") {

                                        $("#modal_sendto").modal("show");
                                    } else {
                                        alert("กรุณากรอก AccessionNUMBER");
                                    }
                                });
                            </script>
                        </div>
                        @if (@$feature->ordata)
                            <div class="col-12 m-0 p-0">
                                <hr>
                            </div>
                            <div class="row m-0 mb-1 px-3">
                                <div class="col-12 p-0">
                                    {{-- <div class="ribbon ribbon-success round-shape"><i class="ri-external-link-fill"></i> Send Report</div> --}}
                                    <h5> Send Data</h5>
                                </div>
                            </div>

                            <div class="col-12 mt-1 m-0 px-3">
                                <button id="btn_ordata_modal"
                                    class="btn btn-danger btn-label waves-effect waves-light w-lg">
                                    <i class="bx bx-server label-icon align-middle fs-16 me-2"></i>
                                    OR Data
                                </button>
                            </div>
                        @endif





                        @if (@$feature->report_eng)
                        <div class="col-12 m-0 p-0">
                            <hr>
                        </div>
                        <div class="row m-0 mb-1 px-3">
                            <div class="col-12 p-0">
                                {{-- <div class="ribbon ribbon-success round-shape"><i class="ri-external-link-fill"></i> Send Report</div> --}}
                                <h5>Report Language</h5>
                            </div>
                        </div>
                        <div class="col-12 mt-1 m-0 px-3">
                            <div class="border p-2">
                                <select name="pdf_head_lang" id="pdf_head_lang" class="form-select">
                                    <option @selected(@$casedata->pdf_language == 'th') value="th">TH</option>
                                    <option @selected(@$casedata->pdf_language == 'eng') value="eng">ENG</option>
                                </select>
                            </div>
                        </div>
                        @endif

                    </div>
                    <div class="col-12 m-0 p-0">
                        <hr>
                    </div>


                    <div class="row m-0">
                        <div class="col-12">
                            <h5>Edit Version</h5>
                        </div>
                        @php
                            $case_pdfversion = isset($casedata->case_pdfversion) ? $casedata->case_pdfversion : [];
                            $hn = isset($casedata->hn) ? $casedata->hn : '';
                        @endphp
                        @foreach ($case_pdfversion as $pdf)
                            @php
                                $when = isset($pdf['when']) ? explode(' ', $pdf['when'])[0] : '';
                                $pdfname = isset($pdf['pdf']) ? $pdf['pdf'] : '';
                            @endphp
                            <div class="row m-0 mt-2">
                                <div class="col-4 m-0 p-0 text-muted">
                                    {{ isset($pdf['user']) ? $pdf['user'] : 'Endocapture' }}
                                </div>
                                <div class="col-5 text-muted">
                                    {{ format_date($pdf['when'], 'd/m/Y  H:i:s') }}
                                </div>
                                <div class="col-3 text-end">
                                    <a href="{{ domainname("store/$hn/$folderdate/pdf/$pdfname") }}"
                                        class="text-primary text-decoration-underline" target="_blank"
                                        style="color: #192D4B">view</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <br>
            </div>
            <div class="col-12  ">
                <a href="{{@$config->url_and_port}}" class="btn btn-success w-100">
                    {{-- <i class="ri-list-check me-2"></i> --}}
                    Back to home
                </a>
            </div>
            @php
                $pdf_type = @$_GET['type'];
                $app_url = url('');
                $pdf_url = "$app_url/api/pdf?id=$id+type=$pdf_type";
                // dd($pdf_type, $app_url, $pdf_url, $casedata);
            @endphp
        </div>
    </div>
    @if (configTYPE('admin', 'system_ordata'))
        @include('capture.reportendocapture.component.ordata')
    @endif
@endsection


@section('modal')
    @include('capture.reportendocapture.component.modal_vip')
    @include('capture.reportendocapture.component.modal_emr')
    @include('capture.reportendocapture.component.modal_modal_confirmsave')
    @include('capture.reportendocapture.component.modal_waitingcreatedicom')
    @include('capture.reportendocapture.component.modal_process')
    @include('capture.reportendocapture.component.modal_signed')
    @include('capture.reportendocapture.component.modal_sendto')
    @include('capture.reportendocapture.component.modal_loading')

@endsection

@section('script')





    <script>

        $("#pdf_head_lang").change(function() {
            var value = $(this).val();
            $.post("{{ url('api/pdf') }}", {
                event: "pdf_head_lang",
                value: value,
                id: "{{ $casedata->id }}"
            }, function(data, status) {
                location.reload();
            });
        });




        $(".mouse-enter").mouseover(function() {
            $(".hide-content").toggle(300);
        })
    </script>


    <script>
        function loadOtherPage(src) {
            console.log(src);
            $("<iframe>") // create a new iframe element
                .hide() // make it invisible
                .attr("src", "{{ url("note/paper/$id") }}") // point the iframe to the page you want to print
                .appendTo("body") // add iframe to the DOM to cause it to load the page
                .on('load', function() { // add an event listener to wait for the iframe to load
                    this.contentWindow.print();
                    $("#modal_loading").modal("hide"); // print the iframe content once it's loaded
                });
        }

        $("#btn_printnursenote").click(function() {

            $("#modal_loading").modal("show");

            loadOtherPage("");



        });
    </script>






    <script>
        $("#open_file_location").click(function() {
            let folder = $("#pdf_folder_head").val();
            $.post("{{ url('api/case') }}", {
                event: "go2folder",
                folder: folder,
            }, function(data, status) {});
        })
    </script>

    <script src='{{ url('resources/box/js/box.js') }}'></script>
    <script>
        let pdf_setting = false;
        $("#switch_setting").click(function() {
            if (pdf_setting) {
                pdf_setting = false;
                $("#card_setting").slideUp(500);
            } else {
                pdf_setting = true;
                $("#card_setting").slideDown(500);
            }
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(".jsonboxSAVE").click(function() {
            var ele = $(this).attr("name");
            var elements = document.querySelectorAll('input[name="' + ele + '"]:checked');
            var checkedElements = Array.prototype.map.call(elements, function(el, i) {
                return el.value;
            });
            $.post("{{ url('api/case') }}", {
                event: "jsonboxSAVE",
                ele: ele,
                val: checkedElements,
                cid: "{{ $cid }}"
            }, function(data, status) {});
        });


        $('#send_to_pac_btn').on('click', function() {
            var is_show = $('#pac_btn').css('display')
            if (is_show == 'block') {
                $('#pac_btn').css('display', 'none')
            } else {
                $('#pac_btn').css('display', 'block')
            }
        })



        $("#pdf_setting_save").click(function() {
            $.post("{{ url('superadmin') }}", {
                event: "clearview"
            }, function(d, s) {
                window.location.reload();
            });
        });



        $("#btn_esign").click(function() {
            $("#modal_emr").modal("show");
            $("#password_incorrect1").hide();
            $("#password_incorrect2").hide();
        });



        $("#create_sign").click(function() {
            var doctor_id = $("#doctor_id").val();
            var doctor_code = $("#doctor_code").val();
            setTimeout(() => {
                $.post('{{ url('reportendocapture') }}', {
                    event: "create_sign",
                    doctor_id: doctor_id,
                    doctor_code: doctor_code,
                    folderdate: '{{ $folderdate }}',
                    cid: '{{ $cid }}',
                    caseuniq: '{{ $casedata->caseuniq }}',
                    comcreate: '{{ $casedata->comcreate }}',
                    hn: '{{ $casedata->case_hn }}'
                }, function(data, status) {
                    if (data == "success") {
                        location.reload();
                    } else {
                        $("#password_incorrect1").show();
                        $("#password_incorrect2").show();
                    }
                });
            }, 1000);
        });

        var pdftype = "";

        $('.btn-outline-success').click(function() {
            pdftype = $(this).attr('id');
            $('#modal_confirmsave').modal('show');
        });

        $('#btnYes').click(function() {
            window.location.replace("{{ url('') }}/reportendocapture/{{ Request::segment(2) }}?type=" +
                pdftype + "&savepdf=true");
        });


        $('#sendbilling').click(function() {
            var cid = $(this).attr('cid');
            $.post('{{ url('billing') }}', {
                event: "billing_file",
                cid: cid,
            }, function(data, status) {
                const obj = JSON.parse(data);
                if (obj.status == "success") {
                    alert("ส่งข้อมูลค่าใช้จ่าย สำเร็จ");
                } else {
                    alert("ส่งข้อมูลค่าใช้จ่าย ไม่สำเร็จ");
                }
                console.log(data);
            });
        });
    </script>
    <script>
        $(".config_type").focusout(function() {
            var value = $(this).val();
            var id = $(this).attr('id');
            var config_type = $(this).attr('config_type');
            $.post("{{ url('superadmin') }}", {
                event: "config_type",
                config_type: config_type,
                id: id,
                value: value,
            }, function(data, status) {});
        });

        $(".configtext").focusout(function() {
            var value = $(this).val();
            var id = $(this).attr('id');
            $.post("{{ url('jquery') }}", {
                event: "configtext",
                id: id,
                value: value,
            }, function(data, status) {});
        });

        $('.config_option').click(function() {
            var id = $(this).attr('id');
            var config_type = $(this).attr('config_type');
            var value = true;
            if ($(this).prop("checked") == false) {
                value = 'false';
            }
            $.post("{{ url('jquery') }}", {
                event: "configcheck",
                id: id,
                config_type: config_type,
                value: value,
            }, function(data, status) {
                console.log(data);
            });
        });
    </script>
    <script>
        @php
            $comname = getCONFIG('admin')->com_name;
        @endphp
        @if ($comname != 'endocapture')
            @if (configTYPE('admin', 'system_semi'))
                setInterval(function() {
                    $.post("{{ url('synchronize') }}", {},
                        function(data, status) {
                            console.log(data);
                            if (data == "true") {
                                location.reload();
                            }
                        });
                    console.log("Connect server success!!!");
                }, 10000);
            @endif
        @endif
    </script>



    <script>
        function show_modal(modal_id, btn_id) {
            var doctorname = $(`#${btn_id}`).data('doctorname')
            var doctor_id = $(`#${btn_id}`).data('doctorid')
            var id = $(`#${btn_id}`).data('caseid')
            $(`#btn_id`).val(btn_id)
            $('#doctorname_txt').html(doctorname)
            $('#create_sign_btn').attr('href', `{{ $url }}/esign/${doctor_id}?id=${id}`)
            var myModal = new bootstrap.Modal(document.getElementById(modal_id))
            myModal.show()
        }

        $("#autoesign").click(function() {
            $.post("{{ url('api/jquery') }}", {
                event: 'autoesign',
                cid: "{{ $cid }}",
                doctor_id: "{{ $casedata->case_physicians01 }}"
            }, function(data, status) {
                console.log(doctor_id);
                if (data == "success") {
                    location.reload();
                } else {
                    alert("แพทย์ท่านนี้ไม่มีลายเซ็น")
                }
            });
        })





        $('#confirm_signed_btn').on('click', function() {
            // alert('Please');
            var btn_id = $(`#btn_id`).val()
            $.post("{{ url('api/jquery') }}", {
                event: 'create_sign',
                doctor_id: $(`#${btn_id}`).data('doctorid'),


                doctor_code: $('#user_code_inp').val(),


                folderdate: $(`#${btn_id}`).data('folderdate'),
                cid: $(`#${btn_id}`).data('caseid'),
                caseuniq: $(`#${btn_id}`).data('caseuniq'),
                comcreate: $(`#${btn_id}`).data('comcreate'),
                hn: $(`#${btn_id}`).data('hn')
            }, function(data, status) {
                if (data == "success") {
                    location.reload();
                } else {
                    $('#warning_msg').css('display', 'block')
                    $('#warning_msg').html(data)
                }
            });
        })

        $('#user_code_inp').on('input', function() {
            var inp_lg = $(this).val().length
            if (inp_lg > 0) {
                $('#confirm_signed_btn').prop('disabled', false)
                $('#warning_msg').css('display', 'none')
            } else {
                $('#confirm_signed_btn').prop('disabled', true)
            }
        })
    </script>



    @if (connectSERVER())
        {{-- ตรวจสอบการเชื่อมต่อกับ SERVER เพื่อป้องกันการโหลดช้าของหน้านี้ --}}
        <script src='http://{{ getCONFIG('admin')->server_name }}:3000/socket.io/socket.io.js'></script>
        <script>
            var socketserver = io.connect('http://{{ getCONFIG('admin')->server_name }}:3000');
            socketserver.emit('chat message', 'casemonitor');
        </script>
    @endif

    <script>
        //Semi
        setInterval(() => {
            $.post("{{ url('api/semi') }}", {
                event: "checktempin"
            }, function(d, s) {
                console.log(d);
            });
        }, 10000);
    </script>

    <script>
        function change_pdf(type) {

            $.post("{{ url('api/pdf') }}", {
                "event": "change_pdf",
                "cid": "{{ $cid }}",
                "pdftype": type
            }, function(d, s) {
                $('#iframepdf').attr('src', "{{ url("api/pdf/$cid") }}");
            });




        }

        function extra_pdf(type) {
            if (type == 'lumina_report') {
                $('#iframepdf').attr('src', '{{ url("lumina/print/$id") }}');
            }
            if (type == 'nurse') {
                $("#btn_printnursenote").show();
                $("#photo_report").prop('checked', false);
                $("#report_sendto").prop('checked', false);
                $("#nurse_report").prop('checked', true);
                $('#iframepdf').attr('src', '{{ url("note/paper/$id") }}');
            }
            if (type == 'followup') {
                $('#iframepdf').attr('src', '{{ url("api/pdfnurse/$id/edit") }}')
            }
        }

        // ฟังก์ชันสำหรับเปิด PDF แบบเต็มจอ
        function openPdfFullscreen(pdfUrl) {
            // เปิดหน้าต่างใหม่ที่มีขนาดเต็มจอ
            var newWindow = window.open(pdfUrl, '_blank',
                'width=' + screen.width +
                ',height=' + screen.height +
                ',scrollbars=yes,resizable=yes,toolbar=yes,menubar=yes,location=yes,status=yes'
            );

            // พยายามทำให้เต็มจอ (อาจไม่ทำงานในบางเบราว์เซอร์)
            if (newWindow) {
                try {
                    newWindow.moveTo(0, 0);
                    newWindow.resizeTo(screen.width, screen.height);

                    // สำหรับเบราว์เซอร์ที่รองรับ fullscreen API
                    if (newWindow.document.documentElement.requestFullscreen) {
                        newWindow.document.documentElement.requestFullscreen();
                    } else if (newWindow.document.documentElement.webkitRequestFullscreen) {
                        newWindow.document.documentElement.webkitRequestFullscreen();
                    } else if (newWindow.document.documentElement.msRequestFullscreen) {
                        newWindow.document.documentElement.msRequestFullscreen();
                    }
                } catch (e) {
                    console.log('ไม่สามารถทำให้เต็มจอได้:', e);
                }
            }
        }
    </script>
@endsection
