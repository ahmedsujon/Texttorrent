<?php

namespace App\Livewire\App\Settings;

use App\Models\Api;
use Livewire\Component;

class ApiComponent extends Component
{
    public $gateway = 'Twilio', $account_sid, $auth_token;

    public function mount()
    {
        $data = Api::where('user_id', user()->id)->first();

        if ($data) {
            $this->gateway = $data->gateway;
            $this->account_sid = $data->account_sid;
            $this->auth_token = $data->auth_token;
        }
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'gateway' => 'required',
            'account_sid' => 'required',
            'auth_token' => 'required',
        ]);
    }

    public function updateData()
    {
        $this->validate([
            'gateway' => 'required',
            'account_sid' => 'required',
            'auth_token' => 'required',
        ]);

        $getData = Api::where('user_id', user()->id)->first();
        if (!$getData) {
            $data = new Api();
            $data->user_id = user()->id;
        } else {
            $data = Api::find($getData->id);
        }
        $data->gateway = $this->gateway;
        $data->account_sid = $this->account_sid;
        $data->auth_token = $this->auth_token;
        $data->save();

        $this->mount();
        $this->dispatch('success', ['message' => 'API details updated successfully']);
        $this->reset(['gateway', 'account_sid', 'auth_token']);
    }
    public function render()
    {
        return view('livewire.app.settings.api-component')->layout('livewire.app.layouts.base');
    }
}
