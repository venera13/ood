<?php
declare(strict_types=1);

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
        int $temperature,
        float $humidity,
        int $pressure,
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
                new WeatherDuoInfo(WeatherInfoType::TEMPERATURE, $this->getTemperature()),
                new WeatherDuoInfo(WeatherInfoType::HUMIDITY, $this->getHumidity()),
                new WeatherDuoInfo(WeatherInfoType::PRESSURE, $this->getPressure()),
            ])
        );
    }
}