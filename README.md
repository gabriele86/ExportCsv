# Export to CSV

Laravel 5 package to CSV files.

## Instalation

First run composer command

<code>composer require wilgucki/csv</code>

Next add service provider to <code>config/app.php</code> file

    'providers' => [
        //... 
        GB\ExportCsv\ExportCsvServiceProvider::class,
    ]

Add facades to <code>config/app.php</code> file

    'aliases' => [
        //...
        'export_csv' =>  GB\ExportCsv\Facades\ExportCsv::class,
    ]

Last step is to publish package config

<code>php artisan vendor:publish --provider="GB\ExportCsv\ExportCsvServiceProvider"</code>

## Usage

### Config file

Package config can be found in csv.php file under config directory (after you published it).
Config file contains default values for delimiter, enclosure and escape parameters.

## Example

<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;



class CsvController extends BaseController
{
  

    function createCsv(){
                $data =  array(
  '0' => array(
    'fruit one' => 'orange',
    'fruit two' => 'lime',
  ),
  '1' => array(
    'fruit one' => 'honeydew',
    'fruit two' => 'cantalope',
  ),
  '2' => array(
    'fruit one' => 'raspberry',
    'fruit two' => 'strawberry',
  ),
  '3' => array(
    'fruit one' => 'granny smith',
    'fruit two' => 'fuji',
  )

);

        \export_csv::exportCsv($data);
        
    }
}
