<?php

namespace App\Livewire\App;

use App\Models\Chat;
use App\Models\Contact;
use Livewire\Component;
use App\Models\ChatMessage;
use Illuminate\Support\Facades\DB;

class InboxComponent extends Component
{
    public $folders, $folder_search_term, $templates, $active_numbers, $receiver_numbers;
    public function mount()
    {
        $this->folders = DB::table('contact_folders')->where('user_id', user()->id)->get();
        $last_chat = DB::table('chats')->select('id')->where('user_id', user()->id)->orderBy('updated_at', 'DESC')->first();

        if ($last_chat) {
            $this->selectChat($last_chat->id);
        }

        $this->templates = DB::table('inbox_templates')->where('user_id', user()->id)->get();
        $this->active_numbers = DB::table('numbers')->where('user_id', user()->id)->get();

        $extContacts = DB::table('chats')->select('contact_id')->where('user_id', user()->id)->pluck('contact_id')->toArray();
        $this->receiver_numbers = DB::table('contacts')->where('user_id', user()->id)->whereNotIn('id', $extContacts)->get();
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
    }

    public $selected_chat_id, $selected_chat, $messages;
    public function selectChat($chat_id)
    {
        $this->selected_chat_id = $chat_id;
        $selected_chat = DB::table('chats')->select('contacts.*', 'chats.from_number as from_number')->join('contacts', 'contacts.id', 'chats.contact_id')->where('chats.id', $chat_id)->first();
        $selected_chat->avatar_ltr = substr($selected_chat->first_name, 0, 1) . substr($selected_chat->last_name, 0, 1);
        $selected_chat->notes = DB::table('contact_notes')->where('contact_id', $selected_chat->id)->get();
        $this->selected_chat = $selected_chat;

        $this->messages = DB::table('chat_messages')->where('chat_id', $chat_id)->get();

        $this->dispatch('scrollToBottom');
    }

    public function sendMessage($message)
    {
        $msg = new ChatMessage();
        $msg->chat_id = $this->selected_chat_id;
        $msg->sender = user()->id;
        $msg->receiver = $this->selected_chat->id;
        $msg->message = $message;
        $msg->save();

        $chat = Chat::where('id', $this->selected_chat_id)->first();
        $chat->last_message = $message;
        $chat->save();

        $this->messages->push($msg);
        $this->dispatch('scrollToBottom');
    }

    public $selected_template_preview_new_chat, $selected_template_id_new_chat, $receiver_id, $sender_id, $new_chat_message;
    public function useTemplateNewChat()
    {
        if ($this->receiver_id) {
            $contact = Contact::find($this->receiver_id);
            $output = $this->selected_template_preview_new_chat; // Start with the template preview
            $output = str_replace('[phone_number]', $contact->number, $output);
            $output = str_replace('[email_address]', $contact->email, $output);
            $output = str_replace('[first_name]', $contact->first_name, $output);
            $output = str_replace('[last_name]', $contact->last_name, $output);
            $output = str_replace('[company]', $contact->company, $output);

            $this->new_chat_message = $output;

            $this->dispatch('updateTextareaNewChat', $output);
            // $this->reset(['selected_template_preview_new_chat', 'selected_template_id_new_chat']);
        } else {
            $this->dispatch('error', ['message'=>'No receiver selected']);
        }

    }

    public function updatedReceiverId()
    {
        if ($this->selected_template_id_new_chat) {
            $this->useTemplateNewChat();
        }
    }

    public function startNewChat()
    {
        $this->validate([
            'sender_id' =>'required',
            'receiver_id' =>'required',
            'selected_template_id_new_chat' =>'required',
            'selected_template_preview_new_chat' =>'required',

        ], [
            '*.required' => 'This field is required'
        ]);

        $chat = new Chat();
        $chat->user_id = user()->id;
        $chat->contact_id = $this->receiver_id;
        $chat->last_message = $this->new_chat_message;
        $chat->from_number = $this->sender_id;
        $chat->save();

        $message = new ChatMessage();
        $message->chat_id = $chat->id;
        $message->sender = user()->id;
        $message->receiver = $this->receiver_id;
        $message->message = $this->new_chat_message;
        $message->save();

        session()->flash('success', 'New chat started successfully');
        return redirect()->route('user.inbox');
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
        $output = str_replace('[phone_number]', $contact->number, $output);
        $output = str_replace('[email_address]', $contact->email, $output);
        $output = str_replace('[first_name]', $contact->first_name, $output);
        $output = str_replace('[last_name]', $contact->last_name, $output);
        $output = str_replace('[company]', $contact->company, $output);

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
    }

    public $filter_time, $searchTerm;
    public function render()
    {
        $chats = DB::table('chats')->select('chats.*', 'contacts.first_name', 'contacts.last_name', 'contacts.number')->join('contacts', 'contacts.id', 'chats.contact_id')->where(function($q){
            $q->where('contacts.number', 'like', '%' . $this->searchTerm . '%')
                ->orWhere('contacts.first_name', 'like', '%' . $this->searchTerm . '%')
                ->orWhere('contacts.last_name', 'like', '%' . $this->searchTerm . '%')
                ->orWhere('chats.last_message', 'like', '%' . $this->searchTerm . '%');
        })->where('chats.user_id', user()->id)->orderBy('chats.updated_at', 'DESC');

        if ($this->sort_folder_id) {
            $chats = $chats->where('contacts.folder_id', $this->sort_folder_id);
        }

        if ($this->unread_filter) {
            $chats = $chats->where('chats.status', 0);
        }

        // Apply time filter if set
        if ($this->filter_time) {
            switch ($this->filter_time) {
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
                    // If 'all' or no filter is applied, no additional filtering is necessary
                    break;
            }
        }

        $chats = $chats->get();

        foreach ($chats as $key => $chat) {
            $chat->avatar_ltr = substr($chat->first_name, 0, 1) . substr($chat->last_name, 0, 1);
        }

        $this->dispatch('reload_scripts');
        return view('livewire.app.inbox-component', ['chats' => $chats])->layout('livewire.app.layouts.base');
    }
}
