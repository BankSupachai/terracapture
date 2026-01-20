<style>

    main {
        height: 715px;
    }
    .table-header {
        margin-top : 10px;
    }
    @page {
        margin-top: {{ configTYPE('pdf', 'pdf_page_margin_top') }};
        margin-left: 0px;
        margin-right: 0px;
        margin-bottom: 50px;
    }

    @font-face {
        font-family: 'Noto Sans Thai';
        src: url("{{ url('public/fonts/notosan/static/NotoSansThai-Medium.ttf') }}") format('truetype');
        font-weight: normal;
        font-style: normal;
    }

    @font-face {
        font-family: 'Noto Sans Thai';
        src: url("{{ url('public/fonts/notosan/static/NotoSansThai-Bold.ttf') }}") format('truetype');
        font-weight: bold;
        font-style: bold;
    }

    @font-face {
        font-family: 'DBHeaventt';
        src: url("{{ public_path('fonts/DBHeaventt-Light.ttf') }}") format('truetype');
        font-weight: normal;
        font-style: normal;
    }


    @font-face {
        font-family: 'DBHeaventt';
        src: url("{{ public_path('fonts/DB Heavent Bd.ttf') }}") format('truetype');
        font-weight: bold;
        font-style: bold;
    }

    @font-face {
        font-family: 'DBHeaventt';
        src: url("{{ public_path('fonts/DBHeaventt-Light.ttf') }}") format('truetype');
        font-weight: normal;
        font-style: normal;
    }




    @font-face {
        font-family: 'THSarabunNew';
        src: url("{{ url('public/fonts/THsarabunnew/THSarabunNewr.ttf') }}") format('truetype');
        font-weight: normal;
        font-style: normal;
    }

    @font-face {
        font-family: 'THSarabunNew_Bold';
        src: url("{{ url('public/fonts/THsarabunnew/THSarabunNew Bold.ttf') }}") format('truetype');
        font-weight: normal;
        font-style: normal;
    }

    @font-face {
        font-family: 'Kanit';
        src: url("{{ url('public/fonts/Kanit-Regular.ttf') }}") format('truetype');
        font-weight: normal;
        font-style: normal;
    }

    @font-face {
        font-family: 'Kanit_semibold';
        src: url("{{ url('public/fonts/Kanit-SemiBold.ttf') }}") format('truetype');
        font-weight: normal;
        font-style: normal;
    }

    * {
        font-family: "Noto Sans Thai", sans-serif !important;
    }

    header {
        position: fixed;
        margin-top: {{ configTYPE('pdf', 'pdf_header_margin_top') }};
        top: 0px;
        left: 0px;
        right: 0px;
    }


    #content_right {
        top: {{configTYPE("pdf","pdf_content_right_top")}};
        position: fixed;
        right: 0px;
        padding: 0px;
        font-weight: bold;
        left: {{ $right_page }};
        padding-left:1em;
    }

    #content_left {
        padding-top: {{ configTYPE('pdf', 'pdf_content_left_top') }};
        padding-left: 1em;
        {{ $leftpagewidth }};
    }
    footer {
        padding-left: 1em;
        padding-right: 1em;
    }
    footer .page::before {
        content: counter(page, decimal);
    }
    footer  {   position        : fixed;
                margin-bottom   : -10px;
                bottom          : 0;
                left            : 2em;
                right           : 2em;
                height          : 20px;
                line-height     : 15px;
                margin-top: 10px;
            }
            .head02{
                padding-left: 1.7em;
            }
    .casetitle {
        font-family: "Noto Sans Thai";
        color: #245788;
        font-size: 12px;
        font-weight: bold;
    }

    .overallfinding {
        font-family: "Noto Sans Thai";
        font-size: 20px;
        color: #505050;
    }

    .casetext-fiding {
        line-height: 10px;
        color: #495057;
    }

    .casetext {
        font-family: "Noto Sans Thai";
        font-weight: normal;
        font-size: 12px;
        line-height: 12px !important;
        color: #252525;

    }

    .findtitle {
        font-family: "Noto Sans Thai";
        color: #008330;
        font-size: 12px;
        white-space: nowrap;
    }

    .findtext {
        font-family: "Noto Sans Thai";
        font-size:11px;


    }

    .icd10textdark {
        font-family: "Noto Sans Thai";
        line-height: 13px;
        font-weight: normal;
        font-size: 12px;
        color: #000000;
    }

    .icd10text {
        font-family: "Noto Sans Thai";
        line-height: 10px;
        font-weight: normal;
        font-size: 12px;
        color: red;

    }

    .icd10textpluero {
        font-family: "Noto Sans Thai";
        line-height: 10px;
        font-weight: bold;
        font-size: 13px;
        white-space: nowrap;
        color: #000000;
    }
    .menu-left {
        table-layout: fixed;
        width: {{ ((@$pdftype == 'long_writing') || (@$casedata->pdftype == 'long_writing')) ? '500px' : '350px' }} !important;
        margin-top:-20px;

    }

    .icd9text {
        font-family: "Noto Sans Thai";
        line-height: 10px;
        font-weight: bold;
        font-size: 12px;
        color: red;
    }


    /* #left_menu table tr td{
        padding: 0px !important;


    } */
    /* #findding tr td{
        padding: 0 !important;
        line-height: 7px !important;
    }
    #findding tr td:first-child{
        white-space: nowrap;
        width: 25%;
    } */
    .page-break {
        page-break-after: always;
    }
</style>
