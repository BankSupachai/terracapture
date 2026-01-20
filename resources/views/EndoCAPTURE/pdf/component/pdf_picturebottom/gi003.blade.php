{{-- <table width="470px"  border="0" cellspacing="0" cellpadding="0">
    @include('endocapture.pdf.component.left_section.0001_BRIEF_HISTORY')
    @include('endocapture.pdf.component.left_section.0003_ANESTHESIA')
    @include('endocapture.pdf.component.left_section.0004_MEDICATION')
    @include('endocapture.pdf.component.left_section.0005_PRE-DIAGNOSTIC')
    @include('endocapture.pdf.component.left_section.0010_FINDINGS')
</table> --}}
<table width="100%" border="0">


        @include('endocapture.pdf.component.left_section.9001_time_patientin')
        @include('endocapture.pdf.component.left_section.9002_time_operation')
        @include('endocapture.pdf.component.left_section.0037_roomoperation')
        @include('endocapture.pdf.component.left_section.0036_scope')
        @include('endocapture.pdf.component.left_section.0001_BRIEF_HISTORY')
        @include('endocapture.pdf.component.left_section.0003_ANESTHESIA')
        @include('endocapture.pdf.component.left_section.0004_MEDICATION')
        @include('endocapture.pdf.component.left_section.0005_PRE-DIAGNOSTIC')
        @include('endocapture.pdf.component.left_section.0010_FINDINGS')
        @include('endocapture.pdf.component.left_section.0011_POST-DIAGNOSTIC')
          @include('endocapture.pdf.component.left_section.0012_PROCEDURE_ICD9')
          @include('endocapture.pdf.component.left_section.0016_HISTOPATHOLOGY')
          @include('endocapture.pdf.component.left_section.0032_ESTIMATED_BLOOD_LOSS')
          @include('endocapture.pdf.component.left_section.0017_TISSUESUBMITTED')
          @include('endocapture.pdf.component.left_section.0014_COMPLICATION')
          {{-- @include('endocapture.pdf.component.left_section.0020_RECOMMENDATION') --}}
          @include('endocapture.pdf.component.left_section.0020_COMMENTS')









</table>


@php
    $width = 340;
    $height = 260;
    $marginleft = 'margin-left:19px';

    if ($picperrow == 2) {
        $width = 340;
        $height = 260;
        $marginleft = 'margin-left:19px';
    }

    if ($picperrow == 3) {
        $width = 225;
        $height = 225;
        $marginleft = 'margin-left:19px';
    }

    if ($picperrow == 4) {
        $width = 173;
        $height = 173;
        $marginleft = 'margin-left:0px';
    }

    $i          = 0;
    $startpic   = 0;
    $tempn      = 0;
    $n          = 0;
    $all        = 0;
    $row        = array();

    // if(@$type == 'onlypicture'){
        if($showprocedure){
            // $num1 -= 1;
        }
    // }
    // dd($photoselect);

    foreach ($photoselect as $in=>$data) {
        $all++;
        if ($num1 < $all) {
            // dd($data);
            $tempn++;
            $row[$n][] = $data;
            if ($tempn == $picperrow) {
                $tempn = 0;
                $n++;
            }
        }else{
            $startpic++;
        }
    }

    if(isset($numdel1)){
        $startpic--;
    }

@endphp

@foreach ($row as $data)

<table border="0" style="background-color: white;text-align:center;{{ $marginleft }};z-index:99999;width:100%; "   >
    <tr>
        <td>
            <table border="0" class="set-num-image">
                <tr>
                    {{-- @dd($data); --}}
                    @foreach ($data as $data2)
                        <?php $startpic++; ?>
                        <td valign="top" style="">
                            <table style="">
                                <tr>
                                    <td>
                                        <img src="{{ mePHOTO($casedata->case_hn, $data2['na'], $folderdate) }}"
                                            width="{{ $width }}" height="{{ $height }}">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="line-height:10px; max-width: 30px; word-wrap:break-word">
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
</table>
@endforeach
