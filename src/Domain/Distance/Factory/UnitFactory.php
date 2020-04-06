<?php

namespace App\Domain\Distance\Factory;

use InvalidArgumentException;

class UnitFactory implements FactoryInterface
{
    private $unitNameSpace = 'App\Domain\Distance\Model\Unit\\';

    public function createUnit(string $unitType)
    {
        $className = $this->unitNameSpace . ucfirst($unitType);
        if (class_exists($className)) {
            return new $className();
        } else {
            throw new InvalidArgumentException("We don't support the unit ($unitType) you have requested (yet)");
            //TODO: Create an actual exception for this
        }
    }
}