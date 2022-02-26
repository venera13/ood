<?php
declare(strict_types=1);

include 'Data/WeatherDuoInfo.php';
include 'Data/WeatherDuoInfoList.php';
include 'Data/ObserverData.php';
include 'Domain/ObservableType.php';
include 'Domain/WeatherInfoType.php';
include 'Observable/ObservableInterface.php';
include 'Observable/Observable.php';
include 'Observer/ObserverInterface.php';
include 'WeatherData/WeatherDataPro.php';
include 'WeatherDisplay/ProDisplay.php';
include 'WeatherDisplay/StatsProDisplay.php';
include 'WeatherDisplay/StatsCalculator.php';
include 'WeatherDisplay/StatsWindDirectionCalculator.php';

use Observer\WeatherStationPro\Domain\WeatherInfoType;
use Observer\WeatherStationPro\WeatherData\WeatherDataPro;
use Observer\WeatherStationPro\WeatherDisplay\ProDisplay;
use Observer\WeatherStationPro\WeatherDisplay\StatsProDisplay;

$weatherData = new WeatherDataPro();

$display = new ProDisplay();
$display->setEventListener(WeatherInfoType::TEMPERATURE);
$display->setEventListener(WeatherInfoType::WIND_DIRECTION);
$weatherData->registerObserver($display);

$statsDisplay = new StatsProDisplay();
$statsDisplay->setEventListener(WeatherInfoType::TEMPERATURE);
$statsDisplay->setEventListener(WeatherInfoType::WIND_DIRECTION);
$weatherData->registerObserver($statsDisplay);

$weatherData->setMeasurements(5, 0.9, 750, 10, 1);
$weatherData->setMeasurements(10, 0.5, 754, 5, 359);

$display->removeEventListener(WeatherInfoType::TEMPERATURE);
$statsDisplay->removeEventListener(WeatherInfoType::TEMPERATURE);

$weatherData->setMeasurements(-10, 1, 750, 5, 270);