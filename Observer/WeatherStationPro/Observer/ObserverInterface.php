<?php
declare(strict_types=1);

namespace Observer\WeatherStationPro\Observer;

use Observer\WeatherStationPro\Event\EventInterface;
use Observer\WeatherStationPro\Observable\ObservableInterface;

/**
 * @template T
 */
interface ObserverInterface
{
    public function update(EventInterface $event, ObservableInterface $subject): void;
}