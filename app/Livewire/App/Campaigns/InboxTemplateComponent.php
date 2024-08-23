<?php

namespace App\Livewire\App\Campaigns;

use Livewire\Component;

class InboxTemplateComponent extends Component
{
    public function render()
    {
        return view('livewire.app.campaigns.inbox-template-component')->layout('livewire.app.layouts.base');
    }
}
