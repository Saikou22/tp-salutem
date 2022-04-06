<?php

namespace App\Entity;

use App\Repository\AreaTypeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AreaTypeRepository::class)]
class AreaType
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'string', length: 255)]
    private string $name;

    #[ORM\OneToMany(mappedBy: 'areaType', targetEntity: MedicalArea::class, orphanRemoval: true)]
    private Collection $medicalAreas;

    public function __construct()
    {
        $this->medicalAreas = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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
            $medicalArea->setAreaType($this);
        }

        return $this;
    }

    public function removeMedicalArea(MedicalArea $medicalArea): self
    {
        if ($this->medicalAreas->removeElement($medicalArea)) {
            // set the owning side to null (unless already changed)
            if ($medicalArea->getAreaType() === $this) {
                $medicalArea->setAreaType(null);
            }
        }

        return $this;
    }
}
