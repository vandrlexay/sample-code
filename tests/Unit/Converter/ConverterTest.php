<?php

namespace Tests\Unit\Converter;

use PHPUnit\Framework\TestCase;

use App\Converter\Converter;

class ConverterTest extends TestCase
{

    protected $converter = null;
    protected $fixturesDir = __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "fixtures";

    public function __construct() {
        $this->converter = new Converter();
    }

    public function test_load() {
        $this->assertTrue(false);

        // $converted = $converter->load(
        //      ,
        //     strtolower($file->getClientOriginalExtension())
        // );

    }
    
    public function test_save() {
        $this->assertTrue(false);
    }
    
    public function test_getAvailableFormats() {
        $this->assertTrue(false);
    }

    public function test_getMIMETypeForExtension() {
        $this->assertTrue(false);
    }
                      

}
