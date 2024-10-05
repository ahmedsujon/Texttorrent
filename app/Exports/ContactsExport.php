<?php

namespace App\Exports;

use App\Models\Contact;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ContactsExport implements FromCollection, WithHeadings
{
    protected $selectedContacts;

    public function __construct($selectedContacts)
    {
        $this->selectedContacts = $selectedContacts;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Contact::select('first_name', 'last_name', 'email', 'number', 'company', 'additional_1', 'additional_2', 'additional_3')->whereIn('id', $this->selectedContacts['selectedContacts'])->get();
    }

    /**
     * Define the headings for the exported file.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'First Name',
            'Last Name',
            'Email Address',
            'Phone Number',
            'Company',
            'Additional 1',
            'Additional 2',
            'Additional 3'
        ];
    }
}
