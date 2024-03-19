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

    public const ADMIN_USER_REFERENCE = 'admin';


    public function load(ObjectManager $manager): void
    {


        $admin = new User();
        $admin->setEmail('admin@admin.com');
        $hashedPassword = $this->passwordHasher->hashPassword(
            $admin,
            'admin'
        );
        $admin->setPassword($hashedPassword);
        $admin->setRoles(array('ROLE_ADMIN'));
        $admin->setNom('Bertollucci');
        $admin->setPrenom('michel');
        $admin->setZIP(75320);
        $admin->setAdresse('Rue des rosiers');
        $manager->persist($admin); 
    
       
        // role

        // parent

        $manager->flush();


        $this->addReference(self::ADMIN_USER_REFERENCE, $admin);

    }
}
