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

    function normalizeString($string) {
        // Trim leading and trailing spaces
        $string = trim($string);

        // Replace multiple spaces with a single space
        $string = preg_replace('/\s+/', ' ', $string);

        return $string;
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



        $first_name = $this->columns['first_name_column'] ? $this->normalizeString(ucwords(strtolower($this->columns['first_name_column']))) : null;
        $last_name = $this->columns['last_name_column'] ? $this->normalizeString(ucwords(strtolower($this->columns['last_name_column']))) : null;
        $email_address = $this->columns['email_address_column'] ? $this->normalizeString(ucwords(strtolower($this->columns['email_address_column']))) : null;
        $phone_number = $this->columns['phone_number_column'] ? $this->normalizeString(ucwords(strtolower($this->columns['phone_number_column']))) : null;
        $company = $this->columns['company_column'] ? $this->normalizeString(ucwords(strtolower($this->columns['company_column']))) : null;

        $additional_1 = $this->columns['additional_1_column'] ? $this->normalizeString(ucwords(strtolower($this->columns['additional_1_column']))) : null;
        $additional_2 = $this->columns['additional_2_column'] ? $this->normalizeString(ucwords(strtolower($this->columns['additional_2_column']))) : null;
        $additional_3 = $this->columns['additional_3_column'] ? $this->normalizeString(ucwords(strtolower($this->columns['additional_3_column']))) : null;
        $import_list_id = $this->columns['import_list_id'] ? $this->normalizeString(ucwords(strtolower($this->columns['import_list_id']))) : null;

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
        // dd($import_list_id);
        if ($import_list_id) {
            $contact->list_id = $import_list_id != 'Unlisted' && $import_list_id != 'Blacklisted' ? $import_list_id : null;
        }
        $contact->save();
    }
}
