<?php
declare(strict_types=1);

namespace Observer\WeatherStationPro\WeatherData;

use Observer\WeatherStationPro\Data\WeatherInfoPro;
use Observer\WeatherStationPro\Event\WeatherInfoEvent;
use Observer\WeatherStationPro\Observable\Observable;
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
        $changeEvents = Arrays::removeNulls([
            $this->getTemperature() !== null ? new WeatherInfoEvent(WeatherInfoEvent::TEMPERATURE) : null,
            $this->getHumidity() !== null ? new WeatherInfoEvent(WeatherInfoEvent::HUMIDITY) : null,
            $this->getPressure() !== null ? new WeatherInfoEvent(WeatherInfoEvent::PRESSURE) : null,
            $this->getWindSpeed() !== null ? new WeatherInfoEvent(WeatherInfoEvent::WIND_SPEED) : null,
            $this->getWindDirection() !== null ? new WeatherInfoEvent(WeatherInfoEvent::WIND_DIRECTION) : null,
        ]);
        $this->notifyObservers($changeEvents);
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

    public function getChangedData(): WeatherInfoPro
    {
        return new WeatherInfoPro(
            $this->getTemperature(),
            $this->getHumidity(),
            $this->getPressure(),
            $this->getWindSpeed(),
            $this->getWindDirection(),
        );
    }
}