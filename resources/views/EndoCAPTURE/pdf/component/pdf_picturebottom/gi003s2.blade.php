@php
    $body_line = '5px';
@endphp

<style>
    .content_right {
        top: {{ configTYPE('pdf', 'pdf_content_right_top') }};
        position: fixed;
        right: 0px;
        padding: 0px;
        font-weight: bold;
        left: 565px;
        /* padding-left:1em; */
    }

    .casetitle-small {
        color: #245788;
        font-size: 12px
            /* font-weight: normal !important; */

    }

    .casetext-small {
        color: #585858;
        font-size: 12px;
        line-height: 8px;
        /* font-weight: 300 !important; */


    }

    .casetextdent-small {
        color: #585858;
        font-size: 11px;
        line-height: 8px;
        /* font-weight: 300 !important; */


    }

    .casetext-fiding-small {
        color: #0AB39C;
        font-size: 12px;
        line-height: 5px;
        white-space: nowrap;
        /* font-weight: normal !important; */

    }

    .casetext-red-small {
        color: #F06548;
        font-size: 12px;
        line-height: 8px;
    }

    .page-break {
        page-break-after: always;
    }


    /* table, tr, td {
            border: 1px solid black !important;
        } */
</style>

@php
    use App\models\Mongo;
@endphp

{{-- @include('endocapture.pdf.component.pdf_head_ercp') --}}
@include('EndoCAPTURE.pdf.component.ercp_photo')


<table width="520px" border="0" style="margin-top: 2em;">
    <tr>
        <td>@include('endocapture.pdf.component.left_section.0042_ercp_trainee')</td>
    </tr>
    <tr>
        <td>@include('endocapture.pdf.component.left_section.0042_ercp_anes')</td>
    </tr>
    <tr>
        <td>@include('endocapture.pdf.component.left_section.0043_ercp_medi')</td>
    </tr>
    <tr>
        <td>@include('endocapture.pdf.component.left_section.0041_ercp_position')</td>
    </tr>
    <tr>
        <td>@include('endocapture.pdf.component.left_section.0044_ercp_pos_scope')</td>
    </tr>
    <tr>
        <td>@include('endocapture.pdf.component.left_section.0045_ercp_indication')</td>
    </tr>
    <tr>
        <td>@include('endocapture.pdf.component.left_section.0046_ercp_finding')</td>
    </tr>
    <tr>
        <td>@include('endocapture.pdf.component.left_section.0047_ecrp_cannulation')</td>
    </tr>
</table>

<table width="520px" border="0">
    <tr>
        <td>@include('endocapture.pdf.component.left_section.0048_ercp_cholangiogram')</td>
    </tr>
</table>

<table width="520px" border="0">
    <tr>
        <td>@include('endocapture.pdf.component.left_section.0049_ercp_MoreCholangiogram')</td>
    </tr>
    <tr>
        <td>@include('endocapture.pdf.component.left_section.0050_ercp_stent')</td>
    </tr>
</table>

<table width="520px" border="0">
    <tr>
        <td>@include('endocapture.pdf.component.left_section.0051_ercp_directballloon')</td>
    </tr>
</table>

<table width="520px" border="0">
    <tr>
        <td>@include('endocapture.pdf.component.left_section.0053_ercp_procedurelist')</td>
    </tr>
    <tr>
        <td>@include('endocapture.pdf.component.left_section.0052_ercp_other')</td>
    </tr>
</table>

{{-- @dd($photoselect) --}}

@if(count($photoselect)>4)
<div class="page-break"></div>
@endif

<table>
    <tr>
        <td>

            @php


                $width = 173;
                $height = 173;
                $marginleft = 'margin-left:0px';
                $picperrow = 4;
                $num1 = 4;
                $i = 0;
                $startpic = 4;
                $tempn = 0;
                $n = 0;
                $all = 0;
                $row = [];
                $x = 1;
                // $startpic++;

                foreach ($photoselect as $in => $data) {
                    $all++;
                    if ($num1 < $all) {
                        $tempn++;
                        $row[$n][] = $data;
                        if ($tempn == $picperrow) {
                            $tempn = 0;
                            $n++;
                        }
                    }
                }
            @endphp

            @foreach ($row as $data)
                <table border="0"
                    style="background-color: white;text-align:center;{{ $marginleft }};z-index:99999;width:100%">
                    <tr>
                        <td>
                            <table border="0" class="set-num-image">
                                <tr>
                                    {{-- @dd($data); --}}
                                    @foreach ($data as $data2)
                                        <?php $startpic++; ?>
                                        <td valign="top" style="padding-left: 13px;">
                                            <table>
                                                <tr>
                                                    <td>
                                                        <img src="{{ mePHOTO($casedata->case_hn, $data2['na'], $folderdate) }}"
                                                            width="{{ $width }}" height="{{ $height }}">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="line-height:10px">
                                                        [{{ $startpic }}]
                                                        @if ($data2['sc'] != '')
                                                            <font color="">{{ @$data2['sc'] }}<br></font>
                                                            <font>{{ $data2['tx'] }}</font>
                                                        @else
                                                            <font>{{ $data2['tx'] }}</font>
                                                        @endif
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    @endforeach
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>


                @if($x==4)
                    <div class="page-break"></div>
                    @php
                    $x=0;
                    @endphp
                @endif

                @php
                    $x++;
                @endphp

            @endforeach
        </td>
    </tr>
</table>
