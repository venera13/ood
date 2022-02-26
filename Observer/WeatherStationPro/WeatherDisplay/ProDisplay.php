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

    public function update(mixed $subject): void
    {
        if ($subject->getType())
        {
            print_r('Observable type ' . $subject->getType() . '</br>');
        }

        $data = $subject->getChangedData();
        foreach ($this->getEvents() as $event)
        {
            foreach ($data->getList() as $currentSubjectInfo)
            {
                if ($event === $currentSubjectInfo->getEventType())
                {
                    print_r('Current ' . $currentSubjectInfo->getEventType() . ' ' . $currentSubjectInfo->getValue() . '</br>');
                }
            }
        }
        print_r('------------------</br>');
    }
}