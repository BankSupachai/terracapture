@extends('pdf.pdf_procedure_base')
@section('namereport','Procedure Report')
@section('td')
<td valign="top" height="800px" width="370">
@endsection

@section('detail_right')
    @php
        $i  = 0;    //จำนวนรูป
        $bb = 0;    //กำหนดการเริ่มต้น
        $w  = 320;  //ความกว้างรูป
        $h  = 170;
    @endphp


    <table border="0">
        <tr>
          {{--
            ห้ามลบเผื่อ อยากเอากลับมาใซ้อีก
            <td valign="top">
                <table border="1">
                    <tr>
                        <td>
                            <img src="pdf_pic/{{$_GET['id']}}.jpg" width="{{$w}}">
                        </td>
                    </tr>
                </table>
            </td>
            <td width="10"></td>
          --}}
            <td valign="top">

    @foreach ($photoselect as $p)
        @php $i++; @endphp
        @if($i<=4)

        <table border="0" width="{{$w}}">
            <tr>
                @php
                    if($p->photo_status==1)
                    {
                        $border_color="black";
                    }
                    else
                    {
                        $border_color="black";
                    }
                    $path= picurl($casedata->hn."/".$p->photo_name);
                @endphp

                <td style="border: 0px solid {{$border_color}} ;" align="center">
                    <img src="{{$path}}" height="{{$h}}px">
                </td>
            </tr>

            <tr>
                <td style="border: 1px solid {{$border_color}} ;height:20px">
                    <font>[ {{$i}} ]</font>

                    @if($p->mainpartsub_name!="")
                        <font color="{{$border_color}}">{{$p->mainpartsub_name}}</font>
                        <br><font>{{$p->photo_text}}</font>
                        @else
                        <font>{{$p->photo_text}}</font>
                    @endif


                    @if($p->photo_gastrolesion!="")
                        <br><font>{{$p->photo_gastrolesion}}</font>
                    @endif
                </td>
            </tr>
        </table>

        @endif
        @endforeach

        </td>
        </tr>
        </table>

@endsection
