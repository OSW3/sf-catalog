<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AProductFixtures extends Fixture implements OrderedFixtureInterface
{
    // Definition de la liste des categories
    const DATA = [
        [
            'title' => "iPhone",
            'description' => "",
            'price' => 999.99,
            'brand' => null,
            "categories" => [
                null,
            ]
        ],
        [
            'title' => "Z Fold",
            'description' => "",
            'price' => 999.99,
            'brand' => null,
            "categories" => []
        ],
        [
            'title' => "Produit 3",
            'description' => "",
            'price' => 999.99,
            'brand' => null,
            "categories" => [
                null,
                null,
            ]
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::DATA as $data)
        {
            $product = new Product;

            $product->setTitle( $data['title'] );
            $product->setDescription( $data['description'] );
            $product->setPrice( $data['price'] );
            

            // $product->setBrand( $data['brand'] );

            // $product->addCategory( $data['categories'][0] );


            $manager->persist( $product );
        }

        $manager->flush();
    }

    public function getOrder(): int
    {
        return 1;
    }
}
