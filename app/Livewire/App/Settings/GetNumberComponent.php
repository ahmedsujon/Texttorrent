<?php

namespace App\Livewire\App\Settings;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Number;
use Livewire\Component;
use Twilio\Rest\Client;
use Livewire\WithPagination;
use Illuminate\Support\Facades\DB;

class GetNumberComponent extends Component
{
    use WithPagination;
    public $country = 'US', $areaCode, $qty = 1, $searchTerm = '', $selectedNumber, $all_numbers = [], $numberType = 'local', $purchasedNumbers = [], $sortingValue = 10, $numbers_array = [], $numbers_info_array = [], $TWILIO_SID, $TWILIO_AUTH_TOKEN;

    public function mount()
    {
        if (user()->type == 'sub') {
            $au_user = DB::table('users')->select('id', 'credits')->where('id', user()->parent_id)->first();
            $user_id = $au_user->id;
        } else {
            $user_id = user()->id;
        }

        $twilioCredentials = DB::table('apis')
            ->where('user_id', $user_id)
            ->where('gateway', 'Twilio')
            ->first();

        $this->TWILIO_SID = $twilioCredentials->account_sid;
        $this->TWILIO_AUTH_TOKEN = $twilioCredentials->auth_token;

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
        $twilio = new Client($this->TWILIO_SID, $this->TWILIO_AUTH_TOKEN);

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

            // $this->numbers_array[] = $number->phoneNumber;
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
        if (getActiveSubscription()['status'] == 'Active') {
            $credit_needed = 300;
            if (user()->type == 'sub') {
                $au_user = DB::table('users')->select('id', 'credits')->where('id', user()->parent_id)->first();
                $credit_has = $au_user->credits;
                $user_id = $au_user->id;
            } else {
                $credit_has = user()->credits;
                $user_id = user()->id;
            }

            if ($credit_has >= $credit_needed) {
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
            } else {
                $this->dispatch('error', ['message' => 'You do not have enough credits to purchase this number.']);
            }
        } else {
            $this->dispatch('error', ['message' => 'No active subscription. Please upgrade your subscription.']);
        }

    }

    public function purchaseNumber()
    {
        $twilio = new Client($this->TWILIO_SID, $this->TWILIO_AUTH_TOKEN);

        try {
            $twilio->incomingPhoneNumbers->create([
                'phoneNumber' => $this->numberToPurchase,
            ]);

            $credit_needed = 300;
            if (user()->type == 'sub') {
                $au_user = DB::table('users')->select('id', 'credits')->where('id', user()->parent_id)->first();
                $user_id = $au_user->id;
            } else {
                $user_id = user()->id;
            }

            // credit deduction
            $user = User::find($user_id);
            $user->credits -= $credit_needed;
            $user->save();

            // log
            creditLog('Number purchase: '. $this->numberToPurchase, $credit_needed);

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
            $number->purchased_by = user()->id;
            $number->friendly_name = $data['friendly_name'];
            $number->number = $data['number'];
            $number->region = $data['region'];
            $number->country = $data['country'];
            $number->latitude = $data['latitude'];
            $number->longitude = $data['longitude'];
            $number->postal_code = $data['postal_code'];
            $number->capabilities = $this->fetchPurchasedNumberCaps($data['number']);
            $number->twilio_number_sid = $this->fetchPurchasedNumberSID($data['number']);
            $number->purchased_at = Carbon::parse(now());
            $number->type = $this->numberType;
            $number->webhook = $this->setWebhook($data['number']);
            $number->next_renew_date = Carbon::parse(now())->addMonth(1);
            $number->save();

            $serviceSID = $this->setServices($number->twilio_number_sid);

            if ($serviceSID) {
                $number->twilio_service_sid = $serviceSID;
                $number->save();
            }

            return true;
        } else {
            return false;
        }
    }

