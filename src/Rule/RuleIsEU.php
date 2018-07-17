<?php

namespace App\Rule;

use App\FlightObject\Flight;

class RuleIsEU implements RuleInterface
{
    public function doesPass(Flight $flight): bool
    {
        if($flight->getCountry() !== 'RU')
        {
            return true;
        }
        return false;
    }

}