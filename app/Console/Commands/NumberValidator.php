<?php

namespace App\Console\Commands;

// use App\Models\NumberValidation;
use App\Jobs\NumberValidation;
use App\Models\NumberValidation as ModelsNumberValidation;
use App\Models\NumberValidationItems;
use Illuminate\Console\Command;

class NumberValidator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process:number-validation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Number Validation Process';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $valItems = NumberValidationItems::where('status', '!=', 'Completed')->get();

        foreach ($valItems as $valItem) {
            NumberValidation::dispatch($valItem->id);
        }

        $this->info('Number validation processed - ' . $valItems->count() . ' ');
    }
}
