<?php

namespace App\Converter\ConverterFormat;
use App\Converter\ConverterFormatInterface;
use App\Models\Country;
use App\Models\CountryList;

    
class XMLFormat implements ConverterFormatInterface {
    public function getFileExtenstion() :string {
        return "xml";
    }

    public function deserialize($file) : CountryList {

        $xml = simplexml_load_file($file);

        $countries = [];

        foreach ($xml as $row) {
            $countries[] = new Country($row->country->__toString(), $row->capital->__toString());
        }

        return new CountryList($countries);
    }

    function serialize(CountryList $countryList) : string {
    }
}
