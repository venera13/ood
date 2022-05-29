<?php
declare(strict_types=1);

namespace MVC\View;

use MVC\Model\Harmonic;
use MVC\Model\HarmonicType;

class ChartDrawerView
{
    public function render(array $parameters): void
    {
        $params = $this->parseParams($parameters);
        include('templates/chart_drawer.php');
    }

    private function parseParams(array $parameters): array
    {
        if (count($parameters['harmonics']) === 0)
        {
            return [];
        }
        $active = $parameters['active'] ?? 0;
        $activeShow = $parameters['active_show'] ?? 'chart';
        $params = [
            'harmonics' => $this->parseHarmonics($parameters['harmonics']),
            'harmonic_value' => $this->parseHarmonicInfo($parameters['harmonics'][$active]),
            'active' => $active,
            'active_show' => $activeShow,
            'table_params' => $parameters['table_params'] ?? []
        ];
        return $params;
    }

    private function parseHarmonics(array $harmonicsArray): array
    {
        $harmonics = [];
        foreach ($harmonicsArray as $harmonic)
        {
            $harmonics[] = $harmonic->getAmplitude() . '*' . $harmonic->getHarmonicType() . '(' . $harmonic->getFrequency() . '*x+' . $harmonic->getPhase() . ')';
        }

        return $harmonics;
    }

    private function parseHarmonicInfo(Harmonic $harmonic): array
    {
        return [
            'amplitude' => $harmonic->getAmplitude(),
            'is_sin' => $harmonic->getHarmonicType() === HarmonicType::SIN,
            'is_cos' => $harmonic->getHarmonicType() === HarmonicType::COS,
            'frequency' => $harmonic->getFrequency(),
            'phase' => $harmonic->getPhase(),
        ];
    }
}