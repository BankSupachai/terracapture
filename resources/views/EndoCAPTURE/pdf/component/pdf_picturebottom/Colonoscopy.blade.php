<br>

<table width="361px" border="0">
    @include('endocapture.pdf.component.left_section.0001_BRIEF_HISTORY')
    @include('endocapture.pdf.component.left_section.0003_ANESTHESIA')
    @include('endocapture.pdf.component.left_section.0004_MEDICATION')
    @include('endocapture.pdf.component.left_section.0005_PRE-DIAGNOSTIC')
    @include('endocapture.pdf.component.left_section.0010_FINDINGS')
</table>
<table width="100%" border="0">

    <tr>
        <td style="vertical-align:top !important;">
            <table width="100%">
                @include('endocapture.pdf.component.left_section.0011_POST-DIAGNOSTIC')
                @include('endocapture.pdf.component.left_section.0019_BOWEL_PREPARATION')
            </table>
        </td>
        <td style="vertical-align:top !important;">
            <table width="100%">
                @include('endocapture.pdf.component.left_section.0012_PROCEDURE_ICD9')
                @include('endocapture.pdf.component.left_section.0016_HISTOPATHOLOGY')
            </table>
        </td>

    </tr>

        @include('endocapture.pdf.component.left_section.0014_COMPLICATION')


        @include('endocapture.pdf.component.left_section.0020_RECOMMENDATION')


    {{-- <tr>
        <td><table width="100%">@include('endocapture.pdf.component.left_section.0021_COMMENTS')</table></td>

    </tr> --}}
</table>
