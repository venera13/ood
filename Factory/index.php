<?php
declare(strict_types=1);

namespace Factory;

include 'Canvas/CanvasInterface.php';
include 'Canvas/Canvas.php';
include 'Color/Color.php';
include 'Designer/DesignerInterface.php';
include 'Designer/Designer.php';
include 'Domain/ShapeType.php';
include 'Exeptions/InvalidArgumentsException.php';
include 'Exeptions/ShapeNotFound.php';
include 'Factory/ShapeFactoryInterface.php';
include 'Factory/ShapeFactory.php';
include 'Painter/Painter.php';
include 'PictureDraft/PictureDraft.php';
include 'Point/Point.php';
include 'Shape/ShapeInterface.php';
include 'Shape/Shape.php';
include 'Shape/Ellipse.php';
include 'Shape/Rectangle.php';
include 'Shape/RegularPolygon.php';
include 'Shape/Triangle.php';

use Factory\Canvas\Canvas;
use Factory\Designer\Designer;
use Factory\Factory\ShapeFactory;
use Factory\Painter\Painter;

$shapeFactory = new ShapeFactory();
$designer = new Designer();
$pictureDraft = $designer->createDraft('Data/draft_input.txt', $shapeFactory);

if ($pictureDraft !== null)
{
    $painter = new Painter();
    $canvas = new Canvas();
    $painter->drawPicture($pictureDraft, $canvas);
}