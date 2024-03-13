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
        return $this->render('pro/index.html.twig', [
            'controller_name' => 'ProController',
        ]);
    }
    
    
    #[Route('/messsage', name: 'app_pro_message')]
    public function message(): Response
    {
        return $this->render('pro/message.html.twig', [
            'controller_name' => 'ProController',
        ]);
    } 


    #[Route('/detail', name: 'app_pro_detail')]
    public function detail(): Response
    {
        return $this->render('pro/detail.html.twig', [
            'controller_name' => 'ProController',
        ]);
    }

    #[Route('/demande', name: 'app_pro_demande')]
    public function demande(): Response
    {
        return $this->render('pro/demande.html.twig', [
            'controller_name' => 'ProController',
        ]);
    }  
    
    #[Route('/info', name: 'app_pro_info')]
    public function info(): Response
    {
        return $this->render('pro/info.html.twig', [
            'controller_name' => 'ProController',
        ]);
    }
}
