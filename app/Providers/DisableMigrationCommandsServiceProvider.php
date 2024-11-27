<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Console\Migrations\FreshCommand;

class DisableMigrationCommandsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        if (env('APP_ENV') == 'production') {
            $this->app->extend(FreshCommand::class, function () {
                return new class extends FreshCommand {
                    public function handle()
                    {
                        $this->line("\e[31mThis command is disabled. Site is in Production.\e[0m");
                        return 0;
                    }
                };
            });
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
