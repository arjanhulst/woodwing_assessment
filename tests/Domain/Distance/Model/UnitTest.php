<?php

namespace App\Tests\Domain\Distance\Model;

use App\Domain\Distance\Model\Unit\Meter;
use App\Domain\Distance\Model\Unit\Yard;
use PHPUnit\Framework\TestCase;

class UnitTest extends TestCase
{
    public function testMeter()
    {
        $distance = new Meter();
        $distance->setDistance(15);
        //Check that the meters are stored correctly
        $this->assertEquals(15, $distance->getDistance());

        $distance->addMeters(15);
        //Check that the meters added
        $this->assertEquals(30, $distance->getDistance());
    }

    public function testYard()
    {
        $distance = new Yard();
        $distance->setDistance(15);

        $this->assertEquals(15, $distance->getDistance());
        $distance->addMeters(15);
        //Check that the meters added
        $this->assertEquals(31.404199475065617, $distance->getDistance());
        //Check that the this unit converts to meters correctly
        $this->assertEquals(28.716, $distance->getMeters());
    }
}