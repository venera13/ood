<?php
declare(strict_types=1);

namespace Observer\WeatherStationPro\Data;

class WeatherInfoPro
{
    /** @var WeatherDuoData|null */
    private $temperature;
    /** @var WeatherDuoData|null */
    private $humidity;
    /** @var WeatherDuoData|null */
    private $pressure;
    /** @var WeatherDuoData|null */
    private $windSpeed;
    /** @var WeatherDuoData|null */
    private $windDirection;

    public function __construct(
        ?WeatherDuoData $temperature,
        ?WeatherDuoData $humidity,
        ?WeatherDuoData $pressure,
        ?WeatherDuoData $windSpeed,
        ?WeatherDuoData $windDirection
    ) {
        $this->temperature = $temperature;
        $this->humidity = $humidity;
        $this->pressure = $pressure;
        $this->windSpeed = $windSpeed;
        $this->windDirection = $windDirection;
    }

    /**
     * @return WeatherDuoData
     */
    public function getTemperature(): WeatherDuoData
    {
        return $this->temperature;
    }

    /**
     * @return WeatherDuoData
     */
    public function getHumidity(): WeatherDuoData
    {
        return $this->humidity;
    }

    /**
     * @return WeatherDuoData
     */
    public function getPressure(): WeatherDuoData
    {
        return $this->pressure;
    }

    /**
     * @return WeatherDuoData
     */
    public function getWindSpeed(): WeatherDuoData
    {
        return $this->windSpeed;
    }

    /**
     * @return WeatherDuoData
     */
    public function getWindDirection(): WeatherDuoData
    {
        return $this->windDirection;
    }
}