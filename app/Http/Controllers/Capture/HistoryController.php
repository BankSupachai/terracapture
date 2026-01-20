<?php

namespace App\Http\Controllers\Capture;
use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use App\Models\Department;
use App\Models\Fileconfig;
use App\Models\Mongo;
use App\Models\Patient;
use App\Models\Server;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('capture.viewer');
        // return view('terra.wait.viewer');
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
        // if($r->event=="check_hn")       {return $this->check_hn($r);}



    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // dd(1);

        if(Server::check_connection()){return redirect(url('servererror'));}

        $view['case_hn'] = $id;
        $view['patient'] = Server::table('tb_patient')->where('hn', 'like',$id)->first();
        $view['tb_case'] = $this->get_allcase($id);
        $view['procedure'] = Server::table('tb_procedure')->get();
        // $view['store_url'] = domainname('store').'/';
        // $view['vdo_url'] =  domainname('store').'/';
        $config             = getCONFIG("admin");
        $store_url          = !empty($config->endosmart_url) ? $config->endosmart_url : domainname('store').'/';
        $view['store_url']  = $store_url;
        $view['vdo_url']    = $store_url;

        $view['doctor']             = Department::user('doctor', uid());
        if($view['patient'] == null){
            $view['patient'] = $this->get_endosmartpatient($id);
        }
        if(isMobile()){
            return view('capture.viewer.index', $view);
            // return view('Endocapture.home.mockup.dashboardipad.dataanalyze', $view);
        }
        // return view('terra.wait.main', $view);
        return view('capture.main', $view);
    }

    public function get_allcase($hn){
        $w[0] = array('appointment', "!=", "");
        $w[]  = array('statusjob', '!=', 'delete');
        $w[]  = array('statusjob', '!=', 'cancel');
        $w[]  = array('case_hn' ,$hn);

        $orw[]  = array('case_hn', Intval($hn));

        $tb_case        = Server::table('tb_case')->where($w)->orWhere($orw)->orderBy('_id','DESC')->limit(500)->get();
        // $endosmart_data = Mongo::table('endosmart_data')->where('hn', $hn)->limit(500)->get();
        // use below
        $endosmart_data = Server::table('newendosmart_data')->where('hn', Intval($hn))->orWhere('hn', $hn)->limit(500)->get();
        // $endosmart_data = Server::table('endosmart_data')->where('HN_ID', Intval($hn))->orWhere('HN_ID', $hn)->limit(500)->get();
        foreach (isset($endosmart_data)?$endosmart_data:[] as $data) {
            $tb_case[] = $this->change_key($data);
        }
        $arr     = isset($tb_case) ? $tb_case : [];
        return $arr;
    }

    public function change_key($data){
        $arr['_id']             = $data['_id'];
        // $arr['appointment']     = $this->change_date_format($data['date_operation']);
        // $arr['case_hn']         = $data['hn'];
        // $arr['procedurename']   = $data['procedure'];
        // $arr['photo']           = [];
        // foreach (isset($data['image'])?$data['image']:[] as $data) {
        //     $arr['photo'][]     = $data;
        // }
        $arr['appointment']     = isset($data['CASE_REGIS_DATE']) ? explode(' ', $data['CASE_REGIS_DATE'])[0] : $data['date_operation'];
        $arr['case_hn']         = isset($data['HN_ID']) ? $data['HN_ID'] : $data['hn'];
        $arr['doctorname']      = $this->change_doctorname(@$data['DOCTOR_1']);
        $arr['procedurename']   = @$data['CASE_TYPE']."";
        $arr['photo']           = [];
        $arr['pdf']             = [];
        $arr['endosmart']       = 'true';
        foreach (isset($data['image'])?$data['image']:[] as $img) {
            $arr['photo'][]     = $img;
        }
        foreach (isset($data['pdf'])?$data['pdf']:[] as $p) {
            $arr['pdf'][]     = $p;
        }
        return $arr;
    }

    public function change_doctorname($name){
        $doctorname = '';
        if(isset($name)){
            if(str_contains($name, ',')){
                $exp = explode(',', $name);
                $doctorname = @$exp[1].""." ".@$exp[0]."";
            }
        }
        return $doctorname;
    }

    public function get_endosmartpatient($hn){
        // $data = Server::table('endosmart_data')->where('HN_ID', Intval($hn))->orWhere('HN_ID', strval($hn))->first();
        $data = Server::table('newendosmart_data')->where('hn', Intval($hn))->orWhere('hn', strval($hn))->first();
        $arr = [];
        if(isset($data)){
            $arr['firstname']  = @$data['PT_NAME']."";
            $arr['middlename'] = @$data['PT_MIDDLENAME']."";
            $arr['lastname']   = @$data['PT_SURNAME']."";
            $arr['prefix'] = @$data['PT_PREFIX']."";
            $arr['hn'] = @$data['hn']."";
            $arr['gender'] = @$data['PT_PREFIX']."" == 'นาย' ? '1' : '2';
            $arr['age'] = @$data['AGE']."";
        }
        return $arr;
    }

    public function change_date_format($date){
        $exp = isset($date) ? explode('-', $date) : [];
        $newdate = '';
        if(is_array($exp)){
            if(count($exp) > 0){
                $year     = isset($exp[2]) ? intval($exp[2]) - 543 : '';
                $month    = isset($exp[1]) ? $exp[1] : '';
                $date     = isset($exp[0]) ? $exp[0] : '';
                $newdate  = "$year-$month-$date";
            }
        }
        return $newdate;
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
