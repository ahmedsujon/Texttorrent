<?php

namespace App\Livewire\App\Campaigns;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\InboxTemplate;
use App\Exports\InboxTemplateExport;
use Maatwebsite\Excel\Facades\Excel;

class InboxTemplateComponent extends Component
{
    use WithPagination;
    public $sortingValue = 10, $searchTerm;
    public $sortBy = 'created_at', $sortDirection = 'DESC';
    public $edit_id, $delete_id;
    public $template_name, $status = 1, $preview_message;

    public function mount()
    {}

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
            'preview_message' => 'required',
        ]);

        $template = new InboxTemplate();
        $template->user_id = user()->id;
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

    public function resetForm()
    {
        $this->reset(['template_name', 'status', 'preview_message']);
    }

    public function resetInputs()
    {
        $this->template_name = '';
        $this->status = 1;
        $this->preview_message = '';
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
            $this->sortDirection = ($this->sortDirection == "ASC") ? 'DESC' : "ASC";
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
        $template = InboxTemplate::where('id', $this->delete_id)->first();
        deleteFile($template->avatar);
        $template->delete();

        $this->dispatch('template_deleted');
        $this->delete_id = '';
    }

    public $select_all, $temp_ids, $selectedTemplates = [];
    public function updatedSelectAll()
    {
        if ($this->select_all) {
            $this->selectedTemplates = $this->temp_ids;
        } else {
            $this->selectedTemplates = [];
        }
    }

    public function bulkExport()
    {
        if (!$this->selectedTemplates) {
            $this->dispatch('error', ['message' => 'Please select templates to perform this action.']);
        } else {
            return Excel::download(new InboxTemplateExport(['bulk_ids'=>$this->selectedTemplates]), 'inbox-templates.csv');
        }
    }

    public function render()
    {
        $templates = InboxTemplate::where('template_name', 'like', '%' . $this->searchTerm . '%')
            ->where('user_id', user()->id)
            ->orderBy($this->sortBy, $this->sortDirection)
            ->paginate($this->sortingValue);

        $this->temp_ids = $templates->pluck('id')->toArray();

        $this->dispatch('reload_scripts');
        return view('livewire.app.campaigns.inbox-template-component', ['templates' => $templates])->layout('livewire.app.layouts.base');
    }
}
