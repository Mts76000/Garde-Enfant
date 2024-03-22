<?php

namespace App\DataFixtures;

use App\Entity\FullChild;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ChildFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        $child = new FullChild();
        $child->setNom('Dounard');
        $child->setPrenom('Bilel');
        $child->setAge('6');
        $child->setGenre('Femelle');
        $child->setConsigneAlimentaire('hallal');
        $child->setTraitement('Aucun');
        $child->setVaccin('à jour');
        $child->setAlergie('Fraise, Salade, Avocat, Polène');
        $child->setStatus('new');

        $manager->persist($child);
        $manager->flush();

        $child = new FullChild();
        $child->setNom('Bobi');
        $child->setPrenom('Guillame');
        $child->setAge('2');
        $child->setGenre('Mâle');
        $child->setConsigneAlimentaire('Vegan');
        $child->setTraitement('Lithium');
        $child->setVaccin('à jour');
        $child->setAlergie('Chat');
        $child->setStatus('new');

        $manager->persist($child);
        $manager->flush();

        $child = new FullChild();
        $child->setNom('Grand');
        $child->setPrenom('Tristan');
        $child->setAge('3');
        $child->setGenre('?');
        $child->setConsigneAlimentaire('');
        $child->setTraitement('');
        $child->setVaccin('');
        $child->setAlergie('Chat');
        $child->setStatus('new');

        $manager->persist($child);
        $manager->flush();
    }
}
