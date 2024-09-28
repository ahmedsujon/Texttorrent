<?php

namespace App\Livewire\Web;

use Livewire\Component;

class AboutComponent extends Component
{
    public function render()
    {
        return view('livewire.web.about-component')->layout('livewire.web.layouts.base');
    }
}
