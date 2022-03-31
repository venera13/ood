<?php
declare(strict_types=1);

include 'Utils/Arrays.php';
include 'Data/WeatherInfo.php';
include 'Data/WeatherInfoPro.php';
include 'Data/WeatherDuoData.php';
include 'Data/ObserverData.php';
include 'Data/SensorStats.php';
include 'Data/ObservableData.php';
include 'Domain/WeatherInfoType.php';
include 'Observable/ObservableInterface.php';
include 'Observable/Observable.php';
include 'Observer/ObserverInterface.php';
include 'WeatherData/WeatherData.php';
include 'WeatherData/WeatherDataPro.php';
include 'WeatherDisplay/StatsDisplay.php';
include 'WeatherDisplay/StatsCalculator.php';
include 'WeatherDisplay/StatsWindDirectionCalculator.php';

use Observer\WeatherStationPro\WeatherData\WeatherData;
use Observer\WeatherStationPro\WeatherDisplay\StatsDisplay;
use Observer\WeatherStationPro\Domain\WeatherInfoType;
use Observer\WeatherStationPro\WeatherData\WeatherDataPro;

$weatherDataIn = new WeatherData();
$weatherDataOut = new WeatherDataPro();

$display = new StatsDisplay($weatherDataIn, $weatherDataOut);
$weatherDataIn->registerObserver(WeatherInfoType::TEMPERATURE, $display);
$weatherDataIn->registerObserver(WeatherInfoType::HUMIDITY, $display);
$weatherDataOut->registerObserver(WeatherInfoType::PRESSURE, $display);

$weatherDataIn->setMeasurements(5, 0.9, 750);

$weatherDataIn->removeObserver($display, WeatherInfoType::TEMPERATURE);

$weatherDataIn->setMeasurements(10, 0.5, 754);

$weatherDataOut->setMeasurements(-10, 1, 750, 5, 270);
$weatherDataOut->setMeasurements(0, 0.1, 745, 2, 0);