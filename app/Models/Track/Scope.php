<?php

namespace App\Models\Track;

use App\Models\Mongo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator as PaginationPaginator;

class Scope extends Model
{
    use HasFactory;
    const UPDATED_AT = null;
    protected $table    = 'tb_scope';

    public static function get_scope_page($num_page){
        // return DB::table('tb_scope')
        // ->join('tb_scope_repair','tb_scope.scope_serial','tb_scope_repair.sr_scope_serial_number')
        // ->join('tb_scope_pm','tb_scope.scope_serial','tb_scope_pm.sp_scope_serial_number')
        // ->join('tb_scope_training','tb_scope.scope_serial','tb_scope_training.st_scope_serial_number')
        // ->paginate($num_page);

        $main = [];
        $sub  = [];
        $tb_scope = (object) Mongo::table('tb_scope')->get();

        foreach ($tb_scope as $scope) {
            $scope             = (object) $scope;
            $tb_scope_repair   = (object) Mongo::table('tb_scope_repair')->where('sr_scope_serial_number', $scope->scope_serial)->first();
            $tb_scope_pm       = (object) Mongo::table('tb_scope_pm')->where('sp_scope_serial_number', $scope->scope_serial)->first();
            $tb_scope_training = (object) Mongo::table('tb_scope_training')->where('st_scope_serial_number', $scope->scope_serial)->first();

            foreach($scope as $key_scope => $sc){
                $sub[$key_scope] = $sc;
            }

            foreach($tb_scope_repair as $key_scope_repair => $sc_repair){
                $sub[$key_scope_repair] = $sc_repair;
            }

            foreach($tb_scope_pm as $key_scope_pm => $sc_pm){
                $sub[$key_scope_pm] = $sc_pm;
            }

            foreach($tb_scope_training as $key_scope_training => $sc_training){
                $sub[$key_scope_training] = $sc_training;
            }

            if(count($sub) != 0){
                $main[] = $sub;
            }

            $sub = [];
        }

        $main = collect($main);
        $main = Scope::paginate($main, $num_page);
        return $main;

    }

    public static function paginate($items, $perPage = 15, $page = null, $baseUrl = null, $options = []) {
        $page = $page ?: (PaginationPaginator::resolveCurrentPage() ?: 1);

        $items = $items instanceof Collection ?
                       $items : Collection::make($items);

        $lap = new LengthAwarePaginator($items->forPage($page, $perPage),
                           $items->count(),
                           $perPage, $page, $options);

        if ($baseUrl) {
            $lap->setPath($baseUrl);
        }

        return $lap;
    }

