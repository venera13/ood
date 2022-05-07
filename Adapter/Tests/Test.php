<?php
declare(strict_types=1);

namespace Adapter\Tests;

include '../GraphicsLib/CanvasInterface.php';
include '../GraphicsLib/Canvas.php';
include '../ModernGraphicsLib/Point.php';
include '../ModernGraphicsLib/RGBAColor.php';
include '../ModernGraphicsLib/ModernGraphicsRenderer.php';
include '../ModernGraphicsLib/Exceptions/LogicException.php';
include '../ShapeDrawingLib/CanvasDrawableInterface.php';
include '../ShapeDrawingLib/CanvasPainter.php';
include '../ShapeDrawingLib/Point.php';
include '../ShapeDrawingLib/Rectangle.php';
include '../ShapeDrawingLib/Triangle.php';
include '../ModernGraphicsLibAdapter/PaintPictureOnModernObjectAdapter.php';
include '../ModernGraphicsLibAdapter/PaintPictureOnModernClassAdapter.php';
include '../ModernGraphicsLibAdapter/Utils/ColorUtil.php';
include 'MockModernGraphicsRenderer.php';

use Adapter\ModernGraphicsLibAdapter\PaintPictureOnModernClassAdapter;
use Adapter\ModernGraphicsLibAdapter\PaintPictureOnModernObjectAdapter;
use PHPUnit\Framework\TestCase;

class Test extends TestCase
{
    public function testAdapter(): void
    {
        $renderer = new MockModernGraphicsRenderer();
        $paintAdapter = new PaintPictureOnModernObjectAdapter($renderer);
        $paintAdapter->setColor(0x000000);
        $paintAdapter->moveTo(1, 2);
        $paintAdapter->lineTo(3, 4);

        $this->expectOutputString('1234');
    }

    public function testClassAdapter(): void
    {
        $printAdapter = new PaintPictureOnModernClassAdapter();
        $printAdapter->setColor(0xffffff);
        $printAdapter->moveTo(1, 2);
        $printAdapter->lineTo(3, 4);

        $this->expectOutputString('<draw></br>Line fromX="1 fromY=2 toX=3 toY=4 <\color r="1" g="1" b="1" a="1>"</br></draw></br>');
    }
}