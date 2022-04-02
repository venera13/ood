<?php
declare(strict_types=1);

namespace Observer\WeatherStationPro\Event;

class WeatherInfoEvent extends Event
{
    public const TEMPERATURE_CHANGED = 'temperature';
    public const HUMIDITY_CHANGED = 'humidity';
    public const PRESSURE_CHANGED = 'pressure';
    public const WIND_SPEED_CHANGED = 'wind_speed';
    public const WIND_DIRECTION_CHANGED = 'wind_direction';
}