@php
    $count_holding = get_case_count($tb_casemonitor['holding']);
    use App\Models\Patient;
@endphp
<div class="col-lg-12 p-0">
    <div class="card mb-0 mt-2">
        <div class="card-body m-0 px-0">
            <div class="row m-0">
                <div class="col-lg-12 ">
                    <div class="h5 fw-head-dark ms-4 mb-3">Holding ({{ $count_holding }})</div>
                </div>
                <div class="col-lg-12 m-0 px-0 ">
                    <div class="">
                        <table class="table table-borderless holding">
                            <tr class="bg-light" style="color: #9599AD;">
                                <td></td>
                                <td></td>
                                <td>HN</td>
                                <td>Patient name</td>
                                <td>Endoscopist</td>
                                <td>Procedure</td>
                                <td>Room</td>
                                <td>Waiting Location</td>
                                <td>Description</td>
                                <td></td>

                            </tr>

                            {{-- @dd($tb_casemonitor['Holding']) --}}
                            @isset($tb_casemonitor['holding'])
                                @foreach ($tb_casemonitor['holding'] as $data)
                                    @php
                                        $data = (object) $data;
                                        $count = count($data->procedure);
                                        $hn = @$data->hn . '';
                                        $procs = @$data->procedure;
                                        $app = @$data->appointment . '';
                                        $desc = @$data->description . '';
                                        $caseuniq = isset($data->caseuniq) ? $data->caseuniq : '';
                                        $ids = [];
                                        $patientname = Patient::fullname_patient($data->hn);
                                        foreach (isset($data->id) ? $data->id : [] as $key => $id) {
                                            $id = (array) $id;
                                            $ids[] = $id['oid'];
                                        }
                                    @endphp
                                    <tr style="border-bottom: 1px solid #E9EBEC;">
                                        <td class="text-nowrap">
                                            <button class="btn btn-ghost-light btn-icon qr_create modalqr"
                                                hn="{{ @$hn }}">
                                                <i class="ri-qr-code-fill text-primary ri-2x"></i>
                                            </button>
                                            <b class="callQueue  ri-volume-up-line text-primary ri-lg"
                                                queue="{{ @$data->queue }}"></b>
                                            <span class=" ms-3">
                                                @if ($data->queue != '')
                                                    #{{ @$data->queue }}
                                                @endif
                                            </span>
                                        </td>

                                        <td><span class="badge badge-outline-case">{{ @$data->timevisit }}</span></td>
                                        <td>
                                            <a href="{{ url("book/casemonitor/show?hn=" . @$data->hn . "&date=" . @$data->appointment) }}"><u>{{ @$data->hn }}</u> </a>

                                        </td>
                                        <td style="color:#245788;">
                                            <a href="{{ url("book/casemonitor/show?hn=" . @$data->hn . "&date=" . @$data->appointment) }}">
                                                <u>

                                                {{ @$patientname }}
                                            </u>
                                            </a>
                                        </td>
                                        <td>{{ @$data->physician }}</td>


                                        <td>
                                            @isset($data->procedure)
                                                @foreach ($data->procedure as $data2)
                                                    {{ @trim($data2) }}
                                                    @if ($count > 1)
                                                        <br>
                                                    @endif
                                                @endforeach
                                            @endisset
                                        </td>
                                        <td class="can-not-search">
                                            <select class=" w-75 room_select form-select"
                                                data-choies hn="{{ @$data->hn }}">
                                                <option value="0">เลือก</option>
                                                @foreach ($room_captures as $room)
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
                                        <td class="can-not-search">
                                            <select class=" w-75 location_select form-select"
                                                hn="{{ @$data->hn }}">
                                                {{-- <option value="">เลือก</option> --}}
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
                                        <td class="can-not-search">
                                            <div class="need-hidden">
                                                <input class="need-hidden" type="text" id="Holding_{{ $j }}"
                                                    value="{{ $hn }}" hidden>
                                                <input class="need-hidden" type="text"
                                                    id="Holding_{{ $j }}app" value="{{ $app }}"

                                                    hidden>
                                                    {{-- @dd($app); --}}
                                            </div>
                                            <input type="text" class="form form-control" onchange="save_description('Holding', '{{ $j }}', this.value, '{{ $j }}')"
                                                value="{{ @$desc }}">
                                        </td>
                                        <td class="text-end can-not-search">
                                            <div class="btn-group" role="group">
                                                <i class="ri-edit-box-fill ri-lg " data-bs-toggle="dropdown"></i>
                                                <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                    <li>
                                                        <a class="dropdown-item"
                                                            onclick="edit_case('{{ json_encode($caseuniq) }}')">Edit
                                                            List</a>
                                                    </li>
                                                    <li><a class="dropdown-item"
                                                            onclick="hide_case('{{ json_encode($caseuniq) }}')">Cancel</a>
                                                    </li>
                                                </ul>
                                            </div>
                        </div>
                        {{-- <i class="ri-close-fill ri-2x text-danger"
                                                onclick="hide_case('{{ json_encode($caseuniq) }}')"></i> --}}
                        </td>
                        {{-- onclick="cancel_case('{{ @$j }}', '{{ json_encode($procs) }}', '{{ json_encode($ids) }}', false,'Holding')"></i> --}}
                        </td>
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
