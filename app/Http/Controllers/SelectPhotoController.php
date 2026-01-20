<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Datacase;
use App\Models\Mongo;

class SelectPhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        if (isset($r->event)) {
            $event  = $r->event;
            return $this->$event($r);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $view['cid']    = $id;
        $view['case']   = Datacase::fromID($id);
        $case           = $view['case'];
        $view['photo']  = $this->photo($case);
        $view['photo']  = $case->photo;
        $view['procedure']              = (object) Mongo::table("tb_procedure")->where("code", $case->case_procedurecode)->first();

        $view = $this->procedurepic($view);
        // dd($view['case']);
        return view("EndoINDEX.selectphoto" , $view);
    }

    public function sel_photo($r){
        $mainpart = preg_replace('/[^A-Za-z0-9\-]/', '', $r->mainpart);
        $mainpart = strtolower($mainpart);
        $lesion = $r->lesion;



        $val = Mongo::table("tb_case")->where("_id", $r->cid)->first();

        if(isset($val["advance"][$mainpart][$lesion]['photo'])){
            unset($val["advance"][$mainpart][$lesion]['photo']);
        }

        if(isset($r->photonameall)){
            $photoall = explode(".jpg", $r->photonameall);
            foreach ($photoall as $p) {
                if($p!=""){
                    $val["advance"][$mainpart][$lesion]['photo'][$p.".jpg"]["text"]     = "";
                    $val["advance"][$mainpart][$lesion]['photo'][$p.".jpg"]["select"]   = true;
                }
            }
            Mongo::table("tb_case")->where("_id", $r->cid)->update($val);
        }
        return redirect("procedure/$r->cid#$mainpart$lesion");
    }




    public function procedurepic($view)
    {

        $case                       = $view['case'];
        // dd($view);
        $procedure                  = (object) $view['procedure'];
        $procedure_picori           = fileconfig("procedure/$procedure->img");
        // dd($procedure_picori);
        if (file_exists($procedure_picori)) {
            $procedure_picori           = fileconfig("procedure/$procedure->img");
        } else {
            $procedure_picori = url("public/image/blank.jpg");
        }
        // dd($procedure_picori);
        $appointment                = explode(" ", $case->appointment);
        $folderdate                 = $appointment[0];
        $view['folderdate']         = $folderdate;
        $folder_hnpath              = htdocs("store/$case->case_hn/$folderdate/");
        $view['procedure_piccopy']  = $folder_hnpath . $case->caseuniq . ".jpg";
        makedir($folder_hnpath);
        if (!file_exists($view['procedure_piccopy'])) {
            copy($procedure_picori, $view['procedure_piccopy']);
        }

        return $view;
    }

    public function photo($case)
    {
        $x = 0;
        $photo = array();
        foreach ($case->photo as $p) {
            if (isset($p['st'])) {
                if ($p['st'] == 0 || $p['st'] == 1) {
                    $photo[$x]['nu'] = $p['nu'];
                    $photo[$x]['ns'] = $p['ns'];
                    $photo[$x]['na'] = $p['na'];
                    $photo[$x]['sc'] = $p['sc'];
                    $photo[$x]['st'] = $p['st'];
                    $photo[$x]['tx'] = $p['tx'];
                    $x++;
                }
            }
        }
        return $photo;
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
