<?php

namespace App\DataFixtures;

use App\Entity\FullChild;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ChildFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $child = new FullChild();
        $child->setNom('Dounar');
        $child->setUser($this->getReference(UserFixtures::ADMIN_USER_REFERENCE));
        $child->setPrenom('Bilel');
        $child->setAge('6');
        $child->setGenre('Male');
        $child->setConsigneAlimentaire('Hallal');
        $child->setTraitement('Aucun');
        $child->setVaccin(1);
        $child->setAlergie('Fraise, Salade, Avocat, Polène');
        $child->setStatus('new');

        $manager->persist($child);
        $manager->flush();

        $child = new FullChild();
        $child->setUser($this->getReference(UserFixtures::ADMIN_USER_REFERENCE));
        $child->setNom('Bobi');
        $child->setPrenom('Guillame');
        $child->setAge('2');
        $child->setGenre('Mâle');
        $child->setConsigneAlimentaire('Vegan');
        $child->setTraitement('Lithium');
        $child->setVaccin(0);
        $child->setAlergie('Chat');
        $child->setStatus('new');

        $manager->persist($child);
        $manager->flush();

        $child = new FullChild();
        $child->setUser($this->getReference(UserFixtures::ADMIN_USER_REFERENCE));
        $child->setNom('Grand');
        $child->setPrenom('Tristan');
        $child->setAge('3');
        $child->setGenre('?');
        $child->setConsigneAlimentaire('');
        $child->setTraitement('');
        $child->setVaccin('0');
        $child->setAlergie('Chat');
        $child->setStatus('new');

        $manager->persist($child);
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }
}
