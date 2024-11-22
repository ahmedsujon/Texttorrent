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

    private function formatPhoneNumber($phone)
    {
        // Remove non-numeric characters
        $cleanPhone = preg_replace('/\D/', '', $phone);

        // Check if the number starts with '1', if not, add '+1'
        if (substr($cleanPhone, 0, 1) !== '1') {
            $cleanPhone = '1' . $cleanPhone;
        }

        // Prepend '+1'
        return '+1' . ltrim($cleanPhone, '1');
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

        // Validate and format phone number
        $number = $mappedRow[$phone_number] ?? NULL;
        if ($number) {
            $number = $this->formatPhoneNumber($number);
        }

        $contact = new Contact();
        $contact->user_id = auth()->user()->id;
        $contact->first_name = $mappedRow[$first_name] ?? null;
        $contact->last_name = $mappedRow[$last_name] ?? null;
        $contact->email = $mappedRow[$email_address] ?? null;
        $contact->number = $number;
        $contact->company = $mappedRow[$company] ?? null;
        $contact->additional_1 = $mappedRow[$additional_1] ?? null;
        $contact->additional_2 = $mappedRow[$additional_2] ?? null;
        $contact->additional_3 = $mappedRow[$additional_3] ?? null;
        if ($import_list_id) {
            $contact->list_id = $import_list_id;
        }
        $contact->save();
    }
}
