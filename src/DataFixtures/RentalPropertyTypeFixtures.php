<?php

namespace App\DataFixtures;

use App\Entity\RentalPropertyType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class RentalPropertyTypeFixtures extends Fixture
{

    public const RENTAL_PROPERTY_TYPE = [
        [
            'type' => 'Appartement'
        ],
        [
            'type' => 'Garage'
        ],
        [
            'type' => 'Local commercial'
        ],
        [
            'type' => 'Maison'
        ],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::RENTAL_PROPERTY_TYPE as $data) {
            $rentalPropertyType = new RentalPropertyType();
            $rentalPropertyType->setType($data['type']);

            $manager->persist($rentalPropertyType);
        }
        $manager->flush();
    }
}
