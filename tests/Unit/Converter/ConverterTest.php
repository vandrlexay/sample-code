<?php

namespace Tests\Unit\Converter;

use PHPUnit\Framework\TestCase;

use App\Converter\Converter;
use App\Models\CountryList;

class ConverterTest extends TestCase
{

    protected $converter = null;
    protected $fixturesDir = __DIR__ . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . ".." . DIRECTORY_SEPARATOR . "fixtures";

    public function setUp() : void
    { 
        $this->converter = new Converter();
    }

    public function test_load() {

        foreach ($this->converter->getAvailableFormats() as $format) {
            $file = $this->fixturesDir . DIRECTORY_SEPARATOR . "countries." . $format;
            $retVal = $this->converter->load($file, $format);

            $formatIsOK = (
                ($retVal instanceof CountryList) and
                (count($retVal->serialize()))
            );

            $this->assertTrue($formatIsOK, "Testing format: " . $format);
        }
    }
    
    public function test_save() {

        $file = $this->fixturesDir . DIRECTORY_SEPARATOR . "countries.json";
        $loaded = $this->converter->load($file, "json");

        foreach ($this->converter->getAvailableFormats() as $format) {

            $fixtureData = file_get_contents($this->fixturesDir . DIRECTORY_SEPARATOR . "countries." . $format);

            $this->assertTrue(
                $fixtureData === $this->converter->save($loaded, $format),
                "Testing format: " . $format
            );
        }

        $this->assertTrue(true);
    }

}
