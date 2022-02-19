<?php

/**
 * @template T
 */
class StatsCalculator
{
    /** @var float */
    private $minValue;
    /** @var float */
    private $maxValue;
    /** @var float */
    private $accValue = 0;
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
        $this->accValue += $newValue;
        ++$this->countAcc;
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
        return $this->accValue/$this->countAcc;
    }
}