<?php

namespace App\Livewire\App\Auth;

use App\Models\User;
use Livewire\Component;
use App\Models\UserPermission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Activitylog\Traits\LogsActivity;

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
        ]);

        // Create and save the user
        $user = new User();
        $user->email = $this->email;
        $user->phone = $this->phone;
        $user->password = Hash::make($this->password);
        $user->permissions = UserPermission::pluck('id')->toArray(); // Store permissions as JSON
        $user->save();

        // Log the user in after registration
        Auth::guard('web')->attempt(['email' => $this->email, 'password' => $this->password]);

        // Flash success message and redirect to user dashboard
        session()->flash('success', 'Registration successful');
        return redirect()->route('user.dashboard');
    }

    public function render()
    {
        return view('livewire.app.auth.registration-component')->layout('livewire.app.auth.layouts.base');
    }
}
