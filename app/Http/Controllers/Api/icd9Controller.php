<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


use Image;
use Org_Heigl\Ghostscript\Ghostscript;
use Spatie\PdfToImage\Pdf;

// use App\Facades\Mongo;
use App\Models\Mongo;
use Exception;
use App\Models\Server;

class icd9Controller extends Controller
{



    public function index(){
        $w[]  =    array('case_pacs', '!=' , null );
        $tb_case = Mongo::table('tb_case')->where($w)->get();
        foreach ($tb_case as $key) {
            $y[0] = array('caseuniq' , $key['caseuniq']);
            $y[1] = array('comcreate' , $key['comcreate']);
            $value['case_pacs'] = $key['case_pacs'];
            Server::table('tb_case')->where($y)->update($value);
        }
    }

    public function show($id){
        $this->$id($id);
        // return view("test");
    }


    public function gi001($id){
        $arr['Adrenalin Injection'][0]['name'] = "Adrenalin Injection";
        $arr['Adrenalin Injection'][0]['code'] = "4443";
        $arr['Adrenalin Injection'][0]['unit'] = "ml.";
        $arr['Adrenalin Injection'][0]['status'] = "show";
        $arr['Adrenalin Injection'][0]['bill'] = " ";
        $arr['Adrenalin Injection'][0]['price'] = "4000";
        $arr['Adrenalin Injection'][0]['extra'] = "1";
        $arr['Adrenalin Injection'][0]['extra_text'] = "ml.";

        $arr['APC'][0]['name'] = " APC";
        $arr['APC'][0]['code'] = "44431";
        $arr['APC'][0]['unit'] = null;
        $arr['APC'][0]['status'] = "show";
        $arr['APC'][0]['bill'] = " ";
        $arr['APC'][0]['price'] = "4000";

        $arr['Banding ligation'][0]['name'] = "Banding ligation (Stomach)";
        $arr['Banding ligation'][0]['code'] = " 4341";
        $arr['Banding ligation'][0]['unit'] = " pcs.";
        $arr['Banding ligation'][0]['status'] = "show";
        $arr['Banding ligation'][0]['bill'] = " ";
        $arr['Banding ligation'][0]['price'] = "4000";
        $arr['Banding ligation'][0]['extra'] = "1";
        $arr['Banding ligation'][0]['extra_text'] = " pcs.";

        $arr['Banding ligation'][1]['name'] = "Banding ligation (Esophagus)";
        $arr['Banding ligation'][1]['code'] = " 4233";
        $arr['Banding ligation'][1]['unit'] = " pcs.";
        $arr['Banding ligation'][1]['status'] = "show";
        $arr['Banding ligation'][1]['bill'] = " ";
        $arr['Banding ligation'][1]['price'] = "4000";
        $arr['Banding ligation'][1]['extra'] = "1";
        $arr['Banding ligation'][1]['extra_text'] = " pcs.";

        $arr['Biopsy'][0]['name'] = "Biopsy";
        $arr['Biopsy'][0]['code'] = "4516";
        $arr['Biopsy'][0]['unit'] = null;
        $arr['Biopsy'][0]['status'] = "show";
        $arr['Biopsy'][0]['bill'] = " ";
        $arr['Biopsy'][0]['price'] = "2000";

        $arr['Dilation'][0]['name'] = "Dilation (Esophagus)";
        $arr['Dilation'][0]['code'] = "4292";
        $arr['Dilation'][0]['unit'] = null;
        $arr['Dilation'][0]['status'] = "show";
        $arr['Dilation'][0]['bill'] = " ";
        $arr['Dilation'][0]['price'] = "4000";

        $arr['Dilation'][1]['name'] = "Dilation (Pylorus)";
        $arr['Dilation'][1]['code'] = "4422";
        $arr['Dilation'][1]['unit'] = null;
        $arr['Dilation'][1]['status'] = "show";
        $arr['Dilation'][1]['bill'] = " ";
        $arr['Dilation'][1]['price'] = "6500";

        $arr['Dilation'][2]['name'] = "Dilation (Achalasia)";
        $arr['Dilation'][2]['code'] = "42921";
        $arr['Dilation'][2]['unit'] = null;
        $arr['Dilation'][2]['status'] = "show";
        $arr['Dilation'][2]['bill'] = " ";
        $arr['Dilation'][2]['price'] = "4000";

        $arr['EMR'][0]['name'] = "EMR (Esophagus)";
        $arr['EMR'][0]['code'] = "4233";
        $arr['EMR'][0]['unit'] = null;
        $arr['EMR'][0]['status'] = "show";
        $arr['EMR'][0]['bill'] = " ";
        $arr['EMR'][0]['price'] = "4000";

        $arr['EMR'][1]['name'] = "EMR (Gastric)";
        $arr['EMR'][1]['code'] = "4341";
        $arr['EMR'][1]['unit'] = null;
        $arr['EMR'][1]['status'] = "show";
        $arr['EMR'][1]['bill'] = " ";
        $arr['EMR'][1]['price'] = "4000";

        $arr['EVS'][0]['name'] = "EVS";
        $arr['EVS'][0]['code'] = "42331";
        $arr['EVS'][0]['unit'] = null;
        $arr['EVS'][0]['status'] = "show";
        $arr['EVS'][0]['bill'] = " ";
        $arr['EVS'][0]['price'] = "4000";

        $arr['FB removal'][0]['name'] = "FB removal (Esophagus)";
        $arr['FB removal'][0]['code'] = "9802";
        $arr['FB removal'][0]['unit'] = null;
        $arr['FB removal'][0]['status'] = "show";
        $arr['FB removal'][0]['bill'] = " ";
        $arr['FB removal'][0]['price'] = "2000";

        $arr['FB removal'][1]['name'] = "FB removal (Stomach-Duodenum)";
        $arr['FB removal'][1]['code'] = "9803";
        $arr['FB removal'][1]['unit'] = null;
        $arr['FB removal'][1]['status'] = "show";
        $arr['FB removal'][1]['bill'] = " ";
        $arr['FB removal'][1]['price'] = "4000";

        $arr['Glue injection'][0]['name'] = "Glue injection";
        $arr['Glue injection'][0]['code'] = "43411";
        $arr['Glue injection'][0]['unit'] = "ml.";
        $arr['Glue injection'][0]['status'] = "show";
        $arr['Glue injection'][0]['bill'] = " ";
        $arr['Glue injection'][0]['price'] = "4000";
        $arr['Glue injection'][0]['extra'] = "1";
        $arr['Glue injection'][0]['extra_text'] = "ml.";

        $arr['Heater probe/Gold probe'][0]['name'] = "Heater probe/Gold probe";
        $arr['Heater probe/Gold probe'][0]['code'] = "44433";
        $arr['Heater probe/Gold probe'][0]['unit'] = null;
        $arr['Heater probe/Gold probe'][0]['status'] = "show";
        $arr['Heater probe/Gold probe'][0]['bill'] = " ";
        $arr['Heater probe/Gold probe'][0]['price'] = "4000";

        $arr['Hemoclip'][0]['name'] = "Hemoclip";
        $arr['Hemoclip'][0]['code'] = "44432";
        $arr['Hemoclip'][0]['unit'] = "pcs.";
        $arr['Hemoclip'][0]['status'] = "show";
        $arr['Hemoclip'][0]['bill'] = " ";
        $arr['Hemoclip'][0]['price'] = "4000";
        $arr['Hemoclip'][0]['extra'] = "1";
        $arr['Hemoclip'][0]['extra_text'] = " pcs.";

        $arr['Insert NG'][0]['name'] = "Insert NG";
        $arr['Insert NG'][0]['code'] = "9607";
        $arr['Insert NG'][0]['unit'] = null;
        $arr['Insert NG'][0]['status'] = "show";
        $arr['Insert NG'][0]['bill'] = " ";
        $arr['Insert NG'][0]['price'] = "200";

        $arr['Insert Sengstaken Blakemore tube'][0]['name'] = "Insert Sengstaken Blakemore tube";
        $arr['Insert Sengstaken Blakemore tube'][0]['code'] = "9606";
        $arr['Insert Sengstaken Blakemore tube'][0]['unit'] = null;
        $arr['Insert Sengstaken Blakemore tube'][0]['status'] = "show";
        $arr['Insert Sengstaken Blakemore tube'][0]['bill'] = " ";
        $arr['Insert Sengstaken Blakemore tube'][0]['price'] = "4000";

        $arr['PEG'][0]['name'] = "PEG";
        $arr['PEG'][0]['code'] = "4311";
        $arr['PEG'][0]['unit'] = null;
        $arr['PEG'][0]['status'] = "show";
        $arr['PEG'][0]['bill'] = " ";
        $arr['PEG'][0]['price'] = "7000";

        $arr['Polypectomy'][0]['name'] = "Polypectomy (Esophagus)";
        $arr['Polypectomy'][0]['code'] = "4233";
        $arr['Polypectomy'][0]['unit'] = null;
        $arr['Polypectomy'][0]['status'] = "show";
        $arr['Polypectomy'][0]['bill'] = " ";
        $arr['Polypectomy'][0]['price'] = "4000";

        $arr['Polypectomy'][1]['name'] = "Polypectomy (Stomach)";
        $arr['Polypectomy'][1]['code'] = "4341";
        $arr['Polypectomy'][1]['unit'] = null;
        $arr['Polypectomy'][1]['status'] = "show";
        $arr['Polypectomy'][1]['bill'] = " ";
        $arr['Polypectomy'][1]['price'] = "6500";

        $arr['Polypectomy'][2]['name'] = "Polypectomy (Duodenum)";
        $arr['Polypectomy'][2]['code'] = "4530";
        $arr['Polypectomy'][2]['unit'] = null;
        $arr['Polypectomy'][2]['status'] = "show";
        $arr['Polypectomy'][2]['bill'] = " ";
        $arr['Polypectomy'][2]['price'] = "4000";

        $arr['Spray'][0]['name'] = "Spray";
        $arr['Spray'][0]['code'] = "43411";
        $arr['Spray'][0]['unit'] = null;
        $arr['Spray'][0]['status'] = "show";
        $arr['Spray'][0]['bill'] = " ";
        $arr['Spray'][0]['price'] = "4000";

        $arr['Stenting'][0]['name'] = "Stenting (Esophagus)";
        $arr['Stenting'][0]['code'] = "4281";
        $arr['Stenting'][0]['unit'] = null;
        $arr['Stenting'][0]['status'] = "show";
        $arr['Stenting'][0]['bill'] = " ";
        $arr['Stenting'][0]['price'] = "4000";

        $arr['Stenting'][1]['name'] = "Stenting (Duodenum)";
        $arr['Stenting'][1]['code'] = "4281";
        $arr['Stenting'][1]['unit'] = null;
        $arr['Stenting'][1]['status'] = "show";
        $arr['Stenting'][1]['bill'] = " ";
        $arr['Stenting'][1]['price'] = "4000";


        // $arr['EGD'][0]['name'] = "EGD";
        // $arr['EGD'][0]['code'] = "9802";
        // $arr['EGD'][0]['unit'] = null;
        // $arr['EGD'][0]['status'] = "show";
        // $arr['EGD'][0]['bill'] = "Removal Of Intraluminal Foreign Body From Esophagus Without Incision";
        // $arr['EGD'][0]['price'] = "2000";

        $val['icd9'] = $arr;

        Mongo::table("tb_procedure")->where("code", $id)->update($val);

    }

