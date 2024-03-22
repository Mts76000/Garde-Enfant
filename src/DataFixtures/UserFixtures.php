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

        $admin = new User();
        $admin->setEmail('Jacky@admin.com');
        $hashedPassword = $this->passwordHasher->hashPassword(
            $admin,
            'admin'
        );
        $admin->setPassword($hashedPassword);
        $admin->setRoles(['ROLE_ADMIN']);
        $admin->setNom('Jacky');
        $admin->setPrenom('Kevin');
        $admin->setZIP(79320);
        $admin->setAdresse('Rue de Keke');
        $manager->persist($admin);

        // Création d'un utilisateur avec le rôle "ROLE_USER"
        $user = new User();
        $user->setEmail('user@user.com');
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            'password'
        );
        $user->setPassword($hashedPassword);
        $user->setRoles(['ROLE_PARENT']);
        $user->setNom('Doe');
        $user->setPrenom('John');
        $user->setZIP(12345);
        $user->setAdresse('123 Main Street');
        $manager->persist($user);

        $user = new User();
        $user->setEmail('Booba@user.com');
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            'password'
        );
        $user->setPassword($hashedPassword);
        $user->setRoles(['ROLE_PARENT']);
        $user->setNom('Ba');
        $user->setPrenom('Boo');
        $user->setZIP(97230);
        $user->setAdresse('4321 Street View');
        $manager->persist($user);

        $user = new User();
        $user->setEmail('Booba@user.com');
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            'password'
        );
        $user->setPassword($hashedPassword);
        $user->setRoles(['ROLE_PARENT']);
        $user->setNom('Ba');
        $user->setPrenom('Boo');
        $user->setZIP(12345);
        $user->setAdresse('22 Street View');
        $manager->persist($user);

        $user = new User();
        $user->setEmail('Bilel@user.com');
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            'password'
        );
        $user->setPassword($hashedPassword);
        $user->setRoles(['ROLE_PARENT']);
        $user->setNom('Bibi');
        $user->setPrenom('Bilel');
        $user->setZIP(14345);
        $user->setAdresse('10 Rue');
        $manager->persist($user);


        // Création d'un utilisateur avec le rôle "ROLE_PRO"
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
        $pro->setZIP(54200);
        $pro->setAdresse('456 Elm Street');
        $manager->persist($pro);

        $pro = new User();
        $pro->setEmail('pro@pro.com');
        $hashedPassword = $this->passwordHasher->hashPassword(
            $pro,
            'password'
        );
        $pro->setPassword($hashedPassword);
        $pro->setRoles(['ROLE_PRO']);
        $pro->setNom('Free');
        $pro->setPrenom('Jeanne');
        $pro->setZIP(54321);
        $pro->setAdresse('12 Place du cendare');
        $manager->persist($pro);

        $pro = new User();
        $pro->setEmail('Patton@pro.com');
        $hashedPassword = $this->passwordHasher->hashPassword(
            $pro,
            'password'
        );
        $pro->setPassword($hashedPassword);
        $pro->setRoles(['ROLE_PRO']);
        $pro->setNom('Patton');
        $pro->setPrenom('Gerard');
        $pro->setZIP(97120);
        $pro->setAdresse('12 Place du general');
        $manager->persist($pro);

        $manager->flush();

        $this->addReference(self::ADMIN_USER_REFERENCE, $admin);
    }
}
