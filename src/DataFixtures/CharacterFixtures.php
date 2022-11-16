<?php

namespace App\DataFixtures;

use App\Entity\Character;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class CharacterFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for($i = 0; $i < 10; $i++) {
            $character = new Character();
            $character->setName($faker->name());
            $character->setLink($faker->url());
            $character->setClan($faker->name());
            $character->setAgeStatus($faker->name());
            $character->setRecognized($faker->name());
            $manager->persist($character);
        }
        $manager->flush();
    }
}
