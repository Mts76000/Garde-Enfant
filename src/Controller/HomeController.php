<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Form\ContactFormType;
use App\Entity\Contact;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app')]
    public function index(): Response
    {
        // $user = $this->getUser();
        // dd($user);
        return $this->render('home/index.html.twig', [
       
        ]);
    }

    #[Route('/contact', name: 'app_contact')]
    public function contact(Request $request): Response
    {
        $contact = new Contact();

        // Création du formulaire
        $form = $this->createForm(ContactFormType::class, $contact); // Remplacez YourFormType par le nom de votre formulaire

        // Gestion de la soumission du formulaire
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Traitez les données du formulaire ici
            // Par exemple, enregistrez-les en base de données
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contact);
            $entityManager->flush();

            // Redirigez l'utilisateur vers une autre page après la soumission réussie du formulaire
            return $this->redirectToRoute('nom_de_votre_route_success');
        }

        return $this->render('contact/contact.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
