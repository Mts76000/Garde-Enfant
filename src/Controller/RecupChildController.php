<?php

namespace App\Controller;

use App\Entity\RecupChild;
use App\Form\RecupChildType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RecupChildController extends AbstractController
{
    #[Route('/recupchild', name: 'app_recup_child')]
    public function index(): Response
    {
        return $this->render('recup_child/index.html.twig', [
            'controller_name' => 'RecupChildController',
//            'recupChild' => $recupChildRepository->findAll(),
        ]);
    }

    #[Route('/recupchild/new', name: 'app_recup_child_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $recupChild = new RecupChild();
        $form = $this->createForm(RecupChildType::class, $recupChild);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $recupChild->setCreatedAt(new \DateTimeImmutable());
            $entityManager->persist($recupChild);
            $entityManager->flush();

            return $this->redirectToRoute('app_recup_child', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('recup_child/new.html.twig', [
            'RecupChild' => $recupChild,
            'form' => $form,
        ]);
    }

    #[Route('/recupchild/{id}', name: 'app_recup_child_show', methods: ['GET'])]
    public function show(RecupChild $recupChild): Response
    {
        return $this->render('RecupChild/show.html.twig', [
            'RecupChild' => $recupChild,
        ]);
    }

    #[Route('/recupchild/{id}/edit', name: 'app_recup_child_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, RecupChild $recupChild, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(RecupChildType::class, $recupChild);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_recup_child', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('/recup/child/edit.html.twig', [
            'RecupChild' => $recupChild,
            'form' => $form,
        ]);
    }

    #[Route('/recupchild/{id}', name: 'app_RecupChild_delete', methods: ['POST'])]
    public function delete(Request $request, RecupChild $recupChild, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$recupChild->getId(), $request->request->get('_token'))) {
            $entityManager->remove($recupChild);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_RecupChild_index', [], Response::HTTP_SEE_OTHER);
    }
}
