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
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }

    #[Route('/user_rdv', name: 'app_user_rdv')]
    public function rdv(): Response
    {

        return $this->render('user/rdv.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }


    #[Route('/user_success', name: 'app_user_success')]
    public function success(): Response
    {
        return $this->render('user/success.html.twig', []);
    }

  
}
