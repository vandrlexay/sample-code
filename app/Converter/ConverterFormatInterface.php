<?php

namespace App\Converter;

use App\Models\CountryList;

interface ConverterFormatInterface {
    public function getFileExtenstion() : string;
    public function serialize(CountryList $countryList) : string;
    public function deserialize(string $file) : CountryList;
}
