<?php
declare(strict_types=1);

include 'Data/WeatherInfo.php';
include 'Data/WeatherDuoInfo.php';
include 'Data/ObserverData.php';
include 'Domain/ObservableType.php';
include 'Observable/ObservableInterface.php';
include 'Observable/Observable.php';
include 'Observer/ObserverInterface.php';
include 'WeatherData/WeatherData.php';
include 'WeatherData/WeatherDataPro.php';
include 'WeatherDisplay/Display.php';
include 'WeatherDisplay/StatsDisplay.php';
include 'WeatherDisplay/ProDisplay.php';
include 'WeatherDisplay/StatsProDisplay.php';
include 'WeatherDisplay/StatsCalculatorInterface.php';
include 'WeatherDisplay/StatsCalculator.php';
include 'WeatherDisplay/StatsWindDirectionCalculator.php';

$weatherDataIn = new WeatherData();
$weatherDataIn->setType(ObservableType::INSIDE);

$weatherDataOut = new WeatherDataPro();
$weatherDataOut->setType(ObservableType::OUTSIDE);

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

$weatherDataOut->setMeasurements(5, 0.9, 750, 10, 1);
$weatherDataOut->setMeasurements(10, 0.5, 754, 5, 359);