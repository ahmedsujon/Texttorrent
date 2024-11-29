<?php

namespace App\Livewire\App\Contacts;

use App\Models\NumberValidation;
use App\Models\NumberValidationItems;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

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

    public function render()
    {
        $user_ids = [user()->id];
        $sub_users = DB::table('users')->where('parent_id', user()->id)->pluck('id')->toArray();
        $user_ids = array_merge($user_ids, $sub_users);

        $items = NumberValidation::select('number_validations.*', 'contact_lists.name as list_name')->join('contact_lists', 'contact_lists.id', 'number_validations.list_id')->where('contact_lists.name', 'like', '%' . $this->searchTerm . '%')->whereIn('number_validations.user_id', $user_ids)->orderBy('number_validations.id', 'DESC')->paginate($this->sortingValue);

        return view('livewire.app.contacts.validator-credits-component', ['items' => $items])->layout('livewire.app.layouts.base');
    }
}
