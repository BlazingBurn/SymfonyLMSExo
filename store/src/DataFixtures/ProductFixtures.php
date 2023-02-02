<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i=0; $i < 5; $i++) {

            $entity = new Product();
            $entity
                ->setName("pomme $i")
                ->setDescription("Une pomme")
                ->setPrice($i)
                ->setSlug("pomme$i")
                ->setImage("pomme.png")
            ;

            $manager->persist($entity);

        }

        $manager->flush();
    }
}
