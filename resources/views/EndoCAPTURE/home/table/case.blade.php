@php
    $index = 0;
@endphp
@foreach ($data as $in=>$h)
    @php
        $case_json = jsonDecode($h->case_json);
        $is_shown  = ($in < 9 ) ? '' : 'none';

        $case_procedure = '';
        $more_cases = 0;


        if(isset($procedures[$h->case_hn])){
            // dd($procedures[$h->case_hn]);
            // foreach ($procedures[$h->case_hn] as $text) {
            //     $case_procedure = $case_procedure.$text;
            //     $case_procedure = $case_procedure."</br>";
            // }
            if(count($procedures[$h->case_hn]) > 1){
                $more_cases = 1;
            }
        }

        if(isset($h->case_dateappointment)){
            $datetime = $h->case_dateappointment;
            $exp = explode(' ', $datetime);
            $date = '';
            if(isset($exp[0])){
                $date = $exp[0];
            }
        }

        $should_hide = 'false';
        $hidden_class = 'need-hidden';
        if($type == 'today'){
            if(isset($status[$h->case_hn])){
            $test_here = 'dddf';
            if(isset($tab)){
                if($tab == 'holding'){
                    if(in_array('Operation', $status[$h->case_hn])){
                        $should_hide = 'true';
                    } else {
                        $should_hide = 'false';
                    }
                } else if ($tab == 'operation'){
                    $count = count($status[$h->case_hn]);
                    $holding = 0;
                    $recovery = 0;
                    foreach ($status[$h->case_hn] as $text) {
                        if($text == 'Holding'){
                            $holding = $holding + 1;
                        }
                        if($text == 'Recovery'){
                            $recovery = $recovery + 1;
                        }
                    }
                    if ($holding == $count || $recovery == $count){
                        $should_hide = 'true';
                    }
                } else if ($tab == 'recovery'){
                    $count = count($status[$h->case_hn]);
                    $recovery = 0;
                    foreach ($status[$h->case_hn] as $text) {
                        if($text == 'Recovery'){
                            $recovery = $recovery + 1;
                        }
                    }
                    if ($recovery == $count){
                        $should_hide = 'false';
                    } else {
                        $should_hide = 'true';
                    }
                } else if ($tab == 'discharged'){
                    $count = count($status[$h->case_hn]);
                    $discharged = 0;
                    foreach ($status[$h->case_hn] as $text) {
                        if($text == 'Discharged'){
                            $discharged = $discharged + 1;
                        }
                    }
                    if ($discharged == $count){
                        $should_hide = 'false';
                    } else {
                        $should_hide = 'true';
                    }
                }
            }
        }
        } else {
            $should_hide = 'false';
        }
    @endphp

    {{-- @foreach ($status[$h->case_hn] as $te)
        {{$te}}
    @endforeach --}}


    @if($should_hide == 'false')
        @php
            $index = $index + 1;
        @endphp
    @endif
    <tr class="@if($should_hide == 'true') {{$hidden_class}}  @endif" style="@if($should_hide == 'true') display: none  @endif" >
        {{-- <td>{{$h->case_status}}</td>
        <td>{{$type}}</td> --}}

        <td>{{$index}}</td>
        <td class="case-hn" id="case_hn">{{@$h->case_hn}}</td>
        <td class="case-name">{{@$case_json->patientname}}</td>
        <td class="case-doctor">{{@$case_json->doctorname}} ({{rand(1000,9999)}})</td>
        <td class="case-procedure" id="case_procedure">
            @if(isset($procedures[$h->case_hn]))
                @foreach($procedures[$h->case_hn] as $text)
                    {{$text}}
                    <br>
                @endforeach
            @endif
        </td>
        <td class="case-dateappointment" hidden>{{@$date}}</td>

        @if($type == 'all')
            <td>Anesthetic + Flu</td>
        @elseif($h->case_status == 1 || $h->case_status == 4)

        @else
            <td>Anesthetic + Flu</td>
        @endif

        @if(($h->case_status == 1 || $h->case_status == 4) && $type != 'all')

        @elseif($type == 'all')

        @elseif($h->case_status == 0)
            <td></td>
        @elseif($h->case_status == 2)
            <td>Complication</td>
        @elseif($h->case_status == 3)
        <td>Complication</td>
        @else
            <td>Normal Colonoscopy</td>
            <td>Gastric Bleeding</td>
        @endif

        @if(($h->case_status == 1 || $h->case_status == 4) && ($type != 'all'))
            <td>
                @if(isset($status[$h->case_hn]))
                    @foreach($status[$h->case_hn] as $text)
                        {{$text}}
                        <br>
                    @endforeach
                @endif
            </td>
            <td>Scope 1</td>
        @elseif($h->case_status == 0   || ($type == 'all') )
            <td class="text-center">
                <span class="badge @if($h->case_status == 3 && $type == 'all') badge-soft-success @else badge-soft-danger  @endif">@if($h->case_status == 3 && $type == 'all') Complete @elseif($h->case_status == 1 || $h->case_status == 0 || $h->case_status == 4 ) Incomplete @elseif($h->case_status == 2) Incomplete  @endif</span>
            </td>
        @elseif($h->case_status == 2)
            <td class="text-center">
                @if($more_cases == 1)
                    <button type="button" class="btn btn-sm btn-primary" onclick="open_same_hn('{{$h->case_hn}}', '{{$h->case_id}}', '{{$more_cases}}')"><i class="ri-file-text-fill"></i></button>
                    <button type="button" class="btn btn-sm btn-dark-primary" onclick="open_same_hn('{{$h->case_hn}}', '{{$h->case_id}}', '{{$more_cases}}')"><i class="ri-folder-open-fill"></i></button>
                @else
                    <a href="{{url("reportendocapture/{{@$h->caseuniq}}")}}" class="btn btn-sm btn-dark-primary"><i class="ri-file-text-fill"></i></a>
                    <a href="{{url("procedure/{{@$h->case_id}}")}}" class="btn btn-sm btn-dark-primary"><i class="ri-folder-open-fill"></i></a>
                @endif
            </td>
        @elseif($h->case_status == 3)
        <td>discharged</td>
        <td>send</td>
        @endif

        @if($h->case_status != 3 && $type != 'all' && $h->case_status != 2)
            <td class="text-center">
                @if($more_cases == 1)
                    <button type="button" class="btn btn-icon btn-primary" onclick="open_same_hn('{{$h->case_hn}}', '{{$h->case_id}}', '{{$more_cases}}')"><i class="ri-folder-open-fill"></i></button>
                    <button type="button" class="btn btn-icon btn-success" onclick="open_same_hn('{{$h->case_hn}}', '{{$h->case_id}}', '{{$more_cases}}')"><i class="ri-camera-fill"></i></button>
                    <button type="button" class="btn btn-icon btn-danger" onclick="open_same_hn('{{$h->case_hn}}', '{{$h->case_id}}', '{{$more_cases}}')"><i class="ri-forbid-2-line"></i></button>
                @else
                    <a href="{{url("procedure/{{@$h->case_id}}")}}" class="btn btn-icon btn-dark-primary"><i class="ri-folder-open-fill"></i></a>
                    <a href="{{url("camera/{{@$h->case_id}}")}}" class="btn btn-icon btn-success"><i class="ri-camera-fill"></i></a>
                    <button onclick="close_case('{{$h->case_hn}}','{{get_procedure_name($h->case_procedure)}}', '{{@$h->case_id}}')" class="btn btn-sm btn-danger"><i class="ri-forbid-2-line"></i></button>
                @endif
            </td>

        @elseif($type != 'all'  && $h->case_status != 2 && $h->case_status != 3)
            <td>Normal Colonoscopy</td>
            <td>Gastric Bleeding</td>
        @endif
        @if($h->case_status == 3 && $type == 'today')
            <td class="text-center">
                @if($more_cases == 1)
                    <button type="button" class="btn btn-sm btn-dark-primary" onclick="open_same_hn('{{$h->case_hn}}', '{{$h->case_id}}', '{{$more_cases}}')"><i class="ri-file-text-fill"></i></button>

                    {{-- <button type="button" class="btn btn-sm btn-dark-primary" onclick="open_same_hn('{{$h->case_hn}}', '{{$h->case_id}}', '{{$more_cases}}')"><i class="ri-folder-open-fill"></i></button>
                    <button type="button" class="btn btn-sm btn-success" onclick="open_same_hn('{{$h->case_hn}}', '{{$h->case_id}}', '{{$more_cases}}')"><i class="ri-camera-fill"></i></button>
                    <button type="button" class="btn btn-sm btn-danger" onclick="open_same_hn('{{$h->case_hn}}', '{{$h->case_id}}', '{{$more_cases}}')"><i class="ri-forbid-2-line"></i></button> --}}
                @else
                    <a href="{{url("reportendocapture/@$h->caseuniq")}}" class="btn btn-sm btn-dark-primary"><i class="ri-file-text-fill"></i></a>

                    {{-- <a href="{{url("procedure/@$h->case_id")}}" class="btn btn-sm btn-dark-primary"><i class="ri-folder-open-fill"></i></a>
                    <a href="{{url("camera/@$h->case_id")}}" class="btn btn-sm btn-success"><i class="ri-camera-fill"></i></a>
                    <button onclick="close_case('{{$h->case_hn}}','{{get_procedure_name($h->case_procedure)}}', '{{@$h->case_id}}')" class="btn btn-sm btn-danger"><i class="ri-forbid-2-line"></i></button> --}}
                @endif
            </td>
        @elseif($type == 'all')
        <td>send PACs</td>
        <td class="text-center">
            @if($more_cases == 1)
                <button type="button" id="open_modal_cases" class="btn btn-sm btn-dark-primary" onclick="open_same_hn('{{$h->case_hn}}', '{{$h->case_id}}', '{{$more_cases}}')"><i class="ri-file-text-fill"></i></button>
                {{-- <button type="button" class="btn btn-sm btn-success" onclick="open_same_hn('{{$h->case_hn}}', '{{$h->case_id}}', '{{$more_cases}}')"><i class="ri-camera-fill"></i></button>
                <button type="button" class="btn btn-sm btn-danger" onclick="open_same_hn('{{$h->case_hn}}', '{{$h->case_id}}', '{{$more_cases}}')"><i class="ri-forbid-2-line"></i></button> --}}
            @else
                <a href="{{url("reportendocapture/@$h->caseuniq")}}" class="btn btn-sm btn-dark-primary"><i class="ri-file-text-fill"></i></a>
                {{-- <a href="{{url("")}}" class="btn btn-sm btn-success"><i class="ri-camera-fill"></i></a>
                <button onclick="close_case('{{$h->case_hn}}' ,'{{get_procedure_name($h->case_procedure)}}', '{{@$h->case_id}}')" class="btn btn-sm btn-danger"><i class="ri-forbid-2-line"></i></button> --}}
            @endif
        </td>
        @endif
    </tr>
@endforeach
