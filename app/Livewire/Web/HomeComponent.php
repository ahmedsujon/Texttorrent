<?php

namespace App\Livewire\Web;

use Livewire\Component;

class HomeComponent extends Component
{
    public function render()
    {
        return view('livewire.web.home-component')->layout('livewire.web.layouts.base');
    }
}
