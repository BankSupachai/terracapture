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



@include('endocapture.pdf.component.css.css')
{{-- <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@100..900&display=swap" rel="stylesheet"> --}}
<style>
    /* *{
        font-family: "Noto Sans Thai", sans-serif !important;

    } */

</style>
<body>

    <header>
        @php

            // $department = uget('department');
            $head = configTYPE('pdf', 'pdf_folder_head');
            $head.= "/$department";
        @endphp
        @include("pdfhead.$head.pdf_head01")

        <title>EndoINDEX</title>
    </header>
    <main  style="margin-top: -30px;">
        @include("pdfhead.$head.pdf_head02")
        @include("pdfhead.$head.pdf_head03")
        @foreach ($row as $data)

        <table border="0" style="background-color: white;text-align:center;{{ $marginleft }};z-index:99999;width:100%; "   >
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
                                                <span style="font-size: 14px;">[{{ $startpic }}]</span>
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
    </main>
    <footer>
        @include("pdfhead.$head.pdf_footer")
        <table class="casetext" style="position: absolute; bottom: -10px">
            <tr class="fw-bold">
                <td>Page</td>
                <td class="page"></td>
                <td>&nbsp;/ {{ $pageall-1 }}</td>
            </tr>
        </table>
    </footer>
    <script src="{{ asset('public/js/jquery.min.js') }}"></script>
    <script type="text/javascript">
        {!! viewmode() !!}
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
