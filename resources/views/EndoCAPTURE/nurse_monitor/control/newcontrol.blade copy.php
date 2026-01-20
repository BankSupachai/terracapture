@extends('layouts.layouts_index.main')
@php
    use App\models\Mongo;
@endphp



@section('title', 'Nurse Monitor')
@section('style')
    <style>
        .text-under {
            -webkit-text-decoration-line: underline;
            /* Safari */
            text-decoration-line: underline;
        }

        td {
            vertical-align: middle;
        }

        .btn-dark-primary:hover {
            background: #103d68;
            color: #fff;
        }

        .badge-outline-case {
            border: 1px solid #CED4DA;
            background: transparent;
            color: #707070;
        }
        .fw-head-dark{
            color: #535353;
            font-weight: 600;
        }

        .btn-icon {
            border-radius: 5px;
        }

        .btn-orange {
            background: #DF6E51;
            color: #FFFFFF;
        }

        .booking tr td:nth-child(1) {
            width: 5%;
        }

        .booking tr td:nth-child(2) {
            width: 10%;
        }

        .booking tr td:nth-child(3) {
            width: 10%;
        }

        .booking tr td:nth-child(4) {
            width: 10%;
        }

        .booking tr td:nth-child(5) {
            width: 10%;
        }

        .holding tr td:nth-child(1) {
            width: 5%;
        }

        .holding tr td:nth-child(2) {
            width: 10%;
        }

        .holding tr td:nth-child(3) {
            width: 10%;
        }

        .holding tr td:nth-child(4) {
            width: 10%;
        }

        .holding tr td:nth-child(5) {
            width: 10%;
        }

        .holding tr td:nth-child(6) {
            width: 10%;
        }

        .operation tr td:nth-child(1) {
            width: 5%;
        }

        .operation tr td:nth-child(2) {
            width: 10%;
        }

        .operation tr td:nth-child(3) {
            width: 10%;
        }

        .operation tr td:nth-child(4) {
            width: 10%;
        }

        .operation tr td:nth-child(5) {
            width: 10%;
        }

        .operation tr td:nth-child(6) {
            width: 10%;
        }

        .recovery tr td:nth-child(1) {
            width: 5%;
        }

        .recovery tr td:nth-child(2) {
            width: 10%;
        }

        .recovery tr td:nth-child(3) {
            width: 10%;
        }

        .recovery tr td:nth-child(4) {
            width: 10%;
        }

        .recovery tr td:nth-child(5) {
            width: 10%;
        }
    </style>
@endsection

@section('title-left')
    <h4 class="mb-sm-0">CASE CONTROL</h4>
@endsection
@section('title-right')
    <ol class="breadcrumb m-0">
        <li class="breadcrumb-item"><a href="javascript: void(0);">Management</a></li>
        <li class="breadcrumb-item active">Case Control</li>
    </ol>
@endsection

@section('modal')

    @include('EndoCAPTURE.nurse_monitor.component.modalDoctor')

    @include('EndoCAPTURE.nurse_monitor.component.modalNurse')


    @include('EndoCAPTURE.nurse_monitor.component.modalRegister')


    @include('EndoCAPTURE.nurse_monitor.component.modalCancleCaseHn')

    @include('EndoCAPTURE.nurse_monitor.component.modalroom')

    @include('EndoCAPTURE.nurse_monitor.component.modal_patient')


