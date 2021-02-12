<?php
namespace Modules\User\Concerns;

use Carbon\Carbon;

trait AvailabityTrait
{
    
    public function checkDateNotInOff($date)
    {
        if($this->have_off = 0) return true;
        $date = static::parseDateCarbon($date);
        if (is_array($this->offs) && $this->offs["start"] && $this->offs["end"]) {
            return !$date->between( Carbon::parse($this->offs["start"]), Carbon::parse($this->offs["end"]));
        }
        return true;
    }

    public  static function checkIfDateReserivation($date){
        return true;
    }

    public function checkIfDataAvaibale($date, $resevation=false){

        $date = static::parseDateCarbon($date);
        $validation[] = $date->isFuture();
        $validation[] = $this->checkDateNotInOff($date);
        if($resevation)  $validation[] = static::checkIfDateReserivation($date);
        return array_product($validation);
    }

    public static function parseDateCarbon($date){
        if (!($date instanceof Carbon)) {
            $date = Carbon::parse($date);
        }
        return $date;
    }
}
