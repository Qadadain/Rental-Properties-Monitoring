<?php

namespace App\DataFixtures;

use App\Entity\RentalPropertyAccounting;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class RentalPropertyAccountingFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies(): array
    {
        return [LabelFixtures::class, OperationTypeFixtures::class, PropertyFixtures::class];
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for ($i = 1; $i < 31; $i++) {
            $rentalPropertyAccounting = new RentalPropertyAccounting();
            $comment = 'nada';
            $rentalProperty = rand(1, 9);
            $label = rand(1, 7);
            $operationType = rand(1, 2);
            $rentalPropertyAccounting->setComment($comment)
                ->setValue($faker->randomFloat(2,0,1000));
            $rentalPropertyAccounting->setRentalProperty($manager->find('App:RentalProperty', $rentalProperty));
            $rentalPropertyAccounting->setLabel($manager->find('App:Label', $label));
            $rentalPropertyAccounting->setOperationType($manager->find('App:OperationType', $operationType));

            $manager->persist($rentalPropertyAccounting);
        }
        $manager->flush();
    }
}
