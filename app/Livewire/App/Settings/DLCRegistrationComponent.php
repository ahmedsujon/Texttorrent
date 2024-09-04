<?php

namespace App\Livewire\App\Settings;

use App\Models\User;
use Livewire\Component;

class DLCRegistrationComponent extends Component
{
    public $company_name, $company_phone, $company_website, $industry, $organization_type, $country_of_registration,
        $tax_number, $share_legal_doc, $city, $street_address, $state, $postal_code;

    public $campaign_name, $campaign_type, $campaign_description, $sample_message_one, $sample_message_two, $opt_in,
        $opt_out, $direct_lending, $embedded_link, $embedded_phone, $affiliate_marketing, $age_gated_content,
        $additional_recipients, $terms_aggre;

    public function mount()
    {
        $user = User::find(user()->id);
        // Brand Registration
        $this->company_name = $user->company_name;
        $this->company_phone = $user->company_phone;
        $this->company_website = $user->company_website;
        $this->industry = $user->industry;
        $this->organization_type = $user->organization_type;
        $this->country_of_registration = $user->country_of_registration;
        $this->tax_number = $user->tax_number;
        $this->share_legal_doc = $user->share_legal_doc;
        $this->city = $user->city;
        $this->street_address = $user->street_address;
        $this->state = $user->state;
        $this->postal_code = $user->postal_code;
        // Campaign Registration
        $this->campaign_name = $user->campaign_name;
        $this->campaign_type = $user->campaign_type;
        $this->campaign_description = $user->campaign_description;
        $this->sample_message_one = $user->sample_message_one;
        $this->sample_message_two = $user->sample_message_two;
        $this->opt_in = $user->opt_in;
        $this->opt_out = $user->opt_out;
        $this->direct_lending = $user->direct_lending;
        $this->embedded_link = $user->embedded_link;
        $this->embedded_phone = $user->embedded_phone;
        $this->affiliate_marketing = $user->affiliate_marketing;
        $this->age_gated_content = $user->age_gated_content;
        $this->additional_recipients = $user->additional_recipients;
        $this->terms_aggre = $user->terms_aggre;
    }

    public function saveBrandData()
    {
        $this->validate([
            'company_name' => 'required',
            'company_phone' => 'required',
            'company_website' => 'required',
            'industry' => 'required',
            'organization_type' => 'required',
            'country_of_registration' => 'required',
            'tax_number' => 'required',
            'share_legal_doc' => 'required',
            'city' => 'required',
            'street_address' => 'required',
            'state' => 'required',
            'postal_code' => 'required',
        ]);

        $data = User::find(user()->id);
        $data->company_name = $this->company_name;
        $data->company_phone = $this->company_phone;
        $data->company_website = $this->company_website;
        $data->industry = $this->industry;
        $data->organization_type = $this->organization_type;
        $data->country_of_registration = $this->country_of_registration;
        $data->tax_number = $this->tax_number;
        $data->share_legal_doc = $this->share_legal_doc;
        $data->city = $this->city;
        $data->street_address = $this->street_address;
        $data->state = $this->state;
        $data->postal_code = $this->postal_code;
        $data->save();
        $this->mount();
        $this->dispatch('success', ['message' => 'Campaign Registration updated successfully']);
    }

    public function saveCampaignData()
    {
        $this->validate([
            'campaign_name' => 'required',
        ]);

        $data = User::find(user()->id);
        $data->campaign_name = $this->campaign_name;
        $data->campaign_type = $this->campaign_type;
        $data->campaign_description = $this->campaign_description;
        $data->sample_message_one = $this->sample_message_one;
        $data->sample_message_two = $this->sample_message_two;
        $data->opt_in = $this->opt_in;
        $data->opt_out = $this->opt_out;
        $data->direct_lending = $this->direct_lending;
        $data->embedded_link = $this->embedded_link;
        $data->embedded_phone = $this->embedded_phone;
        $data->affiliate_marketing = $this->affiliate_marketing;
        $data->age_gated_content = $this->age_gated_content;
        $data->additional_recipients = $this->additional_recipients;
        $data->terms_aggre = $this->terms_aggre;
        $data->save();
        $this->mount();
        $this->dispatch('success', ['message' => 'Brand Registration updated successfully']);
    }

    public function render()
    {
        return view('livewire.app.settings.d-l-c-registration-component')->layout('livewire.app.layouts.base');
    }
}
