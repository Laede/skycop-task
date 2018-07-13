<?php

namespace App\FlightObject;

class Flight
{
    const STATUS_DELAY = 0;
    const STATUS_CANCEL = 1;

    /**
     * @var string
     */
    private $country;

    /**
     * @var int
     */
    private $status;

    /**
     * @var int
     */
    private $details;


    /**
     * Flight constructor
     *
     * @param $country
     * @param $status
     * @param $detail
     */

    public function __construct($country,$status,$details)
    {
        if(! in_array($status,[
            static::STATUS_DELAY,
            static::STATUS_CANCEL
        ],true)){
            throw new \UnexpectedValueException();
        }
        $this->country = $country;
        $this->status = $status;
        $this->details = $details;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @return int
     */
    public function getDetails(): int
    {
        return $this->details;
    }
}