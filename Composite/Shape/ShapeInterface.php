<?php
declare(strict_types=1);

namespace Composite\Shape;

use Composite\Canvas\CanvasInterface;
use Composite\Group\GroupInterface;
use Composite\Shape\Domain\Rect;
use Composite\Style\FillStyle;
use Composite\Style\LineStyle;
use Composite\Style\StyleInterface;

interface ShapeInterface
{
    /**
     * @param CanvasInterface $canvas
     */
    public function draw(CanvasInterface $canvas): void;

    /**
     * @return Rect
     */
    public function getFrame(): Rect;

    /**
     * @param Rect $rect
     */
    public function setFrame(Rect $rect): void;

    /**
     * @param LineStyle $style
     */
    public function setLineStyle(LineStyle $style): void;

    /**
     * @return StyleInterface|null
     */
    public function getLineStyle(): ?StyleInterface;

    /**
     * @param FillStyle $style
     */
    public function setFillStyle(FillStyle $style): void;

    /**
     * @return StyleInterface|null
     */
    public function getFillStyle(): ?StyleInterface;

    /**
     * @return GroupInterface|null
     */
    public function getGroup(): ?GroupInterface;
}