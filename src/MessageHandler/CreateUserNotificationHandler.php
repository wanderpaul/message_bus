<?php
namespace App\MessageHandler;

use App\Message\CreateUserNotification;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class CreateUserNotificationHandler
{
    public function __invoke(CreateUserNotification $user)
    {
        echo "User logged to file {$user->getUserId()}";
        // log user info into log file.
        // ... do some work - like sending an SMS message!
    }
}