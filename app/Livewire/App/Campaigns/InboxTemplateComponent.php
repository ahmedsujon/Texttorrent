<?php

namespace App\Livewire\App\Campaigns;

use App\Models\InboxTemplate;
use Livewire\Component;
use Livewire\WithPagination;

class InboxTemplateComponent extends Component
{
    use WithPagination;
    public $searchTerm, $sortingValue = 10, $delete_id, $edit_id;
    public $template_name, $status, $preview_message;

    public function mount()
    {
    }

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'template_name' => 'required',
            'status' => 'required',
            'preview_message' => 'required',
        ]);
    }

    public function storeData()
    {
        $this->validate([
            'template_name' => 'required',
            'status' => 'required',
            // 'preview_message' => 'required',
        ]);

        $template = new InboxTemplate();
        $template->template_name = $this->template_name;
        $template->status = $this->status;
        $template->preview_message = $this->preview_message;

        $template->save();
        $this->dispatch('closeModal');
        $this->resetInputs();
        $this->dispatch('success', ['message' => 'New template added successfully']);
    }

    public function editData($id)
    {
        $data = InboxTemplate::find($id);
        $this->template_name = $data->template_name;
        $this->status = $data->status;
        $this->preview_message = $data->preview_message;
        $this->edit_id = $data->id;

        $this->dispatch('showEditModal');
    }

    public function updateData()
    {
        $this->validate([
            'template_name' => 'required',
            'status' => 'required',
            // 'preview_message' => 'required',
        ]);

        $template = InboxTemplate::where('id', $this->edit_id)->first();
        $template->template_name = $this->template_name;
        $template->status = $this->status;
        $template->preview_message = $this->preview_message;

        $template->save();
        $this->dispatch('closeModal');
        $this->resetInputs();
        $this->dispatch('success', ['message' => 'Template updated successfully']);
    }

    public function resetInputs()
    {
        $this->template_name = '';
        $this->status = '';
        $this->preview_message = '';
        $this->delete_id = '';
        $this->edit_id = '';
    }

    public function close()
    {
        $this->resetInputs();
    }

    //Delete Admin
    public function deleteConfirmation($id)
    {
        $this->delete_id = $id;
        $this->dispatch('show_delete_confirmation');
    }

    public function deleteData()
    {
        $template = InboxTemplate::where('id', $this->delete_id)->first();
        deleteFile($template->avatar);
        $template->delete();

        $this->dispatch('template_deleted');
        $this->delete_id = '';
    }
    public function render()
    {
        return view('livewire.app.campaigns.inbox-template-component')->layout('livewire.app.layouts.base');
    }
}
