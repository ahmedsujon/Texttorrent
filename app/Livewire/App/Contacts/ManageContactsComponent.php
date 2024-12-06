<?php

namespace App\Livewire\App\Contacts;

use App\Models\User;
use App\Models\Contact;
use Livewire\Component;
use App\Models\ContactList;
use App\Models\ContactNote;
use App\Models\ContactFolder;
use Livewire\WithFileUploads;
use App\Exports\ContactsExport;
use App\Imports\ContactsImport;
use App\Models\NumberValidation;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\NumberValidationItems;
use Livewire\WithPagination;

class ManageContactsComponent extends Component
{
    use WithFileUploads;
    use WithPagination;
    public $file, $list_search_term, $folder_search_term, $contacts_search_term;

    public $list_name, $list_edit_id, $list_delete_id, $sort_list_id;

    public function mount()
    {
        $firstList = ContactList::where('user_id', user()->id)->where('bookmarked', 1)->first();
        if ($firstList) {
            $this->sort_list_id = $firstList->id;
        } else {
            $firstListO = ContactList::where('user_id', user()->id)->first();
            $this->sort_list_id = $firstListO ? $firstListO->id : null;
        }
    }

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

    // contacts
    public $first_name, $last_name, $mobile_number, $company_name, $email, $list_id, $contact_edit_id;
    public function addNewContact()
    {
        $this->validate([
            'first_name' => 'required',
            'mobile_number' => 'required',
            'company_name' => 'required',
        ]);

        $list = new Contact();
        $list->user_id = user()->id;
        $list->first_name = $this->first_name;
        $list->last_name = $this->last_name;
        $list->number = '+1' . $this->mobile_number;
        $list->email = $this->email;
        $list->company = $this->company_name;
        $list->list_id = $this->sort_list_id;
        $list->save();

        $this->first_name = '';
        $this->last_name = '';
        $this->mobile_number = '';
        $this->company_name = '';
        $this->email = '';

        $this->dispatch('closeModal');
        $this->dispatch('success', ['message' => 'New contact added successfully']);
        $this->resetPage();
    }
    public function editContact($id)
    {
        $data = Contact::find($id);
        $this->first_name = $data->first_name;
        $this->last_name = $data->last_name;
        $this->mobile_number = str_replace('+1', '', $data->number);
        $this->company_name = $data->company;
        $this->email = $data->email;
        $this->contact_edit_id = $data->id;

        $this->dispatch('showContactEditModal');
    }
    public function updateContact()
    {
        $this->validate([
            'first_name' => 'required',
            'mobile_number' => 'required',
            'company_name' => 'required',
        ]);

        $list = Contact::find($this->contact_edit_id);
        $list->first_name = $this->first_name;
        $list->last_name = $this->last_name;
        $list->number = '+1' . $this->mobile_number;
        $list->company = $this->company_name;
        $list->email = $this->email;
        $list->save();

        $this->first_name = '';
        $this->last_name = '';
        $this->mobile_number = '';
        $this->company_name = '';
        $this->email = '';

        $this->dispatch('closeModal');
        $this->dispatch('success', ['message' => 'Contact updated successfully']);
    }

    public function resetEditModal()
    {
        $this->first_name = '';
        $this->last_name = '';
        $this->mobile_number = '';
        $this->company_name = '';
        $this->email = '';
    }

    // details
    public $numberDetails;
    public function showDetails($id)
    {
        $contact = Contact::find($id);
        $contact->notes = ContactNote::where('contact_id', $contact->id)->get();

        $this->numberDetails = $contact;
        $this->dispatch('showDetailsModal');
    }

    public $folder_id, $contact_id;
    public function addFolderModal($id)
    {
        $cont = Contact::find($id);

        $this->folder_id = $cont->folder_id;

        $this->contact_id = $id;
        $this->dispatch('showFolderModal');
    }

    public function addToFolder()
    {
        $contact = Contact::find($this->contact_id);
        $contact->folder_id = $this->folder_id;
        $contact->save();

        if ($this->folder_id) {
            $msg = 'Contact added to folder successfully';
        } else {
            $msg = 'Contact removed from folder successfully';
        }

        $this->folder_id = '';

        $this->dispatch('closeModal');
        $this->dispatch('success', ['message' => $msg]);
    }

