<?php

namespace App\Controller;

use App\Repository\AddCrecheRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\AddCreche;

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
    public function demande(AddCrecheRepository $addCrecheRepository): Response
    {

        $user = $this->getUser();

        // $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->render('admin/demande.html.twig', [
            'controller_name' => 'AdminController',
            'add_creches' => $addCrecheRepository->findBy(['status' => 'waiting']),
            'user' => $user,

        ]);
    }

    #[Route('/{id}', name: 'app_admin_demande_show', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function show(AddCreche $addCreche): Response
    {
        $user = $this->getUser();

        return $this->render('admin/show.html.twig', [
            'add_creche' => $addCreche,
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
    #[Route('/{id}/validate', name: 'app_admin_demande_validate', methods: ['GET'])]
    public function validatePro(Request $request, AddCreche $addCreche, EntityManagerInterface $entityManager): Response
    {
        if ($addCreche->getStatus() === 'waiting' || $addCreche->getStatus() === 'noValidate') {
            $addCreche->setStatus('validate');

            $entityManager->persist($addCreche);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_demande');
        }

        return new Response('Le professionnel n\'est pas en attente.');
    }

    #[Route('/{id}/novalidate', name: 'app_admin_demande_novalidate', methods: ['GET'])]
    public function noValidatePro(Request $request, AddCreche $addCreche, EntityManagerInterface $entityManager): Response
    {
        if ($addCreche->getStatus() === 'waiting' || $addCreche->getStatus() === 'validate') {
            $addCreche->setStatus('noValidate');

            $entityManager->persist($addCreche);
            $entityManager->flush();

            return $this->redirectToRoute('app_admin_demande');
        }

        return new Response('Le professionnel n\'est pas en attente.');
    }

    #[Route('/app_admin_proValidate', name: 'app_admin_proValidate')]
    public function proValidate(AddCrecheRepository $addCrecheRepository): Response
    {
        $user = $this->getUser();


        // $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->render('admin/proValidate.html.twig', [
            'controller_name' => 'AdminController',
            'ValidatePros' => $addCrecheRepository->findBy(['status' => 'validate']),
            'user' => $user,

        ]);
    }

    #[Route('/app_admin_proNoValidate', name: 'app_admin_proNoValidate')]
    public function proNoValidate(AddCrecheRepository $addCrecheRepository): Response
    {
        $user = $this->getUser();

        // $this->denyAccessUnlessGranted('ROLE_ADMIN');
        return $this->render('admin/proNoValidate.html.twig', [
            'controller_name' => 'AdminController',
            'NoValidatePros' => $addCrecheRepository->findBy(['status' => 'noValidate']),
            'user' => $user,

        ]);
    }
}
