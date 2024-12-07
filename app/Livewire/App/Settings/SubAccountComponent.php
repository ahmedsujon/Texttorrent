<?php

namespace App\Livewire\App\Settings;

use App\Models\Api;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\UserPermission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

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

    public function addSubAccount()
    {
        if (getActiveSubscription()['status'] == 'Active') {
            $count = User::where('type', 'sub')->where('parent_id', user()->id)->count();
            if (user()->sub_accounts > $count) {
                $this->dispatch('showAddAccountModal');
            } else {
                $this->dispatch('error', ['message' => 'You have reached your limit of sub accounts. Please upgrade your plan.']);
            }
        } else {
            $this->dispatch('error', ['message' => 'You have no active subscription. Please upgrade your plan.']);
        }

        $this->resetForm();
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
        $user->status = 1;
        $user->save();

        // $twilio_credentials = Api::where('user_id', user()->id)->first();
        // $cred = new Api();
        // $cred->user_id = $user->id;
        // $cred->gateway = $twilio_credentials->gateway;
        // $cred->account_sid = $twilio_credentials->account_sid;
        // $cred->auth_token = $twilio_credentials->auth_token;
        // $cred->save();

        $data['first_name'] = $this->first_name;
        $data['last_name'] = $this->last_name;
        $data['email'] = $this->email;
        $data['password'] = $this->password;
        $data['url'] = 'https://www.texttorrent.com/login';
        Mail::send('emails.sub-account-created', $data, function ($message) use ($data) {
            $message->to($data['email'])
                ->subject('Account Created');
        });

        // $mUser = User::find(user()->id);
        // $mUser->sub_accounts -= 1;
        // $mUser->save();

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

    //Delete Admin
    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatch('show_delete_confirmation');
    }

    public function deleteData()
    {
        $data = User::where('id', $this->delete_id)->first();
        $data->delete();

        $this->dispatch('user_deleted');
        $this->delete_id = '';
    }

    public function changeStatus($id, $status)
    {
        User::where('id', $id)->update(['status' => ($status == 1 ? 0 : 1)]);
        $this->dispatch('success', ['message' => 'User updated successfully.']);
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
