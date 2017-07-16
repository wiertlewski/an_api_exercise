<?php

namespace Arek\Exercise;

use Psr\Log\AbstractLogger;
use Psr\Log\LoggerInterface;

class Logger extends AbstractLogger implements LoggerInterface
{
    private $path;

    public function __construct($path)
    {
        $this->path = $path;
    }

    public function log($level, $message, array $context = array())
    {
        $dir = $this->path . '/' . date('Y') . '/' . date('m');

        if (!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }

        file_put_contents(
            sprintf('%s/%s.txt', $dir, date('d')),
            sprintf('%s [%s] %s %s', date('H:i:s'), $level, $message, json_encode($context)) . PHP_EOL,
            FILE_APPEND
        );
    }
}
