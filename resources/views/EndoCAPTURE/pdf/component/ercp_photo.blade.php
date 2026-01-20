<div class="content_right">
    @php
        $i = 0; //จำนวนรูป
        $bb = 1; //กำหนดการเริ่มต้น
        $w = 100; //ความกว้างรูป
        $count_ = 0;
        if (isset($mainpart->mainpartsub_name)) {
            $count_ = count($mainpart->mainpartsub_name);
        }
        $num1 = 5;
    @endphp
    <table border="0">
        <tr>
            <td>
                @php
                    $image_position = [];
                    if ($showprocedure) {
                        $image_position[999]['name'] = mePHOTO($casedata->hn, $pic_draw, $folderdate);
                        $image_position[999]['tx'] = 'mainpart';
                        $image_position[999]['sc'] = 'mainpart';
                    }

                    $x = 1;
                    foreach ($photoselect as $p) {
                        if ($x < $num1) {
                            $image_position[$x]['name'] = mePHOTO($casedata->hn, $p['na'], $folderdate);
                            $image_position[$x]['tx'] = $p['tx'];
                            $image_position[$x]['sc'] = $p['sc'];
                        }
                        $x++;
                    }
                @endphp
                {!! tablePICPDF(1, $image_position, "width='170px' height='160px'") !!}

            </td>
        </tr>
    </table>
</div>
