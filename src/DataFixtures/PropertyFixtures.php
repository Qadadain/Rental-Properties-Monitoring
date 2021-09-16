<?php

namespace App\DataFixtures;

use App\Entity\Property;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;

class PropertyFixtures extends Fixture
{
    protected $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public const PROPERTY = [
        [
            'name' => 'Localisation ABC',
            'city' => 'Bordeaux',
            'address' => 'rue paul dénucé',
            'comment' => 'immeuble avec des appartements',
        ],
        [
            'name' => 'Localisation I II III',
            'city' => 'Bayona',
            'address' => 'rue du piment',
            'comment' => 'immeuble avec des appartements',
        ],
        [
            'name' => 'Localisation 1 2 3',
            'city' => 'Paris',
            'address' => 'boulevard de la libération',
            'comment' => 'immeuble avec des appartements',
        ],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::PROPERTY as $data) {
            $property = new Property();
            $property->setName($data['name'])
                ->setCity($data['city'])
                ->setAddress($data['address'])
                ->setComment($data['comment'])
                ->setSlug($this->slugger->slug(strtolower($property->getName())));

            $manager->persist($property);
        }
        $manager->flush();
    }
}