    public function gi002($id){
        $arr['Adrenalin Injection'][0]['name'] = "Adrenalin injection";
        $arr['Adrenalin Injection'][0]['code'] = "4543";
        $arr['Adrenalin Injection'][0]['unit'] = "ml.";
        $arr['Adrenalin Injection'][0]['status'] = "show";
        $arr['Adrenalin Injection'][0]['bill'] = " ";
        $arr['Adrenalin Injection'][0]['price'] = "6700";
        $arr['Adrenalin Injection'][0]['extra'] = "1";
        $arr['Adrenalin Injection'][0]['extra_text'] = "ml.";

        $arr['APC'][0]['name'] = " APC";
        $arr['APC'][0]['code'] = "45433";
        $arr['APC'][0]['unit'] = null;
        $arr['APC'][0]['status'] = "show";
        $arr['APC'][0]['bill'] = " ";
        $arr['APC'][0]['price'] = "4000";

        $arr['Biopsy'][0]['name'] = "Biopsy";
        $arr['Biopsy'][0]['code'] = "4525";
        $arr['Biopsy'][0]['unit'] = null;
        $arr['Biopsy'][0]['status'] = "show";
        $arr['Biopsy'][0]['bill'] = " ";
        $arr['Biopsy'][0]['price'] = "3500";

        $arr['Coagulation'][0]['name'] = "Coagulation";
        $arr['Coagulation'][0]['code'] = "45431";
        $arr['Coagulation'][0]['unit'] = null;
        $arr['Coagulation'][0]['status'] = "show";
        $arr['Coagulation'][0]['bill'] = " ";
        $arr['Coagulation'][0]['price'] = "6700";

        $arr['Dilation'][0]['name'] = "Dilation (Duodenum)";
        $arr['Dilation'][0]['code'] = "4685";
        $arr['Dilation'][0]['unit'] = null;
        $arr['Dilation'][0]['status'] = "show";
        $arr['Dilation'][0]['bill'] = " ";
        $arr['Dilation'][0]['price'] = "4000";

        $arr['Dilation'][1]['name'] = "Dilation (Large intestine)";
        $arr['Dilation'][1]['code'] = "4685";
        $arr['Dilation'][1]['unit'] = null;
        $arr['Dilation'][1]['status'] = "show";
        $arr['Dilation'][1]['bill'] = " ";
        $arr['Dilation'][1]['price'] = "4000";

        $arr['EMR'][0]['name'] = "EMR";
        $arr['EMR'][0]['code'] = "4836";
        $arr['EMR'][0]['unit'] = null;
        $arr['EMR'][0]['status'] = "show";
        $arr['EMR'][0]['bill'] = " ";
        $arr['EMR'][0]['price'] = "4000";

        $arr['ESD'][0]['name'] = "ESD";
        $arr['ESD'][0]['code'] = "45423";
        $arr['ESD'][0]['unit'] = null;
        $arr['ESD'][0]['status'] = "show";
        $arr['ESD'][0]['bill'] = " ";
        $arr['ESD'][0]['price'] = "1000";

        $arr['FB removal'][0]['name'] = "FB removal (Colon)";
        $arr['FB removal'][0]['code'] = "9804";
        $arr['FB removal'][0]['unit'] = null;
        $arr['FB removal'][0]['status'] = "show";
        $arr['FB removal'][0]['bill'] = " ";
        $arr['FB removal'][0]['price'] = "4000";

        $arr['FB removal'][1]['name'] = "FB removal (Rectum and Anus)";
        $arr['FB removal'][1]['code'] = "9804";
        $arr['FB removal'][1]['unit'] = null;
        $arr['FB removal'][1]['status'] = "show";
        $arr['FB removal'][1]['bill'] = " ";
        $arr['FB removal'][1]['price'] = "4000";

        $arr['Fecal impact irrigation'][0]['name'] = "Fecal impact irrigation";
        $arr['Fecal impact irrigation'][0]['code'] = "9638";
        $arr['Fecal impact irrigation'][0]['unit'] = null;
        $arr['Fecal impact irrigation'][0]['status'] = "show";
        $arr['Fecal impact irrigation'][0]['bill'] = " ";
        $arr['Fecal impact irrigation'][0]['price'] = "4000";

        $arr['Glue injection'][0]['name'] = "Glue injection";
        $arr['Glue injection'][0]['code'] = "45434";
        $arr['Glue injection'][0]['unit'] = "pcs.";
        $arr['Glue injection'][0]['status'] = "show";
        $arr['Glue injection'][0]['bill'] = " ";
        $arr['Glue injection'][0]['price'] = "4000";
        $arr['Glue injection'][0]['extra'] = "1";
        $arr['Glue injection'][0]['extra_text'] = " ml.";

        $arr['Hemoclip'][0]['name'] = "Hemoclip";
        $arr['Hemoclip'][0]['code'] = "45432";
        $arr['Hemoclip'][0]['unit'] = "pcs.";
        $arr['Hemoclip'][0]['status'] = "show";
        $arr['Hemoclip'][0]['bill'] = " ";
        $arr['Hemoclip'][0]['price'] = "4000";
        $arr['Hemoclip'][0]['extra'] = "1";
        $arr['Hemoclip'][0]['extra_text'] = " pcs.";

        $arr['Polypectomy'][0]['name'] = "Polypectomy";
        $arr['Polypectomy'][0]['code'] = "4542";
        $arr['Polypectomy'][0]['unit'] = null;
        $arr['Polypectomy'][0]['status'] = "show";
        $arr['Polypectomy'][0]['bill'] = " ";
        $arr['Polypectomy'][0]['price'] = "6700";

        $arr['Polypectomy'][1]['name'] = "Polypectomy with Loop";
        $arr['Polypectomy'][1]['code'] = "45421";
        $arr['Polypectomy'][1]['unit'] = null;
        $arr['Polypectomy'][1]['status'] = "show";
        $arr['Polypectomy'][1]['bill'] = " ";
        $arr['Polypectomy'][1]['price'] = "4000";

        $arr['Polypectomy'][2]['name'] = "Polypectomy of Rectal";
        $arr['Polypectomy'][2]['code'] = "4836";
        $arr['Polypectomy'][2]['unit'] = null;
        $arr['Polypectomy'][2]['status'] = "show";
        $arr['Polypectomy'][2]['bill'] = " ";
        $arr['Polypectomy'][2]['price'] = "4000";

        $arr['Spray'][0]['name'] = "Stenting";
        $arr['Spray'][0]['code'] = "4686";
        $arr['Spray'][0]['unit'] = null;
        $arr['Spray'][0]['status'] = "show";
        $arr['Spray'][0]['bill'] = " ";
        $arr['Spray'][0]['price'] = "4000";

        $val['icd9'] = $arr;

        Mongo::table("tb_procedure")->where("code", $id)->update($val);

    }

