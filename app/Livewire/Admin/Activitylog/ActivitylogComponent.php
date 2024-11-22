<?php

namespace App\Livewire\Admin\Activitylog;

use Livewire\Component;
use App\Models\ActivityLog;
use Livewire\WithPagination;

class ActivitylogComponent extends Component
{
    use WithPagination;
    public $searchTerm, $sortingValue = 10;

    public function render()
    {
        $activities = ActivityLog::orderBy('id', 'DESC')->paginate($this->sortingValue);

        $this->dispatch('reload_scripts');
        return view('livewire.admin.activitylog.activitylog-component', ['activities'=>$activities])->layout('livewire.admin.layouts.base');
    }
}
