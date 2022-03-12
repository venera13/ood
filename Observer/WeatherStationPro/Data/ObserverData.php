<?php
declare(strict_types=1);

namespace Observer\WeatherStationPro\Data;

use Observer\WeatherStationPro\Observer\ObserverInterface;

class ObserverData
{
    /** @var int */
    private $priority;
    /** @var ObserverInterface */
    private $observer;
    /** @var string[]|null */
    private $events;

    public function __construct(int $priority, ObserverInterface $observer, ?array $events)
    {
        $this->priority = $priority;
        $this->observer = $observer;
        $this->events = $events;
    }

    /**
     * @return int
     */
    public function getPriority(): int
    {
        return $this->priority;
    }

    /**
     * @return ObserverInterface
     */
    public function getObserver(): ObserverInterface
    {
        return $this->observer;
    }

    /**
     * @return string[]|null
     */
    public function getEvents(): ?array
    {
        return $this->events;
    }

    /**
     * @param string[] $events
     */
    public function setEvents(array $events): void
    {
        $this->events = $events;
    }
}