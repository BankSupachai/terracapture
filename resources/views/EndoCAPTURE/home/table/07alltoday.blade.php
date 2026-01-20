

@php
    $i = 0;
    $admin = getCONFIG('admin');
use App\Models\Patient;

@endphp
@foreach ($alltoday_case as $in => $data)
{{-- @dd($data); --}}
    @if (isset($data['case_hn']) || isset($data['hn']))
        @php

            $data = (object) $data;
            $hn = isset($data->case_hn) ? $data->case_hn : $data->hn;


            $patientname = Patient::fullname_patient($data->hn);

            // dd($patientname);



            $physician = isset($data->doctorname) ? $data->doctorname : $data->physician;
            $procedure = isset($data->procedure) ? $data->procedure : [];
            $statuspacs = isset($data->statuspacs) ? $data->statuspacs : [];
            $statusvna = isset($data->vna) ? $data->vna : [];
            $statusjob = isset($data->statusjob) ? array_values(array_unique($data->statusjob)) : [];
            $_id = $data->id;

    // dd($room);

            $room = isset($data->room) && @$data->room != '' ? get_room_name(intval($data->room)) : '';
            $appointment = isset($data->appointment) ? explode(' ', $data->appointment) : null;
            $date = isset($appointment) ? format_date($appointment[0], 'd M Y') : '';
            $desc = (@$data->description == '' || @$data->description == 'N/A') ? '-' : @$data->description;

            // dd($desc);
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
            $case_pdfversion = isset($data->case_pdfversion) && @$data->case_pdfversion != '' ? $data->case_pdfversion : [];
            $count_pdf       = is_array($case_pdfversion) ? count($case_pdfversion) : 0;
            $patient_tel     = get_patient_data($hn, 'phone');
            // $urease          = isset($data->rapid_urease_test) ? implode('', $data->rapid_urease_test) : '-';

            $urease_other    = isset($data->rapid_other)       ? implode('', $data->rapid_other) : '';
            // dd( $urease  ,$urease_other );
        @endphp


            {{-- @dd(1) --}}
        <tr>
            <td class="index" style="white-space: nowrap;">
                @if (count($procedure) > 1)
                    @if($admin->com_type!="server")
                    <button type="button" class="btn btn-icon btn-loadicon btn-danger"
                        onclick="open_same_hn('{{ $data->hn }}', '{{ $data->id }}', '{{ @$more_cases }}', 'camera')">
                        <i class="ri-camera-fill ri-lg"></i></button>
                    @endif
                    <button type="button" class="btn btn-icon btn-loadicon btn-primary "
                        onclick="open_same_hn('{{ $data->hn }}','{{ $data->id }}','{{ @$more_cases }}', 'procedure')">
                        <i class="ri-folder-open-fill ri-lg"></i></button>
                    <a href="{{ url("reportendocapture/$_id") }}" class="btn btn-icon btn-blue btn-loadicon" id="btn_dis"
                        @if (!in_array('recovery', $statusjob) && !in_array('discharged', $statusjob)) style="pointer-events: none;  background-color:#F3F6F9; color: #707070 " @endif>
                        <i class="ri-file-text-fill ri-lg"></i>
                    </a>

                @else
                    @if($admin->com_type!="server")
                    <a href="{{ url("camera/$data->id") }}" class="btn btn-icon btn-loadicon btn-danger"><i
                            class="ri-camera-fill ri-lg"></i></a>
                    @endif
                    <a href="{{ url("procedure/$_id") }}" class="btn btn-icon btn-loadicon btn-primary"><i
                            class="ri-folder-open-fill ri-lg"></i></a>
                    <a href="{{ url("reportendocapture/$_id") }}" class="btn btn-icon btn-loadicon btn-blue" id="btn_dis"
                        @if (!in_array('recovery', $statusjob) && !in_array('discharged', $statusjob) && !in_array('Discharged', $statusjob)) style="pointer-events: none;  background-color:#F3F6F9; color: #707070 " @endif>
                        <i class="ri-file-text-fill  ri-lg "></i>
                    </a>


                    {{-- @if ($data2 == 'discharged' || $data2 == 'Discharged') --}}
                    {{-- <button class="btn btn-icon" style="background: transparent;">
                        <i class="ri-checkbox-circle-fill text-success ri-xl"></i>
                    </button> --}}
                @endif
            </td>
            <td data-text="{{$hn}}">
                @if (count($procedure) > 1)
                    <a href="javascript:;"
                        onclick="open_same_hn('{{ $data->hn }}', '{{ $data->id }}', '{{ @$more_cases }}', 'procedure')">
                        <span style="color: #245788;">{{ $hn }}</span>
                    </a>
                @else
                    <a href="{{ url("procedure/$_id") }}" class="">
                        <span style="color: #245788;">{{ $hn }}</span>
                    </a>
                @endif
            </td>

            <td data-text="{{$patientname}}">
                @if (count($procedure) > 1)
                    <a href="javascript:;"
                        onclick="open_same_hn('{{ $data->hn }}', '{{ $data->id }}', '{{ @$more_cases }}', 'procedure')">
                        <span style="color: #245788;">{{ @$patientname }}</span>
                    </a>
                @else
                    <a href="{{ url("procedure/$_id") }}" class="">
                        <span style="color: #245788;">{{ @$patientname }}</span>
                    </a>
                @endif
            </td>


            <td>
                @foreach ($statusjob as $data2)
                    @if ($data2 == 'discharged' || $data2 == 'Discharged')
                        <div class="py-2">
                            <span class="badge-soft-success px-1">Discharged</span><br>
                        </div>
                    @endif

                    @if ($data2 == 'recovery')
                        <div class="py-2">
                            <span class="badge-soft-secondary  px-1">Recovery</span> <br>

                        </div>
                    @endif

                    @if ($data2 == 'holding' || $data2== "registered" || $data2== "register")
                        <div class="py-2">
                            <span class="badge-soft-warning px-1">Holding</span> <br>
                        </div>
                    @endif

                    @if ($data2 == 'operation')
                        <div class="py-2">
                            <span class="badge-soft-danger px-1 ">Operation</span> <br>
                        </div>
                    @endif
                @endforeach

            </td>
            <td>
                @isset($physician)
                    {{ $physician }}
                @else
                    -
                @endisset
            </td>
            <td>
                @php
                    $numpacs = 0;
                @endphp
                @foreach (isset($procedure) ? $procedure : [] as $p)
                    {{ $p }}
                    @if (count($procedure) > 1)

                    @endif

                    @if($statuspacs[$numpacs])
                        <i class="ri-checkbox-circle-fill ri-lg text-success"></i>
                    @else
                        <i class="ri-checkbox-circle-fill ri-lg" style="visibility:hidden;"></i>
                    @endif
                    @if(isset($statusvna[$numpacs]))
                        <i class="ri-checkbox-circle-fill ri-lg text-success"></i>
                    @else
                        <i class="ri-checkbox-circle-fill ri-lg" style="visibility:hidden;"></i>
                    @endif
                    <br>
                    @php
                        $numpacs++;
                    @endphp
                @endforeach
            </td>
            <td>
                {{ @$room }}
            </td>
            <td>
                @if(isset($urease_other) && $urease_other != '')
                    @if (strlen($urease_other) > 15 || $urease_other == 'Pending')
                        <button class="btn modal_ureasetest btn-soft-warning btn-sm fs-14" sub-name="pending"
                        cid="{{@$_id}}" hn="{{@$hn}}" patientname="{{@$patientname}}" contact="{{@$patient_tel}}" select="{{@$urease}}" other="{{@$urease_other}}" count="{{@count($procedure)}}">Pending</button>
                    @endif
                    @if ($urease_other == 'Positive (+)')
                        <button class="btn modal_ureasetest btn-soft-danger btn-sm fs-14" sub-name="positive"
                        cid="{{@$_id}}" hn="{{@$hn}}" patientname="{{@$patientname}}" contact="{{@$patient_tel}}" select="{{@$urease}}" other="{{@$urease_other}}" count="{{@count($procedure)}}">Positive(+)</button>
                    @endif
                    @if ($urease_other == 'Negative (-)')
                        <button class="btn modal_ureasetest btn-soft-success btn-sm fs-14"  sub-name="negative"
                        cid="{{@$_id}}" hn="{{@$hn}}" patientname="{{@$patientname}}" contact="{{@$patient_tel}}" select="{{@$urease}}" other="{{@$urease_other}}" count="{{@count($procedure)}}">Negative (-)</button>
                    @endif
                @else
                    -
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

                    {{ $desc}}

            </td>
        </tr>

        @php
            $i = $i + 1;
        @endphp
    @endif
@endforeach

<script>

$(".modal_ureasetest").click(function(){
    // alert(1);
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
            console.log(hn);
            let id    = parse._id
            id        = id['$oid']
            console.log(parse);
            $(`#urease_${subname}`).prop('checked', true)
            $("#ureasetest").modal('show');
            $('#span_ureahn').html(parse.case_hn)

            $('#span_patientname').html(parse.patientname)
            $('#span_contact').html(phone)
            $('#urease_text').val(parse.rapid_other)
            $('#case_id').val(id)
        })
    } else {
        // alert(3)
        // console.log(data);
        $(`#urease_${subname}`).prop('checked', true)
        $("#ureasetest").modal('show');
        $('#span_ureahn').html(hn)
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