    public $folder_name, $folder_edit_id, $folder_delete_id;
    public function createFolder()
    {
        $this->validate([
            'folder_name' => 'required',
        ]);

        $folder = new ContactFolder();
        $folder->user_id = user()->id;
        $folder->name = $this->folder_name;
        $folder->save();

        $this->folder_name = '';

        $this->dispatch('folderAdded');
        $this->dispatch('success', ['message' => 'Folder added successfully']);
    }
    public function editFolder($folder_id)
    {
        $folder = ContactFolder::find($folder_id);
        $this->folder_name = $folder->name;
        $this->folder_edit_id = $folder->id;

        $this->dispatch('showFolderEditModal');
    }
    public function updateFolder()
    {
        $this->validate([
            'folder_name' => 'required|max:15',
        ]);

        $folder = ContactFolder::find($this->folder_edit_id);
        $folder->name = $this->folder_name;
        $folder->save();

        $this->folder_name = '';

        $this->dispatch('folderUpdated');
        $this->dispatch('success', ['message' => 'Folder updated successfully']);
    }

    public $note_contact_id;
    public function addNoteModal($id)
    {
        $this->note_contact_id = $id;
        $this->dispatch('showNoteAddModal');
    }

    public $note;
    public function addNote()
    {
        $this->validate([
            'note' => 'required',
        ]);

        $note = new ContactNote();
        $note->contact_id = $this->note_contact_id;
        $note->note = $this->note;
        $note->save();

        $this->note = '';

        $this->dispatch('noteAdded');
        $this->dispatch('success', ['message' => 'Note added successfully']);
    }

    // public $progress = 0;
    // public $uploadedSize = 0;
    // public $totalSize = 0;

    public $columns = [], $first_name_column, $last_name_column, $email_address_column, $company_column, $phone_number_column, $additional_1_column, $additional_2_column, $additional_3_column, $import_list_id;
    public function updatedFile()
    {
        $this->validate([
            'file' => 'required|file|mimes:csv,xlsx|max:10240', // 10MB
        ]);
        $this->columns = $this->getCsvHeaders();

        $this->first_name_column = isset($this->columns[0]) ? $this->columns[0] : '';
        $this->last_name_column = isset($this->columns[1]) ? $this->columns[1] : '';
        $this->email_address_column = isset($this->columns[2]) ? $this->columns[2] : '';
        $this->company_column = isset($this->columns[3]) ? $this->columns[3] : '';
        $this->phone_number_column = isset($this->columns[4]) ? $this->columns[4] : '';
        $this->additional_1_column = isset($this->columns[5]) ? $this->columns[5] : '';
        $this->additional_2_column = isset($this->columns[6]) ? $this->columns[6] : '';
        $this->additional_3_column = isset($this->columns[7]) ? $this->columns[7] : '';
    }

    public function resetUpload()
    {
        $this->reset('file');
    }

    // Step 2: Extract CSV headers dynamically
    public function getCsvHeaders()
    {
        $file = fopen($this->file->getRealPath(), 'r');
        $headers = fgetcsv($file);
        fclose($file);

        return $headers;
    }

    public function importConfirmation()
    {
        $this->validate([
            'file' => 'required|mimes:csv,txt|max:51200', // File validation
            'first_name_column' => 'required',
            // 'last_name_column' => 'required',
            'phone_number_column' => 'required',
            // 'email_address_column' => 'required',
            'company_column' => 'required',
            // 'additional_1_column' => 'required',
            // 'additional_2_column' => 'required',
            // 'additional_3_column' => 'required',
        ]);

        $this->dispatch('showImportConfirmation');
    }

    public function import()
    {
        // Pass the selected column mappings to the import class
        Excel::import(new ContactsImport([
            'first_name_column' => $this->first_name_column,
            'last_name_column' => $this->last_name_column,
            'phone_number_column' => $this->phone_number_column,
            'email_address_column' => $this->email_address_column,
            'company_column' => $this->company_column,
            'additional_1_column' => $this->additional_1_column,
            'additional_2_column' => $this->additional_2_column,
            'additional_3_column' => $this->additional_3_column,
            'import_list_id' => $this->import_list_id,
        ]), $this->file);

        $this->dispatch('closeModal');
        $this->dispatch('success', ['message' => 'Contacts imported successfully.']);

        // Reset the form
        $this->reset(['file', 'first_name_column', 'last_name_column', 'phone_number_column', 'email_address_column', 'company_column', 'additional_1_column', 'additional_2_column', 'additional_3_column', 'import_list_id']);
    }

    public $contact_checkbox = [], $contactIDs, $check_all;
    public function selectAll()
    {
        if ($this->check_all) {
            $this->contact_checkbox = $this->contactIDs;
        } else {
            $this->contact_checkbox = [];
        }
    }

    public $delete_id, $delete_type;
    public function deleteConfirmation($id, $type)
    {
        if ($type == 'bulk_delete_contact') {
            if (!$this->contact_checkbox) {
                $this->dispatch('error', ['message' => 'Select contacts first']);
            } else {
                $this->delete_type = $type;
                $this->dispatch('show_delete_confirmation');
            }
        } else {
            $this->delete_id = $id;
            $this->delete_type = $type;
            $this->dispatch('show_delete_confirmation');
        }

    }

