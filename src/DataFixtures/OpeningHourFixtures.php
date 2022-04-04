<?php

namespace App\DataFixtures;

use App\Entity\OpeningHour;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class OpeningHourFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $days = [
            ["Lundi", 1, new \DateTimeImmutable("2022-01-01 09:00:00"), new \DateTimeImmutable("2022-01-01 17:00:00")],
            ["Mardi", 2, new \DateTimeImmutable("2022-01-01 09:00:00"), new \DateTimeImmutable("2022-01-01 17:00:00")],
            ["Mercredi", 3, new \DateTimeImmutable("2022-01-01 09:00:00"), new \DateTimeImmutable("2022-01-01 17:00:00")],
            ["Jeudi", 4, new \DateTimeImmutable("2022-01-01 09:00:00"), new \DateTimeImmutable("2022-01-01 17:00:00")],
            ["Vendredi", 5, new \DateTimeImmutable("2022-01-01 09:00:00"), new \DateTimeImmutable("2022-01-01 17:00:00")],
            ["Samedi", 6, new \DateTimeImmutable("2022-01-01 09:00:00"), new \DateTimeImmutable("2022-01-01 12:00:00")],
            ["Dimanche", 7, null, null],
        ];

        $monday = new OpeningHour();
        $monday->setWeekDay("Lundi");
        $monday->setWeekNumber(1);
        $monday->setOpeningTime(new \DateTimeImmutable("2022-01-01 09:00:00"));
        $monday->setClosingTime(new \DateTimeImmutable("2022-01-01 17:00:00"));
        $manager->persist($monday);

        $manager->flush();
    }
}
