<?php
declare(strict_types=1);

/**
 * @template T
 */
interface ObserverInterface
{
    /**
     * @param ObservableInterface $subject
     */
    public function update(ObservableInterface $subject): void;
}