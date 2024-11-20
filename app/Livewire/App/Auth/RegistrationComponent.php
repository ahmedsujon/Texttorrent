<?php

namespace App\Livewire\App\Auth;

use App\Models\User;
use Livewire\Component;
use App\Models\UserPermission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegistrationComponent extends Component
{
    public $name, $username, $email, $phone, $password, $confirm_password, $notify_status, $latitude, $longitude;

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|unique:users,phone',
            'password' => 'required|min:8|max:30',
            // 'confirm_password' => 'required|min:8|max:30|same:password',
        ]);
    }

    public function userRegistration()
    {
        $this->validate([
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|unique:users,phone',
            'password' => 'required|min:8|max:30',
            // 'confirm_password' => 'required|min:8|max:30|same:password',
        ]);

        $user = new User();
        $user->email = $this->email;
        $user->phone = $this->phone;
        $user->password = Hash::make($this->password);
        $user->permissions = UserPermission::pluck('id')->toArray();
        $user->save();

        Auth::guard('web')->attempt(['email' => $this->email, 'password' => $this->password]);
        session()->flash('success', 'Registration successful');
        return redirect()->route('user.dashboard');
    }

    // public function userLogin()
    // {
    //     $this->validate([
    //         'email' => 'required|email',
    //         'password' => 'required',
    //     ]);

    //     $getUser = User::where('email', $this->email)->first();

    //     if ($getUser) {
    //         if (Hash::check($this->password, $getUser->password)) {
    //             $remember = $this->remember_me == 1 ? true : false;

    //             if(Auth::guard('web')->attempt(['email' => $this->email, 'password' => $this->password], $remember)){
    //                 $this->login_status = 1;
    //                 $this->dispatch('login_success');
    //             } else {
    //                 session()->flash('error', 'Incorrect email or password');
    //             }
    //         } else {
    //             session()->flash('error', 'Incorrect email or password');
    //         }
    //     } else {
    //         session()->flash('error', 'Incorrect email or password');
    //     }
    // }


    public function render()
    {
        return view('livewire.app.auth.registration-component')->layout('livewire.app.auth.layouts.base');
    }
}
