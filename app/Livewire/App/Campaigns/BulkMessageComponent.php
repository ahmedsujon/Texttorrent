<?php

namespace App\Livewire\App\Campaigns;

use App\Models\BulkMessage;
use App\Models\Number;
use Livewire\Component;
use App\Models\ContactList;
use App\Models\InboxTemplate;
use Illuminate\Support\Facades\Auth;

class BulkMessageComponent extends Component
{
    public $user_id, $contact_list_id, $inbox_template_id, $number_pool = true, $batch_process = true, $opt_out_link = true,
        $round_robin_campaign = true, $phone_numbers, $sms_type, $sms_body, $appended_message, $batch_size, $batch_frequency,
        $sending_throttle;

    public function storeData()
    {
        $this->validate([
            'contact_list_id' => 'required',
            'inbox_template_id' => 'required',
        ]);

        $data = new BulkMessage();
        $data->user_id = user()->id;
        $data->contact_list_id = $this->contact_list_id;
        $data->inbox_template_id = $this->inbox_template_id;
        $data->number_pool = $this->number_pool;
        $data->batch_process = $this->batch_process;
        $data->opt_out_link = $this->opt_out_link;
        $data->round_robin_campaign = $this->round_robin_campaign;
        $data->phone_numbers = $this->phone_numbers;
        $data->sms_type = $this->sms_type;
        $data->sms_body = $this->sms_body;
        $data->appended_message = $this->appended_message;
        $data->batch_size = $this->batch_size;
        $data->batch_frequency = $this->batch_frequency;
        $data->sending_throttle = $this->sending_throttle;
        // dd($data);
        $data->save();

        $this->dispatch('closeModal');
        $this->dispatch('success', ['message' => 'Bulk message send successfully!']);
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->reset([
            'user_id',
            'contact_list_id',
            'inbox_template_id',
            'number_pool',
            'sender_number',
            'batch_process',
            'opt_out_link',
            'round_robin_campaign',
            'phone_numbers',
            'sms_type',
            'sms_body',
            'appended_message',
            'batch_size',
            'batch_frequency',
            'sending_throttle'
        ]);
    }

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
