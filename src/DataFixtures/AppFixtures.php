<?php

namespace App\DataFixtures;

use App\Entity\Article;
use Faker;
use App\Entity\Categorie;
use App\Entity\User;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $tabCats=[];
        $tabUsers=[];
        $faker = Faker\Factory::create('fr_FR');
        for($i= 0; $i<10; $i++)
        {        
            $cat= new Categorie();
            $cat->setNom($faker->company());
            $manager->persist($cat);
            $tabCats[]= $cat;
        }
        for($i= 0; $i<5; $i++)
        {
            $user= new User();
            $user->setEmail($faker->email());
            $user->setRoles(['ROLE_USER']);
            $user->setPassword(password_hash("Test1234",PASSWORD_BCRYPT));
            $user->setNom($faker->lastName());
            $user->setPrenom($faker->firstName());          
            $manager->persist($user);
            $tabUsers[]= $user;
        }
        for($i= 0; $i<10; $i++)
        {
            $art= new Article();
            $art->setTitre($faker->jobTitle());
            $art->setContenu($faker->sentence(5));
            $art->setDate(new DateTime($faker->date('Y-m-d H:i:s')));
            $art->setUser($tabUsers[$faker->numberBetween(0,4)]);
            $art->addCategory($tabCats[$faker->numberBetween(0,2)]);
            $art->addCategory($tabCats[$faker->numberBetween(3,5)]);
            $art->addCategory($tabCats[$faker->numberBetween(6,9)]);
            $manager->persist($art);
        }
       
        
        $manager->flush();
    }
}
