<?php

namespace App\Livewire\App;

use Livewire\Component;

class InboxComponent extends Component
{
    public function render()
    {
        return view('livewire.app.inbox-component')->layout('livewire.app.layouts.base');
    }
}
