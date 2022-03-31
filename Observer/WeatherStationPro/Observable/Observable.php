<?php
declare(strict_types=1);

namespace Observer\WeatherStationPro\Observable;

use Observer\WeatherStationPro\Observer\ObserverInterface;
use Observer\WeatherStationPro\Data\ObserverData;
use Observer\WeatherStationPro\Observable\Exception\NotifyObserverException;
use Throwable;

include 'Exceptions/NotifyObserverException.php';

abstract class Observable implements ObservableInterface
{
    /** @var ObserverData[] */
    public $observers = [];

    public function registerObserver(
        string $event,
        ObserverInterface $observer,
        int $priority = 0,
    ): void {
        $observerData = $this->findObserver($observer);
        if ($observerData !== null)
        {
            $this->addEventListener($event, $observerData);
        }
        else
        {
            $this->observers[] = new ObserverData(
                $priority,
                $observer,
                [$event]
            );

            $this->sortObservers();
        }
    }

    public function removeObserver(string $event, ObserverInterface $observer): void
    {
        $observerData = $this->findObserver($observer);
        if ($observerData !== null && !empty($observerData->getEvents()) && $observerData->getEvents() !== [$event])
        {
            $this->removeEventListener($event, $observerData);
            return;
        }

        foreach ($this->observers as $key => $value)
        {
            if ($value->getObserver() === $observer)
            {
                unset($this->observers[$key]);
                break;
            }
        }
        $this->observers = array_values($this->observers);
    }

    private function removeEventListener(string $event, ObserverData $observer): void
    {
        $events = $observer->getEvents();
        unset($events[array_search($event, $events)]);
        $observer->setEvents(array_values($events));
    }

    private function addEventListener(string $observerEventType, ObserverData $observer): void
    {
        $events = $observer->getEvents();
        if (in_array($observerEventType, $events))
        {
            return;
        }

        $events[] = $observerEventType;
        $observer->setEvents($events);
    }

    public function notifyObservers(): void
    {
        try
        {
            $observableInfoList = $this->getChangedData();

            foreach ($this->observers as $observer)
            {
                foreach ($observableInfoList as $observableInfo)
                {
                    if ($observer->getEvents() && in_array($observableInfo->getEventType(), $observer->getEvents()))
                    {
                        $observer->getObserver()->update($this);
                        break;
                    }
                }
            }
        }
        catch (Throwable $exception)
        {
            throw new NotifyObserverException($exception->getMessage());
        }
    }

    public abstract function getChangedData();

    private function sortObservers(): void
    {
        usort($this->observers, static function($firstValue, $secondValue): int
        {
            return $firstValue->getPriority() < $secondValue->getPriority() ? 1 : -1;
        });
    }

    private function findObserver(ObserverInterface $observer): ?ObserverData
    {
        $result = null;
        foreach ($this->observers as $currentObserver)
        {
            if ($currentObserver->getObserver() === $observer)
            {
                $result = $currentObserver;
                break;
            }
        }
        return $result;
    }
}