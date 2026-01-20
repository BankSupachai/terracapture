<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use PDF;
use Image;
use Carbon\Carbon;
use App\Models\Datacase;
use App\Models\Mongo;
use App\Models\casemedication;

class PDFController extends Controller
{
    public function index(Request $r)
    {

        $id = $r->id;
        $val['casedata']            = Datacase::first($id);
        @$apppoint                   = explode(" ",$val['casedata']->appointment);
        $val['folderdate']          = $apppoint[0];
        $val['hospital']            = get_hospital();
        $val['patient']             = (object) Mongo::table("tb_patient")->where("hn",@$val['casedata']->case_hn)->first();
        $val['procedure']           = (object) Mongo::table("tb_procedure")->where("code",@$val['casedata']->case_procedurecode)->first();
        $str                        = file_get_contents("D:/laragon/htdocs/config/project/admin.txt");
        $connection                 = jsonDecode($str);
        $val['img_first']           = 8;
        $val['tb_casemedication']   = CASEMEDICATION::checkdata($val['casedata'], '');
        if(isset($connection->pdf_img)){$val['img_first'] = $connection->pdf_img;}
        $val['body_line']        = '8px';
        $val    = $this->totaltime($val);
        $val    = $this->scopeall($val);
        $val    = $this->photoselect($val);
        $val    = $this->pic_draw($val);
        $val    = $this->check_typepdf($val,$r);
        if($val['type']=="procedure")           {$val = $this->procedure($val);}
        if($val['type']=="pdf_picturebottom")   {$val = $this->pdf_picturebottom($val);}
        if($val['type']=="no_writing")          {$val = $this->no_writing($val);}
        if($val['type']=="long_writing")        {$val = $this->long_writing($val);}
        if($val['type']=="long_image")          {$val = $this->long_image($val);}
        if($val['type']=="drawing")             {$val = $this->drawing($val);}
        if($val['type']=="pathology")           {$val = $this->pathology($val);}
        if($val['type']=="discharge")           {$val = $this->discharge($val);}
        if($val['type']=="accessory")           {$val = $this->accessory($val);}
        $val    = $this->onepage($val);
        $val    = $this->html($val);


        // dd("mfdfsd");

        $namefile = @$val['casedata']->case_hn."_".date('Ymd')."_".@$val['procedure']->name.".pdf";
        $pdf            = PDF::loadHtml($val['html']);
        $pdf->add_info('Title', "$namefile");
        $this->savepdf($val,$pdf,$r);
        return $pdf->stream($namefile);
    }

    public function pdfendosmart(Request $r){
        $view   = "Recorder.pdf.index";
        $pdf    = PDF::loadView($view,$r);
        return @$pdf->stream();
    }



    public function show($id,Request $r){
        if($id=="endosmart"){
            $view   = "endocapture.pdf.pdfendosmart";
            $pdf    = PDF::loadView($view,$r);
            return @$pdf->stream();
        }

        $r = (object) array();
        $r->type                    = "procedure";
        $val['tb_case']             = DB::table('tb_case')->where('case_id',$id)->first();
        $apppoint                   = explode(" ",$val['tb_case']->case_dateappointment);
        $val['folderdate']          = $apppoint[0];
        $val['prediagnosis']        = DB::table('prediagnostic')->get();
        $val['operationcysto']      = DB::table('operation_cysto')->get();
        $val['hospital']            = DB::table('hospital')->first();
        $val['doctor01']            = DB::table('tb_case as tc')->join('users as u', 'tc.case_physicians01', 'u.id')->where('tc.case_id', '=', $id)->first();
        $val['casedata']            = DB::table('tb_case')
        ->join('patient', 'tb_case.case_hn','patient.hn')
        ->join('dd_gender', 'patient.gender','dd_gender.gender_id')
        ->join('tb_procedure', 'tb_case.case_procedurecode', 'tb_procedure.procedure_code')
        ->where('case_id', $id)
        ->first();

        $val['pdfshow']             = jsonDecode($val['casedata']->procedure_pdfshow);
        $val['pdfshownew']          = jsonDecode($val['casedata']->procedure_pdfshownew);
        $val['json']                = jsonDecode($val['casedata']->case_json);
        $val['body_line']        = '8px';

        $val    = $this->staffname($val);
        $val    = $this->totaltime($val);
        $val    = $this->scopeall($val);
        $val    = $this->photoselect($val);
        $val    = $this->pic_draw($val);
        $val    = $this->check_typepdf($val,$r);

        if($val['type'] == "procedure")           {$val = $this->procedure($val);}
        if($val['type'] == "pdf_picturebottom")   {$val = $this->pdf_picturebottom($val);}
        if($val['type'] == "long_writing")        {$val = $this->long_writing($val);}
        if($val['type'] == "long_image")          {$val = $this->long_image($val);}
        if($val['type'] == "drawing")             {$val = $this->drawing($val);}
        if($val['type'] == "pathology")           {$val = $this->pathology($val);}
        if($val['type'] == "discharge")           {$val = $this->discharge($val);}
        if($val['type'] != "accessory")           {}
        if($val['type'] == "accessory")           {$val = $this->accessory($val);}

        $val    = $this->onepage($val);
        $val    = $this->html($val);

        echo $val['html'];

    }

