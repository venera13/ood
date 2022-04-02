<?php
declare(strict_types=1);

namespace Factory\Factory;

use Factory\Domain\ShapeType;
use Factory\Exceptions\InvalidArgumentsException;
use Factory\Exceptions\ShapeNotFound;
use Factory\Point\Point;
use Factory\Shape\Ellipse;
use Factory\Shape\Rectangle;
use Factory\Shape\RegularPolygon;
use Factory\Shape\ShapeInterface;
use Factory\Shape\Triangle;

class ShapeFactory implements ShapeFactoryInterface
{
    public function createShape(string $description): ShapeInterface
    {
        $params = explode(' ', trim($description));

        if (empty($params))
        {
            throw new InvalidArgumentsException('Invalid arguments');
        }

        $shapeName = $params[0];

        $params = array_slice($params, 1, count($params));

        return match ($shapeName)
        {
            ShapeType::ELLIPSE => self::createEllipse($params),
            ShapeType::RECTANGLE => self::createRectangle($params),
            ShapeType::REGULAR_POLYGON => self::createRegularPolygon($params),
            ShapeType::TRIANGLE => self::createTriangle($params),
            default => throw new ShapeNotFound('Shape not found'),
        };
    }

    private static function createEllipse(array $params): ShapeInterface
    {
        if (count($params) !== 5
            || !ctype_alpha($params[0])
            || !ctype_digit($params[1])
            || !ctype_digit($params[2])
            || !ctype_digit($params[3])
            || !ctype_digit($params[4]))
        {
            throw new InvalidArgumentsException('Invalid arguments');
        }

        return new Ellipse(
            $params[0],
            new Point((int) $params[1], (int) $params[2]),
            (int) $params[3],
            (int) $params[4]
        );
    }

    private static function createRectangle(array $params): ShapeInterface
    {
        if (count($params) !== 5
            || !ctype_alpha($params[0])
            || !ctype_digit($params[1])
            || !ctype_digit($params[2])
            || !ctype_digit($params[3])
            || !ctype_digit($params[4]))
        {
            throw new InvalidArgumentsException('Invalid arguments');
        }

        return new Rectangle(
            $params[0],
            new Point((int) $params[1], (int) $params[2]),
            new Point((int) $params[3], (int) $params[4])
        );
    }

    private static function createRegularPolygon(array $params): ShapeInterface
    {
        if (count($params) !== 5
            || !ctype_alpha($params[0])
            || !ctype_digit($params[1])
            || !ctype_digit($params[2])
            || !ctype_digit($params[3])
            || !ctype_digit($params[4]))
        {
            throw new InvalidArgumentsException('Invalid arguments');
        }

        return new RegularPolygon(
            $params[0],
            new Point((int) $params[1], (int) $params[2]),
            (int) $params[3],
            (int) $params[4]
        );
    }

    private static function createTriangle(array $params): ShapeInterface
    {
        if (count($params) !== 7
            || !ctype_alpha($params[0])
            || !ctype_digit($params[1])
            || !ctype_digit($params[2])
            || !ctype_digit($params[3])
            || !ctype_digit($params[4])
            || !ctype_digit($params[5])
            || !ctype_digit($params[6]))
        {
            throw new InvalidArgumentsException('Invalid arguments');
        }

        return new Triangle(
            $params[0],
            new Point((int) $params[1], (int) $params[2]),
            new Point((int) $params[3], (int) $params[4]),
            new Point((int) $params[5], (int) $params[6])
        );
    }
}