    public static function show_scope($id){
        // $view = DB::table('tb_scope')->where('scope_id', $id)->get();
        $view = Mongo::table('tb_scope')->where('scope_id', intval($id))->get();
        return $view;
    }
    public static function insert_scope($r){
        $count = count($r->scope_select);
        for($i=0;$i<$count;$i++){
            $temp = Mongo::table('tb_scope_temp')->where('scope_id',intval($r->scope_select[$i]))->first();
            $temp = (object) $temp;
            $data['scope_type']                         = @$r->scope_type[$r->scope_select[$i]].'';
            $data['scope_name']                         = @$r->scope_name[$r->scope_select[$i]].'';
            $data['scope_model']                        = @$r->scope_model[$r->scope_select[$i]].'';
            $data['scope_serial']                       = @$r->scope_serial[$r->scope_select[$i]].'';
            $data['scope_working_channel']              = @$temp->scope_working_channel.'';
            $data['scope_distal_end_diameter']          = @$temp->scope_distal_end_diameter.'';
            $data['scope_band']                         = @$temp->scope_band.'';
            $data['scope_installdate']                  = @$r->scope_installdate[$r->scope_select[$i]].'';
            $data['scope_selling_price']                = @$temp->scope_selling_price.'';
            $data['scope_warranty_year']                = @$r->scope_warranty_year[$r->scope_select[$i]].'';
            $data['scope_contract_warrantee_start']     = @$temp->scope_contract_warrantee_start.'';
            $data['scope_contract_warrantee_end']       = @$temp->scope_contract_warrantee_end.'';
            $data['scope_sale_name']                    = @$temp->scope_sale_name.'';
            $data['scope_sale_tel']                     = @$temp->scope_sale_tel.'';
            $data['scope_service_name']                 = @$temp->scope_service_name.'';
            $data['scope_service_tel']                  = @$temp->scope_service_tel.'';
            $data['scope_status']                       = @'available';
            $data['scope_id']                           = intval(get_last_id('scope_id', 'tb_scope')) + 1;
            Mongo::table('tb_scope')->insert($data);
        }
    }
    public static function insert_scope_store($r){
        $data['scope_name']                         = @$r->scope_name.'';
        $data['scope_type']                         = @$r->scope_type.'';
        $data['scope_model']                        = @$r->scope_model.'';
        $data['scope_serial']                       = @$r->scope_serial.'';
        $data['scope_working_channel']              = @$r->scope_working_channel.'';
        $data['scope_distal_end_diameter']          = @$r->scope_distal_end_diameter.'';
        $data['scope_band']                         = @$r->scope_band.'';
        $data['scope_installdate']                  = @format_date(@$r->scope_installdate, 'Y-m-d').'';
        $data['scope_selling_price']                = @$r->scope_selling_price.'';
        $data['scope_warranty_year']                = @$r->scope_warranty_year.'';
        $data['scope_contract_warrantee_start']     = @format_date(@$r->scope_contract_warrantee_start, 'Y-m-d').'';
        $data['scope_contract_warrantee_end']       = @format_date(@$r->scope_contract_warrantee_end, 'Y-m-d').'';
        $data['scope_sale_name']                    = @$r->scope_sale_name.'';
        $data['scope_sale_tel']                     = @$r->scope_sale_tel.'';
        $data['scope_service_name']                 = @$r->scope_service_name.'';
        $data['scope_service_tel']                  = @$r->scope_service_tel.'';
        $data['scope_status']                       = @'available';
        $data['scope_id']                           = intval(get_last_id('scope_id', 'tb_scope')) + 1;
        Mongo::table('tb_scope')->insert($data);
    }
    public static function edit_scope($r,$id){
        $data['scope_type']                 = $r->scope_type.'';
        $data['scope_name']                 = $r->scope_name.'';
        $data['scope_model']                = $r->scope_model.'';
        $data['scope_serial']               = $r->scope_serial.'';
        $data['scope_working_channel']      = $r->scope_working_channel.'';
        $data['scope_distal_end_diameter']  = $r->scope_distal_end_diameter.'';
        $data['scope_band']                 = $r->scope_band.'';
        $data['scope_installdate']          = $r->scope_installdate.'';
        $data['scope_selling_price']        = $r->scope_selling_price.'';
        $data['scope_warranty_year']        = $r->scope_warranty_year.'';
        $data['scope_service_name']         = $r->scope_service_name.'';
        $data['scope_service_tel']          = $r->scope_service_tel.'';
        Mongo::table('tb_scope')->where('scope_id',intval($id))->update($data);
    }
    public static function get_scope_type(){
        // return DB::table('tb_scope')->select('scope_type')->groupBy('scope_type')->get();
        $type = Mongo::table('tb_scope')->select('scope_type')->groupBy('scope_type')->get();
        return $type;
    }
    public static function get_scope_where($r){
        if(isset($r->txt_search)){
            $w[] = array('scope_id','!=',0);
            if($r->search_type!='Type'){
                $w[] = array('scope_type',$r->search_type);
                $view['search_type'] = $r->search_type;
            }
            if(isset($r->search_name)){
                $w[] = array('scope_name','like',"%$r->search_name%");
                $view['search_name'] = $r->search_name;
            }
            if($r->search_on!='On/Off'){
                $w[] = array('scope_status',$r->search_on);
                $view['search_on'] = $r->search_on;
            }
            if(isset($r->search_model)){
                $w[] = array('scope_model','like',"%$r->search_model%");
                $view['search_model'] = $r->search_model;
            }
            if(isset($r->search_serial)){
                $w[] = array('scope_serial','like',"%$r->search_serial%");
                $view['search_serial'] = $r->search_serial;
            }
            if($r->search_company!='Company'){
                $w[] = array('scope_band',$r->search_company);
                $view['search_company'] = $r->search_company;
            }
            $use_date_s = 0;
            $use_date_e = 0;
            if($r->search_rw!='none'){
                $view['search_rw'] = $r->search_rw;
                if($r->search_rw=='In Warrantee'){
                    $st = '>=';
                }else{
                    $st = '<=';
                }
                $use_date_e = 1;
            }
            if($r->search_age>=0 && $r->search_age!='fff'){

                $y = $r->search_age+1;

                $ny = $y-1;

                if($r->search_age>5){
                    $y  = date('Y')+6;
                }

                $view['search_age'] = $r->search_age;
                $date = Carbon::today()->subYear($y);
                $date_start = Carbon::today()->subYear($ny);
                $use_date_s = 1;
            }
            if($use_date_e==1 && $use_date_s==0){
                $view= Mongo::table('tb_scope')
                ->where($w)
                ->whereDate('scope_contract_warrantee_end',$st,date('Y-m-d'))
                ->get();
            }elseif($use_date_s==1 && $use_date_e==0){
                $view= Mongo::table('tb_scope')
                ->where($w)
                ->whereDate('scope_contract_warrantee_start','<=',$date_start)
                ->whereDate('scope_contract_warrantee_start','>=',$date)
                ->get();
            }elseif($use_date_s==1 && $use_date_e==1){
                $view= Mongo::table('tb_scope')
                ->where($w)
                ->whereDate('scope_contract_warrantee_end',"$st",date('Y-m-d'))
                ->whereDate('scope_contract_warrantee_start','<=',$date_start)
                ->whereDate('scope_contract_warrantee_start','>=',$date)
                ->get();
            }else{
                $view= Mongo::table('tb_scope')
                ->where($w)
                ->get();
            }
        }else{
            $view= Mongo::table('tb_scope')->get();
        }
        return $view;
    }
    public static function get_scope_temp(){
        $view = Mongo::table('tb_scope_temp')->where('scope_installdate','!=',null)->orWhere('scope_band','!=',null)->orWhere('scope_installdate','!=',null)->orWhere('scope_selling_price','!=',null)->orWhere('scope_warranty_year','!=',null)->orWhere('scope_contract_warrantee_start','!=',null)->orWhere('scope_contract_warrantee_end','!=',null)->orWhere('scope_sale_name','!=',null)->get();
        return $view;
    }
    public static function insert_scope_temp($r){
        if(isset($r->scope_pm_select)){
            $count = count($r->scope_pm_select);
            for($i=0;$i<$count;$i++){
                $data['sp_scope_serial_number']     = @$r->sp_scope_serial_number[$r->scope_pm_select[$i]].'';
                $data['sp_pm_date']                 = @$r->sp_pm_date[$r->scope_pm_select[$i]].'';
                $data['sp_pm_next_date']            = @$r->sp_pm_next_date[$r->scope_pm_select[$i]].'';
                $data['sp_pm_result']               = @$r->sp_pm_result[$r->scope_pm_select[$i]].'';
                $data['sp_result_detail_pm']        = @$r->sp_result_detail_pm[$r->scope_pm_select[$i]].'';
                $data['sp_id']                      = intval(get_last_id('sp_id', 'tb_scope_pm')) + 1;
                Mongo::table('tb_scope_pm')->insert($data);
            }
        }
    }

