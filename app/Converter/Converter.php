<?php

namespace App\Converter;

use App\Converter\ConverterFormatInterface;

use App\Converter\ConverterFormat\JSONFormat;
use App\Converter\ConverterFormat\XMLFormat;
use App\Converter\ConverterFormat\CSVFormat;

use App\Models\CountryList;
    
class Converter {

    protected $formats = [];

    public function __construct() {
        $availableFormats = [
            new JSONFormat(),
            new XMLFormat(),
            new CSVFormat()
        ];
            
        foreach ($availableFormats as $format) {
            $this->formats[ $format->getFileExtenstion() ] = $format;
        }
    }

    public function load($file, $format) {
        if (empty($this->formats[$format]))
            throw new \Exception("Unsupported input format: $format");

        return $this->formats[$format]->deserialize($file);
    }

    public function save(CountryList $countryList, $format) {
        if (empty($this->formats[$format]))
            throw new \Exception("Unsupported output format: $format");

        return $this->formats[$format]->serialize($countryList);
    }

    public function getAvailableFormats() {
        return array_map(
            function($f) {
                return $f->getFileExtenstion();
            },
            array_values($this->formats)
        );
    }

    public function getMIMETypeForExtension(string $format) {
        if (empty($this->formats[$format]))
            throw new \Exception("Unwnown MIME format for this extension: $format");

        return $this->formats[$format]->getMIMEType();
    }

}
