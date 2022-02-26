<?php
declare(strict_types=1);

class MockObservable extends Observable
{
    public function hasObserver(ObserverInterface $observer): bool
    {
        foreach ($this->observers as $observerData)
        {
            if ($observerData->getObserver() === $observer) return true;
        }
        return false;
    }

    public function getObserverByKey(int $key): ObserverData
    {
        return $this->observers[$key];
    }

    public function getChangedData(): WeatherInfo
    {
        return new WeatherInfo(
            0.0,
            0.0,
            0
        );
    }
}