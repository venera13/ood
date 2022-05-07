<?php
declare(strict_types=1);

namespace Composite\Tests;

include '../Domain/Point.php';
include '../Canvas/CanvasInterface.php';
include '../Canvas/Canvas.php';
include '../Shape/Domain/Rect.php';
include '../Shape/ShapeInterface.php';
include '../Shape/Shape.php';
include '../Shape/Ellipse.php';
include '../Shape/Rectangle.php';
include '../Shape/Triangle.php';
include '../Group/GroupInterface.php';
include '../Group/Group.php';
include '../Style/Domain/RGBAColor.php';
include '../Style/StyleInterface.php';
include '../Style/FillStyle.php';
include '../Style/LineStyle.php';
include '../CompositeStyle/CompositeLineStyle.php';
include '../CompositeStyle/CompositeFillStyle.php';
include '../Exceptions/InvalidArgumentsException.php';

use Composite\Domain\Point\Point;
use Composite\Group\Group;
use Composite\Shape\Domain\Rect;
use Composite\Shape\Rectangle;
use Composite\Shape\Triangle;
use Composite\Style\Domain\RGBAColor;
use Composite\Style\FillStyle;
use Composite\Style\LineStyle;
use PHPUnit\Framework\TestCase;

class Tests extends TestCase
{
    public function testShapeFillColor(): void
    {
        $shape = new Rectangle(new Point(500, 800), new Point(1100, 1200));
        $shape->setFillStyle(new FillStyle());
        $shape->getFillStyle()->enable(true);
        $shape->getFillStyle()->setColor(new RGBAColor(156, 78, 78, 1));
        $this->assertEquals(true, $shape->getFillStyle()->getColor() == new RGBAColor(156, 78, 78, 1));
    }

    public function testShapeLineColor(): void
    {
        $shape = new Rectangle(new Point(500, 800), new Point(1100, 1200));
        $shape->setLineStyle(new LineStyle());
        $shape->getLineStyle()->enable(true);
        $shape->getLineStyle()->setColor(new RGBAColor(156, 78, 78, 1));
        $this->assertEquals(true, $shape->getLineStyle()->getColor() == new RGBAColor(156, 78, 78, 1));
    }

    public function testShapeInGroup(): void
    {
        $shape = new Rectangle(new Point(500, 800), new Point(1100, 1200));
        $group = new Group();
        $group->insertShape($shape);
        $this->assertEquals(true, $group->getShapesAtIndex(0) === $shape);
    }

    public function testGroupFrame(): void
    {
        $shape = new Rectangle(new Point(500, 800), new Point(1100, 1200));
        $shape2 = new Triangle(new Point(500, 800), new Point(1100, 800), new Point(800, 500));;
        $group = new Group();
        $group->insertShape($shape);
        $group->insertShape($shape2);

        $rightFrame = new Rect(new Point(500, 500), 600, 700);
        $this->assertEquals(true, $group->getFrame() == $rightFrame);
    }

    public function testSetFrame(): void
    {
        $shape = new Rectangle(new Point(500, 800), new Point(1100, 1200));
        $shape2 = new Triangle(new Point(500, 800), new Point(1100, 800), new Point(800, 500));
        $group = new Group();
        $group->insertShape($shape);
        $group->insertShape($shape2);

        $newRect = new Rect(new Point(400, 500), 800, 700);
        $group->setFrame($newRect);

        $this->assertEquals(true, $group->getFrame() == $newRect);
    }

    public function testGroupFillColor(): void
    {
        $shape = new Rectangle(new Point(500, 800), new Point(1100, 1200));
        $shape->setFillStyle(new FillStyle());
        $shape->getFillStyle()->enable(true);
        $shape->getFillStyle()->setColor(new RGBAColor(156, 78, 78, 1));

        $shape2 = new Triangle(new Point(500, 800), new Point(1100, 800), new Point(800, 500));
        $shape2->setFillStyle(new FillStyle());
        $shape2->getFillStyle()->enable(true);
        $shape2->getFillStyle()->setColor(new RGBAColor(100, 78, 78, 1));

        $group = new Group();
        $group->insertShape($shape);
        $group->insertShape($shape2);

        $this->assertEquals(true, $group->getFillStyle() === null);
    }

