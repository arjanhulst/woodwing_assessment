<?php

namespace App\Domain\Distance\Model\Unit;

use App\Domain\Distance\Model\Base;
use JMS\Serializer\Annotation\ExclusionPolicy;

/**
 * Class Meter
 * @package App\Domain\Distance\Model
 *
 * @ExclusionPolicy("all")
 */
class Yard extends Base
{
    private static $meterRatio = 0.9144;

    public function __construct()
    {
        parent::setMeterRatio(self::$meterRatio);
        $this->setUnit('Yard');
    }
}