@endsection
@section('content')

    <div class="row m-0 mb-5">
        <div class="col-lg-12">
            <div class="card mb-0">
                <div class="card-body">
                    <div class="row m-0">
                        <div class="col-lg-12">
                            <div class="row m-0">
                                <div class="col-lg-8 pl-3">
                                    <div class="h5 ">Officer   Setting</div>
                                </div>
                                <div class="col-lg-4 pl-3">
                                    <div class="h5 ">Noted</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-8">
                            <div class="row m-0 p-2 cn">
                                <div class="col-lg-2">
                                    <label class="checkbox">
                                        <input class="form-check-input room_ready" type="checkbox" />
                                        <span></span>
                                        &ensp; &ensp; In charge
                                    </label>
                                </div>
                                <div class="col-lg-10">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="input-group">
                                                <button class="btn btn-primary btn-icon" type="button" id="button-addon1"
                                                    data-bs-toggle="modal" data-bs-target="#roomModal"><i
                                                        class="ri-settings-2-fill"></i></button>
                                                <input type="text" class="form-control bg-gray-input" placeholder=""
                                                    aria-label="Example text with button addon"
                                                    aria-describedby="button-addon1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row m-0 p-2 cn">
                                <div class="col-lg-2">
                                    <label class="checkbox">
                                        <input class="form-check-input room_ready" type="checkbox" />
                                        <span></span>
                                        &ensp; &ensp; Recovery
                                    </label>
                                </div>
                                <div class="col-lg-10">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="input-group">
                                                <button class="btn btn-primary btn-icon" type="button" id="button-addon1"
                                                    data-bs-toggle="modal" data-bs-target="#roomModal"><i
                                                        class="ri-settings-2-fill"></i></button>
                                                <input type="text" class="form-control bg-gray-input" placeholder=""
                                                    aria-label="Example text with button addon"
                                                    aria-describedby="button-addon1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row m-0 p-2 cn">
                                <div class="col-lg-2">
                                    <label class="checkbox">
                                        <input class="form-check-input room_ready" type="checkbox" />
                                        <span></span>
                                        &ensp; &ensp; Reprocess
                                    </label>
                                </div>
                                <div class="col-lg-10">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="input-group">
                                                <button class="btn btn-primary btn-icon" type="button" id="button-addon1"
                                                    data-bs-toggle="modal" data-bs-target="#roomModal"><i
                                                        class="ri-settings-2-fill"></i></button>
                                                <input type="text" class="form-control bg-gray-input" placeholder=""
                                                    aria-label="Example text with button addon"
                                                    aria-describedby="button-addon1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row m-0 p-2 cn">
                                <div class="col-lg-2">
                                    <label class="checkbox">
                                        <input class="form-check-input room_ready" type="checkbox" />
                                        <span></span>
                                        &ensp; &ensp; Leave
                                    </label>
                                </div>
                                <div class="col-lg-10">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="input-group">
                                                <button class="btn btn-primary btn-icon" type="button" id="button-addon1"
                                                    data-bs-toggle="modal" data-bs-target="#roomModal"><i
                                                        class="ri-settings-2-fill"></i></button>
                                                <input type="text" class="form-control bg-gray-input" placeholder=""
                                                    aria-label="Example text with button addon"
                                                    aria-describedby="button-addon1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row m-0 p-2 cn">
                                <div class="col-lg-2">
                                    <label class="checkbox">
                                        <input class="form-check-input room_ready" type="checkbox" />
                                        <span></span>
                                        &ensp; &ensp; Room 1
                                    </label>
                                </div>
                                <div class="col-lg-10">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="input-group">
                                                <button class="btn btn-primary btn-icon" type="button" id="button-addon1"
                                                    data-bs-toggle="modal" data-bs-target="#roomModal"><i
                                                        class="ri-settings-2-fill"></i></button>
                                                <input type="text" class="form-control bg-gray-input" placeholder=""
                                                    aria-label="Example text with button addon"
                                                    aria-describedby="button-addon1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row m-0 p-2 cn">
                                <div class="col-lg-2">
                                    <label class="checkbox">
                                        <input class="form-check-input room_ready" type="checkbox" />
                                        <span></span>
                                        &ensp; &ensp; Room 2
                                    </label>
                                </div>
                                <div class="col-lg-10">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="input-group">
                                                <button class="btn btn-primary btn-icon" type="button"
                                                    id="button-addon1"><i class="ri-settings-2-fill"></i></button>
                                                <input type="text" class="form-control bg-gray-input" placeholder=""
                                                    aria-label="Example text with button addon"
                                                    aria-describedby="button-addon1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row m-0 p-2 cn">
                                <div class="col-lg-2">
                                    <label class="checkbox">
                                        <input class="form-check-input room_ready" type="checkbox" />
                                        <span></span>
                                        &ensp; &ensp; Room 3
                                    </label>
                                </div>
                                <div class="col-lg-10">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="input-group">
                                                <button class="btn btn-primary btn-icon" type="button"
                                                    id="button-addon1"><i class="ri-settings-2-fill"></i></button>
                                                <input type="text" class="form-control bg-gray-input" placeholder=""
                                                    aria-label="Example text with button addon"
                                                    aria-describedby="button-addon1">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="col-12">
                                <textarea name="" class="form-control" placeholder="Freetext" id="nurse_monitor_freetext" rows="10">{{ $writeboard }}</textarea>
                            </div>
                            <div class="col-12 text-center mt-5">
                                <button class="btn btn-primary w-75 "><i class="ri-refresh-line"></i> Update to
                                    Monitor</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 mt-2">
            <div class="card p-3 mb-0">
                <div class="row">
                    <div class="col-4">
                        <input type="text" class="form-control bg-gray-input" placeholder="Search for HN, Name…">
                    </div>
                    <div class="col-2">
                        <button type="button" class="btn btn-secondary btn-label waves-effect waves-light w-lg"><i class="ri-search-line label-icon align-middle fs-16 me-2"></i> Search</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12">
            <div class="row m-0">
                <div class="col-lg-12 p-0 m-0">
                    <div class="card mb-0 mt-2 ">
                        <div class="card-body m-0 px-0">
                            <div class="row m-0 ">
                                <div class="h5 fw-head-dark ms-4 mb-3">Booking
                                    ({{ isset($tb_booking) ? count($tb_booking) : 0 }})
                                </div>
                                <div class="col-lg-12 p-0 m-0">
                                    <div class="table-responsive p-0">
                                        <table class="table table-borderless booking">
                                            <tr class="bg-light">
                                                <td></td>
                                                <td></td>
                                                <td>HN</td>
                                                <td>Patient name</td>
                                                <td>Physician</td>
                                                <td>Procedure</td>
                                                <td>Description</td>
                                                <td></td>
                                            </tr>

                                            @isset($tb_booking)
                                                @foreach ($tb_booking as $data)
                                                    @php
                                                        $data = (object) $data;
                                                        $_id = $data->id;
                                                    @endphp
                                                    <tr>
                                                        <td >
                                                            <button class="btn btn-ghost-light btn-icon  " data-bs-toggle="modal" data-bs-target="#PatientMonitor">
                                                                <i class="ri-qr-code-fill text-primary ri-2x"></i>
                                                            </button>
                                                            <span>A02</span>
                                                        </td>
                                                        <td>
                                                            <a href="{{ url("book/registration/$data->noteid") }}"
                                                                class="btn btn-success btn-sm" hn="{{ @$data->hn }}">Check in</a>
                                                        </td>
                                                        <td>{{ @$data->hn }}</td>
                                                        <td>{{ @$data->prefixname }}{{ @$data->firstname }}
                                                            {{ @$data->lastname }}</td>
                                                        <td>{{ @$data->physician_name }}</td>
                                                        <td>
                                                            @foreach ($data->procedure as $val)
                                                                @php
                                                                    $tb_procedure = (object) Mongo::table('tb_procedure')
                                                                        ->where('code', $val)
                                                                        ->first();
                                                                @endphp
                                                                {{ @$tb_procedure->name }}
                                                                @if (count($data->procedure) > 1)
                                                                    <br>
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form form-control" onchange="save_description('Booking', '{{$data->hn}}', this.val(), '{{$data->bk_date}}')" value="{{@$data->description}}">
                                                        </td>
                                                        <td class="text-center"><i
                                                                class="ri-close-fill ri-2x text-danger cancel_by_hn"
                                                                hn="{{ @$data->noteid }}"></i></td>
                                                    </tr>
                                                @endforeach
                                            @endisset
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @php
                @endphp

                <div class="col-lg-12 p-0">
                    <div class="card mb-0 mt-2">
                        <div class="card-body m-0 px-0">
                            <div class="row m-0">
                                <div class="col-lg-12 ">
                                    @php
                                        $count_holding = get_case_count($tb_casemonitor['holding']);
                                        $count_operation = get_case_count($tb_casemonitor['operation']);
                                        $count_recovery = get_case_count($tb_casemonitor['recovery']);
                                    @endphp
                                    <div class="h5 fw-head-dark ms-4 mb-3">Holding ({{ $count_holding }})</div>
                                </div>
                                <div class="col-lg-12 m-0 px-0 ">
                                    <div class="table-responsive">
                                        <table class="table table-borderless holding">
                                            <tr class="bg-light">
                                                <td></td>
                                                <td></td>
                                                <td>HN</td>
                                                <td>Patient name</td>
                                                <td>Physician</td>
                                                <td>Room</td>
                                                <td>Waiting Location</td>
                                                <td>Procedure</td>
                                                <td>Description</td>
                                                <td></td>
                                            </tr>

                                            @isset($tb_casemonitor['holding'])
                                                @foreach ($tb_casemonitor['holding'] as $data)
                                                    @php
                                                        $data = (object) $data;
                                                        $count = count($data->procedure);
                                                        $hn  = @$data->hn."";
                                                        $app = @$data->appointment."";
                                                        $desc = @$data->description."";
                                                    @endphp
                                                    <tr>
                                                        <td >
                                                            <button class="btn btn-ghost-light btn-icon "  >
                                                                <i class="ri-qr-code-fill text-primary ri-2x"></i>
                                                            </button>
                                                            <span></span>
                                                        </td>
                                                        {{-- <td><span class="label label-inline mr-2 regis2book" hn="{{@$data->hn}}">{{$data['timevisit']}}</span></td> --}}
                                                        <td><span class="badge badge-outline-case">7:00</span></td>
                                                        <td>{{ @$data->hn }}</td>
                                                        <td>{{ @$data->patientname }}</td>
                                                        <td>{{ @$data->physician }}</td>
                                                        <td>
                                                            <select
                                                                class="form-control w-75 room_select bg-gray-input form-select"
                                                                data-choies hn="{{ @$data->hn }}">
                                                                <option value="0">เลือก</option>
                                                                @foreach ($room_ready as $room)
                                                                    @php
                                                                        $room = (object) $room;
                                                                    @endphp
                                                                    @if ($room->room_id == $data->room || $room->room_name == $data->room)
                                                                        <option value="{{ $room->room_id }}" selected>
                                                                            {{ $room->room_name }}</option>
                                                                    @else
                                                                        <option value="{{ $room->room_id }}">
                                                                            {{ $room->room_name }}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <select
                                                                class="form-control w-75 location_select bg-gray-input form-select"
                                                                hn="{{ @$data->hn }}">
                                                                @php
                                                                    $location = isset($location) && is_array($location) ? $location : jsonDecode($location);
                                                                @endphp
                                                                @foreach ($location as $loca)
                                                                    @if ($loca == $data->location)
                                                                        <option value="{{ $loca }}" selected>
                                                                            {{ $loca }}</option>
                                                                    @else
                                                                        <option value="{{ $loca }}">
                                                                            {{ $loca }}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                            @isset($data->procedure)
                                                                @foreach ($data->procedure as $data)
                                                                    {{ @$data }}
                                                                    @if ($count > 1)
                                                                        <br>
                                                                    @endif
                                                                @endforeach
                                                            @endisset
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form form-control" onchange="save_description('Holding', '{{$hn}}', this.value, '{{$app}}')" value="{{@$desc}}">
                                                        </td>
                                                        <td class="text-right"><i
                                                                class="ri-close-fill ri-2x text-danger cancel_by_hn"
                                                                hn="{{ @$data->hn }}"></i></td>
                                                    </tr>
                                                @endforeach
                                            @endisset
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 p-0">
                    <div class="card mb-0 mt-2">
                        <div class="card-body m-0 px-0">
                            <div class="row m-0">
                                <div class="col-lg-12 ">
                                    <div class="h5 fw-head-dark ms-4 mb-3">Operation and Reporting ({{ $count_operation }})</div>
                                </div>
                                <div class="col-lg-12 m-0 p-0">
                                    <div class="table-responsive">
                                        <table class="table table-borderless operation">
                                            <tr class="bg-light">
                                                <td></td>
                                                <td></td>
                                                <td>HN</td>
                                                <td>Patient name</td>
                                                <td>Physician</td>
                                                <td>Room</td>
                                                <td>Procedure</td>
                                                <td>Description</td>
                                            </tr>
                                            {{-- @dd($tb_case) --}}
                                            @foreach (isset($tb_casemonitor['operation']) ? $tb_casemonitor['operation'] : [] as $data)
                                                {{-- @dd($data) --}}

                                                @php
                                                    $data = (object) $data;
                                                    $count = count($data->procedure);
                                                    $hn  = @$data->hn."";
                                                    $desc = @$data->description."";
                                                @endphp
                                                <tr>
                                                    <td >
                                                        <button class="btn btn-ghost-light btn-icon  " >
                                                            <i class="ri-qr-code-fill text-primary ri-2x"></i>
                                                        </button>
                                                        <span>A02</span>
                                                    </td>
                                                    {{-- <td><span class="label label-inline mr-2">{{$data['timevisit']}}</span></td> --}}
                                                    <td><span class="badge badge-outline-case">7:00</span></td>
                                                    <td>{{ @$data->hn }}</td>
                                                    <td>{{ @$data->patientname }}</td>
                                                    <td>{{ @$data->physician }}</td>
                                                    <td>{{ @$data->room }}</td>
                                                    <td>
                                                        <table width="100%">
                                                            @isset($data->procedure)
                                                                @foreach ($data->procedure as $key => $value)
                                                                    @php
                                                                        $status = isset($data->statusjob) ? $data->statusjob : [];
                                                                    @endphp
                                                                    <tr>
                                                                        <td class="p-0">{{ $value }}</td>
                                                                        <td class="p-0" align="right">
                                                                            <span
                                                                                class="label label-info label-inline mr-2">{{ @$status[$key] }}</span>&nbsp;&nbsp;&nbsp;
                                                                            <i class="fas fa-times text-danger cancel_by_caseuniq"
                                                                                monitor_id=""
                                                                                procedure="{{ $value }}"></i>
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                            @endisset
                                                        </table>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form form-control" onchange="save_description('Operation', '{{$hn}}', this.value, '{{$app}}')" value="{{@$desc}}">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-lg-12 p-0">
                    <div class="card mb-0 mt-2">
                        <div class="card-body m-0 px-0">
                            <div class="row m-0">
                                <div class="col-lg-12 ">
                                            <div class="h5 fw-head-dark ms-4 mb-3">Recovery and Discharge ( {{ $count_recovery }} )</div>
                                        </div>
                                        <div class="col-lg-12 p-0 m-0">
                                            <div class="table-responsive">
                                                <table class="table table-borderless recovery">
                                                    <tr class="bg-light">
                                                        <td></td>
                                                        <td></td>
                                                        <td>HN</td>
                                                        <td>Patient name</td>
                                                        <td>Physician</td>
                                                        <td>Procedure</td>
                                                        <td>Status</td>
                                                    </tr>
                                                    @isset($tb_casemonitor['recovery'])
                                                        @foreach ($tb_casemonitor['recovery'] as $data)
                                                            @php
                                                                $data = (object) $data;
                                                                $count = count($data->procedure);
                                                                $statusjob = isset($data->statusjob) ? $data->statusjob : [];
                                                            @endphp
                                                            <tr>
                                                                <td >
                                                                    <button class="btn btn-ghost-light btn-icon  " >
                                                                        <i class="ri-qr-code-fill text-primary ri-2x"></i>
                                                                    </button>
                                                                    <span>A02</span>
                                                                </td>
                                                                <td><span class="badge badge-outline-case">7:00</span></td>
                                                                <td>{{ @$data->hn }}</td>
                                                                <td>{{ @$data->patientname }}</td>
                                                                <td>{{ @$data->physician }}</td>
                                                                <td>
                                                                    @isset($data->procedure)
                                                                        @foreach ($data->procedure as $data)
                                                                            {{ @$data }}
                                                                            @if ($count > 1)
                                                                                <br>
                                                                            @endif
                                                                        @endforeach
                                                                    @endisset
                                                                </td>

                                                                <td>
                                                                    @foreach ($statusjob as $data2)
                                                                        {{ @$data2 }}
                                                                        @if ($count > 1)
                                                                            <br>
                                                                        @endif
                                                                    @endforeach
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endisset
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="col-lg-4 pl-0 mt-2">
            <div class="row m-0 mt-2">
                <div class="col-lg-12 p-0">
                    <button class="btn btn-dark-primary btn-lg w-100 p-5 btn_update_monitor">UPDATE TO MONITOR <i
                            class="fas fa-redo"></i></button>
                </div>
            </div>
            <div class="row m-0 mt-2">
                <div class="col-lg-6 p-2 mt-2">
                    <div class="card">
                        <div class="card-body">Booked case {{ $count_book }}</div>
                    </div>
                </div>
                <div class="col-lg-6 p-2 mt-2">
                    <div class="card">
                        <div class="card-body">Registered case {{ $count_regis }}</div>
                    </div>
                </div>
                <div class="col-lg-6 p-2 mt-2">
                    <div class="card">
                        <div class="card-body">Remaining case {{ $count_remain }}</div>
                    </div>
                </div>
            </div>

        </div> --}}
    </div>




