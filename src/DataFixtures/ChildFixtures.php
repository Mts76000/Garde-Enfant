<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Child;
use App\DataFixtures\UserFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;



class ChildFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $enfant = new child();

        $enfant->setNom('Benard');
        $enfant->setPrenom('Charlie');
        $enfant->setAge('1 ans');
        $enfant->setGenre('Masculin');
        $enfant->setConsigneAlimentaire('kaueuizevrff');
        $enfant->setTraitement('kaueuizevrff');
        $enfant->setVaccin(1);
        $enfant->setAlergie('akbrbre');
        $enfant->setUser($this->getReference(UserFixtures::ADMIN_USER_REFERENCE));
        $manager->persist($enfant);
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }

}
