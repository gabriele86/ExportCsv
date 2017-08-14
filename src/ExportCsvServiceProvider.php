<?php
namespace GB\ExportCsv;

use Illuminate\Support\ServiceProvider;
use GB\ExportCsv\Export;

class ExportCsvServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/csv.php' => config_path('csv.php')
        ], 'config');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
        \App::bind('export' , function() {

            return new Export();

        });
    }
}
