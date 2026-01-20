<?php

namespace App\Livewire\Capture;

use Livewire\Component;
use App\Models\Mongo;
use App\Models\Livewire;

class Time extends Component
{
    public $case;
    public $procedure;
    public function mount($case)
    {

        $this->case         = Livewire::first($case);
        $tb_procedure       = Mongo::table('tb_procedure')->where('code', $this->case->case_procedurecode)->first();
        $this->procedure    = Livewire::first($tb_procedure);
    }

    public function render()
    {
        $tb_procedure       = Mongo::table('tb_procedure')->where('code', $this->case->case_procedurecode)->first();
        $this->procedure    = Livewire::first($tb_procedure);
        return view('livewire.capture.time');
    }

}
