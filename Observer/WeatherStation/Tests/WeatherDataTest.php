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
include 'FirstObserver.php';
include 'SecondObserver.php';

use PHPUnit\Framework\TestCase;

class WeatherDataTest extends TestCase
{
    public function testSelfRemoverObserver(): void
    {
        $observable = new MockObservable();

        $selfRemoverObserver = new SelfRemoverObserver();
        $observable->registerObserver($selfRemoverObserver);

        $this->assertEquals(true, $observable->hasObserver($selfRemoverObserver));

        $this->expectException(NotifyObserverException::class);
        $observable->notifyObservers();
        $this->assertEquals(true, $observable->hasObserver($selfRemoverObserver));
    }

    public function testObserverUpdatePriority(): void
    {
        $observable = new MockObservable();

        $firstObserver = new FirstObserver();
        $observable->registerObserver($firstObserver, 1);

        $secondObserver = new SecondObserver();
        $observable->registerObserver($secondObserver, 2);

        $observable->notifyObservers();
        $this->expectOutputString('21');
    }
}
