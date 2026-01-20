<?php
namespace App\Http\Controllers;

use App\Models\Server;
use Illuminate\Http\Request;

class OverallController extends Controller
{

    public function index()
    {
        if(Server::check_connection()){return redirect(url('servererror'));}
        $view['patient']        = $this->get_patient_status();
        $view['rooms']          = $this->get_room_monitor();
        $view['scope_status']   = $this->get_scope_status();
        $view['scope_count']    = $this->get_scope_count();
        // dd($view);
        return view('overall', $view);
    }

    public function get_patient_status(){
        $main = [];
        $main['booking']    = Server::table('tb_casemonitor')->where('monitor_status', 'Booking')->count();
        $main['holding']    = Server::table('tb_casemonitor')->where('monitor_status', 'Holding')->count();
        $main['operation']  = Server::table('tb_casemonitor')->where('monitor_status', 'Operation')->count();
        $main['recovery']   = Server::table('tb_casemonitor')->where('monitor_status', 'Recovery')->count();
        $main['discharge']  = Server::table('tb_casemonitor')->where('monitor_status', 'Discharge')->count();
        foreach ($main as $key => $count) {
            if(!isset($count)){
                $main[$key] = 0;
            }
        }
        return $main;
    }

    public function get_room_monitor(){
        $rooms = Server::table('tb_room')->get();
        return isset($rooms)?$rooms:[];
    }

    public function get_scope_status(){
        $scope_update = Server::table('tb_scope_update')->get();
        $main = [];
        foreach (isset($scope_update)?$scope_update:[] as $scope) {
            $scope = (object) $scope;
            $scope_rfid = isset($scope->scope_rfid) ? $scope->scope_rfid : null;
            if(!isset($scope_rfid)){
                continue;
            }

            $casetrack = Server::table('tb_casetrack')->where('track_rfid', $scope_rfid)->orderBy('_id', 'desc')->first();
            if(!isset($casetrack)){
                $main[] = $scope;
            } else {
                $sub = [];
                $casetrack = (object) $casetrack;
                foreach (isset($casetrack)?$casetrack:[] as $key => $track) {
                    $sub[$key] = $track;
                }

                foreach (isset($scope)?$scope:[] as $key => $s) {
                    $sub[$key]   = $s;
                }

                $main[] = (object) $sub;
            }
        }

        $main = collect($main);
        return $main;
    }

    public function get_scope_count(){
        $main = [];
        $main['Operation']  = Server::table('tb_scope_update')->where('scope_status','like','%capture%')->count();
        $main['Reprocess']  = Server::table('tb_scope_update')->where('scope_status','like','%wash%')->count();
        $main['Disable']    = Server::table('tb_scope_update')->where('scope_status','like','%disable%')->count();
        $main['Repair']     = Server::table('tb_scope_update')->where('scope_status','like','%repair%')->count();
        $main['Available']  = Server::table('tb_scope_update')->where('scope_status','like','%available%')->count();
        foreach ($main as $key => $count) {
            if(!isset($count)){
                $main[$key] = 0;
            }
        }
        return $main;
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
