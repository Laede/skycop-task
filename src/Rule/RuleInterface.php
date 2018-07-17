<?php

namespace App\Rule;

use App\FlightObject\Flight;

interface RuleInterface
{
    /**
     * @param $flight
     * @return mixed
     */
    public function doesPass(Flight $flight): bool;

}