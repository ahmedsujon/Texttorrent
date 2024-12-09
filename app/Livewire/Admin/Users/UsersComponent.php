<?php

namespace App\Livewire\Admin\Users;

use App\Models\Api;
use App\Models\User;
use Livewire\Component;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Livewire\Attributes\Url;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
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

    public bool $share_legal_doc = false;
    public bool $opt_in = false, $opt_out = false, $direct_lending = false, $embedded_link = false, $embedded_phone = false,
        $affiliate_marketing = false, $age_gated_content = false, $terms_aggre = false;

    public $company_name, $company_phone, $company_website, $industry, $organization_type, $country_of_registration,
        $tax_number, $city, $street_address, $state, $postal_code;

    public $campaign_name, $campaign_type, $campaign_description, $sample_message_one, $sample_message_two, $additional_recipients;

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
            // Brand Registration
            $this->company_name = $user->company_name;
            $this->company_phone = $user->company_phone;
            $this->company_website = $user->company_website;
            $this->industry = $user->industry;
            $this->organization_type = $user->organization_type;
            $this->country_of_registration = $user->country_of_registration;
            $this->tax_number = $user->tax_number;
            $this->share_legal_doc = $user->share_legal_doc;
            $this->city = $user->city;
            $this->street_address = $user->street_address;
            $this->state = $user->state;
            $this->postal_code = $user->postal_code;
            // Campaign Registration
            $this->campaign_name = $user->campaign_name;
            $this->campaign_type = $user->campaign_type;
            $this->campaign_description = $user->campaign_description;
            $this->sample_message_one = $user->sample_message_one;
            $this->sample_message_two = $user->sample_message_two;
            $this->opt_in = $user->opt_in;
            $this->opt_out = $user->opt_out;
            $this->direct_lending = $user->direct_lending;
            $this->embedded_link = $user->embedded_link;
            $this->embedded_phone = $user->embedded_phone;
            $this->affiliate_marketing = $user->affiliate_marketing;
            $this->age_gated_content = $user->age_gated_content ?? false;
            $this->additional_recipients = $user->additional_recipients;
            $this->terms_aggre = $user->terms_aggre;
            $this->edit_id = $id;
            $this->dispatch('showTenDLCEditModal');
        } else {
            session()->flash('error', 'User not found.');
        }
    }

    public function saveBrandData()
    {
        $this->validate([
            'company_name' => 'required',
            'company_phone' => 'required',
            'company_website' => 'required',
            'industry' => 'required',
            'organization_type' => 'required',
            'country_of_registration' => 'required',
            'tax_number' => 'required',
            'share_legal_doc' => 'required',
            'city' => 'required',
            'street_address' => 'required',
            'state' => 'required',
            'postal_code' => 'required',
        ]);

        $data = User::where('id', $this->edit_id)->first();
        $data->company_name = $this->company_name;
        $data->company_phone = $this->company_phone;
        $data->company_website = $this->company_website;
        $data->industry = $this->industry;
        $data->organization_type = $this->organization_type;
        $data->country_of_registration = $this->country_of_registration;
        $data->tax_number = $this->tax_number;
        $data->share_legal_doc = $this->share_legal_doc;
        $data->city = $this->city;
        $data->street_address = $this->street_address;
        $data->state = $this->state;
        $data->postal_code = $this->postal_code;
        $data->save();
        $this->dispatch('success', ['message' => 'Brand Registration updated successfully']);
    }

    public function saveCampaignData()
    {
        $this->validate([
            'campaign_name' => 'required',
            'campaign_type' => 'required',
            'campaign_description' => 'required',
            'sample_message_one' => 'required',
            'opt_in' => 'required',
        ]);

        $data = User::where('id', $this->edit_id)->first();
        $data->campaign_name = $this->campaign_name;
        $data->campaign_type = $this->campaign_type;
        $data->campaign_description = $this->campaign_description;
        $data->sample_message_one = $this->sample_message_one;
        $data->sample_message_two = $this->sample_message_two;
        $data->opt_in = $this->opt_in;
        $data->opt_out = $this->opt_out;
        $data->direct_lending = $this->direct_lending;
        $data->embedded_link = $this->embedded_link;
        $data->embedded_phone = $this->embedded_phone;
        $data->affiliate_marketing = $this->affiliate_marketing;
        $data->age_gated_content = $this->age_gated_content;
        $data->additional_recipients = $this->additional_recipients;
        $data->terms_aggre = $this->terms_aggre;
        $data->save();
        $this->dispatch('success', ['message' => 'Campaign Registration updated successfully']);
    }

    public function apiIntrigation($id)
    {
        $data = Api::where('user_id', $id)->first();
        if ($data) {
            $this->gateway = $data->gateway;
            $this->account_sid = $data->account_sid;
            $this->auth_token = $data->auth_token;
            $this->edit_id = $data->id;
        } else {
            session()->flash('error', 'No API data found for this user.');
        }

        $this->dispatch('showAPIModal');
    }


    public function changePasswordData($id)
    {
        $user = User::find($id);

        if ($user) {
            $this->password = $user->password;
            $this->edit_id = $id;
            $this->dispatch('showPasswordEditModal');
        } else {
            session()->flash('error', 'User not found.');
        }
    }

    public function changePassword()
    {
        $this->validate([
            'password' => 'sometimes:required',
        ]);

        $data = User::where('id', $this->edit_id)->first();
        $data->password = Hash::make($this->password);
        $data->save();
        $this->dispatch('closeModal');
        $this->resetInputs();
        $this->dispatch('success', ['message' => 'Password changed successfully!']);
    }


    public function creditsEditData($id)
    {
        $user = User::find($id);

        if ($user) {
            $this->credits = $user->credits;
            $this->edit_id = $id;
            $this->dispatch('showCreditsEditModal');
        } else {
            session()->flash('error', 'User not found.');
        }
    }

    public function creditsUpdateData()
    {
        $this->validate([
            'credits' => 'sometimes:required',
        ]);

        $data = User::where('id', $this->edit_id)->first();
        $data->credits = $this->credits;
        $data->save();
        $this->dispatch('closeModal');
        $this->resetInputs();
        $this->dispatch('success', ['message' => 'Credits updated successfully!']);
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
        $this->credits = '';
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

    public function loginAsUser(Request $request)
    {
        $seller = User::where('email', $request->email)->first();

        Auth::guard('web')->login($seller);

        session()->flash('success', 'Login Successful!');
        return redirect()->route('user.dashboard');
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
