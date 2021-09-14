<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{
    public const ADMIN = [
        'quentin.adadain@gmail.com' => [
            'roles'    => ['ROLE_ADMIN'],
            'pseudo'   => 'Rolls',
            'password' => 'Admin47'
        ]
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::ADMIN as $email => $data) {
            $admin = new User();
            $admin->setEmail($email)
                ->setRoles($data['roles'])
                ->setPseudo($data['pseudo'])
                ->setPassword($data['password']);

            $manager->persist($admin);
        }
        $manager->flush();
    }
}
