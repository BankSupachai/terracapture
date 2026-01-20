@php
    $count_register = get_case_count($tb_casemonitor['register']);
    use App\Models\Patient;
@endphp

<div class="col-lg-12 p-0">
    <div class="card mb-0 mt-2">
        <div class="card-body m-0 px-0">
            <div class="row m-0">
                <div class="col-lg-12 ">
                    <div class="h5 fw-head-dark ms-4 mb-3">Registered ({{ $count_register }})</div>
                </div>
                <div class="col-lg-12 m-0 px-0 ">
                    <div class="table-responsive">
                        <table class="table table-borderless register">
                            <tr class="bg-light" style="color: #9599AD;">
                                <td></td>
                                <td></td>
                                <td>HN</td>
                                <td>Patient name</td>
                                <td>Endoscopist</td>
                                <td>Procedure</td>
                                <td>Room</td>
                                <td></td>
                                <td>Description</td>
                                <td></td>
                            </tr>

                            @isset($tb_casemonitor['register'])
                                @foreach (isset($tb_casemonitor['register'])?$tb_casemonitor['register']:[] as $data)
                                    @php
                                        $data = (object) $data;
                                        // dd($data);
                                        $count = count($data->procedure);
                                        $hn = @$data->hn . '';
                                        $procs = @$data->procedure;
                                        $app = @$data->appointment . '';
                                        $desc = @$data->description . '';
                                        $ids = [];
                                        $patientname = Patient::fullname_patient($data->hn);
                                        foreach (isset($data->id) ? $data->id : [] as $key => $id) {
                                            $id = (array) $id;
                                            $ids[] = $id['oid'];
                                        }
                                        // dd($data, $ids);
                                    @endphp
                                    <tr style="border-bottom: 1px solid #E9EBEC;">
                                        {{-- <td class="text-nowrap">
                                            <button class="btn btn-ghost-light btn-icon qr_create">
                                                <i class="ri-qr-code-fill text-primary ri-2x"></i>
                                            </button>
                                            <b class="callQueue  ri-volume-up-line text-primary ri-lg">
                                            </b>
                                            <span class=" ms-3">

                                            </span>
                                        </td> --}}

                                        <td class="text-nowrap">
                                            <button class="btn btn-ghost-light btn-icon qr_create modalqr" hn="{{ @$hn }}">
                                                <i class="ri-qr-code-fill text-primary ri-2x"></i>
                                            </button>
                                            {{-- <b class="callQueue  ri-volume-up-line text-primary ri-lg"
                                                queue="{{ @$data->queue }}"></b> --}}
                                            <span class=" ms-3">
                                                @if ($data->queue != '')
                                                    #{{ @$data->queue }}
                                                @endif
                                            </span>
                                        </td>
                                        {{-- <td><span class="badge badge-outline-case">{{ @$data->timevisit }}</span></td> --}}


                                        {{-- <td>
                                            <button class="btn btn-success checkin text-nowrap btn-sm" hn="{{$hn}}">Check in</button>
                                        </td> --}}
                                        <td></td>
                                        <td>{{@$hn}}<span class="badge badge-outline-case"></span></td>
                                        <td style="color:#245788;">
                                            <a href="{{ url("book/casemonitor/show?hn=$hn&date=".date('Y-m-d')) }}">
                                                {{ @$patientname }}
                                            </a>
                                        </td>
                                        <td>{{ @$data->physician }}</td>
                                        {{-- <td></td> --}}

                                        <td>
                                            @isset($data->procedure)
                                                @foreach ($data->procedure as $p)
                                                    {{ @trim($p) }}
                                                    @if ($count > 1)
                                                        <br>
                                                    @endif
                                                @endforeach
                                            @endisset
                                        </td>
                                        <td class="can-not-search">
                                            {{-- @dd($room_ready) --}}
                                            <select class=" w-75 room_select form-select room-register"
                                                data-choies hn="{{ @$data->hn }}" ids="{{json_encode($ids)}}">
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
                                        <td></td>
                                        <td class="can-not-search">
                                            <div class="need-hidden">
                                                <input class="need-hidden" type="text" id="Register_{{ $j }}"
                                                    value="{{ $hn }}" hidden>
                                                <input class="need-hidden" type="text"
                                                    id="Register_{{ $j }}app" value="{{ $app }}"
                                                    hidden>
                                            </div>

                                            {{-- <input type="text" class="form form-control" value="{{ @$data->description }}"> --}}
                                            <input type="text" class="form form-control"
                                                onchange="save_description('Register', '{{ $j }}', this.value, '{{ $j }}')"
                                                value="{{ @$desc }}">
                                        </td>
                                        <td class="text-end can-not-search">
                                            <div class="btn-group" role="group">
                                                <i class="ri-edit-box-fill ri-lg " data-bs-toggle="dropdown"></i>
                                                <ul class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                                                    <li>
                                                        <a class="dropdown-item"
                                                            onclick="edit_case('{{ json_encode($data->caseuniq) }}')">Edit
                                                            List</a>
                                                    </li>
                                                    <li><a class="dropdown-item"
                                                            onclick="hide_case('{{ json_encode($data->caseuniq) }}')">Cancel</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            {{-- <i class="ri-close-fill ri-2x text-danger"
                                                onclick="hide_case('{{ json_encode($data->caseuniq) }}')"></i> --}}
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
