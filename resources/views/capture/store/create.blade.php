@extends('capture.layoutv6')
@section('style')
    <style>
        .page-title-box {
            padding: 15px 1.5rem;
        }

        .row {
            margin: 0;
        }

        .gap-between+.gap-between {
            margin-left: 50px;
        }

        .col-5 {
            width: 46.666667% !important;
        }
    </style>
@endsection

@php
use App\Models\Equipment;
@endphp

@section('modal')
    @include('capture.store.component.modal_addeq')
@endsection

@section('title-left')

@endsection


@include('capture.camera.obs.js_hotkey')
@section('content')
    <div class="card">
        <h4 class="mb-sm-0 m-4"><b>Store Management</b></h4>
        <div class="row p-4" style="border-bottom: 1px #E9EBEC solid">
            <div class="col-6">
                <span class="fs-16 fw-bold">Add Equipment</span>
            </div>
            <div class="col-6 text-end">
                <button type="button" class="btn btn-soft-secondary w-lg waves-effect" data-bs-toggle="modal"
                    data-bs-target="#modal_addequitment">+ Add new equipment
                </button>

            </div>
        </div>
        <div class="row p-3 d-flex justify-content-center">

            <form action="{{ url('storemanage') }}" method="POST">
                @csrf

                <input type="hidden" name="event" value="equitment_fill">
                <div class="col-12 p-0 gap-between " style="border: 1px solid #ced4da;">
                    <div class="col-12 p-3 mb-3" style="background: #f3f6f9 ; border-bottom: 1px solid #ced4da">
                        <span class="h5 text-color-index">Restock existing equipment</span>
                    </div>

                    <table class="table  table-nowrap">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 70%; "> &ensp; &ensp; Equipment</th>
                                <th style="width: 15%;">Remaining stock</th>
                                <th style="width: 15%;">Volume</th>
                            </tr>
                        </thead>
                        <tbody>


                            @for ($i = 0; $i < 5; $i++)
                                <tr>
                                    <td>
                                        {{-- @dd($tb_equipment) --}}
                                        <select name="equipment[]" class="form-select select2 select_equitment"
                                            aria-label="Default select example">
                                            <option value="">Open this select menu</option>
                                            @foreach ($tb_equipment as $data)
                                                <option value="{{ $data->eq_id }}">{{ @$data->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control txt_balance text-danger text-center"
                                            readonly autocomplete="off">
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" autocomplete="off" name="amount[]">
                                    </td>
                                </tr>
                            @endfor
                        </tbody>
                    </table>
                    <div class="row mb-2">
                        <div class="col-2">
                            Add Equipment by
                        </div>
                        <div class="col-3">
                            <select class="form-select " id="" aria-label="Default select example"
                                name="user_use_equitment" required>
                                <option value="">Select Edit by</option>
                                @foreach ($nurse as $n)
                                    @php
                                        $n = (object) $n;
                                    @endphp
                                    <option value="{{ $n->uid }}" @selected($n->uid == uid())>{{ fullname($n) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-soft-success w-lg waves-effect">Save </button>
                        </div>
                    </div>
            </form>

        </div>

    </div>

    </div>


    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-12 text-end ">
                    <!-- Buttons with Label Right -->
                    <a href="{{ url('storemanage') }}"
                        class="btn btn-danger  btn-label waves-effect right waves-light w-lg ">
                        <i class=" ri-arrow-go-back-line label-icon align-middle fs-16 ms-2"></i> Back</a>
                    <button type="submit" class="btn btn-primary btn-label waves-effect right waves-light w-lg ms-4"><i
                            class=" ri-play-fill label-icon align-middle fs-16 ms-2"></i> Confirm</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                placeholder: "Select",
                // allowClear: true,
            });
            $('.select2').on('select2:open', function(e) {
                $('.select2-dropdown').hide();
                setTimeout(function() {
                    jQuery('.select2-dropdown').slideDown(300);
                });
            });
        });
    </script>


    <script>
        $(".select_equitment").change(function() {
            var eq_id = $(this).val();
            var $row = $(this).closest('tr');

            if(eq_id) {
                $.ajax({
                    url: '{{ route("capture.getBalance") }}',  // สร้าง route ใหม่สำหรับดึงข้อมูล balance
                    type: 'POST',
                    data: {
                        eq_id: eq_id,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        $row.find(".txt_balance").val(response.balance);
                    }
                });
            } else {
                $row.find(".txt_balance").val('');
            }
        });
    </script>
@endsection
