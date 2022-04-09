<?php

namespace Observer\WeatherStationPro\Event;

interface EventInterface
{
    public function getType(): string;
}