@php
    use App\Models\Mongo;
    use App\Models\Patient;
@endphp
<div class="col-lg-12 p-0">
    <div class="card mb-0 mt-2">
        <div class="card-body m-0 px-0">
            <div class="row m-0">
                <div class="col-lg-12 ">
                    <div class="h5 fw-head-dark ms-4 mb-3">Operation and Reporting
                        ({{ $count_operation }})</div>
                </div>
                <div class="col-lg-12 m-0 p-0">
                    <div class="table-responsive">
                        <table class="table table-borderless operation">
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
                            {{-- @dd($tb_casemonitor['operation']); --}}
                            @foreach (isset($tb_casemonitor['operation']) ? $tb_casemonitor['operation'] : [] as $data)
                            {{-- @dd($data); --}}
                                @php
                                    $data = (object) $data;
                                    $count = count($data->procedure);
                                    $hn = @$data->hn . '';
                                    $desc = @$data->description  . '';
                                    $app = @$data->appointment . '';

                                    $num = (int) $data->room;
                                    $room       = (object) Mongo::table("tb_room")->where("room_id",$num)->first();
                                    $roomname   = @$room->room_name."";
                                    $data2 = @$data->status; // สมมติว่าค่า status อยู่ใน $data
                                    $patientname = Patient::fullname_patient($data->hn);

                                @endphp
                                <tr style="border-bottom: 1px solid #E9EBEC;">
                                    <td class="text-nowrap">
                                        <button class="btn btn-ghost-light btn-icon qr_create modalqr" hn="{{@$hn}}">
                                            <i class="ri-qr-code-fill text-primary ri-2x"></i>
                                        </button>
                                        <b class="callQueue  ri-volume-up-line text-primary ri-lg" queue="{{@$data->queue}}"></b>
                                        <span class=" ms-3">
                                            @if($data->queue!="")
                                                #{{@$data->queue}}
                                            @endif
                                        </span>
                                    </td>
                                    <td class="can-search"><span class="badge badge-outline-case">{{@$data->timevisit}}</span></td>
                                    <td class="can-search">{{ @$data->hn }}</td>
                                    <td class="can-search">{{ @$patientname }}</td>
                                    <td class="can-search">{{ @$data->physician }}</td>
                                    <td>
                                        <table width="100%">
                                            @isset($data->procedure)
                                                @foreach ($data->procedure as $jey => $value)
                                                    @php
                                                        $status = isset($data->statusjob) ? $data->statusjob : [];

                                                    @endphp
                                                    <tr>

                                                        <td class="p-0 ">
                                                        @if (in_array("Operation" , $status))
                                                            <span class="badge badge-soft-danger fw-bold">{{ $value }} </span>
                                                        @elseif ($data2 == 'Recovery')
                                                            <span class="badge badge-soft-warning fw-bold">{{ $value }} </span>
                                                        @endif


                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endisset
                                        </table>
                                    </td>
                                    <td class="can-search">{{ @$roomname }}</td>
                                    <td></td>
                                    <td>
                                        <div class="need-hidden">
                                            <input class="need-hidden" type="text" id="Operation_{{ $j }}"
                                                value="{{ $hn }}" hidden>
                                            <input class="need-hidden" type="text"
                                                id="Operation_{{ $j }}app" value="{{ $app }}"
                                                hidden>
                                        </div>
                                        <input type="text" class="form form-control"
                                            onchange="save_description('Operation', '{{ $j }}', this.value, '{{ $j }}')"
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
                                        </td>
                                            {{-- onclick="cancel_case('{{ @$j }}', '{{ json_encode($procs) }}', '{{ json_encode($ids) }}', false,'Holding')"></i> --}}

                                </tr>
                                @php
                                    $j += 1;
                                @endphp
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


