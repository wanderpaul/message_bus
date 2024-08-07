<?php
namespace App\Service;

use Psr\Log\LoggerInterface;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Level;

class Notification
{
    public function __construct(private LoggerInterface $logger) {
    }

    public function logToFile($message)
    {
        $this->logger->pushHandler(new RotatingFileHandler(__DIR__.'/Logs/notification.log', 1, Level::Info));
        $this->logger->info($message);
    }
}