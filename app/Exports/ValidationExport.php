<?php

namespace App\Exports;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ValidationExport implements FromCollection, WithHeadings
{
    protected $selectedItems;

    public function __construct($selectedItems)
    {
        $this->selectedItems = $selectedItems;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $items = DB::table('number_validations')->select('contact_lists.name as list', 'number_validations.total_credits', 'number_validations.total_number', 'number_validations.total_mobile_numbers', 'number_validations.total_landline_numbers', 'number_validations.valid_numbers', 'number_validations.invalid_numbers', 'number_validations.created_at')->join('contact_lists', 'contact_lists.id', 'number_validations.list_id')->whereIn('number_validations.id', $this->selectedItems['selectedItems'])->get();

        foreach ($items as $key => $item) {
            $item->created_at = Carbon::parse($item->created_at)->isToday() ? 'Today, ' . \Carbon\Carbon::parse($item->created_at)->format('g:i A') : \Carbon\Carbon::parse($item->created_at)->format('F j, Y, g:i A');
        }

        return $items;
    }

    /**
     * Define the headings for the exported file.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'File Name',
            'Validator Credits',
            'Total Numbers',
            'Total Mobile Numbers',
            'Total landline Numbers',
            'Valid Numbers',
            'Invalid Numbers',
            'Created At'
        ];
    }
}