    public function gi003($id){
        $arr['Biopsy'][0]['name'] = "Biopsy (Biliary)";
        $arr['Biopsy'][0]['code'] = "5114";
        $arr['Biopsy'][0]['unit'] = null;
        $arr['Biopsy'][0]['status'] = "show";
        $arr['Biopsy'][0]['bill'] = " ";
        $arr['Biopsy'][0]['price'] = "5400";

        $arr['Biopsy'][1]['name'] = "Biopsy (Duodenum)";
        $arr['Biopsy'][1]['code'] = "5114";
        $arr['Biopsy'][1]['unit'] = null;
        $arr['Biopsy'][1]['status'] = "show";
        $arr['Biopsy'][1]['bill'] = " ";
        $arr['Biopsy'][1]['price'] = "5400";

        $arr['Biopsy'][2]['name'] = "Biopsy (Pancreatic duct)";
        $arr['Biopsy'][2]['code'] = "5214";
        $arr['Biopsy'][2]['unit'] = null;
        $arr['Biopsy'][2]['status'] = "show";
        $arr['Biopsy'][2]['bill'] = " ";
        $arr['Biopsy'][2]['price'] = "5400";

        $arr['Brushing (Biliary)'][0]['name'] = "Brushing (Biliary)";
        $arr['Brushing (Biliary)'][0]['code'] = "51141";
        $arr['Brushing (Biliary)'][0]['unit'] = null;
        $arr['Brushing (Biliary)'][0]['status'] = "show";
        $arr['Brushing (Biliary)'][0]['bill'] = " ";
        $arr['Brushing (Biliary)'][0]['price'] = "5400";

        $arr['Dilation'][0]['name'] = "Dilation (Ampulla)";
        $arr['Dilation'][0]['code'] = "5184";
        $arr['Dilation'][0]['unit'] = null;
        $arr['Dilation'][0]['status'] = "show";
        $arr['Dilation'][0]['bill'] = " ";
        $arr['Dilation'][0]['price'] = "5400";

        $arr['Dilation'][1]['name'] = "Dilation (Biliary duct)";
        $arr['Dilation'][1]['code'] = "5184";
        $arr['Dilation'][1]['unit'] = null;
        $arr['Dilation'][1]['status'] = "show";
        $arr['Dilation'][1]['bill'] = " ";
        $arr['Dilation'][1]['price'] = "5400";

        $arr['Dilation'][2]['name'] = "Dilation (Pancreatic duct)";
        $arr['Dilation'][2]['code'] = "5298";
        $arr['Dilation'][2]['unit'] = null;
        $arr['Dilation'][2]['status'] = "show";
        $arr['Dilation'][2]['bill'] = " ";
        $arr['Dilation'][2]['price'] = "5400";

        $arr['Insert drainage tube'][0]['name'] = "Insert drainage tube (Nasobilliary)";
        $arr['Insert drainage tube'][0]['code'] = "5186";
        $arr['Insert drainage tube'][0]['unit'] = null;
        $arr['Insert drainage tube'][0]['status'] = "show";
        $arr['Insert drainage tube'][0]['bill'] = " ";
        $arr['Insert drainage tube'][0]['price'] = "5400";

        $arr['Insert drainage tube'][1]['name'] = "Insert drainage tube (Nasopancreatic)";
        $arr['Insert drainage tube'][1]['code'] = "5297";
        $arr['Insert drainage tube'][1]['unit'] = null;
        $arr['Insert drainage tube'][1]['status'] = "show";
        $arr['Insert drainage tube'][1]['bill'] = " ";
        $arr['Insert drainage tube'][1]['price'] = "5400";

        $arr['PTBD'][0]['name'] = "PTBD";
        $arr['PTBD'][0]['code'] = "5101";
        $arr['PTBD'][0]['unit'] = null;
        $arr['PTBD'][0]['status'] = "show";
        $arr['PTBD'][0]['bill'] = " ";
        $arr['PTBD'][0]['price'] = "2000";

        $arr['Remove Stent'][0]['name'] = "Remove Stent (CBD)";
        $arr['Remove Stent'][0]['code'] = "9755";
        $arr['Remove Stent'][0]['unit'] = "pcs.";
        $arr['Remove Stent'][0]['status'] = "show";
        $arr['Remove Stent'][0]['bill'] = " ";
        $arr['Remove Stent'][0]['price'] = "4000";

        $arr['Remove Stent'][1]['name'] = "Remove Stent (PD)";
        $arr['Remove Stent'][1]['code'] = "9755";
        $arr['Remove Stent'][1]['unit'] = null;
        $arr['Remove Stent'][1]['status'] = "show";
        $arr['Remove Stent'][1]['bill'] = " ";
        $arr['Remove Stent'][1]['price'] = "4000";

        $arr['Remove Stone'][0]['name'] = "Remove Stone (CBD)";
        $arr['Remove Stone'][0]['code'] = "5188";
        $arr['Remove Stone'][0]['unit'] = null;
        $arr['Remove Stone'][0]['status'] = "show";
        $arr['Remove Stone'][0]['bill'] = " ";
        $arr['Remove Stone'][0]['price'] = "3500";

        $arr['Remove Stone'][1]['name'] = "Remove Stone (PD)";
        $arr['Remove Stone'][1]['code'] = "5294";
        $arr['Remove Stone'][1]['unit'] = null;
        $arr['Remove Stone'][1]['status'] = "show";
        $arr['Remove Stone'][1]['bill'] = " ";
        $arr['Remove Stone'][1]['price'] = "3500";

        $arr['Replace Stent'][0]['name'] = "Replace Stent (CBD)";
        $arr['Replace Stent'][0]['code'] = "9705";
        $arr['Replace Stent'][0]['unit'] = "pcs.";
        $arr['Replace Stent'][0]['status'] = "show";
        $arr['Replace Stent'][0]['bill'] = " ";
        $arr['Replace Stent'][0]['price'] = "3500";

        $arr['Replace Stent'][1]['name'] = "Replace Stent (PD)";
        $arr['Replace Stent'][1]['code'] = "9705";
        $arr['Replace Stent'][1]['unit'] = null;
        $arr['Replace Stent'][1]['status'] = "show";
        $arr['Replace Stent'][1]['bill'] = " ";
        $arr['Replace Stent'][1]['price'] = "3500";

        $arr['Sphincterotomy'][0]['name'] = "Sphincterotomy";
        $arr['Sphincterotomy'][0]['code'] = "5185";
        $arr['Sphincterotomy'][0]['unit'] = null;
        $arr['Sphincterotomy'][0]['status'] = "show";
        $arr['Sphincterotomy'][0]['bill'] = " ";
        $arr['Sphincterotomy'][0]['price'] = "5400";

        $arr['Stenting'][0]['name'] = "Stenting (CBD)";
        $arr['Stenting'][0]['code'] = "5187";
        $arr['Stenting'][0]['unit'] = null;
        $arr['Stenting'][0]['status'] = "show";
        $arr['Stenting'][0]['bill'] = " ";
        $arr['Stenting'][0]['price'] = "5400";

        $arr['Stenting'][1]['name'] = "Stenting (PD)";
        $arr['Stenting'][1]['code'] = "5293";
        $arr['Stenting'][1]['unit'] = null;
        $arr['Stenting'][1]['status'] = "show";
        $arr['Stenting'][1]['bill'] = " ";
        $arr['Stenting'][1]['price'] = "10000";

        $val['icd9'] = $arr;

        Mongo::table("tb_procedure")->where("code", $id)->update($val);

    }

