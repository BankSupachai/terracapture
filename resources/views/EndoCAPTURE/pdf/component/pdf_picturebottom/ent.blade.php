<table width="100%" style="line-height: 8px;">
    <tr>
        <td style="vertical-align:top !important;"><table width="100%"> @include('endocapture.pdf.component.left_section.9002_time_operation')</table></td>
        <td style="vertical-align:top !important;"><table width="100%">@include('endocapture.pdf.component.left_section.0037_roomoperation')</table></td>
    </tr>
    <tr>
        <td><table width="100%">@include('endocapture.pdf.component.left_section.0003_ANESTHESIA')</table></td>
        <td><table width="100%">@include('endocapture.pdf.component.left_section.0004_MEDICATION')</table></td>
    </tr>
    <tr>
        <td><table width="100%">@include('endocapture.pdf.component.left_section.0001_BRIEF_HISTORY')</table></td>
        <td><table width="100%">@include('endocapture.pdf.component.left_section.0005_PRE-DIAGNOSTIC')</table></td>
    </tr>

</table>
<table width="470px"  border="0" cellspacing="0" cellpadding="0" style="padding-left: 0.5em;">
    @include('endocapture.pdf.component.left_section.0010_FINDINGS')
    @include('endocapture.pdf.component.left_section.0011_POST-DIAGNOSTIC')
    @include('endocapture.pdf.component.left_section.0012_PROCEDURE_ICD9')
    @include('endocapture.pdf.component.left_section.0020_COMMENTS')
</table>
