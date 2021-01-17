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

    /**
     * Parse given file in specified format and return it in form of
     * CountryList
     */
    public function load(string $file, string $format) : CountryList {
        if (empty($this->formats[$format]))
            throw new \Exception("Unsupported input format: $format");

        return $this->formats[$format]->deserialize($file);
    }

    /**
     * Convert given CountryList to given format
     */
    public function save(CountryList $countryList, string $format) : string {
        if (empty($this->formats[$format]))
            throw new \Exception("Unsupported output format: $format");

        return $this->formats[$format]->serialize($countryList);
    }

    /**
     * List available file extensions to convert from/to
     */
    public function getAvailableFormats() : array {
        return array_map(
            function($f) {
                return $f->getFileExtenstion();
            },
            array_values($this->formats)
        );
    }

    /**
     * Get MIME type for given file extension
     */
    public function getMIMETypeForExtension(string $format) : string {
        if (empty($this->formats[$format]))
            throw new \Exception("Unwnown MIME format for this extension: $format");

        return $this->formats[$format]->getMIMEType();
    }

}
