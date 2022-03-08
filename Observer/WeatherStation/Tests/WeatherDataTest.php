<?php

include '../Data/WeatherInfo.php';
include '../Data/ObserverData.php';
include '../Observable/ObservableInterface.php';
include '../Observable/Observable.php';
include '../Observer/ObserverInterface.php';
include '../WeatherData/WeatherData.php';
include '../WeatherDisplay/Display.php';
include '../WeatherDisplay/StatsDisplay.php';
include '../WeatherDisplay/StatsCalculator.php';
include 'MockObservable.php';
include 'MockObservableInside.php';
include 'MockObservableOutside.php';
include 'SelfRemoverObserver.php';
include 'FirstObserver.php';
include 'SecondObserver.php';
include 'ObserverWithCheckType.php';
include 'TestObserver.php';

use PHPUnit\Framework\TestCase;

class WeatherDataTest extends TestCase
{
    public function testRemoveObserver(): void
    {
        $observable = new MockObservable();

        $firstObserver = new TestObserver();
        $observable->registerObserver($firstObserver);

        $secondObserver = new TestObserver();
        $observable->registerObserver($secondObserver);

        $thirdObserver = new TestObserver();
        $observable->registerObserver($thirdObserver);

        $observable->removeObserver($secondObserver);

        $this->assertEquals(true, $observable->getObserverByKey(1) !== null);
    }

    public function testSelfRemoverObserver(): void
    {
        $observable = new MockObservable();

        $selfRemoverObserver = new SelfRemoverObserver();
        $observable->registerObserver($selfRemoverObserver);

        $this->assertEquals(true, $observable->hasObserver($selfRemoverObserver));

        $observable->notifyObservers();
        $this->assertEquals(false, $observable->hasObserver($selfRemoverObserver));
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

    public function testDuoObservable(): void
    {
        $observableIn = new MockObservableInside();

        $observableOut = new MockObservableOutside();

        $observer = new ObserverWithCheckType();
        $observableIn->registerObserver($observer);
        $observableOut->registerObserver($observer);

        $observableIn->notifyObservers();
        $observableOut->notifyObservers();

        $this->expectOutputString('insideoutside');
    }
}
