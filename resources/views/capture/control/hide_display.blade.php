@php
    use App\Models\Patient;
@endphp
<div class="col-lg-12 p-0">
    <div class="card mb-0 mt-2">
        <div class="card-body m-0 px-0">
            <div class="row m-0">
                <div class="col-lg-12 ">
                    @php
                        $hide_count = 0;
                        foreach (isset($tb_casemonitor['hide'])?$tb_casemonitor['hide']:[] as $data){
                            $data = (object) $data;
                            foreach ( isset($data->statusjob)?$data->statusjob:[] as $statusjob ){
                                $hide_count += 1;
                            }
                        }
                    @endphp
                    <div class="h5 fw-head-dark ms-4 mb-3">Hide Case ({{ $hide_count }})</div>
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
                                <td></td>
                                <td></td>
                            </tr>
                            @isset($tb_casemonitor['hide'])
                                @foreach ($tb_casemonitor['hide'] as $data)
                                    @php
                                        $data = (object) $data;
                                        $count = count($data->procedure);
                                        $statusjob = isset($data->statusjob) ? $data->statusjob : [];
                                        $caseuniq = isset($data->caseuniq) ? json_encode($data->caseuniq) : '';
                                        $patientname = Patient::fullname_patient($data->hn);
                                    @endphp
                                    <tr style="border-bottom: 1px solid #E9EBEC;">
                                        {{-- <td class="text-nowrap">
                                            <button class="btn btn-ghost-light btn-icon qr_create" hn="{{@$hn}}">
                                                <i class="ri-qr-code-fill text-primary ri-2x"></i>
                                            </button>
                                            <b class="callQueue  ri-volume-up-line text-primary ri-lg" queue="{{@$data->queue}}"></b>
                                            <span class=" ms-3">
                                                @if($data->queue!="")
                                                    #{{@$data->queue}}
                                                @endif
                                            </span>
                                        </td> --}}
                                        <td></td>
                                        <td class="can-search"><span class="badge badge-outline-case">{{@$data->timevisit}}</span></td>
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
                                            @foreach ( $data->statusjob as $statusjob )
                                                @php
                                                    if ($statusjob == 'Discharged'){
                                                        $status_discharged = true;
                                                    }
                                                @endphp
                                                <span class="badge-soft-secondary  p-1">{{@$statusjob}}</span>
                                            @endforeach
                                            {{-- @if($status_discharged)
                                                <span class="badge-soft-success  p-1">Discharged</span>
                                            @else
                                            @endif --}}
                                        </td>
                                        <td></td>
                                        <td>
                                            <button type="button"  onclick="show_case('{{ $caseuniq}}')"
                                            class="btn-restore btn btn-warning btn-label waves-effect right waves-light " style="width: 165px;">
                                            <i class="ri-check-double-line label-icon align-middle fs-16"></i> Show on Monitor</button>
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

</script>
