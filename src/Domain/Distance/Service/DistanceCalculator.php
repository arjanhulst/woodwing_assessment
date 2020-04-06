<?php

namespace App\Domain\Distance\Service;

use App\Domain\Distance\Factory\UnitFactory;
use App\Domain\Distance\Model\Base;

/**
 * Class DistanceCalculationService Holds all function related to calculating distances
 * @package App\Calculation
 */
class DistanceCalculator
{
    /**
     * @var UnitFactory $unitFactory the factory we use to instantiate units
     */
    private $unitFactory;


    /**
     * DistanceCalculation constructor.
     * @param UnitFactory $unitFactory
     */
    public function __construct(UnitFactory $unitFactory)
    {
        $this->unitFactory = $unitFactory;
    }

    /**
     * Add up distances and return a new distance in the requested unit type
     *
     * @param array $distances
     * @param string $returnUnitType
     * @return mixed
     */
    public function addUp(array $distances, string $returnUnitType)
    {
        //create a new Unit which we will use to store and add the distances from the distances supplied
        /** @var Base $returnUnit */
        $returnUnit = $this->unitFactory->createUnit($returnUnitType);
        foreach ($distances as $key => $distance) {
            /** @var Base $unit */
            $unit = $this->unitFactory->createUnit($distance['unit']);
            $unit->setDistance(floatval($distance['distance']));
            $returnUnit->addMeters($unit->getMeters());
        }
        return $returnUnit;
    }
}
