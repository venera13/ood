<?php
declare(strict_types=1);

namespace Observer\WeatherStationPro\Observer;

use Observer\WeatherStationPro\Observable\ObservableInterface;

/**
 * @template T
 */
interface ObserverInterface
{
    public function update(ObservableInterface $subject): void;
}