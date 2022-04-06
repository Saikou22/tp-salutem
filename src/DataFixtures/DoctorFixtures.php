<?php

namespace App\DataFixtures;

use App\Entity\Doctor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class DoctorFixtures extends Fixture implements DependentFixtureInterface
{

    public const JACK_REFERENCE = "doctor-jack";
    public const NORMA_REFERENCE = "doctor-norma";
    public const MARIA_REFERENCE = "doctor-maria";

    public function load(ObjectManager $manager): void
    {
        $jack = new Doctor();
        $jack->setFirstName("Jack");
        $jack->setLastName("Smith");
        $jack->setPhoto("doctor-1.jpg");
        $jack->setEmail("jack.smith@gmail.com");
        $jack->setPhone("0685478522");
        $jack->setDescription("La description de Jack Smith");
        $jack->setSpeciality($this->getReference(SpecialityFixtures::OSTEO_REFERENCE));
        $jack->addMedicalArea($this->getReference(MedicalAreaFixtures::HOSPITAL_LAVAL_REFERENCE));
        $jack->addMedicalArea($this->getReference(MedicalAreaFixtures::OFFICE_LOUVERNE_REFERENCE));
        $manager->persist($jack);
        $this->addReference(self::JACK_REFERENCE, $jack);

        $norma = new Doctor();
        $norma->setFirstName("Norma");
        $norma->setLastName("Pedric");
        $norma->setPhoto("doctor-2.jpg");
        $norma->setEmail("norma.pedric@gmail.com");
        $norma->setDescription("La description de Norma Pedric");
        $norma->setSpeciality($this->getReference(SpecialityFixtures::GP_REFERENCE));
        $norma->addMedicalArea($this->getReference(MedicalAreaFixtures::OFFICE_LOUVERNE_REFERENCE));
        $manager->persist($norma);
        $this->addReference(self::NORMA_REFERENCE, $norma);

        $maria = new Doctor();
        $maria->setFirstName("Maria");
        $maria->setLastName("Martin");
        $maria->setPhoto("doctor-3.jpg");
        $maria->setSpeciality($this->getReference(SpecialityFixtures::DENTIST_REFERENCE));
        $manager->persist($maria);
        $this->addReference(self::MARIA_REFERENCE, $maria);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [SpecialityFixtures::class, MedicalAreaFixtures::class];
    }
}
