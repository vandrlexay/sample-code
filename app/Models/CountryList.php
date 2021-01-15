<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Country;

class CountryList extends Model
{
    protected $visible = ["countries"];

    protected $countries;

    public function __construct($countries) {
        $this->countries = $countries;
    }
    
    public function countries()
    {
        return $this->hasMany(Country::class);
    }

    public function serialize() {
        return
            array_map(function($c) {
                return [
                    "country" => $c->getCountry(),
                    "capital" => $c->getCapital()
                ];
            },
                $this->countries
            );
    }
}
