<?php

namespace App\Livewire\Admin\Admin;

use App\Models\Admin;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class AdminComponent extends Component
{
    use WithPagination, WithFileUploads;
    public $searchTerm, $sortingValue = 10, $delete_id, $edit_id, $roles;
    public $name, $email, $phone, $password, $role, $avatar, $uploadedAvatar;

    public function mount()
    {
        $this->roles = DB::table('roles')->get();
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required|string|max:20|min:3',
            'email' => 'required|email|unique:admins,email,' . $this->edit_id . '',
            'phone' => 'required|string|unique:admins,phone,' . $this->edit_id . '',
            'password' => 'required|min:6|max:20',
            'role' => 'required',
            'avatar' => 'required|file|mimes:jpg,png,jpeg',
        ]);
    }

    public function storeData()
    {
        $this->validate([
            'name' => 'required|string|max:20|min:3',
            'email' => 'required|email|unique:admins,email',
            'phone' => 'required|string|unique:admins,phone',
            'password' => 'required|min:6|max:20',
            'role' => 'required',
            'avatar' => 'required|file|mimes:jpg,png,jpeg,webp',
        ]);

        $admin = new Admin();
        $admin->role_id = $this->role;
        $admin->name = $this->name;
        $admin->email = $this->email;
        $admin->phone = $this->phone;
        $admin->password = Hash::make($this->password);

        if ($this->avatar) {
            $file = uploadFile('image', 40, 'profile-images/', 'admin', $this->avatar);
            $admin->avatar = $file;
        }

        $admin->type = 'admin';
        $admin->added_by = admin()->id;
        $admin->save();

        $this->dispatch('closeModal');
        $this->resetInputs();
        $this->dispatch('success', ['message' => 'New admin added successfully']);
    }

    public function editData($id)
    {
        $data = Admin::find($id);
        $this->role = $data->role_id;
        $this->name = $data->name;
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
                'name' => 'required|string|max:20|min:3',
                'email' => 'required|email|unique:admins,email,' . $this->edit_id . '',
                'phone' => 'required|string|unique:admins,phone,' . $this->edit_id . '',
                'role' => 'required',
                'password' => 'min:8|max:25',
            ]);
        } else {
            $this->validate([
                'name' => 'required|string|max:20|min:3',
                'email' => 'required|email|unique:admins,email,' . $this->edit_id . '',
                'phone' => 'required|string|unique:admins,phone,' . $this->edit_id . '',
                'role' => 'required',
            ]);
        }

        $admin = Admin::where('id', $this->edit_id)->first();
        $admin->role_id = $this->role;
        $admin->name = $this->name;
        $admin->email = $this->email;
        $admin->phone = $this->phone;
        $admin->password = Hash::make($this->password);
        if ($this->avatar) {
            deleteFile($admin->avatar);

            $file = uploadFile('image', 40, 'profile-images/', 'admin', $this->avatar);
            $admin->avatar = $file;
        }
        $admin->save();

        $this->dispatch('closeModal');
        $this->resetInputs();
        $this->dispatch('success', ['message' => 'Admin updated successfully']);
    }

    public function resetInputs()
    {
        $this->name = '';
        $this->email = '';
        $this->phone = '';
        $this->password = '';
        $this->role = '';
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
        Admin::where('id', $id)->update(['status' => ($status == 1 ? 0 : 1)]);
        $this->dispatch('success', ['message' => 'Admin updated successfully.']);
    }

    //Delete Admin
    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatch('show_delete_confirmation');
    }

    public function deleteData()
    {
        $admin = Admin::where('id', $this->delete_id)->first();
        deleteFile($admin->avatar);
        $admin->delete();

        $this->dispatch('admin_deleted');
        $this->delete_id = '';
    }

    public function render()
    {
        $admins = Admin::where('type', 'admin')->orderBy('id', 'DESC')->paginate($this->sortingValue);

        $this->dispatch('reload_scripts');
        return view('livewire.admin.admin.admin-component', ['admins' => $admins])->layout('livewire.admin.layouts.base');
    }
}
