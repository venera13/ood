<?php
declare(strict_types=1);

include 'Data/WeatherInfo.php';
include 'Data/ObserverData.php';
include 'Observable/ObservableInterface.php';
include 'Observable/Observable.php';
include 'Observer/ObserverInterface.php';
include 'WeatherData/WeatherData.php';
include 'WeatherData/WeatherDataInside.php';
include 'WeatherData/WeatherDataOutside.php';
include 'WeatherDisplay/Display.php';
include 'WeatherDisplay/StatsDisplay.php';
include 'WeatherDisplay/StatsCalculator.php';

$weatherDataIn = new WeatherDataInside();
$weatherDataOut = new WeatherDataOutside();

$display = new Display();
$weatherDataIn->registerObserver($display, 1);
$weatherDataOut->registerObserver($display, 1);

$statsDisplay = new StatsDisplay();
$weatherDataIn->registerObserver($statsDisplay, 2);
$weatherDataOut->registerObserver($statsDisplay, 2);

$weatherDataIn->setMeasurements(5, 0.9, 750);
$weatherDataOut->setMeasurements(10, 0.5, 754);

$weatherDataIn->removeObserver($statsDisplay);

$weatherDataIn->setMeasurements(-10, 1, 750);
$weatherDataOut->setMeasurements(0, 0.1, 745);