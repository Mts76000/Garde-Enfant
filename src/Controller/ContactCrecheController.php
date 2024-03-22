<?php

namespace App\Controller;

use App\Entity\ContactCreche;
use App\Form\ContactCrecheType;
use App\Repository\ContactCrecheRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/contact/creche')]
class ContactCrecheController extends AbstractController
{
    #[Route('/', name: 'app_contact_creche_index', methods: ['GET'])]
    public function index(ContactCrecheRepository $contactCrecheRepository): Response
    {
        return $this->render('contact_creche/index.html.twig', [
            'contact_creches' => $contactCrecheRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_contact_creche_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $contactCreche = new ContactCreche();
        $form = $this->createForm(ContactCrecheType::class, $contactCreche);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($contactCreche);
            $entityManager->flush();

            return $this->redirectToRoute('app_contact_creche_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('contact_creche/new.html.twig', [
            'contact_creche' => $contactCreche,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_contact_creche_show', methods: ['GET'])]
    public function show(ContactCreche $contactCreche): Response
    {
        return $this->render('contact_creche/show.html.twig', [
            'contact_creche' => $contactCreche,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_contact_creche_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ContactCreche $contactCreche, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ContactCrecheType::class, $contactCreche);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_contact_creche_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('contact_creche/edit.html.twig', [
            'contact_creche' => $contactCreche,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_contact_creche_delete', methods: ['POST'])]
    public function delete(Request $request, ContactCreche $contactCreche, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$contactCreche->getId(), $request->request->get('_token'))) {
            $entityManager->remove($contactCreche);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_contact_creche_index', [], Response::HTTP_SEE_OTHER);
    }
}
