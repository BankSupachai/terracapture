@php
    $i = 0;
    use App\Models\Patient;
@endphp
@include('EndoCAPTURE.home.component.modal_urease_tablet')
@foreach ($alltoday_case as $in => $data)
    @if (isset($data->case_hn) || isset($data->hn))
        @php
            $data = (object) $data;
            $hn = isset($data->case_hn) ? $data->case_hn : $data->hn;
            $patientname = Patient::fullname_patient($data->hn);
            $physician = isset($data->doctorname) ? $data->doctorname : $data->physician;
            $procedure = isset($data->procedure) ? $data->procedure : [];
            $statusjob = isset($data->statusjob) ? $data->statusjob : [];
            $id = $data->id;
            $room = isset($data->room) && @$data->room != '' ? get_room_name(intval($data->room)) : '';
            $appointment = isset($data->appointment) ? explode(' ', $data->appointment) : null;
            $date = isset($appointment) ? format_date($appointment[0], 'd M Y') : '';
            $desc = @$data->description . '';

            if (is_array($statusjob)) {
                if (in_array('operation', $statusjob)) {
                    $statusjob = ['operation'];
                } else {
                    if (in_array('holding', $statusjob) && find_duplicate($statusjob, 'holding')) {
                        $statusjob = ['holding'];
                    } elseif (in_array('recovery', $statusjob) && !find_duplicate($statusjob, 'discharged')) {
                        $statusjob = ['recovery'];
                    } elseif (in_array('discharged', $statusjob) && find_duplicate($statusjob, 'discharged')) {
                        $statusjob = ['discharged'];
                    }
                }
            } else {
                $statusjob = [];
            }
            $case_pdfversion = isset($data->case_pdfversion) && @$data->case_pdfversion != '' ? $data->case_pdfversion : [];
            $count_pdf       = is_array($case_pdfversion) ? count($case_pdfversion) : 0;
            $patient_tel     = get_patient_data($hn, 'phone');
            $urease          = isset($data->rapid_urease_test);
            $urease_other    = isset($data->rapid_other);
        @endphp
        <tr>

            <td>
                @if (count($procedure) > 1)
                    <a href="{{url("tablet/nursenote/".@$data->id."/")}}">
                        <span class="fs-procedure"  >{{ $hn }}</span>
                    </a>
                @else
                    <a href="{{url("tablet/nursenote/".@$data->id."/")}}" class="">
                        <span class="fs-procedure" >{{ $hn }}</span>
                    </a>
                @endif
            </td>

            <td>

                @if (count($procedure) > 1)
                    <a href="{{url("tablet/nursenote/".@$data->id."/")}}">
                        <span class="fs-procedure" >{{ @$patientname }}</span>
                    </a>
                @else
                    <a href="{{url("tablet/nursenote/".@$data->id."/")}}" class="">
                        <span class="fs-procedure">{{ @$patientname }}</span>
                    </a>
                @endif
            </td>


            <td>
                {{-- @dd($statusjob) --}}
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
                @foreach (isset($procedure) ? $procedure : [] as $p)
                    {{ $p }}
                    @if (count($procedure) > 1)
                        <br>
                    @endif
                @endforeach
            </td>
            @php
                  $room               = isset($data->room)            && @$data->room != '' ? get_room_name(intval($data->room)) : '';
            @endphp
            <td>{{ @$room }}</td>
            <td>
                @if(empty($urease))
                    -
                @else
                    @if (strlen($urease) > 15 || $urease == 'Pending')
                        <button class="btn modal_ureasetest btn-soft-warning btn-sm fs-14" sub-name="pending"
                        cid="{{@$id}}" hn="{{@$hn}}" patientname="{{@$patientname}}" contact="{{@$patient_tel}}" select="{{@$urease}}" other="{{@$urease_other}}" count="{{@count($procedure)}}">Pending</button>
                    @endif
                    @if ($urease == 'Positive (+)')
                        <button class="btn modal_ureasetest btn-soft-danger btn-sm fs-14" sub-name="positive"
                        cid="{{@$id}}" hn="{{@$hn}}" patientname="{{@$patientname}}" contact="{{@$patient_tel}}" select="{{@$urease}}" other="{{@$urease_other}}" count="{{@count($procedure)}}">Positive(+)</button>
                    @endif
                    @if ($urease == 'Negative (-)')
                        <button class="btn modal_ureasetest btn-soft-success btn-sm fs-14"  sub-name="negative"
                        cid="{{@$id}}" hn="{{@$hn}}" patientname="{{@$patientname}}" contact="{{@$patient_tel}}" select="{{@$urease}}" other="{{@$urease_other}}" count="{{@count($procedure)}}">Negative (-)</button>
                    @endif
                @endif
            </td>

            <td>
                @if (isset($data->prediagnosis_other) && @$data->prediagnosis_other . '' != '')
                    {{ $data->prediagnosis_other }}
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
                @if(empty($desc))
                    -
                @else
                    {{ $desc }}
                @endif
            </td>
        </tr>

        @php
            $i = $i + 1;
        @endphp
    @endif
@endforeach


<script>

$(".modal_ureasetest").click(function(){
    $('#span_patientname').html('')
    $('#span_hn').html('')
    $('#span_contact').html('')
    let subname = $(this).attr('sub-name')
    let count   = $(this).attr('count')
    let hn      = $(this).attr('hn')
    let phone   = $(this).attr('contact')
    if(count > 1){
        $.post('{{url("api")}}/home', {
            event: "get_only_egd",
            hn   : hn,
        }, function(data, status){
            let parse = JSON.parse(data)
            let id    = parse._id
            id        = id['$oid']
            $(`#urease_${subname}`).prop('checked', true)
            $("#ureasetest").modal('show');
            $('#span_ureahn').html(parse.case_hn)
            $('#span_hn').html(hn)
            $('#span_patientname').html(parse.patientname)
            $('#span_contact').html(phone)
            $('#urease_text').val(parse.rapid_other)
            $('#case_id').val(id)
        })
    } else {
        $(`#urease_${subname}`).prop('checked', true)
        $("#ureasetest").modal('show');
        $('#span_ureahn').html(hn)
        $('#span_hn').html(hn)
        $('#span_patientname').html($(this).attr('patientname'))
        $('#span_contact').html($(this).attr('contact'))
        $('#urease_text').val($(this).attr('other'))
        $('#case_id').val($(this).attr('cid'))
    }

});


function change_urease_text(type) {
    let text = ''
    if(type.includes('positive')){
        text = 'Positive (+)'
    } else if (type.includes('negative')){
        text = 'Negative (-)'
    } else if (type.includes('pending')){
        text = ' Positive [   ]         Negative [   ]'
    }
    $('#urease_text').val(text)
}

</script>
