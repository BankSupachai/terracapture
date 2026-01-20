@php
    $more_cases = 0;
    $i = 0;
@endphp
@isset($tb_case)
    @foreach ($tb_case as $in=>$case)
    @php
        $procedures = '';
        if(isset($case['procedure'])){
            $count = is_array($case['procedure']) ? count($case['procedure']) : 0;
            // dd($count);
            for($i=0; $i < $count; $i++){
                $procedures = $procedures.$case['procedure'][$i].',';
                $procedures = rtrim($procedures);
            }
        }


    @endphp
        <tr>
            <td>{{@$i+1}}</td>
            <td>{{@$case['hn']}}</td>
            <td>{{@$case['firstname']}} {{@$case['lastname']}}</td>
            <td>{{@$case['physician']}}</td>
            <td>{{@$procedures}}</td>
            <td>description</td>
            <td>waiting location</td>
            <td class="text-center">
                @if($more_cases == 1)
                    <button type="button" class="btn btn-icon btn-primary" onclick="open_same_hn('{{$case['hn']}}', '{{$case['_id']}}', '{{$more_cases}}')"><i class="ri-folder-open-fill"></i></button>
                    <button type="button" class="btn btn-icon btn-success" onclick="open_same_hn('{{$case['hn']}}', '{{$case['_id']}}', '{{$more_cases}}')"><i class="ri-camera-fill"></i></button>
                    <button type="button" class="btn btn-icon btn-danger" onclick="open_same_hn('{{$case['hn']}}', '{{$case['_id']}}', '{{$more_cases}}')"><i class="ri-forbid-2-line"></i></button>
                @else
                    <a href="{{url("procedure/{{@$case['_id']}}")}}" class="btn btn-icon btn-primary"><i class="ri-folder-open-fill"></i></a>
                    <a href="{{url("camera/{{@$case['_id']}}")}}" class="btn btn-icon btn-success"><i class="ri-camera-fill"></i></a>
                    <button onclick="close_case('{{$case['hn']}}','{{$procedures}}', '{{@$case['_id']}}')" class="btn btn-icon btn-danger"><i class="ri-forbid-2-line"></i></button>
                @endif
            </td>
        </tr>
        @php
            $i = $i + 1;
        @endphp
    @endforeach
@endisset

