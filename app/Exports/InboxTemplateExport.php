<?php

namespace App\Exports;

use Carbon\Carbon;
use App\Models\InboxTemplate;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class InboxTemplateExport implements FromCollection, WithHeadings
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
        $templates = InboxTemplate::select('template_name', 'preview_message', 'status', 'created_at')->whereIn('id', $this->bulk_ids['bulk_ids'])->get();

        foreach ($templates as $key => $template) {
            $template->status = $template->status == 1 ? 'Active' : 'Inactive';
            $template->created_at = Carbon::parse($template->created_at)->format('F j, g:i A');
        }

        return $templates;
    }

    /**
     * Define the headings for the exported file.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'Name',
            'Message',
            'Status',
            'CreatedAt'
        ];
    }
}
