<?php

namespace App\Imports;

use App\Models\Contact;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ContactsImport implements ToModel, WithHeadingRow
{
    protected $columns;

    public function __construct($columns)
    {
        $this->columns = $columns;
    }

    public function headingRow(): int
    {
        return 1; // This is to indicate that row 1 is the header
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Replace underscores with spaces for keys if needed
        $mappedRow = array_combine(
            array_map(function ($key) {
                return ucwords(str_replace('_', ' ', $key));
            }, array_keys($row)),
            $row
        );

        $first_name = $this->columns['first_name_column'] ? $this->columns['first_name_column'] : 'First Name';
        $last_name = $this->columns['last_name_column'] ? $this->columns['last_name_column'] : 'Last Name';
        $email_address = $this->columns['email_address_column'] ? $this->columns['email_address_column'] : 'Email Address';
        $phone_number = $this->columns['phone_number_column'] ? $this->columns['phone_number_column'] : 'Phone Number';
        $company = $this->columns['company_column'] ? $this->columns['company_column'] : 'Company';

        $additional_1 = $this->columns['additional_1_column'] ? $this->columns['additional_1_column'] : 'Additional 1';
        $additional_2 = $this->columns['additional_2_column'] ? $this->columns['additional_2_column'] : 'Additional 2';
        $additional_3 = $this->columns['additional_3_column'] ? $this->columns['additional_3_column'] : 'Additional 3';
        $import_list_id = $this->columns['import_list_id'] ? $this->columns['import_list_id'] : '';

        $contact = new Contact();
        $contact->user_id = auth()->user()->id;
        $contact->first_name = $mappedRow[$first_name] ?? NULL;
        $contact->last_name = $mappedRow[$last_name] ?? NULL;
        $contact->email = $mappedRow[$email_address] ?? NULL;
        $contact->number = $mappedRow[$phone_number] ?? NULL;
        $contact->company = $mappedRow[$company] ?? NULL;
        $contact->additional_1 = $mappedRow[$additional_1] ?? NULL;
        $contact->additional_2 = $mappedRow[$additional_2] ?? NULL;
        $contact->additional_3 = $mappedRow[$additional_3] ?? NULL;
        if ($import_list_id) {
            $contact->list_id = $import_list_id;
        }
        $contact->save();
    }
}
