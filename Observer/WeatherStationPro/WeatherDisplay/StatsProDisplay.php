<?php
declare(strict_types=1);

namespace Observer\WeatherStationPro\WeatherDisplay;

use Observer\WeatherStationPro\Domain\WeatherInfoType;
use Observer\WeatherStationPro\Observer\ObserverInterface;

/**
 * @template T
 */
class StatsProDisplay implements ObserverInterface
{
    /** @var string[] */
    private $events;
    /** @var array */
    private $stats;

    public function setEventListener(string $observableEventType): void
    {
        $this->events[] = $observableEventType;
        if ($observableEventType === WeatherInfoType::WIND_DIRECTION)
        {
            $this->stats[$observableEventType] = new StatsWindDirectionCalculator();
        }
        else
        {
            $this->stats[$observableEventType] = new StatsCalculator();
        }
    }

    public function removeEventListener(string $observableEventType): void
    {
        foreach ($this->events as $key => $value)
        {
            if ($value === $observableEventType)
            {
                unset($this->events[$key]);
                unset($this->stats[$key]);
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

        $this->updateStatistics($subject->getChangedData());
    }

    private function updateStatistics($subjectInfo): void
    {
        foreach ($this->getEvents() as $event)
        {
            foreach ($subjectInfo->getList() as $currentSubjectInfo)
            {
                if ($event === $currentSubjectInfo->getEventType())
                {
                    $this->stats[$event]->update($currentSubjectInfo->getValue());
                    $this->printStatistic($event, $this->stats[$event]);
                }
            }
        }
    }

    /**
     * @param string $paramName
     * @param T $stats
     */
    private function printStatistic(string $paramName, mixed $stats): void
    {
        if (method_exists($stats, 'getMinValue')) print_r('Min ' . $paramName . ' ' . $stats->getMinValue() . '</br>');
        if (method_exists($stats, 'getMaxValue')) print_r('Max ' . $paramName . ' ' . $stats->getMaxValue() . '</br>');
        if (method_exists($stats, 'getAverage')) print_r('Average ' . $paramName . ' ' . $stats->getAverage() . '</br>');
        print_r('------------------</br>');
    }
}