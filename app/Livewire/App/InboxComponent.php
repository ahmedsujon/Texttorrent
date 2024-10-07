<?php

namespace App\Livewire\App;

use Livewire\Component;
use App\Models\ChatMessage;
use Illuminate\Support\Facades\DB;

class InboxComponent extends Component
{
    public $folders, $folder_search_term;
    public function mount()
    {
        $this->folders = DB::table('contact_folders')->where('user_id', user()->id)->get();
        $last_chat = DB::table('chats')->select('id')->where('user_id', user()->id)->orderBy('updated_at', 'DESC')->first();

        if ($last_chat) {
            $this->selectChat($last_chat->id);
        }
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
