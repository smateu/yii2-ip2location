<?php

declare(strict_types=1);

namespace slavkluev\Ip2Location;

class TmpFile
{
    private $filename;

    public function __construct()
    {
        $this->filename = tempnam(sys_get_temp_dir(), 'ip2location');

        if (!$this->filename) {
            throw new \RuntimeException("tempnam() couldn't create a temp file");
        }

        register_shutdown_function(function () {
            if (file_exists($this->filename)) {
                unlink($this->filename);
            }
        });
    }

    public function __toString(): string
    {
        return $this->filename;
    }
}
