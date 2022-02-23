<?php
declare(strict_types=1);

namespace Observer\WeatherStationPro\Domain;

class WeatherInfoType
{
    public const TEMPERATURE = 'temperature';
    public const HUMIDITY = 'humidity';
    public const PRESSURE = 'pressure';
    public const WIND_SPEED = 'wind_speed';
    public const WIND_DIRECTION = 'wind_direction';
}