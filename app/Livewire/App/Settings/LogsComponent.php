<?php

namespace App\Livewire\App\Settings;

use Livewire\Component;
use App\Models\ChatMessage;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class LogsComponent extends Component
{
    use WithPagination;
    public $sortBy = 'created_at', $sortDirection = 'DESC';
    public $searchTerm, $sortingValue = 10, $delete_id, $edit_id;
    public $created_at;

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
        $logs = DB::table('chat_messages')->select('chat_messages.*', 'chats.from_number as from', 'chats.contact_id')->join('chats', 'chats.id', 'chat_messages.chat_id')->where('chat_messages.message', 'like', '%' . $this->searchTerm . '%')->orderBy('chat_messages.'.$this->sortBy, $this->sortDirection)->paginate($this->sortingValue);

        return view('livewire.app.settings.logs-component', ['logs' => $logs])->layout('livewire.app.layouts.base');
    }
}
