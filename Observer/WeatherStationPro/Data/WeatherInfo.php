<?php
declare(strict_types=1);

namespace Observer\WeatherStationPro\Data;

class WeatherInfo
{
    /** @var float */
    private $temperature;
    /** @var float */
    private $humidity;
    /** @var int */
    private $pressure;

    public function __construct(float $temperature, float $humidity, int $pressure)
    {
        $this->temperature = $temperature;
        $this->humidity = $humidity;
        $this->pressure = $pressure;
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
}