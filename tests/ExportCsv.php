<?php

 namespace GB\ExportCsv\tests;
 use GB\ExportCsv\Export;

 class ExportCsv extends \TestCase {


    protected $fs;
    public function setUp()
    {
        parent::setUp();
        $this->fs = vfsStream::setup('files');
    }
    public function testCreateCsv()
    {
        $data = array(
            'Nome' => 'Gabriele',
            'Cognome' => 'Gabriele',
        );
        $writer = new Export();
        $writer->exportCsv(vfsStream::url('files/file.csv'), $data);
        //$writer->close();
        $this->assertFileExists(vfsStream::url('files/file.csv'));
    }

 }