<?php
declare(strict_types=1);

namespace Observer\WeatherStationPro\WeatherData;

use Observer\WeatherStationPro\Data\WeatherInfo;
use Observer\WeatherStationPro\Event\WeatherInfoEvent;
use Observer\WeatherStationPro\Observable\Observable;
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
        $changeEvents = Arrays::removeNulls([
            $this->getTemperature() !== null ? new WeatherInfoEvent(WeatherInfoEvent::TEMPERATURE) : null,
            $this->getHumidity() !== null ? new WeatherInfoEvent(WeatherInfoEvent::HUMIDITY) : null,
            $this->getPressure() !== null ? new WeatherInfoEvent(WeatherInfoEvent::PRESSURE) : null,
        ]);
        $this->notifyObservers($changeEvents);
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

    public function getChangedData(): WeatherInfo
    {
        return new WeatherInfo(
            $this->getTemperature(),
            $this->getHumidity(),
            $this->getPressure()
        );
    }
}