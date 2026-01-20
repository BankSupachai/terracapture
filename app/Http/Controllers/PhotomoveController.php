<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Datacase;
use App\Models\Mongo;
use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Image;

class PhotomoveController extends Controller
{
    public function show(Request $r, $id){
        $today              = date('Y-m-d');
        $view['tb_case']    = (object) Mongo::table('tb_case')
                                ->where('_id','!=',$id)
                                ->where('case_hn','!=','vip')

                                ->where('statusjob', '!=','delete')
                                ->where('statusjob', '!=', 'cancel')
                                ->limit(1000)
                                ->orderBy('appointment_date','desc')
                                ->get()
                                ;




        $view['doctors']    = $this->get_doctors($view['tb_case']);
        $view['procedures'] = $this->get_procedures($view['tb_case']);
        $view["case"]       = (object) Mongo::table('tb_case')->where('_id',$id)->first();
        $appointment        = isset($view['case']->appointment) ? $view['case']->appointment : $view['case']->case_dateappointment;
        $view['folderdate'] = str_contains($appointment, ' ') ? explode(" ", $appointment)[0] : $appointment;
        $view['casejson']   = isset($view['case']->casejson) ? $view['case']->casejson : null;
        $view['photo_all']  = isset($view['case']->photo) ? $view['case']->photo : [];
        $view['cid']        = $id;
        $view['otp']        = rand(1000,9999);
        $view['user_id']    = uid();
        return view('case.component.photo.photomove.index',$view);

    }

    public function get_doctors($cases){
        $arr = [];
        foreach ($cases as $case) {
            $case  = (object) $case;
            $arr[] = $case->doctorname;
        }
        $arr = array_unique($arr);
        return $arr;
    }

    public function get_procedures($procedures){
        $arr = [];
        foreach ($procedures as $proc) {
            $proc  = (object) $proc;
            $arr[] = $proc->procedurename;
        }
        $arr = array_unique($arr);
        return $arr;
    }



    public function photo_move_case($r){

            $cid        = $r->cid;
            $cid_new    = $r->cid_new;
            $hn         = $r->hn;
            $folderdate = $r->folderdate;
            $user_id    = $r->user_id;

            $arr['case_hn'] = $hn;



            if($r->photoname != null){
                foreach($r->photoname as $photo){
                    $img = Image::make(htdocs("store/$hn/$folderdate/backup/$photo"));

                    $ex = explode("_",$photo);
                    $photoname_new = $cid_new."_".$ex[1]."_".$hn."_".$ex[3]."_".@$ex[4];

                    $photoname_new = str_replace($cid,$cid_new,$photo);
                    $img->save(exfolder("ScreenRecord/$photoname_new"));
                    $img->destroy();
                    unlink(htdocs("store/$hn/$folderdate/backup/$photo"));
                    unlink(htdocs("store/$hn/$folderdate/$photo"));

                    $path = htdocs('ScreenRecord')."/$photoname_new";
                    $size = file_exists($path) ? filesize($path) : 0;
                    $arr['path'] = htdocs("store/$hn/$folderdate/$photo");
                    $arr['hn']   = $hn;

                    Photo::logphoto($photoname_new, 'photomove', $size, $arr);
                }
                if(isset($r->photoname)){
                    $photoold_json = jsonEncode($r->photoname);
                }else{
                    $photoold_json = "";
                }

                $tb_case    = Mongo::table('tb_case')->where('_id',$cid)->first();
                $tb_case    = (object) $tb_case;
                $photo_all  = isset($tb_case->photo) ? $tb_case->photo : [];
                $photo_arr  = array();
                $i = 0;
                $e = 1;
                foreach($photo_all as $pho){
                    $pho = (object) $pho;
                    if(!strpos($photoold_json,$pho->na)){
                        $photo_arr[$i]["nu"] = $e;
                        $photo_arr[$i]["ns"] = 0;
                        $photo_arr[$i]["na"] = $pho->na;
                        $photo_arr[$i]["sc"] = $pho->sc;
                        $photo_arr[$i]["st"] = $pho->st;
                        $photo_arr[$i]["tx"] = $pho->tx;
                        $i++;
                        $e++;
                    }
                }
                $val['photo'] = $photo_arr;
                Mongo::table('tb_case')->where('_id',$cid)->update($val);
            }
            $case_old = Mongo::table('tb_case')->where('_id',$cid)->first();
            $case_new = Mongo::table('tb_case')->where('_id',$cid_new)->first();
            $case_old = (object) $case_old;
            $case_new = (object) $case_new;

            createTEMP("tb_case",$case_old->caseuniq,$case_old->comcreate,date("ymdHis"));
            createTEMP("tb_case",$case_new->caseuniq,$case_new->comcreate,date("ymdHis"));
            $js['case_form']        = $case_old->caseuniq;
            $js['case_receive']     = $case_new->caseuniq;
            $js['case_time_do']     = Carbon::now()->format('Y-m-d H:i:s');
            $data['edit_remark']    = @$r->edit_event.'';
            $data['edit_status']    = 1;
            $data['edit_json']      = $js;
            $data['edit_event']     = 'photo move';
            $data['edit_userid']    = $user_id;
            Mongo::table('tb_logedit')->insert($data);

            return redirect("loadpic/$cid");

    }

