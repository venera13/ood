<?php
declare(strict_types=1);

class MilkShake implements BeverageInterface
{
    /** @var string */
    private $portion;

    public function __construct(?string $portion = MilkShakePortionType::STANDARD)
    {
        $this->portion = $portion;
    }

    public function getDescription(): string
    {
        $description = 'milk shake';
        return ucfirst($this->portion !== MilkShakePortionType::STANDARD ? $this->portion . ' ' . $description : $description);
    }

    public function getCost(): int
    {
        switch ($this->portion)
        {
            case MilkShakePortionType::SMALL:
                return 50;
            case MilkShakePortionType::BIG:
                return 80;
            case MilkShakePortionType::STANDARD:
            default:
                return 60;
        }
    }
}