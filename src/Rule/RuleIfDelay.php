<?php

namespace App\Rule;

use App\FlightObject\Flight;

class RuleIfDelay extends RuleIsEU
{
    /**
     * @param Flight $flight
     * @return bool
     */
    public function doesPass(Flight $flight): bool
    {
        if(parent::doesPass($flight))
        {
            if($flight->getStatus() === Flight::STATUS_DELAY && $flight->getDetails() >= 3){
                return true;
            }
        }
        return false;
    }
}