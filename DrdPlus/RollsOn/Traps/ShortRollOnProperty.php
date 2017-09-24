<?php
namespace DrdPlus\RollsOn\Traps;

use Drd\DiceRolls\Templates\Rolls\Roll1d6;
use DrdPlus\Properties\Property;
use DrdPlus\RollsOn\QualityAndSuccess\RollOnQuality;

abstract class ShortRollOnProperty extends RollOnQuality
{
    /**
     * @var Property
     */
    private $property;

    /**
     * @param Property $property
     * @param Roll1d6 $roll1d6
     */
    public function __construct(Property $property, Roll1d6 $roll1d6)
    {
        $this->property = $property;
        parent::__construct($property->getValue(), $roll1d6);
    }

    /**
     * @return Property
     */
    protected function getProperty(): Property
    {
        return $this->property;
    }
}