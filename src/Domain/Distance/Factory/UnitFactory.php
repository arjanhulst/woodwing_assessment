<?php

namespace App\Domain\Distance\Factory;

use App\Domain\Distance\Exception\ApiException;

class UnitFactory implements FactoryInterface
{
    private $unitNameSpace = 'App\Domain\Distance\Model\Unit\\';

    public function createUnit(string $unitType)
    {
        $className = $this->unitNameSpace . ucfirst($unitType);
        if (class_exists($className)) {
            return new $className();
        } else {
            throw new ApiException("We do not support the unit ($unitType) you have requested (yet)");
            //TODO: Create an actual exception for this
        }
    }
}