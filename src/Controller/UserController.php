<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;



class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(): Response
    {
        $user = $this->getUser();
        $enfants = $user->getFullChildren();

        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
            'full_children' => $enfants,
            'user' => $user,
        ]);
    }

    #[Route('/user_success', name: 'app_user_success')]
    public function success(): Response
    {
        $user = $this->getUser();
        return $this->render('user/success.html.twig', [
            'user' => $user,
        ]);
    }
}
