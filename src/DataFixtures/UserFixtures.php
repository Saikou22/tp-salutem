<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{

    public const ADMIN_REFERENCE = "user-admin";
    public const JOHN_REFERENCE = "user-john";

    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        $admin = new User();
        $admin->setFirstName("Pierre");
        $admin->setLastName("Jehan");
        $admin->setEmail("pierre.jehan@gmail.com");
        $admin->setPassword($this->hasher->hashPassword($admin, "1234"));
        $admin->setRoles(["ROLE_ADMIN"]);
        $manager->persist($admin);
        $this->addReference(self::ADMIN_REFERENCE, $admin);

        $john = new User();
        $john->setFirstName("John");
        $john->setLastName("Doe");
        $john->setEmail("john.doe@gmail.com");
        $john->setPassword($this->hasher->hashPassword($john, "1234"));
        $manager->persist($john);
        $this->addReference(self::JOHN_REFERENCE, $john);

        $manager->flush();
    }
}
