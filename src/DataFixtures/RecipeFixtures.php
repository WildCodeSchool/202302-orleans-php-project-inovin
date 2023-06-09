<?php

namespace App\DataFixtures;

use App\Entity\Recipe;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class RecipeFixtures extends Fixture implements DependentFixtureInterface
{
    public const RECIPE_COUNT = 6;
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        $shiftId = 0;
        for ($i = 0; $i < self::RECIPE_COUNT; $i++) {
            $recipe = new Recipe();

            $recipe->setName($faker->name());
            $recipe->setSessionRate($faker->randomNumber(1));
            $recipe->setSession($this->getReference('session_' . $i));
            $recipe->setUser($this->getReference('user_0'));

            $tastingSheet1 = $this->getReference('tastingSheet_' . ($i + $shiftId));
            $tastingSheet2 = $this->getReference('tastingSheet_' . ($i + $shiftId + 1));
            $tastingSheet3 = $this->getReference('tastingSheet_' . ($i + $shiftId + 2));
            $tastingSheet4 = $this->getReference('tastingSheet_' . ($i + $shiftId + 3));

            $shiftId += 3;
            $recipe->addTastingSheet($tastingSheet1);
            $recipe->addTastingSheet($tastingSheet2);
            $recipe->addTastingSheet($tastingSheet3);
            $recipe->addTastingSheet($tastingSheet4);

            $this->addReference('recipe_' . $i, $recipe);

            $manager->persist($recipe);
        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            TastingSheetFixtures::class,
            SessionFixtures::class,
        ];
    }
}
