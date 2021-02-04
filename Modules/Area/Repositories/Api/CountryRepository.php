<?php

namespace Modules\Area\Repositories\Api;

use Modules\Area\Entities\Country;
use Hash;
use DB;

class CountryRepository
{

    function __construct(Country $country)
    {
        $this->country   = $country;
    }

    public function getAllActive($order = 'id', $sort = 'desc')
    {
        $cities = $this->country->active()->orderBy($order, $sort)->get();
        return $cities;
    }

    public function findById($id)
    {
        $country = $this->country->active()->where('id',$id)->first();
        return $country;
    }
}
