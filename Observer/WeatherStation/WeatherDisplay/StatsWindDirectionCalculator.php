<?php
declare(strict_types=1);

/**
 * @template T
 */
class StatsWindDirectionCalculator
{
    /** @var float */
    private $accSinValue = 0;
    /** @var float */
    private $accCosValue = 0;
    /** @var int */
    private $countAcc = 0;

    public function update($newValue): void
    {
        ++$this->countAcc;
        $this->changeAccValue($newValue);
    }

    public function getAverage(): float
    {
        $averageCosValue = $this->accCosValue/$this->countAcc;
        $averageSinValue = $this->accSinValue/$this->countAcc;
        return round(rad2deg(atan2($averageSinValue, $averageCosValue)), 2);
    }

    private function changeAccValue(int|float $newValue): void
    {
        $this->accSinValue += sin(deg2rad($newValue));
        $this->accCosValue += cos(deg2rad($newValue));
    }
}