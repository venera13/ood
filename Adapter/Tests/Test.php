<?php
declare(strict_types=1);

namespace Adapter\Tests;

include '../GraphicsLib/CanvasInterface.php';
include '../GraphicsLib/Canvas.php';
include '../ModernGraphicsLib/Point.php';
include '../ModernGraphicsLib/ModernGraphicsRenderer.php';
include '../ModernGraphicsLib/Exceptions/LogicException.php';
include '../ShapeDrawingLib/CanvasDrawableInterface.php';
include '../ShapeDrawingLib/CanvasPainter.php';
include '../ShapeDrawingLib/Point.php';
include '../ShapeDrawingLib/Rectangle.php';
include '../ShapeDrawingLib/Triangle.php';
include '../PaintPictureOnModernObjectAdapter.php';
include '../PaintPictureOnModernClassAdapter.php';
include 'MockModernGraphicsRenderer.php';

use Adapter\PaintPictureOnModernClassAdapter;
use Adapter\PaintPictureOnModernObjectAdapter;
use PHPUnit\Framework\TestCase;

class Test extends TestCase
{
    public function testAdapter(): void
    {
        $renderer = new MockModernGraphicsRenderer();
        $paintAdapter = new PaintPictureOnModernObjectAdapter($renderer);
        $paintAdapter->moveTo(1, 2);
        $paintAdapter->lineTo(3, 4);

        $this->expectOutputString('<draw></br>1231234</draw></br>');
    }

    public function testClassAdapter(): void
    {
        $printAdapter = new PaintPictureOnModernClassAdapter();
        $printAdapter->moveTo(1, 2);
        $printAdapter->lineTo(3, 4);

        $this->expectOutputString('<draw></br>Line fromX="1 fromY=2 toX=3 toY=4</br></draw></br>');
    }
}