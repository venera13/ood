<?php

/**
 * @template T
 */
class StatsCalculator implements StatsCalculatorInterface
{
    /** @var float */
    private $minValue;
    /** @var float */
    private $maxValue;
    /** @var float */
    private $accValue = 0;
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
        $this->accValue += $newValue;
        ++$this->countAcc;
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
        return $this->accValue/$this->countAcc;
    }
}