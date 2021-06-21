<?php

namespace App\DataFixtures;

use Faker;
use Faker\Factory;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Category;
use App\Entity\Article;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Faker\Factory::create('fr_FR');

        $users = [];
        $categories = [];
        $articles = [];

        for ($i = 0; $i < 50; $i++) {
            //creation d'un user
            $user = new User();
            // utilisation des setters pour lui affecter des valeurs
            $user->setUsername($faker->name)
                ->setFirstname($faker->firstname)
                ->setLastname($faker->lastname)
                ->setEmail($faker->email)
                ->setPassword($faker->password)
                // on utilise \DateTime parce que c'est pas un objet que nous avons instancié, c un objet natif de PHP
                ->setCreatedAt(new \DateTime);

            // enregistrer les données coté PHP
            $manager->persist($user);

            $users[] = $user;
        }
        
        for ($i=0; $i < 15; $i++) { 
            $category = new Category();

            $category->setTitle($faker->text(50))
            ->setDescription($faker->text(250))
            ->setImage($faker->imageUrl());

            $manager->persist($category);

            $categories[] = $category;
        }

        for ($i=0; $i < 100; $i++) { 
            $article = new Article();
            $article->setTitle($faker->text(50))
            ->setContent($faker->text(5000))
            ->setImage($faker->imageUrl())
            ->setCreatedAt(new \DateTime)
            ->addCategory($categories[$faker->numberBetween(0,14)]) // addCategory -> car on peut attribuer beaucoup de categories
            ->setAuthor($users[$faker->numberBetween(0,49)]);

            $manager->persist($article);

            $articles[]= $article;
        }

        $manager->flush();
    }
}
