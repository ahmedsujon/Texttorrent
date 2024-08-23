<?php

namespace App\Livewire\Admin\Settings;

use Livewire\Component;
use Illuminate\Support\Facades\Artisan;

class ConsoleComponent extends Component
{
    public $output;

    public function migrate()
    {
        Artisan::call('migrate');
        $output = Artisan::output();
        $this->output = $output;

        $this->dispatch('success', ['message'=>'Command Executed Successfully']);
    }

    public function migrateFreshSeed()
    {
        Artisan::call('migrate:fresh --seed');
        $output = Artisan::output();
        $this->output = $output;

        $this->dispatch('success', ['message'=>'Command Executed Successfully']);
    }

    public function dbSeed()
    {
        Artisan::call('db:seed');
        $output = Artisan::output();
        $this->output = $output;

        $this->dispatch('success', ['message'=>'Command Executed Successfully']);
    }

    public function optimizeClear()
    {
        Artisan::call('optimize:clear');
        $output = Artisan::output();
        $this->output = $output;

        $this->dispatch('success', ['message'=>'Command Executed Successfully']);
    }

    public function render()
    {
        return view('livewire.admin.settings.console-component')->layout('livewire.admin.layouts.base');
    }
}
