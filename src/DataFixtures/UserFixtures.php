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
        // Création d'un utilisateur avec le rôle "ROLE_ADMIN"
        $admin = new User();
        $admin->setEmail('admin@admin.com');
        $hashedPassword = $this->passwordHasher->hashPassword(
            $admin,
            'admin'
        );
        $admin->setPassword($hashedPassword);
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setNom('Bertollucci');
        $admin->setPrenom('Michel');
        $admin->setZIP(75320);
        $admin->setAdresse('Rue des Rosiers');
        $manager->persist($admin);


        $user = new User();
        $user->setEmail('user@user.com');
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            'password'
        );
        $user->setPassword($hashedPassword);
        $user->setRoles(['ROLE_USER']);
        $user->setNom('Doe');
        $user->setPrenom('John');
        $user->setZIP(12345);
        $user->setAdresse('123 Main Street');
        $manager->persist($user);


        $pro = new User();
        $pro->setEmail('pro@pro.com');
        $hashedPassword = $this->passwordHasher->hashPassword(
            $pro,
            'password'
        );
        $pro->setPassword($hashedPassword);
        $pro->setRoles(['ROLE_PRO']);
        $pro->setNom('Smith');
        $pro->setPrenom('Alice');
        $pro->setZIP(54321);
        $pro->setAdresse('456 Elm Street');
        $manager->persist($pro);

        $manager->flush();

        $this->addReference(self::ADMIN_USER_REFERENCE, $admin);
    }
}