    public function savepdf($val,$pdf,$r){

        if(!isset($r->savepdf)){return "";}
        $tb_case    = (object) $val['casedata'];
        $cid        = $tb_case->_id;
        $folderdate = $val['folderdate'];
        $hn         = isset($tb_case->case_hn) ? $tb_case->case_hn : $tb_case->hn;
        $content    = $pdf->Output();
        $datetime   = date('YmdHis');
        $pdfversion = $hn.'_'.$datetime.'.pdf';

        makedirfull(htdocs("store/$hn/$folderdate/pdf"));
        if(isset($tb_case->pdfcreate)){
            if(!$tb_case->pdfcreate){
                keepLOGeditreport($cid,$pdfversion);
                file_put_contents(htdocs("store/$hn/$folderdate/pdf/$pdfversion"), $content);
            }
        }
        $arr['pdfcreate']   = true;
        Mongo::table('tb_case')->where('_id',$cid)->update($arr);
        // $mydir = "z:\\";
        // if(file_exists($mydir)){
        //     file_put_contents($mydir.$hn."_".$tb_case->caseuniq.'.pdf', $content);
        // }
    }


    // public function savepdf($val,$pdf){
    //     dd($val, $pdf);
    //     $tb_case    = $val['tb_case'];
    //     $cid        = $tb_case->case_id;
    //     $json       = $val['json'];
    //     $folderdate = $val['folderdate'];
    //     $hn         = $tb_case->case_hn;
    //     $content    = $pdf->Output();
    //     $datetime   = date('YmdHis');
    //     $pdfversion = $tb_case->case_hn.'_'.$datetime.'.pdf';

    //     makedir(htdocs("store/$hn/$folderdate"));
    //     makedir(htdocs("store/$hn/$folderdate/pdf"));

    //     if(isset($json->pdfcreate)){
    //         if(!$json->pdfcreate){
    //             keepLOGeditreport($cid,$pdfversion);
    //             file_put_contents(htdocs("store/$hn/$folderdate/pdf/$pdfversion"), $content);
    //         }
    //     }else{
    //         keepLOGeditreport($cid,$pdfversion);
    //         file_put_contents(htdocs("store/$hn/$folderdate/pdf/$pdfversion"), $content);
    //     }

    //     $json->pdfcreate    = true;
    //     $arr['case_json']   = jsonEncode($json);
    //     DB::table('tb_case')->where('case_id',$tb_case->case_id)->update($arr);


    //     $mydir = "z:\\";
    //     if(file_exists($mydir)){
    //         file_put_contents($mydir.$hn."_".$tb_case->caseuniq.'.pdf', $content);
    //     }
    // }

    public function html($val){
        $val['html'] = '';
        $view = view($val['view'])->with($val);
        $val['html'] .= $view->render();
        $view = view($val['view2'])->with($val);
        $val['html'] .= $view->render();
        return $val;
    }



