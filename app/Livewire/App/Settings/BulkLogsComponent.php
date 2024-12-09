<?php

namespace App\Livewire\App\Settings;

use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class BulkLogsComponent extends Component
{
    use WithPagination;
    public $sortBy = 'created_at', $sortDirection = 'DESC';
    public $searchTerm, $sortingValue = 10, $delete_id, $edit_id, $replies;
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

    public function getReplies($id)
    {
        $replies = DB::table('bulk_message_replies')->select('id', 'message', 'created_at')->where('bulk_message_item_id', $id)->get();

        if ($replies->count() > 0) {
            $this->replies = $replies;
            $this->dispatch('showReplies');
        } else{
            $this->dispatch('error', ['message'=>'No replies found!']);
        }
    }

    public function resetForm()
    {
        $this->replies = '';
    }

    public function render()
    {
        $user_ids = [user()->id];
        $sub_users = DB::table('users')->where('parent_id', user()->id)->pluck('id')->toArray();
        $user_ids = array_merge($user_ids, $sub_users);

        $logs = DB::table('bulk_message_items')->select('bulk_message_items.*', 'contacts.first_name', 'contacts.last_name')->join('contacts', 'contacts.number', 'bulk_message_items.send_to')->where('bulk_message_items.message', 'like', '%' . $this->searchTerm . '%')->whereIn('bulk_message_items.send_by', $user_ids)->orderBy('bulk_message_items.id', 'DESC');
        $logs = $logs->paginate($this->sortingValue);

        $this->export_ids = $logs->pluck('id')->toArray();

        return view('livewire.app.settings.bulk-logs-component', ['logs' => $logs])->layout('livewire.app.layouts.base');
    }
}
