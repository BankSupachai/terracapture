<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Nurse Report</title>
    <style>
    @font-face {
        font-family: 'THSarabunNew';
        font-style: normal;
        font-weight: normal;
        src: url("{{url("public/fonts/THSarabunNew.ttf")}}") format('truetype');
    }
    @font-face {
        font-family: 'THSarabunNew';
        font-style: normal;
        font-weight: bold;
        src: url("{{url("public/fonts/THSarabunNew Bold.ttf")}}") format('truetype');
    }
    @font-face {
        font-family: 'THSarabunNew';
        font-style: italic;
        font-weight: normal;
        src: url("{{url("public/fonts/THSarabunNew Italic.ttf")}}") format('truetype');
    }
        @font-face {
        font-family: 'THSarabunNew';
        font-style: italic;
        font-weight: bold;
        src: url("{{url("public/fonts/THSarabunNew BoldItalic.ttf")}}") format('truetype');
    }
        *{
            font-family: "THSarabunNew";
        }
        html{
            padding: 0;
            margin: 0;
        }
        body{
            margin-top: 320px;
        }
        #header { position: fixed; left: 25px; margin-top: -320px; right: 25px; height: 300px; background-color: white; text-align: center;}
        .w-100{width: 100%;}
        .mh-100{min-height: 75px;}
        .host-header tr td:nth-child(1){width: 15%;}
        .host-header tr td:nth-child(2){width: 50%;}
        .host-header tr td:nth-child(3){width: 25%;text-align: right !important;}
        .host-header tr td{line-height: 0.3em;white-space: nowrap;padding: 0px 4px;}
        .text-right{text-align: right;}
        .m-0{margin: 0;}
        .vtb{vertical-align: bottom !important;}
        .vtt{vertical-align: top !important;}
        .vtc{vertical-align: middle !important;}
        .border-bottom{border-bottom: 1px solid #707070;}
        .border-top{border-top: 1px solid #707070;}
        .border-gray{border-color: #C1C1C1;}
        .border{border: 1px solid #707070;}
        .tb-patient tr td{line-height: 0.7em !important;width: 50%;padding: 0px 4px;}
        .text-danger{color: #F53434;}
        .text-success{color: #0AB39C;}
        .tb-detail tr td:nth-child(5){width: 25%;}
        .tb-detail tr td{line-height: 0.7em;}
        .body{
            padding-right: 25px;
            padding-left: 25px;
        }
        .mt-05{
            margin-top: 0.6em;
        }
        .pb-05{
            padding-bottom: 0.6em;
        }
        .p-05{padding: 0.6em;}
        .p-0{padding: 0;}
        .m-05{margin: 0.6em;}
        .w-80{width: 80;}
        .m-auto{margin: auto;}
        .bg-danger{background: red;}
        .pr-1{padding-right: 1em;}
        .lh-1{line-height: 1em}
        .w-50{width: 50%;}
        .text-center{text-align: center;}
    </style>
</head>
<body>
    @include("EndoINDEX.pdfnurse.component.head")
    <div class="body">
        @include("endoindex.pdfnurse.component.follow_up01")
    </div>
</body>
</html>
