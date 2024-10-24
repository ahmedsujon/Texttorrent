<?php

namespace App\Livewire\Admin\Subscription;

use Livewire\Component;
use App\Models\Subscription;
use Livewire\WithPagination;

class SubscritionComponent extends Component
{

    use WithPagination;
    public $sortingValue = 10, $searchTerm;
    public $sortBy = 'created_at', $sortDirection = 'DESC';
    public $delete_id, $edit_id, $roles;

    public function render()
    {
        $subscriptions = Subscription::orderBy('id', 'DESC')
            ->where('package_name', 'like', '%' . $this->searchTerm . '%')
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->sortingValue);
        $this->dispatch('reload_scripts');
        return view('livewire.admin.subscription.subscrition-component', ['subscriptions' => $subscriptions])->layout('livewire.admin.layouts.base');
    }
}
