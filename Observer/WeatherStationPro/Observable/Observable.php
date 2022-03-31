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
    private $observers = [];
    /** @var array */
    private $events;

    public function registerObserver(
        string $event,
        ObserverInterface $observer,
        ?int $priority = 0,
    ): void {
        $observerData = $this->findObserver($observer);

        if ($observerData === null)
        {
            $this->addObserver($observer, $priority);
            $observerData = $this->findObserver($observer);
        }
        if (!$this->isSubscribeObserver($event, $observer))
        {
            $this->addEventListener($event, $observerData);
        }
    }

    public function removeObserver(ObserverInterface $observer, ?string $event): void
    {
        $observerData = $this->findObserver($observer);
        if ($observerData === null)
        {
            return;
        }

        if ($event !== null && $this->isSubscribeObserver($event, $observer))
        {
            $this->removeEventListener($event, $observerData);
            return;
        }

        if (!$this->isSubscribeObserver($event, $observer))
        {
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
    }

    public function notifyObservers(): void
    {
        try
        {
            $observableInfoList = $this->getChangedData();

            foreach ($observableInfoList as $observableInfo)
            {
                if (array_key_exists($observableInfo->getEventType(), $this->events))
                {
                    $this->notifyObserverByEvent($observableInfo->getEventType());
                }
            }
        }
        catch (Throwable $exception)
        {
            throw new NotifyObserverException($exception->getMessage());
        }
    }

    public abstract function getChangedData();

    private function addObserver(ObserverInterface $observer, int $priority): void
    {
        $this->observers[] = new ObserverData(
            $priority,
            $observer
        );
    }

    private function addEventListener(string $observerEventType, ObserverData $observer): void
    {
        $this->events[$observerEventType][] = $observer;

        $this->sortObservers($observerEventType);
    }

    private function removeEventListener(string $event, ObserverData $observer): void
    {
        unset($this->events[$event][$observer]);
        $this->events[$event][] = array_values($this->events[$event]);
    }

    private function sortObservers(string $event): void
    {
        usort($this->events[$event], static function($firstValue, $secondValue): int
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

    private function isSubscribeObserver(string $event, ObserverInterface $observer): bool
    {
        if (!$this->events || !array_key_exists($event, $this->events))
        {
            return false;
        }

        return in_array($observer, $this->events[$event]);
    }

    private function notifyObserverByEvent(string $event)
    {
        foreach ($this->events[$event] as $observer)
        {
            $observer->getObserver()->update($this);
        }
    }
}