@include('endocapture.pdf.component.css.css')
<body>
    <header>
        @php
            $department = uget('department');
            $head = configTYPE('pdf', 'pdf_folder_head');
            $head .= "/$department";
        @endphp


        @include("pdfhead.$head.pdf_head01")


        <title>EndoINDEX</title>
    </header>
    <main style=" margin-top: -15px;">
        @include("pdfhead.$head.pdf_head02")
        @include("pdfhead.$head.pdf_head03")
        @if (@$_GET['type'] != 'allshow')
            @if ($pdftype != 'onlypicture')
                <div id="content_right">

                    @include("endocapture.pdf.component.right_section.$pdftype")
                </div>
                <div id="content_left ">
                    @include('endocapture.pdf.component.pdf_detail_left')
                </div>
            @endif
        @else
            @foreach ($json as $x => $val)
                Key : {{ $x }} <br> Value : {{ $val }}<br>
                <hr>
            @endforeach
        @endif
    </main>
    <footer>
        @include("pdfhead.$head.pdf_footer")
        <table class="casetext"  style="position: absolute; bottom: -10px" >
            <tr class="fw-bold">
                <td>Page</td>
                <td class="page"></td>
                <td>&nbsp;/ {{ $pageall }}</td>
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
