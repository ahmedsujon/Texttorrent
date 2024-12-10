<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ValidationExport implements WithMultipleSheets
{
    use Exportable;

    protected $selectedItem;

    public function __construct($selectedItem)
    {
        $this->selectedItem = $selectedItem;
    }

    public function sheets(): array
    {
        // dd($this->selectedItem);

        $types = ['valid', 'invalid', 'landline'];
        $sheets = [];

        foreach ($types as $type) {
            $sheets[] = new ValidationSheets($this->selectedItem, $type);
        }

        return $sheets;
    }
}
