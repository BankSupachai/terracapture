@extends('pdf.pdf_procedure_base')
@section('td')
<td valign="top" height="800px" width="550">
@endsection
@section('namereport','Procedure Report')


@section('detail_right')

    @php
        $im = imagecreatefromjpeg('imgprocedure/'.$_GET['id'].'.jpg');
        imagejpeg($im, 'pdf_pic/'.$_GET['id'].'.jpg');

        $w[0]   = array('photo_case',$_GET['id']);
        $w[1]   = array('photo_status', '!=','0');
        $sql    = DB::table('photo')->where($w)->get();

        foreach ($sql as $row) {
            $bg_path	= 'pdf_pic/'.$_GET['id'].'.jpg';
            $num_path	= 'images/blue/blue_'.$row->photo_num_select.'.png';
            $image_1    = imagecreatefromjpeg ($bg_path);
            $image_2    = imagecreatefrompng($num_path);
            $data       = getimagesize($bg_path);
            $xx         = $data[0]*(($row->photo_x-3)/100);
            $yy         = $data[1]*(($row->photo_y-3)/100);
            imagecopy($image_1, $image_2, $xx, $yy, 0, 0, 30, 30);
            imagejpeg($image_1, 'pdf_pic/'.$_GET['id'].'.jpg');
        }
    @endphp

    @php
        $i  = 0;    //จำนวนรูป
        $bb = 1;    //กำหนดการเริ่มต้น
        $w  = 170;  //ความกว้างรูป
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

                <td style="border: 1px solid {{$border_color}} ;">
                    <img src="{{$path}}" width="{{$w}}px" height="{{$w}}px">
                </td>
            </tr>

            <tr>
                <td style="border: 1px solid {{$border_color}} ;height:20px">
                    <font>[ {{$i}} ]</font> <font color="{{$border_color}}">{{$p->mainpartsub_name}}</font>
                    @if($p->photo_additional!="")
                        <br><font>{{$p->photo_additional}}</font>
                    @endif

                    @if($p->photo_gastrolesion!="")
                        <br><font>{{$p->photo_gastrolesion}}</font>
                    @endif

                    @if($p->photo_text!="")
                        <br><font>{{$p->photo_text}}</font>
                    @endif
                </td>
            </tr>
        </table>


        @if($bb==100)
        </td>
        <td width="0"></td>
        <td valign="top">
        <?php $bb=0; ?>
        @else
        </td>
        </tr>
        </table>

        <table>
        <tr>
        <td valign="top">
        <?php $bb++; ?>
        @endif
        @endif
        @endforeach

        </td>
        </tr>
        </table>

@endsection