    public function hn_check($r){
            $patient = Mongo::table('tb_patient')->where('hn',$r->value)->first();
            if($patient!=null){
                echo $patient['prefix']." ".$patient['firstname']." ".$patient['lastname']."#".$patient['hn']."#".$patient['_id'];
            }else{
                echo "false";
            }
    }

    public function markermove($r){
        $w[0]         = array('photo_case', $r->case_id);
        $w[1]         = array('photo_num', $r->ballnumber);
        $v['photo_x'] = $r->positionss[0];
        $v['photo_y'] = $r->positionss[1];
        Mongo::table('photo')->where($w)->update($v);
    }

    public function tags_input($r){
        $mainsub = $r['mainsub'];
        $mp = Mongo::table('tb_mainpartsub')->where('mainpartsub_id','=',$mainsub)->first();
        $mp_id = $mp->mainpartsub_mp_id;
        $value   = $r['value'];
        $valueex = explode("     ", $value);
        foreach ($valueex as $key) {
            $ms = Mongo::table('tb_mainsubgl')
            ->where([
                ['mainsubgl_mp_id','=',$mp_id],
                ['mainsubgl_name','=',$key]
                ])
            ->get();
            $m=count($ms);
            if($key!="" && $mp_id!="0" && $m==0){
                Mongo::table('tb_mainsubgl')->insert([
                    [
                        'mainsubgl_name'=>$key,
                        'mainsubgl_mp_id'=>$mp_id
                    ],
                ]);
            }
        }



        Mongo::table('photo')->where('id','=',$r['photo_id'])->update(['photo_gastrolesion'=>$r['value']]);

        $find = Mongo::table('tb_case')->where('case_id','=',$r['case_id'])->first();

        $acc =array();
        $acc = json_decode($find->finding,true);

        $finding = array();
        $f = explode("     ",$r['value']);
        $i=0;

        foreach ($f as $key) {
            $finding["f".$r['mainsub']][$i]=$key;
            $i++;
        }

        $pg = Mongo::table('photo')->where([
            ['photo_case','=',$r['case_id']],
            ['photo_mainpartsub','=',$r['mainsub']]
        ])->get();


        foreach ($pg as $val) {
            $f = explode("     ",$val->photo_gastrolesion);
            foreach ($f as $key) {
                $finding["f".$r['mainsub']][$i]=$key;
                $i++;
            }
        }

        $finding["f".$r['mainsub']] = array_unique($finding["f".$r['mainsub']]);
        if($acc==null){
            $merge = $finding;
        }else{
            $merge = array_merge($acc,$finding);
        }
        $fjson = jsonEncode($merge);
        Mongo::table('tb_case')->where('case_id','=',$r['case_id'])->update(['finding'=>$fjson]);
    }

