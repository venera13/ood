<?php
declare(strict_types=1);

namespace Observer\WeatherStationPro\Data;

class WeatherDuoInfo
{
    /** @var string */
    private $eventType;
    /** @var float|null */
    private $value;

    public function __construct(string $eventType, ?float $value)
    {
        $this->eventType = $eventType;
        $this->value = $value;
    }

    /**
     * @return string
     */
    public function getEventType(): string
    {
        return $this->eventType;
    }

    /**
     * @return float|null
     */
    public function getValue(): ?float
    {
        return $this->value;
    }
}