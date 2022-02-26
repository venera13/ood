<?php
declare(strict_types=1);

include 'Data/WeatherInfo.php';
include 'Data/WeatherDuoInfo.php';
include 'Data/ObserverData.php';
include 'Domain/ObservableType.php';
include 'Observable/ObservableInterface.php';
include 'Observable/Observable.php';
include 'Observer/ObserverInterface.php';
include 'WeatherData/WeatherDataPro.php';
include 'WeatherDisplay/ProDisplay.php';
include 'WeatherDisplay/StatsProDisplay.php';
include 'WeatherDisplay/StatsCalculator.php';
include 'WeatherDisplay/StatsWindDirectionCalculator.php';

$weatherData = new WeatherDataPro();

$display = new ProDisplay();
$weatherData->registerObserver($display);

$statsDisplay = new StatsProDisplay();
$weatherData->registerObserver($statsDisplay);

$weatherData->setMeasurements(5, 0.9, 750, 10, 1);
$weatherData->setMeasurements(10, 0.5, 754, 5, 359);

$weatherData->removeObserver($statsDisplay);

$weatherData->setMeasurements(-10, 1, 750, 5, 270);
$weatherData->setMeasurements(0, 0.1, 745, 2, 0);