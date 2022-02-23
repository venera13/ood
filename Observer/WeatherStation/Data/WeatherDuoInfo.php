<?php
declare(strict_types=1);

class WeatherDuoInfo
{
    /** @var float */
    private $temperature;
    /** @var float */
    private $humidity;
    /** @var int */
    private $pressure;
    /** @var float */
    private $windSpeed;
    /** @var int */
    private $windDirection;

    public function __construct(
        float $temperature,
        float $humidity,
        int $pressure,
        float $windSpeed,
        int $windDirection
    ) {
        $this->temperature = $temperature;
        $this->humidity = $humidity;
        $this->pressure = $pressure;
        $this->windSpeed = $windSpeed;
        $this->windDirection = $windDirection;
    }

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
}