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
    public function create(EntityManagerInterface $entityManager, MessageBusInterface $messageBus, Request $request): JsonResponse
    {
        $new_user = new User();
        $new_user->setEmail($request->request->get('email'));
        $new_user->setFirstName($request->request->get('first_name'));
        $new_user->setLastName($request->request->get('last_name'));

        $entityManager->persist($new_user);
        $entityManager->flush();

        if ($new_user->getId()) {
            $messageBus->dispatch(new CreateUserNotification($new_user->getId()));
        }
        
        $data = [
            'email' => $new_user->getEmail(),
            'first_name' => $new_user->getFirstName(),
            'last_name' => $new_user->getLastName(),
        ];

        return $this->json($data);
    }
}