    public function gi004($id){
        $arr['Biopsy'][0]['name'] = "Biopsy (Esophagus)";
        $arr['Biopsy'][0]['code'] = "51191";
        $arr['Biopsy'][0]['unit'] = null;
        $arr['Biopsy'][0]['status'] = "show";
        $arr['Biopsy'][0]['bill'] = " ";
        $arr['Biopsy'][0]['price'] = "5000";

        $arr['Biopsy'][1]['name'] = "Biopsy (Stomach)";
        $arr['Biopsy'][1]['code'] = "51191";
        $arr['Biopsy'][1]['unit'] = null;
        $arr['Biopsy'][1]['status'] = "show";
        $arr['Biopsy'][1]['bill'] = " ";
        $arr['Biopsy'][1]['price'] = "5000";

        $arr['Biopsy'][2]['name'] = "Biopsy (Pancreas)";
        $arr['Biopsy'][2]['code'] = "51191";
        $arr['Biopsy'][2]['unit'] = null;
        $arr['Biopsy'][2]['status'] = "show";
        $arr['Biopsy'][2]['bill'] = " ";
        $arr['Biopsy'][2]['price'] = "5000";

        $arr['Biopsy'][3]['name'] = "Biopsy (Rectum)";
        $arr['Biopsy'][3]['code'] = "51191";
        $arr['Biopsy'][3]['unit'] = null;
        $arr['Biopsy'][3]['status'] = "show";
        $arr['Biopsy'][3]['bill'] = " ";
        $arr['Biopsy'][3]['price'] = "5000";

        $arr['Choledochoduodenostomy'][0]['name'] = "Choledochoduodenostomy";
        $arr['Choledochoduodenostomy'][0]['code'] = "51194";
        $arr['Choledochoduodenostomy'][0]['unit'] = null;
        $arr['Choledochoduodenostomy'][0]['status'] = "show";
        $arr['Choledochoduodenostomy'][0]['bill'] = " ";
        $arr['Choledochoduodenostomy'][0]['price'] = "5400";

        $arr['Coiling of GV'][0]['name'] = "Coiling of GV";
        $arr['Coiling of GV'][0]['code'] = "51197";
        $arr['Coiling of GV'][0]['unit'] = null;
        $arr['Coiling of GV'][0]['status'] = "show";
        $arr['Coiling of GV'][0]['bill'] = " ";
        $arr['Coiling of GV'][0]['price'] = "5400";

        $arr['EUS'][0]['name'] = "EUS (Esophagus)";
        $arr['EUS'][0]['code'] = "5119";
        $arr['EUS'][0]['unit'] = null;
        $arr['EUS'][0]['status'] = "show";
        $arr['EUS'][0]['bill'] = " ";
        $arr['EUS'][0]['price'] = "4000";

        $arr['EUS'][1]['name'] = "EUS (Stomach)";
        $arr['EUS'][1]['code'] = "5119";
        $arr['EUS'][1]['unit'] = null;
        $arr['EUS'][1]['status'] = "show";
        $arr['EUS'][1]['bill'] = " ";
        $arr['EUS'][1]['price'] = "4000";

        $arr['EUS'][2]['name'] = "EUS (Biliary tract)";
        $arr['EUS'][2]['code'] = "5119";
        $arr['EUS'][2]['unit'] = null;
        $arr['EUS'][2]['status'] = "show";
        $arr['EUS'][2]['bill'] = " ";
        $arr['EUS'][2]['price'] = "4500";

        $arr['EUS'][3]['name'] = "EUS (Pancreas)";
        $arr['EUS'][3]['code'] = "5119";
        $arr['EUS'][3]['unit'] = null;
        $arr['EUS'][3]['status'] = "show";
        $arr['EUS'][3]['bill'] = " ";
        $arr['EUS'][3]['price'] = "4500";

        $arr['EUS'][4]['name'] = "EUS (Rectum)";
        $arr['EUS'][4]['code'] = "5119";
        $arr['EUS'][4]['unit'] = null;
        $arr['EUS'][4]['status'] = "show";
        $arr['EUS'][4]['bill'] = " ";
        $arr['EUS'][4]['price'] = "4000";

        $arr['FNA'][0]['name'] = "FNA";
        $arr['FNA'][0]['code'] = "51191";
        $arr['FNA'][0]['unit'] = null;
        $arr['FNA'][0]['status'] = "show";
        $arr['FNA'][0]['bill'] = " ";
        $arr['FNA'][0]['price'] = "4000";

        $arr['Hepaticogastrostomy'][0]['name'] = "Hepaticogastrostomy";
        $arr['Hepaticogastrostomy'][0]['code'] = "51193";
        $arr['Hepaticogastrostomy'][0]['unit'] = null;
        $arr['Hepaticogastrostomy'][0]['status'] = "show";
        $arr['Hepaticogastrostomy'][0]['bill'] = " ";
        $arr['Hepaticogastrostomy'][0]['price'] = "5000";

        $arr['Injection'][0]['name'] = "Injection";
        $arr['Injection'][0]['code'] = "51192";
        $arr['Injection'][0]['unit'] = null;
        $arr['Injection'][0]['status'] = "show";
        $arr['Injection'][0]['bill'] = " ";
        $arr['Injection'][0]['price'] = "4000";

        $arr['Pseudocyst drainage'][0]['name'] = "Pseudocyst drainage";
        $arr['Pseudocyst drainage'][0]['code'] = "51196";
        $arr['Pseudocyst drainage'][0]['unit'] = null;
        $arr['Pseudocyst drainage'][0]['status'] = "show";
        $arr['Pseudocyst drainage'][0]['bill'] = " ";
        $arr['Pseudocyst drainage'][0]['price'] = "5400";

        $arr['Rendezvous'][0]['name'] = "Rendezvous";
        $arr['Rendezvous'][0]['code'] = "51195";
        $arr['Rendezvous'][0]['unit'] = null;
        $arr['Rendezvous'][0]['status'] = "show";
        $arr['Rendezvous'][0]['bill'] = " ";
        $arr['Rendezvous'][0]['price'] = "5400";

        $val['icd9'] = $arr;

        Mongo::table("tb_procedure")->where("code", $id)->update($val);

    }

