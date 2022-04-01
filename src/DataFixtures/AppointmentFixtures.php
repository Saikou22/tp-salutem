<?php

namespace App\DataFixtures;

use App\Entity\Appointment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class AppointmentFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $today = new \DateTimeImmutable();

        // Rendez-vous passé ayant été affecté à un docteur
        $appointment1 = new Appointment();
        $appointment1->setDateAt($today->modify("-1 day"));
        $appointment1->setSpeciality($this->getReference(SpecialityFixtures::GP_REFERENCE));
        $appointment1->setDoctor($this->getReference(DoctorFixtures::NORMA_REFERENCE));
        $appointment1->setUser($this->getReference(UserFixtures::JOHN_REFERENCE));
        $manager->persist($appointment1);

        // Rendez-vous dans 5 jours affecté à un docteur
        $appointment2 = new Appointment();
        $appointment2->setDateAt($today->modify("+5 day"));
        $appointment2->setSpeciality($this->getReference(SpecialityFixtures::DENTIST_REFERENCE));
        $appointment2->setDoctor($this->getReference(DoctorFixtures::MARIA_REFERENCE));
        $appointment2->setUser($this->getReference(UserFixtures::JOHN_REFERENCE));
        $manager->persist($appointment2);
        
        // Rendez-vous dans 8 jours pas encore affecté à un docteur
        $appointment3 = new Appointment();
        $appointment3->setDateAt($today->modify("+8 day"));
        $appointment3->setSpeciality($this->getReference(SpecialityFixtures::GP_REFERENCE));
        $appointment3->setUser($this->getReference(UserFixtures::JOHN_REFERENCE));
        $manager->persist($appointment3);
        
        // Rendez-vous dans 10 jours affecté au mauvais docteur
        $appointment4 = new Appointment();
        $appointment4->setDateAt($today->modify("+10 day"));
        $appointment4->setSpeciality($this->getReference(SpecialityFixtures::GP_REFERENCE));
        $appointment4->setDoctor($this->getReference(DoctorFixtures::MARIA_REFERENCE));
        $appointment4->setUser($this->getReference(UserFixtures::JOHN_REFERENCE));
        $manager->persist($appointment4);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            SpecialityFixtures::class,
            DoctorFixtures::class
        ];
    }
}
