<?php

namespace App\Livewire\App\Settings;

use Livewire\Component;
use Livewire\WithPagination;
use Twilio\Rest\Client;

class GetNumberComponent extends Component
{
    use WithPagination;
    public $country = 'US', $areaCode, $qty = 1, $selectedNumber, $all_numbers = [], $numberType = 'local', $purchasedNumbers = [], $sortingValue = 10, $numbers_array = [];

    public function mount()
    {
        $this->getNumbers();
        // $this->fetchPurchasedNumbers();
        
    }

    public function areaCodeSearch()
    {
        $this->validate([
            'areaCode' => 'required'
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
        if ($this->qty > 0) {
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
                'capabilities' => $caps,
            ];

            $this->numbers_array[] = $number->phoneNumber;
        }

        $this->all_numbers = $numbers_array;
    }

    public $numberToPurchase;
    public function purchaseNumberConfirmation($number)
    {
        $this->numberToPurchase = $number;
        $this->dispatch('showPurchaseModal');
    }

    public function purchaseNumber()
    {
        $twilio = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));

        try {
            $twilio->incomingPhoneNumbers->create([
                'phoneNumber' => $this->numberToPurchase,
            ]);

            $this->getNumbers();
            $this->dispatch('purchase_success');
        } catch (\Exception $e) {
            $this->dispatch('error', ['message' => 'Failed to purchase number: ' . $e->getMessage()]);
        }
    }

    public $selected_numbers;
    public function bulkPurchaseConfirmation()
    {
        $selected_numbers = array_slice($this->numbers_array, 0, $this->qty);
        $this->selected_numbers = $selected_numbers;

        $this->dispatch('showBulkPurchaseModal');
    }

    public function bulkPurchaseNumber()
    {
        $twilio = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));

        try {
            foreach ($this->selected_numbers as $key => $number) {
                $twilio->incomingPhoneNumbers->create([
                    'phoneNumber' => $number,
                ]);
            }

            $this->getNumbers();
            $this->dispatch('purchase_success');
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

            dd($this->purchasedNumbers);
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to fetch purchased numbers: ' . $e->getMessage());
        }
    }

    public function render()
    {
        $numbers = collect($this->all_numbers)->paginate($this->sortingValue);
        $purchasedNumbers = collect($this->purchasedNumbers)->paginate($this->sortingValue);

        return view('livewire.app.settings.get-number-component', ['numbers' => $numbers, 'purchasedNumbers' => $purchasedNumbers])->layout('livewire.app.layouts.base');
    }
}
