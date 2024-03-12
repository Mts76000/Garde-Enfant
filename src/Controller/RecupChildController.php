<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RecupChildController extends AbstractController
{
    #[Route('/recup/child', name: 'app_recup_child')]
    public function index(): Response
    {
        return $this->render('recup_child/index.html.twig', [
            'controller_name' => 'RecupChildController',
        ]);
    }
}
