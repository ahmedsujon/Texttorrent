<?php

namespace App\Jobs;

use App\Models\Event;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Twilio\Rest\Client;

class SendEventSMS implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $event_id;
    protected $user_id;
    protected $content;
    protected $from;
    protected $to;

    /**
     * Create a new job instance.
     */
    public function __construct($event_id, $user_id, $content, $from, $to)
    {
        $this->event_id = $event_id;
        $this->user_id = $user_id;
        $this->content = $content;
        $this->from = $from;
        $this->to = $to;
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
                $output = $client->messages->create($this->to, [
                    'from' => $this->from,
                    'body' => $this->content,
                ]);

                $msg = Event::find($this->event_id);
                $msg->status = 1;
                $msg->api = 'Twilio';
                $msg->send_response = $output;
                $msg->msg_sid = $output->sid;
                $msg->save();
            } catch (Exception $e) {

            }
        } else {
            return [
                'result' => false,
                'message' => 'Twilio API credentials not found for this user.',
            ];
        }
    }
}
