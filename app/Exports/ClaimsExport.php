<?php

namespace App\Exports;

use App\Models\BulkMessageItem;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ClaimsExport implements FromCollection, WithHeadings
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
        $claims = BulkMessageItem::select('send_to', 'received_message')->whereIn('id', $this->bulk_ids['bulk_ids'])->get();

        foreach ($claims as $key => $claim) {
            $claim->received_message = $claim->received_message ? $claim->received_message : 'Waiting!';
        }

        return $claims;
    }

    /**
     * Define the headings for the exported file.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Number',
            'Message'
        ];
    }
}
