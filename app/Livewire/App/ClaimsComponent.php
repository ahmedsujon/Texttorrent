<?php

namespace App\Livewire\App;

use App\Exports\ClaimsExport;
use App\Models\BulkMessageItem;
use App\Models\BulkMessageReply;
use App\Models\Chat;
use App\Models\ChatMessage;
use App\Models\Contact;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class ClaimsComponent extends Component
{
    use WithPagination;
    public $sortingValue = 10, $searchTerm;

    public $claim_id;
    public function acceptConfirmation($id)
    {
        $this->claim_id = $id;
        $this->dispatch('showClaimAcceptConfirmation');
    }

    public function acceptClaim()
    {
        $id = $this->claim_id;

        $claim = BulkMessageItem::find($id);
        $contact = DB::table('contacts')->where('number', $claim->send_to)->first();

        $getChat = Chat::where('user_id', user()->id)->where('contact_id', $contact->id)->where('from_number', $claim->send_from)->first();

        if ($getChat) {
            $chat = $getChat;
        } else {
            $chat = new Chat();
            $chat->user_id = user()->id;
            $chat->contact_id = $contact->id;
            $chat->from_number = $claim->send_from;
        }
        $chat->last_message = $claim->received_message ? $claim->received_message : $claim->message;
        $chat->save();

        $msg1 = new ChatMessage();
        $msg1->chat_id = $chat->id;
        $msg1->direction = 'outbound';
        $msg1->api_send_status = 'delivered';
        $msg1->message = $claim->message;
        $msg1->save();

        $allRMsgs = BulkMessageReply::where('bulk_message_item_id', $claim->id)->get();
        foreach ($allRMsgs as $key => $msgItm) {
            $msg2 = new ChatMessage();
            $msg2->chat_id = $chat->id;
            $msg2->direction = 'inbound';
            $msg2->message = $msgItm->message;
            $msg2->api_send_status = 'success';
            $msg2->api_receive_status = 'success';
            $msg2->credit_clear = 1;
            $msg2->msg_sid = $msgItm->msg_sid;
            $msg2->updated_at = $msgItm->created_at;
            $msg2->save();
        }

        $claim->status = 2;
        $claim->save();

        $this->dispatch('success', ['message' => 'Claim accepted successfully!']);
        $this->dispatch('closeModal');
    }

    public function blacklistConfirmation($id)
    {
        $this->claim_id = $id;
        $this->dispatch('showClaimBlacklistConfirmation');
    }

    public function blacklistClaim()
    {
        $id = $this->claim_id;

        $claim = BulkMessageItem::find($id);
        $claim->status = 3;
        $claim->save();

        $contact = Contact::where('number', $claim->send_to)->where('user_id', user()->id)->first();
        $contact->blacklisted = 1;
        $contact->blacklisted_by = user()->id;
        $contact->save();

        $this->dispatch('success', ['message' => 'Contact blacklisted successfully!']);
        $this->dispatch('closeModal');
    }

    public function deleteConfirmation($id)
    {
        $this->claim_id = $id;
        $this->dispatch('showClaimDeleteConfirmation');
    }

    public function deleteClaim()
    {
        $id = $this->claim_id;

        $claim = BulkMessageItem::find($id);
        $claim->delete();

        $this->dispatch('success', ['message' => 'Claim deleted successfully!']);
        $this->dispatch('closeModal');
    }

    public $bulk_ids = [], $claim_ids, $select_all;

    public function updatedSelectAll()
    {
        if ($this->select_all) {
            $this->bulk_ids = $this->claim_ids;
        } else {
            $this->bulk_ids = [];
        }
    }

    public function bulkConfirmation($type)
    {
        if ($this->bulk_ids) {
            if ($type == 'accept') {
                $this->dispatch('showBulkAcceptConfirmation');
            } else if ($type == 'blacklist') {
                $this->dispatch('showBulkBlacklistConfirmation');
            } else if ($type == 'delete') {
                $this->dispatch('showBulkDeleteConfirmation');
            }
        } else {
            $this->dispatch('error', ['message' => 'Please select claims to perform this action.']);
        }

    }

    public function acceptClaimBulk()
    {
        foreach ($this->bulk_ids as $key => $id) {

            $claim = BulkMessageItem::find($id);
            $contact = DB::table('contacts')->where('number', $claim->send_to)->first();

            $getChat = Chat::where('user_id', user()->id)->where('contact_id', $contact->id)->where('from_number', $claim->send_from)->first();

            if ($getChat) {
                $chat = $getChat;
            } else {
                $chat = new Chat();
                $chat->user_id = user()->id;
                $chat->contact_id = $contact->id;
                $chat->from_number = $claim->send_from;
            }
            $chat->last_message = $claim->received_message ? $claim->received_message : $claim->message;
            $chat->save();

            $msg1 = new ChatMessage();
            $msg1->chat_id = $chat->id;
            $msg1->direction = 'outbound';
            $msg1->api_send_status = 'delivered';
            $msg1->message = $claim->message;
            $msg1->save();

            $allRMsgs = BulkMessageReply::where('bulk_message_item_id', $claim->id)->get();
            foreach ($allRMsgs as $key => $msgItm) {
                $msg2 = new ChatMessage();
                $msg2->chat_id = $chat->id;
                $msg2->direction = 'inbound';
                $msg2->message = $msgItm->message;
                $msg2->api_send_status = 'success';
                $msg2->api_receive_status = 'success';
                $msg2->credit_clear = 1;
                $msg2->msg_sid = $msgItm->msg_sid;
                $msg2->updated_at = $msgItm->created_at;
                $msg2->save();
            }

            $claim->status = 2;
            $claim->save();
        }

        $this->dispatch('success', ['message' => 'Selected claims accepted successfully!']);
        $this->dispatch('closeModal');
        $this->select_all = false;
        $this->bulk_ids = [];
    }

    public function blacklistClaimBulk()
    {
        foreach ($this->bulk_ids as $key => $id) {
            $claim = BulkMessageItem::find($id);
            $claim->status = 3;
            $claim->save();

            $contact = Contact::where('number', $claim->send_to)->where('user_id', user()->id)->first();
            $contact->blacklisted = 1;
            $contact->blacklisted_by = user()->id;
            $contact->save();
        }

        $this->dispatch('success', ['message' => 'Selected contacts blacklisted successfully!']);
        $this->dispatch('closeModal');
        $this->select_all = false;
        $this->bulk_ids = [];
    }

    public function deleteClaimBulk()
    {
        foreach ($this->bulk_ids as $key => $id) {
            $claim = BulkMessageItem::find($id);
            $claim->delete();
        }

        $this->dispatch('success', ['message' => 'Selected claims deleted successfully!']);
        $this->dispatch('closeModal');
        $this->select_all = false;
        $this->bulk_ids = [];
    }

    public function bulkExport()
    {
        if (!$this->bulk_ids) {
            $this->dispatch('error', ['message' => 'Please select claims to perform this action.']);
        } else {
            return Excel::download(new ClaimsExport(['bulk_ids' => $this->bulk_ids]), 'claims.csv');
        }
    }

    public function refreshComponents()
    {
        $this->render();
    }

    public function render()
    {
        $claims = BulkMessageItem::where('status', 1)->where('received_message', '!=', NULL)->where(function ($q) {
            $q->where('received_message', 'like', '%' . $this->searchTerm . '%')
                ->orWhere('send_to', 'like', '%' . $this->searchTerm . '%');
        })->where('send_by', user()->id)->paginate($this->sortingValue);

        $this->claim_ids = $claims->pluck('id')->toArray();

        return view('livewire.app.claims-component', ['claims' => $claims])->layout('livewire.app.layouts.base');
    }
}
