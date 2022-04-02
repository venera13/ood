<?php
declare(strict_types=1);

namespace Observer\WeatherStationPro\Event;

class Event
{
    /** @var string */
    private $type;

    public function __construct(string $type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
}