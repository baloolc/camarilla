<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class UserFixtures extends Fixture
{
    public const MEMBER_NUMBER = 8;
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        $member = new User();
        $member->setEmail('member@cama.com');
        $member->setRoles(['ROLE_USER']);
        $member->setFirstname('Boby');
        $member->setLastname('Night');
        $hashedPassword = $this->passwordHasher->hashPassword(
            $member,
            'azerty'
        );
        $member->setPassword($hashedPassword);
        $this->addReference('user_0', $member);
        $manager->persist($member);

        $desk = new User();
        $desk->setEmail('desk@cama.com');
        $desk->setRoles(['ROLE_DESK']);
        $desk->setFirstname('Bob');
        $desk->setLastname('Dylan');
        $this->addReference('user_1', $desk);
        $hashedPassword = $this->passwordHasher->hashPassword(
            $desk,
            'qwerty'
        );
        $desk->setPassword($hashedPassword);
        $manager->persist($desk);

        $storyteller = new User();
        $storyteller->setEmail('storyteller@cama.com');
        $storyteller->setRoles(['ROLE_STORYTELLER']);
        $storyteller->setFirstname('Clem');
        $storyteller->setLastname('Bou');
        $this->addReference('user_2', $storyteller);
        $hashedPassword = $this->passwordHasher->hashPassword(
            $storyteller,
            'poiuyt'
        );
        $storyteller->setPassword($hashedPassword);
        $manager->persist($storyteller);

        $superAdmin = new User();
        $superAdmin->setEmail('superAdmin@cama.com');
        $superAdmin->setRoles(['ROLE_SUPERADMIN']);
        $superAdmin->setFirstname('Clem');
        $superAdmin->setLastname('Bou');
        $this->addReference($superAdmin->getEmail(),$superAdmin);
        $hashedPassword = $this->passwordHasher->hashPassword(
            $superAdmin,
            'poiuyt'
        );
        $superAdmin->setPassword($hashedPassword);

        $manager->persist($superAdmin);

        for ($i = 3; $i < self::MEMBER_NUMBER; $i++) {
            $aleaMember = new User();
            $aleaMember->setEmail($faker->email());
            $aleaMember->setRoles(['ROLE_USER']);
            $aleaMember->setFirstname($faker->name());
            $aleaMember->setLastname($faker->name());
            $hashedPassword = $this->passwordHasher->hashPassword(
                $aleaMember,
                $faker->sentence(
                    1,
                    true
                )
            );
            $aleaMember->setPassword($hashedPassword);
            $this->addReference('user_' . $i, $aleaMember);
            $manager->persist($aleaMember);
        }
        $manager->flush();
    }
}
