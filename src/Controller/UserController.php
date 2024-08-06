<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\UserRepository;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class UserController extends AbstractController
{
    #[Route('/user', name: 'add_user')]
    public function create(EntityManagerInterface $entityManager, UserRepository $userRepository)
    {
        $new_user = new User();
        $new_user->setEmail('test@emails.com');
        $new_user->setFirstName('test');
        $new_user->setLastName('emails');

        $entityManager->persist($new_user);
        $entityManager->flush();
        
        return new Response('Saved new product with id '.$new_user->getId());
    }
}