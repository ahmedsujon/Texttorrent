<?php

namespace App\Livewire\Web;

use Livewire\Component;

class PrivacyPolicyComponent extends Component
{
    public function render()
    {
        return view('livewire.web.privacy-policy-component')->layout('livewire.web.layouts.base');
    }
}
