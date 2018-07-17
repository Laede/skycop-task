<?php

namespace App\Rule;

use App\FlightObject\Flight;

class RuleIfCanceled extends RuleIsEU
{
    /**
     * @param Flight $flight
     * @return bool
     */
    public function doesPass(Flight $flight): bool
    {
        if(parent::doesPass($flight))
        {
            if($flight->getStatus() === Flight::STATUS_CANCEL && $flight->getDetails() <= 14){
                return true;
            }
        }
        return false;
    }
}