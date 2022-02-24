<?php
declare(strict_types=1);

include 'Data/WeatherInfo.php';
include 'Data/ObserverData.php';
include 'Domain/ObservableType.php';
include 'Observable/ObservableInterface.php';
include 'Observable/Observable.php';
include 'Observer/ObserverInterface.php';
include 'WeatherData/WeatherData.php';
include 'WeatherDisplay/Display.php';
include 'WeatherDisplay/StatsDisplay.php';
include 'WeatherDisplay/StatsCalculatorInterface.php';
include 'WeatherDisplay/StatsCalculator.php';

$weatherData = new WeatherData();

$display = new Display();
$weatherData->registerObserver($display, 1);

$statsDisplay = new StatsDisplay();
$weatherData->registerObserver($statsDisplay, 2);

$weatherData->setMeasurements(5, 0.9, 750);
$weatherData->setMeasurements(10, 0.5, 754);

$weatherData->removeObserver($statsDisplay);

$weatherData->setMeasurements(-10, 1, 750);
$weatherData->setMeasurements(0, 0.1, 745);
