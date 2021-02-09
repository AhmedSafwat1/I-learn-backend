<?php

namespace Modules\User\Transformers\Api;

use  Illuminate\Http\Resources\Json\JsonResource;
use Modules\Area\Transformers\Api\CountryResource;
use Modules\Social\Repositories\Api\SocialRepository;
use Modules\Category\Transformers\Api\CategoryResource;

class ProfileWorkingResource extends JsonResource
{
    
    public function toArray($request)
    {
       
       
        return [
           'id'            => $this->id,
           'description'   => $this->description ,
           "lesson_type"   => $this->lesson_type,
           "online_price"  => $this->online_price, 
           "house_price"   => $this->house_price,  
           "work"          =>   $this->handleTheWorking()
           
       ];
    }

    public function handleTheWorking(){
        $date = now();
        $works = [];
        foreach (range(0,6) as $iterarte ) {
            $day = strtolower($date->format("l"));
            if(!$this->working) continue;
            if(isset($this->working[$day])){
                $theDay = $this->working[$day];
                $object["day"]  = $day;
                $object["date"] = $date->format("d-m-Y"); 
                $object["times"]= [];
                if(isset($theDay["times"]) && is_array($theDay["times"] )){
                    foreach ($theDay["times"] as  $time) {
                        $timeDate = $date->setTimeFromTimeString($time);
                        $object["times"][] = [
                            "time"          => $time ,
                            "date"          => $timeDate->format("d-m-Y h:i a")  ,
                            "availabel"     => $timeDate->isFuture()
                        ];
                    }
                }
                $works[] = $object;

            }
            $date->addDay();
        }
       return $works;
    }
    
   
}
