<?php

namespace App\Livewire\App\Campaigns;

use App\Models\Number;
use Livewire\Component;
use App\Models\ContactList;
use App\Models\InboxTemplate;
use Illuminate\Support\Facades\Auth;

class BulkMessageComponent extends Component
{
    public $user_id, $contact_list_id, $inbox_template_id, $number_pool, $batch_process, $opt_out_link,
        $round_robin_campaign, $phone_numbers, $sms_type, $sms_body, $appended_message, $batch_size, $batch_frequency,
        $sending_throttle;

    public function render()
    {
        $contactLists = ContactList::orderBy('id', 'DESC')->get();
        $messageTemplates = InboxTemplate::orderBy('id', 'DESC')->get();
        $activeNumbers = Number::where('id', Auth::user()->id)->orderBy('id', 'DESC')->get();
        return view(
            'livewire.app.campaigns.bulk-message-component',
            [
                'contactLists' => $contactLists,
                'messageTemplates' => $messageTemplates,
                'activeNumbers' => $activeNumbers
            ]
        )->layout('livewire.app.layouts.base');
    }
}
