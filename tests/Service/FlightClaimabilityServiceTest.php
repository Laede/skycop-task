<?php

namespace App\Tests\Service;


use App\FlightObject\Flight;
use App\Service\FlightClaimabilityService;
use Symfony\Bundle\FrameworkBundle\Tests\TestCase;

class FlightClaimabilityServiceTest extends TestCase
{
    /**
     * @var FlightClaimabilityService
     */
    protected $service;

    protected function setUp()
    {
        parent::setUp();

        $this->service = new FlightClaimabilityService();
    }

    public function dataProviderer()
    {
        return [
            [new Flight('LV',Flight::STATUS_CANCEL,20 ),false],
            [new Flight('RU',Flight::STATUS_CANCEL,10),false],
            [new Flight('LT',Flight::STATUS_DELAY,1 ),false],
            [new Flight('LT',Flight::STATUS_DELAY,3 ),true],
            [new Flight('LV',Flight::STATUS_DELAY,4 ),true],
            [new Flight('LT',Flight::STATUS_CANCEL,1 ),true]
        ];
    }

    /**
     * @dataProvider dataProviderer
     */
    public function test_service_prediction($flight, $isClaimable)
    {
        $prediction = $this->service->predict($flight);
        $this->assertEquals($isClaimable,$prediction);
    }
}