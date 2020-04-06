<?php

namespace App\Domain\Distance\Model;

use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

/**
 * Class Base abstract class that sets some predefined functions and requirements for the actual unit classes that depend on this
 *
 * @ExclusionPolicy("all")
 */
abstract class Base
{
    /**
     * @var string $unit the name of the unit
     * @Expose
     */
    private $unit;

    /**
     * @var float $meterRatio The ratio with meters, used to calculate between meters and the unit
     */
    private $meterRatio;

    /**
     * @var float $distance the actual distance in the specified unit
     * @Expose
     */
    private $distance = 0;

    /**
     * Convert this unit to meters
     *
     * @return float
     */
    public function getMeters()
    {
        return $this->getDistance() * $this->getMeterRatio();
    }

    /**
     * @param float $ratio
     */
    public function setMeterRatio(float $ratio): void
    {
        $this->meterRatio = $ratio;
    }

    /**
     * @return float
     */
    public function getMeterRatio()
    {
        return $this->meterRatio;
    }

    /**
     * @return string
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * @return float
     */
    public function getDistance()
    {
        return $this->distance;
    }

    /**
     * @param string $unit
     */
    public function setUnit(string $unit): void
    {
        $this->unit = $unit;
    }

    /**
     * @param float $distance
     */
    public function setDistance(float $distance): void
    {
        $this->distance = $distance;
    }

    /**
     * Add meters to the distance of this unit regardless of the type
     *
     * @param float $meters
     */
    public function addMeters(float $meters): void
    {
        $this->setDistance($this->getDistance() + ($meters / $this->getMeterRatio()));
    }
}