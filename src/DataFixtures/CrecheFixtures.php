<?php

namespace App\DataFixtures;

use App\Entity\AddCreche;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CrecheFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        $creche1 = new AddCreche();
        $creche1->setId(1);
        $creche1->setIdUser(1);
        $creche1->setNom('La Petite Crechette');
        $creche1->setSiret(454154);
        $creche1->setTarif('12');
        $creche1->setMaxEnfant('20');
        $creche1->setAdresse('50 rue rivoli');
        $creche1->setEmail('petite-crechette@gmail.com');
        $creche1->setTelephone('0747848596');
        $creche1->setStatus('waiting');
        $creche1->setBrochureFilename('petite_creche.pdf');
        $creche1->setCreatedAt(new \DateTimeImmutable());
        $creche1->setModifiedAt(NULL);
        $manager->persist($creche1);

        $creche2 = new AddCreche();
        $creche2->setId(1);
        $creche2->setIdUser(1);
        $creche2->setNom('Les filous');
        $creche2->setSiret(85475);
        $creche2->setTarif('15');
        $creche2->setMaxEnfant('35');
        $creche2->setAdresse('50 rue de la république');
        $creche2->setEmail('les-filous@gmail.com');
        $creche2->setTelephone('0454896532');
        $creche2->setStatus('validated');
        $creche2->setBrochureFilename('les_filous.pdf');
        $creche2->setCreatedAt(new \DateTimeImmutable());
        $creche2->setModifiedAt(NULL);
        $manager->persist($creche2);

        $creche3 = new AddCreche();
        $creche3->setId(1);
        $creche3->setIdUser(1);
        $creche3->setNom('Pitchoune');
        $creche3->setSiret(04475);
        $creche3->setTarif('10');
        $creche3->setMaxEnfant('45');
        $creche3->setAdresse('10 rue des carmes, 76000');
        $creche3->setEmail('pitchoune@gmail.com');
        $creche3->setTelephone('0854896532');
        $creche3->setStatus('validated');
        $creche3->setBrochureFilename('pitchoune.pdf');
        $creche3->setCreatedAt(new \DateTimeImmutable());
        $creche3->setModifiedAt(NULL);
        $manager->persist($creche3);

        $manager->flush();
    }
}
