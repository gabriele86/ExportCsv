<?php
namespace GB\ExportCsv;
use Illuminate\Support\Facades\Facade;
class ExportCsv extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'export_csv';
    }
}