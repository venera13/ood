<?php
declare(strict_types=1);

namespace Factory\Designer;

use Factory\Factory\ShapeFactoryInterface;
use Factory\PictureDraft\PictureDraft;
use RuntimeException;

class Designer implements DesignerInterface
{
    public function createDraft(string $fileName, ShapeFactoryInterface $shapeFactory): ?PictureDraft
    {
        try
        {
            $shapes = [];
            $lines = file($fileName);

            foreach ($lines as $line)
            {
                $shapes[] = $shapeFactory->createShape($line);
            }

            return new PictureDraft($shapes);
        }
        catch (RuntimeException $exception)
        {
            echo 'Error - ' . $exception->getMessage();
            return null;
        }
    }
}