<?php

namespace App\Converter\ConverterFormat;
use App\Converter\ConverterFormatInterface;
use App\Models\Country;
use App\Models\CountryList;

    
class CSVFormat implements ConverterFormatInterface {
    public function getFileExtenstion() :string {
        return "csv";
    }

    public function getMIMEType() :string {
        return "text/csv";
    }


    public function deserialize(string $file) : CountryList {

        $countries = [];
        $handle = fopen($file, 'r');

        $row = fgetcsv($handle);
        
        while ( ($row = fgetcsv($handle) ) !== FALSE ) {
            $countries[] = new Country($row[0], $row[1]);
        }
        
        return new CountryList($countries);
    }

    
    function serialize(CountryList $countryList) : string {
        $serialized = "";
        foreach ($countryList->serialize() as $row) {
            $serialized .= implode("," , array_map(function ($e) { return '"' . $e . '"'; }, array_values($row))) . "\n";
        }
        return $serialized;
    }
}
