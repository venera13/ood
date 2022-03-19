<?php
declare(strict_types=1);

namespace Observer\WeatherStationPro\Data;

class WeatherInfo
{
    /** @var float|null */
    private $temperature;
    /** @var float|null */
    private $humidity;
    /** @var int|null */
    private $pressure;

    public function __construct(
        ?float $temperature = null,
        ?float $humidity = null,
        ?int $pressure = null
    ) {
        $this->temperature = $temperature;
        $this->humidity = $humidity;
        $this->pressure = $pressure;
    }

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
}