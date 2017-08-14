<?php
namespace GB\ExportCsv\Facades;
use Illuminate\Support\Facades\Facade;
class ExportCsv extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'export';
    }
}