    public static function get_scope_repair(){
        // return Mongo::table('tb_scope')->where('scope_status', "repair")->get();
        // return Mongo::table('tb_scope_update')->where('scope_status', "repair")->get();
        $main = [];
        $sub  = [];
        $filter = ['repair'];
        $tb_scope_update = Scope::get_scope_update($filter);
        foreach (isset($tb_scope_update)?$tb_scope_update:[] as $data) {
            $data = (object) $data;
            $w[] = array('track_rfid', $data->scope_rfid);
            $w[] = array('track_type', $data->scope_status);
            $casetrack = Mongo::table('tb_casetrack')->where($w)->orderBy('_id', 'DESC')->first();
            if(!isset($casetrack)){
                continue;
            }

            $casetrack = (object) $casetrack;

            $user = (object) Mongo::table('users')->where('uid', intval($casetrack->track_user))->first();
            foreach (isset($data)?$data:[] as $key_scope => $ks) {
                $sub[$key_scope] = $ks;
            }

            foreach (isset($casetrack)?$casetrack:[] as $key_casetrack => $ct) {
                $sub[$key_casetrack] =  $ct;
            }

            foreach($user as $key_user => $u){
                $sub[$key_user] = $u;
            }

            if(count($sub) != 0){
                $main[] = $sub;
            }

            $sub = [];
            $w   = [];
        }

        $main = collect($main);
        return $main;
    }

    public static function get_scope_disable(){
        // return Mongo::table('tb_scope')->where('scope_status', "disable")->get();
        // return Mongo::table('tb_scope_update')->where('scope_status', "disable")->get();
        $main = [];
        $sub  = [];
        $filter = ['disable'];
        $tb_scope_update = Scope::get_scope_update($filter);
        foreach (isset($tb_scope_update)?$tb_scope_update:[] as $data) {
            $data = (object) $data;
            $w[] = array('track_rfid', $data->scope_rfid);
            $w[] = array('track_type', $data->scope_status);
            $casetrack = Mongo::table('tb_casetrack')->where($w)->orderBy('_id', 'DESC')->first();
            if(!isset($casetrack)){
                continue;
            }

            $casetrack = (object) $casetrack;

            $user = (object) Mongo::table('users')->where('uid', intval($casetrack->track_user))->first();
            foreach (isset($data)?$data:[] as $key_scope => $ks) {
                $sub[$key_scope] = $ks;
            }

            foreach (isset($casetrack)?$casetrack:[] as $key_casetrack => $ct) {
                $sub[$key_casetrack] =  $ct;
            }

            foreach($user as $key_user => $u){
                $sub[$key_user] = $u;
            }

            if(count($sub) != 0){
                $main[] = $sub;
            }

            $sub = [];
            $w   = [];
        }

        $main = collect($main);
        return $main;
    }

    public static function get_scope_repair_count(){
        $main = [];
        $sub  = [];
        $tb_scope_repair = (object) Mongo::table('tb_scope_repair')->get();
        foreach ($tb_scope_repair as $scope_repair) {
            $scope_repair = (object) $scope_repair;
            $tb_scope    = (object) Mongo::table('tb_scope')->where('scope_id', intval($scope_repair->sr_scope_id))->first();
            // $tb_scope = (object) Mongo::table('tb_scope')->where('scope_serial', $scope_repair->sr_scope_serial_number)->first();
            foreach($scope_repair as $key_scope_repair => $sc_repair){
                $sub[$key_scope_repair] = $sc_repair;
            }
            foreach($tb_scope as $key_scope => $sc){
                $sub[$key_scope] = $sc;
            }
            if(count($sub) != 0){
                $main[] = $sub;
            }
            $sub = [];
        }
        $main = collect($main);
        return $main;
    }

