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

        foreach ($days as $day) {
            $openingHour = new OpeningHour();
            $openingHour->setWeekDay($day[0]);
            $openingHour->setWeekNumber($day[1]);
            $openingHour->setOpeningTime($day[2]);
            $openingHour->setClosingTime($day[3]);
            $manager->persist($openingHour);
        }

        $manager->flush();
    }
}
