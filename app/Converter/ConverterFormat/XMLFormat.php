<?php

namespace App\Converter\ConverterFormat;

use App\Converter\ConverterFormatInterface;
use App\Models\Country;
use App\Models\CountryList;

class XMLFormat implements ConverterFormatInterface
{
    public function getFileExtenstion() :string
    {
        return "xml";
    }

    public function getMIMEType() :string
    {
        return "text/xml";
    }


    public function deserialize(string $file) : CountryList
    {
        $xml = simplexml_load_file($file);

        $countries = [];

        foreach ($xml as $row) {
            $countries[] = new Country($row->country->__toString(), $row->capital->__toString());
        }

        return new CountryList($countries);
    }

    public function serialize(CountryList $countryList) : string
    {
        $xml = new \SimpleXMLElement('<root/>');

        foreach ($countryList->serialize() as $country) {
            $element = $xml->addChild("element");
            $element->addChild("country", $country["country"]);
            $element->addChild("capital", $country["capital"]);
        }
        return $xml->asXML();
    }
}
