<?php
namespace DrdPlus\RollsOn;

use Drd\DiceRoll\Templates\Rollers\SpecificRolls\Roll2d6DrdPlus;
use Granam\Integer\IntegerInterface;
use Granam\Strict\Object\StrictObject;

abstract class RollOnSituation extends StrictObject implements IntegerInterface
{
    /**
     * @var Roll2d6DrdPlus
     */
    private $roll2d6Plus;

    protected function __construct(Roll2d6DrdPlus $roll2d6Plus)
    {
        $this->roll2d6Plus = $roll2d6Plus;
    }

    /**
     * @return Roll2d6DrdPlus
     */
    public function getRoll2d6Plus()
    {
        return $this->roll2d6Plus;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return (string)$this->getValue();
    }
}