<?php
declare(strict_types=1);

namespace Factory\Painter;

use Factory\Canvas\CanvasInterface;
use Factory\PictureDraft\PictureDraft;

class Painter
{
    public function drawPicture(PictureDraft $draft, CanvasInterface $canvas): void
    {
        for ($i = 0; $i < $draft->getCount(); ++$i)
        {
            $shape = $draft->getShape($i);
            $canvas->setColor($shape->getColor());
            $shape->draw($canvas);
        }

        $canvas->drawImage();
    }
}