<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    // Definition de la liste des categories
    const DATA = [

        // Categorie 1
        [
            'name' => "Sport",
            'description' => "Description de la catégorie sport",
            'color' => "#FF0000",
        ],

        // Categorie 2
        [
            'name' => "Informatique",
            'description' => null,
            'color' => "#00FF00",
        ],

        // Categorie 3
        [
            'name' => "Boisson",
            'description' => "Description de la catégorie boisson",
            'color' => "#0000FF",
        ],

    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::DATA as $data)
        {
            // Instance de l'entité category
            $category = new Category;

            // Affectation des valeurs aux propriété de $category
            $category->setName( $data['name'] );
            $category->setDescription( $data['description'] );
            $category->setColor( $data['color'] );

            // On persiste l'entité
            $manager->persist( $category );
        }

        $manager->flush();
    }
}
