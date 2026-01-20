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

class icd10Controller extends Controller
{




    public function show($id){
        $this->$id($id);
        // return view("test");
    }


    public function gi001($id){
        $arr['Esophagus'][0]['name'] = "Achalasia";
        $arr['Esophagus'][0]['code'] = "K220";
        $arr['Esophagus'][1]['name'] = "CA Esophagus";
        $arr['Esophagus'][1]['code'] = "C159";
        $arr['Esophagus'][2]['name'] = "Corrosion of Esophagus";
        $arr['Esophagus'][2]['code'] = "T286";
        $arr['Esophagus'][3]['name'] = "Esophagitis";
        $arr['Esophagus'][3]['code'] = "K20";
        $arr['Esophagus'][4]['name'] = "Esophageal ulcer";
        $arr['Esophagus'][4]['code'] = "K221";
        $arr['Esophagus'][5]['name'] = "Esophageal obstruction";
        $arr['Esophagus'][5]['code'] = "K222";
        $arr['Esophagus'][6]['name'] = "EV with Bleeding";
        $arr['Esophagus'][6]['code'] = "I85";
        $arr['Esophagus'][6]['name'] = "EV without Bleeding";
        $arr['Esophagus'][6]['code'] = "I859";
        $arr['Esophagus'][7]['name'] = "Foreign body in esophagus";
        $arr['Esophagus'][7]['code'] = "T181";
        $arr['Esophagus'][8]['name'] = "GERD with esophagitis";
        $arr['Esophagus'][8]['code'] = "K210";
        $arr['Esophagus'][9]['name'] = "GERD without esophagitis";
        $arr['Esophagus'][9]['code'] = "K219";
        $arr['Esophagus'][10]['name'] = "Mallory-Weiss tear";
        $arr['Esophagus'][10]['code'] = "K449";


        $arr['Stomach'][0]['name'] = "Hiatal hernia";
        $arr['Stomach'][0]['code'] = "K226";
        $arr['Stomach'][1]['name'] = "Acute gastritis";
        $arr['Stomach'][1]['code'] = "K291";
        $arr['Stomach'][2]['name'] = "Acute hemorrhage icd gastritis";
        $arr['Stomach'][2]['code'] = "K290";
        $arr['Stomach'][3]['name'] = "Acute GU bleeding";
        $arr['Stomach'][3]['code'] = "K250";
        $arr['Stomach'][4]['name'] = "Acute GU no bleed";
        $arr['Stomach'][4]['code'] = "K253";
        $arr['Stomach'][5]['name'] = "CA stomach";
        $arr['Stomach'][5]['code'] = "C169";
        $arr['Stomach'][6]['name'] = "Chronic gastritis";
        $arr['Stomach'][6]['code'] = "K295";
        $arr['Stomach'][7]['name'] = "Chronic GU bleeding";
        $arr['Stomach'][7]['code'] = "K254";
        $arr['Stomach'][8]['name'] = "Chronic GU no bleed";
        $arr['Stomach'][8]['code'] = "K257";
        $arr['Stomach'][9]['name'] = "Foreign body in stomach";
        $arr['Stomach'][9]['code'] = "T182";
        $arr['Stomach'][10]['name'] = "GAVE";
        $arr['Stomach'][10]['code'] = "K318";
        $arr['Stomach'][11]['name'] = "Gastric varices";
        $arr['Stomach'][11]['code'] = "I864";
        $arr['Stomach'][12]['name'] = "Gastric polyp";
        $arr['Stomach'][12]['code'] = "K317";
        $arr['Stomach'][13]['name'] = "PHG";
        $arr['Stomach'][13]['code'] = "K766";
        $arr['Stomach'][14]['name'] = "Pyloric stenosis";
        $arr['Stomach'][14]['code'] = "K311";
        $arr['Stomach'][15]['name'] = "Helicobacter pylori";
        $arr['Stomach'][15]['code'] = "B980";

        $arr['Duodenum'][0]['name'] = "Acute DU bleeding";
        $arr['Duodenum'][0]['code'] = "K260";
        $arr['Duodenum'][1]['name'] = "Acute DU no bleed";
        $arr['Duodenum'][1]['code'] = "K263";
        $arr['Duodenum'][2]['name'] = "Chronic DU bleeding";
        $arr['Duodenum'][2]['code'] = "K264";
        $arr['Duodenum'][3]['name'] = "Chronic DU no bleed";
        $arr['Duodenum'][3]['code'] = "K267";
        $arr['Duodenum'][4]['name'] = "Duodenitis";
        $arr['Duodenum'][4]['code'] = "K298";
        $arr['Duodenum'][5]['name'] = "Duodenal polyp";
        $arr['Duodenum'][5]['code'] = "K317";
        $arr['Duodenum'][6]['name'] = "Duodenal obstruction";
        $arr['Duodenum'][6]['code'] = "K315";
        $arr['Duodenum'][7]['name'] = "Dieulafoy's bleeding (stomach)";
        $arr['Duodenum'][7]['code'] = "K250";
        $arr['Duodenum'][8]['name'] = "Dieulafoy's bleeding (duodenum)";
        $arr['Duodenum'][8]['code'] = "K26";
        $arr['Duodenum'][9]['name'] = "Atrophic gastritis";
        $arr['Duodenum'][9]['code'] = "K294";
        $arr['Duodenum'][10]['name'] = "Small bowel ulcer";
        $arr['Duodenum'][10]['code'] = "K633";

        $val['icd10'] = $arr;
        Mongo::table("tb_procedure")->where("code", $id)->update($val);

    }
    public function gi002($id){
        $arr['Cecum'][0]['name'] = "CA Cecum";
        $arr['Cecum'][0]['code'] = "C180";

        $arr['Colon'][0]['name'] = "Angiodysplasia of Colon";
        $arr['Colon'][0]['code'] = "K552";
        $arr['Colon'][1]['name'] = "Diverticulitis/Diverticulosis/Diverticulum";
        $arr['Colon'][1]['code'] = "K573";
        $arr['Colon'][2]['name'] = "CA colon";
        $arr['Colon'][2]['code'] = "C189";
        $arr['Colon'][3]['name'] = "Colitis";
        $arr['Colon'][3]['code'] = "K529";
        $arr['Colon'][4]['name'] = "Colonic polyp";
        $arr['Colon'][4]['code'] = "K635";
        $arr['Colon'][5]['name'] = "Foreign body in colon";
        $arr['Colon'][5]['code'] = "I184";


        $arr['Rectum'][0]['name'] = "Rectal polyp";
        $arr['Rectum'][0]['code'] = "K621";
        $arr['Rectum'][1]['name'] = "Rectal ulcer";
        $arr['Rectum'][1]['code'] = "K626";
        $arr['Rectum'][2]['name'] = "CA Rectum";
        $arr['Rectum'][2]['code'] = "C20";
        $arr['Rectum'][3]['name'] = "Radiation proctitis";
        $arr['Rectum'][3]['code'] = "K627";
        $arr['Rectum'][4]['name'] = "Foreign body in rectum";
        $arr['Rectum'][4]['code'] = "I844";
        $arr['Rectum'][5]['name'] = "Hemorrhagic rectal ulcer";
        $arr['Rectum'][5]['code'] = "K625";

        $arr['Anus'][0]['name'] = "Anal polyp";
        $arr['Anus'][0]['code'] = "K620";
        $arr['Anus'][1]['name'] = "Internal hemorrhoids without complication";
        $arr['Anus'][1]['code'] = "I842";
        $arr['Anus'][2]['name'] = "External hemorrhoids without complication";
        $arr['Anus'][2]['code'] = "I841";
        $arr['Anus'][3]['name'] = "External hemorrhoids with complications";
        $arr['Anus'][3]['code'] = "I845";
        $arr['Anus'][4]['name'] = "Foreign body in anus";
        $arr['Anus'][4]['code'] = "T185";

        $val['icd10'] = $arr;
        Mongo::table("tb_procedure")->where("code", $id)->update($val);

    }
    public function gi003($id){
        $arr['CBD'][0]['name'] = "Gall stone w Cholecystitis";
        $arr['CBD'][0]['code'] = "K800";
        $arr['CBD'][1]['name'] = "CBD stone w cholangitis";
        $arr['CBD'][1]['code'] = "K803";
        $arr['CBD'][2]['name'] = "CBD stone w/o cholangitis";
        $arr['CBD'][2]['code'] = "K805";
        $arr['CBD'][3]['name'] = "CBD obstruction";
        $arr['CBD'][3]['code'] = "K831";
        $arr['CBD'][4]['name'] = "CBD perforation";
        $arr['CBD'][4]['code'] = "K832";
        $arr['CBD'][5]['name'] = "CBD fistula";
        $arr['CBD'][5]['code'] = "K833";
        $arr['CBD'][6]['name'] = "CBD Cyst";
        $arr['CBD'][6]['code'] = "K835";
        $arr['CBD'][7]['name'] = "Choledochal cyst";
        $arr['CBD'][7]['code'] = "Q444";
        $arr['CBD'][8]['name'] = "CA Gall bladder";
        $arr['CBD'][8]['code'] = "C23";
        $arr['CBD'][9]['name'] = "CA CBD";
        $arr['CBD'][9]['code'] = "C24";
        $arr['CBD'][10]['name'] = "CA Ampulla";
        $arr['CBD'][10]['code'] = "C241";
        $arr['CBD'][11]['name'] = "Cholangio Carcinoma";
        $arr['CBD'][11]['code'] = "C221";
        $arr['CBD'][12]['name'] = "Cholangitis";
        $arr['CBD'][12]['code'] = "K830";
        $arr['CBD'][13]['name'] = "Injury of bilc duct";
        $arr['CBD'][13]['code'] = "S361";
        $arr['CBD'][14]['name'] = "CBD mass";
        $arr['CBD'][14]['code'] = "D135";

        $arr['Pancrease'][0]['name'] = "CA Pancrease";
        $arr['Pancrease'][0]['code'] = "C25";
        $arr['Pancrease'][1]['name'] = "Ac. Pancreatitis";
        $arr['Pancrease'][1]['code'] = "K85";
        $arr['Pancrease'][2]['name'] = "Alcohol pancreatitis";
        $arr['Pancrease'][2]['code'] = "KS60";
        $arr['Pancrease'][3]['name'] = "Chronic pancreatitis";
        $arr['Pancrease'][3]['code'] = "KS61";
        $arr['Pancrease'][4]['name'] = "Cyst of pancrease";
        $arr['Pancrease'][4]['code'] = "KS62";
        $arr['Pancrease'][5]['name'] = "Pscudocyst of pancrease";
        $arr['Pancrease'][5]['code'] = "KS63";
        $arr['Pancrease'][6]['name'] = "Pancrease mass";
        $arr['Pancrease'][6]['code'] = "D136";

        $val['icd10'] = $arr;
        Mongo::table("tb_procedure")->where("code", $id)->update($val);

    }
    public function gi002s1($id){
        $arr['Colon'][0]['name'] = "Angiodysplasia of Colon";
        $arr['Colon'][0]['code'] = "K552";
        $arr['Colon'][1]['name'] = "Diverticulitis/Diverticulosis/Diverticulum";
        $arr['Colon'][1]['code'] = "K573";
        $arr['Colon'][2]['name'] = "CA colon";
        $arr['Colon'][2]['code'] = "C189";
        $arr['Colon'][3]['name'] = "Colitis";
        $arr['Colon'][3]['code'] = "K529";
        $arr['Colon'][4]['name'] = "Colonic polyp";
        $arr['Colon'][4]['code'] = "K635";
        $arr['Colon'][5]['name'] = "Foreign body in colon";
        $arr['Colon'][5]['code'] = "I184";


        $arr['Rectum'][0]['name'] = "Rectal polyp";
        $arr['Rectum'][0]['code'] = "K621";
        $arr['Rectum'][1]['name'] = "Rectal ulcer";
        $arr['Rectum'][1]['code'] = "K626";
        $arr['Rectum'][2]['name'] = "CA Rectum";
        $arr['Rectum'][2]['code'] = "C20";
        $arr['Rectum'][3]['name'] = "Radiation proctitis";
        $arr['Rectum'][3]['code'] = "K627";
        $arr['Rectum'][4]['name'] = "Foreign body in rectum";
        $arr['Rectum'][4]['code'] = "I844";
        $arr['Rectum'][5]['name'] = "Hemorrhagic rectal ulcer";
        $arr['Rectum'][5]['code'] = "K625";

        $arr['Anus'][0]['name'] = "Anal polyp";
        $arr['Anus'][0]['code'] = "K620";
        $arr['Anus'][1]['name'] = "Internal hemorrhoids without complication";
        $arr['Anus'][1]['code'] = "I842";
        $arr['Anus'][2]['name'] = "External hemorrhoids without complication";
        $arr['Anus'][2]['code'] = "I841";
        $arr['Anus'][3]['name'] = "External hemorrhoids with complicationss";
        $arr['Anus'][3]['code'] = "I845";

        $val['icd10'] = $arr;
        Mongo::table("tb_procedure")->where("code", $id)->update($val);

    }











}
