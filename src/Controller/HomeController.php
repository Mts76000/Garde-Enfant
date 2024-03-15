<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\ContactFormType;
use App\Entity\Contact;
use Doctrine\ORM\EntityManagerInterface;

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

    #[Route('/contact', name: 'app_contact')]
    public function contact(Request $request,EntityManagerInterface $entityManager): Response
    {
        $contact = new Contact();

        $form = $this->createForm(ContactFormType::class, $contact);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($contact);
            $entityManager->flush();

            return $this->redirectToRoute('app');
        }

        return $this->render('contact/contact.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
