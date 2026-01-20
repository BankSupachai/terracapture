@extends('pdf.pdf_procedure_base')
@section('namereport','Pathology Report')
@section('td')
<td valign="top" height="800px" width="370">
@endsection
@section('detail_right')
    @php
    $i  = 0;    //จำนวนรูป
    $bb = 0;
    $w  = 170;  //ความกว้างรูป
    $h  = 140;
    @endphp
<table border="0">
<tr>
<td valign="top">
<table border="1">
<tr>
<td>
<img src="pdf_pic/{{$_GET['id']}}.jpg" width="{{$w}}">
</img>
</td>
</tr>
</table>
</td>
<td width="10">
</td>
<td valign="top">
@foreach ($photoselectonly as $p)
@php $i++; @endphp
@if($i<=8)
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
<img height="{{$h}}" src="{{$path}}" width="{{$w}}px" height="{{$w}}px">
</img>
</td>
</tr>
<tr>
<td style="border: 1px solid {{$border_color}} ;height:20px">
<font>
[ {{$i}} ]
</font>
<font color="{{$border_color}}">
{{$p->mainpartsub_name}}
</font>
@if($p->photo_additional!="")
<br><font>{{$p->photo_additional}}</font>
@endif

@if($p->photo_gastrolesion!="")
<br><font>{{$p->photo_gastrolesion}}</font>
@endif

@if($p->photo_text!="")
<br><font>{{$p->photo_text}}</font>
@endif
</br>
</td>
</tr>
</table>
@if($bb==1)
</td>
<td width="10">
</td>
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
</br>
</br>
</br>
</br>
</br>
</br>
</br>
</br>
</br>
</br>
</br>
</br>