    public static function get_scope_repair_where($data){
        return Mongo::table('tb_scope_repair')->where('sr_scope_serial_number',$data)->get();
    }
    public static function get_scope_repair_temp(){
        return Mongo::table('tb_scope_repair_temp')->where('sr_return_date','!=',null)->orWhere('sr_broken_date','!=',null)->orWhere('sr_repair_price','!=',null)->orWhere('sr_repair_status','!=',null)->orWhere('sr_bringback_date','!=',null)->orWhere('sr_scope_serial_number','!=',null)->orWhere('sr_main_phenomenon_repair','!=',null)->get();
    }
    public static function insert_scope_repair($r,$serial_number){
        $data['sr_scope_serial_number']     = @$serial_number->scope_serial;
        $data['sr_broken_date']             = @$r->sr_broken_date.'';
        $data['sr_bringback_date']          = @$r->sr_bringback_date.'';
        $data['sr_main_phenomenon_repair']  = @$r->sr_main_phenomenon_repair.'';
        $data['sr_repair_analyze']          = @$r->sr_repair_analyze.'';
        $data['sr_repair_price']            = @$r->sr_repair_price.'';
        $data['sr_return_date']             = @$r->sr_return_date.'';
        $data['sr_repair_status']           = @$r->sr_repair_status.'';
        $data['sr_id']                      = intval(get_last_id('sr_id', 'tb_scope_repair')) + 1;
        Mongo::table('tb_scope_repair')->insert($data);
        $value['scope_status']              = "repair";
        Mongo::table('tb_scope')->where('scope_serial',@$serial_number->scope_serial)->update($value);
    }

    public static function get_latest_each_scope($track_type){
        $tb_casetrack = Mongo::table('tb_casetrack')->orderBy('track_time', 'desc')->orderBy('track_date', 'desc')->get();
        $check        = [];
        $main         = [];
        $sub          = [];
        foreach (isset($tb_casetrack)?$tb_casetrack:[] as $key => $casetrack) {
            $casetrack  = (object) $casetrack;
            $track_rfid = @$casetrack->track_rfid."";
            if(!in_array($track_rfid, $check)){
                $check[] = $track_rfid;
                $main[]  = $casetrack;
            }
        }

        foreach (isset($main)?$main:[] as $key => $track) {
            $track = (object) $track;
            if(isset($track->track_type)){
                if(is_array($track_type)){
                    if(in_array($track->track_type, $track_type)){
                        $sub[] = $track;
                    }
                } else {
                    if($track->track_type == $track_type){
                        $sub[] = $track;
                    }
                }
            }
        }

        return $sub;
    }

    public static function get_scope_update($type){
        $scope = Mongo::table('tb_scope_update')->whereIn('scope_status', $type)->get();
        return $scope;
    }


    public static function get_scope_available(){

        $filter = ['storage', 'available'];
        $tb_scope_update = Scope::get_scope_update($filter);
        $main = array();
        foreach (isset($tb_scope_update)?$tb_scope_update:[] as $data) {
            $data = (object) $data;
            if($data->scope_status == 'available'){
                $data->scope_status = 'storage';
            }
            $w[] = array('track_rfid', $data->scope_rfid);
            $w[] = array('track_type', $data->scope_status);
            $casetrack = Mongo::table('tb_casetrack')->where($w)->orderBy('_id', 'DESC')->first();
            if(!isset($casetrack)){
                continue;
            }

            $casetrack = (object) $casetrack;

            $user = (object) Mongo::table('users')->where('uid', intval(@$casetrack->track_user))->first();
            foreach (isset($data)?$data:[] as $key_scope => $ks) {
                $sub[$key_scope] = $ks;
            }

            foreach (isset($casetrack)?$casetrack:[] as $key_casetrack => $ct) {
                $sub[$key_casetrack] =  $ct;
            }

            foreach($user as $key_user => $u){
                $sub[$key_user] = $u;
            }

            if(count($sub) != 0){
                $main[] = $sub;
            }

            $sub = [];
            $w   = [];
        }

        $main = collect($main);

        return $main;
    }

    public static function insert_casetrack($data){
        $view = (object) Mongo::table('tb_casetrack')->where('track_date',date('Y-m-d'))->where('track_serial',$data)->orderby('track_id','desc')->first();
        return $view;
    }

    public static function get_casetrack(){
        $view = DB::table('tb_casetrack')
        ->join('users','tb_casetrack.track_user','users.id')
        ->join('tb_scope','tb_casetrack.track_rfid','tb_scope.scope_rfid')
        ->get();
        return $view;
    }

