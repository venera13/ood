<?php
declare(strict_types=1);

include 'Utils/Arrays.php';
include 'Data/WeatherInfo.php';
include 'Data/WeatherDuoInfo.php';
include 'Data/ObserverData.php';
include 'Data/WeatherDuoInfoList.php';
include 'Domain/WeatherInfoType.php';
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

use Observer\WeatherStationPro\Domain\WeatherInfoType;
use Observer\WeatherStationPro\WeatherData\WeatherDataInside;
use Observer\WeatherStationPro\WeatherData\WeatherDataOutside;
use Observer\WeatherStationPro\WeatherDisplay\Display;
use Observer\WeatherStationPro\WeatherDisplay\StatsDisplay;

$weatherDataIn = new WeatherDataInside();
$weatherDataOut = new WeatherDataOutside();

$display = new Display();
$statsDisplay = new StatsDisplay();
$weatherDataIn->registerObserver($display);
//$weatherDataIn->registerObserver($statsDisplay);
//$weatherDataIn->addEventListener($display, WeatherInfoType::TEMPERATURE);
$weatherDataIn->addEventListener($display, WeatherInfoType::PRESSURE);

//$proDisplay = new ProDisplay();
//$statsProDisplay = new StatsProDisplay();
//$weatherDataOut->registerObserver($proDisplay);
//$weatherDataOut->registerObserver($statsProDisplay);

$weatherDataIn->setMeasurements(20);

$weatherDataIn->removeEventListener($display, WeatherInfoType::TEMPERATURE);
$weatherDataIn->removeEventListener($display, WeatherInfoType::PRESSURE);

$weatherDataIn->setMeasurements(22, 0.5, 750);

//$weatherDataIn->setMeasurements(6, 0.9, 750, 10, 1);
//$weatherDataOut->setMeasurements(5, 0.9, 750, 10, 1);
//$weatherDataOut->setMeasurements(10, 0.5, 754, 5, 359);