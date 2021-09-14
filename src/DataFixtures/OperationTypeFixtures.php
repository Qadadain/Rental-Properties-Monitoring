<?php

namespace App\DataFixtures;

use App\Entity\OperationType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OperationTypeFixtures extends Fixture
{
    public const OPERATIONTYPE = [
        [
            'type' => 'Crédit'
        ],
        [
            'type' => 'Débit'
        ],
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::OPERATIONTYPE as $data) {
            $operationType = new OperationType();
            $operationType->setType($data['type']);

            $manager->persist($operationType);
        }
        $manager->flush();
    }
}