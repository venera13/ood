<?php
declare(strict_types=1);

namespace Composite\CompositeStyle;

use Composite\Group\GroupInterface;
use Composite\Style\Domain\RGBAColor;
use Composite\Style\LineStyle;

class CompositeLineStyle
{
    /** @var GroupInterface */
    private $group;

    public function __construct(GroupInterface $group)
    {
        $this->group = $group;
    }

    public function getStyle(): ?LineStyle
    {
        $lineStyle = null;
        for ($i = 0; $i < $this->group->getShapesCount(); $i++)
        {
            $shape = $this->group->getShapesAtIndex($i);
            if ($lineStyle === null)
            {
                $lineStyle = $shape->getLineStyle();
            }
            elseif ($shape->getLineStyle() !== null)
            {
                $lineStyle = $lineStyle->getColor() == $shape->getLineStyle()->getColor()
                    ? $shape->getLineStyle()
                    : null;
            }
        }
        return $lineStyle;
    }

    public function setColor(RGBAColor $color): void
    {
        for ($i = 0; $i < $this->group->getShapesCount(); $i++)
        {
            $shape = $this->group->getShapesAtIndex($i);
            if ($shape->getLineStyle() === null)
            {
                $lineStyle = new LineStyle();
                $lineStyle->enable(true);
            }
            else
            {
                $lineStyle = $shape->getLineStyle();
            }
            $lineStyle->setColor($color);
            $shape->setLineStyle($lineStyle);
        }
    }
}