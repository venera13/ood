<?php

namespace Observer\WeatherStationPro\WeatherDisplay;

/**
 * @template T
 */
interface StatsCalculatorInterface
{
    /**
     * @param T $newValue
     * @return void
     */
    public function update($newValue): void;

    /**
     * @return float
     */
    public function getMinValue(): float;

    /**
     * @return float
     */
    public function getMaxValue(): float;

    /**
     * @return float
     */
    public function getAverage(): float;
}