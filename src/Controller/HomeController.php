<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\ContactFormType;
use App\Entity\Contact;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UserRepository;
use App\Entity\User;
use App\Form\UserType;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app')]
    public function index(): Response
    {
        $user = $this->getUser();
        // dd($user);
        return $this->render('home/index.html.twig', [
            'user' => $user,
        ]);
        
    }

    #[Route('/mentions', name: 'app_mentions')]
    public function mention(): Response
    {
        $user = $this->getUser();

        return $this->render('home/mentions.html.twig', [
            'user' => $user,
        ]);
    
    }

    #[Route('/faq', name: 'app_faq')]
    public function faq(): Response
    {
        $user = $this->getUser();
        return $this->render('home/faq.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/contact', name: 'app_contact')]
    public function contact(Request $request,EntityManagerInterface $entityManager): Response
    {
        $contact = new Contact();
        $user = $this->getUser();
        $form = $this->createForm(ContactFormType::class, $contact);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($contact);
            $entityManager->flush();

            return $this->redirectToRoute('app');
        }

        return $this->render('contact/contact.html.twig', [
            'form' => $form->createView(),
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app');
        }

        return $this->render('home/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    
}
