<?php
declare(strict_types=1);

include 'GraphicsLib/CanvasInterface.php';
include 'GraphicsLib/Canvas.php';
include 'ModernGraphicsLib/Point.php';
include 'ModernGraphicsLib/RGBAColor.php';
include 'ModernGraphicsLib/ModernGraphicsRenderer.php';
include 'ModernGraphicsLib/Exceptions/LogicException.php';
include 'ShapeDrawingLib/CanvasDrawableInterface.php';
include 'ShapeDrawingLib/CanvasPainter.php';
include 'ShapeDrawingLib/Point.php';
include 'ShapeDrawingLib/Rectangle.php';
include 'ShapeDrawingLib/Triangle.php';
include 'ModernGraphicsLibAdapter/PaintPictureOnModernObjectAdapter.php';
include 'ModernGraphicsLibAdapter/PaintPictureOnModernClassAdapter.php';
include 'ModernGraphicsLibAdapter/Utils/ColorUtil.php';

use Adapter\GraphicsLib\Canvas;
use Adapter\ModernGraphicsLib\Exceptions\LogicException;
use Adapter\ModernGraphicsLib\ModernGraphicsRenderer;
use Adapter\ShapeDrawingLib\CanvasPainter;
use Adapter\ShapeDrawingLib\Point;
use Adapter\ShapeDrawingLib\Rectangle;
use Adapter\ShapeDrawingLib\Triangle;
use Adapter\ModernGraphicsLibAdapter\PaintPictureOnModernObjectAdapter;
use Adapter\ModernGraphicsLibAdapter\PaintPictureOnModernClassAdapter;

function paintPicture(CanvasPainter $painter): void
{
    $triangle = new Triangle(new Point(10, 15), new Point(100, 200), new Point(150, 250), 0xffffff);
    $rectangle = new Rectangle(new Point(10, 15), 18, 24);

    $painter->draw($triangle);
    $painter->draw($rectangle);
}

function paintPictureOnCanvas(): void
{
    $simpleCanvas = new Canvas();
    $painter = new CanvasPainter($simpleCanvas);
    paintPicture($painter);
}

function paintPictureOnModernGraphicsRenderer(): void
{
    try
    {
        $renderer = new ModernGraphicsRenderer();
        $renderer->beginDraw();
        $paintAdapter = new PaintPictureOnModernObjectAdapter($renderer);
        $painter = new CanvasPainter($paintAdapter);
        paintPicture($painter);
    }
    catch (LogicException $exception)
    {
        echo $exception->getMessage() . '</br>';
        return;
    }
}

function paintPictureOnModernGraphicsRendererClassAdapter(): void
{
    try
    {
        $paintAdapter = new PaintPictureOnModernClassAdapter();
        $painter = new CanvasPainter($paintAdapter);
        paintPicture($painter);
    }
    catch (LogicException $exception)
    {
        echo $exception->getMessage() . '</br>';
        return;
    }
}

paintPictureOnCanvas();
paintPictureOnModernGraphicsRenderer();
paintPictureOnModernGraphicsRendererClassAdapter();
