<?php
namespace App\MessageHandler;

use App\Message\CreateUserNotification;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\RotatingFileHandler;
use App\Service\Notification;

#[AsMessageHandler]
class CreateUserNotificationHandler
{
    public function __invoke(CreateUserNotification $user)
    {   
        echo "handled";
        $logMessage = "User created through api: {$user->getUserId()} ";
        $notification = new Notification(new Logger('info'));
        $notification->logToFile($logMessage);
    }
}