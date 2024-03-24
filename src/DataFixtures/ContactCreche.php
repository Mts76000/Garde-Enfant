<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ContactCreche extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $message = new \App\Entity\ContactCreche();
        $message->setNom('Tabasco');
        $message->setPrenom('Juan');
        $message->setEmail('juantabasco@gmail.com');
        $message->setMessage('Bonjour, j\'aime le tabasco');
        $message->setStatus('new');

        $message = new \App\Entity\ContactCreche();
        $message->setNom('Feat');
        $message->setPrenom('Booba');
        $message->setEmail('boobafeat@gmail.com');
        $message->setMessage('Bonjour, j\'aime le mouton');
        $message->setStatus('new');


        $manager->flush();
    }
}
