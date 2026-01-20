<?php

    use App\Models\Mongo;
    use App\Models\Server;

    function samedepartment($array_other){
        $same = array();
        $i = 0;
        foreach($array_other as $d){
            $other  = jsonDecode($d->procedure_json);
            $user   = jsonDecode(Auth::user()->procedure_json);
            $result=array_intersect($other,$user);
            $count_array = count($result);
            if($count_array>0){
                $same[$i]['name']    = $d->name;
                $same[$i]['id']      = $d->id;
                $i++;
            }
        }
        return (Object) $same;
    }

    function get_last_id($col, $table){
        $last_id = Mongo::table($table)->get();
        // dd($last_id);
        $total   = count($last_id);
        $num     = 1;
        foreach($last_id as $index=>$r){
            if(isset($r->$col)){
                if($num < intval($r->$col)){
                    $num = intval($r->$col);
                }
            } else {
                $num = $num + 1;
            }

        }
        return isset($num) ? intval($num) : 0;
    }

    function get_last_id_server($col, $table){
        $last_id = Server::table($table)->get();
        $total   = count($last_id);
        $num     = 1;
        foreach($last_id as $index=>$r){
            if(isset($r->$col)){
                if($num < intval($r->$col)){
                    $num = intval($r->$col);
                }
            } else {
                $num = $num + 1;
            }
        }
        return isset($num) ? intval($num) : 0;
    }


?>