    public static function casetrack_today(){
        $view = DB::table('tb_casetrack')
        ->join('users','tb_casetrack.track_user','users.id')
        ->join('tb_scope','tb_casetrack.track_rfid','tb_scope.scope_rfid')
        ->where('track_date',date('Y-m-d'))
        ->get();
        return $view;
    }

    public static function get_casetrack_today($is_today=false, $num_take){
        $main = [];
        $sub  = [];
        if($is_today){
            $w[] = array('track_date',date('Y-m-d'));
            $tb_casetrack = Mongo::table('tb_casetrack')->where($w)->orderBy('track_id','desc')->get();
        } else {
            $tb_casetrack = Mongo::table('tb_casetrack')->orderBy('track_id','desc')->get();
        }

        $num = 0;
        foreach($tb_casetrack as $key_casetrack => $casetrack){
            if($num > $num_take){
                continue;
            }
            $tb_casetrack = (object) $casetrack;
            $tb_scope = (object) Mongo::table('tb_scope')->where('scope_serial', $tb_casetrack->track_serial)->first();
            if(isset($tb_scope)==false){
                continue;
            }
            foreach($casetrack as $key_track => $tr){
                $sub[$key_track] = $tr;
            }
            foreach($tb_scope as $key_scope => $sc){
                $sub[$key_scope] = $sc;
            }
            if(count($sub) != 0){
                $main[] = $sub;
            }
            $sub    = [];
            $num    = $num + 1;
        }

        $main = collect($main);
        return $main;

    }


    public static function get_scope_operation(){
        // $main   = [];
        // $sub    = [];

        $filter = ['capture'];
        $main = array();
        $tb_scope_update = Scope::get_scope_update($filter);
        foreach (isset($tb_scope_update)?$tb_scope_update:[] as $data) {
            $data = (object) $data;
            $w[] = array('track_rfid', $data->scope_rfid);
            $w[] = array('track_type', $data->scope_status);
            $casetrack = (object) Mongo::table('tb_casetrack')->where($w)->orderBy('_id', 'DESC')->first();
            if(!isset($casetrack)){
                continue;
            }

            $user = (object) Mongo::table('users')->where('uid', intval(@$casetrack->track_user))->first();

            foreach (isset($data)?$data:[] as $key_scope => $ks) {
                $sub[$key_scope] = $ks;
            }

            foreach (isset($casetrack)?$casetrack:[] as $key_casetrack => $ct) {
                $sub[$key_casetrack] =  $ct;
            }

            foreach($user as $key_user => $u){
                $sub[$key_user] = $u;
            }

            if(count($sub) != 0){
                $main[] = $sub;
            }

            $sub = [];
            $w   = [];
        }

        $main = collect($main);
        return $main;
    }

    public static function get_scope_operation_where($data){
        $operation = [];
        $sub  = [];

        $w[] = array('track_process',"capture");
        $w[] = array('track_serial',$data);
        $tb_casetrack = (object) Mongo::table('tb_casetrack')->where($w)->get();

        foreach ($tb_casetrack as $casetrack) {
            $casetrack = (object) $casetrack;
            $room      = (object) Mongo::table('tb_room')->where('room_id', intval($casetrack->track_station))->orderBy('room_id', 'desc')->first();
            foreach($room as $key_room => $r){
                $sub[$key_room] = $r;
            }

            if(count($sub) != 0){
                $operation[] = $sub;
            }

            $sub = [];
        }



        if(count($operation)>0){
            foreach ($operation as $value) {
                $value = (object) $value;
                if(isset($array[$value->room_id]['count'])){

                    $array[$value->room_id]['count'] = $array[$value->room_id]['count']+1;
                }else{
                    $array[$value->room_id]['count'] = 1;
                    $array[$value->room_id]['name'] = $value->room_name;
                }
            }
        }


        if(isset($array)){
            return $array;
        }else{
            return [];
        }
    }

