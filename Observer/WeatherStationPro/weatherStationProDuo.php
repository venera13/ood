<?php
declare(strict_types=1);

include 'Utils/Arrays.php';
include 'Data/WeatherInfo.php';
include 'Data/WeatherInfoPro.php';
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
include 'WeatherDisplay/Display.php';
include 'WeatherDisplay/StatsDisplay.php';
include 'WeatherDisplay/ProDisplay.php';
include 'WeatherDisplay/StatsProDisplay.php';
include 'WeatherDisplay/StatsCalculator.php';
include 'WeatherDisplay/StatsWindDirectionCalculator.php';

use Observer\WeatherStationPro\WeatherData\WeatherData;
use Observer\WeatherStationPro\WeatherDisplay\Display;
use Observer\WeatherStationPro\WeatherDisplay\StatsDisplay;
use Observer\WeatherStationPro\WeatherDisplay\ProDisplay;
use Observer\WeatherStationPro\WeatherDisplay\StatsProDisplay;
use Observer\WeatherStationPro\Domain\WeatherInfoType;
use Observer\WeatherStationPro\WeatherData\WeatherDataPro;

$weatherDataIn = new WeatherData();
$weatherDataOut = new WeatherDataPro();

$display = new Display();
$display->setObservable('Inside', $weatherDataIn);
$display->setObservable('Outside', $weatherDataOut);

$statsDisplay = new StatsDisplay();
$statsDisplay->setObservable('Inside', $weatherDataIn);
$statsDisplay->setObservable('Outside', $weatherDataOut);

$weatherDataIn->registerObserver($display);
$weatherDataIn->registerObserver($statsDisplay);

$weatherDataIn->addEventListener($display, WeatherInfoType::TEMPERATURE);
$weatherDataIn->addEventListener($display, WeatherInfoType::PRESSURE);
//$weatherDataIn->addEventListener($statsDisplay, WeatherInfoType::TEMPERATURE);

$weatherDataIn->setMeasurements(20, 20, 20);

//$proDisplay = new ProDisplay();
//$proDisplay->setObservable('Inside', $weatherDataIn);
//$proDisplay->setObservable('Outside', $weatherDataOut);
//
//$statsProDisplay = new StatsProDisplay();
//$statsDisplay->setObservable('Inside', $weatherDataIn);
//$statsDisplay->setObservable('Outside', $weatherDataOut);
//
//$weatherDataOut->registerObserver($proDisplay);
//$weatherDataOut->registerObserver($statsProDisplay);
//$weatherDataOut->addEventListener($proDisplay, WeatherInfoType::TEMPERATURE);
//$weatherDataOut->addEventListener($proDisplay, WeatherInfoType::PRESSURE);
//$weatherDataOut->addEventListener($statsProDisplay, WeatherInfoType::TEMPERATURE);
//
//$weatherDataOut->setMeasurements(20, null, null, null, 50);

//$weatherDataIn->removeEventListener($display, WeatherInfoType::TEMPERATURE);
//$weatherDataIn->removeEventListener($display, WeatherInfoType::PRESSURE);

//$weatherDataIn->setMeasurements(22, 0.5, 750);

//$weatherDataIn->setMeasurements(6, 0.9, 750, 10, 1);
//$weatherDataOut->setMeasurements(5, 0.9, 750, 10, 1);
//$weatherDataOut->setMeasurements(10, 0.5, 754, 5, 359);