@endsection

@section('script')
    <script src="{{ url('public/sample/assets/js/pages/crud/forms/widgets/bootstrap-select.js') }}"></script>
    <script src="{{ url('public/plugins/jquery-ui-1.12.1/jquery-ui.min.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script src="http://{{ getCONFIG('admin')->server_name }}:3000/socket.io/socket.io.js"></script>
    <script>
        var socket = io.connect('http://{{ getCONFIG('admin')->server_name }}:3000');
        socket.on('chat message', function(msg) {
            if (msg == "casemonitor") {
                // location.reload();
            }
        });
    </script>

    <script>
        $('.remark').focusout(function() {
            var value = $(this).val();
            var hn = $(this).attr('hn');
            $.post('{{ url('casemonitor') }}', {
                event: 'remark',
                hn: hn,
                value: value
            }, function(data, status) {
                socket.emit('chat message', 'casemonitor');
            });

        });



        $('.regis2book').click(function() {
            var hn = $(this).attr('hn');
            $.post('{{ url('nurse_monitor') }}', {
                event: 'regis2book',
                hn: hn,
            }, function(data, status) {
                socket.emit('chat message', 'nurse_monitor');
            });
        });

        $('.btn_update_monitor').click(function() {
            socket.emit('chat message', 'nurse_monitor');
        });

        $('.cancel_by_hn').click(function() {
            var hn = $(this).attr('hn');
            $('#modal_cancel_hn').modal('show');
            $('#hn_cancel').val(hn);
            $('.hn_text').html(hn);
        });


        $('.cancel_by_caseuniq').click(function() {
            var monitor_id = $(this).attr('monitor_id');
            var procedure = $(this).attr('procedure');
            $('#modal_cancel_caseuniq').modal('show');
            $('#caseuniq_cancel').val(monitor_id);
            $('#procedure_text').html(procedure);
        });


        $('.room_select').focusout(function() {
            var hn = $(this).attr('hn');
            var room_id = $(this).val();
            $.post('{{ url('nurse_monitor') }}', {
                event: 'room_select',
                room_id: room_id,
                hn: hn,
            }, function(data, status) {
                socket.emit('chat message', 'nurse_monitor');
            });
        });

        $('.location_select').focusout(function() {
            var hn = $(this).attr('hn');
            var location = $(this).val();
            $.post('{{ url('nurse_monitor') }}', {
                event: 'location_select',
                location: location,
                hn: hn,
            }, function(data, status) {
                socket.emit('chat message', 'nurse_monitor');
            });
        });


        $('.room_ready').click(function() {
            var room_id = $(this).attr('room_id');
            var checked = $(this).is(":checked");
            $.post('{{ url('nurse_monitor') }}', {
                event: 'room_ready',
                room_id: room_id,
                checked: checked,
            }, function(data, status) {});
        });

        $('.calldoctor').click(function() {
            var room_id = $(this).attr('room_id');
            $('#room_inmodaldoctor').val(room_id);
            $('#modal_doctor').modal('show');
            $.post("{{ url('nurse_monitor') }}", {
                    event: 'getdoctor',
                    room: room_id,
                },
                function(data, status) {
                    obj = JSON.parse(data);
                    $('.doctor').prop('checked', false);
                    obj.forEach(function(item) {
                        $('#doctor' + item).prop('checked', true);
                        console.log(item);
                    });
                });
        });

        $('.callnurse').click(function() {
            var room_id = $(this).attr('room_id');
            $('#room_inmodalnurse').val(room_id);
            $('#modal_nurse').modal('show');
            $.post("{{ url('nurse_monitor') }}", {
                    event: 'getnurse',
                    room: room_id,
                },
                function(data, status) {
                    obj = JSON.parse(data);
                    $('.nurse').prop('checked', false);
                    obj.forEach(function(item) {
                        $('#nurse' + item).prop('checked', true);
                        console.log(item);
                    });
                });
        });

        $('.callregister').click(function() {
            var room_id = $(this).attr('room_id');
            $('#room_inmodalregister').val(room_id);
            $('#modal_register').modal('show');
            $.post("{{ url('nurse_monitor') }}", {
                    event: 'getregister',
                    room: room_id,
                },
                function(data, status) {
                    console.log(data);
                    obj = JSON.parse(data);
                    $('.register').prop('checked', false);
                    obj.forEach(function(item) {
                        $('#register' + item).prop('checked', true);
                        console.log(item);
                    });
                });
        });


        $('.btn-checkin').click(function() {
            var hn = $(this).attr('hn');
            $.post("{{ url('nurse_monitor') }}", {
                event: 'checkin',
                hn: hn,
            }, function(data, status) {
                socket.emit('chat message', 'endocapture_home');
                socket.emit('chat message', 'nurse_monitor');
            });
        });


        $('.btn-discharge').click(function() {
            var hn = $(this).attr('hn');
            $.post("{{ url('nurse_monitor') }}", {
                event: 'discharge',
                hn: hn,
            }, function(data, status) {
                socket.emit('chat message', 'nurse_monitor');
                socket.emit('queue', 'refreshdata');
            });
        });







        $('#check_in_all').click(function() {
            $.post("{{ url('nurse_monitor') }}", {
                event: 'check_in_all',
            }, function(data, status) {
                socket.emit('chat message', 'endocapture_home');
                socket.emit('chat message', 'nurse_monitor');
            });
        });

        $('#nurse_monitor_freetext').focusout(function() {
            var text = $(this).val();
            $.post("{{ url('nurse_monitor') }}", {
                event: 'update_nursemonitor',
                text: text,
            }, function(data, status) {

            });
        });

        function save_description(type, hn, text, date){
            console.log(type, hn, text);
            $.post("{{url('api')}}/jquery", {
                event : "save_description",
                type  : type,
                hn    : hn,
                text  : text,
                date  : date
            }, function (data, status) {

            })
        }
    </script>




@endsection
