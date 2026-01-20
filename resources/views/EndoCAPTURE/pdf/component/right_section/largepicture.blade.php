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

<table style="padding-left: 3em;">
    <tr>
        <td></td>
        <td>
            @php
        // dd($showprocedure);

                $image_position = [];
                if($showprocedure){
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

                // dd($image_position);

            @endphp
            {!! tablePICPDF(2, $image_position, "width='220px' height='220px'") !!}

        </td>
    </tr>
</table>
