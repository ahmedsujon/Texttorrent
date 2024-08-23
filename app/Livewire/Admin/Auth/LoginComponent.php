<?php

namespace App\Livewire\Admin\Auth;

use App\Models\Admin;
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

    public function adminLogin()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $getAdmin = Admin::where('email', $this->email)->first();

        if ($getAdmin) {
            if (Hash::check($this->password, $getAdmin->password)) {
                $remember = $this->remember_me == 1 ? true : false;

                if(Auth::guard('admin')->attempt(['email' => $this->email, 'password' => $this->password], $remember)){
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
        return view('livewire.admin.auth.login-component')->layout('livewire.admin.auth.layout.base');
    }
}
