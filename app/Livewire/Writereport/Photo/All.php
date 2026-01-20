<?php

namespace App\Livewire\Writereport\Photo;

use Livewire\Component;
use App\Models\Mongo;

class All extends Component
{
    public $count = 11;
    public $case;
    public $folderdate;
    public $cid;
    public $procedurecode;
    public $caseuniq;
    public $photoall;
    public $photostart;
    public $hn;
    public $project_name;
    public function mount($case)
    {
        $this->cid              = (string) $case->id;
        $this->hn               = $case->hn;
        $this->folderdate       = $case->appointment_date;
        $this->procedurecode    = $case->case_procedurecode;
        $this->case             = remove_id($case);
        $this->caseuniq         = $case->caseuniq;
        $this->photoall         = $case->photo ?? [];
        $this->photostart       = $case->photo ?? [];
        $admin                  = getCONFIG("admin");
        $this->project_name     = $admin->project;
    }

    public function render()
    {
        return view('case.component.reportwrite.photo.all');
    }

    public function rollbackphoto($picID)
    {
        // Mongo::table('tb_case')->where('id', $this->cid)->update(['photo' => $this->photoall]);
        $this->dispatch('refreshPage');
    }

    public function removePhoto($picID)
    {
        // $tb_case = Mongo::table('tb_case')->where('id', $this->cid)->first();
        // $photoall = $this->photoall;
        $current = $this->photoall[$picID]['ns'];
        if ($this->photoall[$picID]['st'] != 0) {
            $this->photoall[$picID]['st'] = 0;
        } else {
            $this->photoall[$picID]['st'] = 1;
            $this->photoall[$picID]['ns'] = 0;
        }
        foreach ($this->photoall as $key => $value) {
            if ($this->photoall[$key]['ns'] > $current && $current != 0) {
                $this->photoall[$key]['ns'] = $this->photoall[$key]['ns'] - 1;
            }
        }
        // $this->photoall = $photoall;
        Mongo::table('tb_case')->where('id', $this->cid)->update(['photo' => $this->photoall]);
    }

    public function selectedPhoto($picID)
    {
        // $photoall = $this->photoall;
        if ($this->photoall[$picID]['ns'] == 0) {
            $max_ns = 0;
            foreach ($this->photoall as $key => $value) {
                if ($this->photoall[$key]['ns'] > $max_ns) {
                    $max_ns = $this->photoall[$key]['ns'];
                }
            }
            $this->photoall[$picID]['ns'] = $max_ns + 1;
        } else {
            $current = $this->photoall[$picID]['ns'];
            foreach ($this->photoall as $key => $value) {
                if ($this->photoall[$key]['ns'] > $current && $current != 0) {
                    $this->photoall[$key]['ns'] = $this->photoall[$key]['ns'] - 1;
                }
            }
            $this->photoall[$picID]['ns'] = 0;
        }
        // $this->photoall = $photoall;
        Mongo::table('tb_case')->where('id', $this->cid)->update(['photo' => $this->photoall]);
    }


}
