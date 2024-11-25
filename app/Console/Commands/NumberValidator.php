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

        $delay = 0; // Initial delay for the first job
        foreach ($valItems as $valItem) {
            NumberValidation::dispatch($valItem->id);

            sleep(5);
        }

        $this->info('Number validation processed - ' . $valItems->count() . ' ');
    }
}
