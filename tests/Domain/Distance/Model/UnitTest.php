<?php

namespace App\Tests\Domain\Distance\Model;

use App\Domain\Distance\Factory\UnitFactory;
use PHPUnit\Framework\TestCase;
use InvalidArgumentException;

class UnitTest extends TestCase
{
    /** @var UnitFactory $unitFactory */
    private $unitFactory;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        $this->unitFactory = new UnitFactory();
        parent::__construct($name, $data, $dataName);
    }

    public function testMeter()
    {
        $distance = $this->unitFactory->createUnit('meter');

        $distance->setDistance(15);
        //Check that the meters are stored correctly
        $this->assertEquals(15, $distance->getDistance());

        $distance->addMeters(15);
        //Check that the meters added
        $this->assertEquals(30, $distance->getDistance());
    }

    public function testYard()
    {
        $distance = $this->unitFactory->createUnit('yard');
        $distance->setDistance(15);

        //Check that the distance is set
        $this->assertEquals(15, $distance->getDistance());

        //Add meters and check if they are added to the total distance
        $distance->addMeters(15);
        $this->assertEquals(31.404199475065617, $distance->getDistance());
        //Check that the this unit converts to meters correctly
        $this->assertEquals(28.716, $distance->getMeters());
    }

    public function testNonExistentUnit()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->unitFactory->createUnit('mile');
    }
}