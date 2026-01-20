<?php

namespace App\Livewire\Capture;

use Livewire\Component;
use App\Models\Mongo;
use App\Models\Livewire;
use App\Models\Department;

class Attendant extends Component
{
    public $case;
    public $procedure;
    public $doctor;
    public $nurse;
    public $room;
    public $nurse_assistant;
    public $user_in_case;
    public $cid;
    
    public function render()
    {
        return view('livewire.capture.attendant');
    }
    public function mount($case)
    {
        // dd($case);
        // $department = Department::
        $this->cid              = $case->id;
        $this->case             = Livewire::first($case);
        $doctor                 = Mongo::table('users')->where('user_type','doctor')->get();
        $nurse                  = Mongo::table('users')->where('user_type','nurse')->get();
        $nurse_assistant        = Mongo::table('users')->where('user_type','nurse_assistant')->get();
        $room                   = Department::room(uid());

        // dd($this->case->user_in_case);
        $userincase             = Mongo::table('users')->whereIn('uid',$this->case->user_in_case??[])->get();
        $this->doctor           = Livewire::get($doctor);
        $this->nurse            = Livewire::get($nurse);
        $this->nurse_assistant  = Livewire::get($nurse_assistant);
        $this->room             = Livewire::get($room);
        $this->user_in_case     = Livewire::get($userincase);
    }

    public function add_selectphysician($uid)
    {
        $val['case_physicians01'] = $uid;
        $tb_user = $this->doctor->where('uid',$uid)->first();
        $val['doctorname'] = fullname($tb_user);
        Mongo::table('tb_case')->where('id',$this->cid)->update($val);
    }

    public function add_selectroom($room_id)
    {
        $val['case_room'] = intval($room_id);
        $tb_room = $this->room->where('room_id',$room_id)->first();
        $val['room'] = $tb_room->room_name;
        Mongo::table('tb_case')->where('id',$this->cid)->update($val);
    }

    public function add_selectuser($uid)
    {
        // dd($uid);
        $temp = array();
        $arr = $this->case->user_in_case??[];
        $arr[] = $uid;
        $val['user_in_case'] = $arr;
        Mongo::table('tb_case')->where('id',$this->cid)->update($val);
        foreach ($arr as $value) {
            $temp[] = intval($value);
        }
        $userincase             = Mongo::table('users')->whereIn('uid',$temp)->get();
        $this->user_in_case     = Livewire::get($userincase);
        $tb_case = Mongo::table('tb_case')->where('id',$this->cid)->first();
        $this->case = Livewire::first($tb_case);
    }

    public function del_selectuser($uid)
    {
        $uid = intval($uid);
        $temp = array();
        foreach ($this->case->user_in_case??[] as $value) {
            if ($value != $uid) {
                $temp[] = intval($value);
            }
        }
        $val['user_in_case'] = $temp;
        Mongo::table('tb_case')->where('id',$this->cid)->update($val);
        $userincase             = Mongo::table('users')->whereIn('uid',$temp)->get();
        $this->user_in_case     = Livewire::get($userincase);
        $tb_case = Mongo::table('tb_case')->where('id',$this->cid)->first();
        $this->case = Livewire::first($tb_case);
    }



}