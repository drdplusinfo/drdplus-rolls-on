<?php
namespace DrdPlus\RollsOn\Traps;

use DrdPlus\RollsOn\QualityAndSuccess\ExtendedRollOnSuccess;
use DrdPlus\RollsOn\QualityAndSuccess\SimpleRollOnSuccess;

/**
 * Usable against trap by wounds for example
 * @method RollOnWill getRollOnQuality
 */
class RollOnWillAgainstMalus extends ExtendedRollOnSuccess
{
    const HIGHEST_MALUS = -3;
    const MEDIUM_MALUS = -2;
    const LOWEST_MALUS = -1;
    const WITHOUT_MALUS = 0;

    public function __construct(RollOnWill $rollOnWill)
    {
        parent::__construct(
            new SimpleRollOnSuccess(5, $rollOnWill, self::MEDIUM_MALUS, self::HIGHEST_MALUS),
            new SimpleRollOnSuccess(10, $rollOnWill, self::LOWEST_MALUS),
            new SimpleRollOnSuccess(15, $rollOnWill, self::WITHOUT_MALUS)
        );
    }

    /**
     * @return RollOnWill
     */
    public function getRollOnWill(): RollOnWill
    {
        return $this->getRollOnQuality();
    }

    /**
     * @return int
     */
    public function getMalusValue(): int
    {
        return $this->getResult();
    }
}