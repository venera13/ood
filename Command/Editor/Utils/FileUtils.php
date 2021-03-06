<?php
declare(strict_types=1);

namespace Command\Editor\Utils;

use Command\Exceptions\CopyFileException;
use RuntimeException;

class FileUtils
{
    public static function createDirectory(string $directoryName): void
    {
        if (!file_exists($directoryName))
        {
            mkdir($directoryName);
        }
    }

    public static function createFile(string $file, string $directory): string
    {
        $newFile = $directory . '/' . FileUtils::generateFileName() . '.' . pathinfo($file)['extension'];
        if (!file_exists($file))
        {
            throw new CopyFileException('File not exists');
        }
        try
        {
            copy($file, $newFile);
            return $newFile;
        }
        catch (RuntimeException $exception)
        {
            throw new CopyFileException('File copy error');
        }
    }

    public static function deleteFile(string $file): void
    {
        if (!file_exists($file))
        {
            return;
        }

        unlink($file);
    }

    private static function generateFileName(): string
    {
        return substr(md5((string)microtime()), 0, 16);
    }
}