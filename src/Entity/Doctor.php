<?php

namespace App\Entity;

use App\Repository\DoctorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DoctorRepository::class)]
class Doctor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $firstName;

    #[ORM\Column(type: 'string', length: 255)]
    private string $lastName;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $photo;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $description;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $email;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private ?string $phone;

    #[ORM\ManyToOne(targetEntity: Speciality::class, inversedBy: 'doctors')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Speciality $speciality = null;

    #[ORM\OneToMany(mappedBy: 'doctor', targetEntity: Appointment::class)]
    private Collection $appointments;

    #[ORM\ManyToMany(targetEntity: MedicalArea::class, mappedBy: 'doctors')]
    private Collection $medicalAreas;

    public function __construct()
    {
        $this->appointments = new ArrayCollection();
        $this->medicalAreas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

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

    /**
     * @return Collection<int, Appointment>
     */
    public function getAppointments(): Collection
    {
        return $this->appointments;
    }

    public function addAppointment(Appointment $appointment): self
    {
        if (!$this->appointments->contains($appointment)) {
            $this->appointments[] = $appointment;
            $appointment->setDoctor($this);
        }

        return $this;
    }

    public function removeAppointment(Appointment $appointment): self
    {
        if ($this->appointments->removeElement($appointment)) {
            // set the owning side to null (unless already changed)
            if ($appointment->getDoctor() === $this) {
                $appointment->setDoctor(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, MedicalArea>
     */
    public function getMedicalAreas(): Collection
    {
        return $this->medicalAreas;
    }

    public function addMedicalArea(MedicalArea $medicalArea): self
    {
        if (!$this->medicalAreas->contains($medicalArea)) {
            $this->medicalAreas[] = $medicalArea;
            $medicalArea->addDoctor($this);
        }

        return $this;
    }

    public function removeMedicalArea(MedicalArea $medicalArea): self
    {
        if ($this->medicalAreas->removeElement($medicalArea)) {
            $medicalArea->removeDoctor($this);
        }

        return $this;
    }

    public function getFullName(): string
    {
        return "Dr. " . $this->getFirstName() . " " . $this->getLastName();
    }

    public function getFullNameWithSpeciality(): string
    {
        if($this->getSpeciality() === null) {
            return $this->getFullName();
        }

        return $this->getFullName() . " (" . $this->getSpeciality()->getName() . ")";
    }
}
