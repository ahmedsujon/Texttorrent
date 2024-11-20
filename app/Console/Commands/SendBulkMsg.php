<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Jobs\SendBulkSMS;
use App\Models\BulkMessageItem;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

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
            $user = DB::table('users')->select('id', 'type', 'parent_id')->where('id', $bulkMessage->send_by)->first();
            if ($user->type == 'sub') {
                $user_id = $user->parent_id;
            } else {
                $user_id = $user->id;
            }

            SendBulkSMS::dispatch($user_id, $bulkMessage->id, $bulkMessage->send_from, $bulkMessage->send_to, $bulkMessage->message, $bulkMessage->file, $bulkMessage->type);
        }

        $this->info('Bulk message sending completed - ' . $bulkMessages->count() . ' ');
    }
}
