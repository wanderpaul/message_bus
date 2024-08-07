<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\UserRepository;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use App\Message\CreateUserNotification;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Monolog\Level;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;


class UserController extends AbstractController
{
    #[Route('/user', name: 'add_user', methods:['post'] )]
    public function create(UserRepository $userRepository, MessageBusInterface $messageBus, Request $request): JsonResponse
    {
        $data = [
            'email' => $request->request->get('email'),
            'first_name' => $request->request->get('first_name'),
            'last_name' => $request->request->get('last_name')
        ];

        $new_user = $userRepository->store($data);
        if ($new_user->getId()) {
            $messageBus->dispatch(new CreateUserNotification($new_user->getId()));
        }

        return $this->json($data);
    }
}