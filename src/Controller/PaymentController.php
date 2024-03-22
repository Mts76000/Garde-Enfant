<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Stripe;

class PaymentController extends AbstractController
{
    #[Route('/order/create-session-stripe', name: 'app_payment')]
    public function stripeCheckout(): RedirectResponse
    {
        \Stripe\Stripe::setApiKey('sk_test_VePHdqKTYQjKNInc7u56JBrQ');
        header('Content-Type: application/json');

        $YOUR_DOMAIN = 'http://localhost:4242';

        $checkout_session = \Stripe\Checkout\Session::create([
            'line_items' => [[
                # Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
                'price' => '{{PRICE_ID}}',
                'quantity' => 1,
            ]],
            'mode' => 'payment',
            'success_url' => $YOUR_DOMAIN . '/success.html',
            'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
        ]);
    }

    #[Route('/payment', name: 'app_payment')]
    public function index(): Response
    {
        return $this->render('payment/index.html.twig', [
            'controller_name' => 'PaymentController',
        ]);
    }

}

//https://docs.stripe.com/checkout/quickstart?lang=php