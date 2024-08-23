<?php

namespace App\Livewire\App;

use Livewire\Component;

class ClaimsComponent extends Component
{
    public function render()
    {
        return view('livewire.app.claims-component')->layout('livewire.app.layouts.base');
    }
}
