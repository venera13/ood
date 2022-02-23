<?php
declare(strict_types=1);

/**
 * @template T
 */
class StatsWindDirectionCalculator
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

    /**
     * @param T $newValue
     * @return void
     */
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

    /**
     * @return float
     */
    public function getMinValue(): float
    {
        return $this->minValue;
    }

    /**
     * @return float
     */
    public function getMaxValue(): float
    {
        return $this->maxValue;
    }

    /**
     * @return float
     */
    public function getAverage()
    {
        $averageCosValue = $this->accCosValue/$this->countAcc;
        $averageSinValue = $this->accSinValue/$this->countAcc;
        return round(rad2deg(atan2($averageSinValue, $averageCosValue)), 2);
    }

    /**
     * @param int $newValue
     */
    private function changeAccValue(int $newValue): void
    {
        $this->accSinValue += sin(deg2rad($newValue));
        $this->accCosValue += cos(deg2rad($newValue));
    }
}