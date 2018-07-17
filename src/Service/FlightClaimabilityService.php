<?php

namespace App\Service;

use App\FlightObject\Flight;
use App\Rule\RuleInterface;

class FlightClaimabilityService
{
    /**
     * @var RuleInterface[]
     */
    private $rules;

    public function __construct($rules)
    {
        $this->rules = $rules;
    }

    /**
     * @param Flight $flight
     * @return bool
     */
    public function predict(Flight $flight): bool
    {
        foreach ($this->rules as $rule)
        {
            if($rule->doesPass($flight)){
                return true;
            }
        }
        return false;
    }
}