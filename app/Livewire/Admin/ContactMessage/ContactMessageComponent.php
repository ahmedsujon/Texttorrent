<?php

namespace App\Livewire\Admin\ContactMessage;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ContactMessage;

class ContactMessageComponent extends Component
{
    use WithPagination;
    public $sortingValue = 10, $searchTerm;
    public $sortBy = 'created_at', $sortDirection = 'DESC';
    public $delete_id;

        //Delete Admin
        public function deleteConfirmation($id)
        {
            $this->delete_id = $id;
            $this->dispatch('show_delete_confirmation');
        }

        public function deleteData()
        {
            $data = ContactMessage::where('id', $this->delete_id)->first();
            $data->delete();

            $this->dispatch('contact_deleted');
            $this->delete_id = '';
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

    public function render()
    {
        $messages = ContactMessage::where('first_name', 'like', '%' . $this->searchTerm . '%')
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->sortingValue);
        $this->dispatch('reload_scripts');
        return view('livewire.admin.contact-message.contact-message-component', ['messages' => $messages])->layout('livewire.admin.layouts.base');
    }
}