    public static function get_scope_reprocess(){
        $main   = [];
        $sub    = [];
        $filter = ['wash', 'prewash'];
        $tb_scope_update = Scope::get_scope_update($filter);
        foreach (isset($tb_scope_update)?$tb_scope_update:[] as $data) {
            $data = (object) $data;
            $w[] = array('track_rfid', $data->scope_rfid);
            $w[] = array('track_type', $data->scope_status);
            $casetrack = (object) Mongo::table('tb_casetrack')->where($w)->orderBy('_id', 'DESC')->first();
            if(!isset($casetrack)){
                continue;
            }

            $user = (object) Mongo::table('users')->where('uid', intval(@$casetrack->track_user))->first();

            foreach (isset($data)?$data:[] as $key_scope => $ks) {
                $sub[$key_scope] = $ks;
            }

            foreach (isset($casetrack)?$casetrack:[] as $key_casetrack => $ct) {
                $sub[$key_casetrack] =  $ct;
            }

            foreach($user as $key_user => $u){
                $sub[$key_user] = $u;
            }

            if(count($sub) != 0){
                $main[] = $sub;
            }

            $sub = [];
            $w   = [];
        }

        $main = collect($main);
        return $main;

    }
    public static function get_scope_reprocess_where($data){
        $main = [];
        $sub  = [];

        $w[] = array('track_process',"cleaning");
        $w[] = array('track_status',0);
        $w[] = array('track_serial',$data);

        $orw[] = array('track_status', "0");
        $orw[] = array('track_process',"cleaning");
        $orw[] = array('track_serial',$data);

        $tb_casetrack = (object) Mongo::table('tb_casetrack')->where($w)->orWhere($orw)->orderBy('track_id', 'desc')->get();

        foreach ($tb_casetrack as $casetrack) {
            $casetrack = (object) $casetrack;
            $w1[] = array('scope_status',"available");
            $w1[] = array('scope_serial', $casetrack->track_serial);
            $tb_scope  = (object) Mongo::table('tb_scope')->where($w1)->first();
            $user      = (object) Mongo::table('users')->where('uid', intval($casetrack->track_user))->first();

            foreach($tb_scope as $key_scope => $sc){
                $sub[$key_scope] = $sc;
            }

            foreach($user as $key_user => $u){
                $sub[$key_user] = $u;
            }

            if(count($sub) != 0){
                $main[] = $sub;
            }

            $sub = [];
            $w1 = [];
        }

        $main = collect($main);
        return $main;
    }
    public static function get_scope_training_where($data){
        return Mongo::table('tb_scope_training')->where('st_scope_serial_number',$data)->get();
    }

    public static function get_scope_training_temp(){
        return Mongo::table('tb_scope_training_temp')->where('st_trainer_tel','!=',null)->orWhere('st_trainer_name','!=',null)->orWhere('st_training_date','!=',null)->orWhere('st_training_topic','!=',null)->orWhere('st_scope_serial_number','!=',null)->get();
    }

    public static function insert_scope_training($r){
        $count = count($r->scope_st_select);
        for($i=0;$i<$count;$i++){
            $temp = Mongo::table('tb_scope_training_temp')->where('st_id',intval($r->scope_st_select[$i]))->first();
            $data['st_scope_serial_number']     = @$r->st_scope_serial_number[$r->scope_st_select[$i]].'';
            $data['st_training_date']           = @$r->st_training_date[$r->scope_st_select[$i]].'';
            $data['st_next_training_date']      = @$r->st_next_training_date[$r->scope_st_select[$i]].'';
            $data['st_training_topic']          = @$r->st_training_topic[$r->scope_st_select[$i]].'';
            if(isset($r->st_training_trainee[$r->scope_st_select[$i]])){
                    if(count($r->st_training_trainee[$r->scope_st_select[$i]])!=0){
                        $data['st_training_trainee']        = json_encode($r->st_training_trainee[$r->scope_st_select[$i]]);
                    }
            }
            $data['st_trainer_name']            = @$r->st_trainer_name[$r->scope_st_select[$i]].'';
            $data['st_trainer_tel']             = @$r->st_trainer_tel[$r->scope_st_select[$i]].'';
            $data['st_id']                      = intval(get_last_id('st_id', 'tb_scope_training')) + 1;
            Mongo::table('tb_scope_training')->insert($data);
            $data['st_training_trainee'] = null;
        }
    }
    public static function insert_scope_training2($r,$serial_number){
        $data['st_scope_serial_number'] = @$serial_number->scope_serial;
        $data['st_training_date']       = @$r->st_training_date.'';
        $data['st_training_topic']      = @$r->st_training_topic.'';
        if(isset($r->st_training_trainee)){
            if(count($r->st_training_trainee)!=0){
                $data['st_training_trainee']    = $r->st_training_trainee;
            }
        }else{
            $data['st_training_trainee'] = null;
        }
        $data['st_trainer_name']    = @$r->st_trainer_name.'';
        $data['st_trainer_tel']     = @$r->st_trainer_tel.'';
        $data['st_id']              = intval(get_last_id('st_id', 'tb_scope_training')) + 1;
        Mongo::table('tb_scope_training')->insert($data);
    }
    public static function update_scope_training($r){
        $data['st_training_date']   = @$r->st_training_date_edit.'';
        $data['st_training_topic']  = @$r->st_training_topic_edit.'';
        $data['st_trainer_name']    = @$r->st_trainer_name_edit.'';
        $data['st_trainer_tel']     = @$r->st_trainer_tel_edit.'';
        if(isset($r->st_training_trainee_edit)){
            if(count($r->st_training_trainee_edit)!=0){
                // $data['st_training_trainee']        = json_encode($r->st_training_trainee_edit);
                $data['st_training_trainee']        = $r->st_training_trainee_edit;
            }
        }else{
            $data['st_training_trainee'] = null;
        }
        Mongo::table('tb_scope_training')->where('st_id',intval($r->st_id_edit))->update($data);
    }



