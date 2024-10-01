<?php

namespace App\Livewire\App\Contacts;

use App\Models\Contact;
use App\Models\ContactFolder;
use App\Models\ContactList;
use Livewire\Component;

class ManageContactsComponent extends Component
{
    public $list_search_term, $folder_search_term;

    public $list_name, $list_edit_id, $list_delete_id;
    public function addNewList()
    {
        $this->validate([
            'list_name' => 'required|max:15',
        ]);

        $list = new ContactList();
        $list->name = $this->list_name;
        $list->user_id = user()->id;
        $list->save();

        $this->list_name = '';

        $this->dispatch('closeModal');
        $this->dispatch('success', ['message' => 'New list added successfully']);
    }
    public function editList($list_id)
    {
        $list = ContactList::find($list_id);
        $this->list_name = $list->name;
        $this->list_edit_id = $list->id;

        $this->dispatch('showListEditModal');
    }
    public function updateList()
    {
        $this->validate([
            'list_name' => 'required|max:15',
        ]);

        $list = ContactList::find($this->list_edit_id);
        $list->name = $this->list_name;
        $list->save();

        $this->list_name = '';

        $this->dispatch('closeModal');
        $this->dispatch('success', ['message' => 'List updated successfully']);
    }
    public function addRemoveBookmark($id)
    {
        $list = ContactList::find($id);
        if ($list->bookmarked == 0) {
            $list->bookmarked = 1;
            $message = 'List marked as bookmarked';
        } else {
            $list->bookmarked = 0;
            $message = 'List marked as not bookmarked';
        }
        $list->save();

        $this->dispatch('success', ['message' => $message]);
    }





    public $delete_id, $delete_type;
    public function deleteConfirmation($id, $type)
    {
        $this->delete_id = $id;
        $this->delete_type = $type;
        $this->dispatch('show_delete_confirmation');
    }

    public function deleteData()
    {
        if ($this->delete_type == 'list') {
            $data = ContactList::where('id', $this->delete_id)->first();
            $data->delete();

            $message = 'List deleted successfully';
        }

        $this->dispatch('data_deleted', ['message'=>$message]);
        $this->delete_id = '';
        $this->delete_type = '';
    }


    public function render()
    {
        $bookmarked_lists = ContactList::where('name', 'like', '%' . $this->list_search_term . '%')->where('user_id', user()->id)->where('bookmarked', 1)->get();
        $other_lists = ContactList::where('name', 'like', '%' . $this->list_search_term . '%')->where('user_id', user()->id)->where('bookmarked', 0)->get();

        $folders = ContactFolder::where('name', 'like', '%' . $this->folder_search_term . '%')->where('user_id', user()->id)->get();

        $contacts = Contact::where('user_id', user()->id)->orderBy('id', 'DESC')->get();

        return view('livewire.app.contacts.manage-contacts-component', ['contacts' => $contacts, 'bookmarked_lists' => $bookmarked_lists, 'other_lists' => $other_lists, 'folders' => $folders])->layout('livewire.app.layouts.base');
    }
}
