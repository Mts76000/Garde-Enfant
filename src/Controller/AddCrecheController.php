<?php

namespace App\Controller;

use App\Entity\AddCreche;
use App\Form\AddCrecheType;
use App\Repository\AddCrecheRepository;
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
    #[Route('/', name: 'app_add_creche_index', methods: ['GET'])]
    public function index(AddCrecheRepository $addCrecheRepository): Response
    {

        $user = $this->getUser();

        return $this->render('add_creche/index.html.twig', [
            'add_creches' => $addCrecheRepository->findAll(),
            'user' => $user,
        ]);
    }

    #[Route('/new', name: 'app_add_creche_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SluggerInterface $slugger,EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $addCreche = new AddCreche();
        $form = $this->createForm(AddCrecheType::class, $addCreche);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $addCreche->setStatus('waiting');
//            $addCreche->setIdUser($user->getUserIdentifier());<---------------------------
            $addCreche->setCreatedAt(new \DateTimeImmutable());
            /** @var UploadedFile $brochureFile */
            $brochureFile = $form->get('brochure')->getData();

            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($brochureFile) {
                $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$brochureFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $brochureFile->move(
                        $this->getParameter('brochures_directory'),
                        $newFilename,
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $addCreche->setBrochureFilename($newFilename);
                $entityManager->persist($addCreche);
                $entityManager->flush();

            } else {
                $addCreche->setBrochureFilename('default_filename.pdf');//<------------ Possibilité d'erreur
            }



            return $this->redirectToRoute('app_add_creche_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('add_creche/new.html.twig', [
            'add_creche' => $addCreche,
            'form' => $form,
            'user' => $user,
        ]);
    }

    #[Route('/{id}', name: 'app_add_creche_show', methods: ['GET'])]
    public function show(AddCreche $addCreche): Response
    {
        $user = $this->getUser();
        return $this->render('add_creche/show.html.twig', [
            'add_creche' => $addCreche,
            'user' => $user,
        ]);
    }

    #[Route('/{id}/public', name: 'app_add_creche_public_show', methods: ['GET'])]
    public function public_show(AddCreche $addCreche): Response
    {
        $user = $this->getUser();
        return $this->render('add_creche/public_show.html.twig', [
            'add_creche' => $addCreche,
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_add_creche_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, AddCreche $addCreche, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(AddCrecheType::class, $addCreche);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $addCreche->setModifiedAt(new \DateTimeImmutable());
            $entityManager->flush();

            return $this->redirectToRoute('app_add_creche_index', [], Response::HTTP_SEE_OTHER);
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
        if ($this->isCsrfTokenValid('delete'.$addCreche->getId(), $request->request->get('_token'))) {
            $entityManager->remove($addCreche);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_add_creche_index', [
            'user' => $user,
        ], Response::HTTP_SEE_OTHER);
    }
}
