@php
    $view33['casedata']         = $casedata;
    $view33['hospital']         = $hospital;
    $view33['pname']            = $casedata->procedure_name;
    $view33['border']           = 1;
    $view33['operationcysto']   = $operationcysto;
    $view33['pic_draw']         = $pic_draw;
    $view33['photoselect']      = $photoselect;
    $view33['json']             = $json;
    $view33['pdfshow']          = $pdfshow;
    $view33['pdfshownew']       = $pdfshownew;
    $view33['doctor']           = $doctor;
    $view33['doctor01']         = $doctor01;
    $view33['nurse']            = $nurse;
    $view33['totaltime']        = $totaltime;
    $view33['scopeall']         = $scopeall;
    $view33['showprocedure']    = $showprocedure;
    $view33['num']              = $num;
    $view33['num1']             = $num1;
    $view33['body_line']        =   $body_line;
    $view33['folderdate']       = $folderdate;
    $view33['picperrow']        = 4;
@endphp
<html>
    <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    @component('endocapture.pdf.component.css.css',['right_page'=>$right_page,'leftpagewidth'=>$leftpagewidth])@endcomponent
    {{-- @component('endocapture.pdf.component.css.pdf_css_master')@endcomponent --}}

    </head>
<body>


    <header>
        @php
            $head = configTYPE('pdf','pdf_folder_head');
        @endphp
        @component("pdfhead.$head.pdf_head01",$view33)@endcomponent
    </header>

    <footer>
        @component("pdfhead.$head.pdf_footer",$view33)@endcomponent
        <table>
           <tr>
               <td>Page</td>
               <td class="page"></td>
           </tr>
       </table>
   </footer>



    <main>
        @if(@$_GET['type'] != 'allshow')

            <div class="content_right" style="left: {{$right_page}};padding-left:1em;">
                @component('endocapture.pdf.component.right_section.procedure_new',$view33)@endcomponent
            </div>

            <div id="left_menu" style="padding-left: 4em;height: 700px;">
                {{-- @component('endocapture.pdf.component.pdf_picturebottom.'.$casedata->procedure_name,$view33)@endcomponent --}}
                @if($img_first==0)
                    <div class="page-break"></div>
                @endif
                @component('endocapture.pdf.pdf_photonew',$view33)@endcomponent
            </div>


        @else
            @foreach ($json as $x => $val)
                Key : {{$x}} <br> Value : {{$val}}<br><hr>
            @endforeach
        @endif



    </main>

</body>
</html>
