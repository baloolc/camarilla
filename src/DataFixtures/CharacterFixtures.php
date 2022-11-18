<?php

namespace App\DataFixtures;

use App\Entity\Character;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class CharacterFixtures extends Fixture implements DependentFixtureInterface
{

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for($i = 0; $i < UserFixtures::MEMBER_NUMBER; $i++) {
            for($j = 0; $j < 2; $j++){
            $character = new Character();
            $character->setName($faker->name());
            $character->setLink($faker->url());
            $character->setClan($faker->name());
            $character->setAgeStatus($faker->name());
            $character->setRecognized($faker->name());
            $character->setUser($this->getReference('user_' . $i));
            $manager->persist($character);
            }
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            UserFixtures::class,
        ];
    }
}