    public function pic_draw($val){
        $procedure_pic      = $this->change_procedure_pic($val);

        $hn                 = @$val['casedata']->case_hn."";
        $folderdate         = $val['folderdate'];
        // $procedure_picori   = fileconfig("procedure/".@$val['casedata']->procedure_pic);
        $procedure_picori   = fileconfig("procedure/".@$procedure_pic.".jpg");
        $folder_hnpath      = htdocs("store/$hn/$folderdate/");
        $procedure_piccopy  = $folder_hnpath.@$val['casedata']->caseuniq.".jpg";
        $val['pic_draw']    = @$val['casedata']->caseuniq.".jpg";

        makedir($folder_hnpath);
        if(!file_exists($procedure_piccopy)){copy($procedure_picori,$procedure_piccopy);}
        return $val;
    }

    public function change_procedure_pic($val){
        $procedure_pic      = isset($val['casedata']->procedure_pic) ? $val['casedata']->procedure_pic : $val['casedata']->procedurename;
        $procedure_pic      = str_replace(' ', '_', $procedure_pic);
        return $procedure_pic;
    }

    public function photoselect($val){
        $case_photo         = @$val['casedata']->photo;
        $val['photoselect'] = array();
        foreach(isset($case_photo)?$case_photo:array() as $photo){
            $photo = (object) $photo;
            if(isset($photo->ns)){
                if($photo->ns>0 && $photo->st!=10){
                    $val['photoselect'][$photo->ns]['nu'] = $photo->nu;
                    $val['photoselect'][$photo->ns]['ns'] = $photo->ns;
                    $val['photoselect'][$photo->ns]['na'] = $photo->na;
                    $val['photoselect'][$photo->ns]['sc'] = $photo->sc;
                    $val['photoselect'][$photo->ns]['st'] = $photo->st;
                    $val['photoselect'][$photo->ns]['tx'] = $photo->tx;
                }
            }
        }
        ksort($val['photoselect']);
        return $val;
    }
    public function accessory($val){
        if(getCONFIG('pdf')->pdf_procedure_pic=="true"){
            $val['showprocedure']   = true;
            $val['num1']            = 7;    //8 จำนวนรูปที่แสดงในหน้าแรก
            $val['num2']            = 8;    //9 จำนวนรูปที่แสดงในหน
        }else{
            $val['showprocedure']   = false;
            $val['num1']            = 8;    //8 จำนวนรูปที่แสดงในหน้าแรก
            $val['num2']            = 9;    //9 จำนวนรูปที่แสดงในหน
        }

        $val['size_page']           = '50%';
        $val['right_page']          = '48%';
        $val['position']            = 1;
        $val['picperrow']           = 4;
        $val['right_page']          = '65%';
        $val['showprocedure']       = true;
        $val['num1']                = 1000;    //8 จำนวนรูปที่แสดงในหน้าแรก
        $val['num2']                = 1000;    //9 จำนวนรูปที่แสดงในหน
        $val['view']                = "endocapture.pdf.page_accessory";
        $val['view2']               = "endocapture.pdf.pdf_procedure_page2";
        $val['leftpagewidth']       =  "360px";
        $val['num3']                = 1000;
        $val['picperpage']          = 1000;
        return $val;
    }
    public function procedure($val){
        $val['size_page']       = '50%';
        $val['right_page']      = '48%';
        $val['position']        = 1;
        if(getCONFIG('pdf')->pdf_procedure_pic=="true"){
            $val['showprocedure']   = true;
            $val['num1']        = 7;    //8 จำนวนรูปที่แสดงในหน้าแรก
            $val['num2']        = 8;    //9 จำนวนรูปที่แสดงในหน
        }else{
            $val['showprocedure']   = false;
            $val['num1']        = 8;    //8 จำนวนรูปที่แสดงในหน้าแรก
            $val['num2']        = 9;    //9 จำนวนรูปที่แสดงในหน
        }
        $val['picperrow']       = configTYPE("pdf","pagetwo");
        $val['view']            = "endocapture.pdf.page_start";
        $val['view2']           = "endocapture.pdf.pdf_procedure_page2";
        $val['leftpagewidth']   =  "360px";
        $val['num3']        = 15;
        $val['picperpage']  = 16;
        return $val;
    }

