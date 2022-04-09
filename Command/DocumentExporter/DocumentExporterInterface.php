<?php
declare(strict_types=1);

namespace Command\DocumentExporter;

interface DocumentExporterInterface
{
    public function generate(): string;
}