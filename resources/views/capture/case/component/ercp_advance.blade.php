@extends('layouts.layouts_index.main')
@section('title', 'EndoINDEX')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<link href="{{ url('assets/css/select2.min.css') }}" rel="stylesheet" />
<script src="{{ url('assets/js/select2.min.js') }}"></script>
@section('title-left')
    <h4 class="mb-sm-0">PHYSICIAN RECORD</h4>
@endsection

@section('title-right')
    <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><a href="javascript: void(0);">Cases list</a></li>
        <li class="breadcrumb-item active">Physician Record</li>
    </ol>
@endsection
@section('modal')
    @include('case.component.ercp_advance.component.modal_selectphoto')
@endsection


@section('style')


    @include('case.component.css.css')
    <style>
        .custom_cardbox {
            border: 1px solid #0AB39C66;
            border-radius: 4px;
        }

        .bg-greenfade {
            background: #0AB39C1A;
        }

        .btn-transparent {
            background: transparent;
            color: #f06548;
            border: 0px;

        }


        .select2-container--default .select2-results__option--selected {
            background: transparent;

        }

        .select2-container--default .select2-selection--single {
            background: #f3f6f9;
            border: 1px transparent solid !important;
            transition: box-shadow 0.3s ease-in;

        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice {
            background: #245788;
            color: #ffffff;
            border: 0px !important;
        }

        .select2-container--default .select2-selection--multiple {
            background: #193D61;
            border: 0px !important;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__display {
            background: #245788;
            color: #ffffff;
        }

        .select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
            color: #ffffff;
            border: 0px !important;
        }

        .select2-container--default .select2-results__option--highlighted.select2-results__option--selectable {
            background: #245788 !important;
        }

        .select2-results__option {
            color: #000000
        }

        .select2-dropdown {
            border: 1px solid #d4d6d8;
        }

        .select2-container .select2-selection--single .select2-selection__rendered {
            padding-top: 5px;
        }

        .select2-container--default .select2-selection--single {
            height: 38px;
            border: 0px solid var(--vz-input-border) !important;
        }

        .select2-results__options::-webkit-scrollbar {
            width: 8px;
            background-clip: padding-box;
        }

        .select2-results__options::-webkit-scrollbar-track {
            background-color: #f4f4f4;
            height: 8px;
            border-right: 5px solid rgba(0, 0, 0, 0);
            border-top: 5px solid rgba(0, 0, 0, 0);
            border-bottom: 5px solid rgba(0, 0, 0, 0);
        }

        .select2-results__options::-webkit-scrollbar-thumb {
            background-color: #9599ad;
            border-right: 5px solid rgba(0, 0, 0, 0);
            border-top: 5px solid rgba(0, 0, 0, 0);
            border-bottom: 5px solid rgba(0, 0, 0, 0);
            border-radius: 4px;
        }


        #modal_selectphoto .modal-dialog {
            --vz-modal-width: 900px;
        }

        #modal_selectphoto .modal-dialog,
        .modal-content {
            height: 80%;

        }

        .text-soft-blue {
            color: #24578880;
        }

        .card-custom {
            background: #F3F6F9;
        }

        .text-count-blue {
            color: #325684;
            font-size: 14px;
        }
    </style>
@endsection



@section('content')

    <div class="px-3">
        @include('case.component.ercp_advance.component.php_ERCP')
        @include('case.component.new.patient_detail')
         @include('case.component.ercp_advance.component.add_cannu')
         @include('case.component.ercp_advance.component.add_pri')
         @include('case.component.ercp_advance.component.add_cholang')
        @include('case.component.ercp_advance.component.add_stricture')
        @include('case.component.ercp_advance.component.add_stent')

        <form action="{{ url('procedure') }}" method="POST">
            @csrf

            <input type="hidden" name="event" value="findingtemp">
            <input type="hidden" name="cid" value="{{ $cid }}">
            <input type="hidden" name="findinggroup[]" value="cannulation">
            <input type="hidden" name="findinggroup[]" value="previous">
            <input type="hidden" name="findinggroup[]" value="cholangiogram">
            <input type="hidden" name="findinggroup[]" value="stricture">
            <input type="hidden" name="findinggroup[]" value="stent">
             @include('case.component.ercp_advance.cannulation')
             @include('case.component.ercp_advance.pri_stent')
          @include('case.component.ercp_advance.cholangiogram')
            @include('case.component.ercp_advance.stricture')
            @include('case.component.ercp_advance.stent')

            <div class="col-12 my-3 text-end">
                <a type="button" href="{{ url("procedure/$cid") }}"
                    class="btn btn-primary w-lg btn-label waves-effect right waves-light"><i
                        class="ri-arrow-go-back-line label-icon align-middle fs-16 ms-2"></i> Back</a>
                <button type="submit" class="btn btn-success w-lg btn-label waves-effect right waves-light"><i
                        class="ri-check-double-fill label-icon align-middle fs-16 ms-2"></i> Save</button>

            </div>
        </form>
    </div>


