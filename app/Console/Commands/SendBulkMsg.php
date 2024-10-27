<?php

namespace App\Console\Commands;

use App\Jobs\SendBulkSMS;
use Carbon\Carbon;
use App\Models\BulkMessageItem;
use Illuminate\Console\Command;

class SendBulkMsg extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:bulk-messages';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Bulk Messages';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Bulk message sending started...');

        $bulkMessages = BulkMessageItem::where('status', 0)->where('execute_at', '<=', Carbon::now())->get();
        foreach ($bulkMessages as $bulkMessage) {
            SendBulkSMS::dispatch($bulkMessage->send_by, $bulkMessage->id, $bulkMessage->send_from,$bulkMessage->send_to, $bulkMessage->message, $bulkMessage->file, $bulkMessage->type);
        }

        $this->info('Bulk message sending completed - '.$bulkMessages->count().' ');
    }
}
