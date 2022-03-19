<?php
declare(strict_types=1);

include 'Utils/Arrays.php';
include 'Data/WeatherInfo.php';
include 'Data/WeatherDuoInfo.php';
include 'Data/ObserverData.php';
include 'Data/WeatherDuoInfoList.php';
include 'Data/SensorStats.php';
include 'Data/ObservableData.php';
include 'Domain/WeatherInfoType.php';
include 'Observable/ObservableInterface.php';
include 'Observable/Observable.php';
include 'Observer/ObserverInterface.php';
include 'WeatherData/WeatherData.php';
include 'WeatherData/WeatherDataPro.php';
include 'WeatherData/WeatherDataInside.php';
include 'WeatherData/WeatherDataOutside.php';
include 'WeatherDisplay/Display.php';
include 'WeatherDisplay/StatsDisplay.php';
include 'WeatherDisplay/ProDisplay.php';
include 'WeatherDisplay/StatsProDisplay.php';
include 'WeatherDisplay/StatsCalculator.php';
include 'WeatherDisplay/StatsWindDirectionCalculator.php';

$weatherDataIn = new WeatherData();
$weatherDataOut = new WeatherDataPro();

$display = new Display();
$display->setObservable('Inside', $weatherDataIn);
$display->setObservable('Outside', $weatherDataOut);

$weatherDataIn->registerObserver($display, 1);
$weatherDataOut->registerObserver($display, 1);

$statsDisplay = new StatsDisplay();
$statsDisplay->setObservable('Inside', $weatherDataIn);
$statsDisplay->setObservable('Outside', $weatherDataOut);

$weatherDataIn->registerObserver($statsDisplay, 2);
$weatherDataOut->registerObserver($statsDisplay, 2);

$weatherDataIn->setMeasurements(5, 0.9, 750);
$weatherDataOut->setMeasurements(10, 0.5, 754, 5, 5);

$weatherDataIn->removeObserver($statsDisplay);

$weatherDataIn->setMeasurements(-10, 1, 750);
$weatherDataOut->setMeasurements(0, 0.1, 745, 0, 5);