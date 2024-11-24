<?php

namespace App\Livewire\Admin\NumberRenew;

use App\Models\Number;
use Livewire\Component;
use Livewire\WithPagination;

class RenewComponent extends Component
{

    use WithPagination;
    public $sortingValue = 10, $searchTerm;
    public $sortBy = 'created_at', $sortDirection = 'DESC';
    public $delete_id, $edit_id;

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
        $renew_alerts = Number::where('number', 'like', '%' . $this->searchTerm . '%')
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->sortingValue);
        $this->dispatch('reload_scripts');
        return view('livewire.admin.number-renew.renew-component', ['renew_alerts' => $renew_alerts])->layout('livewire.admin.layouts.base');
    }
}
