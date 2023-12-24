<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Jobs\ExtensionBookLoanJob;

class ExtensionBookLoanServiceProvider extends ServiceProvider
{
    use \Illuminate\Foundation\Bus\DispatchesJobs;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // Dispatch the job for all loans when the server starts
        $this->dispatch(new ExtensionBookLoanJob());
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
