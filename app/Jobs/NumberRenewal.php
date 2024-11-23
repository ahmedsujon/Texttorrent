<?php

namespace App\Jobs;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Number;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class NumberRenewal implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $data;

    /**
     * Create a new job instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $data = $this->data;

        Mail::send('emails.number-expiration-alert', $data, function ($message) use ($data) {
            $message->to($data['email'])
                ->subject('Number Expiration Alert');
        });
    }
}
