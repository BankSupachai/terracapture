<?php

namespace App\Livewire;

use Livewire\Component;

class Luminacomponent extends Component
{
    public $isOpen = false;

    public function openModal()
    {
        $this->isOpen = true;
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function render()
    {
        return view('livewire.modal-component');
    }
}
