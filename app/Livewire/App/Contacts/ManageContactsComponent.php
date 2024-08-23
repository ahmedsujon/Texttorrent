<?php

namespace App\Livewire\App\Contacts;

use Livewire\Component;

class ManageContactsComponent extends Component
{
    public function render()
    {
        return view('livewire.app.contacts.manage-contacts-component')->layout('livewire.app.layouts.base');
    }
}
