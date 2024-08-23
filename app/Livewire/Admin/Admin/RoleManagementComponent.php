<?php

namespace App\Livewire\Admin\Admin;

use App\Models\Role;
use App\Models\Admin;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\RolePermission;
use Illuminate\Support\Facades\DB;

class RoleManagementComponent extends Component
{
    use WithPagination;
    public $searchTerm, $sortingValue = 10;
    public $permissions = [], $role_name, $role_perms = [], $role_id, $name, $delete_id;

    public function mount()
    {
        $bases = DB::table('permissions')->orderBy('base', 'ASC')->groupBy('base')->pluck('base')->toArray();
        foreach($bases as $base){
            $perms = DB::table('permissions')->where('base', $base)->get();

            $this->permissions[] = [
                'base' => $base,
                'perms' => $perms
            ];
        }
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => 'required|string|max:10|unique:roles,role,'.$this->role_id.'',
        ]);
    }

    public function storeData()
    {
        $this->validate([
            'name' => 'required|string|max:10|unique:roles,role',
        ]);

        $data = new Role();
        $data->role = $this->name;
        $data->save();

        foreach ($this->role_perms as $value) {
            RolePermission::create([
                'role_id' => $data->id,
                'permission_id' => $value
            ]);
        }

        $this->close();
        $this->dispatch('closeModal');
        $this->dispatch('success', ['message' => 'Role Permissions Added Successfully']);
    }

    public function editData($id)
    {
        $data = Role::find($id);
        $this->role_name = $data->role;
        $this->role_id = $data->id;
        $this->name = $data->role;
        $this->role_perms = RolePermission::where('role_id', $data->id)->pluck('permission_id')->toArray();

        $this->dispatch('showEditModal');
    }

    public function updateData()
    {
        $this->validate([
            'name' => 'required|string|max:10|unique:roles,role,'.$this->role_id.'',
        ]);

        $data = Role::find($this->role_id);
        $data->role = $this->name;
        $data->save();

        RolePermission::where('role_id', $this->role_id)->delete();
        foreach ($this->role_perms as $value) {
            RolePermission::create([
                'role_id' => $this->role_id,
                'permission_id' => $value
            ]);
        }

        $this->close();
        $this->dispatch('closeModal');
        $this->dispatch('success', ['message' => 'Role Permissions Updated Successfully']);
    }

    public function close()
    {
        $this->role_perms = [];
        $this->name = '';
        $this->role_id = '';
    }

    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatch('show_delete_confirmation');
    }

    public function deleteData()
    {
        Role::where('id', $this->delete_id)->delete();
        RolePermission::where('role_id', $this->delete_id)->delete();
        Admin::where('role_id', $this->delete_id)->update(['role_id'=>NULL]);

        $this->dispatch('data_deleted');
        $this->delete_id = '';
    }

    public function render()
    {
        $roles = Role::paginate($this->sortingValue);

        $this->dispatch('reload_scripts');
        return view('livewire.admin.admin.role-management-component', ['roles' => $roles])->layout('livewire.admin.layouts.base');
    }
}
