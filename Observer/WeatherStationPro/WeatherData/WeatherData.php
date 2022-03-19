<?php
declare(strict_types=1);

namespace Observer\WeatherStationPro\WeatherData;

use Observer\WeatherStationPro\Data\WeatherDuoInfoList;
use Observer\WeatherStationPro\Domain\WeatherInfoType;
use Observer\WeatherStationPro\Observable\Observable;
use Observer\WeatherStationPro\Data\WeatherDuoInfo;
use Observer\WeatherStationPro\Utils\Arrays;

class WeatherData extends Observable
{
    /** @var float */
    private $temperature = 0.0;
    /** @var float */
    private $humidity = 0.0;
    /** @var int */
    private $pressure = 750;

    /**
     * @return float
     */
    public function getTemperature(): float
    {
        return $this->temperature;
    }

    /**
     * @return float|null
     */
    public function getHumidity(): ?float
    {
        return $this->humidity;
    }

    /**
     * @return int|null
     */
    public function getPressure(): ?int
    {
        return $this->pressure;
    }

    public function measurementsChanged(): void
    {
        $this->notifyObservers();
    }

    public function setMeasurements(
        ?int $temperature = null,
        ?float $humidity = null,
        ?int $pressure = null,
    ): void {
        $this->temperature = $temperature;
        $this->humidity = $humidity;
        $this->pressure = $pressure;

        $this->measurementsChanged();
    }

    public function getChangedData(): WeatherDuoInfoList
    {
        return new WeatherDuoInfoList(
            Arrays::removeNulls([
                $this->getTemperature() ? new WeatherDuoInfo(WeatherInfoType::TEMPERATURE, $this->getTemperature()) : null,
                $this->getHumidity() ? new WeatherDuoInfo(WeatherInfoType::HUMIDITY, $this->getHumidity()) : null,
                $this->getPressure() ? new WeatherDuoInfo(WeatherInfoType::PRESSURE, $this->getPressure()) : null,
            ])
        );
    }
}