    public function pdf_picturebottom($val){
        if(getCONFIG('pdf')->pdf_procedure_pic=="true"){
            $val['showprocedure']   = true;
        }else{
            $val['showprocedure']   = false;
        }
        if($val['showprocedure']){
            $val['num1']            = $val['img_first'];    //8 จำนวนรูปที่แสดงในหน้าแรก
            $val['num2']            = $val['img_first'];    //9 จำนวนรูปที่แสดงในหน
        }else{
            $val['num1']            = $val['img_first'];    //8 จำนวนรูปที่แสดงในหน้าแรก
            $val['num2']            = $val['img_first'];    //9 จำนวนรูปที่แสดงในหน
        }
        $val['size_page']           = '50%';
        $val['right_page']          = '48%';
        $val['position']            = 1;
        $val['picperrow']           = configTYPE("pdf","pagetwo");
        $val['right_page']          = '65%';
        $val['showprocedure']       = true;
        $val['num1']                = 1000;    //8 จำนวนรูปที่แสดงในหน้าแรก
        $val['num2']                = 1000;    //9 จำนวนรูปที่แสดงในหน
        $val['view']                = "endocapture.pdf.page_new";
        $val['view2']               = "endocapture.pdf.pdf_procedure_page2";
        $val['leftpagewidth']       = "360px";
        $val['num3']                = 1000;
        $val['picperpage']          = 1000;
        return $val;
    }

    public function no_writing($val){
        if(getCONFIG('pdf')->pdf_procedure_pic=="true"){
            $val['showprocedure']   = true;
        }else{
            $val['showprocedure']   = false;
        }
        if($val['showprocedure']){
            $val['num1']            = $val['img_first'];    //8 จำนวนรูปที่แสดงในหน้าแรก
            $val['num2']            = $val['img_first'];    //9 จำนวนรูปที่แสดงในหน
        }else{
            $val['num1']            = $val['img_first'];    //8 จำนวนรูปที่แสดงในหน้าแรก
            $val['num2']            = $val['img_first'];    //9 จำนวนรูปที่แสดงในหน
        }
        $val['size_page']           = '50%';
        $val['right_page']          = '48%';
        $val['position']            = 1;
        $val['picperrow']           = configTYPE("pdf","pagetwo");
        $val['right_page']          = '65%';
        $val['showprocedure']       = true;
        $val['num1']                = 1000;    //8 จำนวนรูปที่แสดงในหน้าแรก
        $val['num2']                = 1000;    //9 จำนวนรูปที่แสดงในหน
        $val['view']                = "endocapture.pdf.page_no";
        $val['view2']               = "endocapture.pdf.pdf_procedure_page2";
        $val['leftpagewidth']       = "360px";
        $val['num3']                = 1000;
        $val['picperpage']          = 1000;
        return $val;
    }




    public function long_writing($val){
        $val['size_page']   = '10%';
        $val['right_page']  = '72%';
        $val['position']    = 1;
        $val['view']        = "endocapture.pdf.page_start";
        $val['view2']       = "endocapture.pdf.pdf_procedure_page2";
        $val['leftpagewidth']   =  "550px";

        if(getCONFIG('pdf')->pdf_procedure_pic=="true"){
            $val['showprocedure']   = true;
        }else{
            $val['showprocedure']   = false;
        }

        $val['picperrow']     = configTYPE("pdf","pagetwo");

        if($val['showprocedure']){
            $val['num1']    = $val['img_first']/2;    //8 จำนวนรูปที่แสดงในหน้าแรก
            $val['num2']    = $val['img_first']/2;    //9 จำนวนรูปที่แสดงในหน
        }else{
            if($val['img_first']!=0){
                $val['img_first'] = ($val['img_first']/2)+1;
            }
            $val['num1']    = $val['img_first'];    //8 จำนวนรูปที่แสดงในหน้าแรก
            $val['num2']    = $val['img_first'];    //9 จำนวนรูปที่แสดงในหน
        }

        $val['num3']        = 1000; //
        $val['picperpage']  = 1000;
        return $val;
    }

