<?php
declare(strict_types=1);

include 'Utils/Arrays.php';
include 'Data/WeatherInfo.php';
include 'Data/WeatherDuoInfo.php';
include 'Data/ObserverData.php';
include 'Data/WeatherDuoInfoList.php';
include 'Data/SensorStats.php';
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

$weatherDataIn = new WeatherDataInside();
$weatherDataOut = new WeatherDataOutside();

$display = new StatsDisplay();
$weatherDataIn->registerObserver($display);
$weatherDataOut->registerObserver($display);

$weatherDataIn->setMeasurements(5, 0.9, 750);
$weatherDataIn->setMeasurements(10, 0.5, 754);

$weatherDataOut->setMeasurements(-10, 1, 750, 5, 270);
$weatherDataOut->setMeasurements(0, 0.1, 745, 2, 0);