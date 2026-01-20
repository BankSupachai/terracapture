@php
$textcount = 0;
$tr = 1;
$multipage = false;
$view33['num1'] = $num1;
$view33['casedata'] = $casedata;
$view33['hospital'] = $hospital;
$view33['pname'] = $procedure->name;
$view33['photoselect'] = $photoselect;
// $view33['json'] = $json;
$view33['border'] = 1;
// $view33['operation_cysto'] = $operationcysto;
$view33['left_width'] = 120;
$view33['body_line'] = $body_line;
$view33['pic_draw']         = $pic_draw;
$view33['procedure'] = $procedure;
$view33['folderdate']       = $folderdate;
$view33['tb_casemedication'] = $tb_casemedication;
$view33['type'] = $pdftype ?? $_GET['type'] ?? @$type ?? null;
$is_rama = 0;
$head_line = configTYPE("pdf","head_line");
$body_line = configTYPE("pdf","body_line");
@endphp
@if($head_line!='' && $body_line!='')
<style>
 /* .menu-left td{
    padding-top: {{$head_line."px"}};
 } */
 /* .menu-left td{
    padding-top: 8px !important;
 } */
 /* .menu-left tr td .casetext,.menu-left td .casetitle ,.menu-left td .findtext ,..menu-left td .findtitle{
    margin: 0;
    line-height: {{$body_line."px"}};

 } */

 .menu-left tr td{
    margin: 0;
    line-height: {{$body_line."px"}};

 }


</style>
@endif
@if ($procedure->name == 'Percutaneous Dilatational Tracheostomy')
    <br>
@endif
<style>
    tr {
        vertical-align: top;
    }
</style>
{{-- @dd($show) --}}
<table style="padding-left: 1.7em;">
    <tr>
        <td>
            <table border="0" width="{{ $leftpagewidth }}" style=" padding-top: {{ configTYPE('pdf', 'pdf_content_left_top') }}" class="menu-left">

                @if (@$type.'0' != 'onlypicture')
                    @if ($procedure->pdf['show'][0] != '')

                    @foreach ($procedure->pdf['show'] as $show)
                        @php
                            $this_zone = intval(substr($show, 0, 4));
                            $app_name = app_name();
                        @endphp

                        @if (is_file(getCONFIG("admin")->htdocs_path . "$app_name\\resources\\views\\endocapture\pdf\\component\\left_section\\$show.blade.php"))
                            @component('endocapture.pdf.component.left_section.' . $show, $view33) @endcomponent
                        @endif
                    @endforeach
                    @else
                        @component('endocapture.pdf.component.left_section.0000_not', $view33) @endcomponent
                    @endif
                @endif

            </table>
        </td>
    </tr>
</table>