    public function long_image($val){
        $val['size_page']   = '50%';
        $val['right_page']  = '50%';
        $val['position']    = 2;
        $val['view']        = "endocapture.pdf.page_start";
        $val['view2']       = "endocapture.pdf.pdf_procedure_page2";
        $val['leftpagewidth']   =  "360px";

        if(getCONFIG('pdf')->pdf_procedure_pic=="true"){
            $val['showprocedure']   = true;
        }else{
            $val['showprocedure']   = false;
        }


        $val['picperrow']   = configTYPE("pdf","pagetwo");
        $val['num1']        = 0; //7
        $val['num2']        = 0; //8
        $val['num3']        = 8; //
        $val['picperpage']  = 9;
        if($val['img_first']!=0){
            $val['num1'] = ($val['img_first']/2)-1;
            $val['num2'] = ($val['img_first']/2);
        }
        return $val;
    }

    public function drawing($val){
        $val['size_page']   = '60%';
        $val['right_page']  = '53%';
        $val['position']    = 2;
        $val['view']        = "endocapture.pdf.page_start";
        $val['view2']       = "endocapture.pdf.pdf_procedure_page2";
        $val['leftpagewidth']   =  "360px";

        if(getCONFIG('pdf')->pdf_procedure_pic=="true"){
            $val['showprocedure']   = true;
        }else{
            $val['showprocedure']   = false;
        }

        $val['picperrow']   = configTYPE("pdf","pagetwo");
        $val['num1']        = 0; //7
        $val['num2']        = 0; //8
        $val['num3']        = 8; //
        $val['picperpage']  = 9;
        if($val['img_first']!=0){
            $val['num1'] = ($val['img_first']/2);
            $val['num2'] = ($val['img_first']/2)+1;
        }
        return $val;
    }

    public function pathology($val){
        $val['size_page']   = '50%';
        $val['right_page']  = '50%';
        $val['position']    = 2;
        $val['leftpagewidth']   =  "360px";

        if(getCONFIG('pdf')->pdf_procedure_pic=="true"){
            $val['showprocedure']   = true;
        }else{
            $val['showprocedure']   = false;
        }

        $val['picperrow']     = configTYPE("pdf","pagetwo");

        $val['num1']        = 8;
        $val['num2']        = 9;
        $val['num3']        = 8;
        $val['picperpage']  = 16;
        $val['view']        = "pdf.pdf_pathology";
        $val['view2']       = "pdf.pdf_pathology_page2";
        return $val;
    }

    public function discharge($val){
        $val['size_page']   = '50%';
        $val['right_page']  = '50%';
        $val['position']    = 2;
        $val['leftpagewidth']   =  "width:10cm;";

        if(getCONFIG('pdf')->pdf_procedure_pic=="true"){
            $val['showprocedure']   = true;
        }else{
            $val['showprocedure']   = false;
        }
        $val['picperrow']   = configTYPE("pdf","pagetwo");
        $val['view']        = "pdf.pdf_discharge";
        $val['view2']       = "pdf.pdf_discharge_page2";
        $val['num1']        = 4; //7
        $val['num2']        = 5; //8
        $val['num3']        = 8; //
        $val['picperpage']  = 16;
        return $val;
    }

    public function onepage($val){
        $countrow =count($val['photoselect']);
        $val['num'] = ceil(($countrow - $val['num1']) / $val['picperpage']);

        $val['pagecurrent'] = 1;
        $val['pageall'] = $val['num'] + 1;

        if($val['num']==0){
            $val['onepage'] = true;
        }else{
            $val['onepage'] = false;
        }
        return $val;
    }