    public function gi002s1($id){
        $arr['Adrenalin Injection'][0]['name'] = "Adrenalin injection";
        $arr['Adrenalin Injection'][0]['code'] = "4543";
        $arr['Adrenalin Injection'][0]['unit'] = "ml.";
        $arr['Adrenalin Injection'][0]['status'] = "show";
        $arr['Adrenalin Injection'][0]['bill'] = " ";
        $arr['Adrenalin Injection'][0]['price'] = "6700";
        $arr['Adrenalin Injection'][0]['extra'] = "1";
        $arr['Adrenalin Injection'][0]['extra_text'] = "ml.";

        $arr['APC'][0]['name'] = " APC";
        $arr['APC'][0]['code'] = "45433";
        $arr['APC'][0]['unit'] = null;
        $arr['APC'][0]['status'] = "show";
        $arr['APC'][0]['bill'] = " ";
        $arr['APC'][0]['price'] = "4000";

        $arr['Banding ligation'][0]['name'] = "Banding ligation";
        $arr['Banding ligation'][0]['code'] = "4945";
        $arr['Banding ligation'][0]['unit'] = "pcs.";
        $arr['Banding ligation'][0]['status'] = "show";
        $arr['Banding ligation'][0]['bill'] = " ";
        $arr['Banding ligation'][0]['price'] = "1000";
        $arr['Banding ligation'][0]['extra'] = "1";
        $arr['Banding ligation'][0]['extra_text'] = "pcs.";

        $arr['Biopsy'][0]['name'] = "Biopsy";
        $arr['Biopsy'][0]['code'] = "4525";
        $arr['Biopsy'][0]['unit'] = null;
        $arr['Biopsy'][0]['status'] = "show";
        $arr['Biopsy'][0]['bill'] = " ";
        $arr['Biopsy'][0]['price'] = "3500";

        $arr['Coagulation'][0]['name'] = "Coagulation";
        $arr['Coagulation'][0]['code'] = "45431";
        $arr['Coagulation'][0]['unit'] = null;
        $arr['Coagulation'][0]['status'] = "show";
        $arr['Coagulation'][0]['bill'] = " ";
        $arr['Coagulation'][0]['price'] = "6700";

        $arr['Dilation'][0]['name'] = "Dilation (Duodenum)";
        $arr['Dilation'][0]['code'] = "4685";
        $arr['Dilation'][0]['unit'] = null;
        $arr['Dilation'][0]['status'] = "show";
        $arr['Dilation'][0]['bill'] = " ";
        $arr['Dilation'][0]['price'] = "4000";

        $arr['Dilation'][1]['name'] = "Dilation (Large intestine)";
        $arr['Dilation'][1]['code'] = "4685";
        $arr['Dilation'][1]['unit'] = null;
        $arr['Dilation'][1]['status'] = "show";
        $arr['Dilation'][1]['bill'] = " ";
        $arr['Dilation'][1]['price'] = "4000";

        $arr['ESD'][0]['name'] = "ESD";
        $arr['ESD'][0]['code'] = "45423";
        $arr['ESD'][0]['unit'] = null;
        $arr['ESD'][0]['status'] = "show";
        $arr['ESD'][0]['bill'] = " ";
        $arr['ESD'][0]['price'] = "1000";

        $arr['FB removal'][0]['name'] = "FB removal (Colon)";
        $arr['FB removal'][0]['code'] = "9804";
        $arr['FB removal'][0]['unit'] = null;
        $arr['FB removal'][0]['status'] = "show";
        $arr['FB removal'][0]['bill'] = " ";
        $arr['FB removal'][0]['price'] = "4000";

        $arr['FB removal'][1]['name'] = "FB removal (Rectum and Anus)";
        $arr['FB removal'][1]['code'] = "9804";
        $arr['FB removal'][1]['unit'] = null;
        $arr['FB removal'][1]['status'] = "show";
        $arr['FB removal'][1]['bill'] = " ";
        $arr['FB removal'][1]['price'] = "4000";

        $arr['Fecal impact irrigation'][0]['name'] = "Fecal impact irrigation";
        $arr['Fecal impact irrigation'][0]['code'] = "9638";
        $arr['Fecal impact irrigation'][0]['unit'] = null;
        $arr['Fecal impact irrigation'][0]['status'] = "show";
        $arr['Fecal impact irrigation'][0]['bill'] = " ";
        $arr['Fecal impact irrigation'][0]['price'] = "4000";

        $arr['Glue injection'][0]['name'] = "Glue injection";
        $arr['Glue injection'][0]['code'] = "45434";
        $arr['Glue injection'][0]['unit'] = "ml.";
        $arr['Glue injection'][0]['status'] = "show";
        $arr['Glue injection'][0]['bill'] = " ";
        $arr['Glue injection'][0]['price'] = "4000";
        $arr['Glue injection'][0]['extra'] = "1";
        $arr['Glue injection'][0]['extra_text'] = " ml.";

        $arr['Hemoclip'][0]['name'] = "Hemoclip";
        $arr['Hemoclip'][0]['code'] = "45432";
        $arr['Hemoclip'][0]['unit'] = "pcs.";
        $arr['Hemoclip'][0]['status'] = "show";
        $arr['Hemoclip'][0]['bill'] = " ";
        $arr['Hemoclip'][0]['price'] = "4000";
        $arr['Hemoclip'][0]['extra'] = "1";
        $arr['Hemoclip'][0]['extra_text'] = " pcs.";

        $arr['Polypectomy'][0]['name'] = "Polypectomy";
        $arr['Polypectomy'][0]['code'] = "4542";
        $arr['Polypectomy'][0]['unit'] = null;
        $arr['Polypectomy'][0]['status'] = "show";
        $arr['Polypectomy'][0]['bill'] = " ";
        $arr['Polypectomy'][0]['price'] = "6700";

        $arr['Polypectomy'][1]['name'] = "Polypectomy with Loop";
        $arr['Polypectomy'][1]['code'] = "45421";
        $arr['Polypectomy'][1]['unit'] = null;
        $arr['Polypectomy'][1]['status'] = "show";
        $arr['Polypectomy'][1]['bill'] = " ";
        $arr['Polypectomy'][1]['price'] = "4000";

        $arr['Polypectomy'][2]['name'] = "Polypectomy of Rectal";
        $arr['Polypectomy'][2]['code'] = "4836";
        $arr['Polypectomy'][2]['unit'] = null;
        $arr['Polypectomy'][2]['status'] = "show";
        $arr['Polypectomy'][2]['bill'] = " ";
        $arr['Polypectomy'][2]['price'] = "4000";

        $arr['Stenting'][0]['name'] = "Stenting";
        $arr['Stenting'][0]['code'] = "4686";
        $arr['Stenting'][0]['unit'] = null;
        $arr['Stenting'][0]['status'] = "show";
        $arr['Stenting'][0]['bill'] = " ";
        $arr['Stenting'][0]['price'] = "4000";

        $val['icd9'] = $arr;

        Mongo::table("tb_procedure")->where("code", $id)->update($val);

    }

