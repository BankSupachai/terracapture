@php
    use App\Models\Mongo;

    $head = configTYPE('pdf', 'pdf_folder_head');

    // dd($note["_id"]);
    // dd($caseall);

    $nurse_array        = array();
    $nurseanes_array    = array();
    $userincase         = array();
    $physician          = array();
    $procedurename      = array();
    foreach ($caseall as $data) {
        $data               = (object) $data;
        $physician[]        = $data->doctorname;
        $procedurename[]    = $data->procedurename;
        if(isset($data->user_in_case)){
            foreach ($data->user_in_case as $data_user) {
                $userincase[] = $data_user;
            }
        }
    }

    foreach ($userincase as $data){
        $num    = (int)$data;
        $user   = (object) Mongo::table("users")
                ->where("id",$num)
                ->first();

        if(isset($user->user_type)){
            if($user->user_type=="nurse"){
                $nurse_array[] = $user->user_prefix.$user->user_firstname." ".$user->user_lastname;
            }
            if($user->user_type=="nurse_anes"){
                $nurseanes_array[] = $user->user_prefix.$user->user_firstname." ".$user->user_lastname;
            }
        }
    }



    $physician      = array_unique($physician);
    $procedurename  = array_unique($procedurename);
    $userincase     = array_unique($userincase);
@endphp

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
            margin-top: 140px;
        }
        #header { position: fixed; left: 0px; margin-top: -120px; right: 10px; height: 140px; background-color: white; text-align: center;}
        .w-100{width: 100%;}
        /* .mh-100{min-height: 15px;} */
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
        .tb-patient tr td{line-height: 0.6em !important;width: 50%;padding: 0px 4px;}
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

    <style>
        .row{display: flex;}
        .col-6{width: 50%;}
        .text-blue{color: #245788};
        .text-dark{color: #808080}
    </style>

</head>
<body>
    <div id="header">
        @include("pdfhead.$head.nursenote.pdf_head01")
    </div>
   
    <div class="body">

        @include("endoindex.pdfnurse.component.head02")
        <br>
        @include("endoindex.pdfnurse.component.history01")
        <p style="page-break-before: always;"></p>
        @include("endoindex.pdfnurse.component.history02")
    </div>
</body>
</html>
