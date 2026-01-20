
<table width="470px">
    <tr><td>@include('endocapture.pdf.component.left_section.0001_BRIEF_HISTORY')      </td></tr>
    <tr><td>@include('endocapture.pdf.component.left_section.0003_ANESTHESIA')</td></tr>
    <tr><td>@include('endocapture.pdf.component.left_section.0004_MEDICATION')</td></tr>
    <tr><td>@include('endocapture.pdf.component.left_section.0005_PRE-DIAGNOSTIC')</td></tr>
    <tr><td>@include('endocapture.pdf.component.left_section.0010_FINDINGS')</td></tr>
</table>

<table width="100%">
    <tr>
        <td style="vertical-align:top !important;"><table>@include('endocapture.pdf.component.left_section.0011_POST-DIAGNOSTIC')</table></td>
        <td style="vertical-align:top !important;"><table>@include('endocapture.pdf.component.left_section.0012_PROCEDURE_ICD9')</table></td>
    </tr>
    <tr>
        <td><table>@include('endocapture.pdf.component.left_section.0016_HISTOPATHOLOGY')</table></td>
        <td><table>@include('endocapture.pdf.component.left_section.0014_COMPLICATION')</table></td>
    </tr>
    <tr>
        <td><table>@include('endocapture.pdf.component.left_section.0020_RECOMMENDATION')</table></td>
        <td><table>@include('endocapture.pdf.component.left_section.0021_COMMENTS')</table></td>
    </tr>
</table>
