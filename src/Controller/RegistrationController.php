<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class RegistrationController extends BaseController
{
    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            
            // encode the plain password
            $user->setRoles(array($form->get('roless')->getData()));
            // $user->setCR(new DateTimeImmutable());
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            

            $entityManager->persist($user);
            $entityManager->flush();

            // do anything else you need here, like send an email

            // return $this->redirectToRoute('app_register_success');
            return $this->redirectToRoute('app_register_success');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form,
        ]);
    }

    
    
    #[Route('/succes_register', name: 'app_register_success')]
    public function success(): Response
    {         
        return $this->render('registration/success.html.twig', [
       
        ]);
    }
}
