<?php
declare(strict_types=1);

namespace Observer\WeatherStationPro\Observable;

use Observer\WeatherStationPro\Observer\ObserverInterface;
use Observer\WeatherStationPro\Data\ObserverData;
use Observer\WeatherStationPro\Observable\Exception\NotifyObserverException;
use Throwable;

include 'Exceptions/NotifyObserverException.php';

/**
 * @template T
 */
abstract class Observable implements ObservableInterface
{
    /** @var ObserverData[] */
    public $observers = [];

    public function registerObserver(
        ObserverInterface $observer,
        int $priority = 0,
        ?array $measurementKeys = null
    ): void {
        $this->observers[] = new ObserverData(
            $priority,
            $observer,
            $measurementKeys
        );

        $this->sortObservers();
    }
    
    public function removeObserver(ObserverInterface $observer): void
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
    
    public function notifyObservers(): void
    {
        try
        {
            $observableInfoList = $this->getChangedData()->getList();

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

    public function addEventListener(ObserverInterface $observer, string $observerEventType): void
    {
        foreach ($this->observers as $currentObserver)
        {
            if ($currentObserver->getObserver() === $observer)
            {
                $events = $currentObserver->getEvents();
                $events[] = $observerEventType;
                $currentObserver->setEvents($events);
                break;
            };
        }
    }

    public function removeEventListener(ObserverInterface $observer, string $observerEventType): void
    {
        foreach ($this->observers as $currentObserver)
        {
            if ($currentObserver->getObserver() === $observer)
            {
                $events = $currentObserver->getEvents();
                unset($events[array_search($observerEventType, $events)]);
                $currentObserver->setEvents(array_values($events));
                break;
            };
        }
    }

    /**
     * @return T
     */
    public abstract function getChangedData();

    private function sortObservers(): void
    {
        usort($this->observers, static function($firstValue, $secondValue): int
        {
            return $firstValue->getPriority() < $secondValue->getPriority() ? 1 : -1;
        });
    }
}