<?php
declare(strict_types=1);

namespace Observer\WeatherStationPro\Observable;

use Observer\WeatherStationPro\Event\EventInterface;
use Observer\WeatherStationPro\Observer\ObserverInterface;
use Observer\WeatherStationPro\Data\ObserverData;
use Observer\WeatherStationPro\Observable\Exception\NotifyObserverException;
use Throwable;

include 'Exceptions/NotifyObserverException.php';

abstract class Observable implements ObservableInterface
{
    /** @var array */
    private $events;

    public function registerObserver(
        string $event,
        ObserverInterface $observer,
        ?int $priority = 0,
    ): void {
        $observerData = $this->findObserver($event, $observer);

        if ($observerData === null)
        {
            $observerData = new ObserverData(
                $priority,
                $observer
            );
        }
        if (!$this->isObserverSubscribed($event, $observerData))
        {
            $this->addEventListener($event, $observerData);
        }
    }

    public function removeObserver(ObserverInterface $observer, string $event): void
    {
        $observerData = $this->findObserver($event, $observer);
        if ($observerData === null)
        {
            return;
        }

        if ($this->isObserverSubscribed($event, $observerData))
        {
            $this->removeEventListener($event, $observerData);
        }
    }

    public function notifyObservers(array $changeEvents): void
    {
        try
        {
            foreach ($changeEvents as $event)
            {
                if (array_key_exists($event->getType(), $this->events))
                {
                    $this->notifyObserverByEvent($event);
                }
            }
        }
        catch (Throwable $exception)
        {
            throw new NotifyObserverException($exception->getMessage());
        }
    }

    public abstract function getChangedData();

    private function addEventListener(string $observerEventType, ObserverData $observer): void
    {
        $this->events[$observerEventType][] = $observer;

        $this->sortObservers($observerEventType);
    }

    private function removeEventListener(string $event, ObserverData $observer): void
    {
        foreach ($this->events[$event] as $key => $value)
        {
            if ($value === $observer)
            {
                unset($this->events[$event][$key]);;
                break;
            }
        }
        $this->events[$event] = array_values($this->events[$event]);
    }

    private function sortObservers(string $event): void
    {
        usort($this->events[$event], static function($firstValue, $secondValue): int
        {
            return $firstValue->getPriority() < $secondValue->getPriority() ? 1 : -1;
        });
    }

    private function findObserver(string $event, ObserverInterface $observer): ?ObserverData
    {
        if (!$this->events || !array_key_exists($event, $this->events))
        {
            return null;
        }

        foreach ($this->events[$event] as $subscribedObserver)
        {
            if ($subscribedObserver->getObserver() === $observer)
            {
                return $subscribedObserver;
            }
        }

        return null;
    }

    private function isObserverSubscribed(string $event, ObserverData $observer): bool
    {
        if (!$this->events || !array_key_exists($event, $this->events))
        {
            return false;
        }

        return in_array($observer, $this->events[$event]);
    }

    private function notifyObserverByEvent(EventInterface $event)
    {
        foreach ($this->events[$event->getType()] as $observer)
        {
            $observer->getObserver()->update($event, $this);
        }
    }
}