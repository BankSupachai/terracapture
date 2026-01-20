@php
    $i = 0;
    use App\Models\Patient;
@endphp

@foreach (isset($all_case)?$all_case:[] as $in => $data)
    @if (isset($data->case_hn) || isset($data->hn))
        @php
            $data               = (object) $data;
            $_id                = $data->id;
            $hn                 = isset($data->case_hn)         ? $data->case_hn : $data->hn;
            $patientname = Patient::fullname_patient($data->hn);
            $procedure          = isset($data->procedurename)   ? $data->procedurename : $data->procedure;
            $statusjob          = isset($data->statusjob)       ? ucfirst($data->statusjob) : '';


            $pacssuccess = false;
            foreach(isset($data->case_pacs)?$data->case_pacs:[] as $pac){
                if(isset($pac["status"])){
                    if($pac["status"]=="success"){
                        $pacssuccess = true;
                    }
                }
            }

            $appointment        = isset($data->appointment)     ? explode(' ', $data->appointment) : null;
            $date               = isset($appointment)           ? format_date($appointment[0], 'd M Y') : '';
            $physician          = isset($data->doctorname)      && @$data->doctorname . '' !== '' ? $data->doctorname : $data->physician;
            $room               = isset($data->room)            && @$data->room != '' ? get_room_name(intval($data->room)) : '';
            $case_pdfversion    = isset($data->case_pdfversion) && @$data->case_pdfversion != '' ? $data->case_pdfversion : [];
            $count_pdf          = is_array($case_pdfversion)    ? count($case_pdfversion) : 0;
            $patient_tel        = get_patient_data($hn, 'phone');
        @endphp
        <tr>
            <td data-text="{{$hn}}">
                <a href="{{url("tablet/procedure/$data->id/")}}" class="">
                    <span class="fs-procedure" >{{ @$hn }}</span>
                </a>
            </td>
            <td data-text="{{$patientname}}">
                <a href="{{url("tablet/procedure/$data->id/")}}" class="">
                    <span class="fs-procedure" >{{ @$patientname }}</span>
                </a>
            </td>
            <td>
                @if ($statusjob == 'Discharged' || $statusjob == 'Recovery')
                <span class="badge-soft-success px-1">Complete</span>
                @else
                <span class="badge-soft-danger px-1">Incomplete</span>
                @endif
            </td>

            <td>
                @isset($physician)
                    {{ $physician }}
                @else
                    -
                @endisset
            </td>

            <td>
                @if($pacssuccess)
                    <i class="ri-checkbox-circle-fill ri-lg text-success"></i>
                @else
                    <i class="ri-checkbox-circle-fill ri-lg" style="visibility:hidden"></i>
                @endif
                {{ @$procedure }}
            </td>
            <td>{{ @$room }}</td>
            <td>
                @isset($data->rapid_urease_test)
                    @if (strlen($data->rapid_urease_test) > 15 || $data->rapid_urease_test == 'Pending')
                        <a class="btn btn-sm modal_ureasetest btn-soft-warning " sub-name="pending"
                        cid="{{@$_id}}" hn="{{@$hn}}" patientname="{{@$patientname}}" contact="{{@$patient_tel}}" select="{{@$data->rapid_urease_test}}" other="{{@$data->rapid_other}}">Pending</a>
                    @endif
                    @if ($data->rapid_urease_test == 'Positive (+)')
                        <a class="btn btn-sm modal_ureasetest btn-soft-danger " sub-name="positive"
                        cid="{{@$_id}}" hn="{{@$hn}}" patientname="{{@$patientname}}" contact="{{@$patient_tel}}" select="{{@$data->rapid_urease_test}}" other="{{@$data->rapid_other}}">Positive(+)</a>
                    @endif
                    @if ($data->rapid_urease_test == 'Negative (-)')
                        <a class="btn btn-sm modal_ureasetest btn-soft-success" sub-name="negative"
                        cid="{{@$_id}}" hn="{{@$hn}}" patientname="{{@$patientname}}" contact="{{@$patient_tel}}" select="{{@$data->rapid_urease_test}}" other="{{@$data->rapid_other}}">Negative (-)</a>
                    @endif
                @else
                    -
                @endisset
            </td>
            <td>
                @if (isset($data->prediagnostic_other) && @$data->prediagnostic_other . '' != '')
                    {{ $data->prediagnostic_other }}
                @else
                    -
                @endif

            </td>
            <td>
                @if (isset($data->complication_other) && @$data->complication_other . '' != '')
                    {{ $data->complication_other }}
                @else
                    -
                @endif
            </td>
            <td>
                @isset($data->description)
                    {{ $data->description }}
                @else
                    -
                @endisset
            </td>
        </tr>

        @php
            $i = $i + 1;
        @endphp
    @endif
@endforeach
