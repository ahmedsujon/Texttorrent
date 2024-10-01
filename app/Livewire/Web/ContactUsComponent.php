<?php

namespace App\Livewire\Web;

use App\Models\ContactMessage;
use Livewire\Component;

class ContactUsComponent extends Component
{
    public $first_name, $last_name, $email, $phone, $descriptions;

    public function storeData()
    {
        $this->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'descriptions' => 'required',
        ]);

        $data = new ContactMessage();
        $data->first_name = $this->first_name;
        $data->last_name = $this->last_name;
        $data->email = $this->email;
        $data->phone = $this->phone;
        $data->descriptions = $this->descriptions;

        $data->save();
        session()->flash('success', 'Thank you for your message! We will contact you soon!');
        $this->resetInputs();
    }


    public function resetInputs()
    {
        $this->first_name = null;
        $this->last_name = null;
        $this->email = null;
        $this->phone = null;
        $this->descriptions = null;
    }

    public function render()
    {
        return view('livewire.web.contact-us-component')->layout('livewire.web.layouts.base');
    }
}
