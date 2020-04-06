<?php

namespace App\Tests\Domain\Distance\Service;

use App\Domain\Distance\Factory\UnitFactory;
use App\Domain\Distance\Service\DistanceCalculator;
use ApiException;
use PHPUnit\Framework\TestCase;

class DistanceCalculatorTest extends TestCase
{
    public function testAddUpDistance()
    {
        $unitFactory = new UnitFactory();
        $distanceCalculator = new DistanceCalculator($unitFactory);
        $params = [
            [
                'distance' => 5,
                'unit' => 'meter'
            ],
            [
                'distance' => 3,
                'unit' => 'yard'
            ]
        ];
        $newDistance = $distanceCalculator->addUp($params, 'meter');
        //Check that the return distance has the correct value in meters
        $this->assertEquals(7.7432, $newDistance->getDistance());
        $this->assertEquals('Meter', $newDistance->getUnit());

        $newDistance = $distanceCalculator->addUp($params, 'yard');
        //Convert to yards and assert that the values are still correct
        $this->assertEquals(8.4680664916885, $newDistance->getDistance());
        $this->assertEquals('Yard', $newDistance->getUnit());
    }

    public function testNonExistentUnit()
    {
        $params = [
            [
                'distance' => 5,
                'unit' => 'meter'
            ],
            [
                'distance' => 3,
                'unit' => 'yard'
            ]
        ];
        $unitFactory = new UnitFactory();
        $distanceCalculator = new DistanceCalculator($unitFactory);

        $this->expectException(ApiException::class);
        $distanceCalculator->addUp($params, 'mile');
    }
}