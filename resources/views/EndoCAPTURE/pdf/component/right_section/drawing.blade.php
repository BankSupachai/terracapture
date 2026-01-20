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
<table>
    <tr>
        <td>

            <img src='{{mePHOTO($casedata->hn, $pic_draw,$folderdate)}}' width='340px' height="300px" style=""><br>

            @php
                $image_position = [];
                $x = 0;
                foreach ($photoselect as $p) {
                    if ($x < $num1) {
                        $image_position[$x]['name'] = mePHOTO($casedata->hn, $p['na'],$folderdate);
                        $image_position[$x]['tx'] = $p['tx'];
                        $image_position[$x]['sc'] = $p['sc'];
                    }
                    $x++;
                }
            @endphp

            {!! tablePICPDF(2, $image_position, "width='163px' height='163px'") !!}

        </td>
    </tr>
</table>
