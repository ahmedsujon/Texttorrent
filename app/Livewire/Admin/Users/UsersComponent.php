<?php

namespace App\Livewire\Admin\Users;

use App\Models\Api;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;

class UsersComponent extends Component
{
    use WithPagination, WithFileUploads;
    public $sortingValue = 10, $searchTerm;
    public $sortBy = 'created_at', $sortDirection = 'DESC';
    public $edit_id, $delete_id;
    public $first_name, $last_name, $username, $email, $phone, $password, $avatar, $uploadedAvatar,
        $gateway, $account_sid, $auth_token;

    #[Url('history:true')]
    public function mount() {}

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'first_name' => 'required|string|max:20|min:3',
            'last_name' => 'required|string|max:20|min:3',
            'username' => 'required|string|unique:users,username,' . $this->edit_id . '',
            'email' => 'required|email|unique:users,email,' . $this->edit_id . '',
            'phone' => 'required|string|unique:users,phone,' . $this->edit_id . '',
            'password' => 'required|min:6|max:20',
            'avatar' => 'required|file|mimes:jpg,png,jpeg',
        ]);
    }

    public function storeData()
    {
        $this->validate([
            'first_name' => 'required|string|max:20|min:3',
            'last_name' => 'required|string|max:20|min:3',
            'username' => 'required|string|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|unique:users,phone',
            'password' => 'required|min:6|max:20',
            'avatar' => 'required|file|mimes:jpg,png,jpeg,webp',
        ]);

        $user = new User();
        $user->first_name = $this->first_name;
        $user->last_name = $this->last_name;
        $user->full_name = $this->first_name . ' ' . $this->last_name;
        $user->username = $this->username;
        $user->email = $this->email;
        $user->phone = $this->phone;
        $user->password = Hash::make($this->password);

        if ($this->avatar) {
            $file = uploadFile('image', 40, 'profile-images/', 'admin', $this->avatar);
            $user->avatar = $file;
        }

        $user->save();

        $this->dispatch('closeModal');
        $this->resetInputs();
        $this->dispatch('success', ['message' => 'New user added successfully']);
    }

    public function editData($id)
    {
        $data = User::find($id);
        $this->first_name = $data->first_name;
        $this->last_name = $data->last_name;
        $this->username = $data->username;
        $this->email = $data->email;
        $this->phone = $data->phone;
        $this->uploadedAvatar = $data->avatar;
        $this->edit_id = $data->id;
        $this->dispatch('showEditModal');
    }

    public function updateData()
    {
        if ($this->password) {
            $this->validate([
                'first_name' => 'required|string|max:20|min:3',
                'last_name' => 'required|string|max:20|min:3',
                'username' => 'required|string|unique:users,username,' . $this->edit_id . '',
                'email' => 'required|email|unique:users,email,' . $this->edit_id . '',
                'phone' => 'required|string|unique:users,phone,' . $this->edit_id . '',
                'password' => 'min:8|max:25',
            ]);
        } else {
            $this->validate([
                'first_name' => 'required|string|max:20|min:3',
                'last_name' => 'required|string|max:20|min:3',
                'username' => 'required|string|unique:users,username,' . $this->edit_id . '',
                'email' => 'required|email|unique:users,email,' . $this->edit_id . '',
                'phone' => 'required|string|unique:users,phone,' . $this->edit_id . '',
            ]);
        }

        $user = User::where('id', $this->edit_id)->first();
        $user->first_name = $this->first_name;
        $user->last_name = $this->last_name;
        $user->full_name = $this->first_name . ' ' . $this->last_name;
        $user->username = $this->username;
        $user->email = $this->email;
        $user->phone = $this->phone;
        $user->password = Hash::make($this->password);

        if ($this->avatar) {
            deleteFile($user->avatar);

            $file = uploadFile('image', 40, 'profile-images/', 'admin', $this->avatar);
            $user->avatar = $file;
        }
        $user->save();
        $this->dispatch('closeModal');
        $this->resetInputs();
        $this->dispatch('success', ['message' => 'User updated successfully']);
    }

    public function apiIntrigation($userId)
    {
        $data = Api::where('user_id', $userId)->first();
        if ($data) {
            $this->gateway = $data->gateway;
            $this->account_sid = $data->account_sid;
            $this->auth_token = $data->auth_token;
            $this->edit_id = $data->id;
            $this->dispatch('showAPIModal');
        } else {
            session()->flash('error', 'No API data found for this user.');
        }
    }


    public function resetInputs()
    {
        $this->first_name = '';
        $this->last_name = '';
        $this->username = '';
        $this->email = '';
        $this->phone = '';
        $this->password = '';
        $this->avatar = '';
        $this->uploadedAvatar = '';
        $this->delete_id = '';
        $this->edit_id = '';
    }

    public function close()
    {
        $this->resetInputs();
    }

    //Update Admin Status
    public function changeStatus($id, $status)
    {
        User::where('id', $id)->update(['status' => ($status == 1 ? 0 : 1)]);
        $this->dispatch('success', ['message' => 'User updated successfully.']);
    }

    //Delete Admin
    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatch('show_delete_confirmation');
    }

    public function deleteData()
    {
        $user = User::where('id', $this->delete_id)->first();
        deleteFile($user->avatar);
        $user->delete();

        $this->dispatch('user_deleted');
        $this->delete_id = '';
    }

    public function setSortBy($sortByField)
    {
        if ($this->sortBy === $sortByField) {
            $this->sortDirection = ($this->sortDirection ==  "ASC") ? 'DESC' : "ASC";
            return;
        }
        $this->sortBy = $sortByField;
        $this->sortDirection = 'DESC';
    }

    public function updateSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $users = User::where('first_name', 'like', '%' . $this->searchTerm . '%')
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->sortingValue);
        $this->dispatch('reload_scripts');
        return view('livewire.admin.users.users-component', ['users' => $users])->layout('livewire.admin.layouts.base');
    }
}
