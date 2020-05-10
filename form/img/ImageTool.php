<?php

namespace form\img;

class ImageTool
{

    public function __construct()
    {
    }

    public function moveImageIfNotExisting($from, $destDir, $name)
    {
        if (\file_exists($destDir . $name)) {
            throw new \Exception("Съжаляваме, но вече съществува такъв файл.");
        }

        $this->moveImage($from, $destDir, $name);
    }

    /**
     * @throws \Exception
     */
    public function moveImage($from, $destDir, $name)
    {
        if (!\is_writable($destDir)) {
            throw new \Exception("Файлът не може да се запише заради неналичие на права.");
        }

        if (!\move_uploaded_file($from, $destDir . $name)) {
            throw new \Exception("Грешка при преместване на файла от " . $from . " до " . $destDir . $name);
        }
    }
}
