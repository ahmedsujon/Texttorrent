<?php

namespace App\Livewire\App\Settings;

use App\Models\User;
use App\Models\UserPermission;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithPagination;

class SubAccountComponent extends Component
{
    use WithPagination;
    public $sortBy = 'created_at', $sortDirection = 'DESC';
    public $searchTerm, $sortingValue = 10, $delete_id, $edit_id, $lPermissions, $mPermissions, $rPermissions;
    public $user_id, $first_name, $last_name, $username, $email, $password, $confirm_password, $permissions = [];

    public function mount()
    {
        $this->lPermissions = UserPermission::where('position', 'left')->get();
        $this->mPermissions = UserPermission::where('position', 'middle')->get();
        $this->rPermissions = UserPermission::where('position', 'right')->get();
    }

    public function storeData()
    {
        $this->validate([
            'username' => 'required|unique:users,username',
            'email' => 'required|email|unique:users,email',
            'first_name' => 'required|max:20',
            'last_name' => 'required|max:20',
            'password' => 'required|string|min:6',
            'confirm_password' => 'required|same:password',
        ]);

        $user = new User();
        $user->first_name = $this->first_name;
        $user->last_name = $this->last_name;
        $user->username = $this->username;
        $user->email = $this->email;
        $user->password = Hash::make($this->password);
        $user->permissions = $this->permissions;
        $user->type = 'sub';
        $user->parent_id = user()->id;
        $user->save();

        $this->dispatch('closeModal');
        $this->dispatch('success', ['message' => 'New sub user added successfully']);
        $this->resetForm();
    }

    public function editData($id)
    {
        $subAccount = User::findOrFail($id);
        $this->edit_id = $subAccount->id;
        $this->first_name = $subAccount->first_name;
        $this->last_name = $subAccount->last_name;
        $this->username = $subAccount->username;
        $this->email = $subAccount->email;
        $this->permissions = $subAccount->permissions;
        $this->password = '';

        $this->dispatch('showEditModal');
    }

    public function updateData()
    {
        if ($this->password) {
            $this->validate([
                'username' => 'required|unique:users,username,'.$this->edit_id.'',
                'email' => 'required|email|unique:users,email,'.$this->edit_id.'',
                'first_name' => 'required|max:20',
                'last_name' => 'required|max:20',
                'password' => 'required|string|min:6',
                'confirm_password' => 'required|same:password',
            ]);
        } else {
            $this->validate([
                'username' => 'required|unique:users,username,'.$this->edit_id.'',
                'email' => 'required|email|unique:users,email,'.$this->edit_id.'',
                'first_name' => 'required|max:20',
                'last_name' => 'required|max:20',
            ]);
        }

        $user = User::find($this->edit_id);
        $user->first_name = $this->first_name;
        $user->last_name = $this->last_name;
        $user->username = $this->username;
        $user->email = $this->email;
        if ($this->password) {
            $user->password = Hash::make($this->password);
        }
        $user->permissions = $this->permissions;
        $user->save();

        $this->dispatch('closeModal');
        $this->dispatch('success', ['message' => 'User updated successfully']);
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->reset(['username', 'email', 'first_name', 'last_name', 'password']);
        $this->permissions = [];
    }

    public function delete($id)
    {
        User::find($id)->delete();
        session()->flash('message', 'Sub Account Deleted Successfully.');
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

    public function render()
    {
        $subAccounts = User::where(function($q){
            $q->where('first_name', 'like', '%'.$this->searchTerm.'%')
                ->orWhere('last_name', 'like', '%'.$this->searchTerm.'%');
        })->orderBy($this->sortBy, $this->sortDirection)->where('type', 'sub')->where('parent_id', user()->id)->paginate($this->sortingValue);

        return view('livewire.app.settings.sub-account-component', ['subAccounts' => $subAccounts])->layout('livewire.app.layouts.base');
    }
}
