<?php

namespace App\DataFixtures;

use App\Entity\PropertyAccounting;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PropertyAccountingFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies(): array
    {
        return [LabelFixtures::class, OperationTypeFixtures::class, PropertyFixtures::class];
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for ($i = 1; $i < 21; $i++) {
            $propertyAccounting = new PropertyAccounting();
            $comment = '';
            $property = rand(1, 3);
            $label = rand(1, 7);
            $operationType = rand(1, 2);
            $propertyAccounting->setComment($comment)
                ->setValue($faker->randomFloat(2,-1000,1000));
            $propertyAccounting->setProperty($manager->find('App:Property', $property));
            $propertyAccounting->setLabel($manager->find('App:Label', $label));
            $propertyAccounting->setOperationType($manager->find('App:OperationType', $operationType));

            $manager->persist($propertyAccounting);
        }
        $manager->flush();
    }
}
