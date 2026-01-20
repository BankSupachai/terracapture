@php
    use App\Models\Patient;
@endphp
<div class="col-lg-12 p-0">
    <div class="card mb-0 mt-2">
        <div class="card-body m-0 px-0">
            <div class="row m-0">
                <div class="col-lg-12 ">
                    <div class="h5 fw-head-dark ms-4 mb-3">Recovery and Discharge ({{ $count_recovery }})</div>
                </div>
                <div class="col-lg-12 p-0 m-0">
                    <div class="table-responsive">
                        <table class="table table-borderless recovery">
                            <tr class="bg-light" style="color: #9599AD;">
                                <td></td>
                                <td></td>
                                <td>HN</td>
                                <td>Patient name</td>
                                <td>Endoscopist</td>
                                <td>Procedure</td>
                                <td>Complication</td>
                                <td>Status</td>
                                <td>Discharged to</td>
                                <td></td>
                                <td></td>
                            </tr>
                            @isset($tb_casemonitor['recovery'])
                                @foreach ($tb_casemonitor['recovery'] as $data)
                                    @php
                                        $data = (object) $data;
                                        $count = count($data->procedure);
                                        $statusjob = isset($data->statusjob) ? $data->statusjob : [];
                                        $patientname = Patient::fullname_patient($data->hn);
                                    @endphp
                                    <tr style="border-bottom: 1px solid #E9EBEC;">
                                        <td class="text-nowrap">
                                            <button class="btn btn-ghost-light btn-icon qr_create" hn="{{ @$hn }}">
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
                                        <td class="can-search"><span
                                                class="badge badge-outline-case">{{ @$data->timevisit }}</span></td>
                                        <td class="can-search">{{ @$data->hn }}</td>
                                        <td class="can-search">{{ @$patientname }}</td>
                                        <td class="can-search">{{ @$data->physician }}</td>
                                        <td>
                                            @isset($data->procedure)
                                                @foreach ($data->procedure as $data2)
                                                    {{ @$data2 }}
                                                    @if ($count > 1)
                                                        <br>
                                                    @endif
                                                @endforeach
                                            @endisset
                                        </td>
                                        <td>
                                            @if (isset($data->complication_other) && @$data->complication_other . '' != '')
                                                {{ $data->complication_other }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            {{-- @dd($data) --}}
                                            @php
                                                $status_discharged = false;
                                            @endphp
                                            @foreach ($data->statusjob as $statusjob)
                                                @php
                                                    if ($statusjob == 'Discharged') {
                                                        $status_discharged = true;
                                                    }
                                                @endphp
                                            @endforeach
                                            @if ($status_discharged)
                                                <span class="badge-soft-success  p-1">Discharged</span>
                                            @else
                                                <span class="badge-soft-secondary  p-1">Recovery</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span style="text-transform: capitalize;">
                                                @if(isset($data->dischargedto) && @$data->dischargedto . '' != '')
                                                {{@$data->dischargedto }}
                                                @else
                                                -
                                                @endif
                                            </span>
                                        </td>
                                        <td style="">
                                            @if (!$status_discharged)
                                                {{-- <button type="button" class="btn btn-primary btn-label waves-effect right waves-light text-end " data-bs-toggle="modal" data-bs-target="#Modal_Discharge"><i class="ri-check-double-line label-icon align-middle fs-16 ms-2" ></i> Send to Discharge</button> --}}
                                                {{-- <button type="button" hn="{{$data->hn}}" class="btn-discharge btn btn-primary btn-label waves-effect right waves-light text-end "><i class="ri-check-double-line label-icon align-middle fs-16 ms-2"></i> Send to Discharge</button> --}}
                                                {{-- <button type="button" hn="{{ $data->hn }}"
                                                    class="btn btn-primary btn-label waves-effect right waves-light text-end btn_modal_discharged"><i
                                                        class="ri-check-double-line label-icon align-middle fs-16 ms-2"></i>
                                                    Send to Discharge</button> --}}
                                                    <button type="button" caseuniq="{{ json_encode($data->caseuniq) }}"
                                                        class="btn btn-primary btn-label waves-effect right waves-light btn_modal_discharged text-nowrap"><i
                                                            class="ri-check-double-line label-icon align-middle fs-16 ms-2"></i>
                                                        Send to Discharge</button>
                                            @endif
                                            {{-- ปุ่มใหม่ เรียกmodal confirm --}}
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



<script>
    $(".btn_modal_discharged").click(function() {

        $("#Modal_Discharge").modal("show")
        let caseuniq = $(this).attr("caseuniq")

        $.post("{{url("api/casemonitor")}}",{
            event : "get_detail_formodal",
            caseuniq : caseuniq
        }, function(d , status){
            let data = JSON.parse(d);

            // console.log(data);

            console.log(data.tb_case);

           $("#data_hn").val(data.tb_casemonitor.monitor_hn)
            $("#patient_detail").html(`HN: ${data.tb_case.hn || ''} ${data.tb_case.patientname || ''} (${data.tb_case.age !== undefined && data.tb_case.age !== null ? data.tb_case.age : ''} Y) `);
            $(".radio_check").val(data.tb_casemonitor.monitor_discharge_to).prop('checked', true)


        })
    })
</script>
