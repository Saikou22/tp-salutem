<?php

namespace App\Entity;

use App\Repository\AppointmentRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: AppointmentRepository::class)]
class Appointment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'datetime_immutable')]
    #[Assert\GreaterThanOrEqual('now')] // Bloquer la création de rendez-vous avant aujourd'hui (côté serveur)
    private \DateTimeImmutable $dateAt;

    #[ORM\ManyToOne(targetEntity: Doctor::class, inversedBy: 'appointments')]
    private ?Doctor $doctor;

    #[ORM\ManyToOne(targetEntity: Speciality::class, inversedBy: 'appointments')]
    #[ORM\JoinColumn(nullable: false)]
    private Speciality $speciality;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'appointments')]
    #[ORM\JoinColumn(nullable: false)]
    private User $user;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $message;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateAt(): ?\DateTimeImmutable
    {
        return $this->dateAt;
    }

    public function setDateAt(\DateTimeImmutable $dateAt): self
    {
        $this->dateAt = $dateAt;

        return $this;
    }

    public function getDoctor(): ?Doctor
    {
        return $this->doctor;
    }

    public function setDoctor(?Doctor $doctor): self
    {
        $this->doctor = $doctor;

        return $this;
    }

    public function getSpeciality(): ?Speciality
    {
        return $this->speciality;
    }

    public function setSpeciality(?Speciality $speciality): self
    {
        $this->speciality = $speciality;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function hasProblems(): bool
    {
        // appointment.doctor and appointment.speciality.id != appointment.doctor.speciality.id
        if ($this->getDoctor() && $this->getSpeciality()->getId() !== $this->getDoctor()->getSpeciality()->getId()) {
            return true;
        }

        return false;
    }
}
