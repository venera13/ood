<?php
declare(strict_types=1);

namespace Factory\Tests;

include '../Canvas/CanvasInterface.php';
include '../Canvas/Canvas.php';
include '../Color/Color.php';
include '../Designer/DesignerInterface.php';
include '../Designer/Designer.php';
include '../Domain/ShapeType.php';
include '../Exeptions/InvalidArgumentsException.php';
include '../Exeptions/ShapeNotFound.php';
include '../Factory/ShapeFactoryInterface.php';
include '../Factory/ShapeFactory.php';
include '../Painter/Painter.php';
include '../PictureDraft/PictureDraft.php';
include '../Point/Point.php';
include '../Shape/ShapeInterface.php';
include '../Shape/Shape.php';
include '../Shape/Ellipse.php';
include '../Shape/Rectangle.php';
include '../Shape/RegularPolygon.php';
include '../Shape/Triangle.php';
include 'MockShape.php';
include 'MockCanvas.php';
include 'TestCanvas.php';

use Factory\Color\Color;
use Factory\Designer\Designer;
use Factory\Factory\ShapeFactory;
use Factory\Painter\Painter;
use Factory\PictureDraft\PictureDraft;
use Factory\Point\Point;
use Factory\Shape\Ellipse;
use PHPUnit\Framework\TestCase;

class Test extends TestCase
{
    public function testShape(): void
    {
        $shape = new MockShape(Color::BLACK);
        $this->assertEquals(true, $shape->getColor() === Color::BLACK);
    }

    public function testCanvas(): void
    {
        $shape = new MockShape(Color::BLACK);
        $canvas = new MockCanvas();
        $canvas->setColor($shape->getColor());
        $shape->draw($canvas);

        $this->expectOutputString('lineellipse');
    }

    public function testShapeFactory(): void
    {
        $factory = new ShapeFactory();
        $shape = $factory->createShape('ellipse red 10 15 15 10');

        $rightShape = new Ellipse(Color::RED, new Point(10, 15), 15, 10);

        $this->assertEquals($shape, $rightShape);
    }

    public function testDesigner(): void
    {
        $factory = new ShapeFactory();
        $designer = new Designer();
        $pictureDraft = $designer->createDraft('test_input.txt', $factory);

        $rightShape = new Ellipse(Color::RED, new Point(10, 15), 15, 10);
        $rightPictureDraft = new PictureDraft([$rightShape]);

        $this->assertEquals($pictureDraft, $rightPictureDraft);
    }

    public function testPainter(): void
    {
        $shape = new Ellipse(Color::RED, new Point(10, 15), 15, 10);
        $pictureDraft = new PictureDraft([$shape]);

        $painter = new Painter();
        $canvas = new TestCanvas();
        $painter->drawPicture($pictureDraft, $canvas);

        $this->expectOutputString('ellipse 10 15 15 10 red');
    }
}