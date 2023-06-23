<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        // Création d'un utilisateur
        $user = new User();
        $user->setEmail('user@monsite.com');
        $user->setRoles(['ROLE_USER']);
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            'userpassword'
        );
        $user->setPassword($hashedPassword);
        $user->setFirstname('Simple');
        $user->setLastname('User');
        $user->setDateBirth($faker->dateTime());
        $user->setAddress('1 rue du machin truc');
        $user->setZipCode('75000');
        $user->setCity('Paris');
        $user->setCountry('France');

        $this->addReference('user_1', $user);

        $manager->persist($user);

        // Création d'un administrateur
        $admin = new User();
        $admin->setEmail('admin@monsite.com');
        $admin->setRoles(['ROLE_ADMIN']);
        $hashedPassword = $this->passwordHasher->hashPassword(
            $admin,
            'adminpassword'
        );
        $admin->setPassword($hashedPassword);
        $admin->setFirstname('Mike');
        $admin->setLastname('Xiong');
        $admin->setDateBirth($faker->dateTime());
        $admin->setAddress('1 rue du machin truc');
        $admin->setZipCode('75000');
        $admin->setCity('Paris');
        $admin->setCountry('France');

        $this->addReference('user_2', $admin);


        $manager->persist($admin);

        $manager->flush();
    }
}
