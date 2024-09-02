<?php

namespace App\Livewire\App\Settings;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class ChangePasswordComponent extends Component
{
    public $current_password, $new_password;

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'current_password' => 'required',
            'new_password' => 'required|min:8',
        ]);
    }

    public function changePassword()
    {
        $this->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8',
        ]);

        if (Hash::check($this->current_password, user()->password)) {
            User::where('id', user()->id)->update(['password' => Hash::make($this->new_password)]);

            $this->current_password = '';
            $this->new_password = '';
            $this->dispatch('success', ['message' => 'Password changed successfully']);
        } else {
            session()->flash('error', 'Incorrect current password');
        }
    }

    public function render()
    {
        return view('livewire.app.settings.change-password-component')->layout('livewire.app.layouts.base');
    }
}
