<?php

namespace App\Controller;

use App\Repository\FullChildRepository;
use App\Repository\RdvRepository;
use App\Entity\AddCreche;
use App\Repository\AddCrecheRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProController extends AbstractController
{
    #[Route('/pro', name: 'app_pro')]
    public function index(RdvRepository $rdvRepository, AddCrecheRepository $addCrecheRepository, FullChildRepository $fullchildRepository): Response
    {
        $user = $this->getUser();

        $crechedata = $addCrecheRepository->findby(['user' => $user]);
        if (!$crechedata) {
            return $this->redirectToRoute('app_add_creche_new');
        }

        $crecheId = $addCrecheRepository->findCrecheIdByUserId($user);

        $rdvs = $rdvRepository->findBy(['status' => 'open', 'pro' => $crecheId]);

        $childs = [];
        foreach ($rdvs as $rdv) {
            $childId = $rdv->getIdChild();
            if ($childId) {
                $child = $fullchildRepository->find($childId);
                if ($child) {
                    $childs[$rdv->getId()] = $child;
                }
            }
        }



        return $this->render('pro/index.html.twig', [
            'controller_name' => 'ProController',
            'user' => $user,
            'childs' => $childs,
            'rdvs' => $rdvs,
        ]);
    }


    #[Route('/pro_messsage', name: 'app_pro_message')]
    public function message(AddCrecheRepository $addCrecheRepository): Response
    {

        $user = $this->getUser();
        $crechedata = $addCrecheRepository->findby(['user' => $user]);
        if (!$crechedata) {
            return $this->redirectToRoute('app_add_creche_new');
        }
        return $this->render('pro/message.html.twig', [
            'controller_name' => 'ProController',
            'user' => $user,
        ]);
    }


    #[Route('/pro_detail', name: 'app_pro_detail')]
    public function detail(AddCrecheRepository $addCrecheRepository): Response
    {
        $user = $this->getUser();
        $crechedata = $addCrecheRepository->findby(['user' => $user]);
        if (!$crechedata) {
            return $this->redirectToRoute('app_add_creche_new');
        }
        return $this->render('pro/detail.html.twig', [
            'controller_name' => 'ProController',
            'user' => $user,
        ]);
    }

    #[Route('/pro_demande', name: 'app_pro_demande')]
    public function demande(AddCrecheRepository $addCrecheRepository): Response
    {
        $user = $this->getUser();
        $crechedata = $addCrecheRepository->findby(['user' => $user]);
        if (!$crechedata) {
            return $this->redirectToRoute('app_add_creche_new');
        }
        return $this->render('pro/demande.html.twig', [
            'controller_name' => 'ProController',
            'user' => $user,
        ]);
    }
}
