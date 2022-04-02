<?php

namespace Factory\Designer;

use Factory\Factory\ShapeFactoryInterface;
use Factory\PictureDraft\PictureDraft;

interface DesignerInterface
{
    public function createDraft(string $fileName, ShapeFactoryInterface $shapeFactory): ?PictureDraft;
}