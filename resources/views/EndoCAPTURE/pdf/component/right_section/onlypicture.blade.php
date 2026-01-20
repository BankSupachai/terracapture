
<div class="cardcode col-12" style="padding: 0;display:none">
    View : <a style="color:red;"
        href="{{ url("autoit?run=visualcode_open\\endo.exe&path=pdf_detail_right") }}">pdf_detail_right</a>
    <br><br>
</div>
@php
$i = 0; //จำนวนรูป
$bb = 1; //กำหนดการเริ่มต้น
$w = 100; //ความกว้างรูป
$count_ = 0;
if (isset($mainpart->mainpartsub_name)) {
    $count_ = count($mainpart->mainpartsub_name);
}

@endphp
{{-- @dd($photoselect); --}}

@php
    $image_position = [];
    if($showprocedure){
        $image_position[999]['name'] = mePHOTO($casedata->hn, $pic_draw,$folderdate);
        $image_position[999]['tx'] = 'mainpart';
        $image_position[999]['sc'] = 'mainpart';
    }


    if(!$showprocedure){
        $num1 += 1;
    }

    $x = 1;
    foreach ($photoselect as $p) {
        if ($x < $num1) {
            $image_position[$x]['name'] = mePHOTO($casedata->hn, $p['na'],$folderdate);
            $image_position[$x]['tx'] = $p['tx'];
            $image_position[$x]['sc'] = $p['sc'];
        }
        $x++;
    }

    if(is_array($image_position)){
        $image_position = array_values($image_position);
    }

@endphp

<table style="background-color: white;text-align:center;z-index:99999;width:100%">
    <tr>
        <td>
            <img src="{{ @$image_position[0]['name'] }}" width="{{$width}}" height="{{$height}}" style="border: 4px solid white;">
            <img src="{{ @$image_position[1]['name'] }}" width="{{$width}}" style="border: 4px solid white;">
        </td>
        <td>
            <img src="{{ @$image_position[2]['name'] }}" width="{{$width}}" style="border: 4px solid white;">
        </td>
    </tr>
    <tr>
        <td>
            <img src="{{ @$image_position[3]['name'] }}" width="{{$width}}" style="border: 4px solid white;">
        </td>
        <td>

        </td>
    </tr>
</table>


{{-- <table border="0" style="background-color: white;text-align:center;{{ $marginleft }};z-index:99999;width:100%">
    <tr>
        <td>
            <table border="0" class="set-num-image">
                <tr>
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
</table> --}}
