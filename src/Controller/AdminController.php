<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {
        $user = $this->getUser();
        // $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'user' => $user,
        ]);
    }

    #[Route('/admin_list_user', name: 'app_liste_utilisateur')]
    public function listing_user(): Response
    {
        $user = $this->getUser();
        return $this->render('admin/user_listing.html.twig', [
            'controller_name' => 'AdminController',
            'user' => $user,
        ]);
    }
    #[Route('/app_admin_message', name: 'app_admin_message')]
    public function message(): Response
    {
        $user = $this->getUser();
        // $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->render('admin/message.html.twig', [
            'controller_name' => 'AdminController',
            'user' => $user,
        ]);

    }

    #[Route('/app_admin_demande', name: 'app_admin_demande')]
    public function demande(): Response
    {
        $user = $this->getUser();
        // $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->render('admin/message.html.twig', [
            'controller_name' => 'AdminController',
            'user' => $user,
        ]);
    }

    #[Route('/app_admin_detail', name: 'app_admin_detail')]
    public function detail(): Response
    {
        $user = $this->getUser();
        // $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->render('admin/message.html.twig', [
            'controller_name' => 'AdminController',
            'user' => $user,
        ]);
    }
}
