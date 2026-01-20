{{-- @dd($casedata); --}}

<style>

</style>

@php
    if (isset($casedata->box_hormonecontraception)) {
        $box_hormonecontraception = $casedata->box_hormonecontraception;
    } else {
        $box_hormonecontraception = [];
    }

    if (isset($casedata->box_symptom)) {
        $box_symptom = $casedata->box_symptom;
    } else {
        $box_symptom = [];
    }
@endphp
<table border="0" width="100%"  style="margin-top: 3em;">
    <tr>
        <td style="width: 50%; color: #245788; line-height: 12px; ">LMP :
            <span style="color: #808080;">{{ @$casedata->lmp }}</span>
        </td>
        <td style="color: #245788; line-height: 12px;">HORMONE, CONTRACEPTION :
            <span style="color: #808080;">


                {{ implode(' , ', $box_hormonecontraception) }}
                {{-- @foreach ($box_hormonecontraception as $data)
            {{$data}},
            @endforeach<br> --}}
                @isset($casedata->hormonecontraception)
                    @if ($casedata->hormonecontraception != '')
                        <br> Other : {{ @$casedata->hormonecontraception }}
                    @endif
                @endisset
            </span>
        </td>
    </tr>
    <tr>
        <td style="color: #245788; line-height: 12px;">CLINICAL DATA :
            <span style="color: #808080;">{{ @$casedata->clinicaldata }}</span>
        </td>
        <td style="color: #245788; line-height: 12px;">SYMPTOM :
            <span style="color: #808080;">
                {{ implode(' , ', $box_symptom) }}
                @isset($casedata->symptom)
                    @if ($casedata->symptom != '')
                        <br> Other : {{ @$casedata->symptom }}
                    @endif
                @endisset
                {{-- @foreach ($box_symptom as $data)
                {{$data}},
                @endforeach<br> --}}
            </span>
        </td>
    </tr>
    <tr>
        <td style="color: #245788; line-height: 12px;">PAP NUMBER:
            <span style="color: #808080;">{{ @$casedata->papnumber }}</span>
        </td>
        <td style="color: #245788; line-height: 12px;">PAP REPORT :
            <span style="color: #808080;">{{ @$casedata->papreport }}</span>
        </td>
    </tr>
</table>
