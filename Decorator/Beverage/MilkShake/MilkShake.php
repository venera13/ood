<?php
declare(strict_types=1);

namespace Decorator\Beverage\Milkshake;

use Decorator\Beverage\BeverageInterface;
use Decorator\Domain\MilkShakePortionTypes;

class MilkShake implements BeverageInterface
{
    /** @var string */
    private $portion;

    public function __construct(?string $portion = MilkShakePortionTypes::STANDARD)
    {
        $this->portion = $portion;
    }

    public function getDescription(): string
    {
        $description = 'milk shake';
        return ucfirst($this->portion !== MilkShakePortionTypes::STANDARD ? $this->portion . ' ' . $description : $description);
    }

    public function getCost(): int
    {
        switch ($this->portion)
        {
            case MilkShakePortionTypes::SMALL:
                return 50;
            case MilkShakePortionTypes::BIG:
                return 80;
            case MilkShakePortionTypes::STANDARD:
            default:
                return 60;
        }
    }
}