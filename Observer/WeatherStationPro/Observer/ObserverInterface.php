<?php
declare(strict_types=1);

namespace Observer\WeatherStationPro\Observer;

/**
 * @template T
 */
interface ObserverInterface
{
    /**
     * @param T $subject
     */
    public function update(mixed $subject): void;
}