<?php

namespace App\Http\Controllers\Endocapture;

use App\Http\Controllers\Controller;
use App\Models\Mongo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Image;
use Illuminate\Support\Carbon;

class MovecaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Request $r){checklogin();}

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {
        // dd($r->all());
        $patient_hn = $r->move_hn;
        $upper      = strtoupper($patient_hn);
        $lower      = strtolower($patient_hn);

        // old data
        $case = (object) Mongo::table('tb_case')->where('id',$r->case_id)->first();
        $patient = (object) Mongo::table('tb_patient')->where('hn', $upper)->orWhere('hn', $lower)->first();

        $val['caseuniq']       = date("ymdHis");
        $val['updatetime']     = date("ymdHis");
        $val['comcreate']      = getCONFIG('admin')->com_name;

        // // /// Patient ///
        $str['patientname']         = $patient->firstname." ".$patient->lastname;
        $str['hn']                  = $patient->hn;
        $str['age']                 = age($patient->birthdate);
        $json                       = jsonEncode($str);
        // /// Insert ///
        insertMEDICATION($val);
        insertPACs($val);

        // old medication data
        // $obj_id = new ObjectId($case->caseuniq);
        // $medication = Mongo::table('tb_casemedication')->where('caseuniq', $obj_id)->first();
        // updateMEDICATION($val, $medication);

        $r['case_procedurecode']      = @$case->case_procedurecode."";
        $r['hn']                      = @$patient->hn."";
        $r['case_physicians01']       = @$case->case_physicians01."";
        $r['case_dateappointment']    = @$case->case_dateappointment."";
        $r['room']                    = @$case->case_room."";
        $r['opd']                     = @$case->opd."";
        $r['ward']                    = @$case->ward."";
        $r['refer']                   = @$case->refer."";
        $r['doctor02']                = @$case->physicians02."";
        $r['doctor03']                = @$case->physicians03."";
        $r['nurse01']                 = @$case->nurse01."";
        $r['nurse02']                 = @$case->nurse02."";
        $r['nurse03']                 = @$case->nurse03."";
        $r['nurse04']                 = @$case->nurse04."";
        $r['anes']                    = @$case->anes."";
        $r['prediagnosis']            = @$case->prediagnostic_other."";
        $r['patientid']               = @$case->patient_id."";
        $r['useropen']                = @$case->useropencase."";
        $r['righttotreatment']        = @$case->righttotreatment."";
        $r['appointment']             = @$case->appointment."";
        $r['case_dateappointment']    = @$case->appointment ?? '';
        $r['department']              = @$case->department ?? '';
        $r = (object) $r;
        $cid = insertCASE($val,$r);

        // new data
        $check = (object) Mongo::table('tb_case')->where('id', $cid)->first();

        $data['comcreate']              = @$case->comcreate;
        $data['case_dateregister']      = @$case->case_dateregister;
        $data['case_dateappointment']   = @$case->case_dateappointment;
        $data['case_physicians01']      = @$case->case_physicians01;
        $data['case_status']            = @$case->case_status;
        $data['case_status_queue']      = @$case->case_status_queue;
        $data['case_photo']             = @$case->case_photo;
        $data['case_pdfversion']        = @$case->case_pdfversion;
        $data['case_room']              = @$case->case_room;
        $data['case_roomsort']          = @$case->case_roomsort;
        $data['ready_status']           = @$case->ready_status;
        $data['ready_comment']          = @$case->ready_comment;
        $data['case_vip']               = @$case->case_vip;
        $data['case_semi']              = @$case->case_semi;
        $data['case_booking']           = @$case->case_booking;
        $data['department']              = @$case->department ?? '';

        $old_case = $this->get_head((array) $case);
        $new_case = $this->get_head((array) $check);
        $key_left = $this->compare_head($old_case, $new_case);

        $old_case_array = (array) $case;
        foreach ($key_left as $key) {
            // Exclude video and photo from copy, will handle separately
            if($key != 'video' && $key != 'photo'){
                $js[$key] = $old_case_array[$key];
            }
        }
        $js['hn'] = $patient->hn;
        $js['patientname'] = $str['patientname'];
        $js['age']  = @$case->age;

        Mongo::table('tb_case')->where('id', $cid)->update($js);

        // move to tb_casebackup -> then delete old case in tb_case
        $case_old = (array) Mongo::table('tb_case')->where('id',$r->case_id)->first();
        unset($case_old['id']);
        Mongo::table('tb_case')->where('id',$r->case_id)->delete();
        $cid_old =  Mongo::table('tb_casebackup')->insertGetId($case_old);

        $old['case_status'] = 90;
        Mongo::table('tb_case')->where('id',$r->case_id)->update($old);


        // $cid_old    = $r->case_id;
        $cid_new    = (string) $cid;
        $hn         = $case->case_hn;
        $folderdate = $r->folderdate;

        $hn_new = $check->hn;
        $hn_old = $case->case_hn;
        $folder_hnpath = htdocs("store/$hn_new/$folderdate/backup/");
        makedirfull($folder_hnpath);

        $picjson = isset($case->photo) ? $case->photo : [];

        $new_photo_arr = [];
        foreach($picjson as $index=>$pic){
            $pic = (object) $pic;
            if(isset($pic->na)){
                $photo = $pic->na;
                $new_photo = $this->edit_photoname($cid_new, $pic->na);

                try {
                    $img = Image::make(htdocs("store/$hn_old/$folderdate/backup/$photo"));
                    $img->save(htdocs("store/$hn_new/$folderdate/backup/$new_photo"));
                    $img->destroy();
                    unlink(htdocs("store/$hn/$folderdate/backup/$photo"));

                    $img = Image::make(htdocs("store/$hn_old/$folderdate/$photo"));
                    $img->save(htdocs("store/$hn_new/$folderdate/$new_photo"));
                    $img->destroy();
                    unlink(htdocs("store/$hn/$folderdate/$photo"));
                } catch (Exception $e) {
                    //
                }

                $new_photo_arr[] = $pic;
                $new_photo_arr[$index]->na = $new_photo;
            }
        }

        // $exp_folderdate = explode('-', $folderdate);
        // if(isset($exp_folderdate[0])){
        //     $yearmonth = $exp_folderdate[0].$exp_folderdate[1];
        // }

        $video_path = htdocs("store/$hn_old/$folderdate/vdo");
        $new_path = htdocs("store/$hn_new/$folderdate/vdo");
        $new_video_arr = [];
        if($video_path){
            if(file_exists($new_path) == false){
                mkdir($new_path);
            }

            try{
                $files1 = scandir($video_path);
            } catch (Exception $e) {
                $files1 = [];
            }
            foreach ($files1 as $filename) {
                if($filename == '.' || $filename == '..') continue;
                $f = explode("_", $filename);
                if ($f[0] == $case->id) {
                    $f[0] = $cid;
                    $new_video_name = join("_", $f);
                    $old_video_path = $video_path."/$filename";
                    $new_video_path = $new_path."/$new_video_name";
                    try{
                        rename($old_video_path, $new_video_path);
                        $new_video_arr[] = $new_video_name;
                    } catch (Exception $e) {
                        // dd($e);
                    }
                }
            }
        }

        // Use only videos that were moved, do not merge with existing videos
        $u['photo'] = $new_photo_arr;
        $u['video'] = $new_video_arr;
        Mongo::table('tb_case')->where('id', $cid)->update($u);

        $case_old = (object) Mongo::table('tb_casebackup')->where('id',$cid_old)->first();
        $case_new = (object) Mongo::table('tb_case')->where('id',$cid_new)->first();
        $js2['case_form']        = $case_old->caseuniq;
        $js2['case_receive']     = $case_new->caseuniq;
        $js2['case_time_do']     = Carbon::now()->format('Y-m-d H:i:s');
        $data2['edit_remark']    = 'Move patient';
        $data2['edit_status']    = 1;
        $data2['edit_json']      = jsonEncode($js2);
        $data2['edit_event']     = 'CASE MOVE';
        $data2['edit_userid']    = uid();
        Mongo::table('tb_logedit')->insert($data2);

        $log['case_from']        = $case_old->caseuniq;
        $log['case_to']          = $case_new->caseuniq;
        $log['event']            = 'move case';
        logdata('tb_logcase', uid(), 'move case', $log);

        if($r->project == "capture"){
            return redirect("procedure/$check->id");

        }else{
            return redirect("procedure/$check->id");
        }

    }

    public function get_head($data_row){
        $head = array();
        foreach ($data_row as $key => $data) {
            $head[] = $key;
        }
        return $head;
    }

    public function compare_head($old_case, $new_case){
        $compare = array();
        if(is_array($old_case) && is_array($new_case)){
            $compare = array_diff($old_case, $new_case);
        }
        return $compare;
    }

    public function edit_photoname($new_case_id, $photoname){
        $new_photoname = '';
        $exp           = explode("_", $photoname);
        if(isset($exp[0])){
            $exp[0]        = $new_case_id;
            $new_photoname = join('_', $exp);
        }
        return $new_photoname;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