    public function search_hn($r){
        if($r->value!=""||$r->value!=null){
            $w[0] = array('hn','like','%'.$r->value.'%');
            $w2[0] = array('firstname','like','%'.$r->value.'%');
        }else{
            $w[0] = array('hn',null);
            $w2[0] = array('firstname','like','%'.$r->value.'%');
        }
        $autotext_hn = Mongo::table('tb_patient')->where($w)->orderby('hn','asc')->get()->toArray();
        $autotext_name = Mongo::table('tb_patient')->where($w2)->orderby('hn','asc')->get()->toArray();
        $arr = array();
        $i=0;
        foreach($autotext_hn as $auto){
            $arr[$i]['name'] = $auto->hn;
            $arr[$i]['value']= $auto->hn;
            $i++;
        }
        foreach($autotext_name as $auto){
            $arr[$i]['name'] = $auto->firstname;
            $arr[$i]['value']= $auto->firstname;
            $i++;
        }
        $json = json_encode($arr);
        echo $json;
    }
    public function store(Request $r){
        if($r->event == "checkconnect")         {echo "true";}
        if($r->event == "photo_move_case")      {$this->photo_move_case($r);return redirect("loadpic/$r->cid");}
        if($r->event == "hn_check")             {$this->hn_check($r);}
        if($r->event == "markermove")           {$this->markermove($r);}
        if($r->event == "tags-input")           {$this->tags_input($r);}
        if($r->event == "search_hn")            {$this->tags_input($r);}




        if ($_POST['event'] == "tags-mainpart") {
            $mainpartid = $_POST['mainpart_id'];
            $value      = $_POST['value'];
            $valueex    = explode($this->blank, $value);

            foreach ($valueex as $key) {
                $strMain = Mongo::table('tb_mainpartsub')
                    ->where('mainpartsub_id', '=', $mainpartid)
                    ->get();
                $num = $strMain[0]->mainpartsub_mp_id;

                $w['mainsubgl_mp_id'] = $num;
                $w['mainsubgl_name']  = $key;
                $strPro               = Mongo::table('tb_mainsubgl')->where($w)->get();
                $count                = count($strPro);

                if ($count == 0 && $key != "") {
                    $v                    = array();
                    $v['mainsubgl_name']  = $key;
                    $v['mainsubgl_mp_id'] = $num;
                    Mongo::table('tb_mainsubgl')->insert($v);
                }
            }

            ///////

            $strCASE = Mongo::table('tb_case')
                ->where('case_id', '=', $_POST['case_id'])
                ->get();

            $acc     = array();
            $acc     = json_decode($strCASE[0]->finding, true);
            $finding = array();
            $f       = explode("     ", $_POST['value']);
            $i       = 0;
            foreach ($f as $key) {
                $finding["f" . $_POST['mainpart_id']][$i] = $key;
                $i++;
            }

            if ($acc == "") {
                $merge = $finding;
            } else {
                $merge = array_merge($acc, $finding);
            }
            $fjson = json_encode($merge, JSON_UNESCAPED_UNICODE);

            $v            = array();
            $v['finding'] = $fjson;
            Mongo::table('tb_case')->where('case_id', '=', $_POST['case_id'])->update($v);
        }

        if ($r->event == "comment-mainpart") {
            $row = Mongo::table('tb_case')->select('finding_comment')->where('case_id', $r->case_id)->first();

            $acc = array();
            $acc = json_decode($row->finding_comment, true);

            $finding = array();
            $f       = explode($this->blank, $r->value);
            $i       = 0;

            foreach ($f as $key) {
                $finding["f" . $r->mainpart_id][$i] = $key;
                $i++;
            }

            //$c=count($acc);
            if ($acc == "") {
                $merge = $finding;
            } else {
                $merge = array_merge($acc, $finding);
            }
            $fjson = json_encode($merge, JSON_UNESCAPED_UNICODE);

            $v                    = array();
            $v['finding_comment'] = $fjson;
            Mongo::table('tb_case')->where('case_id', '=', $r->case_id)->update($v);

        }

        if ($r->event == "change_status") {
            $row     = Mongo::table('photo')->where('id', '=', $r->photo_id)->first();
            $status  = $row->photo_status;
            $photo_x = $row->photo_x;

            if ($status != 1) {$status = 1;} else { $status = 0;}
            if ($photo_x == 0) {$x = 15;} else { $x = $photo_x;}

            $v                 = array();
            $v['photo_status'] = $status;
            $v['photo_x']      = $x;
            Mongo::table('photo')->where('id', '=', $r->photo_id)->update($v);
            echo $status;
        }

        // if ($r->event == "picselect") {

        //     $row        = Mongo::table('photo')->where('id', '=', $r->photo_id)->first();
        //     $status     = $row->photo_select;
        //     $num_select = $row->photo_num_select;

        //     if ($status != 1) {
        //         $status = 1;
        //         $newnum = Mongo::table('photo')->where('photo_case', '=', $r->case_id)->max('photo_num_select');
        //         $newnum++;
        //         $v['photo_num_select'] = $newnum;
        //         Mongo::table('photo')->where('id', '=', $r->photo_id)->update($v);
        //     } else {
        //         $status = 0;

        //         $v                     = array();
        //         $v['photo_num_select'] = 0;
        //         $v['photo_select']     = 0;
        //         Mongo::table('photo')->where('id', '=', $r->photo_id)->update($v);

        //         $w[0]     = array('photo_num_select', '>', $num_select);
        //         $w[1]     = array('photo_case', '=', $r->case_id);
        //         $rowPhoto = Mongo::table('photo')->where($w)->get();

        //         foreach ($rowPhoto as $key) {
        //             $newnum = $key->photo_num_select--;
        //             Mongo::table('photo')->where('id', '=', $key->id)->update(['photo_num_select' => $newnum]);
        //         }
        //     }

        //     $v                 = array();
        //     $v['photo_select'] = $status;
        //     Mongo::table('photo')->where('id', '=', $r->photo_id)->update($v);
        //     echo $status;
        // }

        if($r->event=='save_attendant'){
            $w['_id']          = $r->cid;
            $i['user_in_case'] = $r->val;
            Mongo::table('tb_case')->where($w)->update($i);
        }


        if($r->event=="picselect"){
            // มุมขวาบน
            // $w          = Mongo::table('tb_case')->where('case_id',$r->case_id)->first();
            // $json       = (array) jsonDecode($w->case_photo);
            $photoall   = Datacase::photoALL($r->case_id);

            // dd($photoall);


            $photo      = array();
            $x          = 0;
            $print      = 0;

            $num_condition = (int) $r->selectnum;

            if($num_condition==0){
                $print = (int) $r->innum;
            }

            foreach($photoall as $j){
                $j = (object) $j;
                if(isset($j->nu)){
                    if($j->nu==$r->photo_id){
                        $photo[$x]['nu']  = $j->nu;
                        $photo[$x]['ns']  = $print;
                        $photo[$x]['na']  = $j->na;
                        $photo[$x]['sc']  = $j->sc;
                        $photo[$x]['st']  = $j->st;
                        $photo[$x]['tx']  = $j->tx;
                    }else{
                        $mm = (int) $j->ns;
                        if($mm > $num_condition && $mm!=0 && $num_condition!=0){
                            $number = $mm-1;
                        }else{
                            $number = $mm;
                        }
                        $photo[$x]['nu']  = $j->nu;
                        $photo[$x]['ns']  = $number;
                        $photo[$x]['na']  = $j->na;
                        $photo[$x]['sc']  = $j->sc;
                        $photo[$x]['st']  = $j->st;
                        $photo[$x]['tx']  = $j->tx;
                    }
                    $x++;
                }
            }
            Datacase::dataUPDATE($r->case_id,['photo'=>$photo]);
            echo $print;
        }




        if ($r->event=="photorollback") {
            if(@$r->is_ppic."" == 'true' ){
                $p_name = isset($r->ppic) ? $r->ppic : '';
                copy(htdocs(("config/procedure/$p_name")),htdocs("store/$r->hn/$r->folderdate/$r->photoname"));
            } else {
                copy(htdocs(("store/$r->hn/$r->folderdate/backup/$r->photoname")),htdocs("store/$r->hn/$r->folderdate/$r->photoname"));
            }
        }

        if ($r->event == "change_status_del") {
            $status = Mongo::table('photo')->select('photo_status')->where('id', $r->photo_id)->first();
            $s      = $status->photo_status;
            if ($s != 3) {$s = 3;} else { $s = 0;}
            Mongo::table('photo')->where([['id', $r->photo_id]])->update(['photo_status' => $s]);
            echo $s;
        }


        if ($r->event == "check-esign") {
            $cid        = $r->cid;
            $hn         = $r->hn;
            $folderdate = $r->folderdate;
            $tb_case    = Mongo::table('tb_case')->where('case_id',$cid)->first();
            $caseuniq   = $tb_case->caseuniq;
            $arr        = (array) jsonDecode($tb_case->case_json);

            makedirfull(htdocs("store/$hn/$folderdate"));

            if(!isset($arr['case_edit'])){
                copy("public/images/ori-esign.txt",htdocs("store/$hn/$folderdate/$caseuniq.txt"));
                $arr['case_edit']   = true;
                $json['case_json']  = jsonEncode($arr);
                Mongo::table('tb_case')->where('case_id',$cid)->update($json);
                $check['status'] = "edit_have";
            }else{
                if($arr['case_edit']){
                    copy("public/images/ori-esign.txt",htdocs("store/$hn/$folderdate/$caseuniq.txt"));
                    $check['status'] = "edit_have";
                }else{
                    $check['status'] = "edit_dont";
                }
            }

            $text = jsonEncode($check);
            echo $text;

        }


        if($r->event=='btn-check-esign'){
            $cid        = $r->cid;
            $hn         = $r->hn;
            $folderdate = $r->folderdate;

            $tb_case    = Mongo::table('tb_case')->where('case_id',$cid)->first();
            $caseuniq   = $tb_case->caseuniq;
            $arr        = (array) jsonDecode($tb_case->case_json);

            $file_start = fopen("public/images/ori-esign.txt", "r") or die("Unable to open file!");
            $str_start  = fread($file_start,filesize("public/images/ori-esign.txt"));
            fclose($file_start);

            $file_end   = fopen(htdocs("store/$hn/$folderdate/$caseuniq.txt"), "r") or die("Unable to open file!");
            $str_end    = fread($file_end,filesize(htdocs("store/$hn/$folderdate/$caseuniq.txt")));
            fclose($file_end);
            if($str_start==$str_end){
                $check['status'] = "edit_dont";
            }else{
                $arr['pdfcreate'] = false;
                $arr['case_edit'] = false;
                $val['case_json'] = jsonEncode($arr);
                Mongo::table('tb_case')->where('_id',$cid)->update($val);
                $check['status'] = "edit_have";
            }

            $text = jsonEncode($check);
            echo $text;
        }



        if ($r->event == "create_sign") {
            $cid        = $r->cid;
            $datapic    = $r->datapic;

            $tb_case    = Mongo::table('tb_case')->where('case_id',$cid)->first();
            $caseuniq   = $tb_case->caseuniq;



            $myfile     = fopen(htdocs("store/$r->hn/$r->folderdate/$caseuniq.txt"), "w") or die("Unable to open file!");
            fwrite($myfile, $datapic);
            fclose($myfile);
            echo $r->hn;
        }

        if ($r->event == "create_sign_doctor") {
            $datapic    = $r->datapic;
            $myfile     = fopen(htdocs("config/doctor/temp.txt"), "w") or die("Unable to open file!");
            fwrite($myfile, $datapic);
            fclose($myfile);
            echo $r->user_id;
        }



        if ($r->event == "rollback") {
            Mongo::table('photo')->where([['id', $r->photo_id]])->update(['photo_status' => 0]);
            copy(exfolder("store/$r->hn/backup/$r->photoname"),exfolder("store/$r->hn/$r->photoname"));
        }


        if ($r->event == "cropblack") {

            $status = Mongo::table('photo')->select('photo_status')->where('id', $r->photo_id)->first();

            $name = exfolder("store/$r->hn/backup/$r->photoname");
            if($status->photo_status==10){
                $name = exfolder("store/$r->hn/$r->photoname");
            }

            try {
                $myImage                = imagecreatefromjpeg($name);
                list($width, $height)   = getimagesize($name);
                $scale                  = 0.5;
                $myImageZoom            = imagecreatetruecolor($width * $scale, $height * $scale);
                $c = cropblack($name);
                $left                   = $c[2]; //ลดภาพด้านซ้าย
                $top                    = $c[0]; //ลดภาพด้านบน
                $rigth                  = $c[3]; //ลดภาพด้านขวา
                $bottom                 = $c[1]; //ลดภาพด้านล่าง
                $width                  = $rigth - $left;
                $height                 = $bottom - $top;
                $myImageCrop            = imagecreatetruecolor($width, $height);
                imagecopyresampled($myImageCrop, $myImage, 0, 0, $c[2], $c[0], $c[3], $c[1], $c[3], $c[1]);
                imagejpeg($myImageCrop, exfolder("store/$r->hn/$r->photoname"));
            } catch(\Throwable $e) {

            }


        }



        if ($r->event == "cropblacknew") {
            $name = htdocs("store/$r->hn/$r->folderdate/backup/$r->photoname");
            try {
                $myImage                = imagecreatefromjpeg($name);
                list($width, $height)   = getimagesize($name);
                $scale                  = 0.5;
                $myImageZoom            = imagecreatetruecolor($width * $scale, $height * $scale);
                $c = cropblack($name);
                $left                   = $c[2]; //ลดภาพด้านซ้าย
                $top                    = $c[0]; //ลดภาพด้านบน
                $rigth                  = $c[3]; //ลดภาพด้านขวา
                $bottom                 = $c[1]; //ลดภาพด้านล่าง
                $width                  = $rigth - $left;
                $height                 = $bottom - $top;
                $myImageCrop            = imagecreatetruecolor($width, $height);
                imagecopyresampled($myImageCrop, $myImage, 0, 0, $c[2], $c[0], $c[3], $c[1], $c[3], $c[1]);
                imagejpeg($myImageCrop, htdocs("store/$r->hn/$r->folderdate/$r->photoname"));
            } catch(\Throwable $e) {

            }

            echo "ddd";
        }



        if ($r->event == "writecomment") {
            $w[0]            = array('photo_case', '=', $r->case_id);
            $w[1]            = array('photo_div', '=', $r->number);
            $v['photo_text'] = $r->text;
            Mongo::table('photo')->where($w)->update($v);
        }

        if ($r->event == "drawsave") {
            // echo 'aaaa';
            function base64_to_jpeg($base64_string, $output_file)
            {
                $ifp  = fopen($output_file, 'wb');
                $data = explode(',', $base64_string);
                fwrite($ifp, base64_decode($data[1]));
                fclose($ifp);
                return $output_file;
            }

            $random = rand(1000,9999);

            base64_to_jpeg($r->base64, 'public/imgprocedure/rampic'.$random.'.png');
            $bg_path  = 'public/imgprocedure/' . $r->case_id . '.jpg';
            $num_path = 'public/imgprocedure/rampic'.$random.'.png';
            $image_1  = imagecreatefromjpeg($bg_path);
            $image_2  = imagecreatefrompng($num_path);
            imagecopy($image_1, $image_2, 59, -1, 0, 0, 1300, 700);
            imagejpeg($image_1, 'public/imgprocedure/' . $r->case_id . '.jpg');
        }


        if ($r->event == "drawclear") {
            unlink(htdocs("store/$r->hn/$r->folderdate/$r->picname"));
            $pname = strlen($r->picname);
            if($pname>20){
                $img = Image::make(htdocs("store/$r->hn/$r->folderdate/backup/$r->picname"));
                $img->save(htdocs("store/$r->hn/$r->folderdate/$r->picname"));
                $img->destroy();
                $name = getCONFIG('admin')->store_url."$r->hn/$r->folderdate/backup/$r->picname";
                try {
                    $myImage                = imagecreatefromjpeg($name);
                    list($width, $height)   = getimagesize($name);
                    $scale                  = 0.5;
                    $myImageZoom            = imagecreatetruecolor($width * $scale, $height * $scale);
                    $c = cropblack($name);
                    $left                   = $c[2]; //ลดภาพด้านซ้าย
                    $top                    = $c[0]; //ลดภาพด้านบน
                    $rigth                  = $c[3]; //ลดภาพด้านขวา
                    $bottom                 = $c[1]; //ลดภาพด้านล่าง
                    $width                  = $rigth - $left;
                    $height                 = $bottom - $top;
                    $myImageCrop            = imagecreatetruecolor($width, $height);
                    imagecopyresampled($myImageCrop, $myImage, 0, 0, $c[2], $c[0], $c[3], $c[1], $c[3], $c[1]);
                    imagejpeg($myImageCrop, htdocs("store/$r->hn/$r->folderdate/$r->picname"));
                } catch(\Throwable $e) {}
            }else{
                $img = Image::make("public/images/$r->ppic");
                $img->save(htdocs("store/$r->hn/$r->folderdate/$r->picname"));
                $img->destroy();
            }
        }


        if ($r->event == "drawarrow") {
            $x = $r->offsetX/$r->clientWidth;
            $y = $r->offsetY/$r->clientHeight;
            $photoname = htdocs("store/$r->hn/$r->folderdate/$r->photoname");
            $data = getimagesize($photoname);
            $x_new = (int) round($data[0]*$x,0);
            $y_new = (int) round($data[1]*$y,0);
            $pointer = 'public/images/pointer.png';
            $img = Image::make($photoname);
            $img->insert($pointer,'top-left',$x_new,$y_new);
            $img->save($photoname);
        }


        if ($r->event == "drawedit") {
            $path = htdocs("store/$r->hn/$r->folderdate/");
            function base64_to_jpeg($base64_string, $output_file){
                $ifp  = fopen($output_file, 'wb');
                $data = explode(',', $base64_string);
                fwrite($ifp, base64_decode($data[1]));
                fclose($ifp);
                return $output_file;
            }

            base64_to_jpeg($r->base64, $path.'temp.png');

            $temp_jpg_width = Image::make($path.'temp.jpg')->width();
            $temp_jpg_height= Image::make($path.'temp.jpg')->height();
            $imgtemp = Image::make($path.'temp.png');
            // วาดรูปเสีย อาจจะเสียเพราะการปรับขนาดหน้าจอ
            $imgtemp->resizeCanvas($temp_jpg_width, $temp_jpg_height, 'top-left');
            $imgtemp->save($path.'temp.png');

            $width = Image::make($path.$r->picname)->width();
            $height= Image::make($path.$r->picname)->height();
            $temp  = Image::make($path.'temp.png')->resize($width,$height);
            $temp->save($path.'temp.png');
            $temp->destroy();

            $img = Image::make($path.$r->picname);
            $img->insert($path.'temp.png');
            $img->save($path.$r->picname);
            $img->destroy();
            unlink($path.'temp.png');
            echo "success";
        }

        if ($r->event == "pictemp") {
            $temp  = Image::make(mePHOTO($r->hn,$r->picname,$r->folderdate))->resize(1000,null, function ($constraint) {
                $constraint->aspectRatio();
            });
            $temp->save(htdocs("store/$r->hn/$r->folderdate/temp.jpg", 100));
            $temp->destroy();
            $val['width']  = Image::make(htdocs("store/$r->hn/$r->folderdate/temp.jpg"))->width();
            $val['height'] = Image::make(htdocs("store/$r->hn/$r->folderdate/temp.jpg"))->height();
            $json = jsonEncode($val);
            echo $json;
        }



        if ($r->event == "testtest") {
            $v         = array();
            $v['name'] = $r->value;
            Mongo::table('test')->insert($v);
        }



        if($r->event=='delautotext')
        {
            Mongo::table('tb_autotext')->where([
                ['auto_text','=',$r->text],
                ['auto_textid','=',$r->textid],
                ['auto_procedure','=',$r->procedure],
            ])->delete();

        }




        if($r->event=='nursechange')
        {
            $value[$r->nurse] = $r->val;
            Mongo::table('tb_room')->where('name',$r->room)->update($value);
        }

        if($r->event=='ready_status')
        {
            $value['ready_status'] = $r->val;
            Mongo::table('tb_case')->where('case_id',$r->case_id)->update($value);
        }

        if($r->event=='ready_comment')
        {
            $value['ready_comment'] = $r->val;
            Mongo::table('tb_case')->where('case_id',$r->case_id)->update($value);
        }

        if($r->event=='room_setready')
        {
            $room = $r->room;
            if($room=="readyroom1"){$roomnum = 1;}
            if($room=="readyroom2"){$roomnum = 2;}
            if($room=="readyroom3"){$roomnum = 5;}
            if($room=="readyroom4"){$roomnum = 6;}
            if($room=="readyroom_ercp"){$roomnum = 4;}
            $value['ready'] = $r->val;
            Mongo::table('tb_room')->where('id',$roomnum)->update($value);
            echo $r->room;
        }












        if($r->event=='vdo_allow'){
            $val['vdo_status'] = $r->value;
            Mongo::table('tb_casevdo')->where('vdo_name',$r->vdo_name)->update($val);
        }



        if($r->event=='savejson2'){
            if($r->value!=""){
                $w[0] = array('auto_text',$r->value);
                $w[1] = array('auto_textid',$r->name);
                $w[2] = array('auto_procedure',$r->procedure);
                $count = Mongo::table('tb_autotext')->where($w)->count();
                if($count==0){
                    $val['auto_procedure']  = $r->procedure;
                    $val['auto_text']       = $r->value;
                    $val['auto_textid']     = $r->name;
                    Mongo::table('tb_autotext')->insert($val);
                }
            }
        }

        //-----------------------------------------
        if($r->event=='focusout2')
        {
                Mongo::table($r->table)
                ->where($r->idname,$r->id)
                ->update([$r->name=>$r->value]);
                if($r->value!=""){
                    $w[0] = array('auto_text',$r->value);
                    $w[1] = array('auto_textid',$r->name);
                    $w[2] = array('auto_procedure',$r->procedure);
                    $count = Mongo::table('autotext')->where($w)->count();
                    if($count==0){
                        $val['auto_procedure']  = $r->procedure;
                        $val['auto_text']       = $r->value;
                        $val['auto_textid']     = $r->name;
                        Mongo::table('autotext')->insert($val);
                    }
                }
        }




        if($r->event=='editroom'){
            $room_id = (int) $r->room_id;

            $room = Mongo::table('tb_room')->where('room_id',$room_id)->first();
            // dd($room);

            if(isset($room['_id'])){
                $val['room'] = $room_id;
                // dd($val);
                // $tb_case =  Mongo::table('tb_case')->where('_id',$r->cid)->first();
                // dd($tb_case);
                Mongo::table('tb_case')->where('_id',$r->cid)->update($val);


                return $room['room_name'] ?? '';
            }
        }






        if($r->event=='savejson_checkbox'){
            case_jsonSave($r->id,$r->idhtml,$r->value);
        }


        if ($r->event == "drawrenew") {
            $picname       = $r->picname;
            $hn            = $r->hn;
            $path_original = "store/" . $hn . "/backup/" . $picname;
            $path_ram      = "store/" . $hn . "/backup/ram.jpg";
            $path_new      = "store/" . $hn . "/" . $picname;

            $ex = explode("_", $picname);

            if ($ex[1] == "self") {
                copy($path_original, $path_new);
            } else {

                $w[0]     = array('scope_id', $ex[1]);
                $rowScope = Mongo::table('tb_scope')->where($w)->first();

                $name                 = $path_original;
                $myImage              = imagecreatefromjpeg($name);
                list($width, $height) = getimagesize($name);
                $scale                = 0.5;
                $myImageZoom          = imagecreatetruecolor($width * $scale, $height * $scale);

                $left        = $rowScope->scope_left; //ลดภาพด้านซ้าย
                $top         = $rowScope->scope_top; //ลดภาพด้านบน
                $rigth       = $rowScope->scope_rigth; //ลดภาพด้านขวา
                $bottom      = $rowScope->scope_bottom; //ลดภาพด้านล่าง
                $width       = $width - ($rigth + $left);
                $height      = $height - ($bottom + $top);
                $myImageCrop = imagecreatetruecolor($width, $height);

                imagecopyresampled($myImageCrop, $myImage, 0, 0, $left, $top, $width, $height, $width, $height);
                imagejpeg($myImageCrop, $path_new);
            }
        }

    }

}
