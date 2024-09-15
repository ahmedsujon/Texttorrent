<?php

namespace App\Livewire\App\Auth;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class NewPasswordComponent extends Component
{
    public $token, $email, $password, $confirm_password;

    public function mount()
    {
        $this->token = request()->token;
    }

    public function changePassword()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
            'confirm_password' => 'required|min:8|same:password',
        ]);

        $getRequest = DB::table('password_resets')->where('email', $this->email)->where('token', $this->token)->first();
        if ($getRequest) {
            $admin = User::where('email', $this->email)->first();
            $admin->password = Hash::make($this->password);
            $admin->save();

            DB::table('password_resets')->where('email', $this->email)->where('token', $this->token)->delete();
            session()->flash('success', 'Password resect successfully!');
        } else {
            session()->flash('error', 'Something went to wrong!');
        }
    }

    public function render()
    {
        return view('livewire.app.auth.new-password-component')->layout('livewire.app.auth.layouts.base');
    }
}
