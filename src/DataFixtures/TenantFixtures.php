<?php

namespace App\DataFixtures;

use App\Entity\Tenant;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class TenantFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies(): array
    {
        return [RentalPropertyFixtures::class];
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for ($t = 0; $t < 10; $t++){

            $tenant = new Tenant();
            $id = rand(1, 9);
            $tenant->setLastName($faker->lastName)
                ->setFirstName($faker->firstName)
                ->setEntry($faker->dateTimeBetween('-6 months'));

            $tenant->setRentalProperty($manager->find('App:RentalProperty', $id));
            $manager->persist($tenant);
        }

        $manager->flush();
    }
}
