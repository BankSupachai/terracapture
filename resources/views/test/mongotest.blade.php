@php
$i = 1;
@endphp

@foreach ($mongo as $data)
    <br>{{$i}} &nbsp;&nbsp;&nbsp;{{$data['caseuniq']}}
    @php
        $i++;
    @endphp
@endforeach
