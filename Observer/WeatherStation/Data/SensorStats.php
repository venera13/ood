<?php
declare(strict_types=1);

class SensorStats
{
    /** @var string */
    private $sensor;
    /** @var StatsCalculator|StatsWindDirectionCalculator */
    private $statsCalculator;

    public function __construct(string $sensor, StatsCalculator|StatsWindDirectionCalculator $statsCalculator)
    {
        $this->sensor = $sensor;
        $this->statsCalculator = $statsCalculator;
    }

    /**
     * @return string
     */
    public function getSensor(): string
    {
        return $this->sensor;
    }

    /**
     * @return StatsCalculator|StatsWindDirectionCalculator
     */
    public function getStatsCalculator(): StatsWindDirectionCalculator|StatsCalculator
    {
        return $this->statsCalculator;
    }
}