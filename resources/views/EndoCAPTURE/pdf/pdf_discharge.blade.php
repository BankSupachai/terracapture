@extends('pdf.pdf')

@section('namereport','Discharge Report')

@section('td')
<td valign="top" height="800px" width="370">
@endsection

@section('detail_left')

<font color="#4472c4"><b>PROCEDURE :</b></font>
<br><font>{{@$casedata->procedure_name}}</font>


<?php
$sub=explode('     ',@$casedata->procedure_sub);
if(empty($sub[count($sub)-1])) {unset($sub[count($sub)-1]);}
?>

@foreach ($sub as $s)
  <br><font>- {{$s}}</font>
@endforeach


<br><font color="#4472c4"><b>FOLLOWING GUIDE :</b></font>
@if(@$casedata->following_guide!="")
<font >{{@$casedata->following_guide}}</font>
@else
None
@endif



<br>
<br><font color="#4472c4"><b>DISCHARGE TO :</b></font>
@if($casedata->discharge_name!="")
<font >{{$casedata->discharge_name}}</font>
@else
None
@endif


<br>

<br><font color="#4472c4" ><b>APPOINTMENT INFORMATION :</b></font>
@if(@$casedata->appointment_info!="")
<font >{{@$casedata->appointment_info}}</font>
@else
None
@endif



<br><br>


@endsection



@section('detail_right')



    @php
        $im = imagecreatefromjpeg ('imgprocedure/'.$_GET['id'].'.jpg');
        imagejpeg($im, 'pdf_pic/'.$_GET['id'].'.jpg');

        $w[0] = array('photo_case',$_GET['id']);
        $w[1] = array('photo_status','!=',0);
        $sql = DB::table('photo')->where($w)->get();
        $num=0;
        foreach($sql as $row) {
            $num++;
            $bg_path  = 'pdf_pic/'.$_GET['id'].'.jpg';
            $num_path = 'images/blue/blue_'.$num.'.png';
            $image_1 = imagecreatefromjpeg ($bg_path);
            $image_2 = imagecreatefrompng($num_path);
            $data = getimagesize($bg_path);
            $xx = $data[0]*(($row->photo_x-3)/100);
            $yy = $data[1]*(($row->photo_y-3)/100);
            imagecopy($image_1, $image_2, $xx, $yy, 0, 0, 30, 30);
            imagejpeg($image_1, 'pdf_pic/'.$_GET['id'].'.jpg');
        }
    @endphp

                            <?php $i=0; ?>
                            <?php $bb=0; ?>
                            <?php $w=170; ?>

                            @forelse ($photoselectonly as $p)
                              @if($i==0)

                              <table>
                                <tr><td valign="top">

                              <table border="0">
                                  <tr>
                                      <td>
                                          <img src="pdf_pic/{{$_GET['id']}}.jpg" width="{{$w}}" height="{{$w}}px">
                                      </td>
                                  </tr>
                              </table>

                            </td>
                            <td width="10"></td>
                            <td valign="top">

                              @endif

                              <?php $i++; ?>
                              @if($i<=7)

                                <table width="{{$w}}">
                                <tr>

                                  <?php
                                  if($p->photo_status==1){
                                    $border_color="black";
                                  }else{
                                    $border_color="black";
                                  }


                                  $path= picurl($casedata->hn."/".$p->photo_name);
                                  list($width, $height) = getimagesize($path);
                                  $fixwidth = 200;
                                  $newheight = ($fixwidth/$width)*$height;

                                  ?>

                                  <td style="border: 1px solid {{$border_color}} ;">
                                    <img src="{{$path}}" width="{{$w}}px">
                                  </td>
                                </tr>

                                <tr>

                                  <td style="border: 1px solid {{$border_color}} ;height:20px">
                                    <font>[ {{$i}} ]</font> &nbsp; <font color="{{$border_color}}">{{$p->mainpartsub_name}}</font>

                                    @if($p->photo_additional!="")
                                    <br><font>{{$p->photo_additional}}</font>
                                    @endif
                                    <br><font>{{$p->photo_gastrolesion}}</font>



                                  </td>
                                </tr>
                              </table>


                              @if($bb==1)
                                </td>
                                <td width="10"></td>
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

                            @empty
                            @endforelse

                                </td>
                                </tr>
                                </table>
@endsection
