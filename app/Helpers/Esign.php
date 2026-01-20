<?php

    function esign_auto($code,$hn,$folderdate,$caseuniq){
        $picdoctor      = fileconfig("doctor/$code.txt");
        $sign_url       = storePATH("$hn/$folderdate/$caseuniq.txt");
        if(!file_exists($picdoctor)){
            copy($picdoctor,$sign_url);
        }else{
            $picdoctorwhite = fileconfig("doctor/white.txt");
            copy($picdoctorwhite,$sign_url);
        }
    }

?>
