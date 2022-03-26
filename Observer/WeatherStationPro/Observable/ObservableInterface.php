<?php
declare(strict_types=1);

namespace Observer\WeatherStationPro\Observable;

use Observer\WeatherStationPro\Observer\ObserverInterface;

interface ObservableInterface
{
    public function registerObserver(string $event, ObserverInterface $observer, int $priority = 0): void;

    public function removeObserver(string $event, ObserverInterface $observer): void;

    public function notifyObservers(): void;
}