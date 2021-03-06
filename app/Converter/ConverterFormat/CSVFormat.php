<?php

namespace App\Converter\ConverterFormat;

use App\Converter\ConverterFormatInterface;
use App\Models\Country;
use App\Models\CountryList;

class CSVFormat implements ConverterFormatInterface
{
    public function getFileExtenstion() :string
    {
        return "csv";
    }

    public function getMIMEType() :string
    {
        return "text/csv";
    }


    public function deserialize(string $file) : CountryList
    {
        $countries = [];
        $handle = fopen($file, 'r');

        $row = fgetcsv($handle);
        
        while (($row = fgetcsv($handle)) !== false) {
            $countries[] = new Country($row[0], $row[1]);
        }
        
        return new CountryList($countries);
    }

    
    public function serialize(CountryList $countryList) : string
    {
        $serialized = "";

        $rawArray = array_merge([[
            "country" => "Country",
            "capital" => "Capital"
        ]], $countryList->serialize());

        foreach ($rawArray as $row) {
            $serialized .= implode(",", array_map(function ($e) {
                return '"' . $e . '"';
            }, array_values($row))) . "\n";
        }
        return $serialized;
    }
}
