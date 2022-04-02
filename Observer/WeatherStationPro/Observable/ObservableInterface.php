<?php
declare(strict_types=1);

namespace Observer\WeatherStationPro\Observable;

use Observer\WeatherStationPro\Observer\ObserverInterface;

interface ObservableInterface
{
    public function registerObserver(string $event, ObserverInterface $observer, int $priority = 0): void;

    public function removeObserver(ObserverInterface $observer, ?string $event): void;

    public function notifyObservers(array $changeEvents): void;
}