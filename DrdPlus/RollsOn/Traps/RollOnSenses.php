<?php
namespace DrdPlus\RollsOn\Traps;

use Drd\DiceRolls\Templates\Rolls\Roll2d6DrdPlus;
use DrdPlus\Properties\Derived\Senses;
use DrdPlus\RollsOn\QualityAndSuccess\RollOnQuality;

class RollOnSenses extends RollOnQuality
{
    /**
     * @var Senses
     */
    private $senses;
    /**
     * @var BonusFromUsedRemarkableSense
     */
    private $bonusFromUsedRemarkableSense;

    /**
     * @param Senses $senses
     * @param Roll2d6DrdPlus $roll2d6DrdPlus
     * @param BonusFromUsedRemarkableSense $bonusFromUsedRemarkableSense
     */
    public function __construct(
        Senses $senses,
        Roll2d6DrdPlus $roll2d6DrdPlus,
        BonusFromUsedRemarkableSense $bonusFromUsedRemarkableSense
    )
    {
        $this->senses = $senses;
        $this->bonusFromUsedRemarkableSense = $bonusFromUsedRemarkableSense;
        parent::__construct($senses->getValue() + $bonusFromUsedRemarkableSense->getValue(), $roll2d6DrdPlus);
    }

    /**
     * @return Senses
     */
    public function getSenses()
    {
        return $this->senses;
    }

    /**
     * @return BonusFromUsedRemarkableSense
     */
    public function getBonusFromUsedRemarkableSense()
    {
        return $this->bonusFromUsedRemarkableSense;
    }

}