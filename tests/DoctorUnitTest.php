<?php

namespace App\Tests;

use App\Entity\Doctor;
use PHPUnit\Framework\TestCase;

class DoctorUnitTest extends TestCase
{
    public function testFullName(): void
    {
        $doctor = new Doctor();
        $doctor->setFirstName("John");
        $doctor->setLastName("Doe");

        $this->assertSame("Dr. John Doe", $doctor->getFullName());
    }

    public function testFullNameWithSpeciality(): void
    {
        $doctor = new Doctor();
        $doctor->setFirstName("John");
        $doctor->setLastName("Doe");

        $this->assertSame("Dr. John Doe", $doctor->getFullNameWithSpeciality());
    }
}