@endsection
@section('script')

    <script>
        var selectList = $('#sel_cannu option');

        selectList.sort(function(a, b) {
            a = a.value;
            b = b.value;

            return a - b;
        });

        $('#sel_cannu').html(selectList);
    </script>
    <script src="{{ url('assets/js/select2.min.js') }}"></script>
    <script src="{{ url('assets/js/pages/select2.init.js') }}"></script>


    <script>
        $(document).on('click', '.remove', function() {
            $(this).closest(".advance").remove();

        });
    </script>

    <script>
        function selectRefresh() {
            $('.main .select2').select2({
                //-^^^^^^^^--- update here
                tags: true,
                placeholder: "Select an Option",
                allowClear: true,
                width: '100%'
            });
        }
        $('.btn_addlesson_cbd01').click(function() {
            let cannu = $(".add_cannu").html()
            $(".cannulation").append(cannu)
            selectRefresh();
        });

        $(document).ready(function() {
            selectRefresh();
        });

        $(".btn_addlesson_cbd02").click(function() {
            let cannu = $(".add_cannu1").html();
            $(".cannulation1").append(cannu);
        });



        $('.btn_addlesson_pd01').click(function() {
            let cannu = $(".add_cannu2").html()
            $(".cannulation2").append(cannu)
            selectRefresh();
        });


        $('.btn_addlesson_pd02').click(function() {
            let cannu = $(".add_cannu3").html()
            $(".cannulation3").append(cannu)
            selectRefresh();
        });



        $(".btn_addlesson2").click(function() {
            let cannu = $(".add_previousstent").html();
            $(".previousstent").append(cannu);
        });
        $(".btn_addlesson3").click(function() {
            let cannu = $(".add_cholan").html();
            $(".cholan").append(cannu);
        });
        $(".btn_addlesson4").click(function() {
            let cannu = $(".add_cholan1").html();
            $(".cholan1").append(cannu);
        });
        $(".btn_addlesson5").click(function() {
            let cannu = $(".add_stricture").html();
            $(".stricture").append(cannu);
        });
        $(".btn_addlesson6").click(function() {
            let cannu = $(".add_stricture1").html();
            $(".stricture1").append(cannu);
        });
        $(".btn_addlesson7").click(function() {
            let cannu = $(".add_stent").html();
            $(".stent").append(cannu);
        });




        $(".btn_addlesson8").click(function() {
            let cannu = $(".add_stent02").html();
            $(".stent02").append(cannu);
        });
    </script>


    {{-- <script>
        $(document).ready(function() {
            function initializeSelect2(element) {
                $(element).select2({
                    placeholder: "Select",
                    allowClear: true
                });
            }
            initializeSelect2('.ercp_select2');
            $(".btn_addlesson").click(function() {
                let cannu = $(".add_cannu").clone();
                cannu.removeClass('add_cannu').removeAttr('style');
                let newRow = $('<div class="row"></div>');
                newRow.append(cannu);

                $(".cannulation").append(newRow);
                newRow.find('.ercp_select2').each(function() {
                    initializeSelect2(this);
                });
            });
        });
    </script> --}}

    {{-- <script>
        $(document).ready(function() {
            function initializeSelect2(element) {
                $(element).select2({
                    placeholder: "Select",
                    allowClear: true
                });
            }
            initializeSelect2('.ercp_select2');
            $(".btn_addlesson1").click(function() {
                let cannu = $(".add_cannu1").html();
                $(".cannulation1").append(cannu);
                $(".cannulation1").find('.ercp_select2').each(function() {
                    initializeSelect2(this);
                });
            });
        });
    </script> --}}


    <script>
        $(document).ready(function() {
            function initializeSelect2(element) {
                $(element).select2({
                    placeholder: "Select",
                    allowClear: true
                });
            }
            initializeSelect2('.ercp_select2');
            $(".btn_addlesson2").click(function() {
                let prist = $(".add_pristent").html();
                $(".pristent").append(prist);
                $(".pristent").find('.ercp_select2').each(function() {
                    initializeSelect2($(this));
                });
            });
        });
    </script>

    <!-- <script>
        $(document).ready(function() {

            $('.ercp_select2').select2({
                placeholder: "Select",
                allowClear: true
            });

            $('.ercp_select2').on('select2:open', function(e) {
                $('.select2-dropdown').hide();
                setTimeout(function() {
                    jQuery('.select2-dropdown').slideDown(300);
                });
            });
        })
    </script> -->
@endsection
