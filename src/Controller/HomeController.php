<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app')]
    public function index(): Response
    {
        // $user = $this->getUser();
        // dd($user);
        return $this->render('home/index.html.twig', []);
    }

    #[Route('/mentions', name: 'app_mentions')]
    public function mention(): Response
    {

        return $this->render('home/mentions.html.twig', []);
    }

    #[Route('/faq', name: 'app_faq')]
    public function faq(): Response
    {

        return $this->render('home/faq.html.twig', []);
    }
}
