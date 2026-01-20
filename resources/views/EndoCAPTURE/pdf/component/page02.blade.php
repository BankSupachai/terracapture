@for ($countpage = 0; $countpage < $num; $countpage++)
    @php
        $photostart = $countpage * 9 + $num2;
        $photoend = $photostart + $num3;
        $lastpage = $num - 1;
        if ($countpage == $lastpage) {
            $paperend = 'true';
        } else {
            $paperend = 'false';
        }
    @endphp

    <br>

    <table width="750" >

        <tr>
            <td>

                <table align="center" width="95%">
                    <tr>

                        <td height="750" valign="top">
                            <table width="100%">

                                <?php $i = 0; ?>
                                <?php $startpic = 0; ?>
                                @forelse ($photoselect as $p)
                                    <?php
                                    if ($p->photo_status == 1) {
                                        $border_color = 'red';
                                    } else {
                                        $border_color = 'black';
                                    }

                                    $path = picurl("$casedata->hn/$folderdate/$p->photo_name");

                                    $haveimgfile = file_exists($path);
                                    if ($haveimgfile) {
                                        [$width, $height] = getimagesize($path);
                                        $fixwidth = 220;
                                        $newheight = ($fixwidth / $width) * $height;
                                    } else {
                                        $fixwidth = 220;
                                        $newheight = 150;
                                    }
                                    ?>

                                    <?php $startpic++; ?>

                                    @if ($startpic >= $photostart && $startpic <= $photoend)
                                        <?php $i++; ?>
                                        <?php if ($i == 1) {
                                            echo '<tr>';
                                        } ?>
                                        <td valign="top">

                                            <table>
                                                <tr>
                                                    <td style="border: 1px solid {{ $border_color }} ;">

                                                        <img src="{{ $path }}" width="230" height="200">

                                                    </td>
                                                    <td rowspan="2" width="<?php if ($i != 3) {
                                                        echo '20px';
                                                    } else {
                                                        echo '0px';
                                                    } ?>">

                                                    </td>
                                                </tr>
                                                <tr>

                                                    <td style="border: 1px solid {{ $border_color }};height:20px">

                                                        [ {{ $p->photo_num_select }} ] &nbsp;
                                                        @if ($p->mainpartsub_name != '')
                                                            <font color="{{ $border_color }}">{{ $p->mainpartsub_name }}
                                                            </font>
                                                            <br>
                                                            <font>{{ $p->photo_text }}</font>
                                                        @else
                                                            <font>{{ $p->photo_text }}</font>
                                                        @endif


                                                        @if ($p->photo_gastrolesion != '')
                                                            <br>
                                                            <font>{{ $p->photo_gastrolesion }}</font>
                                                        @endif
                                                    </td>
                                                </tr>
                                            </table>

                                            <br><br>
                                        </td>
                                        <?php if ($i == 3) {
                                            echo '</tr>';
                                            $i = 0;
                                        } ?>
                                    @endif

                                @empty
                                @endforelse
                            </table>

                        </td>
                    </tr>
                </table>


                <br>

                @if ($paperend != 'ไม่อยากเอาifออกเก็บไว้อย่างงี้แหล่ะ')
                    <br>
                    <table border="0" width="100%">
                        <tr>
                            <td align="left" style="padding: 50px;">


                                @php
                                    $datapic = DB::table('tb_case')
                                        ->join('patient', 'patient.id', 'tb_case.case_patientid')
                                        ->where('case_id', $casedata->case_id)
                                        ->first();

                                    ($file_start = fopen('images/ori-esign.txt', 'r')) or die('Unable to open file!');
                                    $str_start = fread($file_start, filesize('images/ori-esign.txt'));
                                    fclose($file_start);

                                    $check_file = file_exists(
                                        'store/' . $datapic->hn . '/' . $casedata->case_id . '.txt',
                                    );

                                    if ($check_file == 1) {
                                        ($file_end = fopen(
                                            'store/' . $datapic->hn . '/' . $casedata->case_id . '.txt',
                                            'r',
                                        )) or die('Unable to open file!');
                                        $str_end = fread(
                                            $file_end,
                                            filesize('store/' . $datapic->hn . '/' . $casedata->case_id . '.txt'),
                                        );
                                        fclose($file_end);
                                    } else {
                                        ($file_end = fopen('images/ori-esign.txt', 'r')) or die('Unable to open file!');
                                        $str_end = fread($file_end, filesize('images/ori-esign.txt'));
                                        fclose($file_end);
                                    }
                                @endphp

                                @if ($str_start == $str_end)
                                    &nbsp; &nbsp; &nbsp;Signature___________________________, {{ @$doctor01[0]->name }}
                                @else
                                    &nbsp; &nbsp; &nbsp;Signature @for ($nu = 0; $nu <= 5; $nu++)
                                        &nbsp;
                                    @endfor <img src='{{ $str_end }}' width="140"
                                        style="position: absolute;border-bottom: 1px solid black;"><br>
                                    @for ($nu = 0; $nu <= 19; $nu++)
                                        &nbsp;
                                    @endfor
                                    {{ @$doctor01[0]->name }}
                                @endif
                            </td>
                            <td align="right" valign="middle">
                                <br>
                                Reported by EndoCapture &nbsp;&nbsp;&nbsp;
                            </td>
                        </tr>
                    </table>
                @endif

            </td>
        </tr>
    </table>
@endfor