    public static function get_scope_pm_temp(){
        return Mongo::table('tb_scope_pm_temp')->where('sp_pm_date','!=',null)->orWhere('sp_pm_result','!=',null)->orWhere('sp_result_detail_pm','!=',null)->get();
    }
    public static function insert_scope_pm($r,$serial_number){
        $data['sp_scope_serial_number'] = @$serial_number->scope_serial;
        $data['sp_pm_date'] = @$r->sp_pm_date.'';
        $data['sp_pm_result'] = @$r->sp_pm_result.'';
        $data['sp_result_detail_pm'] = @$r->sp_result_detail_pm.'';
        $data['sp_ma_users'] = @$r->sp_ma_users.'';
        $data['sp_id']              = intval(get_last_id('sp_id', 'tb_scope_pm')) + 1;
        Mongo::table('tb_scope_pm')->insert($data);
    }
    public static function insert_scope_pm2($r){
        $data['sp_pm_date'] = @$r->sp_pm_date_edit.'';
        $data['sp_pm_result'] = @$r->sp_pm_result_edit.'';
        $data['sp_result_detail_pm'] = @$r->sp_result_detail_pm_edit.'';
        $data['sp_ma_users'] = @$r->sp_ma_users_edit.'';
        $data['sp_id']              = intval(get_last_id('sp_id', 'tb_scope_pm')) + 1;
        Mongo::table('tb_scope_pm')->where('sp_id',intval($r->st_id_edit))->update($data);
    }

    public static function insert_scope_serial($r){
        $count = count($r->scope_rp_select);
        for($i=0;$i<$count;$i++){
            // $temp = DB::table('tb_scope_repair_temp')->where('sr_id',$r->scope_rp_select[$i])->first();
            $data['sr_scope_serial_number']     = @$r->sr_scope_serial_number[$r->scope_rp_select[$i]].'';
            $data['sr_broken_date']             = @$r->sr_broken_date[$r->scope_rp_select[$i]].'';
            $data['sr_main_phenomenon_repair']  = @$r->sr_main_phenomenon_repair[$r->scope_rp_select[$i]].'';
            $data['sr_bringback_date']          = @$r->sr_bringback_date[$r->scope_rp_select[$i]].'';
            $data['sr_repair_analyze']          = @$r->sr_repair_analyze[$r->scope_rp_select[$i]].'';
            $data['sr_repair_price']            = @$r->sr_repair_price[$r->scope_rp_select[$i]].'';
            $data['sr_return_date']             = @$r->sr_return_date[$r->scope_rp_select[$i]].'';
            $data['sr_repair_status']           = @$r->sr_repair_status[$r->scope_rp_select[$i]].'';
            $data['sr_id']                      = intval(get_last_id('sr_id', 'tb_scope_repair')) + 1;
            Mongo::table('tb_scope_repair')->insert($data);
            $value['scope_status'] = "repair";
            Mongo::table('tb_scope')->where('scope_serial',@$r->sr_scope_serial_number[$r->scope_rp_select[$i]])->update($value);
        }
    }
    public static function insert_scope_serial2($r,$serial_number){
        $data['sr_broken_date'] = @$r->sr_broken_date_edit.'';
        $data['sr_bringback_date'] = @$r->sr_bringback_date_edit.'';
        $data['sr_main_phenomenon_repair'] = @$r->sr_main_phenomenon_repair_edit.'';
        $data['sr_repair_analyze'] = @$r->sr_repair_analyze_edit.'';
        $data['sr_repair_price'] = @$r->sr_repair_price_edit.'';
        $data['sr_return_date'] = @$r->sr_return_date_edit.'';
        $data['sr_repair_status'] = @$r->sr_repair_status_edit.'';
        Mongo::table('tb_scope_repair')->where('sr_id',intval($r->sr_id_edit))->update($data);
        $value['scope_status'] = "repair";
        Mongo::table('tb_scope')->where('scope_serial',@$serial_number->scope_serial)->update($value);
    }

    public static function count_register(){
        $view = Mongo::table('users')->where('user_type','register')->count();
        return $view;
    }

