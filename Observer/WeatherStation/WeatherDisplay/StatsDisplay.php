<?php
declare(strict_types=1);

/**
 * @template T
 */
class StatsDisplay implements ObserverInterface
{
    /** @var SensorStats[] */
    private $sensorStats = [];

    public function update(mixed $subject): void
    {
        $subjectType = $subject instanceof WeatherDataInside ? 'Inside' : 'Outside';
        print_r('Observable type ' . $subjectType . '</br>');
        print_r('----' . '</br>');

        $this->updateStatistics($subject);
        $this->printStatistics();
    }

    /**
     * @param mixed $subject
     */
    private function updateStatistics(mixed $subject): void
    {
        $data = $subject->getChangedData()->getList();
        foreach ($data as $currentObservableData)
        {
            if ($currentObservableData->getValue() !== null)
            {
                $this->updateSensorStats($subject, $currentObservableData);
            }
        }
    }

    private function updateSensorStats(mixed $subject, $observableData)
    {
        if (empty($this->sensorStats) || !$this->findSensorStats($subject, $observableData->getEventType()))
        {
            $calculator = $observableData->getEventType() === WeatherInfoType::WIND_DIRECTION ? new StatsWindDirectionCalculator() : new StatsCalculator();
            $this->sensorStats[] = new SensorStats(
                $observableData->getEventType(),
                $subject,
                $calculator
            );
        }
        foreach ($this->sensorStats as $sensorStats)
        {
            if ($sensorStats->getSensor() === $observableData->getEventType() && $sensorStats->getSubject() === $subject)
            {
                $sensorStats->getStatsCalculator()->update($observableData->getValue());
                break;
            }
        }
    }

    private function printStatistics(): void
    {
        foreach ($this->sensorStats as $sensorStats)
        {
            $this->printStatistic($sensorStats->getSensor(), $sensorStats->getStatsCalculator());
        }
    }

    /**
     * @param string $paramName
     * @param StatsCalculator|StatsWindDirectionCalculator $stats
     */
    private function printStatistic(string $paramName, StatsCalculator|StatsWindDirectionCalculator $stats): void
    {
        if (method_exists($stats, 'getMinValue')) print_r('Min ' . $paramName . ' ' . $stats->getMinValue() . '</br>');
        if (method_exists($stats, 'getMaxValue')) print_r('Max ' . $paramName . ' ' . $stats->getMaxValue() . '</br>');
        if (method_exists($stats, 'getAverage')) print_r('Average ' . $paramName . ' ' . $stats->getAverage() . '</br>');
        print_r('------------------</br>');
    }

    /**
     * @param mixed $subject
     * @param $eventType
     * @return SensorStats|null
     */
    private function findSensorStats(mixed $subject, $eventType): ?SensorStats
    {
        $result = null;
        foreach ($this->sensorStats as $sensorStats)
        {
            if ($sensorStats->getSensor() === $eventType && $sensorStats->getSubject() === $subject)
            {
                $result = $sensorStats;
            }
        }
        return $result;
    }
}