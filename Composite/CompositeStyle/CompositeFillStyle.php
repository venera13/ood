<?php
declare(strict_types=1);

namespace Composite\CompositeStyle;

use Composite\Group\GroupInterface;
use Composite\Style\Domain\RGBAColor;
use Composite\Style\FillStyle;

class CompositeFillStyle
{
    /** @var GroupInterface */
    private $group;

    public function __construct(GroupInterface $group)
    {
        $this->group = $group;
    }

    public function getStyle(): ?FillStyle
    {
        $fillStyle = null;
        for ($i = 0; $i < $this->group->getShapesCount(); $i++)
        {
            $shape = $this->group->getShapesAtIndex($i);
            if ($fillStyle === null)
            {
                $fillStyle = $shape->getFillStyle();
            }
            elseif ($shape->getFillStyle() !== null)
            {
                $fillStyle = $fillStyle->getColor() == $shape->getFillStyle()->getColor()
                    ? $shape->getFillStyle()
                    : null;
            }
        }
        return $fillStyle;
    }

    public function setColor(RGBAColor $color): void
    {
        for ($i = 0; $i < $this->group->getShapesCount(); $i++)
        {
            $shape = $this->group->getShapesAtIndex($i);
            if ($shape->getFillStyle() === null)
            {
                $fillStyle = new FillStyle();
                $fillStyle->enable(true);
            }
            else
            {
                $fillStyle = $shape->getFillStyle();
            }
            $fillStyle->setColor($color);
            $shape->setFillStyle($fillStyle);
        }
    }
}