@php
    $width = 300;
    $height = 300;
    $marginleft = 'margin-left:19px';

    if ($picperrow == 2) {
        $width = 300;
        $height = 300;
        $marginleft = 'margin-left:19px';
    }

    if ($picperrow == 3) {
        $width = 225;
        $height = 225;
        $marginleft = 'margin-left:19px';
    }

    if ($picperrow == 4) {
        $width = 170;
        $height = 170;
        $marginleft = 'margin-left:0px';
    }

    $i          = 0;
    $startpic   = 0;
    $tempn      = 0;
    $n          = 0;
    $all        = 0;
    $row        = array();

    $type = $type ?? ($pdftype ?? null);

    if(@$type == 'onlypicture' || @$type == 'ent_standard'){
        if($showprocedure){
            $num1 -= 1;
        }
    }


    foreach ($photoselect as $in=>$data) {
        $all++;

        if (@$type == 'long_writing') {
            if ($all >= $num1) {
                $tempn++;
                $row[$n][] = $data;
                if ($tempn == $picperrow) {
                    $tempn = 0;
                    $n++;
                }
            } else {
                $startpic++;
            }
        } else {
            if ($num1 < $all) {
                $tempn++;
                $row[$n][] = $data;
                if ($tempn == $picperrow) {
                    $tempn = 0;
                    $n++;
                }
            } else {
                $startpic++;
            }
        }
    }

    if(isset($numdel1)){
        $startpic--;
    }

@endphp
<br> <br> <br> <br> <br> <br>  <br>
@foreach ($row as $data)

<table border="0" style="background-color: white;text-align:center;{{ $marginleft }};z-index:99999;width:100%;
font-size: 10px;"
@if(@$picperrow == 2) style="padding-left: 4em;" @endif>
    <tr>
        <td>
            <table border="0" class="set-num-image">
                <tr>
                    {{-- @dd($data); --}}
                    @foreach ($data as $data2)
                        <?php $startpic++; ?>
                        <td valign="top" style="padding-left: 13px;">
                            <table style="">
                                <tr>
                                    <td>
                                        <img src="{{ mePHOTO($casedata->case_hn, $data2['na'], $folderdate) }}"
                                            width="{{ $width }}" height="{{ $height }}">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="line-height:10px; max-width: 30px; word-wrap:break-word">
                                        <strong>[{{ $startpic }}]
                                        @if ($data2['sc'] != '')
                                            <font color="">{{ @$data2['sc'] }}<br></font>
                                            <font>{{ $data2['tx'] }}</font>
                                        @else
                                            <font>{{ $data2['tx'] }}</font>
                                        @endif</strong>
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
@endforeach