    public function update_patientworklist(){
        $w[0] = array('firstname', 'ทดสอบ222');
        $patient = Mongo::table('tb_patient')->where($w)->get();
        // Mongo::table('tb_caseworklist')->where('accessionnumber', '')->delete();
        $case_worklist = Mongo::table('tb_caseworklist')->get();

        $arr = [];
        foreach (isset($patient)?$patient:[] as $p) {
            $p = (object) $p;
            $hn = $p->hn;
            $specialChars = array('/', '.', ':');
            $hn = str_replace($specialChars, '', $hn);

            $url = "http://SiPHVmRis/EnvisionRIEGet3rdPartyDataMedica/Service/Setpatient";
            $client = new \GuzzleHttp\Client();
            $data['hn'] = $hn;
            $response = $client->post($url, [
                'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
                'body'    => json_encode($data)
            ]);
            $json = jsonDecode($response->getBody());
            $json = (array) $json;
            if(isset($json)){
                // $u['hn']        = $hn;
                $u['firstname'] = @$json['PatientFName']."";
                $u['lastname']  = @$json['PatientLName']."";
                $u['prefix']    = @$json['PatientTitle']."";
                if(isset($json['PatientDob'])){
                    $u['birthdate']           = explode("T",@$json['PatientDob'])[0];
                } else {
                    $u['birthdate']           = "";
                }
                $w1[0] = array('hn', $hn);
                $arr[] = $u;
                if($u['firstname'] != "" && $u['lastname'] != ""){
                    // Mongo::table('tb_patient')->where($w1)->update($u);
                    $test[] = Mongo::table('tb_patient')->where($w1)->first();
                }
            }
            $w1 = [];
            $u = [];
        }
        // $test = Mongo::table('tb_patient')->where($w)->get();

        dd($patient,  $arr, $test);
    }

