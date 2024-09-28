<?php

namespace App\Livewire\Web;

use Livewire\Component;

class FeatureComponent extends Component
{
    public function render()
    {
        return view('livewire.web.feature-component')->layout('livewire.web.layouts.base');
    }
}
