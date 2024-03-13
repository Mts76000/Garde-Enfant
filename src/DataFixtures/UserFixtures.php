<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{

    private $passwordHasher;
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    

    public function load(ObjectManager $manager): void
    {
        $admin = new User();
        $admin->setEmail('admin@admin.fr');
        $hashedPassword = $this->passwordHasher->hashPassword(
            $admin,
            'michel'
        );
        $admin->setPassword($hashedPassword);
        $admin->setRoles(array('ROLE_ADMIN'));
        $manager->persist($admin);

        // role

        // parent

        $manager->flush();
    }
}
