
@php
$i = 0; //จำนวนรูป
$bb = 1; //กำหนดการเริ่มต้น
$w = 100; //ความกว้างรูป
$count_ = 0;
if (isset($mainpart->mainpartsub_name)) {
    $count_ = count($mainpart->mainpartsub_name);
}
@endphp

<table style="margin-left: 2.5em;">
    <tr >
        <td >
            {{-- <table>
                <img src='{{mePHOTO($casedata->hn, $pic_draw)}}' width='170px' height="160px" style="border: 2px solid #555;margin-left:2px;">
            </table> --}}
            @php

                $image_position = [];
                if(@$showprocedure){
                    $image_position[999]['name'] = mePHOTO($casedata->hn, $pic_draw,$folderdate);
                    $image_position[999]['tx'] = 'mainpart';
                    $image_position[999]['sc'] = 'mainpart';
                }

                $x = 1;
                foreach ($photoselect as $p) {
                    if ($x <= $num1) {
                        $image_position[$x]['name'] = mePHOTO($casedata->hn, $p['na'],$folderdate);
                        $image_position[$x]['tx'] = $p['tx'];
                        $image_position[$x]['sc'] = $p['sc'];
                    }
                    $x++;
                }
            @endphp

            {!! tablePICPDF(2, $image_position, "width='280px' height='250px'") !!}

        </td>
    </tr>
</table>