    public function testGroupRightFillColor(): void
    {
        $shape = new Rectangle(new Point(500, 800), new Point(1100, 1200));
        $shape->setFillStyle(new FillStyle());
        $shape->getFillStyle()->enable(true);
        $shape->getFillStyle()->setColor(new RGBAColor(156, 78, 78, 1));

        $shape2 = new Triangle(new Point(500, 800), new Point(1100, 800), new Point(800, 500));
        $shape2->setFillStyle(new FillStyle());
        $shape2->getFillStyle()->enable(true);
        $shape2->getFillStyle()->setColor(new RGBAColor(156, 78, 78, 1));

        $group = new Group();
        $group->insertShape($shape);
        $group->insertShape($shape2);

        $rightFillStyle = new FillStyle();
        $rightFillStyle->enable(true);
        $rightFillStyle->setColor(new RGBAColor(156, 78, 78, 1));

        $this->assertEquals(true, $group->getFillStyle() == $rightFillStyle);
    }

    public function testGroupLineColor(): void
    {
        $shape = new Rectangle(new Point(500, 800), new Point(1100, 1200));
        $shape->setLineStyle(new LineStyle());
        $shape->getLineStyle()->enable(true);
        $shape->getLineStyle()->setColor(new RGBAColor(156, 78, 78, 1));

        $shape2 = new Triangle(new Point(500, 800), new Point(1100, 800), new Point(800, 500));
        $shape2->setLineStyle(new LineStyle());
        $shape2->getLineStyle()->enable(true);
        $shape2->getLineStyle()->setColor(new RGBAColor(100, 78, 78, 1));

        $group = new Group();
        $group->insertShape($shape);
        $group->insertShape($shape2);

        $this->assertEquals(true, $group->getLineStyle() === null);
    }

    public function testGroupRightLineColor(): void
    {
        $shape = new Rectangle(new Point(500, 800), new Point(1100, 1200));
        $shape->setLineStyle(new LineStyle());
        $shape->getLineStyle()->enable(true);
        $shape->getLineStyle()->setColor(new RGBAColor(156, 78, 78, 1));

        $shape2 = new Triangle(new Point(500, 800), new Point(1100, 800), new Point(800, 500));
        $shape2->setLineStyle(new LineStyle());
        $shape2->getLineStyle()->enable(true);
        $shape2->getLineStyle()->setColor(new RGBAColor(156, 78, 78, 1));

        $group = new Group();
        $group->insertShape($shape);
        $group->insertShape($shape2);

        $rightLineStyle = new LineStyle();
        $rightLineStyle->enable(true);
        $rightLineStyle->setColor(new RGBAColor(156, 78, 78, 1));

        $this->assertEquals(true, $group->getLineStyle() == $rightLineStyle);
    }

    public function testChangeGroupFillColor(): void
    {
        $shape = new Rectangle(new Point(500, 800), new Point(1100, 1200));
        $shape->setFillStyle(new FillStyle());
        $shape->getFillStyle()->enable(true);
        $shape->getFillStyle()->setColor(new RGBAColor(156, 78, 78, 1));

        $shape2 = new Triangle(new Point(500, 800), new Point(1100, 800), new Point(800, 500));
        $shape2->setFillStyle(new FillStyle());
        $shape2->getFillStyle()->enable(true);
        $shape2->getFillStyle()->setColor(new RGBAColor(100, 78, 78, 1));

        $group = new Group();
        $group->insertShape($shape);
        $group->insertShape($shape2);

        $newFillStyle = new FillStyle();
        $newFillStyle->enable(true);
        $newFillStyle->setColor(new RGBAColor(255, 0, 0, 1));
        $group->setFillStyle($newFillStyle);

        $this->assertEquals(true, $group->getFillStyle() == $newFillStyle);
    }

    public function testChangeGroupLineColor(): void
    {
        $shape = new Rectangle(new Point(500, 800), new Point(1100, 1200));
        $shape->setLineStyle(new LineStyle());
        $shape->getLineStyle()->enable(true);
        $shape->getLineStyle()->setColor(new RGBAColor(156, 78, 78, 1));

        $shape2 = new Triangle(new Point(500, 800), new Point(1100, 800), new Point(800, 500));
        $shape2->setLineStyle(new LineStyle());
        $shape2->getLineStyle()->enable(true);
        $shape2->getLineStyle()->setColor(new RGBAColor(100, 78, 78, 1));

        $group = new Group();
        $group->insertShape($shape);
        $group->insertShape($shape2);

        $newLineStyle = new LineStyle();
        $newLineStyle->enable(true);
        $newLineStyle->setColor(new RGBAColor(255, 0, 0, 1));
        $group->setLineStyle($newLineStyle);

        $this->assertEquals(true, $group->getLineStyle() == $newLineStyle);
    }
}