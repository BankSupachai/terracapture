

<div class="col-lg-12 p-0">
    <div class="card mb-0 mt-2">
        <div class="card-body m-0 px-0">
            <div class="row m-0">
                <div class="col-lg-12 ">
                    <div class="h5 fw-head-dark ms-4 mb-3">Booking ({{ $count_booking }})</div>
                </div>
                <div class="col-lg-12 m-0 px-0 ">
                    <div class="table-responsive">
                        <table class="table table-borderless booking">
                            <tr class="bg-light" style="color: #9599AD;">
                                <td></td>
                                <td></td>
                                <td>HN</td>
                                <td>Patient name</td>
                                <td>Physician</td>
                                {{-- <td>Room</td> --}}
                                <td>Waiting Location</td>
                                <td>Procedure</td>
                                <td>Description</td>
                                <td></td>
                            </tr>

                            @isset($tb_casemonitor['booking_no_system'])
                                @foreach ($tb_casemonitor['booking_no_system'] as $data)
                                    @php
                                        $data = (object) $data;
                                        $count = count($data->procedure);
                                        $hn  = @$data->hn."";
                                        $procs = @$data->procedure;
                                        $app = @$data->appointment."";
                                        $desc = @$data->description."";
                                        $ids = [];
                                        $caseuniq = isset($data->caseuniq) ? $data->caseuniq : '';
                                        foreach (isset($data->id)?$data->id:[] as $key => $id) {
                                            $id  = (array) $id;
                                            $ids[]  = $id['oid'];
                                        }
                                    @endphp
                                    <tr>

                                        <td>
                                            <button class="btn btn-success checkin text-nowrap btn-sm" hn="{{$hn}}">Check in</button>
                                        </td>
                                        <td></td>
                                        {{-- <td class="text-nowrap">
                                            <button class="btn btn-ghost-light btn-icon qr_create" hn="{{@$hn}}">
                                                <i class="ri-qr-code-fill text-primary ri-2x"></i>
                                            </button>
                                            <b class="callQueue  ri-volume-up-line text-primary ri-lg" queue="{{@$data->queue}}"></b>
                                            <span class="d-block ms-3">
                                                @if($data->queue!="")
                                                    #{{@$data->queue}}
                                                @endif
                                            </span>
                                        </td>
                                        <td><span class="badge badge-outline-case">7:00</span></td> --}}



                                        <td>{{ @$data->hn }}</td>
                                        <td>{{ @$data->patientname }}</td>
                                        <td>{{ @$data->physician }}</td>
                                        {{-- <td class="can-not-search">
                                            <select
                                                class="form-control  room_select room-register bg-gray-input form-select"
                                                data-choies hn="{{ @$data->hn }}" ids="{{json_encode($ids)}}">
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
                                        </td> --}}
                                        <td class="can-not-search">
                                            <select
                                                class="form-control w-75 location_select bg-gray-input form-select"
                                                hn="{{ @$data->hn }}">
                                                <option value="">เลือก</option>
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
                                                    {{@trim($data)}}
                                                    @if ($count > 1)
                                                    <br>
                                                    @endif
                                                @endforeach
                                            @endisset
                                        </td>
                                        <td class="can-not-search">

                                            <div class="need-hidden">
                                            <input class="need-hidden" type="text" id="Holding_{{$j}}" value="{{$hn}}" hidden>
                                            <input class="need-hidden" type="text" id="Holding_{{$j}}app" value="{{$app}}" hidden>
                                            </div>
                                            <input type="text" class="form form-control bg-light" style="border: 0;" onchange="save_description('Holding', '{{$j}}', this.value, '{{$j}}')" value="{{@$desc}}">
                                        </td>
                                        <td class="text-end can-not-search"><i class="ri-close-fill ri-2x text-danger"
                                            onclick="hide_case('{{ json_encode($caseuniq) }}')"></i></td>
                                            {{-- onclick="cancel_case('{{ @$j }}', '{{json_encode($procs)}}', '{{json_encode($ids)}}', false,'Holding')"></i></td> --}}
                                    </tr>
                                    @php
                                        $j += 1;
                                    @endphp
                                @endforeach
                            @endisset
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


