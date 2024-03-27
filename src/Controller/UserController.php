<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\FullChildRepository;
use App\Repository\RdvRepository;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(RdvRepository $rdvRepository, FullChildRepository $fullchildRepository): Response
    {
        $user = $this->getUser();
        $enfants = $user->getFullChildren();

        $rdvs = $rdvRepository->findBy(['status' => 'open']);

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

        $pros = [];
        foreach ($rdvs as $rdv) {
            $pro = $rdv->getPro();
            if ($pro) {
                $pros[$rdv->getId()] = $pro;
            }
        }

        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
            'full_children' => $enfants,
            'user' => $user,
            'rdvs' => $rdvs,
            'childs' => $childs,
            'pros' => $pros,
        ]);
    }

    #[Route('/user_success', name: 'app_user_success')]
    public function success(): Response
    {
        $user = $this->getUser();
        return $this->render('user/success.html.twig', [
            'user' => $user,
        ]);
    }
}
