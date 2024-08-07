<?php
namespace App\Message;

class CreateUserNotification
{
    public function __construct(private string $userId) {
    }

    public function getUserId(): string {
        return $this->userId;
    }
}