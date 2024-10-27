<?php

namespace App\Jobs;

use App\Models\BulkMessageItem;
use Exception;
use Twilio\Rest\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Mail;

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

    /**
     * Create a new job instance.
     */
    public function __construct($user_id, $msg_id, $from, $to, $message, $file, $type)
    {
        $this->user_id = $user_id;
        $this->msg_id = $msg_id;
        $this->from = $from;
        $this->to = $to;
        $this->message = $message;
        $this->file = $file;
        $this->type = $type;
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
                    $client->messages->create($this->to, [
                        'from' => $this->from,
                        'body' => $this->message,
                        'mediaUrl' => [$this->file]
                    ]);
                } else {
                    $client->messages->create($this->to, [
                        'from' => $this->from,
                        'body' => $this->message
                    ]);
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
