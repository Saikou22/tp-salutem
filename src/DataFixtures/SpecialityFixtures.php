<?php

namespace App\DataFixtures;

use App\Entity\Speciality;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class SpecialityFixtures extends Fixture
{

    public const DENTIST_REFERENCE = "speciality-dentist";
    public const GP_REFERENCE = "speciality-gp";
    public const OSTEO_REFERENCE = "speciality-osteo";

    public function load(ObjectManager $manager): void
    {
        $dentist = new Speciality();
        $dentist->setName("Dentiste");
        $manager->persist($dentist);
        $this->addReference(self::DENTIST_REFERENCE, $dentist);

        $gp = new Speciality();
        $gp->setName("Médecin Généraliste");
        $manager->persist($gp);
        $this->addReference(self::GP_REFERENCE, $gp);

        $osteopath = new Speciality();
        $osteopath->setName("Ostéopathe");
        $manager->persist($osteopath);
        $this->addReference(self::OSTEO_REFERENCE, $osteopath);

        $manager->flush();
    }
}
