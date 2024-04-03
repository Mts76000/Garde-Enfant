<?php

namespace App\Controller;

use App\Entity\AddCreche;
use App\Entity\ProTime;
use App\Entity\User;
use App\Form\AddCrecheType;
use App\Repository\AddCrecheRepository;
use App\Repository\ProTimeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/add/creche')]
class AddCrecheController extends AbstractController
{
    #[Route('/', name: 'app_pro', methods: ['GET'])]
    public function index(AddCrecheRepository $addCrecheRepository): Response
    {

        $user = $this->getUser();

        return $this->render('add_creche/index.html.twig', [
            'add_creches' => $addCrecheRepository->findAll(),
            'user' => $user,
        ]);
    }

    #[Route('/new', name: 'app_add_creche_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SluggerInterface $slugger, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();

        $addCreche = new AddCreche();
        $form = $this->createForm(AddCrecheType::class, $addCreche);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $addCreche->setStatus('waiting');

            $addCreche->setUser($user);

            $addCreche->setCreatedAt(new \DateTimeImmutable());
            /** @var UploadedFile $brochureFile */
            $brochureFile = $form->get('brochure')->getData();
            if ($brochureFile) {
                $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $brochureFile->guessExtension();

                try {
                    $brochureFile->move(
                        $this->getParameter('brochures_directory'),
                        $newFilename,
                    );
                } catch (FileException $e) {
                }

                $addCreche->setBrochureFilename($newFilename);
            } else {
                $addCreche->setBrochureFilename('default_filename.pdf');
            }

            $entityManager->persist($addCreche);
            $entityManager->flush();

            return $this->redirectToRoute('app_pro', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('add_creche/new.html.twig', [
            'add_creche' => $addCreche,
            'form' => $form,
            'user' => $user,
        ]);
    }


    #[Route('/{id}', name: 'app_add_creche_show', methods: ['GET'])]
    public function show(AddCreche $addCreche, ProTimeRepository $timeRepository, AddCrecheRepository $addCrecheRepository): Response
    {
        $user = $this->getUser();
        $crecheId = $addCrecheRepository->findCrecheIdByUserId($user);

        $times = $timeRepository->findBy(['pro' => $crecheId]);

        $timeDetails = [];
        foreach ($times as $time) {
            $timeDetails[] = [
                'jour' => $time->getJour(),
                'heure_debut' => $time->getHeureDebut(),
                'heure_fin' => $time->getHeureFin(),
            ];
        }

        return $this->render('add_creche/show.html.twig', [
            'add_creche' => $addCreche,
            'user' => $user,
            'times' => $timeDetails,
        ]);
    }



    #[Route('/{id}/public', name: 'app_add_creche_public_show', methods: ['GET'])]
    public function public_show(AddCreche $addCreche, ProTimeRepository $timeRepository, AddCrecheRepository $addCrecheRepository, string $id): Response
    {
        $user = $this->getUser();

        $times = $timeRepository->findBy(['pro' => $id]);

        $timeDetails = [];
        foreach ($times as $time) {
            $timeDetails[] = [
                'jour' => $time->getJour(),
                'heure_debut' => $time->getHeureDebut(),
                'heure_fin' => $time->getHeureFin(),
            ];
        }


        return $this->render('add_creche/public_show.html.twig', [
            'add_creche' => $addCreche,
            'user' => $user,
            'times' => $timeDetails,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_add_creche_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, AddCreche $addCreche, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(AddCrecheType::class, $addCreche);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $addCreche->setStatus('waiting');
            $addCreche->setUser($user);
            $addCreche->setModifiedAt(new \DateTimeImmutable());
            $entityManager->flush();

            return $this->redirectToRoute('app_pro', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('add_creche/edit.html.twig', [
            'add_creche' => $addCreche,
            'form' => $form,
            'user' => $user,
        ]);
    }

    #[Route('/{id}', name: 'app_add_creche_delete', methods: ['POST'])]
    public function delete(Request $request, AddCreche $addCreche, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        if ($this->isCsrfTokenValid('delete' . $addCreche->getId(), $request->request->get('_token'))) {
            $entityManager->remove($addCreche);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_pro', [
            'user' => $user,
        ], Response::HTTP_SEE_OTHER);
    }
}
