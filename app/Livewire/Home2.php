<?php

namespace App\Livewire;

use Livewire\Component;

class Home2 extends Component
{
    public $count = 11;

    public function up(){
        $this->count++;
    }

    public function down(){
        $this->count--;
    }

    public function render()
    {
        return view('livewire.counter.counter');
    }
}
