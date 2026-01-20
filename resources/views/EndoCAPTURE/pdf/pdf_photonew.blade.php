@php
$i = 0; //จำนวนรูป
$bb = 1; //กำหนดการเริ่มต้น
$w = 100; //ความกว้างรูป
$count_ = 0;
if (isset($mainpart->mainpartsub_name)) {
    $count_ = count($mainpart->mainpartsub_name);
}

$img_height = configTYPE('pdf', 'pdf_image_height');
$img_width = configTYPE('pdf', 'pdf_image_width');
@endphp

@php
$image_position = [];
$x = 1;
foreach ($photoselect as $p) {
    if ($x <= $num1) {
        $image_position[$x]['name'] = mePHOTO($casedata->hn, $p['na'], $folderdate);
        $image_position[$x]['tx'] = $p['tx'];
        $image_position[$x]['sc'] = $p['sc'];
    }
    $x++;
}

if ($picperrow == '3x3') {
    $picperrow = 3;
}

if ($picperrow == '4x4') {
    $picperrow = 4;
}

@endphp
<table style="margin: 0 auto; width: 100%;">
    <tr>
        <td align="center">
            {!! tablePICPDF(2, $image_position, "width='290px' height='275px'") !!}
        </td>
    </tr>
</table>





