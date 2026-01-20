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
    <main style="margin-top: -30px;  padding-right: 2em;">
        @include("pdfhead.$head.pdf_head02")
        @include("pdfhead.$head.pdf_head03")
        @if(@$_GET['type'] != 'allshow')

            <div id="content_right" style="left: {{$right_page}}; ">
                {{-- @include('endocapture.pdf.component.right_section.procedure_new') --}}
            </div>
            <div id="left_menu" style="height: 700px; padding-left: 2em;">
                    @include('endocapture.pdf.component.pdf_picturebottom.'.$casedata->procedurename)
                    @if($img_first==0)
                        <div class="page-break"></div>
                    @endif
                    {{-- <div class="page-break" style="margin-top: 16px;"> --}}
                        <div style="padding-left: 3em;">
                            @include('endocapture.pdf.pdf_photonew')

                        </div>
            {{-- </div> --}}
            </div>


        @else
            @foreach ($json as $x => $val)
                Key : {{$x}} <br> Value : {{$val}}<br><hr>
            @endforeach
        @endif
    </main>
    <footer>
        @include("pdfhead.$head.pdf_footer")
        <table class="casetext" style="position: absolute; bottom: -10px">
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
