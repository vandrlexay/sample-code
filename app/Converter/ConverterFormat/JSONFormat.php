<?php

namespace App\Converter\ConverterFormat;
use App\Converter\ConverterFormatInterface;
use App\Models\Country;
use App\Models\CountryList;
    
class JSONFormat implements ConverterFormatInterface {

    public function getFileExtenstion() :string {
        return "json";
    }

    public function getMIMEType() :string {
        return "application/json";
    }


    public function deserialize($file) : CountryList {
        $rawArray = json_decode(file_get_contents($file), true);

        $countries = [];

        foreach ($rawArray as $row) {
            $countries[] = new Country($row["country"], $row["capital"]);
        }

        return new CountryList($countries);
    }

    function serialize(CountryList $countryList) : string {
        return json_encode($countryList->serialize());
    }
}
