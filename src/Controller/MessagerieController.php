<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Repository\ContactRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/messagerie')]
class MessagerieController extends AbstractController
{
    #[Route('/', name: 'app_messagerie_index', methods: ['GET'])]
    public function index(ContactRepository $contactRepository): Response
    {
        $user = $this->getUser();
        return $this->render('messagerie/index.html.twig', [
            'contacts' => $contactRepository->findAll(),
            'user' => $user,
        ]);
    }

    #[Route('/{id}', name: 'app_messagerie_show', methods: ['GET'])]
    public function show(Contact $contact): Response
    {
        $user = $this->getUser();
        return $this->render('messagerie/show.html.twig', [
            'contact' => $contact,
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_messagerie_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Contact $contact, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);
        $user = $this->getUser();

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_messagerie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('messagerie/edit.html.twig', [
            'contact' => $contact,
            'form' => $form,
            'user' => $user,
        ]);
    }

    #[Route('/{id}', name: 'app_messagerie_delete', methods: ['POST'])]
    public function delete(Request $request, Contact $contact, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$contact->getId(), $request->request->get('_token'))) {
            $entityManager->remove($contact);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_messagerie_index', [], Response::HTTP_SEE_OTHER);
    }
}
