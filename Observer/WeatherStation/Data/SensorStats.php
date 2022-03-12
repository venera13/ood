<?php
declare(strict_types=1);

class SensorStats
{
    /** @var string */
    private $sensor;
    /** @var ObservableInterface */
    private $subject;
    /** @var StatsCalculator|StatsWindDirectionCalculator */
    private $statsCalculator;

    public function __construct(string $sensor, ObservableInterface $subject, StatsCalculator|StatsWindDirectionCalculator $statsCalculator)
    {
        $this->sensor = $sensor;
        $this->subject = $subject;
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
     * @return ObservableInterface
     */
    public function getSubject(): ObservableInterface
    {
        return $this->subject;
    }

    /**
     * @return StatsCalculator|StatsWindDirectionCalculator
     */
    public function getStatsCalculator(): StatsWindDirectionCalculator|StatsCalculator
    {
        return $this->statsCalculator;
    }
}