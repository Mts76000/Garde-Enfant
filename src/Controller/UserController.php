<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\ChildFormType;
use App\Entity\Child;
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


    #[Route('/user_enfant', name: 'app_user_child')]
    public function addChild(Request $request, EntityManagerInterface $entityManager): Response
    {

        $enfant = new Child();

        $form = $this->createForm(ChildFormType::class, $enfant);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $enfant->setUser($this->getUser());
        
            $entityManager->persist($enfant);
            $entityManager->flush();

            // Rediriger l'utilisateur vers une autre page après l'enregistrement
            return $this->redirectToRoute('app_user');
        }

        // Rendre le formulaire dans la vue Twig
        return $this->render('user/addchild.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/user_success', name: 'app_user_success')]
    public function success(): Response
    {
        return $this->render('user/success.html.twig', [
        ]);
    }
}
