<?php

namespace App\Livewire\Admin\Subscription;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Subscription;
use Livewire\WithPagination;

class SubscritionComponent extends Component
{

    use WithPagination;
    public $sortingValue = 10, $searchTerm;
    public $sortBy = 'created_at', $sortDirection = 'DESC', $paymentStatusSearchTerm;
    public $delete_id, $edit_id, $roles;

    public $dateFilter = '';

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
        $subscriptions = Subscription::orderBy('id', 'DESC')
            ->where('package_name', 'like', '%' . $this->searchTerm . '%')
            ->orderBy($this->sortBy, $this->sortDirection)
            ->when($this->paymentStatusSearchTerm !== null && $this->paymentStatusSearchTerm !== '', function ($query) {
                return $query->where('payment_status', $this->paymentStatusSearchTerm);
            })
            ->when($this->dateFilter !== '', function ($query) {
                switch ($this->dateFilter) {
                    case 'today':
                        $query->whereDate('created_at', Carbon::today());
                        break;
                    case '7days':
                        $query->whereBetween('created_at', [Carbon::now()->subDays(7), Carbon::now()]);
                        break;
                    case '30days':
                        $query->whereBetween('created_at', [Carbon::now()->subDays(30), Carbon::now()]);
                        break;
                    case '6months':
                        $query->whereBetween('created_at', [Carbon::now()->subMonths(6), Carbon::now()]);
                        break;
                    case 'this_year':
                        $query->whereYear('created_at', Carbon::now()->year);
                        break;
                }
            })
            ->paginate($this->sortingValue);

        $this->dispatch('reload_scripts');
        return view('livewire.admin.subscription.subscrition-component', ['subscriptions' => $subscriptions])
            ->layout('livewire.admin.layouts.base');
    }
}
