<?php

namespace App\Domain\Distance\Model\Unit;

use JMS\Serializer\Annotation\ExclusionPolicy;
use App\Domain\Distance\Model\Base;

/**
 * Class Meter
 * @package App\Domain\Distance\Model
 *
 * @ExclusionPolicy("all")
 */
class Meter extends Base
{
    private static $meterRatio = 1.0;

    public function __construct()
    {
        parent::setMeterRatio(self::$meterRatio);
        $this->setUnit('Meter');
    }
}