    public function deleteData()
    {
        if ($this->delete_type == 'list') {
            $data = ContactList::where('id', $this->delete_id)->first();
            $data->delete();

            $message = 'List deleted successfully';
        }

        if ($this->delete_type == 'folder') {
            $data = ContactFolder::where('id', $this->delete_id)->first();
            $data->delete();

            $message = 'Folder deleted successfully';
        }

        if ($this->delete_type == 'contact') {
            $data = Contact::where('id', $this->delete_id)->first();
            $data->delete();

            $message = 'Contact deleted successfully';
        }

        if ($this->delete_type == 'bulk_delete_contact') {
            if (!$this->contact_checkbox) {
                $this->dispatch('error', ['message' => 'Select contacts first']);
            } else {
                foreach ($this->contact_checkbox as $key => $chkId) {
                    $data = Contact::where('id', $chkId)->first();
                    $data->delete();
                }

                $message = 'Contacts deleted successfully';
                $this->contact_checkbox = [];
                $this->check_all = false;
            }
        }

        $this->dispatch('data_deleted', ['message' => $message]);
        $this->delete_id = '';
        $this->delete_type = '';
    }

    public function selectList($id)
    {
        $this->sort_list_id = $id;
        $this->contact_checkbox = [];
        $this->check_all = false;

        $this->import_list_id = $id;
        $this->dispatch('setSelectedList', $id);
        $this->resetPage();
    }

    public function exportContacts()
    {
        if (!$this->contact_checkbox) {
            $this->dispatch('error', ['message' => 'Select contacts first']);
        } else {
            return Excel::download(new ContactsExport(['selectedContacts' => $this->contact_checkbox]), 'contacts.csv');
        }
    }

    public function addToBlacklistConfirmation()
    {
        if (!$this->contact_checkbox) {
            $this->dispatch('error', ['message' => 'Select contacts first']);
        } else {
            $this->dispatch('showBlacklistAddConfirmation');
        }
    }

    public function addToBlacklist()
    {
        foreach ($this->contact_checkbox as $key => $chkId) {
            $data = Contact::where('id', $chkId)->first();
            $data->blacklisted = 1;
            $data->blacklisted_by = user()->id;
            $data->save();
        }

        $message = 'Contacts added to blacklist';
        $this->contact_checkbox = [];
        $this->check_all = false;

        $this->dispatch('added_to_blacklist', ['message' => $message]);
    }

    public function removeFromBlacklistConfirmation()
    {
        if (!$this->contact_checkbox) {
            $this->dispatch('error', ['message' => 'Select contacts first']);
        } else {
            $this->dispatch('showBlacklistRemoveConfirmation');
        }
    }

    public function removeBlacklist()
    {
        foreach ($this->contact_checkbox as $key => $chkId) {
            $data = Contact::where('id', $chkId)->first();
            $data->blacklisted = 0;
            $data->blacklisted_by = 0;
            $data->save();
        }

        $message = 'Contacts removed from blacklist';
        $this->contact_checkbox = [];
        $this->check_all = false;

        $this->dispatch('removed_blacklist', ['message' => $message]);
    }

    public $validator_credits = 0, $total_numbers_selected = 0, $numbers_to_validate = [], $availableValidation = 0, $alreadyValidated = 0;
    public function numberValidateConfirmation()
    {
        if (!$this->contact_checkbox) {
            $this->dispatch('error', ['message' => 'Select contacts first']);
        } else {
            $number_to_validate = [];
            $already_validated = [];

            foreach ($this->contact_checkbox as $key => $chkBox)
            {
                $contact = Contact::select('id', 'validation_process')->find($chkBox);
                if ($contact->validation_process == 1) {
                    $already_validated[] = $contact->id;
                } else {
                    $number_to_validate[] = $contact->id;
                }
            }

            $this->total_numbers_selected = count($this->contact_checkbox);
            $this->numbers_to_validate = $number_to_validate;
            $this->alreadyValidated = count($already_validated);
            $this->availableValidation = count($number_to_validate);
            $this->validator_credits = count($number_to_validate) * 1;

            $this->dispatch('showNumberValidateConfirmation');
        }
    }

