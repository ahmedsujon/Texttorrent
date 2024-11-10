<?php

namespace App\Livewire\Admin\Users;

use App\Models\Api;
use App\Models\User;
use Livewire\Component;
use App\Models\Subscription;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersComponent extends Component
{
    use WithPagination, WithFileUploads;
    public $sortingValue = 10, $searchTerm;
    public $sortBy = 'created_at', $sortDirection = 'DESC';
    public $edit_id, $delete_id;
    public $first_name, $last_name, $username, $credits, $email, $phone, $password, $avatar, $uploadedAvatar,
        $gateway, $account_sid, $auth_token, $package_type, $package_name, $amount, $status;
    public $totalChildUsers = 0;
    public $delivered_message = 0;
    public $totalCredit = 0;

    #[Url('history:true')]
    public function setUserForStatusChange($id, $status)
    {
        $this->edit_id = $id;
        $this->status = $status;
    }

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

    public $childUsers = []; // Define a property to store child users


    public function editData($id)
    {
        // Load user data
        $user = User::find($id);

        // Check if user exists
        if ($user) {
            // Set user data
            $this->first_name = $user->first_name;
            $this->last_name = $user->last_name;
            $this->username = $user->username;
            $this->email = $user->email;
            $this->phone = $user->phone;
            $this->status = $user->status;
            $this->credits = $user->credits;
            $this->uploadedAvatar = $user->avatar;
            $this->edit_id = $user->id;

            // Load subscription data separately
            $subscription = Subscription::where('user_id', $id)->latest()->first();
            if ($subscription) {
                $this->package_type = $subscription->package_type;
                $this->package_name = $subscription->package_name;
                $this->amount = $subscription->amount;
            } else {
                $this->package_type = null;
                $this->package_name = null;
                $this->amount = null;
            }

            // Retrieve child users where parent_id is this user_id
            $this->childUsers = User::where('parent_id', $user->id)->get();

            // Count total users with this parent_id
            $this->totalChildUsers = User::where('parent_id', $user->id)->count();

            // Retrieve chat IDs for the user and count delivered messages
            $user_chats = DB::table('chats')->where('user_id', $user->id)->pluck('id')->toArray();
            $this->delivered_message = DB::table('chat_messages')->whereIn('chat_id', $user_chats)
                ->where('api_send_status', 'delivered')
                ->count();

            // Calculate the total credit from the transactions table
            $this->totalCredit = DB::table('transactions')->where('user_id', $user->id)->sum('credit');

            // Show the edit modal
            $this->dispatch('showEditModal');
        } else {
            session()->flash('error', 'User not found.');
        }
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

    public function tenDLCEditData($id)
    {
        // Load user data
        $user = User::find($id);

        // Check if user exists
        if ($user) {
            // Dispatch event to show the modal (you can add any logic to show a modal here)
            $this->dispatch('showTenDLCEditModal');
        } else {
            session()->flash('error', 'User not found.');
        }
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
        $this->credit_balance = '';
        $this->uploadedAvatar = '';
        $this->delete_id = '';
        $this->edit_id = '';
    }

    public function close()
    {
        $this->resetInputs();
    }

    //Update User Status
    public function changeStatus()
    {
        User::where('id', $this->edit_id)->update(['status' => ($this->status == 1 ? 0 : 1)]);
        $this->dispatch('success', ['message' => 'Status updated successfully.']);
        $this->reset(['edit_id', 'status']); // Reset after changing status
        $this->dispatch('closeModal');
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

        // Get latest subscriptions for all displayed users
        $userIds = $users->pluck('id');
        $subscriptions = Subscription::whereIn('user_id', $userIds)
            ->latest()
            ->get()
            ->unique('user_id');

        // Attach the subscription to each user manually
        $users->each(function ($user) use ($subscriptions) {
            $user->latestSubscription = $subscriptions->firstWhere('user_id', $user->id);
        });

        $this->dispatch('reload_scripts');
        return view('livewire.admin.users.users-component', ['users' => $users])->layout('livewire.admin.layouts.base');
    }
}
