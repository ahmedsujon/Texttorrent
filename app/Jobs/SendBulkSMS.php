<?php

namespace App\Jobs;

use Exception;
use Twilio\Rest\Client;
use App\Models\ChatMessage;
use Illuminate\Bus\Queueable;
use App\Models\BulkMessageItem;
use App\Models\Chat;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendBulkSMS implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user_id;
    protected $msg_id;
    protected $from;
    protected $to;
    protected $message;
    protected $file;
    protected $type;
    protected $send_by;

    /**
     * Create a new job instance.
     */
    public function __construct($user_id, $msg_id, $from, $to, $message, $file, $type, $send_by)
    {
        $this->user_id = $user_id;
        $this->msg_id = $msg_id;
        $this->from = $from;
        $this->to = $to;
        $this->message = $message;
        $this->file = $file;
        $this->type = $type;
        $this->send_by = $send_by;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $getCredentials = DB::table('apis')->where('user_id', $this->user_id)->where('gateway', 'Twilio')->first();

        if ($getCredentials) {
            $sid = $getCredentials->account_sid;
            $token = $getCredentials->auth_token;

            try {
                $client = new Client($sid, $token);
                if ($this->type == 'mms') {
                    $output = $client->messages->create($this->to, [
                        'from' => $this->from,
                        'body' => $this->message,
                        'mediaUrl' => [$this->file]
                    ]);
                } else {
                    $output = $client->messages->create($this->to, [
                        'from' => $this->from,
                        'body' => $this->message
                    ]);
                }

                $contact = DB::table('contacts')->select('id')->where('number', $this->to)->first();
                $getChat = DB::table('chats')->where('user_id', $this->send_by)->where('contact_id', $contact->id)->where('from_number', $this->from)->first();
                if ($getChat) {
                    $chat = Chat::find($getChat->id);
                    $chat->last_message = $this->message;
                    $chat->save();

                    $msg1 = new ChatMessage();
                    $msg1->chat_id = $chat->id;
                    $msg1->api = 'Twilio';
                    $msg1->api_send_response = $output;
                    $msg1->msg_sid = $output->sid;
                    $msg1->direction = 'outbound';
                    $msg1->message = $this->message;
                    $msg1->save();
                }

            } catch (Exception $e) {

            }
        } else {
            return [
                'result' => false,
                'message' => 'Twilio API credentials not found for this user.',
            ];
        }

        $msg = BulkMessageItem::find($this->msg_id);
        $msg->status = 1;
        $msg->save();
    }
}
