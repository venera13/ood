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
    /** @var float|null */
    private $windSpeed = null;
    /** @var int|null */
    private $windDirection = null;

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
        int $temperature,
        ?float $humidity = null,
        ?int $pressure = null,
        ?float $windSpeed = null,
        ?int $windDirection = null,
    ): void {
        $this->temperature = $temperature;
        $this->humidity = $humidity;
        $this->pressure = $pressure;
        $this->windSpeed = $windSpeed;
        $this->windDirection = $windDirection;

        $this->measurementsChanged();
    }

    public function getChangedData(): WeatherDuoInfoList
    {
        return new WeatherDuoInfoList(
            [
                new WeatherDuoInfo(WeatherInfoType::TEMPERATURE, $this->getTemperature()),
                new WeatherDuoInfo(WeatherInfoType::HUMIDITY, $this->getHumidity()),
                new WeatherDuoInfo(WeatherInfoType::PRESSURE, $this->getPressure()),
                new WeatherDuoInfo(WeatherInfoType::WIND_SPEED, $this->getWindSpeed()),
                new WeatherDuoInfo(WeatherInfoType::WIND_DIRECTION, $this->getWindDirection()),
            ]
        );
    }
}