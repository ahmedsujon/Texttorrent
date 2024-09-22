<?php

namespace App\Livewire\App\Settings;

use App\Models\Number;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;
use Twilio\Rest\Client;

class GetNumberComponent extends Component
{
    use WithPagination;
    public $country = 'US', $areaCode, $qty = 1, $searchTerm = '', $selectedNumber, $all_numbers = [], $numberType = 'local', $purchasedNumbers = [], $sortingValue = 10, $numbers_array = [], $numbers_info_array = [];

    public function mount()
    {
        $this->getNumbers();
        // $this->fetchPurchasedNumbers();

    }

    public function areaCodeSearch()
    {
        $this->validate([
            'areaCode' => 'required',
        ]);

        $this->getNumbers();
    }

    public function plusQty()
    {
        $total = count($this->all_numbers);
        if ($this->qty < $total) {
            $this->qty += 1;
        }
    }
    public function minusQty()
    {
        if ($this->qty > 1) {
            $this->qty -= 1;
        }
    }
    public function updatedQty()
    {
        if ($this->qty > 30) {
            $this->qty = 30;
        }
    }

    public function updatedNumberType()
    {
        $this->getNumbers();
    }

    public function getNumbers()
    {
        $twilio = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));

        if ($this->numberType == 'local') {
            $numbers = $twilio->availablePhoneNumbers($this->country)->local->read(["areaCode" => $this->areaCode]);
        } else {
            $numbers = $twilio->availablePhoneNumbers($this->country)->tollFree->read();
        }

        // Convert each number to a simple array
        $numbers_array = [];

        foreach ($numbers as $number) {
            $reflectedObject = new \ReflectionObject($number->capabilities);
            $props = $reflectedObject->getProperties(\ReflectionProperty::IS_PROTECTED);

            $caps = [];
            foreach ($props as $prop) {
                $prop->setAccessible(true);
                $caps[$prop->getName()] = $prop->getValue($number->capabilities);
            }

            // Create a simple array for each number
            $numbers_array[] = [
                'friendlyName' => $number->friendlyName,
                'phoneNumber' => $number->phoneNumber,
                'region' => $number->region,
                'isoCountry' => $number->isoCountry,
                'latitude' => $number->latitude,
                'longitude' => $number->longitude,
                'postalCode' => $number->postalCode,
                'capabilities' => $caps,
            ];

            $this->numbers_array[] = $number->phoneNumber;
            $this->numbers_info_array[] = [
                'friendly_name' => $number->friendlyName,
                'number' => $number->phoneNumber, // '+14154750306'
                'region' => $number->region,
                'country' => $number->isoCountry,
                'latitude' => $number->latitude,
                'longitude' => $number->longitude,
                'postal_code' => $number->postalCode,
            ];
        }

        $this->all_numbers = $numbers_array;
    }

    public $numberToPurchase, $numberToPurchaseInfo = [];
    public function purchaseNumberConfirmation($number, $friendlyName, $region, $isoCountry, $latitude, $longitude, $postalCode)
    {
        $this->numberToPurchase = $number;
        $this->numberToPurchaseInfo = [
            'friendly_name' => $friendlyName,
            'number' => $number, // '+14154750306'
            'region' => $region,
            'country' => $isoCountry,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'postal_code' => $postalCode,
        ];

        $this->dispatch('showPurchaseModal');
    }

    public function purchaseNumber()
    {
        $twilio = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));

        try {
            $twilio->incomingPhoneNumbers->create([
                'phoneNumber' => $this->numberToPurchase,
            ]);

            $saveData = $this->savePurchase($this->numberToPurchaseInfo);
            if ($saveData) {
                $this->getNumbers();
                $this->dispatch('purchase_success');

                $this->numberToPurchase = '';
                $this->numberToPurchaseInfo = [];
            } else {
                $this->dispatch('error', ['message' => 'Something went wrong!']);
            }
        } catch (\Exception $e) {
            $this->dispatch('error', ['message' => 'Failed to purchase number: ' . $e->getMessage()]);
        }
    }

    public function savePurchase($selected_number)
    {
        $data = $selected_number;

        $get_number = Number::where('number', $data['number'])->first();

        if (!$get_number) {
            $number = new Number();
            $number->user_id = user()->id;
            $number->friendly_name = $data['friendly_name'];
            $number->number = $data['number'];
            $number->region = $data['region'];
            $number->country = $data['country'];
            $number->latitude = $data['latitude'];
            $number->longitude = $data['longitude'];
            $number->postal_code = $data['postal_code'];
            $number->capabilities = $this->fetchPurchasedNumberCaps($data['number']);
            $number->purchased_at = Carbon::parse(now());
            $number->save();

            return true;
        } else {
            return false;
        }
    }

    public $selected_numbers, $selected_numbers_info;
    public function bulkPurchaseConfirmation()
    {
        $selected_numbers = array_slice($this->numbers_array, 0, $this->qty);
        $this->selected_numbers = $selected_numbers;

        $selected_numbers_info = array_slice($this->numbers_info_array, 0, $this->qty);
        $this->selected_numbers_info = $selected_numbers_info;

        $this->dispatch('showBulkPurchaseModal');
    }

    public function bulkPurchaseNumber()
    {
        $twilio = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));

        try {
            $purchase_result = [];

            foreach ($this->selected_numbers_info as $key => $number) {
                $twilio->incomingPhoneNumbers->create([
                    'phoneNumber' => $number['number'],
                ]);

                $saveData = $this->savePurchase($number);
                if ($saveData) {
                    $purchase_result[] = [
                        'number' => $number['number'],
                        'status' => "<span class='text-success'>Success</span>",
                    ];
                } else {
                    $purchase_result[] = [
                        'number' => $number['number'],
                        'status' => "<span class='text-danger'>Failed</span>",
                    ];
                }
            }

            session()->flash('purchase_result', $purchase_result);
            $this->dispatch('bulk_purchase_complete');

            $this->selected_numbers_info = [];
            $this->selected_numbers = [];
            $this->qty = 1;

            $this->getNumbers();
        } catch (\Exception $e) {
            $this->dispatch('error', ['message' => 'Failed to purchase number: ' . $e->getMessage()]);
        }
    }

    public function fetchPurchasedNumbers()
    {
        $twilio = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));

        try {
            // Fetch purchased numbers
            $incomingNumbers = $twilio->incomingPhoneNumbers->read();

            // Convert each number to a simple array
            $numbers_array = [];

            foreach ($incomingNumbers as $number) {
                $reflectedObject = new \ReflectionObject($number->capabilities);
                $props = $reflectedObject->getProperties(\ReflectionProperty::IS_PROTECTED);

                $caps = [];
                foreach ($props as $prop) {
                    $prop->setAccessible(true);
                    $caps[$prop->getName()] = $prop->getValue($number->capabilities);
                }

                // Create a simple array for each number
                $numbers_array[] = [
                    'friendlyName' => $number->friendlyName,
                    'phoneNumber' => $number->phoneNumber,
                    'capabilities' => $caps,
                ];
            }

            $this->purchasedNumbers = $numbers_array;

            dd($incomingNumbers);
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to fetch purchased numbers: ' . $e->getMessage());
        }
    }

    public function fetchPurchasedNumberCaps($number)
    {
        $twilio = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));
        try {
            $incomingNumbers = $twilio->incomingPhoneNumbers->read(["phoneNumber" => $number]);
            foreach ($incomingNumbers as $number) {
                $reflectedObject = new \ReflectionObject($number->capabilities);
                $props = $reflectedObject->getProperties(\ReflectionProperty::IS_PROTECTED);

                $caps = [];
                foreach ($props as $prop) {
                    $prop->setAccessible(true);
                    $caps[$prop->getName()] = $prop->getValue($number->capabilities);
                }
            }
            return $caps;
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to fetch purchased numbers: ' . $e->getMessage());
        }
    }

    public function render()
    {
        $numbers = collect($this->all_numbers)->filter(function ($item) {
            return false !== stripos($item['phoneNumber'], $this->searchTerm);
        })->paginate($this->sortingValue);
        $purchasedNumbers = collect($this->purchasedNumbers)->paginate($this->sortingValue);

        return view('livewire.app.settings.get-number-component', ['numbers' => $numbers, 'purchasedNumbers' => $purchasedNumbers])->layout('livewire.app.layouts.base');
    }
}
