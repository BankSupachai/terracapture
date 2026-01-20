    <div class="cardcode col-12" style="padding: 0;display:none">
        View : <a style="color:red;" href="{{url("autoit?run=visualcode_open\\endo.exe&path=pdf_detail_left")}}">pdf_detail_left</a>
        <br><br>
    </div>
    @php
    $textcount = 0;
    $tr = 1;
    $multipage = false;
    $view['casedata']       = $casedata;
    $view['hospital']       = $hospital;
    $view['pname']          = $casedata->procedure_name;
    $view['photoselect']    = $photoselect;
    $view['json']           = $json;
    $view['border']         = $border;
    $view['operation_cysto']= $operationcysto;
    $view['left_width']     = 120;
    $app_name   = app_name();
    $head_line = configTYPE("pdf","head_line");
    $body_line = configTYPE("pdf","body_line");
    @endphp
    @if($head_line!='' && $body_line!='')
        <style>
            .menu-left td{
                padding-top: {{$head_line."px"}};
            }
            .menu-left tr td .casetext,.menu-left td .casetitle{
                margin: 0;
                line-height: {{$body_line."px"}};

            }
        </style>
    @endif
    @if($casedata->procedure_name=='Percutaneous Dilatational Tracheostomy')
        <br>
    @endif
    <style>
        tr{
            vertical-align: top;
        }
    </style>


            @if($pdfshownew[0] != '')
                @foreach($pdfshownew as $show)
                    @if(is_file(getconfig('admin')->htdocs_path."$app_name\\resources\\views\\endocapture\pdf\\component\\left_section\\$show.blade.php"))
                        @component('endocapture.pdf.component.left_section.'.$show,$view)@endcomponent
                    @endif
                @endforeach
            @else
                @component('endocapture.pdf.component.left_section.0000_not',$view)@endcomponent
            @endif



