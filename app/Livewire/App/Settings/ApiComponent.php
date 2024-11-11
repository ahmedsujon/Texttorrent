<?php

namespace App\Livewire\App\Settings;

use App\Models\Api;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

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

        $subUsers = DB::table('users')->where('parent_id', user()->id)->get();
        foreach ($subUsers as $user) {
            $cred = Api::where('user_id', $user->id)->first();
            $cred->user_id = $user->id;
            $cred->gateway = $this->gateway;
            $cred->account_sid = $this->account_sid;
            $cred->auth_token = $this->auth_token;
            $cred->save();
        }

        $this->mount();
        $this->dispatch('success', ['message' => 'API details updated successfully']);
    }
    public function render()
    {
        return view('livewire.app.settings.api-component')->layout('livewire.app.layouts.base');
    }
}
