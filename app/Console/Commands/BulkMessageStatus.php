<?php

namespace App\Console\Commands;

use App\Jobs\GetBulkMessageStatus;
use App\Models\BulkMessageItem;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class BulkMessageStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:bulk-message-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Bulk Message Status';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $bulk_items = BulkMessageItem::select('id', 'send_by')->where('status', 1)->where(function($q){
            $q->where('send_status', 'pending');
            $q->orWhere('send_status', 'sent');
        })->where('msg_sid', '!=', null)->get();

        foreach ($bulk_items as $key => $bItem) {
            $user = DB::table('users')->select('id', 'type', 'parent_id')->where('id', $bItem->send_by)->first();
            if ($user->type == 'sub') {
                $user_id = $user->parent_id;
            } else {
                $user_id = $user->id;
            }

            GetBulkMessageStatus::dispatch($bItem->id, $user_id);
        }
    }
}
