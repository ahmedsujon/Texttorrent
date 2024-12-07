<?php

namespace App\Jobs;

use Exception;
use Twilio\Rest\Client;
use Illuminate\Bus\Queueable;
use App\Models\BulkMessageItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class GetBulkMessageStatus implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $msg_id;
    protected $user_id;

    /**
     * Create a new job instance.
     */
    public function __construct($msg_id, $user_id)
    {
        $this->msg_id = $msg_id;
        $this->user_id = $user_id;
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

                $msg = BulkMessageItem::find($this->msg_id);
                $message = $client->messages($msg->msg_sid)->fetch();

                $msg->send_status = $message->status;
                $msg->save();

            } catch (Exception $e) {

            }
        }
    }
}
