<?php
declare(strict_types=1);

namespace State\GumballMachine;

interface GumballMachineInterface
{
    public function ejectQuarter(): void;

    public function insertQuarter(): void;

    public function refill(int $numBalls): void;

    public function turnCrank(): void;

    public function toString(): void;
}