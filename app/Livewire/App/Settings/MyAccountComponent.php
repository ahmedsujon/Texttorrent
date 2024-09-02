<?php

namespace App\Livewire\App\Settings;

use App\Models\User;
use Livewire\Component;

class MyAccountComponent extends Component
{
    public $avatar, $first_name, $last_name, $email, $phone, $company_name, $voicemail_notify_email, $voicemail_message_type, $greetings, $timezone;

    public function mount()
    {
        $user = User::find(user()->id);
        $this->avatar = $user->avatar;
        $this->first_name = $user->first_name;
        $this->last_name = $user->last_name;
        $this->email = $user->email;
        $this->phone = $user->phone;
        $this->company_name = $user->company_name;
        $this->voicemail_notify_email = $user->voicemail_notify_email;
        $this->voicemail_message_type = $user->voicemail_message_type;
        $this->greetings = $user->greetings;
        $this->timezone = $user->timezone;
    }

    public function saveData()
    {
        sleep(1);
        $this->validate([
            'first_name' => 'required|string|max:20',
            'last_name' => 'required|string|max:20',
            'email' => 'required|email|unique:users,email,' . user()->id,
            'phone' => 'required|string|unique:users,phone,' . user()->id,
            'company_name' => 'required|string|max:100',
            'voicemail_notify_email' => 'required|email',
            'voicemail_message_type' => 'required|in:text,file',
            'greetings' => 'required|string',
            'timezone' => 'required|string',
        ]);

        $data = User::find(user()->id);
        $data->first_name = $this->first_name;
        $data->last_name = $this->last_name;
        $data->email = $this->email;
        $data->phone = $this->phone;
        $data->company_name = $this->company_name;
        $data->voicemail_notify_email = $this->voicemail_notify_email;
        $data->voicemail_message_type = $this->voicemail_message_type;
        $data->greetings = $this->greetings;
        $data->timezone = $this->timezone;
        $data->save();

        $this->dispatch('success', ['message' => 'Your account details have been updated successfully']);
    }

    public function render()
    {
        return view('livewire.app.settings.my-account-component')->layout('livewire.app.layouts.base');
    }
}