    public static function trackUPDATE($r,$scope_id){
        $tb_room    = (object) Mongo::table('tb_room')->where('room_id',intval($r->station_id))->first();
        $tb_scope   = (object) Mongo::table('tb_scope')->where('scope_id',intval($scope_id))->first();
        $last       = (object) Mongo::table('tb_casetrack')->where('track_rfid',$tb_scope->scope_rfid)->orderby('track_id','desc')->first();

        if($tb_room->room_type=="capture" || $tb_room->room_type=="storage"){
            $val['track_process']   = $tb_room->room_type;
            $val['track_rfid']      = $tb_scope->scope_rfid;
            $val['track_serial']    = $tb_scope->scope_serial;
            $val['track_station']   = $r->station_id;
            $val['track_user']      = $r->user_id;
            $val['track_date']      = date('Y-m-d');
            $val['track_time']      = date('H:i:s');
            $val['track_id']        = intval(get_last_id('', 'tb_casetrack')) + 1;
            if($last!=null){
                if($last->track_process=="cleaning"){
                    $json                       = jsonDecode($last->track_json);
                    $count                      = count($json);
                    $countsub                   = $count-1;
                    $json[$countsub]->minute    = CalMINUTE($json[$countsub]->time,date('H:i:s'));
                    // $new['track_json']          = jsonEncode($json);
                    $new['track_json']          = $json;
                }
                $new['track_status'] = 1;
                $new['track_minute'] = CalMINUTE($last->track_time,date('H:i:s'));
                Mongo::table('tb_casetrack')->where('track_id',intval($last->track_id))->update($new);
            }
            Mongo::table('tb_casetrack')->insert($val);

        }else{
            if($last!=null){
                if($last->track_process=="capture" || $last->track_process=="storage"){
                    $val['track_process']   = "cleaning";
                    $val['track_rfid']      = $tb_scope->scope_rfid;
                    $val['track_serial']    = $tb_scope->scope_serial;
                    $val['track_station']   = $r->station_id;
                    $val['track_user']      = $r->user_id;
                    $val['track_date']      = date('Y-m-d');
                    $val['track_time']      = date('H:i:s');
                    $val['track_id']        = intval(get_last_id('', 'tb_casetrack')) + 1;
                    if($last!=null){
                        $new['track_status'] = 1;
                        $new['track_minute'] = CalMINUTE($last->track_time,date('H:i:s'));
                        Mongo::table('tb_casetrack')->where('track_id',intval($last->track_id))->update($new);
                    }
                    $arr[0]['user']     = $r->user_id;
                    $arr[0]['type']     = $tb_room->room_type;
                    $arr[0]['process']  = $tb_room->room_name;
                    $arr[0]['time']     = date('H:i:s');
                    $arr[0]['minute']   = 0;
                    // $val['track_json']  = jsonEncode($arr);
                    $val['track_json']  = $arr;
                    Mongo::table('tb_casetrack')->insert($val);
                }else{
                    $json       = jsonDecode($last->track_json);
                    $count      = count($json);
                    $countsub   = $count-1;
                    $json[$countsub]->minute = CalMINUTE($json[$countsub]->time,date('H:i:s'));

                    $arr[$count]['user']     = $r->user_id;
                    $arr[$count]['type']     = $tb_room->room_type;
                    $arr[$count]['process']  = $tb_room->room_name;
                    $arr[$count]['time']     = date('H:i:s');
                    $arr[$count]['minute']   = 0;

                    $merge = array_merge($json,$arr);
                    // $val['track_json']  = jsonEncode($merge);
                    $val['track_json']  = $merge;
                    Mongo::table('tb_casetrack')->where('track_id',intval($last->track_id))->update($val);

                }
            }else{
                $val['track_process']   = 'cleaning';
                $val['track_rfid']      = $tb_scope->scope_rfid;
                $val['track_serial']    = $tb_scope->scope_serial;
                $val['track_station']   = $r->station_id;
                $val['track_user']      = $r->user_id;
                $val['track_date']      = date('Y-m-d');
                $val['track_time']      = date('H:i:s');
                $val['track_id']        = intval(get_last_id('', 'tb_casetrack')) + 1;
                if($last!=null){
                    $new['track_status'] = 1;
                    $new['track_minute'] = CalMINUTE($last->track_time,date('H:i:s'));
                    Mongo::table('tb_casetrack')->where('track_id',intval($last->track_id))->update($new);
                }
                $arr[0]['user']     = $r->user_id;
                $arr[0]['type']     = $tb_room->room_type;
                $arr[0]['process']  = $tb_room->room_name;
                $arr[0]['time']     = date('H:i:s');
                $arr[0]['minute']   = 0;
                // $val['track_json']  = jsonEncode($arr);
                $val['track_json']  = $arr;
                Mongo::table('tb_casetrack')->insert($val);
            }
        }
    }

    public static function show_room_name($id){
        $view = Mongo::table('tb_room')->where('room_id',intval($id))->select('room_id','room_name')->first();
        return $view;
    }
    public static function show_rrom($id){
        $view = Mongo::table('tb_room')->where('room_id',intval($id))->first();
        return $view;
    }

    public static function get_casetrack_trackchart($scope_serial){
        $main = [];
        $sub  = [];

        $w[] = array('track_serial',$scope_serial);

        $tb_casetrack = (object) Mongo::table('tb_casetrack')->where($w)->get();

        foreach ($tb_casetrack as $casetrack) {
            $casetrack = (object) $casetrack;
            $w1[] = array('scope_status',"available");
            $w1[] = array('scope_serial', $casetrack->track_serial);
            $tb_case   = (object) Mongo::table('tb_case')->where('caseuniq', $casetrack->track_caseuniq)->first();
            $tb_room   = (object) Mongo::table('tb_room')->where('room_id', intval($casetrack->case_room) )->where('room_id', intval($casetrack->room) )->first();

            foreach($tb_case as $key_case => $c){
                $sub[$key_case] = $c;
            }

            foreach($tb_room as $key_room => $r){
                $sub[$key_room] = $r;
            }

            if(count($sub) != 0){
                $main[] = $sub;
            }

            $sub = [];
            $w1 = [];
        }

        $main = collect($main);
        return $main;
    }
}
