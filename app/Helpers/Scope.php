<?php
    use App\Models\Track\Scope;
    use App\Models\Mongo;
use App\Models\Server;

    function get_scope_type($scope_type){
        $s[0] = array('scope_type', $scope_type);
        $scope_count = Mongo::table('tb_scope')->where($s)->count();
        return $scope_count;
    }

    function get_casetrack_by_scope_type($scope_type){
        $main = [];
        $sub  = [];
        $w[]  = array('track_process', 'storage');
        $w[]  = array('track_status', 0);
        $orw[] = array('track_status', "0");
        $orw[]  = array('track_process', 'storage');
        $tb_casetrack = Mongo::table('tb_casetrack')->where($w)->orWhere($orw)->get();
        foreach ($tb_casetrack as $key_casetrack => $casetrack) {
            $casetrack = (object) $casetrack;
            $w1[]      = array('scope_serial', $casetrack->track_serial);
            // $w1[]      = array('scope_type', $scope_type);
            $tb_scope  = (object) Mongo::table('tb_scope')->where($w1)->first();

            foreach($casetrack as $key_casetrack => $ct){
                $sub[$key_casetrack] = $ct;
            }

            foreach($tb_scope as $key_scope => $sc){
                $sub[$key_scope] = $sc;   
            }

            $main[] = $sub;
            $sub = [];
            $w1 = [];
        }


        $count = 0;
        foreach($main as $m){
            $m = (object) $m;
            if(isset($m->scope_type)){
                if($m->scope_type == $scope_type){
                    $count += 1;
                }   
            }
        }

        return $count;

    }

    function get_room_name_server($id){
        $room_name = '';
        if(isset($id)){
            $room = Server::table('tb_room')->where('room_id', intval($id))->first();
            $room = (object) $room;
            if(isset($room->room_name)){
                $room_name = @$room->room_name."";
            }
        }
        return $room_name;
    }


    function get_casetrack_first($w){
        return (object) Mongo::table('tb_casetrack')->where($w)->first();
    }

    function get_user_first($w){
        return (object) Mongo::table('users')->where($w)->first();
    }

    function get_room_first($w){
        return (object) Mongo::table('tb_room')->where($w)->first();
    }

    function get_scope_first($w){
        return (object) Mongo::table('tb_scope')->where($w)->first();
    }

    function get_location_scope($sc_serial, $sc_status){
        
        $w[] = array('track_serial', $sc_serial);
        $w[] = array('track_type', $sc_status);
        $casetrack = Mongo::table('tb_casetrack')->where($w)->first();

        $location = '-';
        if(!isset($casetrack)){
            return $location; 
        }

        $casetrack = (object) $casetrack;
        if(isset($casetrack->track_station)){
            $w1[] = array('room_id', intval($casetrack->track_station));
            $room = Mongo::table('tb_room')->where($w1)->first();
            if(!isset($room)){
                return $location; 
            }
            $room = (object) $room;
            $location = isset($room->room_name) ? $room->room_name : '';
        }

        return $location;
    }
?>