<?php
declare(strict_types=1);

include 'Domain/Point.php';
include 'Canvas/CanvasInterface.php';
include 'Canvas/Canvas.php';
include 'Shape/Domain/Rect.php';
include 'Shape/ShapeInterface.php';
include 'Shape/Shape.php';
include 'Shape/Ellipse.php';
include 'Shape/Rectangle.php';
include 'Shape/Triangle.php';
include 'Shape/GroupInterface.php';
include 'Shape/Group.php';
include 'Style/Domain/RGBAColor.php';
include 'Style/StyleInterface.php';
include 'Style/FillStyle.php';
include 'Style/LineStyle.php';
include 'Style/CompositeLineStyle.php';
include 'Style/CompositeFillStyle.php';
include 'Exceptions/InvalidArgumentsException.php';

use Composite\Shape\Rectangle;
use Composite\Domain\Point\Point;
use Composite\Style\Domain\RGBAColor;
use Composite\Shape\Triangle;
use Composite\Shape\Ellipse;
use Composite\Canvas\Canvas;
use Composite\Style\FillStyle;
use Composite\Style\LineStyle;
use Composite\Group\Group;
use Composite\Shape\Domain\Rect;

$wall = new Rectangle(new Point(500, 800), new Point(1100, 1200));
$wall->setFillStyle(new FillStyle());
$wall->getFillStyle()->enable(true);
$wall->getFillStyle()->setColor(new RGBAColor(156, 78, 78, 1));

$roof = new Triangle(new Point(500, 800), new Point(1100, 800), new Point(800, 500));
$roof->setLineStyle(new LineStyle());
$roof->getLineStyle()->enable(true);
$roof->getLineStyle()->setThick(10);
$roof->getLineStyle()->setColor(new RGBAColor(0, 139, 232, 1));

$window = new Ellipse(new Point(700, 1000), 100, 100);
$window->setFillStyle(new FillStyle());
$window->getFillStyle()->enable(true);
$window->getFillStyle()->setColor(new RGBAColor(183, 213, 232, 1));

$canvas = new Canvas();

$group = new Group();
$group->insertShape($wall);
$group->insertShape($roof);
$group->insertShape($window);

$frame = $group->getFrame();

$newRect = new Rect(new Point(400, 500), 800, 700);
$group->setFrame($newRect);

//$groupLineStyle = new LineStyle();
//$groupLineStyle->enable(true);
//$groupLineStyle->setColor(new RGBAColor(255, 0, 0, 1));
//$group->setLineStyle($groupLineStyle);
//
//$groupFillStyle = new FillStyle();
//$groupFillStyle->enable(true);
//$groupFillStyle->setColor(new RGBAColor(0, 0, 255, 1));
//$group->setFillStyle($groupFillStyle);

$wall->draw($canvas);
$roof->draw($canvas);
$window->draw($canvas);
$canvas->drawImage();
