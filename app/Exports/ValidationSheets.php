<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ValidationSheets implements FromCollection, WithHeadings, WithTitle
{
    protected $selectedItem;
    protected $type;

    public function __construct($selectedItem, $type)
    {
        $this->selectedItem = $selectedItem;
        $this->type = $type;
    }

    public function collection()
    {
        return DB::table('number_validation_items')
            ->join('contacts', 'contacts.id', '=', 'number_validation_items.contact_id')
            ->where('contacts.valid', $this->type)
            ->whereIn('number_validation_items.number_validation_id', $this->selectedItem['selectedItems'])
            ->select(
                DB::raw("CONCAT(contacts.first_name, ' ', contacts.last_name) AS name"),
                'number_validation_items.number',
                'number_validation_items.location',
                'number_validation_items.carrier',
                'number_validation_items.line_type',
                'contacts.valid AS status',
                'number_validation_items.validated_at'
            )
            ->get();
    }

    public function headings(): array
    {
        return ['Contact Name', 'Number', 'Location', 'Carrier', 'Line Type', 'Status', 'Validated At'];
    }

    public function title(): string
    {
        return ucfirst($this->type) . " Numbers";
    }
}
