@php
    if (isset($casedata->box_cervix)) {
        $box_cervix = ($casedata->box_cervix);
    }else{
        $box_cervix = array();
    }

    if (isset($casedata->box_vagina)) {
        $box_vagina = ($casedata->box_vagina);
    }else{
        $box_vagina = array();
    }

    if (isset($casedata->box_vulva)) {
        $box_vulva = ($casedata->box_vulva);
    }else{
        $box_vulva = array();
    }

@endphp
<table border="0" width="550" >
    {{--
    <tr >
        <td  style="width: 50%; color: #245788;">COLPOSCOPIC FINDING T ZONE : : {{ @$casedata->colposcopicfindingtzone }}</td>
        <td  style="color: #245788;">COLPOSCOPIC DIAGNOSIS :{{ @$casedata->colposcopicdiagnosis }} </td>
    </tr>
    --}}

    <tr >
        <td  style="width: 50%; color: #245788; line-height: 12px;">COLPOSCOPIC FINDING T ZONE :
            <span style="color: #808080;">
                {{@$casedata->colpo_select}} <br> {{@$casedata->colpo_text}}
            </span>
        </td>
        <td  style="color: #245788; line-height: 12px;">Cervix :
            <span style="color: #808080;">
                {{implode(" , ",$box_cervix)}}
                @isset($casedata->text_cervix01,)
                    @if ($casedata->text_cervix01 != "" )
                    <br> Other : {{ @$casedata->text_cervix01 }}
                    @endif
                @endisset

                @isset($casedata->text_cervix02,)
                @if ($casedata->text_cervix02 != "" )
                <br>{{ @$casedata->text_cervix02 }}
                @endif

            @endisset

            {{-- @foreach ($box_cervix as $data)
                {{$data}}<br>
            @endforeach --}}
            {{-- {{ @$casedata->text_cervix01 }}
            @isset($casedata->text_cervix02)
                <br>{{ @$casedata->text_cervix02 }}
            @endisset --}}

            </span>
        </td>
    </tr>


    <tr >
        <td style="color: #245788; line-height: 12px;">RX :<span style="color: #808080;"> {{ @$casedata->rx }}</span></td>
        <td style="color: #245788; line-height: 12px;">Vagina :
            <span style="color: #808080;">
                {{implode(" , ", $box_vagina)}}
                @isset($casedata->text_vagina01)
                    @if ($casedata->text_vagina01 != "")
                    <br> Other : {{$casedata->text_vagina01}}
                    @endif
                @endisset

                @isset($casedata->text_vagina02)
                @if ($casedata->text_vagina01 != "")
                <br> {{$casedata->text_vagina02}}
                @endif
            @endisset
            {{-- @foreach ($box_vagina as $data)
            {{$data}}<br>
            @endforeach --}}
            {{-- {{ @$casedata->text_vagina01 }}
            @isset($casedata->text_vagina02 )
            @endisset --}}

            </span>
        </td>
    </tr>
    <tr>
        <td  style="color: #245788; line-height: 12px;">SUGGESTION : <span style="color: #808080; line-height: 12px;">{{ @$casedata->suggestion }}</span></td>
        <td  style="color: #245788; line-height: 12px;">Vulva :
            <span style="color: #808080;">
                {{implode(" , ", $box_vulva)}}
                @isset($casedata->text_vulva01)
                    @if ($casedata->text_vulva01 != "")
                    <br> Other : {{$casedata->text_vulva01}}
                    @endif
                @endisset

                @isset($casedata->text_vulva02)
                @if ($casedata->text_vulva02 != "")
                <br> {{$casedata->text_vulva02}}
                @endif
            @endisset
            {{-- @foreach ($box_vulva as $data)
            {{$data}}<br>
            @endforeach
            {{ @$casedata->text_vulva01 }}
            @isset($casedata->text_vulva02)
            <br>{{ @$casedata->text_vulva02 }}
            @endisset --}}
            </span>
        </td>
    </tr>
</table>
