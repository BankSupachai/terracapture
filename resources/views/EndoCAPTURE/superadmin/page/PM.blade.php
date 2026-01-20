
            @php
                //Attribute
                $arr["nameshow"]    = "PM";
                $arr["img"]         = "EGD.jpg";
                $arr["color"]       = "#0d7810";

                //Component in Case
            $arr["case"][]   = 'pm';
$arr["case"][]   = 'photo';
$arr["case"][]   = 'finding';
$arr["case"][]   = 'diagnostic';
$arr["case"][]   = 'post_procedure_icd9';
$arr["case"][]   = 'histopathology';
$arr["case"][]   = 'officer';

            //PDF Head
            $arr["pdf"]["head"]["title"]["departmentTH"]    = "หน่วยส่องกล้องทางเดินอาหาร";
            $arr["pdf"]["head"]["title"]["departmentEN"]    = "Digestive Endoscopy Department";
            $arr["pdf"]["head"]["title"]["documentname"]    = "Digestive Endoscopy Report";
            $arr["pdf"]["head"]["title"]["physician"]       = "ENDOSCOPIST";
            $arr["pdf"]["head"]["title"]["nurse"]           = "ENDOSCOPY NURSE";

            //PDF Show
            $arr["pdf"]["show"][]   = '0001_BRIEF_HISTORY';
$arr["pdf"]["show"][]   = '0003_ANESTHESIA';
$arr["pdf"]["show"][]   = '0004_MEDICATION';
$arr["pdf"]["show"][]   = '0005_PRE-DIAGNOSTIC';
$arr["pdf"]["show"][]   = '0015_GASTRICCONTENT';
$arr["pdf"]["show"][]   = '0010_FINDINGS';
$arr["pdf"]["show"][]   = '0011_POST-DIAGNOSTIC';
$arr["pdf"]["show"][]   = '0012_PROCEDURE_ICD9';
$arr["pdf"]["show"][]   = '0018_RAPID_UREASE_TEST';
$arr["pdf"]["show"][]   = '0016_HISTOPATHOLOGY';
$arr["pdf"]["show"][]   = '0017_TISSUESUBMITTED';
$arr["pdf"]["show"][]   = '0014_COMPLICATION';
$arr["pdf"]["show"][]   = '0020_RECOMMENDATION';
$arr["pdf"]["show"][]   = '0021_COMMENTS';
//Anesthesia 
//Anesthesis 
//Histopathology 
//icd9 
//icd10 
//mainpart 

                printJSON($arr);

                @endphp
            