<?php

namespace App\DataFixtures;

use App\Entity\Contact;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ContactFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $message = new Contact();
        $message->setNom('Morand');
        $message->setPrenom('tristan');
        $message->setEmail('tristan76190@icloud.com');
        $message->setMessage('Bonjour je me met en bdd');
        $message->setCreatedAt(new \DateTimeImmutable());
        $message->setStatus('New');
        $manager->persist($message);


        $message1 = new Contact();
        $message1->setNom('Morand');
        $message1->setPrenom('tristan');
        $message1->setEmail('tristan76190@icloud.com');
        $message1->setMessage('Bonjour je me met en bdd');
        $message1->setCreatedAt(new \DateTimeImmutable());
        $message1->setStatus('New');
        $manager->persist($message1);

        $manager->flush();
    }
}
