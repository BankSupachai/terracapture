
<tr class=" set-font-family" style="line-height:{{$body_line}};">
    {{-- <td colspan="2">
        <span class="casetitle">COMPLICATION :</span>
        <span class="casetext" style="margin-left: 41px;">
            @isset($casedata->complication)
                @if(gettype($casedata->complication)=='array')
                    @foreach($casedata->complication as $data)
                        {{$data}} <br>
                    @endforeach
                @endif
            @endisset

            {{@$casedata->complication_other}}

            @if(!isset($casedata->complication) && !isset($casedata->complication_other))
            None Complication
            @endif
        </span>
    </td> --}}
</tr>
