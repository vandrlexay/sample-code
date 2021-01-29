<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country
{
    protected $visible = ['country', 'capital'];
    
    protected $country;
    protected $capital;
    
    public function __construct($country, $capital)
    {
        $this->country = $country;
        $this->capital = $capital;
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function getCapital()
    {
        return $this->capital;
    }
}
