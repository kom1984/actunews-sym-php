<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Post;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        #1. Catégories

        $politique = new Category();
        $politique->setName('Politique')
            ->setSlug('politique');

        $economie = new Category();
        $economie->setName('Economie')
            ->setSlug('economie');

        $culture = new Category();
        $culture->setName('Culture')
            ->setSlug('culture');

        $loisirs = new Category();
        $loisirs->setName('Loisirs')
            ->setSlug('loisirs');

        $sport = new Category();
        $sport->setName('Sport')
            ->setSlug('sport');

        # Sauvegarde dans la BDD
        $manager->persist($politique);
        $manager->persist($economie);
        $manager->persist($culture);
        $manager->persist($loisirs);
        $manager->persist($sport);

        #2. User
        $user = User::create('Hugo', 'LIEGEARD', 'hugo@actu.news', 'demo');
        $manager->persist($user);

        # Utilisation de faker
        $faker = Factory::create('fr_FR');

        $categories = [$politique, $economie, $culture, $loisirs, $sport];

        #3. Posts
        for ($i = 0 ; $i < 20 ; $i++) {

            $post = new Post();
            $post->setTitle( $faker->sentence );
            $post->setSlug( $faker->slug );
            $post->setContent( $faker->text );
            $post->setUser( $user );
            $post->setImage( $faker->imageUrl(640, 480) );
            $post->setCategory( $categories[random_int(0 , 4)] );

            $manager->persist($post);

        }

        $manager->flush();
    }
}
