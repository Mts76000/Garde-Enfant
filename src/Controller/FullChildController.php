<?php

namespace App\Controller;

use App\Entity\FullChild;
use App\Form\FullChildType;
use App\Repository\FullChildRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


#[Route('/full/child')]
class FullChildController extends AbstractController
{
    #[Route('/', name: 'app_full_child_index', methods: ['GET'])]
    public function index(FullChildRepository $fullChildRepository): Response
    {
        $user = $this->getUser();
        $enfants = $user->getFullChildren();

        return $this->render('full_child/index.html.twig', [
            'full_children' => $enfants,
        ]);
    }

    #[Route('/new', name: 'app_full_child_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $fullChild = new FullChild();
        $form = $this->createForm(FullChildType::class, $fullChild);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user = $this->getUser();
            $fullChild->setUser($user);


            $entityManager->persist($fullChild);
            $entityManager->flush();

            return $this->redirectToRoute('app_full_child_success');
        }

        return $this->render('full_child/new.html.twig', [
            'full_child' => $fullChild,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_full_child_show', methods: ['GET'], requirements: ['id' => '\d+'])]
    public function show(FullChild $fullChild): Response
    {
        return $this->render('full_child/show.html.twig', [
            'full_child' => $fullChild,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_full_child_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, FullChild $fullChild, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FullChildType::class, $fullChild);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_full_child_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('full_child/edit.html.twig', [
            'full_child' => $fullChild,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_full_child_delete', methods: ['POST'])]
    public function delete(Request $request, FullChild $fullChild, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $fullChild->getId(), $request->request->get('_token'))) {
            $entityManager->remove($fullChild);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_full_child_index', [], Response::HTTP_SEE_OTHER);
    }


    #[Route('/success', name: 'app_full_child_success', methods: ['GET'])]
    public function success(): Response
    {
        return $this->render('full_child/success.html.twig', []);
    }
}
