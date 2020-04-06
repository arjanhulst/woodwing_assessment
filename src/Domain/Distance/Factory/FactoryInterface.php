<?php


namespace App\Domain\Distance\Factory;


interface FactoryInterface
{
    public function createUnit(string $unitType);
}