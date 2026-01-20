{{-- Font Kanit Pdf --}}






<style>
    @page {
        margin-top: {{configTYPE("pdf","pdf_page_margin_top")}};
        margin-left: 0px;
        margin-right: 0px;
        margin-bottom: 50px;
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
        font-weight: bold;
        font-style: normal;
    }

    header {
        position: fixed;
        margin-top: {{configTYPE("pdf","pdf_header_margin_top")}};
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
        padding-top: {{configTYPE("pdf","pdf_content_left_top")}};
        padding-left: 1.8em;
        {{ $leftpagewidth }};
    }
    footer .page::before {
        content: counter(page, decimal);
    }

    /* #left_menu table:nth-child(2) tr{
        line-height: 5px;
    }
    #left_menu table:nth-child(2) tr td table tr{
        line-height: 5px;
    } */
    #left_menu table tr td,#left_menu table tr td table tr td {
        border: 1px solid #fff;
        vertical-align: top !important;
    }
    footer  {   position        : fixed;
                margin-bottom   : 10px;
                bottom          : 0;
                left            : 2em;
                right           : 2em;
                height          : 20px;
                line-height     : 15px;}

    .card-hide{padding: 0;display:none;}


    /* .lh-6{line-height: 13px;} */
    .vt-lh06{vertical-align:top;line-height: 0.6;}
    .lh6px{line-height: 10px;}
    .border-1px{border:1px;}
    .lh-7px{line-height:7px;}
    .vat{vertical-align:top;}
    .lh-08{line-height: 0.8em;}
    .lh-8px{line-height: 8px;}

    .headtitle  {   font-family : "Kanit";}

    .headtext   {   font-family : "Kanit";}

    .casetitle  {   font-family : "Kanit_semibold";
                    color:#245788;
                    font-weight: bold;
                }
    .overallfinding  {
        font-family : "DBHeaventt";
        /* line-height : 10px; */
        font-size   : 20px;
        color       : #505050;
    }
    .casetext-fiding {line-height: 10px;
                    color: #495057;}
    .casetext   {   font-family : "Kanit";
                    font-weight : normal;
                    line-height : 15px};


    .findtitle  {   font-family : "Kanit_semibold";
                    color:green !important;
                    font-weight: bold;}




    .findtext   {   font-family : "Kanit";}


    .icd10textdark {
        font-family : "Kanit";
                    line-height : 12px;
                    font-weight : normal;
                    font-size   : 14px;
                    color       :#000000;}



    .icd10text  {   font-family : "Kanit";
                    line-height : 12px;
                    font-weight : normal;
                    font-size   : 14px;
                    color       :red;}


    .icd10textpluero  {   font-family : "Kanit";
                    line-height : 10px;
                    font-weight : normal;
                    font-size   : 18px;
                    white-space: nowrap;
                    color       :#000000;}


    .icd9text   {   font-family : "Kanit";
                    line-height : 12px;
                    font-weight : normal;
                    font-size   : 14px;
                    color       :red;}




    #left_menu table tr td{
        padding: 0px !important;
        /* line-height: -10 !important; */

    }
    #findding tr td{
        padding: 0 !important;
        line-height: 7px !important;
    }
    #findding tr td:first-child{
        white-space: nowrap;
        width: 25%;
    }
    .page-break {
        page-break-after: always;
    }



</style>
