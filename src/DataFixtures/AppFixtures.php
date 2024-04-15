<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use App\Entity\Pokedex;

class AppFixtures extends Fixture
{

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');
        // $product = new Product();
        // $manager->persist($product);
        $pokemons = [];
        for  ($i=0; $i < 800 ; $i++){
            $pokemon = new Pokedex();
            $pokemon->setName($faker->word())
            ->setType($faker->word())
            ->setEvolution($faker->word())
            ->setStatistique($faker->word())
            ->setHp($faker->numberBetween(10, 400));
            $atkValues = [];
            $atkValues = [$faker->word(), $faker->numberBetween(5, 200)];
            $pokemon->setAtk($atkValues)
            ->setDefense($faker->numberBetween(0, 100))
            ->setWeight($faker->numberBetween(1, 999))
            ->setHeight($faker->numberBetween(1, 30))
            ->setImage($faker->imageUrl(400, 400, 'animals', true));
            
            $manager->persist($pokemon);
        };
        $manager->flush();
    }
}