    public function validateNumbers()
    {
        if (user()->type == 'sub') {
            $au_user = DB::table('users')->select('id', 'credits')->where('id', user()->parent_id)->first();
            $user_id = $au_user->id;
            $credits = $au_user->credits;
        } else {
            $user_id = user()->id;
            $credits = user()->credits;
        }

        if (getUserActiveSubscription($user_id)['status'] == 'Active') {
            // $apiKey = env('NUM_VERIFY_ACCESS_KEY');

            // $output = [];
            // foreach ($this->contact_checkbox as $key => $number) {
            //     $contact = Contact::find($number);
            //     $response = Http::get("http://apilayer.net/api/validate", [
            //         'access_key' => $apiKey,
            //         'number' => $contact->number,
            //     ]);
            //     $result = $response->json();
            //     $output[] = $result;
            // }

            // dd($output);

            if ($credits >= $this->validator_credits) {
                $validation = new NumberValidation();
                $validation->user_id = user()->id;
                $validation->list_id = $this->sort_list_id;
                $validation->number_ids = $this->numbers_to_validate;
                $validation->total_number = $this->availableValidation;
                $validation->total_credits = $this->validator_credits;
                $validation->total_mobile_numbers = null;
                $validation->total_landline_numbers = null;
                $validation->save();

                foreach ($this->numbers_to_validate as $key => $number) {
                    $contact = Contact::find($number);

                    $item = new NumberValidationItems();
                    $item->number_validation_id = $validation->id;
                    $item->user_id = user()->id;
                    $item->contact_id = $contact->id;
                    $item->number = $contact->number;
                    $item->validated_at = null;
                    $item->status = 'Processing';
                    $item->save();
                }

                // credit deduction
                $user = User::find($user_id);
                $user->credits -= $this->validator_credits;
                $user->save();

                // log
                creditLog('Number validation for ' . $this->availableValidation . ' numbers', $this->validator_credits);

                $this->dispatch('numberValidationSubmitted');
                $this->reset(['numbers_to_validate', 'contact_checkbox', 'check_all']);
            } else {
                $this->dispatch('error', ['message' => 'Not enough credits to validate selected numbers!']);
            }
        } else {
            $this->dispatch('error', ['message' => 'No active subscription found!']);
        }
    }

    public function validateNum($number)
    {
        $apiKey = env('NUM_VERIFY_ACCESS_KEY');
        $response = Http::get("http://apilayer.net/api/validate", [
            'access_key' => $apiKey,
            'number' => $number,
        ]);

        if ($response->ok()) {
            dd($response->json());
        }
    }

    public $sortingValue = 10;
    public function render()
    {
        $bookmarked_lists = DB::table('contact_lists')
            ->leftJoin('contacts', 'contact_lists.id', '=', 'contacts.list_id')
            ->where(function ($query) {
                $query->where('contact_lists.name', 'like', '%' . $this->list_search_term . '%')
                    ->orWhere('contacts.number', 'like', '%' . $this->list_search_term . '%');
            })
            ->where('contact_lists.user_id', user()->id)
            ->where('contact_lists.bookmarked', 1)
            ->select('contact_lists.*') // Ensure you're only selecting columns from `contact_lists`
            ->distinct() // To avoid duplicates if a list has multiple matching contacts
            ->get();

        $other_lists = DB::table('contact_lists')
            ->leftJoin('contacts', 'contact_lists.id', '=', 'contacts.list_id')
            ->where(function ($query) {
                $query->where('contact_lists.name', 'like', '%' . $this->list_search_term . '%')
                    ->orWhere('contacts.number', 'like', '%' . $this->list_search_term . '%');
            })
            ->where('contact_lists.user_id', user()->id)
            ->where('contact_lists.bookmarked', 0)
            ->select('contact_lists.*') // Ensure you're only selecting columns from `contact_lists`
            ->distinct() // To avoid duplicates if a list has multiple matching contacts
            ->get();
        // $other_lists = DB::table('contact_lists')->where('name', 'like', '%' . $this->list_search_term . '%')->where('user_id', user()->id)->where('bookmarked', 0)->get();

        $folders = ContactFolder::where('name', 'like', '%' . $this->folder_search_term . '%')->where('user_id', user()->id)->get();

        $contacts = Contact::where(function ($q) {
            $q->where('first_name', 'like', '%' . $this->contacts_search_term . '%')
                ->orWhere('last_name', 'like', '%' . $this->contacts_search_term . '%')
                ->orWhere('number', 'like', '%' . $this->contacts_search_term . '%');
        })->where('user_id', user()->id)->orderBy('id', 'DESC');
        if ($this->sort_list_id) {
            if ($this->sort_list_id == 'unlisted') {
                $contacts = $contacts->where('blacklisted', 0)->where('list_id', null);
            } else if ($this->sort_list_id == 'blacklisted') {
                $contacts = $contacts->where('blacklisted', 1);
            } else {
                $contacts = $contacts->where('blacklisted', 0)->where('list_id', $this->sort_list_id);
            }
        }
        $contacts = $contacts->paginate($this->sortingValue);

        $allLists = ContactList::where('user_id', user()->id)->get();

        $this->contactIDs = $contacts->pluck('id')->toArray();

        return view('livewire.app.contacts.manage-contacts-component', ['contacts' => $contacts, 'bookmarked_lists' => $bookmarked_lists, 'other_lists' => $other_lists, 'folders' => $folders, 'allLists' => $allLists])->layout('livewire.app.layouts.base');
    }
}
