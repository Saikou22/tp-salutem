<?php

namespace App\DataFixtures;

use App\Entity\MedicalArea;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class MedicalAreaFixtures extends Fixture implements DependentFixtureInterface
{

    public const HOSPITAL_LAVAL_REFERENCE = "medical-area-hospital-laval";
    public const OFFICE_LOUVERNE_REFERENCE = "medical-area-office-louverne";
    public const OFFICE_RENNES_REFERENCE = "medical-area-office-rennes";

    public function load(ObjectManager $manager): void
    {
        $hospitalLaval = new MedicalArea();
        $hospitalLaval->setName('Hôpital de Laval');
        $hospitalLaval->setAreaType($this->getReference(AreaTypeFixtures::HOSPITAL_REFERENCE));
        $manager->persist($hospitalLaval);
        $this->addReference(self::HOSPITAL_LAVAL_REFERENCE, $hospitalLaval);

        $officeLouverne = new MedicalArea();
        $officeLouverne->setName('Cabinet de Louverné');
        $officeLouverne->setAreaType($this->getReference(AreaTypeFixtures::OFFICE_REFERENCE));
        $manager->persist($officeLouverne);
        $this->addReference(self::OFFICE_LOUVERNE_REFERENCE, $officeLouverne);

        $officeRennes = new MedicalArea();
        $officeRennes->setName('Cabinet de Rennes');
        $officeRennes->setAreaType($this->getReference(AreaTypeFixtures::OFFICE_REFERENCE));
        $manager->persist($officeRennes);
        $this->addReference(self::OFFICE_RENNES_REFERENCE, $officeRennes);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [AreaTypeFixtures::class];
    }
}
