<?php

namespace App\Repository;

use App\FlightObject\Flight;

class CsvFlightRepository implements FlightRepositoryInterface
{
    public function getAll($source)
    {
        $file  = file($source);
        $data = [];
        foreach ($file as $line){
            list($country,$reason,$details) = str_getcsv($line);
            $data[] = new Flight($country,$this->convertStatus($reason),$details);
        }
        return $data;
    }

    public function convertStatus($reason)
    {
        if(strtolower($reason) == 'cancel'){
            return Flight::STATUS_CANCEL;
        }
        return Flight::STATUS_DELAY;
    }
}