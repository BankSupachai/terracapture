
<br><br>

<table width="470px"  border="0" cellspacing="0" cellpadding="0">
    @include('endocapture.pdf.component.left_section.0001_BRIEF_HISTORY')
    @include('endocapture.pdf.component.left_section.0003_ANESTHESIA')
    @include('endocapture.pdf.component.left_section.0004_MEDICATION')
    @include('endocapture.pdf.component.left_section.0005_PRE-DIAGNOSTIC')
    @include('endocapture.pdf.component.left_section.0010_FINDINGS')
</table>
<table width="100%">
    {{-- @dd($casedata); --}}
    <tr>
        <td style="vertical-align:top !important;"><table width="100%">@include('endocapture.pdf.component.left_section.0011_POST-DIAGNOSTIC')</table></td>
        <td style="vertical-align:top !important;"><table width="100%">@include('endocapture.pdf.component.left_section.0012_PROCEDURE_ICD9')</table></td>
    </tr>
    <tr>
        <td><table width="100%">@include('endocapture.pdf.component.left_section.0015_GASTRICCONTENT')</table></td>
        <td><table width="100%">@include('endocapture.pdf.component.left_section.0018_RAPID_UREASE_TEST')</table></td>
    </tr>
    <tr>
        <td><table width="100%">@include('endocapture.pdf.component.left_section.0016_HISTOPATHOLOGY')</table></td>
        <td><table width="100%">@include('endocapture.pdf.component.left_section.0014_COMPLICATION')</table></td>
    </tr>
    <tr>
        {{-- <td><table width="100%">@include('endocapture.pdf.component.left_section.0020_RECOMMENDATION')</table></td>
        <td><table width="100%">@include('endocapture.pdf.component.left_section.0021_COMMENTS')</table></td> --}}
    </tr>
</table>
