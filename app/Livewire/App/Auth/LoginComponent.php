<?php

namespace App\Livewire\App\Auth;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginComponent extends Component
{
    public $email, $password, $remember_me = 0, $login_status;

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'email' => 'required|email',
            'password' => 'required',
        ]);
    }

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

                if (Auth::guard('web')->attempt(['email' => $this->email, 'password' => $this->password], $remember)) {
                    $this->login_status = 1;
                    $this->dispatch('login_success');

                    // Redirect to user dashboard after successful login
                    return redirect()->route('user.dashboard');
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

    public $status = 0;
    public function togglePasswordVisibility()
    {
        $this->status = $this->status == 0 ? 1 : 0;
    }

    public function render()
    {
        $this->dispatch('reloadScripts');
        return view('livewire.app.auth.login-component')->layout('livewire.app.auth.layouts.base');
    }
}
