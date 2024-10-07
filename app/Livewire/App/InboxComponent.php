<?php

namespace App\Livewire\App;

use Livewire\Component;
use App\Models\ChatMessage;
use App\Models\Contact;
use Illuminate\Support\Facades\DB;

class InboxComponent extends Component
{
    public $folders, $folder_search_term, $templates;
    public function mount()
    {
        $this->folders = DB::table('contact_folders')->where('user_id', user()->id)->get();
        $last_chat = DB::table('chats')->select('id')->where('user_id', user()->id)->orderBy('updated_at', 'DESC')->first();

        if ($last_chat) {
            $this->selectChat($last_chat->id);
        }

        $this->templates = DB::table('inbox_templates')->where('user_id', user()->id)->get();
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
        $selected_chat = DB::table('chats')->select('contacts.*')->join('contacts', 'contacts.id', 'chats.contact_id')->where('chats.id', $chat_id)->first();
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

        $this->messages->push($msg);
        $this->dispatch('scrollToBottom');
    }

    public $selected_template_preview, $selected_template_id;
    public function useTemplate()
    {
        $this->validate([
            'selected_template_id' => 'required',
        ],[
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

    public function render()
    {
        $chats = DB::table('chats')->select('chats.*', 'contacts.first_name', 'contacts.last_name', 'contacts.number')->join('contacts', 'contacts.id', 'chats.contact_id')->where('chats.user_id', user()->id)->orderBy('chats.updated_at', 'DESC')->get();

        foreach ($chats as $key => $chat) {
            $chat->avatar_ltr = substr($chat->first_name, 0, 1) . substr($chat->last_name, 0, 1);
        }

        $this->dispatch('reload_scripts');
        return view('livewire.app.inbox-component', ['chats' => $chats])->layout('livewire.app.layouts.base');
    }
}
