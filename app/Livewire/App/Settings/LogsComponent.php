<?php

namespace App\Livewire\App\Settings;

use App\Exports\LogExport;
use Livewire\Component;
use App\Models\ChatMessage;
use App\Models\User;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

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

    public function viewChat($id, $key)
    {
        session()->flash('chat_id', $id);
        return redirect()->route('user.inbox');
    }

    public $filter, $export_ids;
    public function filterMessage($type)
    {
        $this->filter = $type;
    }

    public function exportAll()
    {
        if (!$this->export_ids) {
            $this->dispatch('error', ['message' => 'No data available to export.']);
        } else {
            return Excel::download(new LogExport(['bulk_ids'=>$this->export_ids]), 'logs.csv');
        }
    }

    public function render()
    {
        $user_ids = [user()->id];
        $sub_users = DB::table('users')->where('parent_id', user()->id)->pluck('id')->toArray();
        $user_ids = array_merge($user_ids, $sub_users);

        $logs = DB::table('chat_messages')->select('chat_messages.*', 'chats.from_number as from', 'chats.contact_id')->join('chats', 'chats.id', 'chat_messages.chat_id')->where('chat_messages.message', 'like', '%' . $this->searchTerm . '%')->whereIn('chats.user_id', $user_ids)->orderBy('chat_messages.'.$this->sortBy, $this->sortDirection);
        if ($this->filter == 'received') {
            $logs = $logs->where('chat_messages.direction', 'inbound');
        }
        if ($this->filter == 'sent') {
            $logs = $logs->where('chat_messages.direction', 'outbound');
        }

        $this->export_ids = $logs->pluck('id')->toArray();

        $logs = $logs->paginate($this->sortingValue);


        return view('livewire.app.settings.logs-component', ['logs' => $logs])->layout('livewire.app.layouts.base');
    }
}
