<?php

namespace App\Tests\FlightObject;


use App\FlightObject\Flight;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class FlightTest extends TestCase
{

    public function getSampleFlight()
    {
       return $flight = new Flight('LV',Flight::STATUS_CANCEL,10);
    }

    public function test_is_flight_object_created()
    {
        try
        {
            $flight = new Flight('RU','Hello',10);
            $this->assertEquals(true,false);
        } catch (\UnexpectedValueException $exception){
            $this->assertEquals(true,true);
        }
    }

    public function test_flight_getter_country()
    {
        $country = $this->getSampleFlight()->getCountry();
        $this->assertEquals('LV',$country);
    }

    public function test_flight_getter_status()
    {
        $status = $this->getSampleFlight()->getStatus();
        $this->assertEquals(1,$status);
    }

    public function test_flight_getter_details()
    {
        $details = $this->getSampleFlight()->getDetails();
        $this->assertEquals(10,$details);
    }

}