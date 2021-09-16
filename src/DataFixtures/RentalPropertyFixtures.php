<?php

namespace App\DataFixtures;

use App\Entity\RentalProperty;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;

class RentalPropertyFixtures extends Fixture implements DependentFixtureInterface
{
    protected $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function getDependencies(): array
    {
        return [PropertyFixtures::class, RentalPropertyTypeFixtures::class];
    }

    public const RENTAL_PROPERTY = [
        [
            'name' => 'Appartement A',
            'comment' => 'nada',
        ],
        [
            'name' => 'Appartement B',
            'comment' => 'nada',
        ],
        [
            'name' => 'Appartement C',
            'comment' => 'nada',
        ],
        [
            'name' => 'Appartement I',
            'comment' => 'nada',
        ],
        [
            'name' => 'Appartement II',
            'comment' => 'nada',
        ],
        [
            'name' => 'Appartement III',
            'comment' => 'nada',
        ],
        [
            'name' => 'Appartement 1',
            'comment' => 'nada',
        ],
        [
            'name' => 'Appartement 2',
            'comment' => 'nada',
        ],
        [
            'name' => 'Appartement 3',
            'comment' => 'nada',
        ],

    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::RENTAL_PROPERTY as $data) {
            $rentalProperty = new RentalProperty();
            $property = rand(1,3);
            $propertyType = rand(1,4);
            $rentalProperty->setName($data['name'])
                ->setComment($data['comment'])
                ->setSlug($this->slugger->slug(strtolower($rentalProperty->getName())));
            $rentalProperty->setProperty($manager->find('App:Property', $property));
            $rentalProperty->setRentalPropertyType($manager->find('App:RentalPropertyType', $propertyType));
            $manager->persist($rentalProperty);
        }
        $manager->flush();
    }
}
