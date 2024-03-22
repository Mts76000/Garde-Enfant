<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProController extends AbstractController
{
    #[Route('/pro', name: 'app_pro')]
    public function index(): Response
    {

        $user = $this->getUser();

        return $this->render('pro/index.html.twig', [
            'controller_name' => 'ProController',
            'user' => $user,
        ]);
    }
    
    
    #[Route('/pro_messsage', name: 'app_pro_message')]
    public function message(): Response
    {
        $user = $this->getUser();
        return $this->render('pro/message.html.twig', [
            'controller_name' => 'ProController',
            'user' => $user,
        ]);
    } 


    #[Route('/pro_detail', name: 'app_pro_detail')]
    public function detail(): Response
    {
        $user = $this->getUser();
        return $this->render('pro/detail.html.twig', [
            'controller_name' => 'ProController',
            'user' => $user,
        ]);
    }

    #[Route('/pro_demande', name: 'app_pro_demande')]
    public function demande(): Response
    {
        $user = $this->getUser();
        return $this->render('pro/demande.html.twig', [
            'controller_name' => 'ProController',
            'user' => $user,
        ]);
    }  
    
    
}
