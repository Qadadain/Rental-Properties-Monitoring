<?php

namespace App\DataFixtures;

use App\Entity\RentReceipt;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class RentReceiptFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies(): array
    {
        return [TenantFixtures::class];
    }

    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');

        for ($i = 1; $i < 31; $i++) {
            $tenant = 1;
            $rentReceipt = new RentReceipt();
            $rentReceipt->setRent($faker->randomFloat(2,450,800))
                ->setAdvancesOnCharges($faker->randomFloat(2,50,150))
                ->setStartRent($faker->dateTimeBetween('-10 months'))
                ->setEndRent($faker->dateTimeBetween('-10 months'))
                ->setDate($faker->dateTimeBetween('-10 months'))
                ->setTotal($faker->randomFloat(2,550,800))
                ->setRentalNumber('4AZERD');
            $rentReceipt->setTenant($manager->find('App:Tenant', $tenant));
            $manager->persist($rentReceipt);
        }

        $manager->flush();
    }
}
