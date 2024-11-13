<?php

namespace App\Exports;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class LogExport implements FromCollection, WithHeadings
{
    protected $bulk_ids;

    public function __construct($bulk_ids)
    {
        $this->bulk_ids = $bulk_ids;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $logs = DB::table('chat_messages')->select('chats.from_number as from', 'chats.contact_id as to', 'chats.contact_id as name', 'chat_messages.message', 'chat_messages.created_at', 'chat_messages.api_send_status')->join('chats', 'chats.id', 'chat_messages.chat_id')->whereIn('chat_messages.id', $this->bulk_ids['bulk_ids'])->get();

        foreach ($logs as $key => $log) {
            $contact = DB::table('contacts')->where('id', $log->to)->first();

            $log->to = $contact->number;
            $log->name = $contact->first_name.' '. $contact->last_name;
            $log->created_at = Carbon::parse($log->created_at)->isToday() ? 'Today, ' . \Carbon\Carbon::parse($log->created_at)->format('g:i A') : \Carbon\Carbon::parse($log->created_at)->format('F j, Y, g:i A');
        }

        return $logs;
    }

    /**
     * Define the headings for the exported file.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'From Number',
            'To Number',
            'Name',
            'Message',
            'Created At',
            'Status'
        ];
    }
}
