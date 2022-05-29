<?php
declare(strict_types=1);

namespace MVC\Model;

class Model
{
    /** @var array */
    private $harmonics = [];

    /**
     * @param array $harmonics
     */
    public function setHarmonics(array $harmonics): void
    {
        $this->harmonics = $harmonics;
        $this->saveHarmonics($this->harmonics);
    }

    /**
     * @return array
     */
    public function getHarmonics(): array
    {
        if (count($this->harmonics) === 0)
        {
            $this->harmonics = file_exists('data.txt') ? unserialize(file_get_contents('data.txt')) : [];
        }

        return $this->harmonics;
    }

    public function changeHarmonic(int $index, string $key, string $value)
    {
        $harmonics = $this->getHarmonics();
        switch ($key)
        {
            case 'amplitude':
                $harmonics[$index]->setAmplitude((float)$value);
                break;
            case 'harmonic_type':
                $harmonics[$index]->setHarmonicType($value);
                break;
            case 'frequency':
                $harmonics[$index]->setFrequency((float)$value);
                break;
            case 'phase':
                $harmonics[$index]->setPhase((float)$value);
                break;
        }
        $this->saveHarmonics($harmonics);
    }

    public function getChart(): void
    {
        $canvas = new Canvas();
        $vars = $this->calculateHarmonics();
        $data = [
            'x' => $vars['x'],
            'y' => $vars['y']
        ];
        $canvas->drawChart($data);
    }

    public function addNewHarmonic(string $amplitude, string $harmonicType, string $frequency, string $phase): void
    {
        $harmonic = new Harmonic(
            $amplitude ? floatval($amplitude) : 1,
            $harmonicType ?? HarmonicType::SIN,
            $frequency ? floatval($frequency) : 1,
            $phase ? floatval($phase) : 0
        );
        $this->harmonics = $this->getHarmonics();
        $this->harmonics[] = $harmonic;
        $this->saveHarmonics($this->harmonics);
    }

    public function deleteHarmonic(int $index): void
    {
        $this->harmonics = $this->getHarmonics();
        array_splice($this->harmonics, $index, 1);
        $this->saveHarmonics($this->harmonics);
    }

    public function getNewHarmonic(?string $amplitude, ?string $harmonicType, ?string $frequency, ?string $phase): Harmonic
    {
        return new Harmonic(
            $amplitude ? floatval($amplitude) : 1,
            $harmonicType ?? HarmonicType::SIN,
            $frequency ? floatval($frequency) : 1,
            $phase ? floatval($phase) : 0
        );
    }

    private function calculateHarmonics(): array
    {
        $x = [];
        $y = [];
        for ($i = 0; $i < 4.5; $i += 0.5)
        {
            $x[] = $i;

            $yVal = 0;
            foreach ($this->getHarmonics() as $harmonic)
            {
                $yVal += $harmonic->calculateValue($i);
            }
            $y[] = $yVal;
        }

        return [
            'x' => $x,
            'y' => $y
        ];
    }

    private function saveHarmonics(array $harmonics): void
    {
        file_put_contents('data.txt', serialize($harmonics));
    }
}