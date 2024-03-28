<?php

namespace App\Controller;

use App\Entity\ContactCreche;
use App\Form\ContactCrecheType;
use App\Repository\AddCrecheRepository;
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
    public function index(ContactCrecheRepository $contactCrecheRepository, AddCrecheRepository $addCrecheRepository): Response
    {
        $user = $this->getUser();
        $crecheId = $addCrecheRepository->findCrecheIdByUserIdSingle($user);


        return $this->render('contact_creche/index.html.twig', [
            'contact_creches' => $contactCrecheRepository->findby(['id_pro' => $crecheId]),
            'user' => $user,
        ]);
    }

    #[Route('/new', name: 'app_contact_creche_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();

        $idcreche = $request->query->get('id');

        $contactCreche = new ContactCreche();
        $form = $this->createForm(ContactCrecheType::class, $contactCreche);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $contactCreche->setIdPro($idcreche);
            $entityManager->persist($contactCreche);
            $entityManager->flush();

            return $this->redirectToRoute('app_rdv_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('contact_creche/new.html.twig', [
            'contact_creche' => $contactCreche,
            'form' => $form,
            'user' => $user,
        ]);
    }

    #[Route('/{id}', name: 'app_contact_creche_show', methods: ['GET'])]
    public function show(ContactCreche $contactCreche): Response
    {
        $user = $this->getUser();

        return $this->render('contact_creche/show.html.twig', [
            'contact_creche' => $contactCreche,
            'user' => $user,

        ]);
    }

    #[Route('/{id}/edit', name: 'app_contact_creche_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ContactCreche $contactCreche, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();

        $form = $this->createForm(ContactCrecheType::class, $contactCreche);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_contact_creche_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('contact_creche/edit.html.twig', [
            'contact_creche' => $contactCreche,
            'form' => $form,
            'user' => $user,

        ]);
    }

    #[Route('/{id}', name: 'app_contact_creche_delete', methods: ['POST'])]
    public function delete(Request $request, ContactCreche $contactCreche, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();

        if ($this->isCsrfTokenValid('delete' . $contactCreche->getId(), $request->request->get('_token'))) {
            $entityManager->remove($contactCreche);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_contact_creche_index', [
            'user' => $user,
        ], Response::HTTP_SEE_OTHER);
    }
}
