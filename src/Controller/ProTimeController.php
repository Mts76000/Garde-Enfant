<?php

namespace App\Controller;

use App\Entity\AddCreche;
use App\Entity\ProTime;
use App\Form\ProTimeType;
use App\Repository\AddCrecheRepository;
use App\Repository\ProTimeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/pro/time')]
class ProTimeController extends AbstractController
{
    #[Route('/', name: 'app_pro_time_index', methods: ['GET'])]
    public function index(ProTimeRepository $proTimeRepository): Response
    {
        $user = $this->getUser();
        return $this->render('pro_time/index.html.twig', [
            'pro_times' => $proTimeRepository->findAll(),
            'user' => $user,
        ]);
    }

    #[Route('/new', name: 'app_pro_time_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, AddCrecheRepository $addCrecheRepository): Response
    {
        $proTime = new ProTime();
        $form = $this->createForm(ProTimeType::class, $proTime);
        $form->handleRequest($request);

        $user = $this->getUser();
        $crecheId = $addCrecheRepository->findCrecheIdByUserIdSingle($user);
        $addCreche = $entityManager->getRepository(AddCreche::class)->find($crecheId);

        if ($form->isSubmitted() && $form->isValid()) {

            $existingProTime = $entityManager->getRepository(ProTime::class)->findOneBy(['pro' => $addCreche]);

      
            if ($existingProTime) {
                $entityManager->remove($existingProTime);
                $entityManager->flush(); 
            }

         
            $proTime->setPro($addCreche);
            $entityManager->persist($proTime);
            $entityManager->flush();

            return $this->redirectToRoute('app_pro', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('pro_time/new.html.twig', [
            'pro_time' => $proTime,
            'form' => $form,
            'addCreche' => $addCreche,
            'user' => $user,
        ]);
    }

    #[Route('/{id}', name: 'app_pro_time_show', methods: ['GET'])]
    public function show(ProTime $proTime): Response
    {
        $user = $this->getUser();
        return $this->render('pro_time/show.html.twig', [
            'pro_time' => $proTime,
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_pro_time_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ProTime $proTime, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(ProTimeType::class, $proTime);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_pro_time_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('pro_time/edit.html.twig', [
            'pro_time' => $proTime,
            'form' => $form,
            'user' => $user,
        ]);
    }

    #[Route('/{id}', name: 'app_pro_time_delete', methods: ['POST'])]
    public function delete(Request $request, ProTime $proTime, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        if ($this->isCsrfTokenValid('delete' . $proTime->getId(), $request->request->get('_token'))) {
            $entityManager->remove($proTime);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_pro_time_index', [
            'user' => $user,
        ], Response::HTTP_SEE_OTHER);
    }
}
