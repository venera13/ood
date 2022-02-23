<?php
declare(strict_types=1);

namespace Observer\WeatherStationPro\Observer;

/**
 * @template T
 */
interface ObserverInterface
{
    /**
     * @param string $observableEventType
     */
    public function setEventListener(string $observableEventType): void;

    /**
     * @param string $observableEventType
     */
    public function removeEventListener(string $observableEventType): void;

    /**
     * @return string[]
     */
    public function getEvents(): array;

    /**
     * @param T $weatherInfo
     * @param string|null $observableType
     */
    public function update(mixed $weatherInfo, ?string $observableType = null): void;
}