<?php
declare(strict_types=1);

namespace Observer\WeatherStationPro\WeatherDisplay;

/**
 * @template T
 */
class StatsWindDirectionCalculator implements StatsCalculatorInterface
{
    /** @var float */
    private $minValue;
    /** @var float */
    private $maxValue;
    /** @var float */
    private $accSinValue = 0;
    /** @var float */
    private $accCosValue = 0;
    /** @var int */
    private $countAcc = 0;

    public function update($newValue): void
    {
        if (!$this->minValue)
        {
            $this->minValue = $newValue;
        }
        if (!$this->maxValue)
        {
            $this->maxValue = $newValue;
        }

        if ($this->minValue > $newValue)
        {
            $this->minValue = $newValue;
        }
        if ($this->maxValue < $newValue)
        {
            $this->maxValue = $newValue;
        }
        ++$this->countAcc;
        $this->changeAccValue($newValue);
    }

    public function getMinValue(): float
    {
        return $this->minValue;
    }

    public function getMaxValue(): float
    {
        return $this->maxValue;
    }

    public function getAverage(): float
    {
        $averageCosValue = $this->accCosValue/$this->countAcc;
        $averageSinValue = $this->accSinValue/$this->countAcc;
        return round(rad2deg(atan2($averageSinValue, $averageCosValue)), 2);
    }

    private function changeAccValue(float $newValue): void
    {
        $this->accSinValue += sin(deg2rad($newValue));
        $this->accCosValue += cos(deg2rad($newValue));
    }
}