    public function setServices($number_sid)
    {
        $client = new Client($this->TWILIO_SID, $this->TWILIO_AUTH_TOKEN);
        $serviceName = "TextTorrent Messaging Service";
        $phoneNumberSid = $number_sid;

        // Check if the phone number is associated with any service
        $services = $client->messaging->v1->services->read();
        $isNumberInAnotherService = false;
        $serviceSid = null;

        foreach ($services as $service) {
            $phoneNumbers = $client->messaging->v1->services($service->sid)->phoneNumbers->read();

            foreach ($phoneNumbers as $number) {
                if ($number->sid === $phoneNumberSid) {
                    $isNumberInAnotherService = true;
                    $serviceSid = $service->sid;
                    break 2;
                }
            }
        }

        if (!$isNumberInAnotherService) {
            // Check if "TextTorrent Messaging Service" exists or create a new one
            $targetService = null;
            foreach ($services as $service) {
                if ($service->friendlyName === $serviceName) {
                    $targetService = $service;
                    $serviceSid = $service->sid;
                    break;
                }
            }

            // If the "TextTorrent Messaging Service" does not exist, create it
            if (!$targetService) {
                $targetService = $client->messaging->v1->services->create($serviceName);
                $serviceSid = $targetService->sid;
            }

            // Add the phone number to the "TextTorrent Messaging Service"
            $client->messaging->v1->services($serviceSid)
                ->phoneNumbers
                ->create($phoneNumberSid);
        }

        return $serviceSid;
    }

    public function setWebhook($number)
    {
        $twilio = new Client($this->TWILIO_SID, $this->TWILIO_AUTH_TOKEN);
        $twilio->incomingPhoneNumbers
            ->read(['phoneNumber' => $number])[0]
            ->update([
                "smsUrl" => 'https://texttorrent.com/api/v1/twilio/incoming-message',
                "voiceUrl" => 'https://texttorrent.com/api/v1/twilio/incoming-message',
            ]);

        return 1;
    }

    public $selected_numbers, $selected_numbers_info;
    public function bulkPurchaseConfirmation()
    {
        if (getActiveSubscription()['status'] == 'Active') {
            $credit_needed = 300 * $this->qty;
            if (user()->type == 'sub') {
                $au_user = DB::table('users')->select('id', 'credits')->where('id', user()->parent_id)->first();
                $credit_has = $au_user->credits;
                $user_id = $au_user->id;
            } else {
                $credit_has = user()->credits;
                $user_id = user()->id;
            }

            if ($credit_has >= $credit_needed) {
                $selected_numbers = array_slice($this->numbers_array, 0, $this->qty);
                $this->selected_numbers = $selected_numbers;

                $selected_numbers_info = array_slice($this->numbers_info_array, 0, $this->qty);
                $this->selected_numbers_info = $selected_numbers_info;

                $this->dispatch('showBulkPurchaseModal');
            } else {
                $this->dispatch('error', ['message' => 'You do not have enough credits to purchase numbers.']);
            }
        } else {
            $this->dispatch('error', ['message' => 'No active subscription. Please upgrade your subscription.']);
        }
    }

    public function bulkPurchaseNumber()
    {
        $twilio = new Client($this->TWILIO_SID, $this->TWILIO_AUTH_TOKEN);

        try {
            $purchase_result = [];

            foreach ($this->selected_numbers_info as $key => $number) {
                $twilio->incomingPhoneNumbers->create([
                    'phoneNumber' => $number['number'],
                ]);

                $credit_needed = 300;
                if (user()->type == 'sub') {
                    $au_user = DB::table('users')->select('id', 'credits')->where('id', user()->parent_id)->first();
                    $user_id = $au_user->id;
                } else {
                    $user_id = user()->id;
                }

                // credit deduction
                $user = User::find($user_id);
                $user->credits -= $credit_needed;
                $user->save();

                // log
                creditLog('Number purchase: '. $number, $credit_needed);

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
        $twilio = new Client($this->TWILIO_SID, $this->TWILIO_AUTH_TOKEN);

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
        $twilio = new Client($this->TWILIO_SID, $this->TWILIO_AUTH_TOKEN);
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

    public function fetchPurchasedNumberSID($number)
    {
        $twilio = new Client($this->TWILIO_SID, $this->TWILIO_AUTH_TOKEN);
        try {
            $incomingNumbers = $twilio->incomingPhoneNumbers->read(["phoneNumber" => $number]);
            // Check if the number exists and return its SID
            if (!empty($incomingNumbers)) {
                return $incomingNumbers[0]->sid;
            } else {
                return "";
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Failed to fetch purchased numbers: ' . $e->getMessage());
        }
    }

    public function render()
    {
        $numbers = collect($this->all_numbers)->filter(function ($item) {
            return false !== stripos($item['phoneNumber'], $this->searchTerm);
        })->paginate($this->sortingValue);

        $this->numbers_array = $numbers->pluck('phoneNumber')->toArray();

        return view('livewire.app.settings.get-number-component', ['numbers' => $numbers])->layout('livewire.app.layouts.base');
    }
}
