<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Stripe;
use Symfony\Component\Security\Core\User\UserInterface;

class PaymentController extends AbstractController
{

    #[Route('/payment', name: 'app_payment')]
    public function index(): Response
    {
        $user = $this->getUser();

        return $this->render('payment/index.html.twig', [
            'controller_name' => 'PaymentController',
            'user' => $user,

        ]);
    }
}

//https://docs.stripe.com/checkout/quickstart?lang=php