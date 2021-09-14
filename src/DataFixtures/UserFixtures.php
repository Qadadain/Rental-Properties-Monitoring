<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private $encoder;

    public function __construct(UserPasswordHasherInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public const ADMIN = [
        'quentin.adadain@gmail.com' => [
            'roles'    => ['ROLE_ADMIN'],
            'pseudo'   => 'Rolls',
        ]
    ];

    public function load(ObjectManager $manager)
    {

        foreach (self::ADMIN as $email => $data) {
            $admin = new User();
            $hash = $this->encoder->hashPassword($admin, "password");
            $admin->setEmail($email)
                ->setRoles($data['roles'])
                ->setPseudo($data['pseudo'])
                ->setPassword($hash);

            $manager->persist($admin);
        }
        $manager->flush();
    }
}
