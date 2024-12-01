<?php

namespace App\Livewire\App\Contacts;

use Livewire\Component;
use App\Models\NumberValidation;
use App\Exports\ValidationExport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ValidationItemExport;
use App\Models\NumberValidationItems;

class ValidatorCreditsComponent extends Component
{
    public $searchTerm, $sortingValue, $delete_id;


    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatch('show_delete_confirmation');
    }

    public function deleteData()
    {
        $data = NumberValidation::find($this->delete_id);
        $dataItem = NumberValidationItems::where('number_validation_id', $data->id)->get();
        foreach ($dataItem as $dt) {
            $dt->delete();
        }
        $data->delete();

        $this->dispatch('data_deleted');
    }

    public $selectedItems = [], $itemIDs, $check_all;
    public function updatedCheckAll()
    {
        if ($this->check_all) {
            $this->selectedItems = $this->itemIDs;
        } else {
            $this->selectedItems = [];
        }
    }

    public function exportData()
    {
        if (!$this->selectedItems) {
            $this->dispatch('error', ['message' => 'Select items first']);
        } else {
            return Excel::download(new ValidationExport(['selectedItems' => $this->selectedItems]), 'validations.csv');
        }
    }

    public function exportItems($id)
    {
        return Excel::download(new ValidationItemExport(['selectedItem' => $id]), 'validation_items.csv');
    }

    public function render()
    {
        $user_ids = [user()->id];
        $sub_users = DB::table('users')->where('parent_id', user()->id)->pluck('id')->toArray();
        $user_ids = array_merge($user_ids, $sub_users);

        $items = NumberValidation::select('number_validations.*', 'contact_lists.name as list_name')->join('contact_lists', 'contact_lists.id', 'number_validations.list_id')->where('contact_lists.name', 'like', '%' . $this->searchTerm . '%')->whereIn('number_validations.user_id', $user_ids)->orderBy('number_validations.id', 'DESC')->paginate($this->sortingValue);

        $this->itemIDs = $items->pluck('id')->toArray();

        return view('livewire.app.contacts.validator-credits-component', ['items' => $items])->layout('livewire.app.layouts.base');
    }
}
