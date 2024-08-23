<?php

namespace App\Livewire\App\Auth;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginComponent extends Component
{
    public $email, $password, $remember_me = 0, $login_status;

    public function userLogin()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $getUser = User::where('email', $this->email)->first();

        if ($getUser) {
            if (Hash::check($this->password, $getUser->password)) {
                $remember = $this->remember_me == 1 ? true : false;

                if(Auth::guard('web')->attempt(['email' => $this->email, 'password' => $this->password], $remember)){
                    $this->login_status = 1;
                    $this->dispatch('login_success');
                } else {
                    session()->flash('error', 'Incorrect email or password');
                }
            } else {
                session()->flash('error', 'Incorrect email or password');
            }
        } else {
            session()->flash('error', 'Incorrect email or password');
        }
    }

    public function render()
    {
        return view('livewire.app.auth.login-component')->layout('livewire.app.layouts.base');
    }
}
