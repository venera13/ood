<?php
declare(strict_types=1);

namespace State\GumballMachine;

interface GumballMachineInterface
{
    public function releaseBall(): void;

    /**
     * @return int
     */
    public function getBallCount(): int;

    public function setSoldOutState(): void;

    public function setNoQuarterState(): void;

    public function setSoldState(): void;

    public function setHasQuarterState(): void;
}