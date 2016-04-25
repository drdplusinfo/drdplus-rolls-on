<?php
namespace DrdPlus\Tests\RollsOn;

use DrdPlus\RollsOn\BasicRollOnSuccess;
use DrdPlus\RollsOn\RollOnQuality;
use Granam\Boolean\BooleanInterface;
use Granam\Tests\Tools\TestWithMockery;

class BasicRollOnSuccessTest extends TestWithMockery
{
    /**
     * @test
     * @dataProvider provideDifficultyAndPropertyWithRoll
     * @param $difficulty
     * @param RollOnQuality $rollOnQuality
     * @param $shouldSuccess
     */
    public function I_can_use_it($difficulty, RollOnQuality $rollOnQuality, $shouldSuccess)
    {
        $basicRollOnSuccess = new BasicRollOnSuccess($difficulty, $rollOnQuality);

        self::assertInstanceOf(BooleanInterface::class, $basicRollOnSuccess);
        self::assertSame($difficulty, $basicRollOnSuccess->getDifficulty());
        self::assertSame($rollOnQuality, $basicRollOnSuccess->getRollOnQuality());

        if ($shouldSuccess) {
            self::assertTrue($basicRollOnSuccess->getValue());
            self::assertTrue($basicRollOnSuccess->isSuccessful());
            self::assertFalse($basicRollOnSuccess->isFailed());
            self::assertSame('success', (string)$basicRollOnSuccess);
        } else {
            self::assertFalse($basicRollOnSuccess->getValue());
            self::assertFalse($basicRollOnSuccess->isSuccessful());
            self::assertTrue($basicRollOnSuccess->isFailed());
            self::assertSame('fail', (string)$basicRollOnSuccess);
        }
    }

    public function provideDifficultyAndPropertyWithRoll()
    {
        return [
            [123, $this->createRollOnQuality(789), true],
            [999, $this->createRollOnQuality(998), false],
            [0, $this->createRollOnQuality(0), true],
            [1, $this->createRollOnQuality(0), false],
            [1, $this->createRollOnQuality(1), true],
        ];
    }

    /**
     * @param int $value
     * @return \Mockery\MockInterface|RollOnQuality
     */
    private function createRollOnQuality($value)
    {
        $rollOnQuality = $this->mockery(RollOnQuality::class);
        $rollOnQuality->shouldReceive('getValue')
            ->andReturn($value);

        return $rollOnQuality;
    }
}