<?php
declare(strict_types=1);

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
     * @return float
     */
    public function getTemperature(): float
    {
        return $this->temperature;
    }

    /**
     * @return float
     */
    public function getHumidity(): float
    {
        return $this->humidity;
    }

    /**
     * @return int
     */
    public function getPressure(): int
    {
        return $this->pressure;
    }

    /**
     * @return float
     */
    public function getWindSpeed(): float
    {
        return $this->windSpeed;
    }

    /**
     * @return int
     */
    public function getWindDirection(): int
    {
        return $this->windDirection;
    }

    public function measurementsChanged(): void
    {
        $this->notifyObservers();
    }

    public function setMeasurements(
        int $temperature,
        float $humidity,
        int $pressure,
        float $windSpeed,
        int $windDirection,
    ): void {
        $this->temperature = $temperature;
        $this->humidity = $humidity;
        $this->pressure = $pressure;
        $this->windSpeed = $windSpeed;
        $this->windDirection = $windDirection;

        $this->measurementsChanged();
    }

    public function getChangedData(): WeatherDuoInfo
    {
        return new WeatherDuoInfo(
            $this->getTemperature(),
            $this->getHumidity(),
            $this->getPressure(),
            $this->getWindSpeed(),
            $this->getWindDirection()
        );
    }
}