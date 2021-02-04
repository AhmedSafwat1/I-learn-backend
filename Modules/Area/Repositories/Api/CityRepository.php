<?php

namespace Modules\Area\Repositories\Api;

use Modules\Area\Entities\City;
use Hash;
use DB;

class CityRepository
{

    function __construct(City $city)
    {
        $this->city   = $city;
    }

    public function getAllActive(&$request ,$order = 'id', $sort = 'desc')
    {
        $cities = $this->city->active()
        ->when($request->country_id, function($query) use(&$request){
            $query->where("country_id", $request->country_id);
        })
        ->orderBy($order, $sort)->get();
        return $cities;
    }

    public function findById($id)
    {
        $city = $this->city->active()->where('id',$id)->first();
        return $city;
    }
}
