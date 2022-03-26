<?php
declare(strict_types=1);

namespace Observer\WeatherStationPro\WeatherData;

use Observer\WeatherStationPro\Domain\WeatherInfoType;
use Observer\WeatherStationPro\Observable\Observable;
use Observer\WeatherStationPro\Data\WeatherDuoData;
use Observer\WeatherStationPro\Utils\Arrays;

class WeatherDataPro extends Observable
{
    /** @var float */
    private $temperature = 0.0;
    /** @var float */
    private $humidity = 0.0;
    /** @var int */
    private $pressure = 750;
    /** @var float */
    private $windSpeed = 0.0;
    /** @var int */
    private $windDirection = 0;

    /**
     * @return float|null
     */
    public function getTemperature(): ?float
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

    /**
     * @return float|null
     */
    public function getWindSpeed(): ?float
    {
        return $this->windSpeed;
    }

    /**
     * @return int|null
     */
    public function getWindDirection(): ?int
    {
        return $this->windDirection;
    }

    public function measurementsChanged(): void
    {
        $this->notifyObservers();
    }

    public function setMeasurements(
        ?int $temperature,
        ?float $humidity,
        ?int $pressure,
        ?float $windSpeed,
        ?int $windDirection,
    ): void {
        $this->temperature = $temperature;
        $this->humidity = $humidity;
        $this->pressure = $pressure;
        $this->windSpeed = $windSpeed;
        $this->windDirection = $windDirection;

        $this->measurementsChanged();
    }

    public function getChangedData(): array
    {
        return Arrays::removeNulls([
            $this->getTemperature() !== null ? new WeatherDuoData(WeatherInfoType::TEMPERATURE, $this->getTemperature()) : null,
            $this->getHumidity() !== null ? new WeatherDuoData(WeatherInfoType::HUMIDITY, $this->getHumidity()) : null,
            $this->getPressure() !== null ? new WeatherDuoData(WeatherInfoType::PRESSURE, $this->getPressure()) : null,
            $this->getWindSpeed() !== null ? new WeatherDuoData(WeatherInfoType::WIND_SPEED, $this->getWindSpeed()) : null,
            $this->getWindDirection() !== null ? new WeatherDuoData(WeatherInfoType::WIND_DIRECTION, $this->getWindDirection()) : null,
        ]);
    }
}