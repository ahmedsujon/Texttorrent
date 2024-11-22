<?php

namespace App\Console\Commands;

use App\Jobs\SendEventSMS;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SendEventMsg extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:event-messages';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Event Messages';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();
        $events = DB::table('events')
            ->where('status', 0)
            ->where('alert_at', '<=', $now->format('Y-m-d H:i'))
            ->get();

        foreach ($events as $event) {
            $content = "Event Reminder: '{$event->subject}' scheduled on {$event->date} at {$event->time}. Please make necessary preparations.";
            // Dispatch the SMS job
            dispatch(new SendEventSMS(
                $event->id,
                $event->user_id,
                $content, // Assuming this is the content
                $event->sender_number,
                $event->receiver_number
            ));
        }

        $this->info('Sent Event SMS:- ' . $events->count() . ' - ' . $now);
    }
}
