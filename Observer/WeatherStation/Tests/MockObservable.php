<?php
declare(strict_types=1);

class MockObservable extends Observable
{
    public function hasObserver(ObserverInterface $observer): bool
    {
        return in_array($observer, $this->observers);
    }

    protected function getChangedData(): WeatherInfo
    {
        return new WeatherInfo(
            0.0,
            0.0,
            0
        );
    }
}