<?php

namespace App\Livewire\App;

use App\Models\Chat;
use App\Models\ChatMessage;
use App\Models\Contact;
use App\Models\ContactFolder;
use App\Models\ContactNote;
use App\Models\Event;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class InboxComponent extends Component
{
    use WithPagination;

    public $folders, $folder_search_term, $templates, $active_numbers, $receiver_numbers, $participant_numbers;
    public function mount()
    {
        $this->folders = DB::table('contact_folders')->where('user_id', user()->id)->get();
        $last_chat = DB::table('chats')->select('chats.id')->join('contacts', 'contacts.id', 'chats.contact_id')->where('chats.user_id', user()->id)->where('contacts.blacklisted', 0)->orderBy('chats.updated_at', 'DESC')->first();

        if (session()->has('chat_id') && session('chat_id') != null) {
            $this->selectChat(session('chat_id'));
        } else if ($last_chat) {
            $this->selectChat($last_chat->id);
        }

        $this->templates = DB::table('inbox_templates')->where('user_id', user()->id)->get();
        $this->active_numbers = DB::table('numbers')->where('user_id', user()->id)->where('status', 1)->get();
        $this->participant_numbers = Contact::select('number')->where('blacklisted', 0)->where('user_id', user()->id)->take(30)->get();

        $extContacts = DB::table('chats')->select('contact_id')->where('user_id', user()->id)->pluck('contact_id')->toArray();
        $this->receiver_numbers = DB::table('contacts')->where('user_id', user()->id)->whereNotIn('id', $extContacts)->take(30)->get();
    }

    public function updatedFolderSearchTerm()
    {
        $this->folders = DB::table('contact_folders')->where('name', 'like', '%' . $this->folder_search_term . '%')->where('user_id', user()->id)->get();
    }

    public $sort_folder_id;
    public function selectFolder($folder_id)
    {
        if ($folder_id == 'all') {
            $this->sort_folder_id = '';
        } else {
            $this->sort_folder_id = $folder_id;
        }
        $this->resetPage();
    }

    public $selected_chat_id, $selected_chat, $messages;
    public function selectChat($chat_id)
    {
        $this->selected_chat_id = $chat_id;
        $selected_chat = DB::table('chats')->select('contacts.*', 'chats.from_number as from_number')->join('contacts', 'contacts.id', 'chats.contact_id')->where('chats.id', $chat_id)->first();
        $selected_chat->avatar_ltr = substr($selected_chat->first_name, 0, 1) . substr($selected_chat->last_name, 0, 1);
        $selected_chat->notes = DB::table('contact_notes')->where('contact_id', $selected_chat->id)->get();
        $this->selected_chat = $selected_chat;

        $messages = DB::table('chat_messages')->where('chat_id', $chat_id)->get();

        $SMessages = DB::table('chat_messages')->where('chat_id', $chat_id)->where('status', 0)->get();
        foreach ($SMessages as $msg) {
            $msgS = ChatMessage::find($msg->id);
            $msgS->status = 1;
            $msgS->save();
        }

        $this->messages = $messages;

        $this->dispatch('scrollToBottom');
        $this->dispatch('selectedChat', ['chat_id' => $chat_id]);
    }

    public function sendMessage($message)
    {
        $number_st = DB::table('numbers')->select('id', 'status')->where('number', $this->selected_chat->from_number)->first();
        if ($number_st->status == 1) {
            if (getActiveSubscription()['status'] == 'Active') {
                $credit_needed = msgCreditCalculation('sms', 'outgoing');
                if (user()->type == 'sub') {
                    $au_user = DB::table('users')->select('id', 'credits')->where('id', user()->parent_id)->first();
                    $credit_has = $au_user->credits;
                    $user_id = $au_user->id;
                } else {
                    $credit_has = user()->credits;
                    $user_id = user()->id;
                }
                if ($credit_has >= $credit_needed) {
                    $msg = new ChatMessage();
                    $msg->chat_id = $this->selected_chat_id;
                    $msg->direction = 'outbound';
                    $msg->message = $message;
                    $msg->save();

                    $chat = Chat::where('id', $this->selected_chat_id)->first();
                    $chat->last_message = $message;
                    $chat->save();

                    sendSMSviaTwilio($this->selected_chat->number, $chat->from_number, $message, $msg->id);

                    // credit deduction
                    $user = User::find($user_id);
                    $user->credits -= $credit_needed;
                    $user->save();

                    // log
                    creditLog('Send message to ' . $this->selected_chat->first_name . '' . $this->selected_chat->last_name, $credit_needed);

                    $msgSt = ChatMessage::find($msg->id);
                    $msg->api_send_status = $msgSt->api_send_status;
                    $msg->msg_sid = $msgSt->msg_sid;

                    $this->messages->push($msg);
                    $this->dispatch('scrollToBottom');
                } else {
                    $this->dispatch('error', ['message' => 'Not enough credit for this message!']);
                }
            } else {
                $this->dispatch('error', ['message' => 'No active subscription found!']);
            }
        } else {
            $this->dispatch('error', ['message' => 'Unable to send message. Sender number is not active!']);
        }
    }

    public function pollMessageStatuses()
    {
        $chat_messages = DB::table('chat_messages')
            ->select('msg_sid', 'api_send_status')
            ->where('chat_id', $this->selected_chat_id)
            ->where(function ($q) {
                $q->where('api_send_status', 'pending')
                    ->orWhere('api_send_status', 'sent');
            })
            ->whereNotNull('msg_sid')
            ->get();

        $updates = [];

        foreach ($chat_messages as $msg) {
            if ($msg->api_send_status == 'pending' || $msg->api_send_status == 'sent') { // Case-insensitive check for 'pending'
                $output = twilioMsgStatus($msg->msg_sid);

                if (!empty($output['status'])) { // Ensure status is not null or empty
                    DB::table('chat_messages')
                        ->where('msg_sid', $msg->msg_sid)
                        ->update(['api_send_status' => $output['status']]);
                    $this->dispatch('msgStatusUpdated', ['msg_sid' => $msg->msg_sid, 'status' => ucfirst($output['status'])]);
                }
            }
        }
    }

    public function getMsgStatus($sid)
    {
        $output = twilioMsgStatus($sid);
        dd($output);
    }

    public $selected_template_preview_new_chat, $selected_template_id_new_chat, $receiver_id, $receiver_number, $sender_id, $new_chat_message;

    public function receiverSelect($number)
    {
        $this->receiver_number = str_replace('+1', '', $number);
        // $this->selected_template_id_new_chat = '';
    }

    public function updatedReceiverNumber()
    {
        $extContacts = DB::table('chats')->select('contact_id')->where('user_id', user()->id)->pluck('contact_id')->toArray();
        $this->receiver_numbers = DB::table('contacts')->where('number', 'like', '%' . $this->receiver_number . '%')->where('user_id', user()->id)->whereNotIn('id', $extContacts)->take(30)->get();

        // $this->selected_template_id_new_chat = '';

    }

    public function useTemplateNewChat()
    {
        if ($this->receiver_number) {
            $rec_number = '+1' . $this->receiver_number;

            $getContact = Contact::where('number', $rec_number)->where('user_id', user()->id)->first();
            if ($getContact) {
                $this->receiver_id = $getContact->id;
            } else {
                // $unlisted_count = Contact::where('user_id', user()->id)->where('list_id', NULL)->count();

                $contact = new Contact();
                $contact->user_id = user()->id;
                // $contact->first_name = 'Unlisted';
                // $contact->last_name = $unlisted_count + 1;
                $contact->number = $rec_number;
                $contact->save();
                $this->receiver_id = $contact->id;
            }
        }

        if ($this->receiver_id) {
            $contact = Contact::find($this->receiver_id);
            $output = $this->selected_template_preview_new_chat; // Start with the template preview
            $output = str_replace('{phone_number}', $contact->number, $output);
            $output = str_replace('{email_address}', $contact->email, $output);
            $output = str_replace('{first_name}', $contact->first_name, $output);
            $output = str_replace('{last_name}', $contact->last_name, $output);
            $output = str_replace('{company}', $contact->company, $output);
            $output = processSpinText($output);

            $this->new_chat_message = $output;

            $this->dispatch('updateTextareaNewChat', $output);
            // $this->reset(['selected_template_preview_new_chat', 'selected_template_id_new_chat']);
        } else {
            $this->dispatch('error', ['message' => 'No receiver selected']);
        }
    }

    public function updatedReceiverId()
    {
        // if ($this->selected_template_id_new_chat) {
        // $this->selected_template_id_new_chat = '';
        // }
    }

    public function startNewChat()
    {
        if ($this->receiver_number) {
            $rec_number = '+1' . $this->receiver_number;

            $getContact = Contact::where('number', $rec_number)->where('user_id', user()->id)->first();
            if ($getContact) {
                $this->receiver_id = $getContact->id;
            } else {
                // $unlisted_count = Contact::where('user_id', user()->id)->where('list_id', NULL)->count();

                $contact = new Contact();
                $contact->user_id = user()->id;
                // $contact->first_name = 'Unlisted';
                // $contact->last_name = $unlisted_count + 1;
                $contact->number = $rec_number;
                $contact->save();
                $this->receiver_id = $contact->id;
            }
        }

        $this->validate([
            'sender_id' => 'required',
            'receiver_id' => 'required',
            // 'selected_template_id_new_chat' => 'required',
            'selected_template_preview_new_chat' => 'required',

        ], [
            '*.required' => 'This field is required',
        ]);


        $contact = Contact::where('id', $this->receiver_id)->first();
        if ($contact && $contact->blacklisted == 1) {
            $this->dispatch('error', ['message' => 'This number is blacklisted']);
        } else {
            $getChat = Chat::select('id')->where('contact_id', $this->receiver_id)->where('from_number', $this->sender_id)->where('user_id', user()->id)->first();
            if ($getChat) {
                $this->dispatch('error', ['message' => 'Chat already exists!']);
            } else {
                $chat = new Chat();
                $chat->user_id = user()->id;
                $chat->contact_id = $this->receiver_id;
                $chat->from_number = $this->sender_id;
                $chat->save();

                $this->selectChat($chat->id);
                $this->dispatch('closeModal');
                $this->dispatch('newChatMessage', ['message' => $this->selected_template_preview_new_chat]);
                $this->dispatch('success', ['message' => 'New chat started successfully']);

                $this->receiver_number = '';
                $this->selected_template_preview_new_chat = '';
                $this->sender_id = '';
                $this->receiver_id = '';
            }
        }

        // $msg = new ChatMessage();
        // $msg->chat_id = $chat->id;
        // $msg->direction = 'outbound';
        // $msg->message = $this->new_chat_message;
        // $msg->save();

        // $contact = Contact::find($this->receiver_id);
        // // send msg
        // $result = sendSMSviaTwilio($contact->number, $chat->from_number, $this->new_chat_message);

        // if ($result['result'] == false) {
        //     $msgSt = ChatMessage::find($msg->id);
        //     $msgSt->api_send_status = 'failed';
        //     $msgSt->save();

        //     $msg->api_send_status = 'failed';
        // } else {
        //     $msgSt = ChatMessage::find($msg->id);
        //     $msgSt->api = 'Twilio';
        //     $msgSt->api_send_status = 'success';
        //     $msgSt->api_send_response = $result['twilio_response'];
        //     $msgSt->msg_sid = $result['sid'];
        //     $msgSt->save();

        //     $msg->api_send_status = 'success';
        // }

        // session()->flash('success', 'New chat started successfully');
        // return redirect()->route('user.inbox');
    }

    public $selected_template_preview, $selected_template_id;
    public function useTemplate()
    {
        $this->validate([
            'selected_template_id' => 'required',
        ], [
            'selected_template_id.required' => 'Select a template',
        ]);

        $contact = Contact::find($this->selected_chat->id);
        $output = $this->selected_template_preview; // Start with the template preview
        $output = str_replace('{phone_number}', $contact->number, $output);
        $output = str_replace('{email_address}', $contact->email, $output);
        $output = str_replace('{first_name}', $contact->first_name, $output);
        $output = str_replace('{last_name}', $contact->last_name, $output);
        $output = str_replace('{company}', $contact->company, $output);
        $output = processSpinText($output);

        $this->dispatch('updateTextarea', $output);
        $this->reset(['selected_template_preview', 'selected_template_id']);
    }

    public $unread_filter;
    public function showUnread()
    {
        if ($this->unread_filter) {
            $this->unread_filter = false;
        } else {
            $this->unread_filter = true;
        }
        $this->resetPage();
    }

    public $info_edit_id, $first_name, $last_name, $mobile_number, $company_name, $email;
    public function editInfo($id)
    {
        $data = Contact::find($id);
        $this->first_name = $data->first_name;
        $this->last_name = $data->last_name;
        $this->mobile_number = str_replace('+1 ', '', $data->number);
        $this->company_name = $data->company;
        $this->email = $data->email;
        $this->info_edit_id = $data->id;

        $this->dispatch('showInfoUpdateModal');
    }

    public function updateInformation()
    {
        $list = Contact::find($this->info_edit_id);
        $list->first_name = $this->first_name;
        $list->last_name = $this->last_name;
        $list->number = '+1 ' . $this->mobile_number;
        $list->company = $this->company_name;
        $list->email = $this->email;
        $list->save();

        $this->first_name = '';
        $this->last_name = '';
        $this->mobile_number = '';
        $this->company_name = '';
        $this->email = '';

        $this->dispatch('closeModal');
        $this->dispatch('success', ['message' => 'Info updated successfully']);

        $this->selectChat($this->selected_chat_id);
    }

    public $note;
    public function addNote()
    {
        $this->validate([
            'note' => 'required',
        ], [
            'note.required' => 'Note is required',
        ]);

        $note = new ContactNote();
        $note->contact_id = $this->selected_chat->id;
        $note->note = $this->note;
        $note->save();

        $this->note = '';

        $this->dispatch('closeModal');
        $this->dispatch('success', ['message' => 'Note added successfully']);

        $this->selectChat($this->selected_chat_id);
    }

    public function deleteNote($id)
    {
        $note = ContactNote::find($id);
        $note->delete();

        $this->note = '';
        $this->dispatch('success', ['message' => 'Note completed successfully']);
        $this->selectChat($this->selected_chat_id);
    }

    public $folder_id, $contact_id;
    public function addFolderModal($id)
    {
        $chat = Chat::find($id);
        $cont = Contact::find($chat->contact_id);

        $this->folder_id = $cont->folder_id;

        $this->contact_id = $cont->id;
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
        ], [
            'folder_name.required' => 'Folder name is required',
        ]);

        $folder = new ContactFolder();
        $folder->user_id = user()->id;
        $folder->name = $this->folder_name;
        $folder->save();

        $this->folder_name = '';

        $this->dispatch('folderAdded');
        $this->dispatch('success', ['message' => 'Folder added successfully']);
        $this->mount();
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
        ], [
            'folder_name.required' => 'Folder name is required',
        ]);

        $folder = ContactFolder::find($this->folder_edit_id);
        $folder->name = $this->folder_name;
        $folder->save();

        $this->folder_name = '';

        $this->dispatch('folderUpdated');
        $this->dispatch('success', ['message' => 'Folder updated successfully']);
        $this->mount();
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
        if ($this->delete_type == 'folder') {
            $data = ContactFolder::where('id', $this->delete_id)->first();
            $data->delete();

            $message = 'Folder deleted successfully';
        }

        if ($this->delete_type == 'chat') {
            $data = Chat::where('id', $this->delete_id)->first();
            $data->delete();

            $this->mount();

            $message = 'Chat deleted successfully';
        }

        $this->dispatch('data_deleted', ['message' => $message]);
        $this->delete_id = '';
        $this->delete_type = '';

        $this->mount();
    }

    public $name, $subject, $date, $time, $sender_number, $alert_before, $participant_number, $participant_email;

    public function addEvent()
    {
        $this->validate([
            'name' => 'required',
            'subject' => 'required',
            'date' => 'required',
            'time' => 'required',
            'sender_number' => 'required',
            'alert_before' => 'required',
        ], [
            '*' => 'This field is required',
        ]);

        $event = new Event();
        $event->user_id = user()->id;
        $event->name = $this->name;
        $event->subject = $this->subject;
        $event->date = $this->date;
        $event->time = $this->time;
        $event->alert_at = Carbon::parse($this->time)->subMinutes($this->alert_before)->format('Y-m-d H:i');
        $event->sender_number = $this->sender_number;
        $event->receiver_number = user()->phone;
        $event->alert_before = $this->alert_before;
        $event->participant_number = $this->participant_number;
        $event->participant_email = $this->participant_email;
        $event->save();

        $this->dispatch('closeModal');
        $this->dispatch('success', ['message' => 'New event added successfully']);
        $this->reset(['name', 'subject', 'date', 'time', 'sender_number', 'alert_before', 'participant_number', 'participant_email']);
    }

    public function reFreshOnMessageReceived()
    {
        $this->render();
    }

    public $blacklist_contact_id;
    public function blacklistConfirmation($contact_id)
    {
        $this->blacklist_contact_id = $contact_id;
        $this->dispatch('showBlackListConfirmation');
    }

    public function blacklistContact()
    {
        $contact = Contact::find($this->blacklist_contact_id);
        $contact->blacklisted = 1;
        $contact->save();

        $this->blacklist_contact_id = '';
        $this->dispatch('blackListedSuccess');
        $this->mount();
        $this->render();
    }

    public $filter_time, $searchTerm;
    public function render()
    {
        $chats = DB::table('chats')->select('chats.*', 'contacts.first_name', 'contacts.last_name', 'contacts.number', 'contacts.folder_id')->join('contacts', 'contacts.id', 'chats.contact_id')->where('contacts.blacklisted', 0)->where(function ($q) {
            $q->where('contacts.number', 'like', '%' . $this->searchTerm . '%')
                ->orWhere('contacts.first_name', 'like', '%' . $this->searchTerm . '%')
                ->orWhere('contacts.last_name', 'like', '%' . $this->searchTerm . '%')
                ->orWhere('chats.last_message', 'like', '%' . $this->searchTerm . '%');
        })->where('chats.user_id', user()->id)->orderBy('chats.updated_at', 'DESC');

        if ($this->sort_folder_id) {
            $chats = $chats->where('contacts.folder_id', $this->sort_folder_id);
        }

        if ($this->unread_filter) {
            $chat_msgs = ChatMessage::where('direction', 'inbound')->where('status', 0)->distinct()->pluck('chat_id')->toArray();
            $chats = $chats->whereIn('chats.id', $chat_msgs);
        }

        // Apply time filter if set
        if ($this->filter_time) {
            switch ($this->filter_time) {
                case 'today':
                    $chats = $chats->whereDate('chats.updated_at', '=', now()->toDateString());
                    break;
                case 'last_week':
                    $chats = $chats->where('chats.updated_at', '>=', now()->subWeek());
                    break;
                case 'last_month':
                    $chats = $chats->where('chats.updated_at', '>=', now()->subMonth());
                    break;
                case 'last_year':
                    $chats = $chats->where('chats.updated_at', '>=', now()->subYear());
                    break;
                default:
                    break;
            }
        }

        $chats = $chats->paginate(8);

        foreach ($chats as $key => $chat) {
            $chat->avatar_ltr = substr($chat->first_name, 0, 1) . substr($chat->last_name, 0, 1);
            $unreadCount = DB::table('chat_messages')->where('chat_id', $chat->id)->where('direction', 'inbound')->where('status', 0)->count();
            $chat->unread = $unreadCount > 0 ? true : false;
            $chat->unread_count = $unreadCount;
        }

        $this->dispatch('reload_scripts');
        return view('livewire.app.inbox-component', ['chats' => $chats])->layout('livewire.app.layouts.base');
    }
}
