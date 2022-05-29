<?php
declare(strict_types=1);

namespace MVC\View;

use MVC\Model\Harmonic;
use MVC\Model\HarmonicType;

class AddNewHarmonicView
{
    public function render(Harmonic $harmonic): void
    {
        $params = $this->parseParams($harmonic);
        include('templates/add_new_harmonic.php');
    }

    private function parseParams(Harmonic $harmonic): array
    {
        return [
            'harmonic' => $harmonic->getAmplitude() . '*' . $harmonic->getHarmonicType() . '(' . $harmonic->getFrequency() . '*x+' . $harmonic->getPhase() . ')',
            'harmonic_value' => [
                'amplitude' => $harmonic->getAmplitude(),
                'harmonic_type' => $harmonic->getHarmonicType(),
                'frequency' => $harmonic->getFrequency(),
                'phase' => $harmonic->getPhase(),
            ]
        ];
    }
}