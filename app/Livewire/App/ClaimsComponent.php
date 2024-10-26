<?php

namespace App\Livewire\App;

use App\Models\BulkMessageItem;
use Livewire\Component;
use Livewire\WithPagination;

class ClaimsComponent extends Component
{
    use WithPagination;
    public $sortingValue, $searchTerm;

    

    public function render()
    {
        $claims = BulkMessageItem::where('status', 1)->where(function($q){
            $q->where('received_message', 'like', '%'.$this->searchTerm.'%')
                ->orWhere('send_to', 'like', '%'.$this->searchTerm.'%');
        })->paginate($this->sortingValue);
        return view('livewire.app.claims-component', ['claims' => $claims])->layout('livewire.app.layouts.base');
    }
}
