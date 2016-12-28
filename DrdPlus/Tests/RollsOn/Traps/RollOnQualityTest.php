<?php
namespace DrdPlus\Tests\RollsOn\Traps;

use Drd\DiceRoll\Templates\Rollers\Roller2d6DrdPlus;
use DrdPlus\Properties\Base\BaseProperty;
use DrdPlus\Properties\Derived\DerivedProperty;
use DrdPlus\Properties\Property;
use DrdPlus\RollsOn\QualityAndSuccess\RollOnQuality;
use Granam\Tests\Tools\TestWithMockery;

abstract class RollOnQualityTest extends TestWithMockery
{
    /**
     * @test
     */
    public function I_can_use_it()
    {
        $sutClass = self::getSutClass();
        /** @var RollOnQuality $rollOnProperty */
        $rollOnProperty = new $sutClass(
            $property = $this->getPropertyInstance($propertyValue = 123),
            $roll = Roller2d6DrdPlus::getIt()->roll()
        );
        $getProperty = $this->getPropertyGetter();
        self::assertSame($property, $rollOnProperty->$getProperty());
        self::assertSame($propertyValue, $rollOnProperty->getPreconditionsSum());
        self::assertSame($roll, $rollOnProperty->getRoll());
        $resultValue = $propertyValue + $roll->getValue();
        self::assertSame($resultValue, $rollOnProperty->getValue());
        self::assertSame((string)$resultValue, (string)$rollOnProperty);
    }

    /**
     * @return string|BaseProperty
     */
    protected function getPropertyClass()
    {
        $propertyBasename = preg_replace('~^.+RollOn(.+)$~', '$1', self::getSutClass());
        $basePropertyNamespace = (new \ReflectionClass(BaseProperty::class))->getNamespaceName();
        $basePropertyClassName = $basePropertyNamespace . '\\' . $propertyBasename;
        if (class_exists($basePropertyClassName)) {
            return $basePropertyClassName;
        }
        $derivedPropertyNamespace = (new \ReflectionClass(DerivedProperty::class))->getNamespaceName();

        return $derivedPropertyNamespace . '\\' . $propertyBasename;
    }

    /**
     * @param $value
     * @return \Mockery\MockInterface|Property
     */
    protected function getPropertyInstance($value)
    {
        $property = $this->mockery($this->getPropertyClass());
        $property->shouldReceive('getValue')
            ->andReturn($value);

        return $property;
    }

    protected function getPropertyGetter()
    {
        $propertyName = preg_replace('~^(?:.+[\\\])?(\w+)$~', '$1', $this->getPropertyClass());

        return 'get' . $propertyName;
    }
}