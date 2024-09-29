<?php

namespace App\Livewire\Web;

use Livewire\Component;

class ContactUsComponent extends Component
{
    public function render()
    {
        return view('livewire.web.contact-us-component')->layout('livewire.web.layouts.base');
    }
}
