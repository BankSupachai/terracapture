<html>
<style>
    /* .head02{
        margin-top: -35px !important;
        padding-left: 0px !important;
    } */
</style>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    @include('endocapture.pdf.component.css.css')
    {{-- @component('endocapture.pdf.component.css.pdf_css_master')@endcomponent --}}

    </head>
<body>

    <header>
        @php
              $department = uget('department');
            $head = configTYPE('pdf', 'pdf_folder_head');
            $head .= "/$department";
        @endphp

        @include("pdfhead.$head.pdf_head01")
        @include("pdfhead.$head.pdf_head02")


    </header>

    <footer class="casetext">
        @include("pdfhead.$head.pdf_footer")
        <table style="margin-top: -10px;">
           <tr>
               <td>Page</td>
               <td class="page"></td>
           </tr>
       </table>
   </footer>



    <main>
        @if(@$_GET['type'] != 'allshow')
            <div id="left_menu" style="padding-left: 2em;">
                @include('endocapture.pdf.component.pdf_picturebottom.'.$casedata->case_procedurecode)
                {{-- @if($img_first==0)
                    <div class="page-break"></div>
                @endif --}}
            </div>


        @else
            @foreach ($json as $x => $val)
                Key : {{$x}} <br> Value : {{$val}}<br><hr>
            @endforeach
        @endif




    </main>

</body>
</html>
