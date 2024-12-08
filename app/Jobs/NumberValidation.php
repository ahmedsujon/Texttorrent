<?php

namespace App\Jobs;

use App\Models\Contact;
use App\Models\NumberValidation as ModelsNumberValidation;
use App\Models\NumberValidationItems;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class NumberValidation implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $validation_item_id;

    /**
     * Create a new job instance.
     */
    public function __construct($validation_item_id)
    {
        $this->validation_item_id = $validation_item_id;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        $valItem = NumberValidationItems::where('id', $this->validation_item_id)->first();
        $validation = ModelsNumberValidation::where('id', $valItem->number_validation_id)->first();

        $apiKey = env('NUM_VERIFY_ACCESS_KEY');

        $response = Http::get("http://apilayer.net/api/validate", [
            'access_key' => $apiKey,
            'number' => $valItem->number,
        ]);

        $result = $response->json();

        $valItem->validated_at = Carbon::parse(now());
        $valItem->status = 'Completed';
        $valItem->location = $result['location'] ? $result['location'] : null;
        $valItem->carrier = $result['carrier'] ? $result['carrier'] : null;
        $valItem->line_type = $result['line_type'] ? $result['line_type'] : null;
        $valItem->save();

        $contact = Contact::find($valItem->contact_id);
        $contact->validation_process = 1;

        $valid = 0;
        $invalid = 0;
        // Check if the 'valid' key exists in the response
        if (isset($result['valid']) && $result['valid'] === true) {
            $contact->valid = 'Valid';
            $valid = 1;
        } else {
            $contact->valid = 'Invalid';
            $invalid = 1;
        }
        $contact->save();

        if ($validation->total_landline_numbers == null) {
            $validation->total_landline_numbers = 0;
        }
        if ($validation->total_mobile_numbers == null) {
            $validation->total_mobile_numbers = 0;
        }

        // Safely check for the 'line_type' key
        if (isset($result['line_type'])) {
            if ($result['line_type'] == 'landline') {
                $validation->total_landline_numbers = $validation->total_landline_numbers ? $validation->total_landline_numbers + 1 : 1;
            } else {
                $validation->total_mobile_numbers = $validation->total_mobile_numbers ? $validation->total_mobile_numbers + 1 : 1;
            }
        }
        $validation->valid_numbers += $valid;
        $validation->invalid_numbers += $invalid;
        $validation->save();
    }
}
