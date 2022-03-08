<?php
declare(strict_types=1);

include 'Data/WeatherInfo.php';
include 'Data/WeatherDuoInfo.php';
include 'Data/ObserverData.php';
include 'Observable/ObservableInterface.php';
include 'Observable/Observable.php';
include 'Observer/ObserverInterface.php';
include 'WeatherData/WeatherData.php';
include 'WeatherData/WeatherDataInside.php';
include 'WeatherData/WeatherDataOutside.php';
include 'WeatherDisplay/Display.php';
include 'WeatherDisplay/StatsDisplay.php';
include 'WeatherDisplay/ProDisplay.php';
include 'WeatherDisplay/StatsProDisplay.php';
include 'WeatherDisplay/StatsCalculator.php';
include 'WeatherDisplay/StatsWindDirectionCalculator.php';

$weatherDataIn = new WeatherDataInside();
$weatherDataOut = new WeatherDataOutside();

$display = new Display();
$statsDisplay = new StatsDisplay();
$weatherDataIn->registerObserver($display);
$weatherDataIn->registerObserver($statsDisplay);

$proDisplay = new ProDisplay();
$statsProDisplay = new StatsProDisplay();
$weatherDataOut->registerObserver($proDisplay);
$weatherDataOut->registerObserver($statsProDisplay);

$weatherDataIn->setMeasurements(20, 0.4, 750);
$weatherDataIn->setMeasurements(22, 0.5, 750);

$weatherDataIn->setMeasurements(6, 0.9, 750, 10, 1);
//$weatherDataOut->setMeasurements(5, 0.9, 750, 10, 1);
//$weatherDataOut->setMeasurements(10, 0.5, 754, 5, 359);