    function match_procedure(){
        $w[0] = array('proceduredescription', '!=', '');
        $tb_caseworklist = Mongo::table('tb_caseworklist')->where($w)->get();
        $tb_procedure    = Mongo::table('tb_procedure')->get();

        $match = [];
        foreach ($tb_caseworklist as $key => $val) {
            $sub = [];
            $val = (object) $val;
            $wk_proc = $val->proceduredescription;
            $txt_split = $this->custom_split($wk_proc);
            foreach ($txt_split as $t) {
                foreach ($tb_procedure as $k => $v) {
                    if($t == 'with' || $t == '-' || $t == 'UNKNOWN' || $t == '' || $t == '/' || $t == 'Change'){
                        continue;
                    }
                    $v = (object) $v;
                    $name = $v->name;
                    if (str_contains($name, $t) || str_contains($t, $name)){
                        // $sub[] = $name;
                        $match[$t] = $name;
                        break;
                    }
                    // else {
                    //     $match[$t] = 'EGD';
                    // }
                }
            }
            // $sub = array_values(array_unique($sub));
            // if(count($sub) == 0){
            //     $sub = ['EGD'];
            // }
            // $match[$wk_proc] = $sub;
            // $sub = [];
        }

        dd($match);

        foreach ($match as $proc_name => $proc_match) {
            $i['text_find'] = $proc_name;
            $i['text_match'] = $proc_match;
            Mongo::table('tb_worklistfindtext')->insert($i);
        }

        // -------------------------------------------- //
    }

    function custom_split($str) {
        // Check if the string contains parentheses
        if (preg_match('/\((.*?)\)/', $str, $matches)) {
            // Extract the part inside the parentheses
            $insideParentheses = $matches[1];
            // Remove the parentheses part from the original string
            $str = str_replace('(' . $insideParentheses . ')', '', $str);
            // Split the remaining part of the string
            $parts = explode(' ', trim($str));
            // Add the part that was inside the parentheses
            $parts[] = $insideParentheses;
            return $parts;
        } else {
            // If no parentheses, just split by spaces
            return explode(' ', $str);
        }
    }


    public function store(Request $r){
        echo rand(1000,9999);
        // echo "data";

    }










}
