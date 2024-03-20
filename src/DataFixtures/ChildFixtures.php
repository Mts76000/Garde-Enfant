<?php

namespace App\DataFixtures;

use App\Entity\FullChild;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ChildFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Enfant 1
        $child1 = new FullChild();
        $child1->setNom('Durand');
        $child1->setPrenom('Lucie');
        $child1->setAge('8 ans');
        $child1->setGenre('Fille');
        $child1->setConsigneAlimentaire('Pas de lactose');
        $child1->setTraitement('Traitement Y');
        $child1->setVaccin(0);
        $child1->setAlergie('Aucune');
        $child1->setStatus('new');
        $manager->persist($child1);

        // Enfant 2
        $child2 = new FullChild();
        $child2->setNom('Martin');
        $child2->setPrenom('Paul');
        $child2->setAge('6 ans');
        $child2->setGenre('Garçon');
        $child2->setConsigneAlimentaire('Pas de fruits à coque');
        $child2->setTraitement('Traitement Z');
        $child2->setVaccin(1);
        $child2->setAlergie('Aucune');
        $child2->setStatus('new');
        $manager->persist($child2);

        // Enfant 3
        $child3 = new FullChild();
        $child3->setNom('Petit');
        $child3->setPrenom('Alice');
        $child3->setAge('4 ans');
        $child3->setGenre('Fille');
        $child3->setConsigneAlimentaire('Pas de gluten');
        $child3->setTraitement('Traitement X');
        $child3->setVaccin(1);
        $child3->setAlergie('Aucune');
        $child3->setStatus('new');
        $manager->persist($child3);

        // Enfant 4
        $child4 = new FullChild();
        $child4->setNom('Leblanc');
        $child4->setPrenom('Thomas');
        $child4->setAge('7 ans');
        $child4->setGenre('Garçon');
        $child4->setConsigneAlimentaire('Pas de gluten');
        $child4->setTraitement('Traitement Y');
        $child4->setVaccin(0);
        $child4->setAlergie('Aucune');
        $child4->setStatus('new');
        $manager->persist($child4);

        $manager->flush();
    }
}
