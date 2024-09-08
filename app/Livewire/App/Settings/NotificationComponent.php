<?php

namespace App\Livewire\App\Settings;

use App\Models\TriggerNotification;
use Livewire\Component;
use Livewire\WithPagination;

class NotificationComponent extends Component
{
    use WithPagination;
    public $sortingValue = 10, $searchTerm;
    public $sortBy = 'created_at', $sortDirection = 'DESC';
    public $edit_id, $delete_id;
    public $keyword, $type, $email, $phone, $webhook_url, $webhook_format, $auto_responder, $auto_responder_message;

    public function mount() {}

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'keyword' => 'required',
            'type' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'webhook_url' => 'required',
            'webhook_format' => 'required',
            'auto_responder' => 'required',
            'auto_responder_message' => 'required',
        ]);
    }

    public function storeData()
    {
        $this->validate([
            'keyword' => 'required',
            'type' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'webhook_url' => 'required',
            'webhook_format' => 'required',
            'auto_responder' => 'required',
            'auto_responder_message' => 'required',
        ]);

        $data = new TriggerNotification();
        $data->keyword = $this->keyword;
        $data->type = $this->type;
        $data->email = $this->email;
        $data->phone = $this->phone;
        $data->webhook_url = $this->webhook_url;
        $data->webhook_format = $this->webhook_format;
        $data->auto_responder = $this->auto_responder;
        $data->auto_responder_message = $this->auto_responder_message;

        $data->save();
        $this->dispatch('closeModal');
        $this->resetInputs();
        $this->dispatch('success', ['message' => 'New template added successfully']);
    }

    public function editData($id)
    {
        $data = TriggerNotification::find($id);
        $this->keyword = $data->keyword;
        $this->type = $data->type;
        $this->email = $data->email;
        $this->phone = $data->phone;
        $this->webhook_url = $data->webhook_url;
        $this->webhook_format = $data->webhook_format;
        $this->auto_responder = $data->auto_responder;
        $this->auto_responder_message = $data->auto_responder_message;
        $this->edit_id = $data->id;

        $this->dispatch('showEditModal');
    }

    public function updateData()
    {
        $this->validate([
            'keyword' => 'required',
            'type' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'webhook_url' => 'required',
            'webhook_format' => 'required',
            'auto_responder' => 'required',
            'auto_responder_message' => 'required',
        ]);

        $data = TriggerNotification::where('id', $this->edit_id)->first();
        $data->keyword = $this->keyword;
        $data->type = $this->type;
        $data->email = $this->email;
        $data->phone = $this->phone;
        $data->webhook_url = $this->webhook_url;
        $data->webhook_format = $this->webhook_format;
        $data->auto_responder = $this->auto_responder;
        $data->auto_responder_message = $this->auto_responder_message;

        $data->save();
        $this->dispatch('closeModal');
        $this->resetInputs();
        $this->dispatch('success', ['message' => 'Template updated successfully']);
    }

    public function resetInputs()
    {
        $this->keyword = '';
        $this->type = '';
        $this->email = '';
        $this->phone = '';
        $this->webhook_url = '';
        $this->webhook_format = '';
        $this->auto_responder = '';
        $this->auto_responder_message = '';
        $this->delete_id = '';
        $this->edit_id = '';
    }

    public function close()
    {
        $this->resetInputs();
    }

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

    //Delete Admin
    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatch('show_delete_confirmation');
    }

    public function deleteData()
    {
        $data = TriggerNotification::where('id', $this->delete_id)->first();
        deleteFile($data->avatar);
        $data->delete();

        $this->dispatch('notification_deleted');
        $this->delete_id = '';
    }

    public function render()
    {
        return view('livewire.app.settings.notification-component')->layout('livewire.app.layouts.base');
    }
}
