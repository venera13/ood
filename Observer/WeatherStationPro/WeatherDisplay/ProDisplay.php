<?php
declare(strict_types=1);

namespace Observer\WeatherStationPro\WeatherDisplay;

use Observer\WeatherStationPro\Observer\ObserverInterface;

/**
 * @template T
 */
class ProDisplay implements ObserverInterface
{
    /** @var string[] */
    private $events;

    public function setEventListener(string $observableEventType): void
    {
        $this->events[] = $observableEventType;
    }

    public function removeEventListener(string $observableEventType): void
    {
        foreach ($this->events as $key => $value)
        {
            if ($value === $observableEventType)
            {
                unset($this->events[$key]);
            }
        }
    }

    public function getEvents(): array
    {
        return $this->events;
    }

    public function update(mixed $weatherInfo, ?string $observableType = null): void
    {
        if ($observableType)
        {
            print_r('Observable type ' . $observableType . '</br>');
        }
        foreach ($this->getEvents() as $event)
        {
            foreach ($weatherInfo->getList() as $currentWeatherInfo)
            {
                if ($event === $currentWeatherInfo->getEventType())
                {
                    print_r('Current ' . $currentWeatherInfo->getEventType() . ' ' . $currentWeatherInfo->getValue() . '</br>');
                }
            }
        }
        print_r('------------------</br>');
    }
}