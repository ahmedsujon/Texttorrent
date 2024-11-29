<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ValidationItemExport implements FromCollection, WithHeadings
{
    protected $selectedItem;

    public function __construct($selectedItem)
    {
        $this->selectedItem = $selectedItem;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $items = DB::table('number_validation_items')->select('contacts.first_name', 'contacts.last_name', 'number_validation_items.number', 'contacts.valid', 'number_validation_items.validated_at')->join('contacts', 'contacts.id', 'number_validation_items.contact_id')->where('number_validation_items.number_validation_id', $this->selectedItem['selectedItem'])->get();

        $output = [];
        foreach ($items as $key => $item) {
            $output[] = [
                'name' => $item->first_name . ' ' . $item->last_name,
                'number' => $item->number,
                'status' => $item->valid,
                'validated_at' => $item->validated_at,
            ];
        }

        $collection = collect($output);
        return $collection;
    }

    /**
     * Define the headings for the exported file.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Contact Name',
            'Number',
            'Status',
            'Validated At'
        ];
    }
}
