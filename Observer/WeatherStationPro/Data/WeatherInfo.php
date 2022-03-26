<?php
declare(strict_types=1);

namespace Observer\WeatherStationPro\Data;

class WeatherInfo
{
    /** @var WeatherDuoData|null */
    private $temperature;
    /** @var WeatherDuoData|null */
    private $humidity;
    /** @var WeatherDuoData|null */
    private $pressure;

    public function __construct(
        ?WeatherDuoData $temperature = null,
        ?WeatherDuoData $humidity = null,
        ?WeatherDuoData $pressure = null
    ) {
        $this->temperature = $temperature;
        $this->humidity = $humidity;
        $this->pressure = $pressure;
    }

    /**
     * @return WeatherDuoData|null
     */
    public function getTemperature(): ?WeatherDuoData
    {
        return $this->temperature;
    }

    /**
     * @return WeatherDuoData|null
     */
    public function getHumidity(): ?WeatherDuoData
    {
        return $this->humidity;
    }

    /**
     * @return WeatherDuoData|null
     */
    public function getPressure(): ?WeatherDuoData
    {
        return $this->pressure;
    }
}