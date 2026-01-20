@extends('pdf.pdf_procedure_base')
@section('namereport', 'Procedure Report')
@section('td')
    <td valign="top" height="800px" width="370">
    @endsection
    @section('detail_right')
        @php
            $i = 0; //จำนวนรูป
            $bb = 1; //กำหนดการเริ่มต้น
            $w = 170; //ความกว้างรูป
        @endphp
        <table border="0">
            <tr>
                <td valign="top">
                    @foreach ($photoselect as $p)
                        @php $i++; @endphp
                        @if ($i <= 8)
                            <table border="0" width="{{ $w }}">
                                <tr>
                                    @php
                                        if ($p->photo_status == 1) {
                                            $border_color="black";
                                        } else {
                                            $border_color="black";
                                        }
                                        $path = picurl($casedata->hn . '/' . $p->photo_name);
                                    @endphp

                                    <td style="border: 1px solid {{ $border_color }} ;">
                                        <img src="{{ $path }}" width="{{ $w }}px" height="150px">
                                    </td>
                                </tr>

                                <tr>
                                    <td style="border: 1px solid {{ $border_color }} ;height:20px">
                                        <font>[ {{ $i }} ]</font>

                                        @if ($p->mainpartsub_name != '')
                                            <font color="{{ $border_color }}">{{ $p->mainpartsub_name }}</font>
                                            <br>
                                            <font>{{ $p->photo_text }}</font>
                                        @else
                                            <font>{{ $p->photo_text }}</font>
                                        @endif

                                        @if ($p->photo_gastrolesion != '')
                                            <br>
                                            <font>{{ $p->photo_gastrolesion }}</font>
                                        @endif
                                    </td>
                                </tr>
                            </table>


                            @if ($bb == 1)
                </td>
                <td width="0"></td>
                <td valign="top">
                    <?php $bb = 0; ?>
                @else
                </td>
            </tr>
        </table>

        <table border="1">
            <tr>
                <td valign="top">
                    <?php $bb++; ?>
                    @endif
                    @endif
                    @endforeach
                </td>
            </tr>
        </table>
        @if (1 == 1)
        @endif
    @endsection