    public function check_typepdf($val,$r){
        if(isset($r->type)){
            $val['type'] = $r->type;
        }else{
            if(getCONFIG('pdf')->pdf_default=="auto"){
                // Calculate auto type PDF
                $val = $this->cal_pdf_type($val);
            }else{
                // Fix type PDF
                $val['type'] = getCONFIG('pdf')->pdf_default;
            }
        }
        return $val;
    }


    public function cal_pdf_type($val){
        $procedure_pic      = $this->change_procedure_pic($val);
        $val['tb_case']     = $val['casedata'];

        $count = count($val['photoselect']);
        if($count < 5){
            $val['type'] = "long_writing";
        }else{
            $val['type'] = "procedure";
        }
        //drawing
        // $procedure_picori   = fileconfig("procedure/".$val['casedata']->procedure_pic);
        $procedure_picori   = fileconfig("procedure/".$procedure_pic.'.jpg');
        $folder_hnpath      = storePATH($val['tb_case']->case_hn."/".$val['folderdate'].'/');
        $procedure_piccopy  = $folder_hnpath.$val['tb_case']->caseuniq.".jpg";
        $val['pic_draw']    = $val['tb_case']->caseuniq.".jpg";

        makedir($folder_hnpath);

        if(!file_exists($procedure_piccopy)){copy($procedure_picori,$procedure_piccopy);}
        $ori    = Image::make($procedure_picori);
        $end    = Image::make($procedure_piccopy);
        if($ori->filesize()!=$end->filesize()){
            $val['type'] = "drawing";
        }

        //long_image
        foreach($val['photoselect'] as $data=>$photo){
            if($photo['ns']>0){
                try {
                    $width  = Image::make(mePHOTO($val['tb_case']->case_hn,$photo['na'],$val['folderdate']))->width();
                    $height = Image::make(mePHOTO($val['tb_case']->case_hn,$photo['na'],$val['folderdate']))->height();
                    if($width>($height*2)){
                        $val['type'] = "long_image";
                    }
                } catch(\Throwable $e) {}
            }
        }
        return $val;
    }



    public function staffname($val){
        $val['doctor'][2]       = $this->checkUSERNULL(@$val['json']->physicians02);
        $val['doctor'][3]       = $this->checkUSERNULL(@$val['json']->physicians03);
        $val['doctor'][4]       = $this->checkUSERNULL(@$val['json']->physicians04);
        $val['nurse'][1]        = $this->checkUSERNULL(@$val['json']->nurse01);
        $val['nurse'][2]        = $this->checkUSERNULL(@$val['json']->nurse02);
        $val['nurse'][3]        = $this->checkUSERNULL(@$val['json']->nurse03);
        $val['nurse'][4]        = $this->checkUSERNULL(@$val['json']->nurse04);
        $val['nurse_anes'][1]   = $this->checkUSERNULL(@$val['json']->nurse_anes01);
        $val['nurse_anes'][2]   = $this->checkUSERNULL(@$val['json']->nurse_anes02);
        return $val;
    }

    public function checkUSERNULL($uid){
        $user   = DB::table('users')->where('id',$uid)->first();
        $str    = "";
        if($user!=null){
            $str.= $user->user_prefix;
            $str.= $user->user_firstname." ";
            $str.= $user->user_lastname;
        }
        return $str;
    }

    public function totaltime($val){
        $val['totaltime'] = ' - ';
        if(isset($val['json']->time_start) && isset($val['json']->time_finish)){
            $val['totaltime'] = $val['json']->time_start." - ".$val['json']->time_finish;
            $start      = new Carbon($val['json']->time_start);
            $end        = new Carbon($val['json']->time_finish);
            $toltal     = Carbon::parse($start)->diffInMinutes($end);
            $val['totaltime'] .= " [".$toltal."] นาที";
        }
        return $val;
    }

    public function scopeall($val){
        $val['scopeall'] = array();
        if(isset($val['json']->endoscope)){
            foreach($val['json']->endoscope as $endoscope){
                $tb_scope = DB::table('tb_scope')->where('scope_id',$endoscope)->first();
                if(isset($tb_scope->scope_name)){
                    $val['scopeall'][]=$tb_scope->scope_name;
                }
            }
        }
        return $val;
    }


}
