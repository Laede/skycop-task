<?php

namespace App\Service;

use App\FlightObject\Flight;

class FlightClaimabilityService
{
    /**
     * @param Flight $flight
     * @return bool
     */
    public function predict(Flight $flight): bool
    {
        if(!$this->isEuropeanUnion($flight)){
            return false;
        }

        if($flight->getStatus() === Flight::STATUS_CANCEL && $flight->getDetails() >= 14){
            return false;
        }

        if($flight->getStatus() === Flight::STATUS_DELAY && $flight->getDetails() < 3){
            return false;
        }
        return true;
    }

    /**
     * @param Flight $flight
     * @return bool
     */
    protected function isEuropeanUnion(Flight $flight)
    {
        return $flight->getCountry() != 'RU';
    }

}