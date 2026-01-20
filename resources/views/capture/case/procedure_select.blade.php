@php
    session_start();
    use App\models\mongo;
    $admin = getCONFIG('admin');
@endphp

@if (isset($_SESSION['page419']))
    <script>
        $("#footer").scrollTop();
    </script>
    @php
        unset($_SESSION['page419']);
    @endphp
@endif

{{-- @extends('layouts.layouts_index.main') --}}
@extends('capture.layoutv6')

@section('style')
    <script src='{{ url('public/js/autosize.js') }}'></script>
    <script src="{{ url('public/js/jquery.imgcheckbox.js') }}"></script>
    <script src="{{ url('public/js/jquery.input-dropdown.js') }}"></script>
    <script src="{{ url('public/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ url('public/ckeditor/adapters/jquery.js') }}"></script>
    <script>
        let cid = "{{ $cid }}";
    </script>

    <style>
        /* .page-title-box {
                margin-top: -60px;
                } */
        .bg-report {
            background: #192d4b;
            color: #fff;
        }


        .img-report {
            max-width: 100%;
            height: 75px;
            border-radius: 50%;
            margin-left: 7px;
        }

        .btn-editp {
            background: #192d4b;
            color: #fff;
            border: 1px solid #fff;
            border-radius: 5px;
            margin-left: 8px;

        }

        .btn-editp:hover {
            background: #fff;
            color: #245788;
            border: 1px solid #fff;
        }

        .h-85 {
            height: 85px;
        }

        .btn-checkbox {
            background: #192d4b;
            color: #ffffffff;

        }

        .btn-checkbox:hover {
            color: #fff;
            background: #0f2e4c
        }

        .text-pos {
            background: #0f2e4c;

            .material-icons.md-18 {
                font-size: 18px;
            }

            .material-icons.md-24 {
                font-size: 24px;
            }

            .material-icons.md-36 {
                font-size: 36px;
            }

            .material-icons.md-48 {
                font-size: 48px;
            }

            .margin-pos {
                margin-top: 45px;
            }

            .pic-report {
                width: 100%;
                height: 150px;
            }

            .btn-gray {
                background: #CED4DA;
                border-left: 1px solid #707070;
                border-right: 1px solid #707070;
                border-radius: 0;

            }

            .btn-gray:hover {
                background: #9fa4a9;
            }

            .w-number {
                width: 48px;
            }

            .an {
                display: flex;
                align-items: center;
            }

            .other-pos {
                margin-top: 13em;
            }

            .mt-28 {
                margin-top: 28px;
            }

            .pic-res {
                display: none;
            }

            .btn-res {
                display: none;
            }

            .tap-report {
                height: 40px;
                padding: 7px;

            }

            .ri-lg {

                vertical-align: -0.3em;
            }

            .btn-light {
                /* background: #f3f6f9; */
                border: 0px !important;
            }

            .form-check-input:checked[type=checkbox] {
                background-color: #245788 !important;
                color: #fff;
                background-image: url(data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 20 20'%3e%3cpath fill='none' stroke='%23fff' stroke-linecap='round' stroke-linejoin='round' stroke-width='3' d='M6 10l3 3l6-6'/%3e%3c/svg%3e);
            }

            .hides-scroll {
                background: red;

            }


            @media only screen and (max-width: 1200px) {
                .btn-res {
                    display: flex;
                }

                .btn-main {
                    display: none;
                }

                .pic-res {
                    display: flex;
                }

                .pic-main {
                    display: none;
                }

                .other-pos {
                    margin-top: 1em;
                }

                .hide-btn {
                    display: none;
                }

                .btnres-hide {
                    display: none;
                }

                .mt-res-2 {
                    margin-top: 1em;
                }

                .img-with-btn-res {
                    text-align: center;

                }

                .btn-editp {
                    display: block;
                    margin: auto;
                }
            }

            }
    </style>
    @php
        if (isset($admin->theme_fontsize)) {
            $theme_fontsize = $admin->theme_fontsize . 'px';

            if ($admin->theme_fontsize == '50') {
                $theme_fontsize = '10px';
            }
            if ($admin->theme_fontsize == '75') {
                $theme_fontsize = '12px';
            }
            if ($admin->theme_fontsize == '100') {
                $theme_fontsize = '14px';
            }
            if ($admin->theme_fontsize == '125') {
                $theme_fontsize = '16px';
            }
            if ($admin->theme_fontsize == '150') {
                $theme_fontsize = '18px';
            }
            if ($admin->theme_fontsize == '175') {
                $theme_fontsize = '20px';
            }
        } else {
            $theme_fontsize = '14px';
        }

        // dd($theme_fontsize);
        echo "<style>
            input   {font-size: $theme_fontsize!important;}
            .row    {font-size: $theme_fontsize !important;}
            button  {font-size: $theme_fontsize !important;}
            a       {font-size: $theme_fontsize !important;}
            select  {font-size: $theme_fontsize !important;}
            textarea  {font-size: $theme_fontsize !important;}
            select, option  {font-size: $theme_fontsize !important;}
            .select2, .select2-selection, .select2-selection__rendered, .select2-results__option {font-size: $theme_fontsize !important;}

            label  {font-size: $theme_fontsize !important;}
            p  {font-size: $theme_fontsize !important;}
            h1  {font-size: $theme_fontsize !important;}
            h2  {font-size: $theme_fontsize !important;}
            h3  {font-size: $theme_fontsize !important;}
            h4  {font-size: $theme_fontsize !important;}
            h5  {font-size: $theme_fontsize !important;}
            h6  {font-size: $theme_fontsize !important;}
            .text-register2  {font-size: $theme_fontsize !important;}
            .text-register3  {font-size: $theme_fontsize !important;}
            .text-register4  {font-size: $theme_fontsize !important;}
            .text-register5  {font-size: $theme_fontsize !important;}
            .text-register6  {font-size: $theme_fontsize !important;}
            .text-register7  {font-size: $theme_fontsize !important;}
            .text-register8  {font-size: $theme_fontsize !important;}
        </style>";

    @endphp
@endsection

@section('title-left')
    {{-- <h4 class="mb-sm-0">PHYSICIAN RECORD</h4> --}}
@endsection

{{-- @section('title-right')
    <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><a href="javascript: void(0);">Cases list</a></li>
        <li class="breadcrumb-item active">Physician Record</li>
    </ol>
@endsection --}}

@section('modal')
    @include('capture.case.component.modal.modal_confirm_del')
    @include('capture.case.component.modal.modal_finding')
    {{-- @include('case.component.modal.modal_bigpic') --}}
    @include('capture.case.component.modal.modal_reload')
    @include('capture.case.component.modal.modal_scope')
    @include('capture.case.component.modal.modal_move_case')
    @include('capture.case.component.modal.modal_downloadVdo')
    @include('capture.case.component.modal.modal_pacphoto')
    @include('capture.case.component.modal.modal_manage_complication')
    @include('capture.case.component.modal.modal_adddoctor')
    @include('capture.reportendocapture.component.modal_report_icd9')
    @include('capture.reportendocapture.component.modal_report_icd10')


    {{-- @if (@$feature->auth_report) --}}
    @include('capture.reportendocapture.component.modal_auth')
    {{-- @endif --}}

    @include('capture.reportendocapture.component.modal_photo')
@endsection

@section('content')
    {{-- @dd($vdo); --}}
    {{-- @dd($case); --}}
    <div class="row">


            <div class="col-12 ">
                <input type="hidden" id="tabselect" value="0">
                <input type="hidden" name="patientid" value="{{ @$case->patient_id }}">
                <input type="hidden" name="useropen" value="{{ uid() }}">
                <input type="hidden" name="hn" value="{{ $case->hn }}">
                <input type="hidden" name="case_id" value="{{ $cid }}">
                @php
                    $newurl = str_replace('procedure', 'procedure_pic', url()->full());
                @endphp
                <div class="row">
                    @include('capture.case.component.procedure_edit')
                    @include('capture.case.component.new.patient_detail')
                    @include('capture.case.component.admin_alert')
                </div>

                @include('capture.case.component.new.tap')


                <form id="formviewreport" action="{{ url('procedure') }}" method="post" style="width: 100%;">
                    @csrf
                    <input type="hidden" name="event" value="caserecord">
                    <input type="hidden" name="cid" value="{{ $cid }}">
                    <input type="hidden" name="hn" value="{{ $case->case_hn }}">
                    <input type="hidden" name="folderdate" value="{{ $folderdate }}">
                    <div class="row" style="margin: 0; ">
                        {{-- <div style="padding-left: 67px; padding-right: 77px;"> --}}
                        @foreach ($procedure->case as $cardname)
                            @include("case.component.$cardname")
                        @endforeach
                        {{-- </div> --}}


                    </div>
                </form>
            </div>

    </div>

    <form action="{{ url('procedure') }}" method="post" hidden>
        @csrf
        <input type="hidden" id="event_inp" name="event">
        <input type="hidden" name="id" value="{{ @$cid }}">
        <button id="all_action_btn" type="submit" hidden>click</button>
    </form>

    @php
        $cholangiogram = isset($case->cholangiogram) ? $case->cholangiogram : [];
        $complete_cholangiogram = isset($case->complete_cholangiogram) ? $case->complete_cholangiogram : [];
        $cholangiogram_ck = isset($case->cholangiogram_ck) ? $case->cholangiogram_ck : [];
        $complete_cholangiogram_ck = isset($case->complete_cholangiogram_ck) ? $case->complete_cholangiogram_ck : [];
        $cholangiogram_i = isset($case->cholangiogram_i) ? $case->cholangiogram_i : [];
        $complete_cholangiogram_i = isset($case->complete_cholangiogram_i) ? $case->complete_cholangiogram_i : [];
    @endphp
@endsection





@section('script')
    <script>
        $("button").click(function() {
            $(this).find('i').toggleClass('ri-checkbox-blank-line ri-checkbox-line')
        })
    </script>


    <script>
        $(".radioother").click(function() {
            let other = $(this).attr('other');
            let id = $(this).attr('id');
            let exval = $("[radiootherval='" + id + "']").val();
            let exval2 = $("[radiootherval2='" + id + "']").val();
            let textend = $("[radioothervalend='" + id + "']").html();
            let value = $(this).val();

            if (exval === undefined) {
                exval = "";
            }
            if (exval2 === undefined) {
                exval2 = "";
            }
            if (textend === undefined) {
                textend = "";
            }

            let allstring = value + " " + exval + " " + textend + " " + exval2;
            $("#" + other).val(allstring)
            $("#" + other).focusout()

            let hasClass = $(this).hasClass('ck-no')
            let name = $(this).attr('name')
            if (hasClass) {
                $(`input[name="${name}_other"]`).val('')
            }

            if ($(`input[name="${name}_other"]`).val()) {
                $.post('{{ url('api/procedure') }}', {
                    event: "savejson_edit",
                    cid: '{{ @$cid }}',
                    datagroup: `${name}_other`,
                    value: $(`input[name="${name}_other"]`).val()
                }, function(d, s) {
                    console.log('success');
                })
            }


            console.log(name, 'name', $(`input[name="${name}_other"]`).val(), name.includes('Diverticulum'));
        })
    </script>

    @if (@$feature->report_auth)
        <script type="text/javascript">
            $(window).on('load', function() {
                $('#modal_auth').modal('show');
            });
        </script>
    @endif
    <script>
        var ct = 2;
        var ct9 = 2;
        var num = {{ count($case->photo) }};
    </script>


    {{-- For clean code --}}
    @include('case.script')

    {{-- <script>
        $("#btn_callmodaldownload").click(function(){
            alert(1);
            $.post('{{url('api/procedure')}}',{
                event: 'photozip',
                cid: {{$cid}}
            })
        })


    </script> --}}

    <script>
        // pacs image
        var pacs_ck = false
        // restore storage data

    </script>





    <script>
        function del_icd(data) {
            $("#" + data).hide();
        }
        $(".bt_edit").click(function() {
            var this_id = $(this).attr('sub_id');
            $(".set_edit_" + this_id).removeClass('d-hide').addClass('d-show');
            $(".set_show_" + this_id).removeClass('d-show').addClass('d-hide');
        })
        $(".bt_success").click(function() {
            var this_id = $(this).attr('sub_id');
            $(".set_show_" + this_id).removeClass('d-hide').addClass('d-show');
            $(".set_edit_" + this_id).removeClass('d-show').addClass('d-hide');
        })

        $(".text_delfind").click(function() {
            var del_val = $(this).attr("deltext");
            $("#finding" + del_val).val('Not Accessible');
            $("#finding" + del_val).focus();
        });


        $(document).ready(function() {
            $('.myGallery li img').on('click', function() {
                var src = $(this).attr('src');
                var img = '<img src="' + src + '" class="img-responsive"/>';
                var title = $(this).attr('title');
                $('#myModal').modal();
                $('#myModal').on('shown.bs.modal', function() {
                    $('#myModal .modal-body').html(img);
                    $('#myModal .modal-footer').html(title);
                });
                $('#myModal').on('hidden.bs.modal', function() {
                    $('#myModal .modal-body').html('');
                    $('#myModal .modal-footer').html('');
                });
            });
        });
    </script>

    <script>
        function renumber(number) {
            @foreach ($photo as $p)
                if ($("#bb{{ @$p['nu'] }}").html() >= number) {
                    var newnum = new Number($("#bb{{ @$p['nu'] }}").html()) - 1;
                    $("#bb{{ @$p['nu'] }}").html(newnum);
                }
            @endforeach
        }
    </script>

    <script>
        $('.btn-submit').click(function() {
            $('.btn-submit').hide();
            $('#modal_progress').modal('show');
            setTimeout(function() {
                window.location.reload();
            }, 10000);
        });

        $('.savejson-medi').bind('focusout', function() {
            let obj = {}
            let medi_ck = [];
            let medi_dose = [];
            let medi_unit = [];
            let retString = localStorage.getItem("{{ $cid }}")
            if (retString != null) {
                obj = JSON.parse(retString)
            }
            let sub = []

            $(".medigroup").each(function() {
                medi_dose.push($(this).val())
            });
            $(".ck-medi:checkbox:checked").each(function() {
                medi_ck.push($(this).val())
            });
            $(".medi_unit").each(function() {
                medi_unit.push($(this).val())
            });

            sub['medi_ck'] = []
            sub['medi_dose'] = []
            sub['medi_unit'] = []
            for (let i = 0; i < medi_dose.length; i++) {
                sub['medi_ck'].push(medi_ck[i])
                sub['medi_dose'].push(medi_dose[i])
                sub['medi_unit'].push(medi_unit[i])
            }

            obj['medi_ck'] = sub['medi_ck']
            obj['medi_dose'] = sub['medi_dose']
            obj['medi_unit'] = sub['medi_unit']
            let text = JSON.stringify(obj);
            localStorage.setItem("{{ $cid }}", text);

        })

        $("#btn_gettempdata").click(function() {
            try {
                restore_storage()
            } catch (error) {
                console.log(error);
            }
        });
    </script>

    {{-- <script>
        var ss_photoid = localStorage.getItem("photo_id")
        var ss_photoname = localStorage.getItem("photoname")
        if ((ss_photoid != '' && ss_photoid != undefined) && (ss_photoname != '' && ss_photoname != undefined)) {
            // document.getElementById("photo_card").scrollIntoView()
            // document.getElementById(`divselect${ss_photoid}`).scrollIntoView()
            localStorage.removeItem("photo_id");
            localStorage.removeItem("photoname");
        }
    </script> --}}

    <script>
        function queryFunction(query) {
            var term = query.term;
            var offset = query.offset || 0;
            var results = cities.filter(function(city) {
                return transformText(city).indexOf(transformText(term)) > -1;
            });
            results.sort(function(a, b) {
                a = transformText(a);
                b = transformText(b);
                var startA = (a.slice(0, term.length) === term),
                    startB = (b.slice(0, term.length) === term);
                if (startA) {
                    return (startB ? (a > b ? 1 : -1) : -1);
                } else {
                    return (startB ? 1 : (a > b ? 1 : -1));
                }
            });
            setTimeout(query.callback({
                more: results.length > offset + 10,
                results: results.slice(offset, offset + 10)
            }), 500);
        }
    </script>

    <script>
        var modalConfirm = function(callback) {
            $("#btn-confirm").on("click", function() {
                $("#mi-modal").modal('show');
            });
            $("#modal-btn-si").on("click", function() {
                callback(true);
                $("#mi-modal").modal('hide');
            });
            $("#modal-btn-no").on("click", function() {
                callback(false);
                $("#mi-modal").modal('hide');
            });
        };

        modalConfirm(function(confirm) {
            if (confirm) {
                $("#result").html("CONFIRMADO");
            } else {
                $("#result").html("NO CONFIRMADO");
            }
        });
    </script>



    <script>
        $("#form").keypress(function(e) {
            if (event.target.tagName != 'TEXTAREA') {
                if (event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            }
        });
        $("input[type=text], textarea ").focus(function() {
            $(this).css("background-color", "#D6EAF8");
        });
        $("input").focusout(function() {
            $(this).css("background-color", "");
        });
    </script>


    <script>
        document.addEventListener("keydown", function(event) {
            var thai = /^[^ก-ฮ]*$/;
            if (!thai.test(event.key)) {
                beep();
            }
        });

        function beep() {
            var snd = new Audio(
                "data:audio/wav;base64,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qJrx4KOQjahZxWbcZgztj2c49nKmkId44S71j0c8eV9yDK6uPRzx5X18eDvjvQ6yKo9ZSS6l//8elePK/Lf//IInrOF/FvDoADYAGBMGb7FtErm5MXMlmPAJQVgWta7Zx2go+8xJ0UiCb8LHHdftWyLJE0QIAIsI+UbXu67dZMjmgDGCGl1H+vpF4NSDckSIkk7Vd+sxEhBQMRU8j/12UIRhzSaUdQ+rQU5kGeFxm+hb1oh6pWWmv3uvmReDl0UnvtapVaIzo1jZbf/pD6ElLqSX+rUmOQNpJFa/r+sa4e/pBlAABoAAAAA3CUgShLdGIxsY7AUABPRrgCABdDuQ5GC7DqPQCgbbJUAoRSUj+NIEig0YfyWUho1VBBBA//uQZB4ABZx5zfMakeAAAAmwAAAAF5F3P0w9GtAAACfAAAAAwLhMDmAYWMgVEG1U0FIGCBgXBXAtfMH10000EEEEEECUBYln03TTTdNBDZopopYvrTTdNa325mImNg3TTPV9q3pmY0xoO6bv3r00y+IDGid/9aaaZTGMuj9mpu9Mpio1dXrr5HERTZSmqU36A3CumzN/9Robv/Xx4v9ijkSRSNLQhAWumap82WRSBUqXStV/YcS+XVLnSS+WLDroqArFkMEsAS+eWmrUzrO0oEmE40RlMZ5+ODIkAyKAGUwZ3mVKmcamcJnMW26MRPgUw6j+LkhyHGVGYjSUUKNpuJUQoOIAyDvEyG8S5yfK6dhZc0Tx1KI/gviKL6qvvFs1+bWtaz58uUNnryq6kt5RzOCkPWlVqVX2a/EEBUdU1KrXLf40GoiiFXK///qpoiDXrOgqDR38JB0bw7SoL+ZB9o1RCkQjQ2CBYZKd/+VJxZRRZlqSkKiws0WFxUyCwsKiMy7hUVFhIaCrNQsKkTIsLivwKKigsj8XYlwt/WKi2N4d//uQRCSAAjURNIHpMZBGYiaQPSYyAAABLAAAAAAAACWAAAAApUF/Mg+0aohSIRobBAsMlO//Kk4soosy1JSFRYWaLC4qZBYWFRGZdwqKiwkNBVmoWFSJkWFxX4FFRQWR+LsS4W/rFRb/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////VEFHAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAU291bmRib3kuZGUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAMjAwNGh0dHA6Ly93d3cuc291bmRib3kuZGUAAAAAAAAAACU="
            );
            snd.play();
        }
    </script>


    <script>
        $('input[type=text]').each(function() {
            if ($(this).val() != '' && $(this).val() != null) {
                $(this).css('background', '#d2ebf6');
            }
        });
        $('select').each(function() {
            if ($(this).val() != '' && $(this).val() != null) {
                $(this).css('background', '#d2ebf6');
            }
        });
        $('input[type=number]').each(function() {
            if ($(this).val() != '' && $(this).val() != null) {
                $(this).css('background', '#d2ebf6');
            }
        });
        $('textarea').each(function() {
            if ($(this).text() != '' && $(this).text() != null) {
                $(this).css('background', '#d2ebf6');
            }
        });
        $('.form-control').focusout(function() {
            var text_val = $(this).val();
            if (text_val != null && text_val != '') {
                $(this).css('background', '#d2ebf6');
            } else {
                $(this).css('background', 'none');
            }
        });
    </script>



    <script>
        $(".checkboxgroupmain").click(function(e) {
            let group = $(this).attr("group");
            let checked = $(this).is(":checked");
            if (checked) {
                $('.checkboxgroupsub[group="' + group + '"]').show();
            } else {
                $('.checkboxgroupsave[group="' + group + '"]').prop('checked', false);;
                $('.checkboxgroupsub[group="' + group + '"]').hide();
            }
        });


        $(".checkboxgroupsave").click(function(e) {
            save_checkbox(e.target)
            if ($(this).hasClass('ck-complicationercp') && !$(this).is(':checked')) {
                $(`.ck-complicationercp-input[position="${$(this).attr('position')}"]`).val('').focusout()
            }
        });

        $(".radiosave").click(function() {
            let datagroup = $(this).attr("datagroup");
            let value = $(this).val();
            $.post('{{ url('api/procedure') }}', {
                event: "radiosave",
                cid: cid,
                datagroup: datagroup,
                value: value
            }, function(d, s) {})
        });

        function save_checkbox(e) {
            let datagroup = $(e).attr("datagroup");
            let array = [];
            let checkboxes = document.querySelectorAll(`.checkboxgroupsave:checked[datagroup="${datagroup}"]`);
            for (var i = 0; i < checkboxes.length; i++) {
                array.push(checkboxes[i].value)
            }
            $.post('{{ url('api/procedure') }}', {
                event: "checkboxgroupsave",
                cid: cid,
                datagroup: datagroup,
                array: array
            }, function(d, s) {})
        }

        // ercp_staff
        function get_user(classname, attrname) {
            let count = $(classname).length
            var data_array = [];
            for (i = 0; i < count; i++) {
                data_array.push($($(classname)[i]).attr(attrname));
            }
            return data_array
        }

        function list_save(datagroup, array) {
            $.post('{{ url('api/procedure') }}', {
                event: "checkboxgroupsave",
                cid: cid,
                datagroup: datagroup,
                array: array
            }, function(d, s) {})
        }

        function del_user(selector, value) {
            $(`${selector} option[value="${value}"]`).attr('data-show', 'false')
            $("div[sub-tab='" + value + "'").remove()
            let data_array = get_user(selector, 'sub-tab')
            list_save('consultant', data_array)
        }

        function save_textarea(datagroup, is_ck = false, other_group = '') {
            // let textarea = $(`#${datagroup}_other`).val()
            let textarea;
            if (datagroup == 'indicationGroup') {
                textarea = other_group
            } else {
                textarea = $(`#${datagroup}_other`).val()
            }
            // let text_array = textarea.split('\n')
            // text_array = text_array.filter(item => item !== null && item !== "");
            $.post('{{ url('api/procedure') }}', {
                event: "checkboxgroupsave",
                cid: cid,
                datagroup: `${datagroup}_other`,
                array: textarea
                // array: text_array
            }, function(d, s) {})
        }

        // cholangiogram //
        var c = @json($cholangiogram);
        var cc = @json($complete_cholangiogram);
        var cholangiogram_ck = @json($cholangiogram_ck);
        var cholcomp_ck = @json($complete_cholangiogram_ck);
        var cholangiogram_text = [];
        var other_ck = [];
        var cholangiogram_i = @json($cholangiogram_i);
        var cholcomp_i = @json($complete_cholangiogram_i);
        var sort = true
        var prev_cholcomp = sort == true ? @json($complete_cholangiogram_i) : @json($complete_cholangiogram_ck);
        var prev_chol = sort == true ? @json($cholangiogram_i) : @json($cholangiogram_ck);
        var indices = []
        var track_unck = 9999

        cholangiogram_text = set_array_with_data('cholangiogram', cholangiogram_text)
        cholangiogram_text = set_array_with_data('complete_cholangiogram', cholangiogram_text)

        function call_savejsonedit(datagroup, value, is_other = false, is_array = false) {
            $.post('{{ url('api/procedure') }}', {
                event: "savejson_edit",
                cid: cid,
                datagroup: datagroup,
                value: value,
                is_other: is_other,
                is_array: is_array
            }, function(d, s) {})
        }

        $(".checkboxgroupsave_edit").click(function() {
            let datagroup = $(this).attr("datagroup");
            let subgroup = $(this).attr("subgroup")
            let name = $(this).attr('name')
            let index = $(this).attr('dataindex')
            let value = $(this).val();
            let checkboxes = document.querySelectorAll('.checkboxgroupsave_edit:checked');
            let is_show = true
            let is_write = true
            cholangiogram_ck = []
            cholcomp_ck = []
            other_ck[datagroup] = []

            if (!$(this).is(':checked')) {
                let radios = $(`.radiosave_edit[subgroup="${subgroup}"]`)
                for (let j = 0; j < radios.length; j++) {
                    $($(radios)[j]).prop('checked', false)
                }
                let new_val = reset_value(subgroup)
                if (datagroup == 'complete_cholangiogram') {
                    cholcomp_ck[subgroup] = new_val
                } else if (datagroup == 'cholangiogram') {
                    cholangiogram_text[datagroup][subgroup] = new_val
                }

                let lg = $(`.ck-radio[subgroup="${subgroup}"]`).length
                for (let k = 0; k < lg; k++) {
                    let e = $($(`.ck-radio[subgroup="${subgroup}"]`)[k])
                    e.val('')
                    // save_otherck(datagroup, subgroup, e.attr('name'), '')
                    if (datagroup != 'dilator' && datagroup != 'extractor') e.focusout()
                    else save_otherck(datagroup, subgroup, e.attr('name'), '')

                }
            }

            save_text(datagroup, true)

            checkboxes = document.querySelectorAll('.checkboxgroupsave_edit:checked');
            if (datagroup == 'complete_cholangiogram' && !cholcomp_i.includes(parseInt(index)) && $(this).is(
                    ':checked')) {
                cholcomp_i.push(subgroup)
            } else if (datagroup == 'cholangiogram' && !cholangiogram_i.includes(parseInt(index)) && $(this).is(
                    ':checked')) {
                cholangiogram_i.push(subgroup)
            }

            for (var i = 0; i < checkboxes.length; i++) {
                // array.push(checkboxes[i].value)
                // array.push($(checkboxes[i]).attr('subgroup'))
                let subgroup = $(checkboxes[i]).attr('subgroup')
                if (subgroup.includes('complete_cholangiogram') && !cholcomp_ck.includes(subgroup)) {
                    cholcomp_ck.push(subgroup)
                } else if (subgroup.includes('cholangiogram') && !cholangiogram_ck.includes(subgroup)) {
                    cholangiogram_ck.push(subgroup)
                } else {
                    if (!other_ck[datagroup].includes(subgroup)) {
                        other_ck[datagroup].push(subgroup)
                    }
                }
            }


            if (!$(this).is(':checked')) {
                if (subgroup.includes('complete_cholangiogram')) {
                    let i = cholcomp_i.indexOf(subgroup)
                    if (i !== -1) {
                        cholcomp_i.splice(i, 1)
                    }
                    track_unck = i
                } else {
                    let i = cholangiogram_i.indexOf(subgroup)
                    if (i !== -1) {
                        cholangiogram_i.splice(i, 1)
                    }
                    track_unck = i
                }
            }

            if (!subgroup.includes('cholangiogram')) {
                save_otherck(datagroup, subgroup, `${subgroup}_ck`, other_ck)
                return
            }

            if (value == undefined || value == '' || value == 'on') {
                is_show = false
                is_write = false
            }

            if (cholangiogram_text[datagroup][subgroup] != null ||
                cholangiogram_text[datagroup][subgroup] != undefined) {
                is_show = true
                is_write = false
            }

            if (is_write) {
                write_text(datagroup, subgroup, value, value, true)
            }
            if (is_show) {
                show_text(datagroup, true)
            }

            let new_data = {}
            let array = subgroup.includes('complete_cholangiogram') ? cholcomp_ck : cholangiogram_ck
            let key_array = `${datagroup}_ck`
            for (let key in array) {
                let value = array[key];
                new_data[key] = value
            }
            let json = JSON.stringify(new_data)

            $.post('{{ url('api/procedure') }}', {
                event: "checkboxgroupsave_edit",
                cid: cid,
                datagroup: key_array,
                value: json
            }, function(d, s) {})

            let sort_data = {}
            array = subgroup.includes('complete_cholangiogram') ? cholcomp_i : cholangiogram_i
            key_array = `${datagroup}_i`
            for (let key_two in array) {
                let value_two = array[key_two];
                sort_data[key_two] = value_two
            }
            json = JSON.stringify(sort_data)

            $.post('{{ url('api/procedure') }}', {
                event: "checkboxgroupsave_edit",
                cid: cid,
                datagroup: key_array,
                value: json
            }, function(d, s) {})

            save_textarea(datagroup, true)

            if (datagroup == 'complete_cholangiogram' && !prev_cholcomp.includes(parseInt(index)) && $(this).is(
                    ':checked')) {
                prev_cholcomp.push(subgroup)
            } else if (datagroup == 'cholangiogram' && !prev_chol.includes(parseInt(index)) && $(this).is(
                    ':checked')) {
                prev_chol.push(subgroup)
            }
            if (!$(this).is(':checked')) {
                if (subgroup.includes('complete_cholangiogram')) {
                    let i = prev_cholcomp.indexOf(subgroup)
                    if (i !== -1) {
                        prev_cholcomp.splice(i, 1)
                    }
                } else {
                    let i = prev_chol.indexOf(subgroup)
                    if (i !== -1) {
                        prev_chol.splice(i, 1)
                    }
                }
            }

        });

        $(".radiosave_edit").click(function() {
            let datagroup = $(this).attr("datagroup");
            let subgroup = $(this).attr("subgroup")
            let position = $(this).attr("position")
            let name = $(this).attr('name')
            let value = $(this).val();
            // console.log(datagroup, subgroup, position, name, value);

            let checkbox = $(`.checkboxgroupsave_edit[subgroup="${subgroup}"]`)
            if (value != '') {
                if (checkbox.is(':checked') == false) checkbox.click()
                if (subgroup == 'cholangiogram_smooth') {
                    if (value != 'distal CBD') value = $(`.savejson_edit[subgroup="cholangiogram_smooth"]`).val()
                }
                if (subgroup == 'cholangiogram_filling') {
                    if (value == 'No filling defect') $(`input[datagroup="${datagroup}"][subgroup="${subgroup}"]`)
                        .val('').focusout()
                }
            } else {
                if (checkbox.is(':checked')) checkbox.click();
                $(checkbox).val($())
            }

            if (!subgroup.includes('cholangiogram')) {
                save_otherck(datagroup, subgroup, name, value)
                return
            }
            write_text(datagroup, subgroup, position, value)
            show_text(datagroup)
            save_text(datagroup)
            save_textarea(datagroup)
        });

        let subgroup_arr = ['Periampullary', 'complicationercp']
        $(".savejson_edit").on('focusout', function() {
            let datagroup = $(this).attr("datagroup");
            let subgroup = $(this).attr("subgroup")
            let position = $(this).attr("position")
            let name = $(this).attr('name')
            let value = $(this).val();

            let checkbox = $(`.checkboxgroupsave_edit[subgroup="${subgroup}"]`)
            if (value != '' && value != '0') {
                if (checkbox.is(':checked') == false) checkbox.click()
            } else {
                if (value == '' || value == undefined) {
                    if (subgroup != 'cholangiogram_filling') {
                        if (checkbox.is(':checked')) checkbox.click()
                    }
                } else if (value == '0') {
                    let select = $(`select[subgroup="${subgroup}"]`).length
                    let is_empty = true
                    for (let j = 0; j < select; j++) {
                        let sel_val = $($(`select[subgroup="${subgroup}"]`)[j]).val()
                        if (sel_val != '' && sel_val != '0') is_empty = false
                    }
                    if (is_empty)
                        if (checkbox.is(':checked')) checkbox.click()
                }
                // if(checkbox.is(':checked')) checkbox.click()
            }

            let other_checkbox = $(`.ck-${subgroup}[position="${position}"]`)
            if ($(this).hasClass('ck-radio') && ($(this).val() != '' && $(this).val() != undefined)) {
                if (subgroup_arr.includes(subgroup)) {
                    if (!$(other_checkbox).is(':checked')) {
                        $(other_checkbox).click()
                    }
                    $(`#${datagroup}_other`).val('').focusout()
                } else {
                    $(`.ck-${subgroup}`).prop('checked', true).click()
                }
            } else if (($(this).val() != '' && $(this).val() != undefined)) {
                $(other_checkbox).prop('checked', true)
            } else if ($(this).val() == '') {
                if ($(other_checkbox).is(':checked')) {
                    $(other_checkbox).click()
                }
            }

            if (!subgroup.includes('cholangiogram')) {
                save_otherck(datagroup, subgroup, name, value)
                return
            }
            write_text(datagroup, subgroup, position, value)
            show_text(datagroup)
            save_text(datagroup)
            save_textarea(datagroup)
        });

        $('.ck-no').on('click', function() {
            let datagroup = $(this).attr("datagroup");
            let subgroup = $(this).attr("subgroup")
            let position = $(this).attr("position")
            let name = $(this).attr('name')
            if (datagroup == 'Periampullary mass') {
                for (let i = 0; i < $('.periampullary').length; i++) {
                    let is_checked = $($('.periampullary')[i]).is(':checked')
                    if (is_checked) {
                        $($('.periampullary')[i]).prop('checked', false)
                    }
                }
                $(`.ck-${subgroup}-input`).val('').change().focusout()
                save_otherck('Periampullary', 'Periampullary', 'Periampullary', 'No')
                let arr = {}
                arr['Periampullarymassyes'] = []
                call_savejsonedit('Periampullarymassyes', JSON.stringify(arr), true)
            } else {
                $(`.ck-${subgroup}-input`).val('').change().focusout()
            }
        })

        function write_text(datagroup, subgroup, position, value, is_ck = false) {
            if (cholangiogram_text[datagroup] == undefined || cholangiogram_text[datagroup] == null) {
                cholangiogram_text[datagroup] = []
            }
            if (position != null && position != '') {
                let replace_str = position.replace('{}', value)
                if (subgroup == 'cholangiogram_filling' || subgroup == 'cholangiogram_contrastat') {
                    let index = replace_str.includes('Filling defect') || replace_str.includes('Contrast') ? 0 : 1
                    if (replace_str.includes('filling defect')) {
                        cholangiogram_text[datagroup][subgroup] = []
                        index = 0
                    }
                    append_array(datagroup, subgroup, index, replace_str)
                } else if (subgroup == 'cholangiogram') {
                    let index = replace_str.includes('upstream') || replace_str.includes('Bilateral') ? 1 : 0
                    append_array(datagroup, subgroup, index, replace_str)
                } else {
                    cholangiogram_text[datagroup][subgroup] = replace_str
                }
            }

        }

        function append_array(datagroup, subgroup, index, replace_str) {
            if (cholangiogram_text[datagroup][subgroup] == undefined || cholangiogram_text[datagroup][subgroup] == null ||
                replace_str == 'No filling defect') {
                cholangiogram_text[datagroup][subgroup] = []
            }

            if (replace_str == "Filling defect/defects in Shape at") {
                let filling_other = $('#filling_other').val()
                let shapeat_other = $('#shapeat_other').val()
                // replace_str = `Filling defect/defects in ${filling_other} Shape at ${shapeat_other}`
                cholangiogram_text[datagroup][subgroup][0] = `Filling defect/defects in ${filling_other}`
                cholangiogram_text[datagroup][subgroup][1] = `Shape at ${shapeat_other}`
            } else if (replace_str == 'No filling defect') {
                cholangiogram_text[datagroup][subgroup][0] = `No filling defect`
            } else {
                cholangiogram_text[datagroup][subgroup][index] = replace_str
            }

            if ((filling_other == '' || filling_other == undefined) && (shapeat_other == '' || shapeat_other ==
                undefined)) {
                cholangiogram_text[datagroup][subgroup][0] = ''
                cholangiogram_text[datagroup][subgroup][1] = ''
            }
        }

        function save_text(datagroup, is_ck = false) {
            let ck_array = cholangiogram_text[datagroup]
            let new_data = {}
            for (let key in ck_array) {
                let value = ck_array[key];
                new_data[key] = value
            }
            let value = JSON.stringify(new_data)
            $.post('{{ url('api/procedure') }}', {
                event: "savejson_edit",
                cid: cid,
                datagroup: datagroup,
                value: value
            }, function(d, s) {})
        }

        let new_line_add = []

        function show_text(datagroup, is_ck = false) {
            let head = datagroup == 'cholangiogram' ? cholangiogram_ck : cholcomp_ck
            let indexes = datagroup == 'cholangiogram' ? cholangiogram_i : cholcomp_i
            let data_arr = cholangiogram_text[datagroup]
            let str = ''
            if (sort) {
                head = indexes
            }
            let old_arr = []
            let old_text = $(`#${datagroup}_other`).val()
            if (old_text != '') {
                let spt = old_text.split('\n')
                for (let k = 0; k < spt.length; k++) {
                    if (spt[k] != 'Free text' && spt[k] != undefined) {
                        // old_arr.push(spt[k])
                        let is_append = check_append(datagroup, spt[k])
                        if (is_append) {
                            if (track_unck < k && !(check_append(datagroup, spt[0]))) { // problem is here [1] replace [0]
                                new_line_add[k - 1] = spt[k]
                            } else {
                                new_line_add[k] = spt[k]
                            }
                        } else {
                            old_arr.push(spt[k])
                        }
                    }
                }
            }

            if (is_ck) {
                let compared = datagroup == 'cholangiogram' ? prev_chol : prev_cholcomp
                let dup = compared.filter(value => head.includes(value));
                indices = dup.map(value => compared.indexOf(value));
            }

            let new_arr = []
            if (head.length > 0) {
                for (let i = 0; i < head.length; i++) {
                    let group_data = data_arr[head[i]]
                    let line_for_arr = ''
                    if (indices[i] != undefined) {
                        if (old_arr[indices[i]] != undefined) {
                            if (group_data instanceof Array) {
                                group_data = group_data
                                line_for_arr = old_arr[indices[i]].split(' ')
                            } else {
                                if (group_data.length <= old_arr[indices[i]].length) {
                                    group_data = old_arr[indices[i]]
                                }
                            }
                        }
                    }

                    if (group_data instanceof Array) {
                        let this_line = ''
                        // group_data.forEach((e) =>{
                        //     this_line = this_line + e + ' '
                        //     str = str + e + ' '
                        // })
                        this_line = this_line.split(' ')
                        if (line_for_arr.length != 0 && line_for_arr != '') {
                            for (let i = 0; i < line_for_arr.length; i++) {
                                if (this_line[i] != undefined && this_line[i] != '') {
                                    line_for_arr[i] = this_line[i]
                                }
                            }
                            for (let j = 0; j < line_for_arr.length; j++) {
                                str = str + line_for_arr[j] + ' '

                            }
                        } else {
                            group_data.forEach((e) => {
                                str = str + e + ' '
                            })
                        }

                    } else {
                        str = str + group_data
                    }
                    str += '\n'
                }
                // have new line
                if (new_line_add.length > 0) {
                    let new_split = str.split('\n')
                    for (let y = 0; y < new_line_add.length; y++) {
                        if (new_line_add[y] == undefined) {
                            continue
                        }
                        new_split.splice(parseInt(y), 0, new_line_add[y])
                    }
                    str = new_split.join('\n')
                }
            } else {
                // have new line
                if (new_line_add.length > 0) {
                    new_split = []
                    Object.keys(new_line_add).forEach(index => {
                        new_split.push(new_line_add[index])
                    });
                    str = new_split.join('\n')
                }
            }

            new_line_add = []
            track_unck = 9999

            $(`#${datagroup}_other`).val(str)
            // $(`#${datagroup}_other`).val(new_str)
        }


        function check_append(datagroup, to_check) {
            if (to_check == '') {
                return
            }
            let not_append = []
            if (datagroup == 'cholangiogram') {
                not_append = ['Distal', 'Mid', 'Proximal', 'upstream to Hilar region', 'Bilateral IHD',
                    'smooth tapering', 'Contrast abruptly', 'No filling defect', 'Filling defect/defects in',
                    'Contrast', 'Cystic duct low lying', 'cystic duct', 'Gallbladder distension',
                    'Stricture at bile duct segment', 'Hilar stricture at'
                ]
            } else {
                not_append = ['Complete Cholangiogram from', 'No residual filling defect',
                    'No resistance', 'Minimal resistance at',
                    'No delay of contrast', 'Minimal delay of contrast in'
                ]
            }

            return should_append(to_check, not_append)
        }

        function should_append(str, arr) {
            for (let a of arr) {
                if (str.includes(a)) {
                    return false;
                }
            }
            return true;
        }

        function reset_value(key) {
            let new_val;
            switch (key) {
                case 'cholangiogram' || 'cholangiogram_contrastat' || 'cholangiogram_filling':
                    new_val = []
                    break;
                case 'complete_cholangiogram_delay' || 'complete_cholangiogram_resist':
                    new_val = ''
                    break;
                case 'cholangiogram_contrast':
                    new_val = 'Contrast abruptly disappear at'
                    break;
                case 'cholangiogram_cystic':
                    new_val = 'Cystic duct low lying'
                    break;
                case 'cholangiogram_cystic_duct':
                    new_val = 'cystic duct'
                    break;
                case 'cholangiogram_gallbladder':
                    new_val = 'Gallbladder distension  evidence of filling defect'
                    break;
                case 'cholangiogram_hilar':
                    new_val = 'Hilar stricture at'
                    break;
                case 'cholangiogram_smooth':
                    new_val = 'smooth tapering in short segment at'
                    break;
                case 'cholangiogram_stricture':
                    new_val = 'Stricture at bile duct segment'
                    break;
                case 'complete_cholangiogram_from':
                    new_val = 'Complete Cholangiogram from'
                    break;
                case 'complete_cholangiogram_no_residual':
                    new_val = 'No residual filling defect'
                    break;
            }
            return new_val
        }

        function set_array_with_data(datagroup, cholangiogram_text, ck_array) {
            // get data from database if not set as default
            if (cholangiogram_text[datagroup] == undefined || cholangiogram_text[datagroup] == null) {
                cholangiogram_text[datagroup] = []
            }

            if (datagroup == 'cholangiogram') {
                cholangiogram_text[datagroup]['cholangiogram'] = c['cholangiogram'] ? c['cholangiogram'] : []
                cholangiogram_text[datagroup]["cholangiogram_contrast"] = c['cholangiogram_contrast'] ? c[
                    'cholangiogram_contrast'] : 'Contrast abruptly disappear at'
                cholangiogram_text[datagroup]["cholangiogram_contrastat"] = c['cholangiogram_contrastat'] ? c[
                    'cholangiogram_contrastat'] : []
                cholangiogram_text[datagroup]["cholangiogram_cystic"] = c['cholangiogram_cystic'] ? c[
                    'cholangiogram_cystic'] : 'Cystic duct low lying'
                cholangiogram_text[datagroup]["cholangiogram_cystic_duct"] = c['cholangiogram_cystic_duct'] ? c[
                    'cholangiogram_cystic_duct'] : 'cystic duct'
                cholangiogram_text[datagroup]["cholangiogram_filling"] = c['cholangiogram_filling'] ? c[
                    'cholangiogram_filling'] : []
                cholangiogram_text[datagroup]["cholangiogram_gallbladder"] = c['cholangiogram_gallbladder'] ? c[
                    'cholangiogram_gallbladder'] : 'Gallbladder distension  evidence of filling defect'
                cholangiogram_text[datagroup]["cholangiogram_hilar"] = c['cholangiogram_hilar'] ? c['cholangiogram_hilar'] :
                    'Hilar stricture at'
                cholangiogram_text[datagroup]["cholangiogram_smooth"] = c['cholangiogram_smooth'] ? c[
                    'cholangiogram_smooth'] : 'smooth tapering in short segment at'
                cholangiogram_text[datagroup]["cholangiogram_stricture"] = c['cholangiogram_stricture'] ? c[
                    'cholangiogram_stricture'] : 'Stricture at bile duct segment'
            } else {
                cholangiogram_text[datagroup]["complete_cholangiogram_delay"] = cc['complete_cholangiogram_delay'] ? cc[
                    'complete_cholangiogram_delay'] : ''
                cholangiogram_text[datagroup]["complete_cholangiogram_from"] = cc['complete_cholangiogram_from'] ? cc[
                    'complete_cholangiogram_from'] : 'Complete Cholangiogram from'
                cholangiogram_text[datagroup]["complete_cholangiogram_no_residual"] = cc[
                        'complete_cholangiogram_no_residual'] ? cc['complete_cholangiogram_no_residual'] :
                    'No residual filling defect'
                cholangiogram_text[datagroup]["complete_cholangiogram_resist"] = cc['complete_cholangiogram_resist'] ? cc[
                    'complete_cholangiogram_resist'] : ''
            }

            return cholangiogram_text
        }

        function save_otherck(datagroup, subgroup, name, value) {
            let new_value = value
            let new_array = {}
            if (value instanceof Array) {
                new_array[`${datagroup}_ck`] = value[datagroup]
            } else {
                new_array[name] = value
            }
            new_value = JSON.stringify(new_array)
            call_savejsonedit(datagroup, new_value, true)
        }
    </script>

    <script>
        $("#formviewreport").keypress(function(e) {
            if (event.target.tagName != 'TEXTAREA') {
                if (event.keyCode == 13) {
                    event.preventDefault();
                    return false;
                }
            }
        });
    </script>
    <script>
        autosize(document.querySelectorAll('textarea'));
    </script>
@endsection
