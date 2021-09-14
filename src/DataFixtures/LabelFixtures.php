<?php

namespace App\DataFixtures;

use App\Entity\Label;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class LabelFixtures extends Fixture
{
    public const LABEL = [
        [
            'name' => 'Eau',
            'color' => '#79c0ff'
        ],
        [
            'name' => 'Gaz',
            'color' => '#ff0000'
        ],
        [
            'name' => 'Loyer',
            'color' => '#00ff09'
        ],
        [
            'name' => 'Électricité',
            'color' => '#fff900'
        ],
        [
            'name' => 'Taxe foncière',
            'color' => '#00FFC4'
        ],
        [
            'name' => 'Travaux',
            'color' => '#7d7d7d'
        ],
        [
            'name' => 'Crédit bancaire',
            'color' => '#e502ff'
        ],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::LABEL as $data) {
            $label = new Label();
            $label->setName($data['name']);
            $label->setColor($data['color']);

            $manager->persist($label);
        }
        $manager->flush();
    }
}
