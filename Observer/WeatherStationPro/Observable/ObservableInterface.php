<?php
declare(strict_types=1);

namespace Observer\WeatherStationPro\Observable;

use Observer\WeatherStationPro\Observer\ObserverInterface;

/**
 * @template T
 */
interface ObservableInterface
{
    public function setType(string $type): void;

    public function registerObserver(ObserverInterface $observer, int $priority = 0): void;

    public function removeObserver(ObserverInterface $observer): void;
    
    public function notifyObservers(): void;
}