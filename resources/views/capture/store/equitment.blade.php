@extends('capture.layoutv6')
@php
    use App\Models\Equipment;
@endphp
@section('style')
    <style>
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
            margin-top: 5.5em;
        }

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

        .page-title-box {
            padding: 15px 1.5rem;
            background-color: var(--vz-card-bg-custom);
            -webkit-box-shadow: 0 1px 2px rgba(56, 65, 74, .15);
            box-shadow: 0 1px 2px rgba(56, 65, 74, .15);
            border-bottom: 1px solid none;
            margin: -23px -1.5rem 1.5rem -1.5rem;
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

        .small-input {
            max-width: 20%;
        }

        .nav-success .nav-size {
            font-size: 14px !important;
        }
    </style>
@endsection

@section('title-left')

@endsection

@section('title-right')
    <ol class="breadcrumb m-0">

    </ol>
@endsection

@section('modal')
@endsection

@section('content')
    {{-- @dd($vdo); --}}
    {{-- @dd($case->photo); --}}
    @php
        use App\Models\Mongo;

    @endphp

    <div class="row ps-2">
        @include('capture.case.component.procedure_edit')
        @include('capture.case.component.new.patient_detail')
        @include('capture.case.component.admin_alert')
    </div>
    @include('capture.camera.obs.js_hotkey')
    @include('capture.case.component.new.tap')


    <div class="card">
        <div class=" p-3" style="border-bottom: 1px #E9EBEC solid">
            <div class="col-12 m-3" style="padding-left:10px; font-weight: bold;">
                Equipment
            </div>
            <div class="col-12 text-gray ms-2 ps-3">
                “Equipment and quantity used in the procedure”
            </div>
        </div>
        <form action="{{ url('store') }}" method="POST">
            <input type="hidden" name="event" value="case_equitment">
            <input type="hidden" name="cid" value="{{ @$cid }}">
            <input type="hidden" name="caseuniq" value="{{ @$caseuniq }}">
            <input type="hidden" name="comcreate" value="{{ @$case->comcreate }}">
            @csrf
            <div class="col-12 ">
                <div class="row">
                    <div class="col-6" style="padding: 3%">
                        <div class="table-responsive table-card ">
                            <table class="table table-nowrap mb-0 table-borderless">
                                <thead class="table-light">
                                    <tr class="fw-bold" style="color: #495057;">
                                        <td style="width: 70%">Type Equipment</td>
                                        <td style="width: 15%">Volume</td>
                                        <td style="width: 15%">Total quantity</td>
                                    </tr>
                                </thead>
                                <tbody>

                                    @for ($i = 0; $i < 5; $i++)

                                        <tr>
                                            <td>
                                                <select name="equipment[]"
                                                    class="form-select flex-grow-1 me-3 select_equitment check_select"
                                                    aria-label="Default select example">
                                                    <option value="">Open this select menu</option>
                                                    @foreach ($tb_equipment as $data)
                                                        <option value="{{ $data->eq_id }}"
                                                            data-balance="{{ Equipment::balance($data->eq_id) }}"
                                                            @selected(@$case->equipment[$i]['equit_id'] == @$data->eq_id)>
                                                            {{ @$data->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <div>
                                                    <input name="num[]" type="number" class="form-control amount"
                                                        eqsum="{{ $i }}" id="amount_{{ $i }}"
                                                        value="{{ @$case->equipment[$i]->amount }}"
                                                        onkeyup="saveInputValue({{ $i }}, this.value)"
                                                        onchange="saveInputValue({{ $i }}, this.value)">
                                                </div>
                                            </td>
                                            <td>

                                                @php

                                                    $balance = Equipment::balance(@$case->equipment[$i]['equit_id']);

                                                @endphp
                                                {{-- @php
                                                $eq_store = Mongo::table("tb_equipment_store")
                                                ->where("equipment_id" , $data['ID'])
                                                ->where("display" , "show")
                                                ->sum("amount");
                                                @endphp --}}
                                                <div>
                                                    <input type="text"
                                                        class="form-control txt_balance text-center text-danger"
                                                        id="txt_balance_{{ $i }}" value="{{ $balance }}"
                                                        readonly>
                                                </div>
                                            </td>
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-5" style="padding: 3%">
                        <div>
                            <label for="exampleFormControlTextarea5" class="form-label m-3 fs-18">Note</label>
                            <textarea class="form-control" id="" name="other_equipment" placeholder="Free text" rows="12">{{ @$case->equipment[0]->txt_equipment }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-auto pt-1 m-3">
                        Equipment Record by
                    </div>
                    <div class="col-3 mt-1 pt-2">
                        <select class="form-select" aria-label="Default select example" name="equit_record_by" required>
                            <option value="">Open this select menu</option>
                            @foreach ($users as $data)
                                <option value="{{ $data->id }}" @selected((string)uid() == (string)$data->id)>{{ fullname($data) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-5"></div>
                    <div class="col-1 pt-2 mt-1  ">
                        <button type="submit" class="btn btn-primary btn-label waves-effect right waves-light w-lg ms-4"><i
                                class=" ri-play-fill label-icon align-middle fs-16 ms-2"></i> Confirm</button>
                    </div>
                </div>
            </div>
        </form>

    </div>
@endsection


@section('script')
    {{-- <script>
    $(document).ready(function () {
        let eq_id = {};
    $(".select_equitment").change(function(){

       var eq_id = $(this).val();
       var $row = $(this).closest('tr');

       if(eq_id === eq_id){
        console.log(eq_id);
        alert("This equipment is already selected. Please choose a different one.");
       }
           $.post('{{url("storemanage")}}',{
               event : 'get_valueformselect',
               eq_id : eq_id
           }, function(data , status){
               console.log(data);
               $row.find(".txt_balance").val(data);
               $row.find(".txt_balance").css("background" , "#D2EBF6");

           })
    })
})
</script> --}}
    {{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> --}}
    <script src="{{ url('assets/js/sweetalert.js') }}"></script>


    <script>
        $(".select_equitment").change(function() {
            var eq_id = $(this).val();
            var row = $(this).closest('tr');

            if (eq_id === "") {
                row.find(".txt_balance").val("");
                return;
            }

            var isDuplicate = false;
            $(".select_equitment").each(function() {
                if ($(this).val() === eq_id && $(this)[0] !== row.find('.select_equitment')[0]) {
                    isDuplicate = true;
                    return false;
                }
            });

            if (isDuplicate) {
                Swal.fire("This Equipment has been selected");
                $(this).val('');
                row.find(".txt_balance").val("");
            } else {
                var balance = $(this).find("option:selected").data('balance');
                row.find(".txt_balance").val(balance);
                row.find(".txt_balance").css("background", "#D2EBF6");
            }
        });

        $(document).ready(function() {


            $(".amount").focusout(function() {
                let eqsum = $(this).attr("eqsum")

                let amount = $(this).val();
                let balance = $("#txt_balance_" + eqsum).val();
                let sum_data = balance - amount
                var row = $(this.closest('tr'));



                // $("#txt_balance_" + eqsum).val(sum_data);
            })


        })
    </script>
@endsection
