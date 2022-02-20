<?php

include '../Data/WeatherInfo.php';
include '../Observable/ObservableInterface.php';
include '../Observable/Observable.php';
include '../Observer/ObserverInterface.php';
include '../WeatherData/WeatherData.php';
include '../WeatherDisplay/Display.php';
include '../WeatherDisplay/StatsDisplay.php';
include '../WeatherDisplay/StatsCalculator.php';
include 'MockObservable.php';
include 'SelfRemoverObserver.php';

use PHPUnit\Framework\TestCase;

class WeatherDataTest extends TestCase
{
    public function testSelfRemoverObserver(): void
    {
        $observable = new MockObservable();

        $selfRemoverObserver = new SelfRemoverObserver();
        $observable->registerObserver($selfRemoverObserver);

        $this->assertEquals(true, $observable->hasObserver($selfRemoverObserver));

        $observable->notifyObservers();
        $this->assertEquals(false, $observable->hasObserver($selfRemoverObserver));
    }
}
